@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                <div class="card">
                    <div class=" card-header justify-content-center">
                        <h1 class="card-title text-center">{{$offer->name}}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-12 col-sm-8 col-md-5 offset-sm-2 offset-sm-3 ">
                                <p class="text-justify"> {!! nl2br(e($offer->description_short)) !!}</p>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card ">
                    <a class="collapse-head" data-toggle="collapse"  href="#detailed" role="button" aria-expanded="false"
                       aria-controls="detailed">


                        <div class="card-header" id="ratingHeader">
                            <h5 class="mb-0 d-flex justify-content-center">
                                <button class="btn btn-link buttons-for-colapse">
                                    {{__('Detailed Information')}}
                                </button>
                            </h5>
                        </div>
                    </a>

                    <div id="detailed" class="collapse show">
                        <div class="card-body">
                            <div class="row ">


                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Manager:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify">
                                        @if($offer->user)
                                            <a href="{{route('users.show',['user'=>$offer->user])}}">{{$offer->user->center}}</a>
                                        @else

                                             {{$offer->center}} ({{__("Eliminated")}})
                                        @endif
                                    </p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Type:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify" title="{{$offer->type->description}}"> {{$offer->type->name}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Places:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify"> {{$offer->places}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Location:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify"> {{$offer->location}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Init Date:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify"> {{$offer->init_date}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("End Date:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify"> {{$offer->end_date}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Created At:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify"> {{$offer->created_at}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5  offset-md-1 ">
                                    <p class="ml-auto text-right"> {{__("Updated At:")}}</p>
                                </div>
                                <div class=" col-6 col-sm-6 col-md-5">
                                    <p class="text-justify"> {{$offer->updated_at}}</p>
                                </div>

                                <div class="col-12 col-md-10 offset-md-1" >
                                    <h4 class=" text-left descripcion-offer-tilte"> {{__("Description:")}}</h4>

                                </div>
                                <div class="col-12 col-md-8 offset-md-2" >
                                        <p class="text-justify descripcion-offer"> {!! nl2br(e($offer->description)) !!}</p>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->hasRole('Company'))

                    <div class="card ">
                        <a class="collapse-head" data-toggle="collapse"  href="#registereds" role="button" aria-expanded="false"
                           aria-controls="registereds">


                            <div class="card-header" id="ratingHeader">
                                <h5 class="mb-0 d-flex justify-content-center">
                                    <button class="btn btn-link buttons-for-colapse">
                                        {{__('Users Registereds')}}
                                    </button>
                                </h5>
                            </div>
                        </a>

                        <div id="registereds" class="collapse show">
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

                @endif
                @if(Auth::user()->hasRole('User'))
                    @include('layouts.block.rating.show', ['ratings' => $offer->user->ratings, 'ratingTitle'=>__("Users Ratings"),'show'=>'show'])
                   @else
                    @include('layouts.block.rating.show', ['ratings' => $offer->user->ratings, 'ratingTitle'=>__("Users Ratings")])

                    @endif



                {{--                TODO CHAT--}}
                @if($isSubscribe)
                    <div class="card">
                        <a class="collapse-head" data-toggle="collapse"  href="#chat" role="button" aria-expanded="false" aria-controls="chat">


                            <div class="card-header" id="ratingHeader">
                                <h5 class="mb-0 d-flex justify-content-center">
                                    <button class="btn btn-link buttons-for-colapse">
                                        {{__('Chat')}}
                                    </button>
                                </h5>
                            </div>
                        </a>

                        <div id="chat" class="collapse show">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">


{{--                                    <div class="col-12 chat-offer">--}}
{{--                                        <div class="panel panel-default">--}}
{{--                                            <div class="panel-heading">{{__("Chats")}}</div>--}}

{{--                                            <div class="panel-body">--}}
{{--                                                <chat-messages :messages="messages"></chat-messages>--}}
{{--                                            </div>--}}
{{--                                            <div class="panel-footer">--}}
{{--                                                <chat-form--}}
{{--                                                    v-on:messagesent="addMessage"--}}
{{--                                                    :user="{{ Auth::user() }}"--}}
{{--                                                ></chat-form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

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
{{----}}
