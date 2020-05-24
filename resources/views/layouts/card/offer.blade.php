<div class="card h-100">
    <div class="card-body card-button">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-auto mr-auto">{{ $offer['name'] }} </h5>
            <small class="text-muted text-right ">{{$offer->type['name']??__('Unspecified')}}</small>
            @if ($offer->user)
                <small class="text-muted text-right "> <a href="{{route("users.show",$offer->user)}}"
                                                          class="enlace ml-1 mr-1">{{$offer->user['center']}}</a></small>
                @if($offer->user->ratingsValue()>=0)

                    <div class="rating-starts">
                        @for($i = 1; $i < 6; $i++)
                            <span class="float-left"><i
                                    class="text-warning fa {{$i>$offer->user->ratingsValue()?'fa-star-o':'fa-star'}}"></i></span>
                        @endfor
                        <small class="ml-1">{{$offer->user->ratingsValue()}}</small>
                    </div>
                @endif
            @else
                <small class="enlace missing ml-1 mr-1">{{__('Missing User')}}</small>
            @endif

        </div>


        <p class="card-text">{{ $offer['description_short'] }}</p>
        <div class="buttons-group ">
            <a href="{{route("offers.show",$offer)}}" class="btn btn-primary">{{__("See")}}</a>
            @if( Auth::user()&&( Auth::user()->can('admin')||  Auth::user()->id==$offer['user_id']))
                <a href="{{route("offers.edit",$offer)}}" class="btn btn-success">{{__("Edit")}}</a>

                <button class="btn btn-warning swalButton"
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
                <button class="btn btn-danger swalButton"
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
