@extends('layout.dashboard.app')
@section('title')
{{ __('words.admins') }}
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Basic Forms</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">{{__('words.Home')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index')  }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create')  }}"> {{ __('words.Create Roles') }}
                                        </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
   @include('dashboard.includes.buttonheader')
            </div>
            <div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title mb-0">{{ __('words.Roles') }}</h4>

    <div class="d-flex align-items-center">
        <input type="search"
               name="search"
               id="search-ajax"
               class="form-control mr-2"
               placeholder="Search Admin..."
               style="width:250px;">

        <a class="btn btn-danger round btn-glow px-3"
           href="{{ route('dashboard.admins.create') }}">
            Create Admin
        </a>
    </div>
</div>

<div class="search-table">
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
                                @foreach ($admins as $admin)
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
           data-toggle="modal"
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

                                @endforeach


                    </tbody>
                    </table>
                <div class="ajax-paginate">

                    {{ $admins->links() }}
                </div>

                </div>
</div>

                @foreach ($admins as $admin)
                    <div class="modal" id="delete{{$admin->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Delete Admin </h6><button aria-label="Close" class="close"
                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <p>Do You want Delete the Admin </p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>
                    <div class="modal" id="status{{$admin->id}}">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">Change Status </h6><button aria-label="Close" class="close"
                                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{ route('dashboard.admins.status', $admin->id) }}" >
                                    @csrf
                                    <div class="modal-body">
                                        @if ($admin->status==1)
                                            
                                        <p>Do You want Blocked the Admin </p>
                                        @else
                                        <p>Do You want Actived the Admin </p>
                                            
                                        @endif

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>

                @endforeach
            </div>

        </div>

    </div>
    </div>
    @endsection
    @push('scripts')
        
  

    <script>
        let depounce;
        console.log('ajax send');
        $(document).on('input','#search-ajax',function(e){
          console.log('input works');
    var search=$(this).val();
    console.log(search);
         
            e.preventDefault();
            clearTimeout(depounce);
    depounce= setTimeout(() => {
               $.ajax({
                url:"{{ route('dashboard.admins.search') }}",
                type:"POST",
                data:{
                    '_token':"{{ csrf_token() }}",
                    'search':search,
                },
                success:function(data){
                $('.search-table').html(data);
                    $('.dropdown-toggle').dropdown();

                },

            });
     }, 1000);
        });
    </script>

    <script>
        $(document).on('click', '.ajax-paginate a', function(e){
    e.preventDefault();
    var link = $(this).attr('href');
    
    $.ajax({
        url: link,
        type: 'GET',
        success: function(data){
      $('.search-table').html(data);         
        },
    });
});
    </script>
   
    @endpush