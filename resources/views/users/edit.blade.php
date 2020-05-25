
@extends('layouts.app')

@section('content')


    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="tab-content mt-3">
                            <div class="card-title text-center"><h1> {{ __('Edit User') }} </h1></div>




                            <form method="POST" action="{{ route('users.update',['user' => $user])  }} ">
                                @csrf
                                @method('PUT')
                                    @if ($user->hasRole('User'))


                                        <div class="form-group row">
                                            <label for="name-user" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name-user" type="text"
                                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                                       value="{{ old('name')??  $user->name}}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="subname-user"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Subname') }}</label>

                                            <div class="col-md-6">
                                                <input id="subname-user" type="text"
                                                       class="form-control @error('subname') is-invalid @enderror" name="subname"
                                                       value="{{ old('subname')??  $user->subname}}" required autocomplete="subname" autofocus>

                                                @error('subname')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <label for="description-es-user" class="col-md-4 col-form-label text-md-right">{{ __('Description (Spanish)') }}</label>

                                        <div class="col-md-6">

                                                <textarea class="form-control   @error('descriptionEs') is-invalid @enderror" name="descriptionEs"
                                                          required autocomplete="descriptionEs" id="description-es-user" name="descriptionEs" rows="3">{{ old('descriptionEs')??  $user->getTranslation('description', 'es')}}</textarea>
                                            @error('descriptionEs')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description-en-user" class="col-md-4 col-form-label text-md-right">{{ __('Description (English)') }}</label>
                                        <div class="col-md-6">
                                                <textarea class="form-control   @error('descriptionEn') is-invalid @enderror" name="descriptionEn"
                                                          required autocomplete="descriptionEn" id="description-en-user" name="descriptionEn" rows="3"> {{ old('descriptionEn')??  $user->getTranslation('description', 'en')}}</textarea>
                                            @error('descriptionEn')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="form-group row">
                                            <label for="location-user"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="location" id="location-user" required>
                                                    <option selected disabled>{{ __('Select Province') }} </option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location['nm'] }}" {{ ((old('location')??  $user->location) == $location['nm'] ? "selected":"") }}>{{ $location['nm'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email-user"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email-user" type="email"
                                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ old('email')??  $user->email }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                    @elseif ($user->hasRole('Company'))

                                        <div class="form-group row">
                                            <label for="center-company" class="col-md-4 col-form-label text-md-right">{{ __('Name Company') }}</label>
                                            <div class="col-md-6">
                                                <input id="center-company" type="text"
                                                       class="form-control @error('center') is-invalid @enderror" name="center"
                                                       value="{{  old('center')??  $user->center }}" required autocomplete="center" autofocus>
                                                @error('center')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description-es-company" class="col-md-4 col-form-label text-md-right">{{ __('Description (Spanish)') }}</label>

                                            <div class="col-md-6">

                                                <textarea class="form-control   @error('descriptionEs') is-invalid @enderror" name="descriptionEs"
                                                          required autocomplete="descriptionEs" id="description-es-company" name="descriptionEs" rows="3">{{ old('descriptionEs')??  $user->getTranslation('description', 'es')}}</textarea>
                                                @error('descriptionEs')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description-en-company" class="col-md-4 col-form-label text-md-right">{{ __('Description (English)') }}</label>
                                            <div class="col-md-6">
                                                <textarea class="form-control   @error('descriptionEn') is-invalid @enderror" name="descriptionEn"
                                                          required autocomplete="descriptionEn" id="description-en-company" name="descriptionEn" rows="3"> {{ old('descriptionEn')??  $user->getTranslation('description', 'en')}}</textarea>
                                                @error('descriptionEn')
                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="direction-company"class="col-md-4 col-form-label text-md-right">{{ __('Direction') }}</label>
                                            <div class="col-md-6">
                                                <textarea class="form-control" id="direction-company" name="direction" rows="3"  required autocomplete="direction">{{ old('direction')??  $user->direction  }}</textarea>
                                                @error('direction')
                                                <span class="invalid-feedback" role="alert">
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
                                                        <option value="{{ $location['nm'] }}" {{ ((old('location')??  $user->location )== $location['nm'] ? "selected":"") }}>{{ $location['nm'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('location')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email-company"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email-company" type="email"
                                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ old('email')??  $user->email  }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                     @endif

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Edit') }}
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
