    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="card email-app-details d-none d-lg-block">
                <div class="card-content">

                    @if ($msg)
                    <div class="email-app-options card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                        data-toggle="tooltip" data-placement="top"
                                        wire:click.prevent="replayMsg({{ $msg->id }})" data-original-title="Replay"><i
                                            class="la la-reply"></i></button>

                                    @if (!$msg->trashed())
                                        <button type="button" wire:click.prevent="archiveMsg({{ $msg->id }})"
                                            class="btn btn-sm btn-outline-secondary" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Archive">
                                            <i class="ft-alert-octagon"></i>
                                        </button>
                                    @else
                                        <button type="button" wire:click.prevent="restoreMsg({{ $msg->id }})"
                                            class="btn btn-sm btn-outline-secondary" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Unarchive">
                                            <i class="ft-inbox"></i>
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                        data-toggle="tooltip" data-placement="top"
                                        wire:click.prevent="deleteMsg({{ $msg->id }})" data-original-title="Delete"><i
                                            class="ft-trash-2"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 text-right">

                                <div class="btn-group ml-1">
                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</button>
                                    <div class="dropdown-menu">

                                        @if ($msg->is_start)
                                            <a class="dropdown-item" wire:click.prevent="addToStart({{ $msg->id }})"
                                                href="#">Remove In star</a>
                                        @else
                                            <a class="dropdown-item" wire:click.prevent="addToStart({{ $msg->id }})"
                                                href="#">Add star</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="email-app-title card-body">
                        <h3 class="list-group-item-heading">{{ $msg->subject }}</h3>
                        <p class="list-group-item-text">
                            <span class="primary">
                                       <span class="badge badge-primary">Message Details</span>
 <i
                                    class=" float-right fa fa-star {{ $msg->is_start ? 'text-warning' : '-o blue-grey lighten-3' }}"></i></span>
                        </p>

                    </div>

                    <div class="media-list">
                        <div id="headingCollapse1" class="card-header p-0">
                            <a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1"
                                class="collapsed email-app-sender media border-0 bg-blue-grey bg-lighten-5">
                                <div class="media-left pr-1">
                                    <span class="avatar avatar-md">
                                        @if ($msg->user->image)
                                            <img class="media-object rounded-circle"
                                                src="{{ asset('uploads/users/' . $msg->user->image) }}"
                                                alt="Generic placeholder image">
                                        @else
                                            <img class="media-object rounded-circle"
                                                src="{{ asset('asset/dashboard/images/users/user.jfif') }}"
                                                alt="Generic placeholder image">
                                        @endif
                                    </span>
                                </div>
                                <div class="media-body w-100">
                                    <h6 class="list-group-item-heading">
                                        {{ $msg->name }}
                                    </h6>

                                    <p class="mb-1">
                                        {{ $msg->email }}
                                    </p>

                                    <p class="list-group-item-text">
                                        {{ $msg->subject }}

                                        <span class="float-right text-muted">
                                            {{ $msg->created_at->format('d M Y, h:i A') }}
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                            class="card-collapse collapse" aria-expanded="true">
                            <div class="card-content">
                                <div class="card-body">
                                    <p>{{ $msg->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
                    <div class="d-flex flex-column align-items-center justify-content-center py-5 text-muted">
                        <i class="ft-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                        <p class="mt-2">No messages to display</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
