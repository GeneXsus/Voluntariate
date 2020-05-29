<form class="form d-flex w-100 align-items-center flex-sm-nowrap flex-wrap mt-1 mb-1" action="{{Request::fullUrl()}}">
    <input class="form-control mr-sm-2 w-100" type="search" name="search" placeholder="{{__('Search')}}" aria-label="Search" value="{{$search??''}}" >
    <button class="btn btn-outline-success searchButton my-2 my-sm-0" type="submit">{{__('Search')}}</button>
</form>
