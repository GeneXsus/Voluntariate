<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-auto mr-auto">{{ $type['name'] }} </h5>
        </div>


        <p class="card-text">{{ $type['description_short'] }}</p>
        <a href="{{route("types.show",$type)}}" class="btn btn-primary">{{__("See")}}</a>
        @if(   Auth::user()->can('admin'))
            <a href="{{route("types.edit",$type)}}" class="btn btn-success">{{__("Edit")}}</a>
            <button class="btn btn-warning"
               onclick="event.preventDefault();document.getElementById('delete-form-{{$type->id}}').submit();">
                    {{ __('Delete') }}
            </button>

            <form id="t-form-{{$type->id}}" action="{{ route('types.delete',$type) }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endif
    </div>
</div>
