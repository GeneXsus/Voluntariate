@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('layouts.block.search')
        <div class="row  justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="nav nav-tabs card-header-tabs justify-content-center" id="nav-tab" role="tablist">

                            <a class="nav-item nav-link active " id="nav-users-tab" data-toggle="tab"
                               href="#nav-users" role="tab" aria-controls="nav-users"
                               aria-selected="true">{{ __('Users') }} </a>

                        <a class="nav-item nav-link " id="nav-company-tab" data-toggle="tab" href="#nav-company"
                           role="tab" aria-controls="nav-company" aria-selected="false">{{ __('Companies') }} </a>
                    </div>
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active " id="nav-users" role="tabpanel"
                             aria-labelledby="nav-users-tab">
                            <div class="d-flex w-100 flex-wrap justify-content-around align-items-center">
                                @forelse ($usersUser as $user)
                                    <div class="col-12 col-md-6 mt-3 mb-3">
                                        @include('layouts.card.user')
                                    </div>
                                @empty
                                    <div class="col-12 col-md-6">
                                        @include('layouts.card.empty', ['message' => __('there are no users')])
                                    </div>
                                @endforelse
                            </div>




                        </div>


                        <div class="tab-pane fade " id="nav-company" role="tabpanel" aria-labelledby="nav-company-tab">
                            @forelse ($usersCompany as $user)
                                @include('layouts.card.company')
                            @empty
                                @include('layouts.card.empty', ['message' => __('there are no companies')])
                            @endforelse
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
