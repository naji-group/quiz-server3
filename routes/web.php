<?php
 
use App\Http\Controllers\Web\QuestionController;
use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\LanguageController;
  
use App\Http\Controllers\Web\MediaStoreController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\LocationController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\LangPostController;
use  App\Http\Controllers\Web\MediaPostController;
use  App\Http\Controllers\Web\MailController;
use  App\Http\Controllers\Web\ClientController;
//use  App\Http\Controllers\Web\ClientAuthController;
use  App\Http\Controllers\Web\MessageController;
use  App\Http\Controllers\Web\SocialController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Web\CategoryQuesController;
use App\Http\Controllers\Web\LevelController;
 use App\Http\Controllers\Web\TranslateController;

//site
use App\Http\Controllers\HomeController;
//use Illuminate\Support\Facades\Facade\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 //defaultlang
    
    
 Route::get('/error500', [HomeController::class, 'error500'])->name('error500');
//  Route::prefix('{lang}')->group(function () {
   
//     });
   // Route::get('/about', [HomeController::class, 'about']);
    Route::get('/', [HomeController::class, 'index'])->name('site.home');
    //selected lang
  
        // Route::get('/about', [HomeController::class, 'about']);

    

Route::get('/clear', function() {
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('optimize');
     
      return 'ok';
 });
 Route::get('/storagelink', function() {
    $exitCode = Artisan::call('storage:link');
      return 'ok';
 });
 Route::get('/cashclear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
   
      return 'ok';
 });
//  Route::get('/{lang}/page/{id?}', function($lang,$id=null) {
//   //  $exitCode = Artisan::call('route:cache');
//       return 'ok'.$lang.'id='.$id;
//  });


