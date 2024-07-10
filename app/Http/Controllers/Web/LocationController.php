<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\LocationSetting;
use App\Models\Location;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Design\AddHeadSocialRequest;

class LocationController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }
  public function getheadsocial()
  {
    $strgCtrlr = new StorageController();
    $path = $strgCtrlr->SitePath('image');
    $List = LocationSetting::wherehas('location', function ($query) {
      $query->where('name', 'header-social');
    })->with('location', 'setting')->get();

    $ComboList = Setting::whereDoesntHave('locationsettings', function ($query) {
      $query->wherehas('location', function ($query) {
        $query->where('name', 'header-social');
      });
    })->where('category', 'social')->get();
    // return  $ComboList;

    return view("admin.design.headersocial", [
      "List" => $List,
      "combo_list" => $ComboList,

    ]);



  }

  public function footersocial()
  {
    $strgCtrlr = new StorageController();
    $path = $strgCtrlr->SitePath('image');
    $List = LocationSetting::wherehas('location', function ($query) {
      $query->where('name', 'footer-social');
    })->with('location', 'setting')->get();

    $ComboList = Setting::whereDoesntHave('locationsettings', function ($query) {
      $query->wherehas('location', function ($query) {
        $query->where('name', 'footer-social');
      });
    })->where('category', 'social')->get();
    // return  $ComboList;

    return view("admin.design.footersocial", [
      "List" => $List,
      "combo_list" => $ComboList,

    ]);



  }

  public function addheadsocial(AddHeadSocialRequest $request)
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
      $setting_id = $formdata['setting_id'];
      $locmodel = Location::where('name', 'header-social')->first();
      $location_id = $locmodel->id;
      $locationset = LocationSetting::updateOrCreate(
        ['location_id' => $location_id, 'setting_id' => $setting_id],
        ['sequence' => 0, 'is_active' => 1]
      );
      // return redirect()->route('design.headsocial');
      return response()->json("ok");
    }
  }
  public function delheadsocial($id)
  {
    $item = LocationSetting::find($id);
    if (!($item === null)) {
      // Setting::where('media_id',$id)->delete();
      LocationSetting::find($id)->delete();
    }
    return redirect()->route('design.headsocial');
  }
  //footer
  public function addfootsocial(AddHeadSocialRequest $request)
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
      $setting_id = $formdata['setting_id'];
      $locmodel = Location::where('name', 'footer-social')->first();
      $location_id = $locmodel->id;
      $locationset = LocationSetting::updateOrCreate(
        ['location_id' => $location_id, 'setting_id' => $setting_id],
        ['sequence' => 0, 'is_active' => 1]
      );
      // return redirect()->route('design.headsocial');
      return response()->json("ok");
    }
  }

  public function delfootsocial($id)
  {
    $item = LocationSetting::find($id);
    if (!($item === null)) {
      // Setting::where('media_id',$id)->delete();
      LocationSetting::find($id)->delete();
    }
    return redirect()->route('design.footersocial');
  }



  public function headsocialsort($loc)
  {

    // $Dblist = LocationSetting::wherehas('location', function ($query)  {
    //     $query->where('name','header-social');
    //   })->wherehas('setting', function ($query)  {
    //     $query->where('is_active',1);
    //   })->with('location','setting')->orderBy('sequence')->get();

    //   $List= $Dblist->map(function ($locSetting) {
    //    return [
    //       'id' =>  $locSetting->id,
    //       'name' =>$locSetting->setting->value1,
    //       'sequence' => $locSetting->sequence,           
    //     ];
    //   });


    return view("admin.design.sortheadsocial", ["location" => $loc]);
  }
  public function showtable()
  {
    return view("admin.page.sorttable");
  }
  public function sortpage($loc)
  {
    return view("admin.page.sort", ["location" => $loc]);
  }

  public function hsocialsort($loc)
  {
    $Dblist = LocationSetting::wherehas('location', function ($query) use ($loc) {
      $query->where('name', $loc);
    })->wherehas('setting', function ($query) {
      $query->where('is_active', 1);
    })->with('location', 'setting')->orderBy('sequence')->get();
    $List = $Dblist->map(function ($locSetting) {
      return [
        'id' => $locSetting->id,
        'name' => $locSetting->setting->value1,
        'sequence' => $locSetting->sequence,
      ];
    });

    return response()->json($List);
  }


  public function updatesort(Request $request)
  {
    //  $data = json_decode($request->getContent(),true);
    $data = json_decode($request->getContent(), true);
    //  $data =   $request->json()->all();
    $collection = collect($data);

    $this->updatetreesequence($collection, 0);
    return "Saved";
    // return response()->json(['success' => true, 'message' => $js  ]);
  }
  public function updatetreesequence($item, int $i)
  {

    foreach ($item as $itemrow) {
      LocationSetting::find($itemrow["id"])->update([
        //  "parent_id" => $parentid,
        "sequence" => $i,
      ]);
      $i++;

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
    //
  }

  //Footer section
  //get for fill table
  public function getsectionsbyname($name)
  {
    //  $strgCtrlr = new StorageController(); 
    //$path= $strgCtrlr->SitePath('image');
    //etfootersections
    if ($name == 'footer') {
      $List = LocationSetting::wherehas('location', function ($query) {
        $query->where('name', 'footer-social-title')
          ->orwhere('name', 'footer-bottom')
          ->orWhere('name', 'Like', '%footer-sec-%');
      })->with('location', 'post')->orderBy('sequence')->get();
      //  return  $List;         
      return view("admin.design.section.footer.show", [
        "List" => $List,
      ]);
    } else if ($name == 'main-menu') {
      //temp
      $List = LocationSetting::wherehas('location', function ($query) {
        $query->where('name', 'main-menu');
      })->with('location', 'category.sons')->orderBy('sequence')->get();
      //,'category.posts:id,title'
      return view("admin.design.section.menu.show", [
        "List" => $List,
      ]);
    } else {
      return "Notfound";
    }
  }

  //saraha
  public function pagesnotsorted($loc)
  {
    $code="";
    if($loc=="cats"){
$code="ques";
    }else{
      $code="page";
    }
    $ComboList = Category::whereDoesntHave('locationsettings', function ($query) use ($loc) {
      $query->wherehas('location', function ($query) use ($loc) {
        $query->where('name', $loc);
      });
    })->where('code', $code)->get();
    // return  $ComboList;  

    return $ComboList;

  }
  public function getpagesforcombo($loc)
  {
    $Dblist = $this->pagesnotsorted($loc);
    $List = $Dblist->map(function ($category) {
      return [
        'id' => $category->id,
        'name' => $category->title,
      ];
    });
    // return  $ComboList;  
    return response()->json($List);


  }
  public function sortpages($loc)
  {
    $code="";
    if($loc=="cats"){
$code="ques";
    }else{
      $code="page";
    }
    $List = LocationSetting::wherehas('location', function ($query) use ($loc) {
      $query->where('name', $loc);
    })->
      wherehas('category', function ($query)use($code) {
        $query->where('code', $code);
      })->with('location', 'category')->get();

    
    return $List;
  }
  public function fillsortpages($loc)
  {
    $Dblist = $this->sortpages($loc);

    $List = $Dblist->map(function ($locSetting) {
      return [
        'id' => $locSetting->category->id,
        'name' => $locSetting->category->title,
        'sequence' => $locSetting->sequence,
      ];
    });
    // return  $ComboList;  
    return response()->json($List);

  }

  public function updatepagesort(Request $request,$loc)
  {  
    //  $data = json_decode($request->getContent(),true);
    $data = json_decode($request->getContent(), true);
    //  $data =   $request->json()->all();
    $collection = collect($data);
  //get old list
  $location_id=Location::where('name',$loc)->first()->id;
  $List = LocationSetting::wherehas('location', function ($query) use ($loc) {
    $query->where('name', $loc);
  })->delete();
  //
    $this->createsequence($collection, 0,$location_id);
    return "Saved";
    // return response()->json(['success' => true, 'message' => $js  ]);
  }
  public function createsequence($items, int $i,$location_id)
  {
    foreach ($items as $itemrow) {
      $newObj=new LocationSetting();
      $newObj->location_id = $location_id;
      //$newObj->setting_id = $formdata['setting_id'];
  //    $newObj->type = $formdata['type'];
    //  $newObj->dep = $formdata['dep'];
      $newObj->sequence = $i;
      $newObj->is_active =1;
      $newObj->main_table = 'categories';
      $newObj->category_id = $itemrow["id"];
     // $newObj->post_id = $formdata['post_id'];
     $newObj->save();      
      $i++;
    }
  }
  /*
  $locmodel = Location::where('name', 'header-social')->first();
      $location_id = $locmodel->id;
      $locationset = LocationSetting::updateOrCreate(
        ['location_id' => $location_id, 'setting_id' => $setting_id],
        ['sequence' => 0, 'is_active' => 1]
      );
  */
}
