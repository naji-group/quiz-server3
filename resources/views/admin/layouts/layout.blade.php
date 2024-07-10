<!DOCTYPE html>
<html lang="ar" dir="rtl">
  
@include('admin.layouts.head')

<body class="g-sidenav-show rtl bg-gray-200">
  @include('admin.layouts.sidebar')
  @include('admin.layouts.header')
@yield('content')
@include('admin.layouts.footer')

</html>
