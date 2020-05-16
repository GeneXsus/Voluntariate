@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @foreach ($offers as $offer)
                @include('layouts.card.offer')
        @endforeach
        </div>

    </div>
</div>
@endsection
