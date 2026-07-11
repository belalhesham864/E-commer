@extends('layout.dashboard.app')

@section('title')
    Categories
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
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your categories from one place. You can add a new category, edit or update
                                existing ones, and remove categories you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        {{-- <th>Slug</th> --}}
                                        <th>Status</th>
                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        {{-- <th>Slug</th> --}}
                                        <th>Status</th>
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
            //  $('#yajra_table').DataTable()
            $('#yajra_table').DataTable({
                processing: true,
                serverSide: true,
                colReorder: true,
                responsive: true,
                fixedHeader: true,
                // rowReorder: true,
                // select: true,
                //                scrollCollapse: true,
                // scroller: true,
                // scrollY: 200,
                ajax: "{{ route('dashboard.categories.all') }}",
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
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action'
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
@endpush
