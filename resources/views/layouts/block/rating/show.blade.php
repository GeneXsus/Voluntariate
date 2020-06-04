<div class="card">
    <a class="collapse-head" data-toggle="collapse"  href="#ratings" role="button" aria-expanded="false" aria-controls="ratings">


        <div class="card-header" id="ratingHeader">
            <h5 class="mb-0 d-flex justify-content-center">
                <button class="btn btn-link buttons-for-colapse d-flex flex-wrap justify-content-center">
                    <span class="mr-1 ">{{$ratingTitle}}</span>
                    @if($rating_value>=0)

                        <div class="rating-starts ml-1" title="{{$rating_value}}">
                            @for($i = 1; $i < 6; $i++)
                                <span class="float-left"><i
                                        class="text-warning fa {{$i>$rating_value?($i>$rating_value+0.5? 'fa-star-o': 'fa-star-half-o'):'fa-star'}}"></i></span>
                            @endfor

                        </div>
                    @else
                        <div class="rating-starts">
                            <span class="text-danger"><small>{{__("Not Rated")}}</small></span>
                        </div>

                    @endif
                </button>
            </h5>
        </div>
    </a>

    <div id="ratings" class="collapse {{$show??''}}">
        <div class="card-body">
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
@if(isset($canRate) && $canRate)
    @include('layouts.block.rating.write', ['ratings' => $user->ratings])
@endif





