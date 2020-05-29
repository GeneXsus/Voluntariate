@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @can('create_offer')
        <div class="w-100">
            <div class="col-12 d-flex mb-3 justify-content-end">

                    <a class="btn  btn-outline-primary" href="{{route('offers.create')}}"
                       role="button">{{__('New Offer')}}</a>

            </div>
        </div>
        @endcan

        <div class="card">
            <div class="col-12 d-flex justify-content-center text-center card-header mb-2  ">
                <h2 class="text-center card-title mt-2">{{__('Manage Offers')}}
                </h2>

            </div>
            <div class="col-12">
                @include('layouts.block.search')

            </div>
            <div class=" card-header card-header-for-tabs col-12 mt-2">
                <div class="nav nav-tabs card-header-tabs justify-content-center m-0" id="nav-tab" role="tablist">


                    @can('be_acepted')
                        <a class="nav-item nav-link active " id="nav-registered-tab" data-toggle="tab"
                           href="#nav-registered" role="tab" aria-controls="nav-registered"
                           aria-selected="true">{{ __('Registered') }} </a>
                        <a class="nav-item nav-link " id="nav-acepted-tab" data-toggle="tab" href="#nav-acepted"
                           role="tab" aria-controls="nav-acepted" aria-selected="false">{{ __('Acepted') }} </a>
                    @else
                        <a class="nav-item nav-link active " id="nav-offers-tab" data-toggle="tab"
                           href="#nav-offers" role="tab" aria-controls="nav-offers"
                           aria-selected="true">{{ __('Opened') }} </a>
                    @endcan
                    <a class="nav-item nav-link " id="nav-closed-tab" data-toggle="tab" href="#nav-closed"
                       role="tab" aria-controls="nav-closed" aria-selected="false">{{ __('Closed') }} </a>
                </div>
            </div>
            <div class="tab-content mt-3">

                @can('be_acepted')
                    <div class="tab-pane fade  show active" id="nav-registered" role="tabpanel"
                         aria-labelledby="nav-registered-tab">
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
                                    @include('layouts.card.empty', ['message' => __('you have not registered in any offer')])
                                @endif

                            </div>
                        @endforelse

                    </div>
                    <div class="tab-pane fade " id="nav-acepted" role="tabpanel"
                         aria-labelledby="nav-acepted-tab">
                        @forelse ($offers_acepted as $offer)
                            <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                                @include('layouts.card.offer')
                            </div>
                        @empty
                            <div class="col-12 mt-3 mb-3">
                                @if(isset($search))
                                    @include('layouts.card.empty', ['message'
                                    => __('could not find what you were looking for')])
                                @else
                                    @include('layouts.card.empty', ['message' => __('you have not been accepted in any offer')])
                                @endif

                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="tab-pane fade show active " id="nav-offers" role="tabpanel"
                         aria-labelledby="nav-offers-tab">
                        <div class="d-flex flex-wrap">


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
                                        @include('layouts.card.empty', ['message' => __('there are no open offers')])
                                    @endif


                                </div>
                            @endforelse
                        </div>
                    </div>
                @endcan

                <div class="tab-pane fade " id="nav-closed" role="tabpanel"
                     aria-labelledby="nav-closed-tab">
                    @forelse ($offers_closed as $offer)
                        <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                            @include('layouts.card.offer')
                        </div>
                    @empty
                        <div class="col-12 mt-3 mb-3">
                            @if(isset($search))
                                @include('layouts.card.empty', ['message'
                                => __('could not find what you were looking for')])
                            @else
                                @include('layouts.card.empty', ['message' => __('there are no closed offers')])
                            @endif

                        </div>
                    @endforelse
                </div>
            </div>


        </div>

    </div>
@endsection
