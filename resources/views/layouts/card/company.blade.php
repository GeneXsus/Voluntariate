<div class="card">
    <div class="card-body  card-button">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-100 text-center">{{ $user['center']." | ".$user['location'].(Auth::user()->hasRole('Administrator')?" | ".$user['email']:'')}}  </h5>
            <h5 class="d-inline card-title w-100 text-center">{{ $user['center']." | ".$user['location'].(Auth::user()->hasRole('Administrator')?" | ".$user['email']:'')}}  </h5>
        </div>

        <div class="buttons-group">
            <a href="{{route("users.show",$user)}}" class="btn btn-sm btn-primary">{{__("See")}}</a>
            @can('edit_user')
                <a href="{{route("users.edit",$user)}}" class="btn btn-sm btn-success">{{__("Edit")}}</a>
            @endcan
            @can('delete_user')
                <button class="btn btn-sm btn-danger swalButton"
                        data-form-send="delete-form-{{$user->id}}"
                        data-title-swal="{{__('Delete')}}"
                        data-text-swal="{{__('Are you sure you want to delete it?')}}"
                        data-type-swal="warning"
                        data-confirm-swal="{{__('Delete')}}"
                        data-cancel-swal="{{__('Cancel')}}"
                >
                    {{ __('Delete') }}

                </button>

                <form id="delete-form-{{$user->id}}" action="{{ route('users.delete',$user) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endcan
        </div>


    </div>
</div>
