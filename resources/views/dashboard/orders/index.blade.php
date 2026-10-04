@extends('layout.dashboard.app')

@section('title')
    orders
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Orders</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Orders
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



                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Orders from one place. You can view order details, track statuses,
                                and monitor payments. Use the search box to quickly find a specific order,
                                or export the list as Excel, PDF, or print it directly.
                            </p>
                            <div class="d-flex align-items-center mb-2" style="gap: 10px; flex-wrap: wrap;">
                                <div class="d-flex align-items-center" style="gap: 8px;">
                                    <label for="status_filter" class="mb-0 font-weight-bold text-muted" style="white-space: nowrap; font-size: 0.9rem;">
                                        <i class="la la-filter"></i> Filter by Status:
                                    </label>
                                    <select name="status" id="status_filter"
                                        class="form-control"
                                        style="width: 180px; border-radius: 6px; border: 1px solid #d1d5db; font-size: 0.875rem; padding: 5px 10px; cursor: pointer; background-color: #fff;">
                                        <option value="allStatus">🔵 All Status</option>
                                        <option value="pending">🟡 Pending</option>
                                        <option value="completed">🟢 Completed</option>
                                        <option value="delivered">✅ Delivered</option>
                                        <option value="cancelled">🔴 Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Total Price</th>
                                        <th>Coupon</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Total Price</th>
                                        <th>Coupon</th>
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
            $('#yajra_table').DataTable({
                processing: true,
                serverSide: true,


                ajax: {
                    url: "{{ route('dashboard.orders.all') }}",
                    data: function(d){
                        d.status=$('#status_filter').val();
                    }
                },

                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'user_phone',
                        name: 'user_phone'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'coupon',
                        name: 'coupon',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
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






      $('#status_filter').on('change',function(){
        $('#yajra_table').DataTable().ajax.reload(null, false);

      })


        $(document).on('click', '.delete_confirm_order', function (e) {
            e.preventDefault();

            let orderId = $(this).attr('order-id');

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
                        url: "{{ route('dashboard.order.delete', ':id') }}".replace(':id', orderId),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: response.msg || "Order Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('#yajra_table').DataTable().ajax.reload(null, false);
                        },
                        error: function (xhr) {
                            let errorMsg = xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : "Failed to delete order";
                            Swal.fire({
                                icon: "error",
                                title: "Cannot Delete",
                                text: errorMsg,
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
