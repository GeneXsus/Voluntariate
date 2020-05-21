@extends('layouts.app')

@section('content')


    <div class="container-fluid">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="tab-content mt-3">
                            <div class="card-title text-center"><h1> {{ __('New Offer') }} </h1></div>
                            <form method="POST" action="{{ route('offers.store') }}">
                                @csrf
                                <input id="type-company" type="hidden"
                                       class="form-control" name="type"
                                       value="company">

                                <div class="form-group row">
                                    <label for="nameEs"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name (Spanish)') }}</label>
                                    <div class="col-md-6">
                                        <input id="nameEs" type="text"
                                               class="form-control @error('nameEs') is-invalid @enderror" name="nameEs"
                                               value="{{ old('nameEs') }}" required autocomplete="nameEs" autofocus>
                                        @error('nameEs')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nameEn"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name (English)') }}</label>
                                    <div class="col-md-6">
                                        <input id="nameEn" type="text"
                                               class="form-control @error('nameEn') is-invalid @enderror" name="nameEn"
                                               value="{{ old('nameEn') }}" required autocomplete="nameEn" autofocus>
                                        @error('nameEn')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="type"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="type" id="type" required>
                                            <option selected disabled>{{ __('Select Type') }} </option>
                                            @foreach ($types as $type)
                                                <option title="{{$type['description']}}"
                                                    value="{{ $type['id'] }}" {{ (old("type") == $type['id'] ? "selected":"") }}>{{ $type['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback  d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description-short-es"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Description short (Spanish)') }}</label>

                                    <div class="col-md-6">

                                        <textarea class="form-control   @error('descriptionShortEs') is-invalid @enderror"
                                                  name="descriptionShortEs"
                                                  required autocomplete="descriptionShortEs" id="description-short-es"
                                                  name="descriptionShortEs" rows="3">{{ old('descriptionShortEs') }}</textarea>
                                        @error('descriptionShortEs')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descriptionShortEn"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Description short (English)') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control   @error('descriptionShortEn') is-invalid @enderror"
                                                  name="descriptionShortEn"
                                                  required autocomplete="descriptionShortEn" id="descriptionShortEn"
                                                  name="descriptionShortEn" rows="3">{{ old('descriptionShortEn') }}</textarea>
                                        @error('descriptionShortEn')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description-es"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Description (Spanish)') }}</label>

                                    <div class="col-md-6">

                                        <textarea class="form-control   @error('descriptionEs') is-invalid @enderror"
                                                  name="descriptionEs"
                                                  required autocomplete="descriptionEs" id="description-es"
                                                  name="descriptionEs" rows="3">{{ old('descriptionEs') }}</textarea>
                                        @error('descriptionEs')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="descriptionEn"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Description (English)') }}</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control   @error('descriptionEn') is-invalid @enderror"
                                                  name="descriptionEn"
                                                  required autocomplete="descriptionEn" id="descriptionEn"
                                                  name="descriptionEn" rows="3">{{ old('descriptionEn') }}</textarea>
                                        @error('descriptionEn')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="location-company"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="location" id="location-company" required>
                                            <option selected disabled>{{ __('Select Province') }} </option>
                                            @foreach ($locations as $location)
                                                <option
                                                    value="{{ $location['nm'] }}" {{ (old("location") == $location['nm'] ? "selected":"") }}>{{ $location['nm'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                        <span class="invalid-feedback  d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="places"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Places') }}</label>
                                    <div class="col-md-6">
                                        <input id="places" type="number"
                                               class="form-control @error('places') is-invalid @enderror" name="places"
                                               value="{{ old('places') }}" required autocomplete="places">
                                        @error('places')
                                        <span class="invalid-feedback  d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="init_date"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Init Date') }}</label>

                                    <div class="col-md-6">
                                        <input class="date form-control"  type="date" id="init_date" name="init_date"  value="{{ old('init_date') }}">


                                        @error('init_date')
                                            <span class="invalid-feedback  d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date"
                                           class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                                    <div class="col-md-6">
                                        <input class="date form-control"  type="date" id="end_date" name="end_date"  value="{{ old('end_date') }}">


                                        @error('end_date')
                                        <span class="invalid-feedback  d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Create') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
