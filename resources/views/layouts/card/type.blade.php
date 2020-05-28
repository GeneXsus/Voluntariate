<div class="card">
    <div class="card-body  card-button">
        <div class="d-flex flex-wrap-reverse justify-content-end">
            <h5 class="d-inline card-title w-auto mr-auto">{{ $type['name'] }} </h5>
        </div>


        <p class="card-text">{{ $type['description'] }}</p>
        <div class="buttons-group">
        @can('edit_type')
        <a href="{{route("types.edit",$type)}}" class="btn btn-sm btn-success">{{__("Edit")}}</a>
        @endcan
        @can('delete_type')
            <button class="btn btn-sm btn-danger swalButton"
                    data-form-send="delete-form-{{$type->id}}"
                    data-title-swal="{{__('Delete')}}"
                    data-text-swal="{{__('Are you sure you want to delete it?')}}"
                    data-type-swal="warning"
                    data-confirm-swal="{{__('Delete')}}"
                    data-cancel-swal="{{__('Cancel')}}"
            >
                {{ __('Delete') }}

            </button>

            <form id="delete-form-{{$type->id}}" action="{{ route('types.delete',$type) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endcan
        </div>
    </div>
</div>
