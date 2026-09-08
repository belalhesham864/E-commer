@extends('layout.dashboard.app')

@section('title')
    Users
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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.roles.index') }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create') }}">
                                        {{ __('words.Create Roles') }}
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.buttonheader')

            </div>
            <div class="card">

                <div class="card-content collapse show">

                    {{-- alert --}}
                    @include('dashboard.includes.toster-error')
                    @include('dashboard.includes.toster-success')


                    <div class="card-content collapse show">
                        <a style="margin-left:20px" class="btn btn-primary modal-effect" data-effect="effect-scale"
                            data-toggle="modal" href="#createUser">

                            <i class="ft-plus mr-1"></i>Create User
                        </a>
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Users from one place. You can add a new category, edit or update
                                existing ones, and remove Users you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>email</th>
                                        <th>email Verified At</th>
                                        <th>status</th>
                                        <th>Location</th>

                                        <th>image</th>
                                        <th>Number Of Order</th>
                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>email</th>
                                        <th>email Verified At</th>
                                        <th>status</th>
                                        <th>Location</th>

                                        <th>image</th>
                                        <th>Number Of Order</th>
                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            @include('dashboard.users.create')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection



@push('scripts')


<script>
    $(function() {
        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,


            ajax: "{{ route('dashboard.users.all') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'name',
                    name: 'name'


                },
                {
                    data: 'phone',
                    name: 'phone',
                    searchable: false,
                    orderable: false,

                },
                {
                    data: 'email',
                    name: 'email',
                    searchable: false,
                    orderable: false,

                },
                {
                    data: 'email_verified_at',
                    name: 'email_verified_at'

                },

                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false,

                },

                {
                    data: 'location',
                    name: 'location',


                },



                {
                    data: 'image',
                    name: 'image',
                    searchable: false,
                    orderable: false,

                },
                {
                    data: 'num_of_order',
                    name: 'num_of_order',
                    searchable: false,
                    orderable: false,

                },

                {
                    data: 'created_at',
                    name: 'created_at'

                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,

                },

            ],
            layout: {
                topStart: ['pageLength', 'buttons'],
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            },
            buttons: ['colvis', 'print', 'copy', 'excel', 'pdf'],
        });
    });
</script>
<script>
    $(document).on('click', '#sumbitUser', function(e) {

        e.preventDefault();
        let form = document.getElementById('createUser2');
        var formData = new FormData(form);
        $.ajax({
            url: "{{ route('dashboard.users.store') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    $('#createUser2')[0].reset();

                    $('#createUser').modal('hide');
                    $('#yajra_table').DataTable().ajax.reload(null, false);

                    Swal.fire({
                        title: "User Created Successfuly",
                        icon: "success",
                        draggable: true
                    });

                } else {
                    Swal.fire({
                        title: data.msg,
                        icon: "error",
                        draggable: true
                    });
                }
            },
            error: function(data) {

                if (data.responseJSON.errors) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('#error-' + key).text(value[0]);
                    });
                }
            }
        });
    })
    $(document).on('input', '#createUser2 input, #createUser2 select', function() {

        let name = $(this).attr('name');

        $('#error-' + name).text('');

    });
</script>
<script>
    $(document).on('click', '.change_statusUser', function(e) {
        e.preventDefault();
        let id = $(this).attr('user-id');
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to change the status of this User?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change status!"
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ route('dashboard.users.status', ':id') }}".replace(':id', id),
                    type: "PATCH",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#yajra_table').DataTable().ajax.reload(null, false);

                        Swal.fire({
                            title: "Status Chenged Successfuly",
                            icon: "success",
                            draggable: true
                        });
                    },


                });

            }
        });

    });
</script>

<script>
    $(document).on('click', '.delete_confirmUser', function(e) {
        e.preventDefault();
        let id = $(this).attr('user-id');


        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete The User?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change status!"
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('dashboard.users.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function(data) {

                        Swal.fire({
                            title: "User Deleted Successfuly",
                            icon: "success",
                            draggable: true
                        });
                        $('#yajra_table').DataTable().ajax.reload(null,false);

                    },
                    error:function(){
                           Swal.fire({
                            title: "Error Please Try Again Latter",
                            icon: "error",
                            draggable: true
                        });
                    }

                });


            }

        });
    });
</script>


@endpush
