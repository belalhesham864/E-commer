@extends('layout.dashboard.app')

@section('title')
    Products
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
                        <a style="margin-left:20px" class="btn btn-primary"
                          href="{{ route('dashboard.products.create') }}">

                            <i class="ft-plus mr-1"></i>Create Product
                        </a>
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Products from one place. You can add a new category, edit or update
                                existing ones, and remove Brands you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Has Variants</th>
                                        <th>Images</th>
                                        <th>Status</th>
                                        <th>Sku</th>
                                        <th>Avaliable For</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Has Variants</th>
                                        <th>Images</th>
                                        <th>Status</th>
                                        <th>Sku</th>
                                        <th>Avaliable For</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
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
    $('#yajra_table').DataTable({
         processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.products.all') }}",
        columns:[
            {
                data:'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
            {
                data:'name',
                name:'name',
            },

            {
                data:'has_variants',
                name:'has_variants',
                searchable: false,
                orderable: false,
            },
            {
                data:'images',
                name:'images',
                 searchable: false,
                orderable: false,
            },
            {
                data:'status',
                name:'status',
            },
            {
                data:'sku',
                name:'sku',
            },
            {
                data:'available_for',
                name:'available_for',
            },
            {
                data:'category',
                name:'category',
            },
            {
                data:'brand',
                name:'brand',
            },
            {
                data:'price',
                name:'price',
            },
            {
                data:'quantity',
                name:'quantity',
            },
            {
                data:'created_at',
                name:'created_at',
            },
            {
                data:'action',
                name:'action',
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
</script>
<script>

$(document).on('click', '.change_statusProduct', function (e) {
    e.preventDefault();

    let productId = $(this).attr('product-id');

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to change the status of this product?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change status!"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('dashboard.product.status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },

                success: function (response) {

                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Status Changed Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#yajra_table').DataTable().ajax.reload(null, false);
                },

                error: function () {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });

                }
            });

        }

    });
});


</script>
<script>
    $(document).on('click', '.delete_confirm', function (e) {
    e.preventDefault();

    let productId = $(this).attr('product-id');

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('dashboard.products.destroy', ':id') }}"
                    .replace(':id', productId),
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },

                success: function (response) {

                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Product Deleted Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#yajra_table').DataTable().ajax.reload(null, false);
                }
            });

        }
    });
});
</script>
@endpush
