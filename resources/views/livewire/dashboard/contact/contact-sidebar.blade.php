<div class="email-app-menu col-md-5 card d-none d-lg-block">

    <h6 class="text-muted text-bold-500 mb-1">Messages</h6>

    <div class="list-group list-group-messages">

        <a wire:click="selectSecreen('inbox')"
           href="#"
           class="list-group-item @if($screen == 'inbox') active @endif border-0">
            <i class="ft-inbox mr-1"></i>
            Inbox
            @if($inboxCount > 0)
                <span class="badge badge-secondary badge-pill float-right">{{ $inboxCount }}</span>
            @endif
        </a>

        <a wire:click="selectSecreen('readed')"
           href="#"
           class="list-group-item @if($screen == 'readed') active @endif border-0">
            <i class="la la-paper-plane-o mr-1"></i>
            Readed
            @if($readedCount > 0)
                <span class="badge badge-info badge-pill float-right">{{ $readedCount }}</span>
            @endif
        </a>

        <a wire:click="selectSecreen('replay')"
           href="#"
           class="list-group-item @if($screen == 'replay') active @endif border-0">
            <i class="ft-file mr-1"></i>
            Replayed
            @if($replayCount > 0)
                <span class="badge badge-success badge-pill float-right">{{ $replayCount }}</span>
            @endif
        </a>

        <a wire:click="selectSecreen('Starred')"
           href="#"
           class="list-group-item @if($screen == 'Starred') active @endif border-0">
            <i class="ft-star mr-1"></i>
            Starred
            @if($starCount > 0)
                <span class="badge badge-danger badge-pill float-right">{{ $starCount }}</span>
            @endif
        </a>

        <a wire:click="selectSecreen('Trash')"
           href="#"
           class="list-group-item @if($screen == 'Trash') active @endif border-0">
            <i class="ft-trash-2 mr-1"></i>
            Archive
            @if($trashCount > 0)
                <span class="badge badge-warning badge-pill float-right">{{ $trashCount }}</span>
            @endif
        </a>

    </div>
</div>
