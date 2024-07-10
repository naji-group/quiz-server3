@extends('site.layouts.layout')
@section('page-title') - {{$page->title}} @endsection
@section('content')
    <div class="content-all" style="width: 100%; height:auto;">
        <div class="part-country">
            <div class="container">
                <div class="container mt-5 mb-5">
                    <div class="jumbotron">
                        <h2>{{ Str::of($page->title)->toHtmlString()}}</h2>
                        <hr>
                    {{ Str::of($page->desc)->toHtmlString()}}  
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('assets/site/assets/css/custom.css') }}" />
@endsection
@section('js')
@endsection
