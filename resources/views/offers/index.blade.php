@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-12 d-flex mb-3 justify-content-end">
                <a class="btn  btn-outline-primary" href="{{route('offers.create')}}" role="button">{{__('New Offer')}}</a>
            </div>
        </div>
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="nav nav-tabs card-header-tabs justify-content-center" id="nav-tab" role="tablist">


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
                    <div class="tab-content mt-3">

                        @can('be_acepted')
                            <div class="tab-pane fade show active" id="nav-registered" role="tabpanel"
                                 aria-labelledby="nav-registered-tab">
                                @forelse ($offers as $offer)
                                    @include('layouts.card.offer')
                                @empty
                                    @include('layouts.card.empty', ['message' => __('you have not registered in any offer')])
                                @endforelse
                            </div>

                            <div class="tab-pane fade " id="nav-acepted" role="tabpanel"
                                 aria-labelledby="nav-acepted-tab">
                                @forelse ($offers_acepted as $offer)
                                    @include('layouts.card.offer')
                                @empty
                                    @include('layouts.card.empty', ['message' => __('you have not been accepted in any offer')])
                                @endforelse
                            </div>
                            @else
                            <div class="tab-pane fade show active" id="nav-offers" role="tabpanel"
                                 aria-labelledby="nav-offers-tab">
                                @forelse ($offers as $offer)
                                    @include('layouts.card.offer')
                                @empty
                                    @include('layouts.card.empty', ['message' => __('there are no open offers')])
                                @endforelse
                            </div>
                        @endcan

                        <div class="tab-pane fade " id="nav-closed" role="tabpanel" aria-labelledby="nav-closed-tab">
                            @forelse ($offers_closed as $offer)
                                @include('layouts.card.offer')
                            @empty
                                @include('layouts.card.empty', ['message' => __('there are no closed offers')])
                            @endforelse
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
