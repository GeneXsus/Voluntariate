@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-12 d-flex mb-3 justify-content-end">
                <a class="btn  btn-outline-primary" href="{{route('offers.create')}}" role="button">{{__('New Offer')}}</a>
            </div>
        </div>
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class=" card-header justify-content-center" >
                        <h1 class="card-title">{{__("Types")}}</h1>
                    </div>


                            <div class="card-body" >
                                @forelse ($offers as $offer)
                                    @include('layouts.card.type')
                                @empty
                                    @include('layouts.card.empty', ['message' => __('there is no type ')])
                                @endforelse
                            </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
