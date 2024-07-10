<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;
use App\Http\Requests\Category\StoreCategoryRequest;
 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class CategoryQuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Category::where('code', 'ques')->get();

        return view("admin.catques.show", [
            "List" => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.catques.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $formdata = $request->all();
        // return  $formdata;
        // return redirect()->back()->with('success_message', $formdata);
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {
            /*
                                 return  redirect()->back()->withErrors($validator)
                                 ->withInput();
                                 */
            // return response()->withErrors($validator)->json();
            return response()->json($validator);

        } else {

           $tmpslug = "";
            if ($formdata["slug"] == "" || empty($formdata["slug"])) {
            $tmpslug = Str::slug($formdata["title"]); 
            } else {
                $tmpslug = Str::slug($formdata["slug"]) ;
            }
            $promodel = Category::where('slug', $tmpslug)->first();           
            if (!is_null($promodel)) {
              //  return response()->json( $promodel);
                // error
                return response()->json([
                    "errors" => ["slug" => [__('messages.this field exist', [], 'ar')]]
                ], 422);

            } else {
                $newObj = new Category();
                $newObj->title = $formdata['title'];
                $newObj->desc = $formdata['desc'];
                // $newObj->category_id = $formdata['category_id'];
                $newObj->slug = $tmpslug;
                // $newObj->metakey = $formdata['metakey'];   
                $newObj->status = isset($formdata["status"]) ? 1 : 0;
                $newObj->code = 'ques';
                $newObj->save();
                return response()->json("ok");
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
    public function edit( $id)
    {
     $item = Category::find($id);
     $lang_list = Language::orderByDesc('is_default')->with(
        [
            'langposts' => function ($q) use ($id) {
                $q->where('category_id', $id);
            }
        ]
    )->get();
        return view("admin.catques.edit", ["category" => $item,'lang_list'=>$lang_list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request,$id)
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
            // check if slug exist
            //run first time only
            $tmpslug = "";
            if ($formdata["slug"] == "" || empty($formdata["slug"])) {
                $tmpslug = Str::slug($formdata["title"]); 
                } else {
                    $tmpslug = Str::slug($formdata["slug"]) ;
                }
            $promodel = Category::where('slug', $tmpslug)->whereNot('id', $id)->first();
            if (!is_null($promodel)) {
                // error
                return response()->json([
                    "errors" => ["slug" => [__('messages.this field exist', [], 'ar')]]
                ], 422);
                //end run
            } else {
                Category::find($id)->update([
                    //'user_name'=>$formdata['user_name'],
                      'title' => $formdata['title'],
                      'desc' => $formdata['desc'],
                    'meta_key' => isset($formdata['metakey']) ? $formdata['metakey'] : '',
                    'slug' => $tmpslug ,
                    'status' => isset($formdata["status"]) ? 1 : 0,
                    'update_user_id' => Auth::user()->id,
                ]);

                return response()->json("ok");
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Category::find($id);
        if (!($item === null)) {
            Category::find($id)->delete();
        }
        return redirect()->back();
    }
}
