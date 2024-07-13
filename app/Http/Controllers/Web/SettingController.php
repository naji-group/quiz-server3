<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Http\Requests\Setting\UpdateTitleRequest;
use App\Http\Requests\Setting\UpdateFavRequest;
use App\Http\Requests\Setting\UpdateLogoRequest;
use App\Http\Requests\Setting\StoreSocialRequest;
use App\Http\Requests\Setting\UpdateSocialRequest;
use App\Http\Requests\Setting\UpdateEmailRequest;
use App\Http\Requests\Setting\StoreHeadRequest;

use App\Http\Requests\Setting\UpdatePhoneRequest;
use App\Models\LocationSetting;
use App\Http\Requests\Setting\UpdateWhatsRequest;
use App\Http\Requests\Setting\UpdateLocationRequest;
use App\Http\Requests\Setting\UpdateContactEmailRequest;
use App\Http\Requests\Setting\UpdateQuesRequest;

class SettingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //general setting
    return view("admin.setting.show");
  }

  public function getbasic()
  {
    $strgCtrlr = new StorageController();
    $path = $strgCtrlr->SitePath('image');


    $List = Setting::select(
      'id',
      'name1',
      'value1',
      'name2',
      'value2',
      'name3',
      'value3',
      'category',
      'dep',
      'sequence',
      'section',
      'location',
      'is_active',
    )->where('category', 'site-info')->get();
    $titlerow = $List->where('dep', 'title')->first();
    $title = $titlerow->value1;
    // $desc = $titlerow->value2;
    // $meta = $titlerow->value3;
    $logorow = $List->where('dep', 'logo')->first();
    $iconrow = $List->where('dep', 'icon')->first();
    $favicon = $strgCtrlr->getPath($iconrow->value1, $path);
    $favicon = ($favicon == '' ? $strgCtrlr->DefaultPath('image') : $favicon);
    $logo = $strgCtrlr->getPath($logorow->value1, $path);
    $logo = ($logo == '' ? $strgCtrlr->DefaultPath('image') : $logo);
    $facerow = $List->where('dep', 'facebook')->first();
    $twitterrow = $List->where('dep', 'twitter')->first();
    // $whats = $whatsrow->value1;
    //  $locationrow = $List->where('dep', 'location')->first();
    //   $location = $locationrow->value1;
    //   $contact_emailrow = $List->where('dep', 'contact_email')->first();
    //   $contact_email = $contact_emailrow->value1;
    return view("admin.setting.basic", [
      "titlerow" => $titlerow,
      "logorow" => $logorow,
      "iconrow" => $iconrow,
      // "desc" => $desc,
      // "meta" => $meta,
      "favicon" => $favicon,
      "logo" => $logo,
      "facerow" => $facerow,
      "twitterrow" => $twitterrow,
      // "contact_email" => $contact_email,
    ]);
  }

  public function updatetitle(UpdateTitleRequest $request)
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
      $item = Setting::where('category', 'site-info')->where('dep', 'title')->first();
      Setting::find($item->id)->update([
        'value1' => $formdata['title'],
        'value2' => $formdata['desc'],
        'value3' => $formdata['meta'],
      ]);
      return response()->json("ok");
    }
  }
  public function updatefav(UpdateFavRequest $request)
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
      $item = Setting::where('category', 'site-info')->where('dep', 'logo')->first();
      if ($request->hasFile('favicon')) {
        $file = $request->file('favicon');
        // $filename= $file->getClientOriginalName();                
        $this->storeImage($file, $item->id, 'value1');
      }
      return response()->json("ok");
    }
  }
  public function updatelogo(UpdateLogoRequest $request)
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
      $item = Setting::where('category', 'site-info')->where('dep', 'logo')->first();
      if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        // $filename= $file->getClientOriginalName();                
        $this->storeImage($file, $item->id, 'value2');
      }


      return response()->json("ok");
    }
  }
  public function updatewhats(UpdateWhatsRequest $request)
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
      $item = Setting::where('category', 'site-info')->where('dep', 'whatsapp')->first();
      Setting::find($item->id)->update([
        'value1' => $formdata['whatsapp'],

      ]);
      return response()->json("ok");
    }
  }
  //location
  public function updatelocation(UpdateLocationRequest $request)
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
      $item = Setting::where('category', 'site-info')->where('dep', 'location')->first();
      Setting::find($item->id)->update([
        'value1' => $formdata['location'],

      ]);
      return response()->json("ok");
    }
  }

  //social

  public function getsocial()
  {
    //   $strgCtrlr = new StorageController(); 
    //  $path= $strgCtrlr->SitePath('image');


    $List = Setting::select(
      'id',
      'name1',
      'value1',
      'name2',
      'value2',
      'name3',
      'value3',
      'category',
      'dep',
      'sequence',
      'section',
      'location',
      'is_active',
    )->where('category', 'social')->get();

    return view("admin.setting.showsocial", ["List" => $List]);
  }
  public function createsocial()
  {
    return view("admin.setting.createsocial");
  }
  public function editsocial($id)
  {
    $item = Setting::find($id);

    //

    return view("admin.setting.editsocial", ["item" => $item]);
  }
  public function storesocial(StoreSocialRequest $request)
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
      $newObj = new Setting();
      $newObj->name1 = 'Name';
      $newObj->value1 = $formdata['name'];
      $newObj->name2 = 'Code';
      $newObj->value2 = $formdata['code'];
      $newObj->name3 = 'Link';
      $newObj->value3 = $formdata['link'];
      $newObj->category = 'social';
      $newObj->dep = '';
      $newObj->sequence = 0;
      $newObj->section = '';
      $newObj->location = '';
      $newObj->is_active = isset($formdata["is_active"]) ? 1 : 0;
      $newObj->save();
      return response()->json("ok");
    }
  }
  public function updatesocial(UpdateTitleRequest $request, $id)
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
      Setting::find($id)->update([

        'value1' => $formdata['name'],
        'value2' => $formdata['code'],
        'value3' => $formdata['link'],
        'is_active' => isset($formdata["is_active"]) ? 1 : 0,

      ]);
      return response()->json("ok");
    }
  }

  public function delsocial($id)
  {
    $item = Setting::find($id);
    if (!($item === null)) {
      LocationSetting::where('setting_id', $id)->delete();
      Setting::find($id)->delete();
    }
    return redirect()->route('setting.getsocial');
  }


  //header info

  public function updatephone(UpdatePhoneRequest $request)
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
      $item = Setting::where('category', 'header-info')->where('dep', 'phone')->first();
      Setting::find($item->id)->update([
        'value1' => $formdata['phone'],
        'is_active' => isset($formdata["is_active"]) ? 1 : 0,

      ]);
      return response()->json("ok");
    }
  }
  public function updateemail(UpdateEmailRequest $request)
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
      $item = Setting::where('category', 'header-info')->where('dep', 'email')->first();
      Setting::find($item->id)->update([
        'value1' => $formdata['email'],
        'is_active' => isset($formdata["is_active-e"]) ? 1 : 0,

      ]);
      return response()->json("ok");
    }
  }

  //updatecontactemail
  public function updatecontactemail(UpdateContactEmailRequest $request)
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
      $item = Setting::where('category', 'site-info')->where('dep', 'contact_email')->first();
      Setting::find($item->id)->update([
        'value1' => $formdata['contact_email'],
      ]);
      if (isset($formdata['password'])) {
        $password = trim($formdata['password']);
        Setting::find($item->id)->update([
          'value2' => $password,
        ]);
      }
      return response()->json("ok");
    }
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
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
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
  public function destroy(string $id)
  {
    $item = Setting::find($id);
    if (!($item === null)) {
      if (
        ($item->category == 'header-info' && $item->dep == 'header')
        || ($item->category == 'footer-info' && $item->dep == 'footer')
      ) {
        Setting::find($id)->delete();
      }
      return redirect()->back()->with('success', 'تم الحذف بنجاح');
    } else {
      return redirect()->back();

    }
  }

  public function storeImage($file, $id, $column)
  {
    $imagemodel = Setting::find($id);
    $strgCtrlr = new StorageController();
    $path = $strgCtrlr->path['site'];
    $oldimage = $imagemodel[$column];
    $oldimagename = basename($oldimage);
    //  $oldimagepath = $path . '/' . $oldimagename;
    //save photo  
    if ($file !== null) {
      //  $filename= rand(10000, 99999).".".$file->getClientOriginalExtension();
      $ext = $file->getClientOriginalExtension();
      $filename = rand(10000, 99999) . $id . "." . $ext;
      //  $filename =  $imagemodel->code . $id . ".webp";
      //  $filename =  $imagemodel->code . $id .'.'.$ext;    
      Storage::delete("public/" . $path . '/' . $oldimagename);
      $path = $file->storeAs($path, $filename, 'public');
      Setting::find($id)->update([
        $column => $filename
      ]);
    }
    return 1;
  }

  ///////////////////////////////info

  public function updateinfo(UpdateTitleRequest $request, $id)
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
      //  $item = Setting::where('category', 'site-info')->where('dep', 'title')->first();
      $item = Setting::find($id);
      if ($item->category == 'site-info' && $item->dep == 'title') {
        Setting::find($id)->update([
          'value1' => $formdata['name'],
        ]);
      } else if ($item->category == 'site-info' && $item->dep == 'icon') {
        if ($request->hasFile('icon_input')) {
          $file = $request->file('icon_input');
          // $filename= $file->getClientOriginalName();                
          $this->storeImage($file, $id, 'value1');
        }
      } else if ($item->category == 'site-info' && $item->dep == 'logo') {
        if ($request->hasFile('logo_input')) {
          $file = $request->file('logo_input');
          // $filename= $file->getClientOriginalName();                
          $this->storeImage($file, $id, 'value1');
        }
      }
      if ($item->category == 'site-info' && $item->dep == 'facebook') {

        Setting::find($id)->update([
          'value1' => $formdata['face'],
        ]);
        Setting::where('category', 'site-info')->where('dep', 'twitter')->first()->update([
          'value1' => $formdata['twitter'],
        ]);
      }

      return response()->json("ok");
    }
  }

  public function getheadinfo()
  {


    $List = Setting::select(
      'id',
      'name1',
      'value1',
      'name2',
      'value2',
      'name3',
      'value3',
      'category',
      'dep',
      'sequence',
      'section',
      'location',
      'is_active',
    )->where('category', 'header-info')->where('dep', 'header')->get();
    // $phonerow = $List->where('dep', 'phone')->first();

    // $emailrow = $List->where('dep', 'email')->first();

    return view("admin.setting.headerinfo", ['List' => $List]);
  }

  public function createhead()
  {
    return view("admin.setting.createheader");
  }
  public function storehead(StoreHeadRequest $request)
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
      $newObj = new Setting();
      $newObj->name1 = $formdata['name'];
      $newObj->value1 = $formdata['code'];
      // $newObj->name2 = 'Code';
      // $newObj->value2 = $formdata['code'];
      // $newObj->name3 = 'Link';
      // $newObj->value3 = $formdata['link'];
      $newObj->category = 'header-info';
      $newObj->dep = 'header';
      $newObj->sequence = 0;
      $newObj->section = '';
      $newObj->location = '';
      $newObj->is_active = 1;
      $newObj->save();
      return response()->json("ok");
    }
  }
  public function updatehead(StoreHeadRequest $request, $id)
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
      $item = Setting::find($id);
      if ($item->category == 'header-info' && $item->dep == 'header') {
        Setting::find($id)->update([
          'name1' => $formdata['name'],
          'value1' => $formdata['code'],
        ]);
      }
      return response()->json("ok");
    }
  }

  public function footerinfo()
  {


    $List = Setting::select(
      'id',
      'name1',
      'value1',
      'name2',
      'value2',
      'name3',
      'value3',
      'category',
      'dep',
      'sequence',
      'section',
      'location',
      'is_active',
    )->where('category', 'footer-info')->where('dep', 'footer')->get();


    return view("admin.setting.footer.edit", ['List' => $List]);
  }
  public function createfooter()
  {
    return view("admin.setting.footer.create");
  }
  public function storefooter(StoreHeadRequest $request)
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
      $newObj = new Setting();
      $newObj->name1 = $formdata['name'];
      $newObj->value1 = $formdata['code'];
      // $newObj->name2 = 'Code';
      // $newObj->value2 = $formdata['code'];
      // $newObj->name3 = 'Link';
      // $newObj->value3 = $formdata['link'];
      $newObj->category = 'footer-info';
      $newObj->dep = 'footer';
      $newObj->sequence = 0;
      $newObj->section = '';
      $newObj->location = '';
      $newObj->is_active = 1;
      $newObj->save();
      return response()->json("ok");
    }

  }

  public function updatefooter(StoreHeadRequest $request, $id)
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
      $item = Setting::find($id);
      if ($item->category == 'footer-info' && $item->dep == 'footer') {
        Setting::find($id)->update([
          'name1' => $formdata['name'],
          'value1' => $formdata['code'],
        ]);
      }
      return response()->json("ok");
    }
  }

  public function delfooter(UpdateEmailRequest $request, $id)
  {
  }

  //Question settting
