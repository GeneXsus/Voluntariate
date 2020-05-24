@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content" >
                <div class="title">
                    <h2>{{$offer->name}}</h2>
                    <span class="byline">Mauris vulputate dolor sit amet nibh</span> </div>

                <p>{{$offer->description}}</p>
                @if($offer->user->ratings->count()>0)
                    @include('layouts.block.rating.show', ['ratings' => $offer->user->ratings, 'ratingTitle'=>__("Usuario Ratings")])
                @endif
            </div>
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
                <form id="unsubscribe-form-{{$offer->id}}" action="{{ route('offers.unsubscribe',$offer) }}" method="POST"
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
                <form id="subscribe-form-{{$offer->id}}" action="{{ route('offers.subscribe',$offer) }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </div>
            @endif
            </div>

        </div>

@endsection
