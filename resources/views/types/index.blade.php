@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center ">
            <div class="col-12 d-flex mb-3 justify-content-end">
                @can('create_type')
                    <a class="btn  btn-outline-primary" href="{{route('types.create')}}" role="button">{{__('New Type')}}</a>
                @endcan

            </div>
        </div>
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class=" card-header justify-content-center" >
                        <h1 class="card-title text-center">{{__("Types")}}</h1>
                    </div>


                            <div class="card-body" >
                                <div class="row d-flex justify-content-center">




                                @forelse ($types as $type)
                                    <div class="col-12 col-sm-6 col-xl-4 mt-3 mb-3">
                                        @include('layouts.card.type')
                                    </div>
                                @empty
                                    <div class="col-12">
                                        @include('layouts.card.empty', ['message' => __('there is no type ')])
                                    </div>
                                @endforelse
                                </div>
                            </div>

                    </div>


                </div>
            </div>
        </div>

@endsection
