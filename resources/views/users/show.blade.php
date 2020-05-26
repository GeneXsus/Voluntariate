@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                @if ($user->hasRole('User'))
                    <div class="title">
                        <h2>{{$user->name}} {{$user->subname}}</h2>
                        <p>{{$user->description}}</p>
                        <p>{{$user->location}}</p>
                        @if (Auth::user()->hasRole('Administrator'))
                            <p>{{$user->email}}</p>
                        @endif



                        @elseif ($user->hasRole('Company'))
                            <h2>{{$user->center}}</h2>
                            <p>{{$user->description}}</p>
                            <p>{{$user->location}}</p>
                            <p>{{$user->direction}}</p>
                            @if (Auth::user()->hasRole('Administrator'))
                                <p>{{$user->email}}</p>
                            @endif

                        @endif



                    </div>
                    @include('layouts.block.rating.show', ['ratings' => $user->ratings, 'ratingTitle'=>__("Ratings")])
                    @if($canRate)
                        @include('layouts.block.rating.write', ['ratings' => $user->ratings])
                    @endif
                @if ($user->hasRole('Company'))
                    <div class="card">
                        <div class="nav nav-tabs card-header-tabs justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active " id="nav-offers-tab" data-toggle="tab"
                               href="#nav-offers" role="tab" aria-controls="nav-offers"
                               aria-selected="true">{{ __('Opened') }} </a>

                            <a class="nav-item nav-link " id="nav-closed-tab" data-toggle="tab" href="#nav-closed"
                               role="tab" aria-controls="nav-closed" aria-selected="false">{{ __('Closed') }} </a>
                        </div>
                        <div class="tab-content mt-3">


                            <div class="tab-pane fade show active " id="nav-offers" role="tabpanel"
                                 aria-labelledby="nav-offers-tab">
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


                            <div class="tab-pane fade " id="nav-closed" role="tabpanel"
                                 aria-labelledby="nav-closed-tab">
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
                    @endif



            </div>
        </div>

@endsection
