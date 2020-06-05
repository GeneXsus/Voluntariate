<a class="collapse-head" data-toggle="collapse" href="#{{$name}}" role="button"
   aria-expanded="false"
   aria-controls="{{$name}}">


    <div class="card-header" id="{{$name}}Header">
        <h5 class="mb-0 d-flex justify-content-center">
            <button class="btn btn-link buttons-for-colapse">
                {{$title}}
            </button>
        </h5>
    </div>
</a>

<div id="{{$name}}" class="collapse {{$show??''}}">
    <div class="card-body">
        <div class="row d-flex justify-content-center">
            @forelse($filesVideo as $video)
            <div class="col-12 col-sm-6 col-lg-4 mt-3 mb-3">
                <video class="w-100" controls>
                    <source src="{{asset("assets/video/$name/$video")}}">
                </video>
            </div>
            @empty
                <div class="col-12">
                    @include('layouts.card.empty', ['message' => __('there is any video')])
                </div>
            @endforelse


        </div>
    </div>
</div>
