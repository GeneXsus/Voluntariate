@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                <div class="card">
                    <div class=" user-header card-header justify-content-center">
                        <h1 class="card-title text-center">{{$user->name}} {{$user->subname}} ({{$user->location}})</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-10 col-xl-8 offset-sm-1 offset-xl-2">
                                <p>{ {!! nl2br(e($user->description)) !!}</p>
                            </div>
                        </div>

                    </div>

                </div>

                @include('layouts.block.rating.show', ['ratings' => $user->ratings()->orderBy('updated_at','Desc')->get(), 'ratingTitle'=>__("Ratings"), 'rating_value'=>$user->ratingsValue()])



                <div class="card">
                    <a class="collapse-head" data-toggle="collapse" href="#chat" role="button" aria-expanded="false"
                       aria-controls="chat">


                        <div class="card-header" id="ratingHeader">
                            <h5 class="mb-0 d-flex justify-content-center">
                                <button class="btn btn-link buttons-for-colapse">
                                    {{__('Chat')}} {{$offer->name}}
                                </button>
                            </h5>
                        </div>
                    </a>

                    <div id="chat" class="collapse show">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">


                                <div id="chat-vue" class="col-12 chat-offer">
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            <chat-messages :messages="messages"></chat-messages>
                                        </div>
                                        <div class="panel-footer">
                                            <chat-form
                                                v-on:messagesent="addMessage"
                                                :user="{{ Auth::user() }}"
                                            ></chat-form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                @if($user->pivot->acepted)
                    <div class="subscribe-button-container animated fadeInUp">
                        <button class="btn btn-danger btn-block   swalButton"
                                data-form-send="refuse-form-{{$user->id}}"
                                data-title-swal="{{__('Refuse')}}"
                                data-text-swal="{{__('Are you sure you want to refuse him?')}}"
                                data-type-swal="warning"
                                data-confirm-swal="{{__('Refuse')}}"
                                data-cancel-swal="{{__('Cancel')}}"
                        >
                            {{__('Refuse')}}
                        </button>

                    </div>

                    <form id="refuse-form-{{$user->id}}" action="{{ route('offers.refuse',['offer'=>$offer,'user'=>$user]) }}"
                          method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                @else
                    <div class="subscribe-button-container animated fadeInUp">

                        <button class="btn btn-success btn-block  swalButton"
                                data-form-send="acept-form-{{$user->id}}"
                                data-title-swal="{{__('Accept')}}"
                                data-text-swal="{{__('Are you sure you want to refuse him?')}}"
                                data-type-swal="warning"
                                data-confirm-swal="{{__('Accept')}}"
                                data-cancel-swal="{{__('Cancel')}}"
                        >
                            {{__('Accept')}}
                        </button>
                        <form id="acept-form-{{$user->id}}" action="{{ route('offers.accept',['offer'=>$offer,'user'=>$user]) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>












    @endsection


