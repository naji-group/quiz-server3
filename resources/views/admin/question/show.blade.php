@extends('admin.layouts.layout')
@section('breadcrumb')الاسئلة@endsection
@section('content')

        <div class="row backgroundW p-4 m-3">
            <div class="container">
                <div class="form-group btn-create">
                    <h4>الاسئلة</h4>
                   <form name="create_form" method="POST" action="{{ url('admin/search') }}"
                   id="s_form">
                   @csrf
                    <input type="text" class="form-controll" name="content" id="content"
                    placeholder="بحث" value="">
                    <button type="submit" id="btn_search" class="btn btn-primary float-right  "
                    style="margin-right: 20px;margin-left: 20px">بحث </button>
                </form>
                </div>
                <div class="form-group btn-create  justify-content-end" style="display: flex">
                    <a href="{{route('question.create') }}" class="btn btn-primary">جديد</a>
                </div>
            </div>
            @if(@isset($List))
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                            <th scope="col">السؤال</th>
                            <th scope="col">اللغة</th>
                            <th scope="col">التصنيف </th>
                            <th scope="col">الحالة</th>
                            <th scope="col">العمليات</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                    
                            
                      
                        @forelse ($List as $ques) 
                        <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{$ques->content}}</td>
                                <td>{{ $ques->language->name }}</td>
                                <td>{{ $ques->category->title }}</td>                                
                                <td>{{ $ques->status_conv }}</td>                      
                               
                                <td style="width: 50px">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{route('question.edit', $ques->id)}}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-sm-2">
                                                <form method="POST" action="{{route('question.destroy', $ques->id)}}" >
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
            {!! $List->render() !!}
            @endif
         
           
        </div>

    </main>


@endsection