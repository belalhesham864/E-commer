<div>



@if ($cartItem > 0 && !$cart->coupon)
    <div class="d-flex align-items-center" style="gap: 8px;">
        <input type="text" wire:model="code" class="form-control" placeholder="Coupon code"
            style="height: 42px; font-size: 13px; border-radius: 6px;">
        <button type="button" wire:click="applyCoupon" class="shop-btn"
            style="height: 42px; line-height: 42px; padding: 0 20px; font-size: 13px; border-radius: 6px; border: none; cursor: pointer; white-space: nowrap;">
            Apply
        </button>
    </div>
    @error('code')
        <span class="text-danger small mt-1 d-block" style="font-size: 12px;">{{ $message }}</span>
    @enderror
@endif
    @if ($coupon)
        <div class="coupon-applied-box">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span class="fs-4">🎉</span>
                    <div>
                        <div class="fw-bold text-success">
                            Discount Applied ({{ $coupon->discount_precentage }}% OFF)
                        </div>
                        <div class="text-muted small">
                            Code: <span class="badge bg-light text-dark border">{{ $coupon->code }}</span>
                            @if ($coupon->end_date)
                                &bull; Valid until: {{ \Carbon\Carbon::parse($coupon->end_date)->format('M d, Y') }}
                            @endif
                        </div>
                    </div>
                </div>

                <button type="button" wire:click="removeCoupon"
                    class="btn btn-sm btn-link text-danger text-decoration-none" title="Remove coupon">
                    &times; Remove
                </button>
            </div>
        </div>
    @endif

</div>
