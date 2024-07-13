@extends('site.layouts.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <main role="main" class="col-12 col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ $sitedataCtrlr->gettrans($translate, 'my-score') }}</h1>
                </div>

                <!-- محتوى الصفحة -->
                <div class="row main-content justify-content-center ">
                    <div class="col-md-12">
                        <div class="card login-card">
                            <div class="card-body  bg-style">
                                <h3 class="card-title text-center">{{ $sitedataCtrlr->gettrans($translate, 'my-score') }}
                                </h3>
                               <!-- محتوى الصفحة -->
                               <div class="card-container">
                                @forelse ($cat_score as $cat)
                                <div class="scard animate__animated">
                                    <h2>{{ $cat['category']['tr_title'] }} </h2>
                                    <p><span>{{ $sitedataCtrlr->gettrans($translate, 'level') }}</span> : <span>{{ $cat['level'] }}</span> </p>
                                    <p><span>{{ $sitedataCtrlr->gettrans($translate, 'total-points') }}</span> : <span>{{ $cat['points'] }}</span> </p>
                                </div>
                                @empty
                                <p>{{ $sitedataCtrlr->gettrans($translate, 'no-sections') }}</p>
                                @endforelse
                                
                            </div>


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
