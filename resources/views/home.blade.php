@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">


        @foreach ($offers as $offer)
                <div class="col-12 col-md-6 col-xl-4 mt-3 mb-3">
                @include('layouts.card.offer')
                </div>
        @endforeach


    </div>
</div>
@endsection
