     <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#fullscreenModal{{ $page->id }}">
            <i class="fa fa-expand mr-1"></i> View Fullscreen
        </button>

{{-- Fullscreen Modal --}}
<div class="modal fade" id="fullscreenModal{{ $page->id }}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel{{ $page->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel{{ $page->id}}">
                    Page Content #{{ $page->title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
               <div class="active">
                {!! $page->content !!}
               </div>
            </div>
        </div>
    </div>
</div>
