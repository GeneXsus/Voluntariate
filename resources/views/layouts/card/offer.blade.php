<div class="card h-100 {{$offer['closed']? 'closed':''}}  @if(Auth::user()
                                                                && Auth::user()->hasRole('User')
                                                                &&  $offer->user->unresponded(( $offer->id . 'o' . $offer->user->id . 'c' . Auth::user()->id.'a')))
                                                                    bg-info
                                                                        @endif">

    <div class="card-body card-button">
        <div class="d-flex  justify-content-around flex-wrap mb-1">
            <small class="text-muted text-right ml-1 mr-1">{{$offer->type['name']??__('Unspecified')}}</small>
            <small class="text-muted text-right ml-1 mr-1">{{$offer->location}}</small>
            <small class="text-muted text-right ml-1 mr-1 text-nowrap">{{__('Places')}} : {{$offer->places}}</small>
            @if ($offer->user)
                @if(Auth::user() && Auth::user()->id==$offer['user_id'])
                    <small class="text-muted text-right ">{{__('Registers')}} : {{$offer->registereds()->count()}}</small>

                    @else

                    <small class="text-muted text-right "> <a href="{{route("users.show",$offer->user)}}"
                                                              class="enlace ml-1 mr-1">{{$offer->user['center']}}</a></small>
                @endif
                @if($offer->user->ratingsValue()>=0)

                    <div class="rating-starts ml-1" title="{{$offer->user->ratingsValue()}}">
                        @for($i = 1; $i < 6; $i++)
                            <span class="float-left"><i
                                    class="text-warning fa {{$i>$offer->user->ratingsValue()?($i>$offer->user->ratingsValue()+0.5? 'fa-star-o': 'fa-star-half-o'):'fa-star'}}"></i></span>
                        @endfor
                    </div>
                @else
                    <div class="rating-starts ml-1">
                        <span class="text-danger"><small>{{__("Not Rated")}}</small></span>
                    </div>

                @endif
            @else
                <small class="enlace missing ml-1 mr-1">{{$offer->center}}{{__('Eliminated')}}</small>
            @endif


        </div>
        <div class="d-flex justify-content-center ">
            <h5 class="d-inline card-title w-auto  text-center">{{ $offer['name'] }} </h5>

        </div>


        <p class="card-text text-center"> {!! nl2br(e($offer->description_short)) !!}</p>
        <div class="buttons-group ">
            <a href="{{route("offers.show",$offer)}}" class="btn btn-sm btn-primary">{{__("See")}}</a>
            @if( Auth::user()&&( Auth::user()->can('admin')||  Auth::user()->id==$offer['user_id']))
                <a href="{{route("offers.edit",$offer)}}" class="btn btn-sm btn-success">{{__("Edit")}}</a>

                <button class="btn btn-sm btn-warning swalButton"
                        @if($offer->closed)
                        data-form-send="toogle-closed-form-{{$offer->id}}"
                        data-title-swal="{{__('Open')}}"
                        data-text-swal="{{__('Are you sure you want to open it?')}}"
                        data-type-swal="warning"
                        data-confirm-swal="{{__('Open')}}"
                        data-cancel-swal="{{__('Cancel')}}"
                        @else
                        data-form-send="toogle-closed-form-{{$offer->id}}"
                        data-title-swal="{{__('Close')}}"
                        data-text-swal="{{__('Are you sure you want to close it?')}}"
                        data-type-swal="warning"
                        data-confirm-swal="{{__('Close')}}"
                        data-cancel-swal="{{__('Cancel')}}"
                    @endif


                >
                    @if($offer->closed)
                        {{ __('Open') }}
                    @else
                        {{ __('Close') }}
                    @endif

                </button>



                <form id="toogle-closed-form-{{$offer->id}}" action="{{ route('offers.toogle',$offer) }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
                <button class="btn btn-sm btn-danger swalButton"
                        data-form-send="delete-form-{{$offer->id}}"
                        data-title-swal="{{__('Delete')}}"
                        data-text-swal="{{__('Are you sure you want to delete it?')}}"
                        data-type-swal="warning"
                        data-confirm-swal="{{__('Delete')}}"
                        data-cancel-swal="{{__('Cancel')}}"
                >
                    {{ __('Delete') }}

                </button>

                <form id="delete-form-{{$offer->id}}" action="{{ route('offers.delete',$offer) }}" method="POST"
                      style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    </div>
</div>
