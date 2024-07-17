<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AnswersClient;
use App\Models\Category;
use App\Models\ClientPoint;
use App\Models\PointTrans;
use App\Models\SocialModel;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientSocial;
use App\Models\MessageModel;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdatePassRequest;
use App\Http\Requests\Client\PullRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\LoginClientRequest;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Web\MessageController;
use URL;
//use Illuminate\Support\Facades\Session;
use Session;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $clients = Client::paginate(100);
    return view('admin.client.all', [
      'clients' => $clients,
    ]);
  }
  public function pullops($id)
  {
    $client=Client::find($id);
    $op_list = PointTrans::with('client')->where('client_id',$id)->orderByDesc('created_at')->paginate(100);
    return view('admin.client.pull', [
      'op_list' => $op_list,
      'client' => $client,
    ]);
  }
  public function allpullops()
  {
    $op_list = PointTrans::with('client')->orderByDesc('created_at')->paginate(100);
    return view('admin.client.pullall', [
      'op_list' => $op_list,
    ]);
  }
  /**
   * Display the specified resource.
   */
  public function show($id)
  {
    $lang='ar';
    $client = Client::find($id);
   $cntryjson=  'assets/site/js/countries/' . $lang . '/countries.json' ;
   $countries = json_decode(File::get($cntryjson), true);
   $countries =collect( $countries );
   $client_country=$countries->where('alpha2',$client->country)->first();
   if($client_country){
    $client->country_conv=$client_country['name'];
   }else{
    $client->country_conv='-';
   }

  // return $client_country;
    return view('admin.client.show', [
      'client' => $client,
    ]);
  }
  /**
   * Show the form for creating a new resource.
   */
  public function create($lang)
  {
    $sitedctrlr = new SiteDataController();
    $transarr = $sitedctrlr->FillTransData($lang);
    $defultlang = $transarr['langs']->first();

    $register = $sitedctrlr->getbycode($defultlang->id, ['register','register-error']);

    return view('site.client.register', [
      'transarr' => $transarr,
      'lang' => $lang,
      'defultlang' => $defultlang,
      'register' => $register,
      'sitedataCtrlr' => $sitedctrlr
    ]);
  }
  public function showlogin($lang)
  {
    $sitedctrlr = new SiteDataController();
    $transarr = $sitedctrlr->FillTransData($lang);
    $defultlang = $transarr['langs']->first();

    $login = $sitedctrlr->getbycode($defultlang->id, ['login','register-error']);

    return view('site.client.login', [
      'transarr' => $transarr,
      'lang' => $lang,
      'defultlang' => $defultlang,
      'login' => $login,
      'sitedataCtrlr' => $sitedctrlr
    ]);
  }


  public function login(LoginClientRequest $request)//: RedirectResponse
  {
    $request->authenticate();

    $request->session()->regenerate();
    //new code
    //return redirect()->intended(Route('mymessages',false));
    return response()->json("ok");


  }
  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreClientRequest $request, $lang)//StoreClientRequest
  {
    StoreClientRequest::$lang=$lang;
    $formdata = $request->all();
    // return  $formdata;
    // return redirect()->back()->with('success_message', $formdata);
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );

    if ($validator->fails()) {

      return response()->json($validator);
      //return redirect()->with('errors',$validator)->json();
      //   return response()->json($validator);
      //  return redirect()
      //  ->back()
      //  ->withErrors($validator)
      //  ->withInput();

    } else {

      //  $lang= $formdata["lang"];
      $sitedctrlr = new SiteDataController();
      $transarr = $sitedctrlr->FillTransData($lang);
      $defultlang = $transarr['langs']->first();
      $newObj = new Client;
      //  $slug=   Str::slug($formdata['name']);
      $newObj->name = $formdata['name'];
      // $newObj->first_name = $formdata['first_name'];
      // $newObj->last_name = $formdata['last_name'];
      $newObj->email = $formdata['email'];
      $newObj->password = bcrypt($formdata['password']);
      // $newObj->mobile = $formdata['mobile'];
      // $newObj->role = 'admin';
      //   $newObj->is_active = $formdata['is_active'];
      // $newObj->user_name=$slug;
      $newObj->is_active = 1;
      $newObj->lang_id = $defultlang->id;
      $newObj->save();

      if ($request->hasFile('image')) {

        $file = $request->file('image');
        // $filename= $file->getClientOriginalName();

        $this->storeImage($file, $newObj->id);
        //  $this->storeImage( $file,2);
      }
      event(new Registered($newObj));
      Auth::guard('client')->login($newObj);
      // make login after register
      //  return redirect()->route('site.home');
      return response()->json("ok");
    }
  }
  
   

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($lang)
  {
    if (Auth::guard('client')->check()) {
      $id = Auth::guard('client')->user()->id;
      $client = Client::find($id);
      $client->birthdateStr = (string) Carbon::create($client->birthdate)->format('Y-m-d');
      //return response()->json($this->getsocial($id));  
      $sitedctrlr = new SiteDataController();
      $transarr = $sitedctrlr->FillTransData($lang);

      $defultlang = $transarr['langs']->first();
      // $profile = $sitedctrlr->getbycode($defultlang->id, ['profile', 'register']);

      $profile = $sitedctrlr->getbycode($defultlang->id, ['profile','register-error']);


      return view(
        "site.client.edit",
        [
          "client" => $client,
          'transarr' => $transarr,
          'lang' => $lang,
          'defultlang' => $defultlang,
          'profile' => $profile,
          'sitedataCtrlr' => $sitedctrlr

        ]
      );

    } else {
      return redirect()->route('login.client');
    }

  }
  public function myscore($lang)
  {
    if (Auth::guard('client')->check()) {
      $client_id = Auth::guard('client')->user()->id;
      //$client=Client::find($client_id);
//clpointmodel= ClientPoint::where('client_id',$client_id)->where('category_id',$category_id)->orderByDesc('created_at')->first();

      //return response()->json($this->getsocial($id));  
      $sitedctrlr = new SiteDataController();
      $transarr = $sitedctrlr->FillTransData($lang);
      $defultlang = $transarr['langs']->first();
      //$catlist=Category::with()->where('status',1);  
      $catlist = $sitedctrlr->getquescatbyloc('cats', $defultlang->id);
      $catarr = [];

      foreach ($catlist as $catrow) {
        $clpointmodel = ClientPoint::where('client_id', $client_id)->where('category_id', $catrow['category_id'])->orderByDesc('created_at')->first();
        $newarr['category'] = $catrow;
        if ($clpointmodel) {
          $newarr['level'] = $clpointmodel->level->value;
          $clpointlist = ClientPoint::where('client_id', $client_id)->where('category_id', $catrow['category_id'])->get()->sum(function ($q) {
            return $q->points_sum + $q->gift_sum;
          });
          $newarr['points'] = $clpointlist;
        } else {
          $newarr['level'] = 0;
          $newarr['points'] = 0;
        }
        //add row to list
        $catarr[] = $newarr;
      }
      // return dd($catarr);
      $translate = $sitedctrlr->getbycode($defultlang->id, ['my-score','header','public-score','home_page']);//chang
      return view(
        "site.client.score",
        [
          "cat_score" => $catarr,
          'transarr' => $transarr,
          'lang' => $lang,
          'defultlang' => $defultlang,
          'translate' => $translate,
          'sitedataCtrlr' => $sitedctrlr
        ]
      );
    } else {
      return redirect()->route('login.client');
    }

  }

  public function scores($lang)
  {
    $sitedctrlr = new SiteDataController();
    $transarr = $sitedctrlr->FillTransData($lang);
    $defultlang = $transarr['langs']->first();
    //total all
    $grouplist = ClientPoint::groupBy('client_id', 'category_id')->select(
      'id',
      'category_id',
      'client_id',
    )
      ->addSelect(DB::raw('SUM(points_sum + gift_sum) as cat_sum'))->get();

    //this month list
    $nowmonth = Carbon::now()->format('m');
    // return $nowmonth;
    $monthlist = AnswersClient::whereMonth('created_at', $nowmonth)->groupBy('client_id', 'category_id')->
      select('id', 'category_id', 'client_id')
      ->addSelect(DB::raw('SUM(points) as cat_sum'))->get();
    //   return  $monthlist;
    $catlist = $sitedctrlr->getquescatbyloc('cats', $defultlang->id);
    $catarr = [];

    foreach ($catlist as $catrow) {
      $newarr['category'] = $catrow;
      //total score
      $highrow = $grouplist->where('category_id', $catrow['category_id'])->sortByDesc('cat_sum')->first();
      if ($highrow) {
        $newarr['total_score']['cat_score'] = $highrow['cat_sum'];
        $client = Client::find($highrow['client_id']);
        $clpointmodel = ClientPoint::where('client_id', $client->id)->where('category_id', $catrow['category_id'])->orderByDesc('created_at')->first();

        $newarr['total_score']['level'] = $clpointmodel->level->value;
        $newarr['total_score']['client_name'] = $client->name;
      } else {
        $newarr['total_score']['cat_score'] = 0;
        $newarr['total_score']['client_name'] = "-";
        $newarr['total_score']['level'] = 0;
      }
      //current month score
      $monthrow = $monthlist->where('category_id', $catrow['category_id'])->sortByDesc('cat_sum')->first();
      if ($monthrow) {
        $newarr['month_score']['cat_score'] = $monthrow['cat_sum'];
        $client = Client::find($monthrow['client_id']);
        $clpointmodel = ClientPoint::where('client_id', $client->id)->where('category_id', $catrow['category_id'])->orderByDesc('created_at')->first();

        $newarr['month_score']['level'] = $clpointmodel->level->value;
        $newarr['month_score']['client_name'] = $client->name;
      } else {
        $newarr['month_score']['cat_score'] = 0;
        $newarr['month_score']['client_name'] = "-";
        $newarr['month_score']['level'] = 0;
      }
      $catarr[] = $newarr;
    }
    // return  $catarr;

    //high balance client
    $firstclient = Client::orderByDesc('total_balance')->select('id', 'name', 'image', 'total_balance')->take(3)->get();
    // return dd($catarr);
    $translate = $sitedctrlr->getbycode($defultlang->id, ['footer-menu','public-score','home_page','sort-places']);//chang
    return view(
      "site.content.score",
      [
        "category_score" => $catarr,
        "first_client" => $firstclient,
        'transarr' => $transarr,
        'lang' => $lang,
        'defultlang' => $defultlang,
        'translate' => $translate,
        'sitedataCtrlr' => $sitedctrlr
      ]
    );

  }

   
 
  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClientRequest $request,$lang)
  {
    StoreClientRequest::$lang=$lang;
    $formdata = $request->all();
    // return  $formdata;
    // return redirect()->back()->with('success_message', $formdata);
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );

    if ($validator->fails()) {

      return response()->json($validator);
    } else {


      $id = Auth::guard('client')->user()->id;
      Client::find($id)->update([
        'name' => $formdata['name'],
        // 'desc' => $formdata['desc'],         
        // 'birthdate' => $formdata['birthdate'], 
        'gender' => $formdata['gender'],
        'country' => $formdata['country'],
      ]);
      if ($request->hasFile('image')) {

        $file = $request->file('image');
        // $filename= $file->getClientOriginalName();

        $this->storeImage($file, $id);
        //  $this->storeImage( $file,2);
      }
      //  return redirect()->back();
      return response()->json("ok");
    }
  }
  public function updatepass(UpdatePassRequest $request,$lang)
  {
    StoreClientRequest::$lang=$lang;
    $formdata = $request->all();
    // return  $formdata;
    // return redirect()->back()->with('success_message', $formdata);
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );

    if ($validator->fails()) {
      return response()->json($validator);
    } else {
      $id = Auth::guard('client')->user()->id;
      Client::find($id)->update([

        'password' => bcrypt($formdata['password']),
      ]);
      //  return redirect()->back();
      return response()->json("ok");
    }
  }
  //pull balance
  public function pull(PullRequest $request,$lang)
  {
    StoreClientRequest::$lang=$lang;
    $formdata = $request->all();
    // return  $formdata;
    // return redirect()->back()->with('success_message', $formdata);
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );

    if ($validator->fails()) {
      return response()->json($validator);
    } else {
      if (Auth::guard('client')->check()) {
        $id = Auth::guard('client')->user()->id;
        $setctrl = new SettingController();
        $set_arr = $setctrl->getquessetting();
        $pull_points = $formdata['points'];
        if ($set_arr['minpoints'] > $pull_points) {
          return response()->json("big-value");
        } else {
          //get client
          $clint = Client::find($id);
          $balance_before=$clint->balance;
          $balance_after= $balance_before-$pull_points;
          //add record
          $transObj = new PointTrans();
          $transObj->type = 'p';
          $transObj->points = $pull_points;
          $transObj->process_type = 'pull';
          $transObj->client_id = $id;
          $transObj->pointsrate = $set_arr['pointsrate'];
          $transObj->cash = $this->CalcCash($pull_points, $set_arr['pointsrate']);
          $transObj->balance_before = $balance_before;
          $transObj->balance_after =  $balance_after;
          $transObj->status = 'confirm';
          $transObj->save();  
          //update client balance
         
        //  $clint->balance -= $pull_points;
        $clint->balance =  $balance_after;       
           $clint->save();   
        }
        //  return redirect()->back();
        return response()->json("ok");
      } else {
        return response()->json("deny");
      }
    }
  }

  public function balanceinfo()
  {
    if (Auth::guard('client')->check()) {
      $id = Auth::guard('client')->user()->id;
      $clint = Client::find($id);
      $setctrl = new SettingController();
      $set_arr = $setctrl->getquessetting();
      $resArr=[
        'pointsrate'=>$set_arr['pointsrate'],
        'minpoints'=>$set_arr['minpoints'],
        'balance'=> $clint->balance,
    ];
    }
    return response()->json($resArr);


  }
  public function CalcCash($pull_points, $pointsrate)
  {
    $val = 0;
    if ($pointsrate != 0) {
      $val = $pull_points / $pointsrate;
    }
    return $val;
  }
  /**
   * Remove the specified resource from storage.
   */
  public function destroy()
  {
    if (Auth::guard('client')->check()) {


      $id = Auth::guard('client')->user()->id;
      $item = Client::find($id);
      if (!($item === null)) {
        //delete image
        $oldimagename = $item->image;
        $strgCtrlr = new StorageController();
        $path = $strgCtrlr->path['clients'];
        Storage::delete("public/" . $path . '/' . $oldimagename);

        //delete   MediaPost records
        // ClientSocial::where('client_id',$id)->delete();
        // MessageModel::where('sender_id',$id)->orWhere('recipient_id',$id)->delete();
        AnswersClient::where('client_id', $id)->delete();
        ClientPoint::where('client_id', $id)->delete();
        PointTrans::where('client_id', $id)->delete();
        Client::find($id)->delete();
        Auth::guard('client')->logout();
        return response()->json("ok");
      } else {
        return response()->json("error");
      }
    } else {
      return response()->json("error");
    }
  }
  public function logout(Request $request): RedirectResponse
  {
    //  Auth::guard('web')->logout();
    Auth::guard('client')->logout();
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
  public function storeImage($file, $id)
  {
    $imagemodel = Client::find($id);
    $strgCtrlr = new StorageController();
    $path = $strgCtrlr->path['clients'];
    $oldimage = $imagemodel->image;
    $oldimagename = basename($oldimage);
    $oldimagepath = $path . '/' . $oldimagename;
    //save photo

    if ($file !== null) {
      //  $filename= rand(10000, 99999).".".$file->getClientOriginalExtension();

      $filename = Str::slug($imagemodel->name) . rand(10, 99) . $id . ".webp";
      $manager = new ImageManager(new Driver());
      $image = $manager->read($file);
      $image = $image->toWebp(75);
      if (!File::isDirectory(Storage::url('/' . $path))) {
        Storage::makeDirectory('public/' . $path);
      }
      $image->save(storage_path('app/public') . '/' . $path . '/' . $filename);
      //   $url = url('storage/app/public' . '/' . $path . '/' . $filename);
      Client::find($id)->update([
        "image" => $filename
      ]);
      Storage::delete("public/" . $path . '/' . $oldimagename);
    }
    return 1;
  }
}
