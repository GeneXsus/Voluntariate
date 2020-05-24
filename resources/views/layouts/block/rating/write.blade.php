@if(Auth::user()->can('write_rating') && Auth::user()->id != $user->id)
    <div class="card mt-3 mb-3">
        <div class="card-header">
            <h2 class="card-title  text-center ">
           {{__("Write Rating")}}
            </h2>
        </div>
        <div class="card-body">


            <form method="POST" action="{{ route('ratings.store') }}">

                @csrf
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                @endif
                <input type="hidden" name="id_user" value="{{$user->id}}">

                <div class="form-group row mb-2">
                    <label
                           class="col-md-4 col-form-label text-md-right">{{ __('Rate') }}</label>


                    <div class="rating-form col-md-6 pt-1">
                        <label title="{{__('Very Good')}}">
                            <input type="radio" name="rate" value="5" title="5 stars"> 5
                        </label>
                        <label title="{{__('Good')}}">
                            <input type="radio" name="rate" value="4" title="4 stars"> 4
                        </label>

                        <label title="{{__('Average')}}">
                            <input type="radio" name="rate" value="3" title="3 stars"> 3
                        </label>
                        <label title="{{__('Poor')}}">
                            <input type="radio" name="rate" value="2" title="2 stars"> 2
                        </label>
                        <label title="{{__('Very Poor')}}">
º
                            <input type="radio" name="rate" value="1" title="1 star"> 1
                        </label>



                    </div>
                </div>
                <div class="form-group row ">
                    <label for="description-rating"
                           class="col-md-4 col-form-label text-md-right">{{ __('Commentary') }}</label>

                    <div class="col-md-6">

                                        <textarea class="form-control   @error('description') is-invalid @enderror"
                                                  name="description"
                                                  required autocomplete="descriptionEs" id="-rating"
                                                  rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback  d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                        @enderror
                    </div>
                </div>





                <div class="form-group row mb-0">
                    <div class="col-md-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Public') }}
                        </button>
                    </div>
                </div>
            </form>




        </div>
    </div>

    @endif