//Route::get('/', [AuthenticatedSessionController::class, 'create']);
/*
Route::get('/dashboard', function () {
   return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/

Route::middleware(['auth:web', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    
    Route::middleware('role.admin:admin')->group(function () {
                Route::resource('user', UserController::class, ['except' => ['update']]);
        Route::prefix('user')->group(function () {
            Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/editprofile/{id}', [UserController::class, 'editprofile'])->name('user.editprofile');
            Route::post('/updateprofile/{id}', [UserController::class, 'updateprofile'])->name('user.updateprofile');
    
        });
       ////////////////social///////////////////////

       Route::resource('social', SocialController::class, ['except' => ['update']]);
       Route::prefix('social')->group(function () {
           Route::post('/update/{id}', [SocialController::class, 'update'])->name('social.update');
          
       });
       /////////////////////////////////////////
        Route::resource('language', LanguageController::class, ['except' => ['update']]);
        Route::prefix('language')->group(function () {
            Route::post('/update/{id}', [LanguageController::class, 'update'])->name('language.update');
            
        });   
        Route::prefix('mediastore')->group(function () {
            Route::get('/getbyid/{id}', [MediaStoreController::class, 'getbyid']);
            Route::delete('/destroyimage/{id}', [MediaStoreController::class, 'destroyimage']);
          //  Route::get('/getgallery/{id}', [MediaStoreController::class, 'getgallery']);
          //  Route::get('/getvideo/{id}', [MediaStoreController::class, 'getvideo']);
           
            //category post
            Route::get('/getcatgallery/{id}', [MediaStoreController::class, 'getcatgallery']);
            Route::get('/getcatvideo/{id}', [MediaStoreController::class, 'getcatvideo']);
            Route::get('/getpostgallery/{id}', [MediaStoreController::class, 'getpostgallery']);
            Route::get('/getpostvideo/{id}', [MediaStoreController::class, 'getpostvideo']);
            Route::get('/getcatpdf/{id}', [MediaStoreController::class, 'getcatpdf']);
        });

        Route::prefix('setting')->group(function () {
           
            Route::post('/updatetitle', [SettingController::class, 'updatetitle']);
            Route::post('/updatefav', [SettingController::class, 'updatefav']);
            Route::post('/updatelogo', [SettingController::class, 'updatelogo']);
            Route::post('/updatewhats', [SettingController::class, 'updatewhats']);
            Route::post('/updatelocation', [SettingController::class, 'updatelocation']);
            Route::post('/updatecontactemail', [SettingController::class, 'updatecontactemail']);
            //social
            Route::get('/getsocial', [SettingController::class, 'getsocial'])->name('setting.getsocial');
            Route::get('/createsocial', [SettingController::class, 'createsocial']);
            Route::post('/storesocial', [SettingController::class, 'storesocial']);
            Route::get('/editsocial/{id}', [SettingController::class, 'editsocial']);
          //  Route::post('/updatesocial/{id}', [SettingController::class, 'updatesocial']);
            Route::delete('/delsocial/{id}', [SettingController::class, 'delsocial']);
            //header contact
  
            Route::post('/updatephone', [SettingController::class, 'updatephone']);
            Route::post('/updateemail', [SettingController::class, 'updateemail']);
            Route::get('/translate', [TranslateController::class, 'translate']);
///////////////////////// saraha
            Route::get('/general', [SettingController::class, 'index']);
                  //////////////siteinfo
            Route::get('/siteinfo', [SettingController::class, 'getbasic']);
          //  Route::get('/editinfo', [SettingController::class, 'editinfo']);
            Route::post('/updateinfo/{id}', [SettingController::class, 'updateinfo']);
            //////////////header
            Route::get('/head', [SettingController::class, 'getheadinfo']);
            Route::get('/createhead', [SettingController::class, 'createhead']);
            Route::post('/storehead', [SettingController::class, 'storehead']);
       
           Route::post('/updatehead/{id}', [SettingController::class, 'updatehead']);
            Route::delete('/delhead/{id}', [SettingController::class, 'destroy']);
      //////////////footer
            Route::get('/footer', [SettingController::class, 'footerinfo']);
            Route::get('/createfooter', [SettingController::class, 'createfooter']);
            Route::post('/storefooter', [SettingController::class, 'storefooter']);         
         Route::post('/updatefooter/{id}', [SettingController::class, 'updatefooter']);
            Route::delete('/delfooter/{id}', [SettingController::class, 'delfooter']);
            //question
            //
            Route::get('/question', [SettingController::class, 'quessetting']);
            Route::post('/question/{id}', [SettingController::class, 'quesupdate']);
        });
//questions
//category
Route::resource('categoryques', CategoryQuesController::class, ['except' => ['update']]);
Route::prefix('categoryques')->group(function () {
    Route::post('/update/{id}', [CategoryQuesController::class, 'update'])->name('categoryques.update');
    Route::get('/sort/{loc}', [LocationController::class, 'sortpage']);
   
    
});   
//Level
Route::resource('level', LevelController::class, ['except' => ['update']]);
Route::prefix('level')->group(function () {
    Route::post('/update/{id}', [LevelController::class, 'update'])->name('level.update');
    
});
//questions route
Route::resource('question', QuestionController::class, ['except' => ['update']]);
Route::prefix('question')->group(function () {
    Route::post('/update/{id}', [QuestionController::class, 'update'])->name('question.update');
    
}); 


        // Route::prefix('design')->group(function () {
        //     Route::get('/headsocial', [LocationController::class, 'getheadsocial'])->name('design.headsocial');
        //     Route::get('/footersocial', [LocationController::class, 'footersocial'])->name('design.footersocial');
            
        //     Route::post('/addheadsocial', [LocationController::class, 'addheadsocial']);
        //     Route::delete('/delheadsocial/{id}', [LocationController::class, 'delheadsocial']);

        //     Route::post('/addfootsocial', [LocationController::class, 'addfootsocial']);
        //     Route::delete('/delfootsocial/{id}', [LocationController::class, 'delfootsocial']);

        //     Route::get('/getsortpage/{loc}', [LocationController::class, 'headsocialsort']);
        //     Route::get('/hsocialsavesort', [LocationController::class, 'headsocialsavesort']);
        //     Route::get('/getsort/{loc}', [LocationController::class, 'hsocialsort']);
        //     Route::post('/updatesort', [LocationController::class, 'updatesort']);
        //     //footer section
        //     Route::get('/sections/{name}', [LocationController::class, 'getsectionsbyname'])->name('design.sections');
        //     Route::get('/editfooter/{id}', [PostController::class, 'editfooter']);
        //     //main menu sec
        //     Route::get('/editmenu/{id}', [CategoryController::class, 'editmenu']);
        //     //submenu  
        //     Route::get('/categorysub/{id}', [CategoryController::class, 'getcatbyparent']);
      
        // });


       // Route::resource('post', PostController::class, ['except' => ['update']]);
       //footer
        Route::prefix('post')->group(function () {
            Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
            Route::post('/updatefooter/{id}', [PostController::class, 'updatefooter'])->name('post.updatefooter');
            Route::get('/showbycatid/{id}', [PostController::class, 'showbycatid']);
            Route::get('/createbycatid/{id}', [PostController::class, 'createwithcatid']);
            Route::post('/storepost', [PostController::class, 'storepost']);
            Route::post('/updatepost/{id}', [PostController::class, 'updatepost']);
            Route::delete('/destroy/{id}', [PostController::class, 'destroy']);
            Route::get('/editpost/{id}', [PostController::class, 'editpost']);
            Route::post('/upload', [PostController::class, 'uploadLargeFiles'])->name('post.upload');;
         
        });  
        Route::prefix('langpost')->group(function () {
            Route::post('/update/{id}', [LangPostController::class,'update'])->name('langpost.update');
            Route::post('/updatecategory/{id}', [LangPostController::class,'updatelangcategory'])->name('langcategory.update');
            
        });

//category menu
Route::prefix('category')->group(function () {
  //  Route::post('/update/{id}', [CategoryController::class, 'update'])->name('post.update');
    Route::post('/updatemenu/{id}', [CategoryController::class, 'updatemenu'])->name('category.updatemenu');

  
    
}); 
Route::prefix('page')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
      //////////////header
      Route::get('/create', [CategoryController::class, 'create']);
      Route::post('/store', [CategoryController::class, 'store']);
      Route::get('/edit/{id}', [CategoryController::class, 'edit']);
 
     Route::post('/update/{id}', [CategoryController::class, 'update']);
      Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
      //sort
      Route::get('/sort', [LocationController::class, 'showtable']);
      Route::get('/sort/{loc}', [LocationController::class, 'sortpage']);
      Route::get('/fillcombo/{loc}', [LocationController::class, 'getpagesforcombo']);
      Route::get('/fillsort/{loc}', [LocationController::class, 'fillsortpages']);
      Route::post('/updatesort/{loc}', [LocationController::class, 'updatepagesort']);
      
}); 

Route::prefix('mediapost')->group(function () {
    Route::post('/store/{id}', [MediaPostController::class, 'storeimages'])->name('mediapost.store');
    Route::post('/update/{id}', [MediaPostController::class, 'update'])->name('mediapost.update');
    Route::post('/storevideo/{id}', [MediaPostController::class, 'storevideo'])->name('mediapost.storevideo');
    Route::post('/updatevideo/{id}', [MediaPostController::class, 'updatevideo'])->name('mediapost.updatevideo');

    
});

    });

     
////////////////////////////////////////////////////////////////////
    Route::middleware('role.admin:admin-super')->group(function () {

       
      
    });

    /*
    Route::middleware('role.admin:super')->group(function () {

        // expert
   Route::prefix('/expert')->group(function () {
       Route::get('', [ExpertController::class, 'index'])->name('admin.expert.show');

   });

   });
*/
//question admin
Route::prefix('translate')->group(function () {
   // Route::post('/update/{id}', [TranslateController::class, 'update'])->name('post.update');
    
    Route::get('/showbycatid/{id}', [TranslateController::class, 'showbycatid']);
    Route::get('/create', [TranslateController::class, 'createwithcatid']);
    Route::post('/store', [TranslateController::class, 'storepost']);
    Route::post('/update/{id}', [TranslateController::class, 'updatepost']);
    Route::delete('/destroy/{id}', [TranslateController::class, 'destroy']);
    Route::get('/edit/{id}', [TranslateController::class, 'editpost']);
   // Route::post('/upload', [TranslateController::class, 'uploadLargeFiles'])->name('post.upload');;
 
}); 


});

