@extends('layouts.app')

@section('content')
    <div class="container-fluid">
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
                        <div class="tab-pane fade show active" id="nav-users" role="tabpanel"
                             aria-labelledby="nav-users-tab">
                            @forelse ($usersUser as $user)
                                @include('layouts.card.user')
                            @empty
                                @include('layouts.card.empty', ['message' => __('there are no users')])
                            @endforelse
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
