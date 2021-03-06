<div class="card mt-3 mb-3">
    <div class="card-body  card-button">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-auto mr-auto">
                <a href="{{route('users.show',["user"=>$rating->userRated])}}">{{$rating->userRated->hasRole('Company')? $rating->userRated->center: $rating->userRated->name." ".$rating->userRated->subname}}
                </a>
            </h5>
            <div class="rating-starts">
                @for($i = 0; $i < 5; $i++)
                    <span class="float-left"><i class="text-warning fa {{$i>=$rating->rate?'fa-star-o':'fa-star'}}"></i></span>
                @endfor
            </div>
        </div>
        <p>
            {!! nl2br(e($rating->description)) !!}
        </p>

        @if(Auth::user()->can('delete_user') ||Auth::user()->id==$rating->userRated->id)
            <div class="buttons-group ">
            <button class="btn btn-sm btn-danger swalButton"
                    data-form-send="delete-form-{{$rating->userRated->id}}-{{$rating->userRating->id}}"
                    data-title-swal="{{__('Delete')}}"
                    data-text-swal="{{__('Are you sure you want to delete it?')}}"
                    data-type-swal="warning"
                    data-confirm-swal="{{__('Delete')}}"
                    data-cancel-swal="{{__('Cancel')}}"
            >
                {{ __('Delete') }}

            </button>

            <form id="delete-form-{{$rating->userRated->id}}-{{$rating->userRating->id}}" action="{{ route('ratings.delete',['userRated'=>$rating->userRated->id,'userRating'=>$rating->userRating->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            </div>
        @endcan



    </div>
</div>