/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
//Route::middleware(['localemiddle'])->
// Route::prefix('lang/{lang}')->group(function () {
//     Route::get('/', [HomeController::class, 'index']);
//    // Route::get('/about', [HomeController::class, 'about']);
//     Route::get('/page/{slug}', [HomeController::class, 'getcontent']);
//     Route::get('/page/{slug}/{postslug}', [HomeController::class, 'getpostcontent']);
// });

//site
// Route::prefix('u')->group(function () {
//     Route::get('/{slug}', [ClientController::class, 'send_message']);
//     Route::middleware('guest:client')->group(function () {
//         Route::get('/register', [ClientController::class, 'create'])->name('register.client');
//         Route::post('/register', [ClientController::class, 'store']);
    
//         Route::get('/login', [ClientController::class, 'showlogin'])->name('login.client');
//         Route::post('/login', [ClientController::class, 'login']);
//         Route::get('auth/redirect', [SocialiteController::class, 'loginSocial'])
//         ->name('socialite.auth');
 
//     Route::get('auth/callback', [SocialiteController::class, 'callbackSocial'])
//         ->name('socialite.callback');
//        // 

//     });

//     Route::post('/sendmessage', [MessageController::class, 'store']);
//    //Route::post('/login', [ClientController::class, 'login']);
 

  
//     Route::  middleware(['auth:client', 'verified'])->group(function () {
//       //  Route::get('/{slug}', [ClientController::class, 'send_message']);
//          Route::get('/messages', [MessageController::class, 'index'])->name('mymessages');
//          Route::post('/messages', [ClientController::class, 'logout'])->name('logout.client');
//          Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('message.delete');;
//          Route::get('/account', [ClientController::class, 'edit'])->name('client.account');
//          Route::post('/update', [ClientController::class, 'update'])->name('client.update');
         
