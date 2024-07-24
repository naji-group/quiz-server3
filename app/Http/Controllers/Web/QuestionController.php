<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnswersClient;
use App\Models\Category;
use App\Models\ClientPoint;
use App\Models\Language;
use App\Models\Level;
use App\Models\Question;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Question\StoreQuesRequest;
use App\Http\Requests\Question\SendQuesRequest;
use App\Http\Requests\Question\CheckAnsRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
 
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Question::with('category', 'language')->paginate(100);

        return view("admin.question.show", ["List" => $items,]);
    }
    public function search(Request $request )
    {
       
       // $formdata = $request->all();
        $searchval=$request->input('content');
    //   if($request->input('page')){
    //     return $request->input('page');
    //   }
       if($searchval!=''){
        //return $searchval;
        $List = Question::with('category', 'language')->where('content','like','%'.$searchval.'%')
        ->paginate(5)
        ->setpath('');
        $List->appends(array(
            'content'=>$searchval));
            if(count($List)>0){
                return view("admin.question.show", ["List" => $List]);
            }else{
                return view("admin.question.show" );
            }
       }else{
        $List=null;
       }   
      
       
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lang_list = Language::orderByDesc('is_default')->get();
        $cat_list = Category::where('code', 'ques')->orderBy('title')->get();
        return view("admin.question.create", ["lang_list" => $lang_list, 'cat_list' => $cat_list]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuesRequest $request)
    {
        $formdata = $request->all();
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {

            return response()->json($validator);
        } else {
            //check if answers exist at least 2
            $i = 0;
            foreach ($formdata['answer_content'] as $key => $option) {
                if (!is_null($option)) {
                    if (trim($option) != "") {
                        $i++;
                    }
                }
            }
            if ($i >= 2) {
                //add ques
                $newObj = new Question();
                $newObj->content = $formdata['content'];
                $newObj->points = 1;
                $newObj->category_id = $formdata['category_id'];
                $newObj->lang_id = $formdata['lang_id'];
                $newObj->status = isset($formdata["status"]) ? 1 : 0;
                $newObj->type = 'text';
                $newObj->createuser_id = Auth::user()->id;
                $newObj->updateuser_id = Auth::user()->id;
                $newObj->save();
                //save answers
                foreach ($formdata['answer_content'] as $key => $option) {
                    if (!is_null($option)) {
                        $answer = new Answer();
                        $answer->question_id = $newObj->id;
                        $answer->sequence = $key;
                        $answer->content = trim($option);
                        $answer->is_correct = $formdata['is_correct'] == $key ? 1 : 0;
                        $answer->status = 1;
                        $answer->createuser_id = Auth::user()->id;
                        $answer->updateuser_id = Auth::user()->id;
                        $answer->type = 'text';
                        $answer->save();
                    }
                }
                return response()->json("ok");
            } else {
                return response()->json("fewanswers");
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Question::with('answers')->find($id);
        $lang_list = Language::orderByDesc('is_default')->get();
        $cat_list = Category::where('code', 'ques')->orderBy('title')->get();

        return view("admin.question.edit", ["question" => $item, "lang_list" => $lang_list, 'cat_list' => $cat_list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuesRequest $request, $id)
    {
        $formdata = $request->all();
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );
        if ($validator->fails()) {
            return response()->json($validator);
        } else {
            // //check if answers exist at least 2
            $i = 0;
            foreach ($formdata['answer_content'] as $key => $option) {
                if (!is_null($option)) {
                    if (trim($option) != "") {
                        $i++;
                    }
                }
            }
            if ($i >= 2) {
                Question::find($id)->update([
                    'content' => $formdata['content'],
                    'category_id' => $formdata['category_id'],
                    'lang_id' => $formdata['lang_id'],
                    'status' => isset($formdata["status"]) ? 1 : 0,
                    'updateuser_id' => Auth::user()->id,
                ]);

                foreach ($formdata['answer_content'] as $key => $option) {
                    if (!is_null($option)) {
                        if (trim($option) != "") {
                            $iscorrect = $formdata['is_correct'] == $key ? 1 : 0;
                            $res = Answer::updateOrCreate(
                                ['question_id' => $id, 'sequence' => $key]
                                ,
                                [
                                    'content' => trim($option),
                                    'is_correct' => $iscorrect,
                                    'status' => 1,
                                    'createuser_id' => Auth::user()->id,
                                    'updateuser_id' => Auth::user()->id,
                                    'type' => 'text',
                                ]
                            );
                        } else {
                            $res = Answer::where('question_id', $id)->where('sequence', $key)->delete();
                        }
                    } else {
                        $res = Answer::where('question_id', $id)->where('sequence', $key)->delete();
                    }
                }
            } else {
                return response()->json("fewanswers");
            }
            return response()->json("ok");
        }
    }
    public function sendquiz(SendQuesRequest $request, $lang)
    {
        $formdata = $request->all();
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );
        if ($validator->fails()) {
            return response()->json($validator);
        } else {
            $client_id = auth()->guard('client')->user()->id;
            $category_id = $formdata['cat'];
            $lang_id = $formdata['lang'];
            $catmodel=Category::find($category_id);
            if($catmodel->notes=='general'){
                $queslist = Question::where('lang_id',$lang_id)
                ->whereDoesntHave('answers.answersclients', function ($query) use ($client_id,$category_id) {
                    $query->where('client_id', $client_id)//->where('category_id',$category_id)//if we want not repeat ques from other cat
                    ;
                })->select('id')->pluck('id');
            }else{
                $queslist = Question::where(['category_id' => $category_id, 'lang_id' => $lang_id])
                ->whereDoesntHave('answers.answersclients', function ($query) use ($client_id) {
                    $query->where('client_id', $client_id);
                })->select('id')->pluck('id');
            }           
               if($queslist->count()>0){
                $randid = Arr::random($queslist->toArray());
                $ques = Question::with('answers')->find($randid);
                $quesmaped = $this->quesmap($ques);
               } else{
                $quesmaped=[];
               }
     
            return response()->json($quesmaped);
        }
    }
    public function quesmap(Question $ques)
    {
        $answers = $ques->answers->map(function ($answer) {
            return [
                "id" => $answer->id,
                "content" => $answer->content,
                "sequence" => $answer->sequence,
            ];
        });
        $quesArr = [
            "id" => $ques->id,
            "content" => $ques->content,
            "answers" => $answers
        ];
        return $quesArr;
    }

    public function checkanswer(CheckAnsRequest $request, $lang)
    {
     
       // CheckAnsRequest
        $formdata = $request->all();
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );
        if ($validator->fails()) {
            return response()->json($validator);
        } else {
            $client_id = auth()->guard('client')->user()->id;
            $question_id = $formdata['ques'];
            $answer_id = $formdata['ans'];
            $category_id = $formdata['cat'];
            $ansmodel = Answer::where(['id' => $answer_id, 'question_id' => $question_id])->first();
            $anscorrect = Answer::where(['is_correct' => 1, 'question_id' => $question_id])->first();
            $giftpoints=0;
            $notifylevel=0;
            $levelnum=0;
            if ($ansmodel) {
                //record the answer
                $newObj = new AnswersClient();
                $newObj->is_correct = $ansmodel->is_correct;
                $newObj->points = $ansmodel->is_correct==1?1:0;
                $newObj->client_id = $client_id;
                $newObj->answer_id = $answer_id;
                $newObj->category_id = $category_id;
                // $newObj->level_id = ;
              //  $newObj->question_content ='';
                $newObj->answer_content = $ansmodel->content;
                // $newObj->question_type = $formdata['question_type'];
                $newObj->answer_type = $ansmodel->type;                     
                // $newObj->question_file = $formdata['question_file'];
                // $newObj->answer_file = $formdata['answer_file'];
                $newObj->save();// tem 
                $client=Client::find($client_id);
               
                $clpointmodel= ClientPoint::where('client_id',$client_id)->where('category_id',$category_id)->orderByDesc('created_at')->first();
                if ($ansmodel->is_correct == 1) {
                    // correct answer
                    $client->balance = $client->balance + 1;                     
                    $client->total_balance=$client->total_balance+1;                 
                    // level check.
                    //get category
                    //check if ClientPoint level exist
if($clpointmodel){
    $clpointmodel->points_sum= $clpointmodel->points_sum+1;
    $clpointmodel->save();
    $currentlevel=Level::find($clpointmodel->level_id);
    //save level id in AnswersClient record
    $newObj->level_id=$clpointmodel->level_id;
    $newObj->save();
    $nextlevelval=$currentlevel->value+1;
    $nextlevel=Level::where('value', $nextlevelval)->first();
if($nextlevel){
    // next level exist
    if($clpointmodel->points_sum>= $nextlevel->answers_count){
        //move to next level
        //add new record
        $client->balance=$client->balance+$nextlevel->points;
        $client->total_balance=$client->total_balance+$nextlevel->points;
        $newCpObj=new ClientPoint();
        $newCpObj->points_sum = 0;
        $newCpObj->gift_sum = $nextlevel->points;
        $newCpObj->category_id = $category_id;
        $newCpObj->client_id =$client_id;
        $newCpObj->level_id = $nextlevel->id;
        $newCpObj->save();
        //add answerclient record for gift
        $giftObj = new AnswersClient();
        $giftObj->is_correct =1;
        $giftObj->points = $nextlevel->points;
        $giftObj->client_id = $client_id;
       // $newObj->answer_id = $answer_id;
        $giftObj->category_id = $category_id;
          $giftObj->level_id = $nextlevel->id ;
        $giftObj->question_type ='gift';      
        $giftObj->save();

        $giftpoints=$nextlevel->points;
        $notifylevel=1;
        $levelnum= $nextlevel->value;
            }
}else{
    //no next level
    $notifylevel=2;
}
}else{
    $newCpObj=new ClientPoint();
    //level0
    $currentlevel=Level::orderBy('value')->first();
   $client->balance=$client->balance+$currentlevel->points;
$client->total_balance=$client->total_balance+$currentlevel->points;
    $newCpObj->points_sum = 1;
    $newCpObj->gift_sum = $currentlevel->points;
    $newCpObj->category_id =$category_id;
    $newCpObj->client_id =$client_id;
    $newCpObj->level_id =$currentlevel->id;
    $newCpObj->save();
   //save level id in AnswersClient record
    $newObj->level_id=$currentlevel->id;
    $newObj->save();
    if($currentlevel->points>0){
        $notifylevel=1;
   //add answerclient record for gift
        $giftObj = new AnswersClient();
        $giftObj->is_correct =1;
        $giftObj->points =$currentlevel->points;
        $giftObj->client_id = $client_id;
      
        $giftObj->category_id = $category_id;
          $giftObj->level_id =$currentlevel->id;
        $giftObj->question_type ='gift';      
        $giftObj->save();
    } 
    $giftpoints= $currentlevel->points;
    $levelnum= $currentlevel->value;
} 
$client->save();
                    //end level check                    
                    $resArr = [
                        'balance' => $client->balance,
                        'result' => 1,
                        'correct_ans' => $anscorrect->id,
                        'notifylevel'=>$notifylevel,
                        'giftpoints'=>$giftpoints,
                        'levelnum'=> $levelnum,                       
                    ];
                } else {
                    //wrong answer
                    if($clpointmodel){
                        $currentlevel=Level::orderBy('value')->first();
                        $newObj->level_id = $currentlevel->id;
                    }
                    else{
                        $newObj->level_id = $clpointmodel->level_id;
                    }
                    $newObj->save();
                    $resArr = [
                        'balance' => $client->balance,
                        'result' => 0,
                        'correct_ans' => $anscorrect->id,
                        'notifylevel'=>$notifylevel,
                       // 'giftpoints'=>$giftpoints,
                    ];
                }
            }
            return response()->json($resArr);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete 
        $item = Question::find($id);
        if (!($item === null)) {
            Answer::where('question_id', $id)->delete();
            Question::find($id)->delete();
        }
        return redirect()->back();

    }
}
