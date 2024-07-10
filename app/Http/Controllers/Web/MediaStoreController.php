<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MediaPost;

use App\Models\Mediastore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaStoreController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
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
  public function getbyid($id)
  {
    $item = Mediastore::select('id', 'name', 'caption', 'local_path', 'type')->find($id);
    return response()->json($item);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }
  // public function getgallery($id)
  // {
  //   $List = MediaProject::with('mediastore')->where('project_id', $id)->get();
  //   $List = $List->where('media_type', 'image');
  //   return view('admin.media.showgallery', ['List' => $List]);
  //   //   return  $List;
  // }
  public function getcatgallery($id)
  {
    $List = MediaPost::with('mediastore')->where('category_id', $id)->get();
    $List = $List->where('media_type', 'image');
    return view('admin.catques.media.showcatgallery', ['List' => $List]);
    //   return  $List;
  }
  public function getpostgallery($id)
  {
    $List = MediaPost::with('mediastore')->where('post_id', $id)->get();
    $List = $List->where('media_type', 'image');
    return view('admin.design.section.menu.media.showpostgallery', ['List' => $List]);
    //   return  $List;
  }
  public function getcatpdf($id)
  {
    $List = MediaPost::with('mediastore')->where('category_id', $id)->get();
    $List = $List->where('media_type', 'pdf');
    return view('admin.design.section.menu.media.showcatpdf', ['List' => $List]);
    //   return  $List;
  }
  // public function getvideo($id)
  // {
  //   $List = MediaProject::with('mediastore')->where('project_id', $id)->get();
  //   $List = $List->where('media_type', 'video');
  //   return view('admin.media.showvideo', ['List' => $List]);
  //   //   return  $List;
  // }
  //category post video
  public function getcatvideo($id)
  {
    $List = MediaPost::with('mediastore')->where('category_id', $id)->get();
    $List = $List->where('media_type', 'video');
    return view('admin.design.section.menu.media.showcatvideo', ['List' => $List]);
    //   return  $List;
  }
  public function getpostvideo($id)
  {
    $List = MediaPost::with('mediastore')->where('post_id', $id)->get();
    $List = $List->where('media_type', 'video');
    return view('admin.design.section.menu.media.showpostvideo', ['List' => $List]);
    //   return  $List;
  }
  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroyimage($id)
  {
    $this->deleteimage($id);
    return response()->json("ok");

  }
  public function deleteimage($id)
  {

    $item = Mediastore::find($id);


    if (!($item === null)) {
      $local_path = $item->local_path;
      $oldimagename = $item->name;
      $strgCtrlr = new StorageController();
      $path = '';
      if ($item->type == 'image') {
        $path = $strgCtrlr->path[$local_path];
      } else if ($item->type == 'pdf') {
        //pdf
        $path = $strgCtrlr->pdfpath[$local_path];
      } else {
        //video
        $path = $strgCtrlr->vidpath[$local_path];
      }
      Storage::delete("public/" . $path . '/' . $oldimagename);
      if ($local_path == 'projects') {
     //   MediaProject::where('media_id', $id)->delete();
      } else {
        $res = MediaPost::where('media_id', $id)->delete();
      }
      Mediastore::find($id)->delete();
    }

    return 1;

  }
}
