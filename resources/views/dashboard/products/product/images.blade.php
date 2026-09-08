<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($row->images as $key => $image)
            <div class="carousel-item @if ($key == 0) active @endif">
                <img class="d-block w-100" src="{{ asset('uploads/products/' . $image->file_name) }}" alt="First slide">
            </div>
        @endforeach

    </div>
                        @if($row->images->count() >1)

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    @endif
    <div class="mt-1">
        <button class="btn btn-outline-primary" data-toggle="modal"   data-target="#fullscreenModal{{ $row->id }}"
            <i class="fa fa-expand"> View Fullscreen</i>

        </button>
    </div>
</div>

{{-- Fullscreen Modal --}}
<div class="modal fade" id="fullscreenModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="fullscreenModalLabel">
        {{ $row->name }} Images
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div id="fullscreenCarousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">

                        @foreach ($row->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">

                            <img class="d-block w-100" src="{{ asset('uploads/products/' . $image->file_name) }}" alt="First slide">


                            </div>
                        @endforeach

                    </div>
                        @if($row->images->count() >1)

                    {{-- Previous --}}
                    <a class="carousel-control-prev" href="#fullscreenCarousel" role="button" data-slide="prev">

                        <span class="carousel-control-prev-icon" aria-hidden="true">
                        </span>

                        <span class="sr-only">
                            Previous
                        </span>

                    </a>

                    {{-- Next --}}
                    <a class="carousel-control-next" href="#fullscreenCarousel" role="button" data-slide="next">

                        <span class="carousel-control-next-icon" aria-hidden="true">
                        </span>

                        <span class="sr-only">
                            Next
                        </span>

                    </a>
@endif
                </div>

            </div>

        </div>

    </div>

</div>
