@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header ">
                        <div class="nav nav-tabs card-header-tabs justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link @if(old('type') !="company")active @endif" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="true">{{ __('auth.user') }} </a>
                            <a class="nav-item nav-link @if(old('type') =="company")active @endif" id="nav-company-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company" aria-selected="false">{{ __('auth.company') }} </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade @if(old('type') !="company") show active @endif" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                                <div class="card-title text-center"> <h1> {{ __('auth.registerUser') }}</h1></div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input id="type-user" type="hidden"
                                           class="form-control" name="type"
                                           value="user">
                                    <div class="form-group row">
                                        <label for="name-user" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name-user" type="text"
                                                   class="form-control @error('name') is-invalid @enderror" name="name"
                                                   value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                                   value="{{ old('subname') }}" required autocomplete="subname" autofocus>

                                            @error('subname')
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
                                                    <option value="{{ $location['nm'] }}" {{ (old("location") == $location['nm'] ? "selected":"") }}>{{ $location['nm'] }}</option>
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
                                        <label
                                            class="col-md-4 col-form-label text-md-right">{{ __('Desired types') }}</label>

                                        <div class="col-md-6">
                                            <div class="types-group">
                                                @foreach($types as $type)
                                                    <div class="form-check form-check-inline"
                                                         title="{{$type->description}}">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="type{{$type->id}}" name="types[]"

                                                               @if((is_array(old('types')) && in_array($type->id, old('types')))) checked @endif
                                                               value="{{$type->id}}">
                                                        <label class="form-check-label"
                                                               for="type{{$type->id}}">{{$type->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description-es-user" class="col-md-4 col-form-label text-md-right">{{ __('Description (Spanish)') }}</label>

                                        <div class="col-md-6">

                                            <textarea class="form-control   @error('descriptionEs') is-invalid @enderror" name="descriptionEs"
                                                      required autocomplete="descriptionEs" id="description-es-user" name="descriptionEs" rows="3">{{ old('descriptionEs') }}</textarea>
                                            @error('descriptionEs')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descriptionEn-user" class="col-md-4 col-form-label text-md-right">{{ __('Description (English)') }}</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control   @error('descriptionEn') is-invalid @enderror" name="descriptionEn"
                                                      required autocomplete="descriptionEn" id="descriptionEn-user" name="descriptionEn" rows="3">{{ old('descriptionEn') }}</textarea>
                                            @error('descriptionEn')
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
                                                   value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-user"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-user" type="password"
                                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                                   required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm-user"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm-user" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade @if(old('type') =="company")show active @endif" id="nav-company" role="tabpanel" aria-labelledby="nav-company-tab">
                                <div class="card-title text-center"> <h1> {{ __('auth.registerCompany') }} </h1></div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input id="type-company" type="hidden"
                                           class="form-control" name="type"
                                           value="company">

                                    <div class="form-group row">
                                        <label for="center-company" class="col-md-4 col-form-label text-md-right">{{ __('Name Company') }}</label>
                                        <div class="col-md-6">
                                            <input id="center-company" type="text"
                                                   class="form-control @error('center') is-invalid @enderror" name="center"
                                                   value="{{ old('center') }}" required autocomplete="center" autofocus>
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
                                                      required autocomplete="descriptionEs" id="description-es-company" name="descriptionEs" rows="3">{{ old('descriptionEs') }}</textarea>
                                            @error('descriptionEs')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="descriptionEn" class="col-md-4 col-form-label text-md-right">{{ __('Description (English)') }}</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control   @error('descriptionEn') is-invalid @enderror" name="descriptionEn"
                                                      required autocomplete="descriptionEn" id="descriptionEn" name="descriptionEn" rows="3">{{ old('descriptionEn') }}</textarea>
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
                                        <textarea class="form-control" id="direction-company" name="direction" rows="3"  required autocomplete="direction">{{ old('direction') }}</textarea>
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
                                                    <option value="{{ $location['nm'] }}" {{ (old("location") == $location['nm'] ? "selected":"") }}>{{ $location['nm'] }}</option>
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
                                                   value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-company"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-company" type="password"
                                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                                   required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm-company"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm-company" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
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
    </div>
@endsection
