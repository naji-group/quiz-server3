<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}"/> 
  @foreach ( $mainarr['headerlist'] as $headrow )
  {{ Str::of($headrow['value1'])->toHtmlString()}}    
@endforeach
<link href="{{ $mainarr['favicon']}}" rel="icon">  
<title>
  {{$mainarr['title']}} @yield('page-title')
</title> 
 
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Custom styles -->
   
  <link rel="stylesheet" href="{{ url('assets/site/css/styles.css') }}" />
  @yield('css')
</head>
