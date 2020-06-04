@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="w-100 ">
        @if((Auth::user() == null))
            <div class="jumbotron text-center">
                <div class="container">
                    <h1>{{__('Volunteers?')}}</h1>
                    <p class="lead text-muted">{{__("If you need people willing to face the challenges of participating in a volunteer service or what you are looking for is to become a volunteer, this is your application")}}</p>
                    <p>
                        <a href="{{ route('register') }}" class="btn btn-primary my-2">{{__('Sign up')}} </a>
                    </p>
                </div>
            </div>
        @endIf


    @if(Auth::user() && Auth::user()->hasRole('User'))
        <div class="card w-100 mt-3 ">
            <div class="col-12 d-flex justify-content-center text-center card-header mb-2  ">
                <h2 class="text-center card-title mt-2">{{__('Offers')}}
                </h2>

            </div>
            <div class="col-12">
                @include('layouts.block.search')

            </div>
            <div class=" card-header card-header-for-tabs col-12 mt-2">
                <div class="nav nav-tabs card-header-tabs justify-content-center w-100 m-0" id="nav-tab" role="tablist">


                    <a class="nav-item nav-link active " id="nav-recommended-tab" data-toggle="tab"
                       href="#nav-recommended" role="tab" aria-controls="nav-recommended"
                       aria-selected="true">{{ __('Recommended') }} </a>
                    <a class="nav-item nav-link " id="nav-all-tab" data-toggle="tab" href="#nav-all"
                       role="tab" aria-controls="nav-all" aria-selected="false">{{ __('All') }} </a>

                </div>
            </div>

            <div class="tab-content mt-3">
                <div class="tab-pane fade  show active w-100" id="nav-recommended" role="tabpanel"
                     aria-labelledby="nav-recommended-tab">
                    <div class="row mr-0 ml-0 ">
                        @forelse ($offers_recommended as $offer)
                            <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                                @include('layouts.card.offer')
                            </div>
                        @empty
                            <div class="col-12 mt-3 mb-3">
                                @if(isset($search))
                                    @include('layouts.card.empty', ['message'
                                    => __('could not find what you were looking for')])
                                @else
                                    @include('layouts.card.empty', ['message'
                                            => __('There are no recommended offers for you in your area and / or you do not have any type as a favorite')])

                                @endif
                            </div>
                        @endforelse
                    </div>


                </div>
                <div class="tab-pane fade  w-100" id="nav-all" role="tabpanel"
                     aria-labelledby="nav-all-tab">
                    <div class="row mr-0 ml-0 ">
                        @forelse ($offers as $offer)
                            <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                                @include('layouts.card.offer')
                            </div>
                        @empty
                            <div class="col-12 mt-3 mb-3">
                                @if(isset($search))
                                    @include('layouts.card.empty', ['message'
                                    => __('could not find what you were looking for')])
                                @else
                                    @include('layouts.card.empty', ['message'
                              => __('Could not find any offer')])
                                @endif

                            </div>
                        @endforelse
                    </div>

                </div>


            </div>


        </div>


    @else()
        <div class="card  d-flex flex-wrap justify-content-center mt-3">
            <div class="col-12 d-flex justify-content-center text-center card-header mb-2  ">
                <h2 class="text-center card-title mt-2">{{__('Offers')}}
                </h2>

            </div>
            <div class="col-12">
                @include('layouts.block.search')

            </div>
            <div class="w-100 d-flex justify-content-center flex-wrap mr-0 ml-0 ">
                @forelse ($offers as $offer)
                    <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                        @include('layouts.card.offer')
                    </div>
                @empty
                    <div class="col-12 mt-3 mb-3">
                        @if(isset($search))
                            @include('layouts.card.empty', ['message'
                            => __('could not find what you were looking for')])
                        @else
                            @include('layouts.card.empty', ['message'
                                    => __('Could not find any offer')])

                        @endif

                    </div>

                @endforelse
            </div>
        </div>
    @endif

</div>
</div>
@endsection
