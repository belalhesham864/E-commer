@extends('layout.dashboard.app')

@section('title')
    Coupons
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
                        <a style="margin-left:20px" class="btn btn-primary round btn-glow px-2 modal-effect"
                            data-effect="effect-scale" data-toggle="modal" href="#createcoupon">

                            <i class="ft-plus mr-1"></i>Create Coupon
                        </a>
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Coupons from one place. You can add a new category, edit or update
                                existing ones, and remove Coupons you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>discount_precentage</th>
                                        <th>limit</th>
                                        <th>time_used</th>
                                        <th>start_date</th>
                                        <th>end_date</th>
                                        <th>created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>discount_precentage</th>
                                        <th>limit</th>
                                        <th>time_used</th>
                                        <th>start_date</th>
                                        <th>end_date</th>
                                        <th>created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            @include('dashboard.coupon.create')
                            @include('dashboard.coupon.edit')

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
                ajax: "{{ route('dashboard.coupons.all') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,

                    },
                    {
                        data: 'code',
                        name: 'code'

                    },
                    {
                        data: 'discount_precentage',
                        name: 'discount_precentage'
                    },
                    {
                        data: 'limit',
                    },
                    {
                        data: 'time_used',

                    },
                    {
                        data: 'start_date',

                    },
                    {
                        data: 'end_date',

                    },
                    {
                        data: 'created_at',


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
        $(document).on('submit', '#create_coupon', function(e) {
            e.preventDefault();
            $('#error_list').empty();
            $('#alert_div').hide();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('dashboard.coupons.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#error_list').empty();
                        $('#alert_div').hide();

                        $('#create_coupon')[0].reset();
                        $('#yajra_table').DataTable().ajax.reload();

                        $('#createcoupon').modal('hide');
                        Swal.fire({
                            title: "Coupon Created Successfuly",
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
                        $.each(data.responseJSON.errors, function($key, $value) {
                            $('#error_list').append(`<li>` + $value[0] + `</li>`);
                            $('#alert_div').show();
                        });
                    }
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.delete_confirm_btn', function(e) {
            e.preventDefault();

            var coupon_id = $(this).attr('coupon-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed)
                    $.ajax({
                        url: "{{ route('dashboard.coupons.destroy', ':id') }}".replace(':id',
                            coupon_id),
                        type: "DELETE",
                        data: {
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == true) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your Coupon has been deleted.",
                                    icon: "success"
                                });
                                $('#yajra_table').DataTable().ajax.reload();

                            }
                        }
                    });
            });
        });
    </script>
    <script>
        $(document).on('click', '#edit-btn', function(e) {
            e.preventDefault();
            var coupon_id = $(this).attr('coupon-id');
            $.ajax({
                url: "{{ route('dashboard.coupons.edit', ':id') }}".replace(':id', coupon_id),
                type: "GET",
                success: function(data) {
                    if (data.status == true) {
                        $('#coupon_id').val(data.coupon.id);
                        $('#Couponcode').val(data.coupon.code);
                        $('#discountCode').val(data.coupon.discount_precentage);
                        $('#startDateCode').val(data.coupon.start_date);
                        $('#endDateCode').val(data.coupon.end_date);
                        $('#limitcode').val(data.coupon.limit);
                        $('input[name="is_active"][value="' + data.coupon.is_active + '"]')
                            .prop('checked', true);
                        $('#editCoupon').modal('show');
                    }
                }
            });
        });
    </script>
    <script>
        $(document).on('submit', '#edit_coupon', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            data.append('_method', 'PUT');

            var coupon_id = $('#coupon_id').val();

            $.ajax({
                url: "{{ route('dashboard.coupons.update', ':id') }}".replace(':id', coupon_id),
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#editCoupon').modal('hide');
                        $('#edit_coupon')[0].reset();
                        $('#yajra_table').DataTable().ajax.reload(null, false);
                        Swal.fire({
                            title: data.msg,
                            icon: "success"
                        });

                    }

                }
            });
        });
    </script>
@endpush
