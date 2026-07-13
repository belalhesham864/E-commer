@extends('layout.dashboard.app')

@section('title')
    Brands
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
                            data-toggle="modal" href="#createBrand">

                            <i class="ft-plus mr-1"></i>Create Brand
                        </a>
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Brands from one place. You can add a new category, edit or update
                                existing ones, and remove Brands you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>logo</th>
                                        <th>Status</th>
                                        <th>product count</th>
                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>logo</th>
                                        <th>Status</th>
                                        <th>product count</th>
                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                       @include('dashboard.brands.create')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@push('scripts')
@if ($errors->any())
<script>
    $(function(){
        $('#createBrand').modal('show');
    });
</script>
    
@endif


    <script>
        $(function() {
            $('#yajra_table').DataTable({
                processing: true,
                serverSide: true, 
         

                ajax: "{{ route('dashboard.brands.all') }}",

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
                        data: 'logo',
                        name: 'logo',
                        searchable: false,
                        orderable: false,

                    },
                    {
                        data: 'status',
                        name: 'status'

                    },
                    {
                        data: 'products_count',
                        name: 'products_count',
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

@endpush
