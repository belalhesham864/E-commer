<div>
    <img src="{{ asset($slider->file_name) }}" 
         alt="Slider Image" 
         class="img-thumbnail" 
         style="width: 120px; height: 70px; object-fit: cover; cursor: pointer;"
         data-toggle="modal" 
         data-target="#fullscreenModal{{ $slider->id }}">

    <div class="mt-1">
        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#fullscreenModal{{ $slider->id }}">
            <i class="fa fa-expand mr-1"></i> View Fullscreen
        </button>
    </div>
</div>

{{-- Fullscreen Modal --}}
<div class="modal fade" id="fullscreenModal{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel{{ $slider->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel{{ $slider->id }}">
                    Slider Image #{{ $slider->id }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img class="img-fluid rounded" src="{{ asset($slider->file_name) }}" alt="Slider Full Image">
            </div>
        </div>
    </div>
</div>
