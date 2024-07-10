@extends('admin.layouts.layout')
@section('breadcrumb')المستويات@endsection
@section('content')

        <div class="row backgroundW p-4 m-3">
            <div class="container">
                <div class="form-group btn-create">
                    <h4>المستويات</h4>
                </div>
                <div class="form-group btn-create  justify-content-end" style="display: flex">
                    <a href="{{url('admin/post/createbycatid',$category->id)}}" class="btn btn-primary">جديد</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">النص</th>
                            <th scope="col"> القسم</th>
                           
                            <th scope="col">الحالة</th>
                            <th scope="col">العمليات</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @forelse  ($list as $item)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{$item->title}}</td>
                                <td>{{ $item->code}}</td>
                                
                                <td>{{ $item->status_conv }}</td>                      
                               
                                <td style="width: 50px">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{url('admin/post/editpost', $item->id)}}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-sm-2">
                                                <form method="POST" action="{{url('admin/post/destroy', $item->id)}}" >
                                                    @csrf
                                                    @method('DELETE')
                                                <a href=""   onclick="event.preventDefault();  this.closest('form').submit();">
                                                    <i class="fa-solid fa-trash"></i></a>                                                    
                                                </a>
                                            </form> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             @empty
                                <tr>
                                    <td colspan="3" style="text-align:center;">لايوجد بيانات لعرضها</td>
                                </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>

    </main>


@endsection