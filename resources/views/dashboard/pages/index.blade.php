@extends('layout.dashboard.app')

@section('title')
    Pages
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
                        <a style="margin-left:20px" class="btn btn-primary modal-effect"
                            href="{{ route('dashboard.pages.create') }}">

                            <i class="ft-plus mr-1"></i>Create Page
                        </a>
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Pages from one place. You can add a new category, edit or update
                                existing ones, and remove Pages you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>Content</th>
                                        <th>image</th>
                                        <th>status</th>

                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>Content</th>
                                        <th>image</th>
                                        <th>status</th>

                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>

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


                ajax: "{{ route('dashboard.pages.all') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'title',
                        name: 'title'


                    },
                    {
                        data: 'content',
                        name: 'content',
                        searchable: false,
                        orderable: false,

                    },
                    {
                        data: 'image',
                        name: 'image',
                        searchable: false,
                        orderable: false,

                    },
                    {
                        data: 'is_active',
                        name: 'is_active',

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
        $(document).on('click','.delete_confirm_page',function(e){
            e.preventDefault();
          let page_id=$(this).attr('page-id');
                  Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete the Page ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete Page!"
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ route('dashboard.pages.destroy', ':id') }}".replace(':id', page_id),
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#yajra_table').DataTable().ajax.reload(null, false);

                        Swal.fire({
                            title: "Page Deleted Successfuly",
                            icon: "success",
                            draggable: true
                        });
                    },


                });

            }
        });
        });
    </script>
@endpush