//          Route::post('/delete', [ClientController::class, 'destroy']) ;
//          Route::post('/updatepass', [ClientController::class, 'updatepass'])->name('client.updatepass');
//          Route::post('/updatesocial', [ClientController::class, 'updatesocial'])->name('client.updatesocial');
       
//     });
// });


 Route::get('/page/{slug}', [HomeController::class, 'showpage']);
// Route::post('/sendmail', [MailController::class, 'store']);

//question client

//site
Route::get('{lang}/categories', [HomeController::class, 'getcategories']);
Route::prefix('{lang}')->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    //Route::get('/{slug}', [ClientController::class, 'send_message']);
    Route::middleware('guest:client')->group(function () {
        Route::get('/register', [ClientController::class, 'create'])->name('register.client');
        Route::post('/register', [ClientController::class, 'store']);
    
        Route::get('/login', [ClientController::class, 'showlogin'])->name('login.client');
        Route::post('/login', [ClientController::class, 'login']);
    
       // 

    });
});
Route::  middleware(['auth:client', 'verified'])->group(function () {
    Route::post('u/logout', [ClientController::class, 'logout'])->name('logout.client');

    Route::prefix('{lang}')->group(function () {
    Route::get('/account', [ClientController::class, 'edit'])->name('client.account');
   Route::get('/quiz/{slug}', [HomeController::class, 'getcategory']);
   Route::post('/send', [QuestionController::class, 'sendquiz']);
   Route::post('/checkans', [QuestionController::class, 'checkanswer']);
});
});
require __DIR__ . '/auth.php';