//get ques setting
public function getquessetting()
{
  $List = Setting::select(
    'id',
    'name1',
    'value1',
    'category',
    'dep',
    'is_active',
  )->where('category', 'question')->get();

  $minpoints = $List->where('dep', 'minpoints')->first();

  $pointsrate = $List->where('dep', 'pointsrate')->first();
  return ['minpoints'=> $minpoints->value1,
  'pointsrate'=>$pointsrate->value1];
}
  public function quessetting()
  {

    $List = Setting::select(
      'id',
      'name1',
      'value1',
      'category',
      'dep',
      'is_active',
    )->where('category', 'question')->get();

    $minpoints = $List->where('dep', 'minpoints')->first();

    $pointsrate = $List->where('dep', 'pointsrate')->first();
    return view("admin.setting.ques", [
      'minpoints' => $minpoints,
      'pointsrate' => $pointsrate
    ]);
  }
  public function quesupdate(UpdateQuesRequest $request, $id)
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
      $item = Setting::find($id);
      if ($item->category == 'question' && $item->dep == 'minpoints') {
        Setting::find($id)->update([
          'value1' => $formdata['minpoints'],
        ]);
      } else if ($item->category == 'question' && $item->dep == 'pointsrate') {
        Setting::find($id)->update([
          'value1' => $formdata['pointsrate'],
        ]);
      }
    }
    return response()->json("ok");
  }

}
