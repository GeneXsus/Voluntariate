@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                @if ($user->hasRole('User'))
                <div class="title">
                    <h2>{{$user->name}} {{$user->subname}}</h2>
                    <p>{{$user->description}}</p>
                    <p>{{$user->location}}</p>
                    @if (Auth::user()->hasRole('Administrator'))
                        <p>{{$user->email}}</p>
                    @endif



                @elseif ($user->hasRole('Company'))
                        <h2>{{$user->center}}</h2>
                        <p>{{$user->description}}</p>
                        <p>{{$user->location}}</p>
                        <p>{{$user->direction}}</p>
                        @if (Auth::user()->hasRole('Administrator'))
                            <p>{{$user->email}}</p>
                        @endif

                @endif
                @include('layouts.block.ratings', ['ratings' => $user->ratings])
            </div>
            </div>
        </div>

@endsection
