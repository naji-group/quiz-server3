@extends('site.layouts.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <main role="main" class="col-12 col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ $sitedataCtrlr->gettrans($translate, 'scores') }}</h1>
                </div>

                <!-- محتوى الصفحة -->
                <div class="row main-content justify-content-center ">
                    <div class="col-md-12">
                        <div class="card login-card">


                            <!-- category  -->

                            @forelse ($category_score as $cat)
                                <div class="card-body  bg-style">
                                    <h3 class="card-title text-center">{{ $cat['category']['tr_title'] }}</h3>
                                    <!-- محتوى الصفحة -->
                                    <div class="card-container">

                                        <div class="scard text-center animate__animated ">
                                            <h2>{{ $sitedataCtrlr->gettrans($translate, 'high-score') }}</h2>
                                            <p> {{ $cat['total_score']['client_name'] }}</p>
                                            <p><span>{{ $sitedataCtrlr->gettrans($translate, 'level') }}</span> :
                                                <span>{{ $cat['total_score']['level'] }}</span> </p>
                                            <p><span>{{ $sitedataCtrlr->gettrans($translate, 'total-points') }}</span> :
                                                <span>{{ $cat['total_score']['cat_score'] }}</span> </p>
                                        </div>
                                        <div class="scard text-center animate__animated">
                                            <h2>{{ $sitedataCtrlr->gettrans($translate, 'month-score') }}</h2>
                                            <p> {{ $cat['month_score']['client_name'] }}</p>
                                            <p><span>{{ $sitedataCtrlr->gettrans($translate, 'level') }}</span> :
                                                <span>{{ $cat['month_score']['level'] }}</span> </p>
                                            <p><span>{{ $sitedataCtrlr->gettrans($translate, 'total-points') }}</span> :
                                                <span>{{ $cat['month_score']['cat_score'] }}</span> </p>
                                        </div>

                                    </div>


                                </div>

                                <div class="card-separator">
                                    <hr>
                                </div>

                            @empty
                                <p>{{ $sitedataCtrlr->gettrans($translate, 'no-sections') }}</p>
                            @endforelse

                            <div class="card-body  bg-style">
                                <h3 class="card-title text-center">
                                    {{ $sitedataCtrlr->gettrans($translate, 'general-sort') }}</h3>
                                <!-- محتوى الصفحة -->
                                @php
                                    $i=1;
                                @endphp
                                @forelse ($first_client as $client)
                                <div class="card-container">
                                    <div class="scard  scard-one text-center animate__animated">
                                        <h2>{{ $sitedataCtrlr->gettrans($translate, $i) }}</h2>
                                        <h2> {{ $client->name }}</h2>
                                        <p><span>{{ $sitedataCtrlr->gettrans($translate, 'total-points') }}</span> :
                                            <span>{{ $client->total_balance }}</span> </p>
                                    </div>
                                </div>
                                @php
                                $i++;
                            @endphp
                                @empty
                                <p>{{ $sitedataCtrlr->gettrans($translate, 'no-sections') }}</p>
                            @endforelse

                            </div>

                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('assets/site/js/myscore.js') }}"></script>
@endsection
