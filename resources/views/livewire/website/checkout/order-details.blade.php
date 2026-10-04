<div>

    <div class="checkout-wrapper">
        <div class="account-section billing-section">
            <h5 class="wrapper-heading">Order Summary</h5>
            <div class="order-summery">
                <div class="subtotal product-total">
                    <h5 class="wrapper-heading">PRODUCT</h5>
                    <h5 class="wrapper-heading">Price</h5>
                    <h5 class="wrapper-heading">TOTAL</h5>
                </div>
                <hr>
                <div class="subtotal product-total">
                    <ul class="product-list">
                        @foreach ($cartItems as $item)
                            <li>
                                <div class="product-info">
                                    <h5 class="wrapper-heading">{{ $item->product->name }} X{{ $item->quantity }}</h5>
                                    <p class="paragraph">
                                        @if ($item->attributes != null)
                                            @foreach ($item->attributes as $attr => $value)
                                                {{ $attr . ':' . $value }}
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
                                <div class="price">
                                    <h5 class="wrapper-heading" style="margin-right: 140px">{{ $item->price }}EGP</h5>
                                    <h5 class="wrapper-heading">{{ $item->quantity * $item->price }}EGP</h5>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <hr>

                {{-- Coupon Section --}}
                <div class="coupon-section my-3">
                    @livewire('website.checkout.coupon')
                </div>
                <hr>

                {{-- Original Price (السعر الأصلي) --}}
                <div class="subtotal product-total">
                    <h5 class="wrapper-heading">ORIGINAL PRICE</h5>
                    <h5 class="wrapper-heading">{{ number_format($originalPrice, 2) }} EGP</h5>
                </div>

                {{-- Coupon Discount Details (تفاصيل الكوبون والخصم لو موجود) --}}
                @if ($coupon && $discountAmount > 0)
                    <div class="subtotal product-total" style="color: #28a745;">
                        <div class="product-info">
                            <h5 class="wrapper-heading" style="color: #28a745;">
                                <i class="fa fa-tag mr-1"></i> COUPON DISCOUNT ({{ $coupon->code }} - {{ $coupon->discount_precentage }}%)
                            </h5>
                        </div>
                        <div class="price">
                            <h5 class="wrapper-heading" style="color: #28a745;">-{{ number_format($discountAmount, 2) }} EGP</h5>
                        </div>
                    </div>

                    <div class="subtotal product-total">
                        <h5 class="wrapper-heading">PRICE AFTER DISCOUNT</h5>
                        <h5 class="wrapper-heading">{{ number_format($subTotalAfterDiscount, 2) }} EGP</h5>
                    </div>
                @endif

                {{-- Shipping Details (تفاصيل الشحن) --}}
                <div class="subtotal product-total">
                    <div class="product-info">
                        <h5 class="wrapper-heading mb-0">SHIPPING</h5>
                        @if ($governRateName)
                            <p class="paragraph text-muted mb-0" style="font-size: 13px;">
                                <i class="fa fa-map-marker text-primary mr-1"></i> Delivery to: <strong>{{ $governRateName }}</strong>
                            </p>
                        @else
                            <p class="paragraph text-muted mb-0" style="font-size: 13px;">
                                <i class="fa fa-info-circle text-muted mr-1"></i> Select governorate to calculate shipping
                            </p>
                        @endif
                    </div>
                    <div class="price">
                        @if ($shippingPrice > 0)
                            <h5 class="wrapper-heading">+{{ number_format($shippingPrice, 2) }} EGP</h5>
                        @else
                            <h5 class="wrapper-heading text-muted">0.00 EGP</h5>
                        @endif
                    </div>
                </div>

                <hr>

                {{-- Final Total (الإجمالي النهائي) --}}
                <div class="subtotal total">
                    <h5 class="wrapper-heading">TOTAL</h5>
                    <h5 class="wrapper-heading price text-primary font-weight-bold">
                        {{ number_format($totalPrice, 2) }} EGP
                    </h5>
                </div>
                <hr>
                <div class="subtotal payment-type">
                    <div class="checkbox-item">
                        <input type="radio" id="bank" name="bank">
                        <div class="bank">
                            <h5 class="wrapper-heading">Direct Bank Transfer</h5>
                            <p class="paragraph">Make your payment directly into our bank account.
                                Please use
                                <span class="inner-text">
                                    your Order ID as the payment reference.
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="checkbox-item">
                        <input type="radio" id="cash" name="bank">
                        <div class="cash">
                            <h5 class="wrapper-heading">Cash on Delivery</h5>
                        </div>
                    </div>
                    <div class="checkbox-item">
                        <input type="radio" id="credit" name="bank">
                        <div class="credit">
                            <h5 class="wrapper-heading">Credit/Debit Cards or Paypal</h5>
                        </div>
                    </div>
                </div>
         
            </div>
        </div>
    </div>
</div>
