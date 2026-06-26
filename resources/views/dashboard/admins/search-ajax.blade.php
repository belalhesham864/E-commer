        <div class="card-content collapse show">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($admins as $admin)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    
                                                    <td>{{ $admin->role->getTranslation('role','en')}}</td>                                                   
                                                    <td>@if ($admin->status)
                                                   <div class="badge bg-success">Active</div>                                                        
                                                   @else
                                                   <div class="badge bg-primary">Blocked</div>                                                        
                                                        
                                                    @endif</td>
                                                    <td>{{ $admin->created_at->diffForHumans() }}</td>
                                                    <td>

                                                 <div class="dropdown float-md-right">
    <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
        type="button"
        id="dropdownActions{{$admin->id}}"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        {{ __('words.action') }}
    </button>

    <div class="dropdown-menu dropdown-menu-right"
        aria-labelledby="dropdownActions{{$admin->id}}">

        <a class="dropdown-item text-success modal-effect"
           href="{{ route('dashboard.admins.edit', $admin->id) }}">
            <i class="ft-edit-3 mr-1"></i> {{ __('words.edit') }}
        </a>
        <a class="dropdown-item text-primary modal-effect"
           href="{{ route('dashboard.admins.show', $admin->id) }}">
            <i class="ft-eye mr-1"></i> Show
        </a>

        <a class="dropdown-item text-danger modal-effect"
           data-effect="effect-scale"
           data-toggle="modal
           href="#delete{{$admin->id}}">
            <i class="ft-trash mr-1"></i> {{ __('words.delete') }}
        </a>
        <a class="dropdown-item text-secondary modal-effect"
           data-effect="effect-scale"
           data-toggle="modal"
           href="#status{{$admin->id}}">
            <i class="ft-refresh-cw mr-1"></i> Change Status
        </a>

    </div>
</div>
                                    </div>

                                    </td>
                                    </tr>
@empty
<td colspan="4">Not Data Found</td>
                                @endforelse


                    </tbody>
                    </table>
                    {{ $admins->links() }}
                </div>