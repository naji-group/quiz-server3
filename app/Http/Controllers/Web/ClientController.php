<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AnswersClient;
use App\Models\ClientPoint;
use App\Models\PointTrans;
use App\Models\SocialModel;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientSocial;
use App\Models\MessageModel;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdatePassRequest;
use App\Http\Requests\Client\UpdateClientRequest;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($lang)
    {
      $sitedctrlr=new SiteDataController(); 
      $transarr=$sitedctrlr->FillTransData($lang);
      $defultlang=$transarr['langs']->first();
      
      $register=$sitedctrlr->getbycode($defultlang->id,['register']);

        return view('site.client.register',['transarr'=>$transarr,'lang'=>$lang,'defultlang'=>$defultlang 
       ,'register'=>$register,'sitedataCtrlr'=>$sitedctrlr]);
    }
    public function showlogin($lang)
    {
      $sitedctrlr=new SiteDataController(); 
      $transarr=$sitedctrlr->FillTransData($lang);
      $defultlang=$transarr['langs']->first();

      $login=$sitedctrlr->getbycode($defultlang->id,['login']);

        return view('site.client.login',['transarr'=>$transarr,'lang'=>$lang,'defultlang'=>$defultlang 
        ,'login'=>$login,'sitedataCtrlr'=>$sitedctrlr]);
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
    public function store(StoreClientRequest $request,$lang)//StoreClientRequest
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
 
        return response()->json($validator);               
    //return redirect()->with('errors',$validator)->json();
    //   return response()->json($validator);
      //  return redirect()
      //  ->back()
      //  ->withErrors($validator)
      //  ->withInput();
  
      } else {
 
    //  $lang= $formdata["lang"];
    $sitedctrlr=new  SiteDataController();
    $transarr=$sitedctrlr->FillTransData($lang);
    $defultlang=$transarr['langs']->first(); 
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
        $newObj->lang_id= $defultlang->id;
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($lang)
    {
        if(Auth::guard('client')->check()){
$id=Auth::guard('client')->user()->id;
$client=Client::find($id);
$client->birthdateStr= (string)Carbon::create($client->birthdate)->format('Y-m-d');
 //return response()->json($this->getsocial($id));  
  $sitedctrlr=new SiteDataController(); 
      $transarr=$sitedctrlr->FillTransData($lang);

      $defultlang=$transarr['langs']->first();
      $profile=$sitedctrlr->getbycode($defultlang->id,['profile','register']);
return view("site.client.edit", ["client" => $client,'transarr'=>$transarr,'lang'=>$lang,'defultlang'=>$defultlang
,'profile'=>$profile,'sitedataCtrlr'=>$sitedctrlr]);
   
        }else{
               return redirect()->route('login.client');
             }
       
    }

//     public function send_message($slug)
//     {
//       //  if(Auth::guard('client')->check()){
//         if($slug=='account'){
//       // return redirect()->route('client.account');
//     //   return($slug);
//       return $this->edit();
//         }else if($slug=='login'){
//      return $this->showlogin();
//         }else if($slug=='register'){
//           return $this->create();
          
//           // return redirect()->route('register.client');
//         }else if($slug=='messages'){
//         $msgctrlr=new   MessageController();

//           return  $msgctrlr->index();
          
//           // return redirect()->route('register.client');
//         }else{
//           $client=Client::where('user_name',$slug)->first();
//           if($client){
//             $client_url=$this->getclient_url($client->user_name);
//             return view("site.client.sendmessage", ["client" => $client,"client_url" =>$client_url]);
           
//         }
 
//  // return redirect()->route('site.home');
// }
// //$client->birthdateStr= (string)Carbon::create($client->birthdate)->format('Y-m-d');
//  //return response()->json($this->getsocial($id));
 

 

   
//         // }else{
//         //   //not login 
//         //        return redirect()->back();
//         //      }
       
//     }
    public function getclient_url($slug)
    {
    
        /* Get Base URL using URL Facade */      
   $url = URL::to("/");  
   $url=$url.'/u'.'/'.$slug;
   /* Get Base URL using url() helper */
  //  $url2 = url('/');
  $href = preg_replace("(^https?://)", "", $url );
  $arr=[
   'href_client'=>$href,
   'link_client'=>$url,
  ];
      return $arr;
    }
    public function getsocial($client_id)
    {
      $social_list=SocialModel::where('is_active',1)->with([
      'clientsocials' => function ($q) use ($client_id) {
         $q->where('client_id', $client_id) ;
     }])->get();
       
 
      return $social_list; 
    }

    public function updatesocial(Request $request )
    {
        $formdata = $request->all();
       // return  $formdata ;
        // return  $formdata;
         // return redirect()->back()->with('success_message', $formdata);
      //    $validator = Validator::make(
      //      $formdata,
      //      $request->rules(),
      //      $request->messages()
      //    ) ;
        
      //    if ($validator->fails()) {  
                                 
      //  //return redirect()->with('errors',$validator)->json();
      //   return response()->json($validator);
     
      //     // return redirect() 
      //     // ->back()
      //     // ->withErrors($validator,'infoform' )
          
      //     // ->withInput();
     
      //    } else 
      {    
       
         
           $id=Auth::guard('client')->user()->id;
            
           foreach($formdata['social'] as $key => $val){
$res = ClientSocial::updateOrCreate(
  ['client_id' =>  $id, 'social_id' => $key],
  ['link' => $val,'is_active' =>1]
);
           }

 
  //          Client::find($id)->update([    
  //   'name' => $formdata['name'],  
  //   'desc' => $formdata['desc'],         
  //   'birthdate' => $formdata['birthdate'], 
  //   'gender' => $formdata['gender'], 
  //   'country' => $formdata['country'], 
  // ]); 
  // if ($request->hasFile('image')) {
  
  //   $file = $request->file('image');
  //   // $filename= $file->getClientOriginalName();

  //   $this->storeImage($file, $id);
  //   //  $this->storeImage( $file,2);
  // }        
         //  return redirect()->back();
            return response()->json("ok");
         }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request )
    {
        $formdata = $request->all();
        // return  $formdata;
         // return redirect()->back()->with('success_message', $formdata);
         $validator = Validator::make(
           $formdata,
           $request->rules(),
           $request->messages()
         ) ;
        
         if ($validator->fails()) {  
   
        return response()->json($validator); 
           } else {    
       
         
           $id=Auth::guard('client')->user()->id;
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
    public function updatepass(UpdatePassRequest $request )
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
          return response()->json($validator);      
         } else {    
           $id=Auth::guard('client')->user()->id;
           Client::find($id)->update([
    
    'password' => bcrypt($formdata['password']),      
  ]);         
         //  return redirect()->back();
          return response()->json("ok");
         }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( )
    {
        if(Auth::guard('client')->check()){

     
        $id=Auth::guard('client')->user()->id;
        $item = Client::find($id);
      if (!( $item  === null)) {
        //delete image
        $oldimagename =$item->image;
        $strgCtrlr = new StorageController();
        $path = $strgCtrlr->path['clients'];
        Storage::delete("public/" .$path. '/' . $oldimagename);    

        //delete   MediaPost records
       // ClientSocial::where('client_id',$id)->delete();
       // MessageModel::where('sender_id',$id)->orWhere('recipient_id',$id)->delete();
       AnswersClient::where('client_id',$id)->delete();
        ClientPoint::where('client_id',$id)->delete();
         PointTrans::where('client_id',$id)->delete();
        Client::find($id)->delete();
        Auth::guard('client')->logout();
        return response()->json("ok");
      }else{
        return response()->json("error");
      }
    }else{
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
        
        $filename = Str::slug($imagemodel->name). rand(10, 99) . $id . ".webp";
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image = $image->toWebp(75);
        if (!File::isDirectory(Storage::url('/' .$path))) {
          Storage::makeDirectory('public/' . $path);
        }
        $image->save(storage_path('app/public') . '/' . $path . '/' . $filename);
        //   $url = url('storage/app/public' . '/' . $path . '/' . $filename);
        Client::find($id)->update([
          "image" => $filename
        ]);
        Storage::delete("public/" .$path . '/' . $oldimagename);
      }
      return 1;
    }
}
