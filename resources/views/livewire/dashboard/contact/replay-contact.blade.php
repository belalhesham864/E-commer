<div class="modal" id="replayContactModal" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Replay Message</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="replayContent" class="form">
                @csrf

                <div class="modal-body">
                    <input type="hidden" wire:model="id">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" wire:model="email" disabled>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" class="form-control" wire:model="subject" disabled>
                    </div>

                    <div class="form-group">
                        <label for="replayMessage">Replay</label>
                        <textarea wire:model.live="replayMessage" name="replayMessage" class="form-control"></textarea>
                        @error('replayMessage')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span wire:loading.remove wire:target="replayContent">Send</span>
                        <span wire:loading wire:target="replayContent">Sending...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
