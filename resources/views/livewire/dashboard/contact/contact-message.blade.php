   <div class="email-app-list-wraper col-md-7 card p-0">
                        <div class="email-app-list">
                            <div class="card-body chat-fixed-search">
                                <fieldset class="form-group position-relative has-icon-left m-0 pb-1">
                                    <input type="text" wire:model.live="itemSearch" class="form-control" id="iconLeft4" placeholder="Search email">
                                    <div class="form-control-position">
                                        <i class="ft-search"></i>
                                    </div>
                                </fieldset>
                            </div>
                            <div id="users-list" class="list-group">
                                <div  class="users-list-padding media-list">
                                    @forelse ($messages as $msg )

                                    <a href="#" @if ($msg->id ==$openMessageId)    style="background-color: #eaf2f8;" @endif wire:click="showMessage({{ $msg->id }})" class="media border-0">
                                        <div class="media-left pr-1">
                                            <span class="avatar avatar-md">
                                                <span class="media-object rounded-circle text-circle bg-info">T</span>
                                            </span>
                                        </div>
                                        <div class="media-body w-100">
                                            <h6 class="list-group-item-heading text-bold-500">{{ $msg->name }}
                                                <span class="float-right">
                                                    <span class="font-small-2 primary">{{ $msg->created_at->diffForHumans() }}</span>
                                                </span>
                                            </h6>
                                            <p class="list-group-item-text text-truncate text-bold-600 mb-0">{{ $msg->subject }}</p>
                                            <p class="list-group-item-text mb-0">{{ substr($msg->message,0,20)  }} ....
                                                <span class="float-right primary">
                                                  @if ($msg->is_read)
                                              <span class="badge badge-success mr-1">Readed</span>
                                                  @else
                                         <span class="badge badge-danger mr-1">New Contect..</span>
                                                  @endif
                                          <i class=" fa fa-star {{ $msg->is_start ? 'text-warning' : '-o blue-grey lighten-3' }}"></i>
                                                    </span>

                                            </p>
                                        </div>
                                    </a>
                                              @empty
                                              <div class="text-center">
                                                No Message Found

                                              </div>
                                   @endforelse
                                   {{ $messages->links('vendor.livewire.simple-bootstrap') }}

                                </div>
                            </div>
                        </div>
                    </div>
