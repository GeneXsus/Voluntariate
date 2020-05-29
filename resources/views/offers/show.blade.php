@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                <div class="title">
                    <h2>{{$offer->name}}</h2>
                    <span class="byline">{{$offer->description_short}}</span>
                </div>

                <p>{{$offer->description}}</p>
                @if($offer->user->ratings->count()>0)
                    @include('layouts.block.rating.show', ['ratings' => $offer->user->ratings, 'ratingTitle'=>__("Users Ratings")])
                @endif
                {{--                TODO CHAT--}}
                @if($isSubscribe)
                    Chat
                @endif
                @if(Auth::user()->hasRole('Company'))
                    <div class="row  justify-content-center mt-3 mb-3">
                        <div class="col-12">
                            <div class="card">
                                <div class=" card-header justify-content-center">
                                    <h2 class="card-title text-center">{{__('Users Registereds')}}</h2>
                                </div>


                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">


                                        @forelse($registereds as $userRegis)
                                            <div class="col-12 col-sm-6 col-lg-4 mt-3 mb-3">
                                                @include('layouts.card.userRegister', ['user' => $userRegis])
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                @include('layouts.card.empty', ['message' => __('there is any users register')])
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                @endif
            </div>


            @if(Auth::user()->hasRole('User'))

                @if($isSubscribe)
                    <div class="subscribe-button-container animated fadeInUp">

                        <button class="btn btn-danger btn-block swalButton"
                                data-form-send="unsubscribe-form-{{$offer->id}}"
                                data-title-swal="{{__('Unsubscribe')}}"
                                data-text-swal="{{__('Are you sure you want to unsubscribe?')}}"
                                data-type-swal="warning"
                                data-confirm-swal="{{__('Unsubscribe')}}"
                                data-cancel-swal="{{__('Cancel')}}"
                        >
                            {{__('UNSUBSCRIBE')}}
                        </button>
                    </div>
                    <form id="unsubscribe-form-{{$offer->id}}" action="{{ route('offers.unsubscribe',$offer) }}"
                          method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                @else
                    <div class="subscribe-button-container animated fadeInUp">

                        <button class="btn btn-success btn-block swalButton"
                                data-form-send="subscribe-form-{{$offer->id}}"
                                data-title-swal="{{__('Subscribe')}}"
                                data-text-swal="{{__('Are you sure you want to subscribe?')}}"
                                data-type-swal="warning"
                                data-confirm-swal="{{__('Subscribe')}}"
                                data-cancel-swal="{{__('Cancel')}}"
                        >
                            {{__('SUBSCRIBE')}}
                        </button>
                        <form id="subscribe-form-{{$offer->id}}" action="{{ route('offers.subscribe',$offer) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endif
            @endif
        </div>

    </div>

@endsection
