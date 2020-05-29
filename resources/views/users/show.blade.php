@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                <div class="card">
                    @if ($user->hasRole('User'))
                    <div class=" user-header card-header justify-content-center">
                        <h1 class="card-title text-center">{{$user->name}} {{$user->subname}} ({{$user->location}})</h1>
                    </div>
                    @elseif ($user->hasRole('Company'))
                        <div class=" user-header card-header justify-content-center">
                            <h1 class="card-title text-center">{{$user->center}}</h1>
                        </div>
                    @endif
                    <div class="card-body">

                        @if (Auth::user()->hasRole('Administrator'))
                                <div class="row">
                                        <p class="col-12 col-sm-auto offset-sm-1 offset-xl-2">{{__("Email:")}}</p>
                                        <p class="col-auto">{{$user->email}}</p>
                                </div>
                        @endif
                        @if ($user->hasRole('Company'))
                                <div class="row">
                                    <p class="col-12 col-sm-auto offset-sm-1 offset-xl-2">{{__("Direction:")}}</p>
                                    <p class="col-auto">{{$user->direction}} ({{$user->location}})</p>
                                </div>
                        @endif


                        <div class="row">
                            <div class="col-12 col-sm-10 col-xl-8 offset-sm-1 offset-xl-2">
                                <p>{ {!! nl2br(e($user->description)) !!}</p>
                            </div>
                        </div>

                    </div>

                </div>

                    @include('layouts.block.rating.show', ['ratings' => $user->ratings()->orderBy('updated_at','Desc')->get(), 'ratingTitle'=>__("Ratings"),"show"=>'show'])

                    @if ($user->hasRole('Company'))

                        <div class="card ">
                            <a class="collapse-head" data-toggle="collapse" href="#offer" role="button"
                               aria-expanded="false"
                               aria-controls="offer">


                                <div class="card-header" id="offerHeader">
                                    <h5 class="mb-0 d-flex justify-content-center">
                                        <button class="btn btn-link buttons-for-colapse">
                                            {{__('Offers')}}
                                        </button>
                                    </h5>
                                </div>
                            </a>

                            <div id="offer" class="collapse show">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="nav nav-tabs card-header-tabs justify-content-center" id="nav-tab"
                                             role="tablist">
                                            <a class="nav-item nav-link active " id="nav-offers-tab" data-toggle="tab"
                                               href="#nav-offers" role="tab" aria-controls="nav-offers"
                                               aria-selected="true">{{ __('Opened') }} </a>

                                            <a class="nav-item nav-link " id="nav-closed-tab" data-toggle="tab"
                                               href="#nav-closed"
                                               role="tab" aria-controls="nav-closed"
                                               aria-selected="false">{{ __('Closed') }} </a>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-3">


                                        <div class="tab-pane fade show active " id="nav-offers" role="tabpanel"
                                             aria-labelledby="nav-offers-tab">
                                            <div class="row d-flex justify-content-center">
                                                @forelse ($offers as $offer)
                                                    <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                                                        @include('layouts.card.offer')
                                                    </div>
                                                @empty
                                                    <div class="col-12 mt-3 mb-3">
                                                        @include('layouts.card.empty', ['message' => __('there are no open offers')])
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>


                                        <div class="tab-pane fade " id="nav-closed" role="tabpanel"
                                             aria-labelledby="nav-closed-tab">
                                            <div class="row d-flex justify-content-center">

                                                @forelse ($offers_closed as $offer)
                                                    <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                                                        @include('layouts.card.offer')
                                                    </div>
                                                @empty
                                                    <div class="col-12 mt-3 mb-3">
                                                        @include('layouts.card.empty', ['message' => __('there are no closed offers')])
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>



                    @endif


            </div>
        </div>

@endsection
