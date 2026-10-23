<div>
    @if ($screen == 'order')
        <div class="tab-pane fade show active">
            <div class="dashboard-orders-section">

                @if ($orders->count() > 0)
                    {{-- Orders Table Card --}}
                    <div class="orders-table-card">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr class="orders-table-header">
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Products</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="orders-table-row">
                                            {{-- Order ID --}}
                                            <td class="ps-4">
                                                <span class="order-id-badge">#{{ $order->id }}</span>
                                            </td>

                                            {{-- Date --}}
                                            <td>
                                                <div class="order-date-text">
                                                    <span class="fw-semibold text-dark">{{ $order->created_at->format('M d, Y') }}</span>
                                                    <span class="text-muted d-block small" style="font-size: 0.75rem;">{{ $order->created_at->diffForHumans() }}</span>
                                                </div>
                                            </td>

                                            {{-- Products preview --}}
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="d-flex align-items-center">
                                                        @foreach ($order->orderItems->take(3) as $item)
                                                            @php
                                                                $thumb = $item->product?->images?->first()?->file_name;
                                                            @endphp
                                                            <div class="order-mini-thumb" title="{{ $item->product_name }}">
                                                                <img src="{{ $thumb ? asset($thumb) : asset('asset/website/assets/images/homepage-one/product-img/product-img-1.webp') }}"
                                                                     alt="{{ $item->product_name }}">
                                                            </div>
                                                        @endforeach
                                                        @if ($order->orderItems->count() > 3)
                                                            <span class="order-mini-more">+{{ $order->orderItems->count() - 3 }}</span>
                                                        @endif
                                                    </div>
                                                    <span class="text-muted small">
                                                        ({{ $order->orderItems->sum('product_quantity') }} {{ Str::plural('item', $order->orderItems->sum('product_quantity')) }})
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Total Price --}}
                                            <td>
                                                <span class="fw-bold" style="color: #232532; font-size: 1.05rem;">
                                                    {{ number_format($order->total_price, 2) }} EGP
                                                </span>
                                            </td>

                                            {{-- Status --}}
                                            <td>
                                                @if ($order->status == 'delivered')
                                                    <span class="order-status-badge status-delivered">Delivered</span>
                                                @elseif ($order->status == 'completed')
                                                    <span class="order-status-badge status-completed">Completed</span>
                                                @elseif ($order->status == 'cancelled')
                                                    <span class="order-status-badge status-cancelled">Cancelled</span>
                                                @else
                                                    <span class="order-status-badge status-pending">Pending</span>
                                                @endif
                                            </td>

                                            {{-- Action --}}
                                            <td class="text-end pe-4">
                                                <button type="button" wire:click="viewOrder({{ $order->id }})" class="order-details-btn">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    <span>Details</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="col-12 mt-4">
                        {{ $orders->links('livewire.website.pagination') }}
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="orders-empty-state">
                        <div class="mb-3">
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#ae1c9a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </div>
                        <h4 class="fw-semibold mb-2" style="color: #232532;">No Orders Found</h4>
                        <p class="text-muted small mb-4" style="max-width: 400px; margin: 0 auto;">
                            You haven't placed any orders yet. Explore our latest collections and start shopping today!
                        </p>
                        <a href="{{ route('Home.index') }}" class="shop-btn" style="text-decoration: none; padding: 10px 24px; border-radius: 8px;">
                            Start Shopping
                        </a>
                    </div>
                @endif

                {{-- Order Details Modal --}}
                @if ($showDetailsModal && $selectedOrder)
                    <div class="order-modal-backdrop" wire:click.self="closeModal">
                        <div class="order-modal-content">
                            {{-- Modal Header --}}
                            <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-4">
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="m-0 fw-bold" style="color: #232532; font-size: 1.25rem;">Order #{{ $selectedOrder->id }}</h5>
                                        @if ($selectedOrder->status == 'delivered')
                                            <span class="order-status-badge status-delivered">Delivered</span>
                                        @elseif ($selectedOrder->status == 'completed')
                                            <span class="order-status-badge status-completed">Completed</span>
                                        @elseif ($selectedOrder->status == 'cancelled')
                                            <span class="order-status-badge status-cancelled">Cancelled</span>
                                        @else
                                            <span class="order-status-badge status-pending">Pending</span>
                                        @endif
                                    </div>
                                    <span class="text-muted small">Placed on {{ $selectedOrder->created_at->format('M d, Y - h:i A') }}</span>
                                </div>
                                <button type="button" wire:click="closeModal" class="btn-close" aria-label="Close"></button>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="order-info-card">
                                        <h6 class="fw-bold mb-2" style="font-size: 0.9rem; color: #232532;">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            Customer Information
                                        </h6>
                                        <p class="mb-1 small"><strong>Name:</strong> {{ $selectedOrder->user_name }}</p>
                                        <p class="mb-1 small"><strong>Phone:</strong> {{ $selectedOrder->user_phone }}</p>
                                        <p class="mb-0 small"><strong>Email:</strong> {{ $selectedOrder->user_email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="order-info-card">
                                        <h6 class="fw-bold mb-2" style="font-size: 0.9rem; color: #232532;">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            Shipping Address
                                        </h6>
                                        <p class="mb-1 small">
                                            {{ $selectedOrder->street ? $selectedOrder->street . ', ' : '' }}
                                            {{ $selectedOrder->city }}, {{ $selectedOrder->governrate }}, {{ $selectedOrder->country }}
                                        </p>
                                        <p class="mb-0 small">
                                            <strong>Payment:</strong> {{ $selectedOrder->transaction?->payment_method ?? 'Cash on Delivery' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Products Ordered List --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3" style="font-size: 0.95rem; color: #232532;">Ordered Items ({{ $selectedOrder->orderItems->count() }})</h6>
                                <div class="order-items-scroll">
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            <tr style="font-size: 0.8rem; text-transform: uppercase; color: #6c757d;">
                                                <th style="padding: 10px 14px;">Product</th>
                                                <th class="text-center" style="padding: 10px 14px;">Price</th>
                                                <th class="text-center" style="padding: 10px 14px;">Qty</th>
                                                <th class="text-end" style="padding: 10px 14px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($selectedOrder->orderItems as $item)
                                                @php
                                                    $itemImg = $item->product?->images?->first()?->file_name;
                                                @endphp
                                                <tr style="border-bottom: 1px solid #f2f2f4;">
                                                    <td style="padding: 12px 14px;">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="order-modal-item-img">
                                                                <img src="{{ $itemImg ? asset($itemImg) : asset('asset/website/assets/images/homepage-one/product-img/product-img-1.webp') }}"
                                                                     alt="{{ $item->product_name }}">
                                                            </div>
                                                            <div>
                                                                <p class="m-0 fw-semibold text-dark small">{{ $item->product_name }}</p>
                                                                @if ($item->product_variant_id && $item->productVariant)
                                                                    <span class="badge bg-light text-secondary border" style="font-size: 0.72rem;">Variant</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center small" style="padding: 12px 14px;">
                                                        {{ number_format($item->product_price, 2) }} EGP
                                                    </td>
                                                    <td class="text-center small fw-semibold" style="padding: 12px 14px;">
                                                        x{{ $item->product_quantity }}
                                                    </td>
                                                    <td class="text-end small fw-bold text-dark" style="padding: 12px 14px;">
                                                        {{ number_format($item->product_price * $item->product_quantity, 2) }} EGP
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Price Summary --}}
                            <div class="order-summary-box p-3 rounded-3 mb-4" style="background: #faf5f9; border: 1px solid rgba(174, 28, 154, 0.12);">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">Subtotal:</span>
                                    <span class="fw-semibold text-dark">{{ number_format($selectedOrder->price, 2) }} EGP</span>
                                </div>
                                @if ($selectedOrder->coupon_discount > 0)
                                    <div class="d-flex justify-content-between mb-2 small text-success">
                                        <span>Coupon Discount ({{ $selectedOrder->coupon }}):</span>
                                        <span class="fw-semibold">-{{ number_format($selectedOrder->coupon_discount, 2) }} EGP</span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">Shipping Fee:</span>
                                    <span class="fw-semibold text-dark">{{ number_format($selectedOrder->shapping_price ?? 0, 2) }} EGP</span>
                                </div>
                                <hr class="my-2" style="opacity: 0.1;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="color: #232532; font-size: 1.05rem;">Grand Total:</span>
                                    <span class="fw-bold" style="color: #ae1c9a; font-size: 1.25rem;">{{ number_format($selectedOrder->total_price, 2) }} EGP</span>
                                </div>
                            </div>

                            {{-- Customer Note if available --}}
                            @if ($selectedOrder->note)
                                <div class="p-3 rounded-3 bg-light border mb-4">
                                    <p class="m-0 small text-muted"><strong>Order Note:</strong> {{ $selectedOrder->note }}</p>
                                </div>
                            @endif

                            {{-- Footer Close --}}
                            <div class="d-flex justify-content-end">
                                <button type="button" wire:click="closeModal" class="btn btn-sm btn-light border px-4 py-2" style="border-radius: 8px;">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif

    <link rel="stylesheet" href="{{ asset('asset/website/css/pagiation.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/website/css/orders.css') }}">


</div>
