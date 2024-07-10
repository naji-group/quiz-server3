<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnswersClient;
use App\Models\Category;
use App\Models\Language;
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

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Question::with('category', 'language')->get();

        return view("admin.question.show", ["List" => $items,]);
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
                ->whereDoesntHave('answers.answersclients', function ($query) use ($client_id) {
                    $query->where('client_id', $client_id);
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
            $ansmodel = Answer::where(['id' => $answer_id, 'question_id' => $question_id])->first();
            $anscorrect = Answer::where(['is_correct' => 1, 'question_id' => $question_id])->first();
            if ($ansmodel) {
                //record the answer
                $newObj = new AnswersClient();
                $newObj->is_correct = $ansmodel->is_correct;
                $newObj->points = 1;
                $newObj->client_id = $client_id;
                $newObj->answer_id = $answer_id;
                // $newObj->level_id = ;
              //  $newObj->question_content ='';
                $newObj->answer_content = $ansmodel->content;
                // $newObj->question_type = $formdata['question_type'];
                $newObj->answer_type = $ansmodel->type;                     
                // $newObj->question_file = $formdata['question_file'];
                // $newObj->answer_file = $formdata['answer_file'];
              //  $newObj->save();// temmmmmmmmmmmmmmmmmmmmmmmmmmp
                $client=Client::find($client_id);
                if ($ansmodel->is_correct == 1) {
                    // correct answer

                  
                  
                    $newbalance = $client->balance + 1;
                    $client->balance= $newbalance;
                    $client->save();
                    // Client::find($client_id)->update([
                    //     'balance' => $newbalance,
                    // ]);
                   
                    $resArr = [
                        'balance' => $client->balance,
                        'result' => 1,
                        'correct_ans' => $anscorrect->id,
                    ];
                } else {
                    //wrong answer
                    $resArr = [
                        'balance' => $client->balance,
                        'result' => 0,
                        'correct_ans' => $anscorrect->id,
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
