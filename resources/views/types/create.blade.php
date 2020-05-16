@extends('layouts.app')

@section('content')


    <div class="container">
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
                            <div class="card-title text-center"><h1> {{ __('New Type') }} </h1></div>
                            <form method="POST" action="{{ route('types.store') }}">
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
