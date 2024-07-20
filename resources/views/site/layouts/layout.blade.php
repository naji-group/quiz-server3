<!DOCTYPE html>
@if ($defultlang->code=='ar')
<html lang="ar" dir="rtl">
  @else
  <html  >
@endif

  @php
      $sitedataCtrlr=new App\Http\Controllers\Web\SiteDataController();  
      $mainarr=$sitedataCtrlr->FillStaticData();
      
      $f_menu=  $sitedataCtrlr->getbycode($defultlang->id,['footer-menu']);
      $h_menu=  $sitedataCtrlr->getbycode($defultlang->id,['header']);


    // $mainmenuarr=$sitedataCtrlr->getmenubyloc('main-menu');
     //$footermenuarr=$sitedataCtrlr->getmenubyloc('footer-menu');
     
  // if(isset($lang)){
  //   $transarr=$sitedataCtrlr->FillTransData( $lang);
  // }else{
  //   $transarr=$sitedataCtrlr->FillTransData();
  // }
  
  //  $defultlang=$transarr['langs']->first();
  //  $fsectionsarr=$sitedataCtrlr->getfooterLocation($defultlang->id);  
  //  $menuarr=$sitedataCtrlr->getmainmenu($defultlang->id);
  //  $catalog=$sitedataCtrlr->getcatalog($defultlang->id);
    @endphp
  
  @include('site.layouts.head') 
  @include('site.layouts.header') 

  @yield('content')
  @include('site.layouts.footer')
 
 
</html>
