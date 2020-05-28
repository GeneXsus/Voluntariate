<nav class="navbar navbar-expand-md navbar-light shadow-sm cabecera">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item">
                        <a class="dropdown-item nav-link {{ (strpos(Route::currentRouteName(), 'offers') === 0) ? 'active' : '' }}" href="{{route('offers.index') }}">
                            {{ __('Manage Offers') }}
                        </a>
                    </li>
                    @if(auth()->user()->can('create_type')|| auth()->user()->can('edit_type') || auth()->user()->can('delete_type'))
                    <li class="nav-item">
                        <a class="dropdown-item nav-link {{ (strpos(Route::currentRouteName(), 'types') === 0) ? 'active' : '' }}" href="{{route('types.index') }}">
                            {{ __('Manage Types') }}
                        </a>
                    </li>
                    @endif
                    @can('admin')

                        <li class="nav-item">
                            <a class="dropdown-item nav-link {{ (strpos(Route::currentRouteName(), 'users') === 0) ? 'active' : '' }}" href="{{route('users.index') }}">
                                {{ __('Manage User') }}
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item dropdown slideToogle">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>


                            {{ Auth::user()->center? Auth::user()->center: Auth::user()->name.' '.Auth::user()->subname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu  dropdown-menu-right animated fadeInUp" aria-labelledby="navbarDropdown">
                            @if(!Auth::user()->hasRole('Administrator'))
                            <a class="internal dropdown-item nav-link {{ (Route::currentRouteName() =='users.editSelf') ? 'active' : '' }}" href="{{route('users.editSelf',Auth::user()) }}">
                                {{ __('Edit Profile') }}
                            </a>
                            @endif


                            <a class="internal dropdown-item nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest

                @if (config('locale.status') && count(config('locale.languages')) > 1)
                    <li class="nav-item ">
                        @foreach (array_keys(config('locale.languages')) as $lang)
                            @if ($lang != App::getLocale())
                                <a  class="nav-link" href="{!! route('lang.swap', $lang) !!}">
                                    <img class="language" src="/assets/img/language/{!! $lang !!}.svg" alt="{!! $lang !!}">
                                </a>
                            @endif
                        @endforeach
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
