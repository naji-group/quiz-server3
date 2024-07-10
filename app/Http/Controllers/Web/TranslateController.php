<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LangPost;
use App\Models\MediaPost;
use App\Models\Mediastore;
use App\Models\Post;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\Post\UpdateFooterRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Controllers\Web\MediaStoreController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

//use Illuminate\Routing\Controller as BaseController;








class TranslateController extends Controller
{
  /**
   * Display a listing of the resource.
   */


  /**
   * Show the form for creating a new resource.
   */
  public function createwithcatid()
  {

    $item = Category::where('code', 'translate')->first();
    return view('admin.translate.create', ["category" => $item]);
  }
  public function storepost(StorePostRequest $request)
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


      $newObj = new Post;
      $newObj->title = $formdata['title'];
      $newObj->category_id = $formdata['category_id'];
      $newObj->code = isset($formdata["code"]) ? $formdata["code"] : '';
      // $newObj->metakey = $formdata['metakey'];   
      $newObj->status = isset($formdata["status"]) ? 1 : 0;
      $newObj->save();
      return response()->json("ok");



    }
  }
  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
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
    $item = Post::with([
      'category',
      'mediaposts' => function ($q) use ($id) {
        $q->with('mediastore');
      }
    ])->find($id);
    $lang_list = Language::orderByDesc('is_default')->with(
      [
        'langposts' => function ($q) use ($id) {
          $q->where('post_id', $id);
        }
      ]
    )->get();
    //
    //   return $item;
    return view("admin.design.section.footer.edit", ["item" => $item, 'lang_list' => $lang_list]);
  }


  public function editpost($id)
  {
    $item = Post::with([
      'mediaposts' => function ($q) use ($id) {
        $q->with('mediastore');
      }
    ])->find($id);
    $lang_list = Language::orderByDesc('is_default')->with(
      [
        'langposts' => function ($q) use ($id) {
          $q->where('post_id', $id);
        }
      ]
    )->get();
    //
    //   return $item;
    return view("admin.translate.edit", ["post" => $item, 'lang_list' => $lang_list]);
  }
  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateFooterRequest $request, $id)
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
      //check if slug exist
      $tmpslug = "";
      if ($formdata["slug"] == "" || empty($formdata["slug"])) {
        $tmpslug = $formdata["title"];
      } else {
        $tmpslug = $formdata["slug"];
      }
      $promodel = Post::where('slug', $tmpslug)->whereNot('id', $id)->first();
      if (!is_null($promodel)) {
        // error
        return response()->json([
          "errors" => ["slug" => [__('messages.this field exist', [], 'en')]]
        ], 422);

      } else {


        Post::find($id)->update([
          //'user_name'=>$formdata['user_name'],
          'title' => $formdata['title'],
          'metakey' => $formdata['metakey'],
          'slug' => Str::slug($tmpslug),

          'status' => isset($formdata["status"]) ? 1 : 0,
        ]);

        return response()->json("ok");
      }

    }
  }
  public function updatepost(UpdateFooterRequest $request, $id)
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
      //check if slug exist
      $tmpslug = "";
      //  if ($formdata["slug"] == "" || empty($formdata["slug"])) {
      $tmpslug = $formdata["title"];
      // } else {
      //     $tmpslug = $formdata["slug"];
      // }
      $promodel = Post::where('slug', $tmpslug)->whereNot('id', $id)->first();
      if (!is_null($promodel)) {
        // error
        return response()->json([
          "errors" => ["slug" => [__('messages.this field exist', [], 'en')]]
        ], 422);

      } else {


        Post::find($id)->update([
          //'user_name'=>$formdata['user_name'],
          'title' => $formdata['title'],
          //  'metakey' => $formdata['metakey'],
          'slug' => Str::slug($tmpslug),

          'status' => isset($formdata["status"]) ? 1 : 0,
        ]);

        return response()->json("ok");
      }

    }
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $item = Post::find($id);
    if (!($item === null)) {
      //delete image
      // $medstor = new MediaStoreController();
      // $list = MediaPost::where('post_id', $id)->get();
      // foreach ($list as $mediapost) {
      //   $medstor->deleteimage($mediapost->media_id);
      // }

      //delete   MediaPost records
    //  MediaPost::where('post_id', $id)->delete();
      LangPost::where('post_id', $id)->delete();
      Post::find($id)->delete();
    }
    return redirect()->back();

  }


  public function showbycatid($id)
  {
    //  $strgCtrlr = new StorageController(); 
    //$path= $strgCtrlr->SitePath('image');
    //etfootersections

    //temp
    $category = Category::find($id);
    $list = Post::where('category_id', $id)->get();

    return view("admin.post.show", [
      "list" => $list,
      "category" => $category,
    ]);





  }
  public function translate()
  {

    $category = Category::where('code', 'translate')->first();
    $list = Post::where('category_id', $category->id)->get();
    return view("admin.translate.show", [
      "list" => $list,
      "category" => $category,
    ]);
  }


}
