<div>
    <img src="{{ asset($page->image) }}"
         alt="Page Image"
         class="img-thumbnail"
         style="width: 120px; height: 70px; object-fit: cover; cursor: pointer;"
         data-toggle="modal"
         data-target="#fullscreenModal{{ $page->id }}">

    <div class="mt-1">
        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#fullscreenModal2{{ $page->id }}">
            <i class="fa fa-expand mr-1"></i> View Fullscreen
        </button>
    </div>
</div>

{{-- Fullscreen Modal --}}
<div class="modal fade" id="fullscreenModal2{{ $page->id }}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel{{ $page->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel{{ $page->id}}">
                    Page Image #{{ $page->title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img class="img-fluid rounded" src="{{ asset($page->image) }}" alt="Page Full Image">
            </div>
        </div>
    </div>
</div>
