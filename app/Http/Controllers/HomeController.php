<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\SiteDataController;
use App\Models\Language;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     // $this->middleware('auth');
    }
    public function error500()
    {
        return view('500');
    }
    /**
     * Display a listing of the resource.
     *
     * @return 'Illuminate\View\View'
     */
    public function index(Request $request, $lang=null)
    {

      // if($lang=='admin'){
      //    return redirect()->route('admin');  
      // }else if($lang=='login'){
      //    return redirect()->route('login');  
      // }
      $formdata=$request->all();
     
      $sitedctrlr=new SiteDataController();
   // $slidedata=  $sitedctrlr->getSlideData('home');
    $transarr=$sitedctrlr->FillTransData($lang);
  //  $transarr['langs']->select('code')->get();
 //   return  $sitedctrlr->getlangscod()  ;
    //
    
     
   if(isset($formdata['lang']))
   {
      $lang=$formdata['lang'];
   } 
   $active='home';
     if(isset($lang)){
    //  $lang= $formdata["lang"];
    $transarr=$sitedctrlr->FillTransData($lang);
    $defultlang=$transarr['langs']->first();
    $home_page=$sitedctrlr->getbycode($defultlang->id,['home_page']);
   // $homearr= $sitedctrlr->gethomedata( $defultlang->id);
   $catlist= $sitedctrlr-> getquescatbyloc('cats',$defultlang->id);
      return view('site.home',['lang'=>$lang, 'transarr'=>$transarr,'defultlang'=>$defultlang, 'active_item'=>$active,'categories'=>$catlist,
      'home_page'=>$home_page,'sitedataCtrlr'=>$sitedctrlr,
   ]);
     }else{
      $transarr=$sitedctrlr->FillTransData();
      $defultlang=$transarr['langs']->first();
      $lang=  $defultlang->code;
      $catlist= $sitedctrlr-> getquescatbyloc('cats',$defultlang->id);
       $home_page=$sitedctrlr->getbycode($defultlang->id,['home_page']);
      //$homearr= $sitedctrlr->gethomedata( $defultlang->id);
      return view('site.home',['transarr'=>$transarr,'lang'=>$lang, 'defultlang'=>$defultlang,'active_item'=>$active,'categories'=>$catlist,
      'home_page'=>$home_page,'sitedataCtrlr'=>$sitedctrlr,
   ]);
     }
      
    }
    public function about( $lang=null)
    {
     //  $formdata=$request->all();
     
        $sitedctrlr=new SiteDataController();
      $slidedata=  $sitedctrlr->getSlideData('home');
      if(isset($lang)){
   //    if(isset($formdata["lang"])){
        //$lang= $formdata["lang"];
        $transarr=$sitedctrlr->FillTransData( $lang);
        $defultlang=$transarr['langs']->first();
        return view('site.company.about',['slidedata'=> $slidedata,'lang'=>$lang,'transarr'=>$transarr,'defultlang'=>$defultlang]);
       }else{
        $transarr=$sitedctrlr->FillTransData();
        $defultlang=$transarr['langs']->first();
        return view('site.company.about',['slidedata'=> $slidedata,'transarr'=>$transarr,'defultlang'=>$defultlang]);
       }
      
    }
    public function getcontent( $lang,$slug)
    {
     //  $formdata=$request->all();
     $sitedctrlr=new SiteDataController();    
     $langitem = Language::where('status',1)->where('code', $lang)->first();
     $catmodel= Category::where('slug',$slug)->select('id','code')->first();
     $current_path=$sitedctrlr->getpath($lang,$slug); 
if($catmodel->code=='projects'){
   
   $cat= $sitedctrlr->getcatwithposts( $langitem->id,$slug);
   $translateArr=   $sitedctrlr->gettranscat( $langitem->id);
  
   $more_post=$translateArr['posts']->where('code','more')->first();
   $more="";
   if($more_post){
$more=$more_post['tr_title'];
   }
   return view('site.content.project',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path,'tr_more'=>$more,'active_item'=>$cat['code']]);  
}else if($catmodel->code=='products'){
   
   $cat= $sitedctrlr->getcatwithposts( $langitem->id,$slug);
   $translateArr=   $sitedctrlr->gettranscat( $langitem->id); return view('site.content.products',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path,'active_item'=>$cat['code']]);  
}
else if($catmodel->code=='contacts'){
 
   $cat= $sitedctrlr->getcontactinfo( $langitem->id,$slug);

   return view('site.content.contact',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path,'active_item'=>$cat['code']]);  
}
else if($catmodel->code=='services'){
   
   $cat= $sitedctrlr->getcatwithposts( $langitem->id,$slug);
 //  $translateArr=   $sitedctrlr->gettranscat( $langitem->id);
      return view('site.content.service',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path,'active_item'=>$cat['code']]);  
}
else{
  
   $cat= $sitedctrlr->getcatinfo( $langitem->id,$slug);
    $active=$cat['parent_code'];
        return view('site.content.about',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path,'active_item'=> $active]);  
}
     
      
    }
    public function getcategories($lang)
    {
     //  $formdata=$request->all();
     $sitedctrlr=new SiteDataController();   

    // $langitem = Language::where('status',1)->where('code', $lang)->first();
     $transarr=$sitedctrlr->FillTransData($lang);
     $defultlang=$transarr['langs']->first();
   //  $current_path=$sitedctrlr->getpath($lang,"categories"); 
   $home_page=$sitedctrlr->getbycode($defultlang->id,['home_page','footer-menu']);
     $catlist= $sitedctrlr-> getquescatbyloc('cats',$defultlang->id);
  // $cat= $sitedctrlr->getcatwithposts( $langitem->id,$slug);
   //$translateArr=   $sitedctrlr->gettranscat( $defultlang->id);
 
   //$more_post=$translateArr['posts']->where('code','more')->first();
   
//    if($more_post){
// $more=$more_post['tr_title'];
//    }
   return view('site.content.categories',['categories'=>$catlist,'transarr'=>$transarr,'lang'=>$lang,'defultlang'=>$defultlang
   ,'home_page'=>$home_page ,'sitedataCtrlr'=>$sitedctrlr,]);   
    }


    public function getcategory($lang,$slug)
    {
     //  $formdata=$request->all();
     $sitedctrlr=new SiteDataController();   

    // $langitem = Language::where('status',1)->where('code', $lang)->first();
     $transarr=$sitedctrlr->FillTransData($lang);
     $defultlang=$transarr['langs']->first();

     $quiz=$sitedctrlr->getbycode($defultlang->id,['quiz']);


   //  $current_path=$sitedctrlr->getpath($lang,"categories"); 
  
     $cat= $sitedctrlr->getcategory($slug,$defultlang->id);
  // $cat= $sitedctrlr->getcatwithposts( $langitem->id,$slug);
   //$translateArr=   $sitedctrlr->gettranscat( $defultlang->id);
 
   //$more_post=$translateArr['posts']->where('code','more')->first();
   
//    if($more_post){
// $more=$more_post['tr_title'];
//    }
   return view('site.content.category',['catquis'=>$cat,'transarr'=>$transarr,'lang'=>$lang,'defultlang'=>$defultlang 
   ,'quiz'=>$quiz,'sitedataCtrlr'=>$sitedctrlr]);   
    }


    public function showpage($lang, $slug)
    {
 

      $sitedctrlr=new SiteDataController();  
            // $langitem = Language::where('status',1)->where('code', $lang)->first();
       $transarr=$sitedctrlr->FillTransData($lang);
       $defultlang=$transarr['langs']->first();    
       $cat= $sitedctrlr->getcategory($slug,$defultlang->id);
       
       if($cat && $cat['code']=='page' && $cat['id']>0){
         return view('site.page.show',['page'=>$cat,'transarr'=>$transarr,'lang'=>$lang,'defultlang'=>$defultlang 
         ,'sitedataCtrlr'=>$sitedctrlr]); 
       }else{
         abort(404, '');
       }
            //  $catmodel= Category::where('slug',$slug)->where('code','page')->where('status',1)->first();
         }


    public function getpostcontent( $lang,$slug,$postslug)
    {
    //  return $postslug;
     //  $formdata=$request->all();
     $sitedctrlr=new SiteDataController();    
     $langitem = Language::where('status',1)->where('code', $lang)->first();
     $catmodel= Category::where('slug',$slug)->select('id','code')->first();
     $current_path=$sitedctrlr->getpath($lang,$slug); 
   
   if($catmodel->code=='projects'){
   $catpostArr= $sitedctrlr->getcatwithpost( $langitem->id,$slug,$postslug);


   $cat=$catpostArr['category'];
   $post=$catpostArr['posts']->first();

   if($catpostArr['posts']->count()>0){
      return view('site.content.post',['category'=>$cat,'postcontent'=>$post,'lang'=>$lang ,'current_path'=>$current_path,'active_item'=>$cat['code']]);  

   }else{
   abort(404, '');
   }
   }else if($catmodel->code=='products'){
   $catpostArr= $sitedctrlr->getcatwithpost( $langitem->id,$slug,$postslug);


   $cat=$catpostArr['category'];
   $post=$catpostArr['posts']->first();

   if($catpostArr['posts']->count()>0){
      return view('site.content.product',['category'=>$cat,'postcontent'=>$post,'lang'=>$lang ,'current_path'=>$current_path,'active_item'=>$cat['code']]);  

   }else{
   abort(404, '');
   }
}
else{
   abort(404, '');
}
// else if($catmodel->code=='contacts'){
 
//    $cat= $sitedctrlr->getcontactinfo( $langitem->id,$slug);

//    return view('site.content.contact',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path]);  
// }else{
  
//    $cat= $sitedctrlr->getcatinfo( $langitem->id,$slug);
    
//         return view('site.content.about',['category'=>$cat,'lang'=>$lang ,'current_path'=>$current_path]);  
// }
     
      
    }
    public function changelang($lang)
    {
        $sitedctrlr=new SiteDataController();
        $slidedata=  $sitedctrlr->getSlideData('home');
      // return redirect()->back()->with(['lang'=>$lang]);
       return view('site.home',['slidedata'=> $slidedata,'lang'=>$lang]);
     //  return view('site.home',['slidedata'=> $slidedata]);
    }
}
