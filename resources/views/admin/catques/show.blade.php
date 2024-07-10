@extends('admin.layouts.layout')
@section('breadcrumb')التصنيفات@endsection
@section('content')
 

        <div class="row backgroundW p-4 m-3">
            <div class="container">
                <div class="form-group btn-create">
                    <h4>التصنيفات</h4>
                </div>
                <div class="form-group btn-create  justify-content-end" style="display: flex">
                    <a href="{{route('categoryques.create') }}" class="btn btn-primary">جديد</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">التصنيف</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">الحالة</th>
                            <th scope="col">العمليات</th>

                           
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @forelse ($List as $category)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{$category->title}}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->status_conv }}</td>
                               
                                
                                <td style="width: 50px">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{route('categoryques.edit', $category->id)}}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-sm-2">
                                                <form method="POST" action="{{route('categoryques.destroy', $category->id)}}" >
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