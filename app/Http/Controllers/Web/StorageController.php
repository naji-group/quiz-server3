<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\Selectedservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PhpParser\Node\Expr\Cast\Object_;
use Ramsey\Uuid\Type\Decimal;
use Illuminate\Support\Facades\URL;
use  App\Models\Setting;
class StorageController extends Controller
{


  public $path = [];
  public $iconpath = [];
  public $recordpath = [];
  public $vidpath = [];
  public $pdfpath = [];
  public $soundpath = [];
  
  private $defaultimage = "default.png";
  private $defaultsvg = "default.svg";
  public function __construct()
  {
    //inputs
    
    //experts
     

    // $recordpath['experts'] = 'images/experts/records';
 

    //clients
    $this->path['clients'] = 'images/clients';
    //users
    $this->path['users'] = 'images/users';
    //empty
    $this->path['default'] = 'images/default';
    $this->iconpath['default'] = 'images/default/icons';
    $this->path['languages'] = 'images/languages';
    $this->path['projects'] = 'images/projects';
    $this->vidpath['projects'] = 'images/projects/video';
    $this->path['site'] = 'images/site';

    $this->path['categories'] = 'images/categories';
    $this->vidpath['categories'] = 'images/categories/video';
    $this->path['posts'] = 'images/posts';
    $this->vidpath['posts'] = 'images/posts/video';

    $this->pdfpath['categories'] = 'images/categories/pdf';
    $this->pdfpath['posts'] = 'images/posts/pdf';
    //messages
    $this->path['messages'] = 'images/messages';
    $this->vidpath['messages'] = 'images/messages/video';
    $this->soundpath['messages'] = 'images/messages/sound';
    
    
    //value
 
    //answer
  
  }
  /**
   * Display a listing of the resource.
   */
  // public function ExpertPath($type)
  // { //image record
  //   $url = "";

  //   if ($type == "image") {
  //     $url = url(Storage::url($this->path['experts'])) . '/';
  //   } else {
  //     $url = url(Storage::url($this->recordpath['experts'])) . '/';
  //   }

  //   return $url;

  // }
  public function getlocalpath($subpath)
  {  
    $url = "";  

     if(File::exists(base_path('public\index.php'))){
      $url = url(Storage::url($subpath)) . '/';
     }
     else{
      $url = url('public'.Storage::url($subpath)) . '/';
     }
        return $url;
  }
  public function UserPath()
  {  
    $url = "";  
   
     $url =  $this->getlocalpath($this->path['users']);
 
          return $url;
  }
  public function ClientPath()
  {  
    $url = "";  
   
     $url =  $this->getlocalpath($this->path['clients']);
 
          return $url;
  }
  public function LanguagePath()
  {  
    $url = "";  
  //  $url = Storage::url($this->path['users'])  . '/';
     
    //  if(File::exists(base_path('public\index.php')))  {
    //   $url = url(Storage::url($this->path['languages'])) . '/';
    //  }
    //  else{
    //   $url = url('public'.Storage::url($this->path['languages'])) . '/';
    //  }
     $url =  $this->getlocalpath($this->path['languages']);
          return $url;
  }

  public function DefaultPath($type)
  { //image icon
    $url = "";
    if ($type == "image") {

      // if(File::exists(base_path('public\index.php')))  {
      //   $url = url(Storage::url($this->path['default'])) . '/' . $this->defaultimage;
      //  }
      //  else{
      //   $url = url('public'.Storage::url($this->path['default'])) . '/' . $this->defaultimage;
      
      //  }
       $url =  $this->getlocalpath($this->path['default']). $this->defaultimage;
      
    } else {
      // if(File::exists(base_path('public\index.php')))  {
      //   $url = url(Storage::url($this->iconpath['default'])) . '/' . $this->defaultsvg;
      //  }
      //  else{
        
      //   $url = url('public'.Storage::url($this->iconpath['default'])) . '/' . $this->defaultsvg;
      //  }
       $url =  $this->getlocalpath($this->iconpath['default']). $this->defaultsvg;
    }
    return $url;


  }

  public function ProjectPath($type)
  { //image video
    $url = "";
    if ($type == "image") {
      // if(File::exists(base_path('public\index.php')))  {
      //   $url = url(Storage::url($this->path['projects'])) . '/'  ;
      //  }
      //  else{
      //   $url = url('public'.Storage::url($this->path['projects'])) . '/' ;
      
      //  }
       $url =  $this->getlocalpath($this->path['projects']);      
    } else {
      //video
      // if(File::exists(base_path('public\index.php')))  {
      //   $url = url(Storage::url($this->vidpath['projects'])) . '/'  ;
      //  }
      //  else{        
      //   $url = url('public'.Storage::url($this->vidpath['projects'])) . '/'  ;
      //  }
       $url =  $this->getlocalpath($this->vidpath['projects']);
    }
    return $url;

  }

  public function PostPath($type)
  { //image video
    $url = "";
    if ($type == "image") {
    
       $url =  $this->getlocalpath($this->path['posts']);      
    }else if($type == "pdf"){
      $url =  $this->getlocalpath($this->pdfpath['posts']);   
    } else {
      //video
 
       $url =  $this->getlocalpath($this->vidpath['posts']);
    }
    return $url;

  }
  public function CategoryPath($type)
  { //image video
    $url = "";
    if ($type == "image") {
    
       $url =  $this->getlocalpath($this->path['categories']);      
    } else if($type == "pdf"){
      $url =  $this->getlocalpath($this->pdfpath['categories']);   
    }
    else {
      //video 
       $url =  $this->getlocalpath($this->vidpath['categories']);
    }
    return $url;
  }
  public function SitePath($type)
  {  
    $url = "";  
 
     $url =  $this->getlocalpath($this->path['site']);
          return $url;
  }
  public function getPath($filename,$path)
  {  
    $conv='';
    if(is_null($filename) ){
          }else if($filename==''){       
    } else {         
        $conv = $path.$filename;
          return $conv;
  }
}
  
public function MessagePath($type)
  { //image sound video
    $url = "";
    if ($type == "image") {    
       $url =  $this->getlocalpath($this->path['messages']);      
    }else if($type == "sound"){
      $url =  $this->getlocalpath($this->soundpath['messages']);   
    } else {
      //video 
       $url =  $this->getlocalpath($this->vidpath['messages']);
    }
    return $url;
  }
 /*
  public static function CalcPercentVal($percent,$total)
  {
      //10% 200->200*10/100
      $val=$total*$percent/100;
      return $val;
  }
  public static function addZeros($number)
  {
      $number = (int) $number;
      $numLength = strlen($number);
      if ($numLength < 6) {
          $zeroslen = 6 - $numLength;
          $paddedNumber = str_pad($number, 6, '0', STR_PAD_LEFT);
      } else {
          $paddedNumber = str_pad($number, $numLength + 1, '0', STR_PAD_LEFT);
      }
      return $paddedNumber;
  }
  //
  public static function diffTimeinMinutes($start_date, $end_date)
  {
      $minutes = 0;
      if ((!is_null($start_date)) && (!is_null($end_date))) {
          $end = Carbon::parse($end_date);
          $start = Carbon::parse($start_date);

          $minutes = $end->diffInMinutes($start);
      }
      return $minutes;
  }
 */ 

}
