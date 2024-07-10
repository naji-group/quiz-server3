@extends('admin.layouts.layout')
@section('breadcrumb')المستويات@endsection
@section('content')

        <div class="row backgroundW p-4 m-3">
            <div class="container">
                <div class="form-group btn-create">
                    <h4>المستويات</h4>
                </div>
                <div class="form-group btn-create  justify-content-end" style="display: flex">
                    <a href="{{route('level.create') }}" class="btn btn-primary">جديد</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">المستوى</th>
                            <th scope="col">عدد الاجابات</th>
                            <th scope="col">قيمة الهدية</th>
                            <th scope="col">الحالة</th>
                            <th scope="col">العمليات</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @forelse ($List as $level)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{$level->name}}</td>
                                <td>{{ $level->answers_count }}</td>
                                <td>{{ $level->points }}</td>
                                <td>{{ $level->status_conv }}</td>                      
                               
                                <td style="width: 50px">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{route('level.edit', $level->id)}}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-sm-2">
                                                <form method="POST" action="{{route('level.destroy', $level->id)}}" >
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