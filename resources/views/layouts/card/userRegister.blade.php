<div class="card">
    <div class="card-body  card-button">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-auto mr-auto">{{ $user['name']." ".$user['subname'].(Auth::user()->hasRole('Administrator')?" | ".$user['email']:'')}} </h5>
            @if($user->ratingsValue()>=0)

                <div class="rating-starts" title="{{$user->ratingsValue()}}">
                    @for($i = 1; $i < 6; $i++)
                        <span class="float-left"><i
                                class="text-warning fa {{$i>$user->ratingsValue()?($i>$user->ratingsValue()+0.5? 'fa-star-o': 'fa-star-half-o'):'fa-star'}}"></i></span>
                    @endfor

                </div>
            @else
                <div class="rating-starts">
                    <span class="text-danger"><small>{{__("Not Rated")}}</small></span>
                </div>

            @endif
        </div>
        <div class="buttons-group ">
            <a href="{{route("users.show",$user)}}" class="btn btn-primary">{{__("See")}}</a>

            @if($user->pivot->acepted)

                <button class="btn btn-danger  swalButton"
                        data-form-send="refuse-form-{{$user->id}}"
                        data-title-swal="{{__('Refuse')}}"
                        data-text-swal="{{__('Are you sure you want to refuse him?')}}"
                        data-type-swal="warning"
                        data-confirm-swal="{{__('Refuse')}}"
                        data-cancel-swal="{{__('Cancel')}}"
                >
                    {{__('Refuse')}}
                </button>

                <form id="refuse-form-{{$user->id}}" action="{{ route('offers.refuse',['offer'=>$offer,'user'=>$user]) }}"
                      method="POST"
                      style="display: none;">
                    @csrf
                </form>
            @else
                <button class="btn btn-success  swalButton"
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

            @endif

        </div>
    </div>
</div>
