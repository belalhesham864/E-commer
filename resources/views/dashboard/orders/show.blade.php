@extends('layout.dashboard.app')

@section('title')
    {{ __('words.order_details') }} #{{ $order->id }}
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            {{-- Breadcrumbs & Header --}}
            <div class="content-header row mb-2">
                <div class="content-header-left col-md-6 col-12 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block font-weight-bold">
                        <i class="la la-shopping-cart text-primary"></i> {{ __('words.order_details') }} #{{ $order->id }}
                    </h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.orders.index') }}">{{ __('words.orders') }}</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    #{{ $order->id }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="content-header-right col-md-6 col-12 text-md-right text-left mt-md-0 mt-1 d-print-none">
                    <button type="button" onclick="window.print()" class="btn btn-outline-secondary mr-1">
                        <i class="la la-print"></i> Print Invoice
                    </button>
                    <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-primary">
                        <i class="la la-arrow-circle-left"></i> Back to Orders
                    </a>
                </div>
            </div>

            {{-- Alerts --}}
            @include('dashboard.includes.toster-error')
            @include('dashboard.includes.toster-success')

            {{-- Status & Quick Control Card --}}
            <div class="card mb-3 border-top-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-12 mb-2 mb-md-0">
                            <h5 class="mb-1">
                                Order Placed on: <strong>{{ $order->created_at ? $order->created_at->format('M d, Y - h:i A') : 'N/A' }}</strong>
                            </h5>
                            <div class="d-flex align-items-center">
                                <span class="mr-1">Current Status:</span>
                                <span id="current-status-badge">
                                    @if ($order->status == 'completed')
                                        <span class="badge badge-success px-2 py-1 font-medium-1">
                                            <i class="la la-check-circle"></i> {{ ucfirst($order->status) }}
                                        </span>
                                    @elseif ($order->status == 'delivered')
                                        <span class="badge badge-primary px-2 py-1 font-medium-1">
                                            <i class="la la-truck"></i> {{ ucfirst($order->status) }}
                                        </span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="badge badge-danger px-2 py-1 font-medium-1">
                                            <i class="la la-times-circle"></i> {{ ucfirst($order->status) }}
                                        </span>
                                    @else
                                        <span class="badge badge-warning px-2 py-1 font-medium-1">
                                            <i class="la la-clock-o"></i> {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        {{-- Change Status Form --}}
                        <div class="col-md-6 col-12 d-print-none">
                            <form id="change-status-form" class="form-inline justify-content-md-end justify-content-start">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <label for="order-status-select" class="mr-2 font-weight-bold">Change Status:</label>
                                <select name="status" id="order-status-select" class="form-control form-control-sm mr-2 custom-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending </option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed </option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered </option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled </option>
                                </select>
                                <button type="submit" id="btn-update-status" class="btn btn-sm btn-primary">
                                    <i class="la la-save"></i> Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Information Cards Grid --}}
            <div class="row">
                {{-- Customer Information --}}
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light py-1">
                            <h5 class="card-title mb-0 font-weight-bold text-dark">
                                <i class="la la-user text-primary"></i> Customer Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <span class="text-muted d-block small">Name:</span>
                                    <strong class="font-medium-1">{{ $order->user_name }}</strong>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted d-block small">Email:</span>
                                    <a href="mailto:{{ $order->user_email }}" class="text-primary">{{ $order->user_email }}</a>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted d-block small">Phone:</span>
                                    <a href="tel:{{ $order->user_phone }}" class="text-dark font-weight-bold">{{ $order->user_phone }}</a>
                                </li>
                                @if($order->user)
                                <li class="mb-2">
                                    <span class="text-muted d-block small">Account:</span>
                                    <span class="badge badge-light border">Registered User #{{ $order->user->id }}</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light py-1">
                            <h5 class="card-title mb-0 font-weight-bold text-dark">
                                <i class="la la-map-marker text-success"></i> Delivery Address
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <span class="text-muted d-block small">Country / Governorate:</span>
                                    <strong>{{ $order->country }} / {{ $order->governrate }}</strong>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted d-block small">City:</span>
                                    <strong>{{ $order->city }}</strong>
                                </li>
                                <li class="mb-2">
                                    <span class="text-muted d-block small">Street / Detailed Address:</span>
                                    <span class="text-dark">{{ $order->street }}</span>
                                </li>
                                @if($order->note)
                                <li class="mb-0 pt-2 border-top">
                                    <span class="text-muted d-block small">Customer Note:</span>
                                    <div class="alert alert-light border mb-0 py-1 small">
                                        <i class="la la-info-circle text-info"></i> {{ $order->note }}
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Payment & Transaction Summary --}}
                <div class="col-lg-4 col-md-12 col-12 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light py-1">
                            <h5 class="card-title mb-0 font-weight-bold text-dark">
                                <i class="la la-credit-card text-info"></i> Payment & Order Totals
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-3">
                                @if($order->transaction)
                                    <li class="mb-2">
                                        <span class="text-muted d-block small">Payment Method:</span>
                                        <span class="badge badge-info">{{ ucfirst($order->transaction->payment_method) }}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="text-muted d-block small">Transaction ID:</span>
                                        <code class="text-dark">{{ $order->transaction->transaction_id ?? 'N/A' }}</code>
                                    </li>
                                @else
                                    <li class="mb-2">
                                        <span class="text-muted d-block small">Payment Method:</span>
                                        <span class="badge badge-secondary">Online / Cash on Delivery</span>
                                    </li>
                                @endif
                            </ul>

                            <table class="table table-sm table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="text-muted pl-0">Original Price (السعر الأصلي):</td>
                                        <td class="text-right font-weight-bold pr-0">{{ number_format($order->price, 2) }} EGP</td>
                                    </tr>
                                    @if($order->coupon)
                                    <tr>
                                        <td class="text-success pl-0">
                                            <i class="la la-tag"></i> Coupon ({{ $order->coupon }} - {{ $order->coupon_discount }}%):
                                        </td>
                                        <td class="text-right text-success font-weight-bold pr-0">
                                            -{{ number_format($order->price - $order->price_after_discount, 2) }} EGP
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted pl-0">Price After Discount (بعد الخصم):</td>
                                        <td class="text-right font-weight-bold pr-0">{{ number_format($order->price_after_discount, 2) }} EGP</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-muted pl-0">Shipping to ({{ $order->governrate }}):</td>
                                        <td class="text-right font-weight-bold pr-0">+{{ number_format($order->shapping_price, 2) }} EGP</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="font-weight-bold font-medium-1 pl-0">Grand Total (الإجمالي النهائي):</td>
                                        <td class="text-right font-weight-bold font-medium-2 text-primary pr-0">
                                            {{ number_format($order->total_price, 2) }} EGP
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ordered Items Table --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="card-title font-weight-bold mb-0">
                        <i class="la la-cubes text-warning"></i> Order Items ({{ $order->orderItems->count() }})
                    </h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th style="width: 80px;">Image</th>
                                    <th>Product</th>
                                    <th>Variants / Specs</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->orderItems as $index => $item)
                                    @php
                                        $productImage = $item->product?->images?->first()?->file_name;
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($productImage)
                                                <img src="{{ asset($productImage) }}" alt="{{ $item->product_name }}"
                                                    style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px;" class="border">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center border"
                                                    style="width: 55px; height: 55px; border-radius: 6px;">
                                                    <i class="la la-image text-muted font-medium-3"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <h6 class="font-weight-bold mb-1">
                                                @if($item->product_id)
                                                    <a href="{{ route('dashboard.products.show', $item->product_id) }}" class="text-primary" target="_blank">
                                                        {{ $item->product_name }} <i class="la la-external-link small"></i>
                                                    </a>
                                                @else
                                                    {{ $item->product_name }}
                                                @endif
                                            </h6>
                                            @if($item->product_desc)
                                                <p class="text-muted small mb-0">{{ Str::limit(strip_tags($item->product_desc), 80) }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($item->data))
                                                @php
                                                    $attributes = is_array($item->data) ? $item->data : json_decode($item->data, true);
                                                @endphp
                                                @if (is_array($attributes) && count($attributes) > 0)
                                                    <div class="d-flex flex-wrap" style="gap: 4px;">
                                                        @foreach ($attributes as $key => $val)
                                                            <span class="badge badge-light border text-dark font-weight-normal py-1 px-2">
                                                                <strong>{{ $key }}:</strong> {{ is_array($val) ? implode(', ', $val) : $val }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted small">Standard</span>
                                                @endif
                                            @else
                                                <span class="text-muted small">Standard</span>
                                            @endif
                                        </td>
                                        <td class="text-center font-weight-bold">
                                            {{ number_format($item->product_price, 2) }} EGP
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-pill badge-secondary px-2 py-1">
                                                x{{ $item->product_quantity }}
                                            </span>
                                        </td>
                                        <td class="text-right font-weight-bold text-dark font-medium-1">
                                            {{ number_format($item->product_price * $item->product_quantity, 2) }} EGP
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="la la-inbox font-large-2 d-block mb-1"></i>
                                            No items found for this order.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td colspan="4" class="text-right font-weight-bold">Items Count:</td>
                                    <td class="text-center font-weight-bold">{{ $order->orderItems->sum('product_quantity') }}</td>
                                    <td class="text-right font-weight-bold">Total:</td>
                                    <td class="text-right font-weight-bold text-primary font-medium-2">
                                        {{ number_format($order->total_price, 2) }} EGP
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#change-status-form').on('submit', function(e) {
            e.preventDefault();

            let status = $('#order-status-select').val();
            let orderId = "{{ $order->id }}";
            let btn = $('#btn-update-status');

            btn.prop('disabled', true).html('<i class="la la-spinner la-spin"></i> Updating...');

            $.ajax({
                url: "{{ route('dashboard.order.status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: orderId,
                    status: status
                },
                success: function(response) {
                    btn.prop('disabled', false).html('<i class="la la-save"></i> Update');

                    // Update Status Badge dynamically
                    let badgeHtml = '';
                    if (status === 'completed') {
                        badgeHtml = '<span class="badge badge-success px-2 py-1 font-medium-1"><i class="la la-check-circle"></i> Completed</span>';
                    } else if (status === 'delivered') {
                        badgeHtml = '<span class="badge badge-primary px-2 py-1 font-medium-1"><i class="la la-truck"></i> Delivered</span>';
                    } else if (status === 'cancelled') {
                        badgeHtml = '<span class="badge badge-danger px-2 py-1 font-medium-1"><i class="la la-times-circle"></i> Cancelled</span>';
                    } else {
                        badgeHtml = '<span class="badge badge-warning px-2 py-1 font-medium-1"><i class="la la-clock-o"></i> Pending</span>';
                    }
                    $('#current-status-badge').html(badgeHtml);

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.msg || "Order status updated successfully",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        alert(response.msg || "Order status updated successfully");
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html('<i class="la la-save"></i> Update');

                    let errorMsg = "Something went wrong";
                    if (xhr.responseJSON && xhr.responseJSON.msg) {
                        errorMsg = xhr.responseJSON.msg;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: "error",
                            title: "Update Failed",
                            html: errorMsg
                        });
                    } else {
                        alert(errorMsg);
                    }
                }
            });
        });
    });
</script>
@endpush
