<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-auto mr-auto">{{ $offer['name'] }} </h5>
            <small class="text-muted text-right ">{{$offer->type['name']??__('Unspecified')}}</small>
        </div>


        <p class="card-text">{{ $offer['description_short'] }}</p>
        <a href="{{route("offers.show",$offer)}}" class="btn btn-primary">{{__("See")}}</a>
        @if(   Auth::user()->can('admin')||  Auth::user()->id==$offer['user_id'])
            <a href="{{route("offers.edit",$offer)}}" class="btn btn-success">{{__("Edit")}}</a>
            <button class="btn btn-warning"
               onclick="event.preventDefault();document.getElementById('toogle-closed-form-{{$offer->id}}').submit();">
                @if($offer->closed)
                    {{ __('Open') }}
                    @else
                    {{ __('Close') }}
                @endif
            </button>

            <form id="toogle-closed-form-{{$offer->id}}" action="{{ route('offers.toogle',$offer) }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button class="btn btn-warning"
               onclick="event.preventDefault();document.getElementById('delete-form-{{$offer->id}}').submit();">
             {{ __('Delete') }}

            </button>

            <form id="delete-form-{{$offer->id}}" action="{{ route('offers.toogle',$offer) }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </div>
</div>
