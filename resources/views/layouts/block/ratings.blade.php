<div class="row  justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class=" card-header justify-content-center" >
                <h1 class="card-title text-center">{{__("Ratings")}}</h1>
            </div>


            <div class="card-body" >
                <div class="row d-flex justify-content-center">




                    @forelse ($ratings as $rating)
                        <div class="col-12 col-sm-6 col-lg-4 mt-3 mb-3">
                            @include('layouts.card.rating')
                        </div>
                    @empty
                        <div class="col-12">
                            @include('layouts.card.empty', ['message' => __('there is any rating')])
                        </div>
                    @endforelse
                </div>
            </div>

        </div>


    </div>
</div>




