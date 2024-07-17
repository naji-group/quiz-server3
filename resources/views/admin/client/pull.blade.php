@extends('admin.layouts.layout')
@section('breadcrumb')الاعضاء@endsection
@section('content')
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-white" role="alert">
                    {{ $message }}
                </div>
            @endif
        </div>

        @if (count($errors) > 0)

            <ul>
                @foreach ($errors->all() as $item)
                    <li class="text-danger">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>

        @endif
      
        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/client') }}">الاعضاء</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> عمليات السحب للعضو</li>
                </ol>
            </nav>
            <div class="container">
                <div class="form-group btn-create">
                    <h4></h4>
                </div>
                <div class="form-group btn-create  justify-content-end" style="display: flex">
<div class="row " style="text-align: left">
                    <p class="col-sm-12" ><span style="padding: 0px 2px;">الاسم:</span>
                        <span style="padding: 0px 2px;" ><strong>{{ $client->name }}</strong></span>
                        <span style="padding: 0px 5px;">-</span>
                        <span style="padding: 0px 2px;">الايميل:</span>
                        <span style="padding: 0px 2px;"><strong>{{ $client->email }}</strong></span></p>
                    <p class="col-sm-12"  ><span style="padding: 0px 2px;">الرصيد الكلي:</span>
                        <span style="padding: 0px 2px;"><strong>{{ $client->total_balance }}</strong></span>
                        <span style="padding: 0px 5px;">-</span>
                        <span style="padding: 0px 2px;">الرصيد الحالي:</span>
                        <span style="padding: 0px 2px;"><strong>{{ $client->balance }}</strong></span></p>
                </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            {{-- <th scope="col">User</th> --}}
                             
                            <th scope="col">النقاط</th>
                            <th scope="col">القيمة</th>                          
                            <th scope="col"  >الرصيد قبل</th>
                            <th scope="col"  >الرصيد بعد</th>
                            <th scope="col"  >التاريخ</th>
                            <th scope="col"  >عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @forelse ($op_list as $oprow)
                            <tr>
                                <td scope="row">{{ ++$i }}</td>                            
                                <td>{{ $oprow->points }}</td>
                                <td>{{ $oprow->cash }}</td>
                                <td>{{ $oprow->balance_before }}</td>
                                <td>{{ $oprow->balance_after }}</td>
                                <td>{{ $oprow->created_at }}</td>
                                <td style="width: 100px">
                                    <div class="row">                                       
                                        
                                            <a href="{{url('admin/client/show',$oprow->client->id)}}"><i
                                                    class="fa-solid fa-info" data-toggle="tooltip" data-placement="top" title="تفاصيل العضو"></i></a>  
                                                                                                    
                                       
                                     </div>
                                </td>
                            </tr>
                             @empty
                                <tr>
                                    <td colspan="9" style="text-align:center;">لايوجد بيانات لعرضها</td>
                                </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
            {{ $op_list->onEachSide(5)->links() }}
        </div>

    </main>


@endsection