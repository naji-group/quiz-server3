@extends('admin.layouts.layout')
@section('breadcrumb')ترتيب القوائم @endsection
@section('content')
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-white" role="alert">
                    {{ $message }}
                </div>
            @endif
        </div>

       

        <div class="row backgroundW p-4 m-3">
            <div class="container">
                <div class="form-group btn-create">
                    <h4>القوائم</h4>
                </div>
                <div class="form-group btn-create  justify-content-end" style="display: flex">
                    
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">القسم</th>
                             
                            <th scope="col">عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr>
                                <th scope="row">1</th>
                                <td> HEADER</td>
                                <td style="width: 50px">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{url('admin/page/sort','main-menu')}}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td> FOOTER</td> 
                                <td style="width: 50px">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{url('admin/page/sort','footer-menu')}}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        
                                    </div>
                                </td>
                            </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </main>


@endsection