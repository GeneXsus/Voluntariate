@extends('layouts.app')

@section ('content')
    <div id="wrapper">
        <div id="page" class="container-fluid">
            <div id="content">
                <div class="title">
                    <h2>{{$offer->name}}</h2>
                    <span class="byline">Mauris vulputate dolor sit amet nibh</span> </div>

                <p>{{$offer->description}}</p>
            </div>
            </div>
        </div>

@endsection
