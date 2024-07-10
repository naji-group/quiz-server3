<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Routing\Router;
use App\Models\User;
use Illuminate\Support\Facades\DB;
//use Image;

use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\User\StoreUserRequest;
use App\Http\Requests\Web\User\UpdateUserRequest;
use App\Http\Requests\Web\User\UpdateUserProfileRequest;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
 // public $path = 'images/users';
  /**
   * Display a listing of the resource.
   */
  public function index()
  {


    $users = User::get();
    return view('admin.user.show', ['users' => $users]);
    //return response()->json($users);

  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.user.create');

  }
  /*
      public function check()
      {
        if(  Auth::check())
        $res="yes";
      $user= Auth::user()->role;
          return    $res;
      }
  */
  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreUserRequest $request)//StoreUserRequest
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
      $newObj = new User;
      $newObj->name = $formdata['name'];
      // $newObj->first_name = $formdata['first_name'];
      // $newObj->last_name = $formdata['last_name'];
      $newObj->email = $formdata['email'];
      $newObj->password = bcrypt($formdata['password']);
      // $newObj->mobile = $formdata['mobile'];
      $newObj->role = 'admin';
      //   $newObj->is_active = $formdata['is_active'];
      $newObj->createuser_id = Auth::user()->id;
      $newObj->updateuser_id = Auth::user()->id;
      // $newObj->is_active = isset ($formdata["is_active"]) ? 1 : 0;
      $newObj->is_active =1;
      $newObj->save();

      // if ($request->hasFile('image')) {

      //   $file = $request->file('image');
      //   // $filename= $file->getClientOriginalName();

      //   $this->storeImage($file, $newObj->id);
      //   //  $this->storeImage( $file,2);
      // }
      return redirect()->route('user.index')->with('success', 'تم إضافة المدير بنجاح');
      //return response()->json("ok");
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

    
    $user = User::find($id);
    
 
    return view('admin.user.edit', ['user' => $user]);
  }

  public function update(UpdateUserRequest $request, $id)
  {
    //  return $request->all();
    // UpdateUserRequest

    //validate

    $formdata = $request->all();
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );
    if ($validator->fails()) {

      return response()->json($validator);

    } else {
      if ($request->hasFile('image')) {
        $file = $request->file('image');
        // $filename= $file->getClientOriginalName();                
        $this->storeImage($file, $id);
      }
      User::find($id)->update([
        //'user_name'=>$formdata['user_name'],
      //  'name' => $formdata['name'],
     //   'first_name' => $formdata['first_name'],
      //  'last_name' => $formdata['last_name'],
        'email' => $formdata['email'],

        //'password' => bcrypt($formdata['password']),
      //  'mobile' => $formdata['mobile'],
    //    'role' => $formdata['role'],
        'updateuser_id' => Auth::user()->id,
     //   'is_active' => isset ($formdata["is_active"]) ? 1 : 0,
      ]);

      if (isset ($formdata['password'])) {
        $password = trim($formdata['password']);
        User::find($id)->update([
          'password' => bcrypt($password),
        ]);
      }
      //    return redirect()->back()->with('success_message','user has been Updated!');
     // return response()->json("ok");
      return redirect()->route('user.index')->with('success', 'تم تعديل معلومات المدير بنجاح');
    }


  }

  public function editprofile($id)
  {
    $authuser = auth()->user();
    if (!($authuser->id == $id)) {

      return redirect()->route('admin');
    } else {
      $user = User::find($id);
      /*
      $url = url(Storage::url($this->path)) . '/';
     
      if ($user->image != "") {
        $user->fullpathimg = $url . $user->image;
      }
*/
      return view('admin.user.editprofile', ['user' => $user]);
    }

  }

  public function updateprofile(UpdateUserProfileRequest $request, $id)
  {
    //  return $request->all();
    // UpdateUserRequest

    //validate

    $formdata = $request->all();
    $validator = Validator::make(
      $formdata,
      $request->rules(),
      $request->messages()
    );
    if ($validator->fails()) {

      return response()->json($validator);

    } else {

      $authuser = auth()->user();
      if (!($authuser->id == $id)) {
         // error
        return response()->json([
          "errors" =>  ["name" => [__('messages.Not allowed')]]          
        ], 422);      
     
      } else {
        if ($request->hasFile('image')) {
          $file = $request->file('image');
          // $filename= $file->getClientOriginalName();                
          $this->storeImage($file, $id);
        }
        User::find($id)->update([
          //'user_name'=>$formdata['user_name'],
          'name' => $formdata['name'],
          'first_name' => $formdata['first_name'],
          'last_name' => $formdata['last_name'],
          'email' => $formdata['email'],

          //'password' => bcrypt($formdata['password']),
          'mobile' => $formdata['mobile'],
        //  'role' => $formdata['role'],
          'updateuser_id' => Auth::user()->id,
         // 'is_active' => isset ($formdata["is_active"]) ? 1 : 0,
        ]);

        if (isset ($formdata['password'])) {
          $password = trim($formdata['password']);
          User::find($id)->update([
            'password' => bcrypt($password),
          ]);
        }
        //    return redirect()->back()->with('success_message','user has been Updated!');
        return response()->json("ok");
      }


    }


  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $count = User::count();
    if($count>1){
//delete foriegn key
User::where('createuser_id', $id)->update([
  'createuser_id' => null,

]);
User::where('updateuser_id', $id)->update([
  'updateuser_id' => null,
]);
//delete user
$user = User::find($id);
$oldimagename = $user->image;
$strgCtrlr = new StorageController();
$path = $strgCtrlr->path['users'];
Storage::delete("public/" .$path. '/' . $oldimagename);
if (!($user === null)) {
  User::find($id)->delete();
}

    } 
    return redirect()->route('user.index');

  }

  public function storeImage($file, $id)
  {
    $imagemodel = User::find($id);
    $strgCtrlr = new StorageController();
    $path = $strgCtrlr->path['users'];
    $oldimage = $imagemodel->image;
    $oldimagename = basename($oldimage);
    $oldimagepath = $path . '/' . $oldimagename;
    //save photo

    if ($file !== null) {
      //  $filename= rand(10000, 99999).".".$file->getClientOriginalExtension();
      $filename = rand(10000, 99999) . $id . ".webp";
      $manager = new ImageManager(new Driver());
      $image = $manager->read($file);
      $image = $image->toWebp(75);
      if (!File::isDirectory(Storage::url('/' .$path))) {
        Storage::makeDirectory('public/' . $path);
      }
      $image->save(storage_path('app/public') . '/' . $path . '/' . $filename);
      //   $url = url('storage/app/public' . '/' . $path . '/' . $filename);
      User::find($id)->update([
        "image" => $filename
      ]);
      Storage::delete("public/" .$path . '/' . $oldimagename);
    }
    return 1;
  }
}
