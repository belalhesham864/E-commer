<div>
    <div class="checkout-wrapper">
        <div class="account-section billing-section">
            <h5 class="wrapper-heading">Billing Details</h5>
            <form action="{{ route('checkout.post') }}" method="post">
                @csrf
                <div class="review-form">
                    <div class="account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">First Name*</label>
                            <input type="text" name="first_name" id="fname" value="{{ old('first_name') }}" class="form-control" placeholder="First Name">
                            @error('first_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="lname" class="form-label">Last Name*</label>
                            <input type="text" name="last_name" id="lname" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name">
                            @error('last_name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="user_email" id="email" value="{{ old('user_email') }}" class="form-control" placeholder="user@gmail.com">
                            @error('user_email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="tel" name="user_phone" id="phone" value="{{ old('user_phone') }}" class="form-control" placeholder="+880388**0899">
                            @error('user_phone')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="review-form-name mb-3">
                            <label for="country_id" class="form-label">Country*</label>
                            <select name="country_id" id="country_id" wire:model.live="countryId" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="review-form-name mb-3">
                            <label for="governrate_id" class="form-label">GovernRate*</label>
                            <select name="governrate_id" id="governrate_id" wire:model.live="governRateId" class="form-control" @disabled(empty($countryId))>
                                <option value="">Select GovernRate</option>
                                @foreach ($governrates as $gov)
                                    <option value="{{ $gov->id }}" {{ old('governrate_id') == $gov->id ? 'selected' : '' }}>
                                        {{ $gov->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('governrate_id')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="review-form-name mb-3">
                            <label for="city_id" class="form-label">City*</label>
                            <select name="city_id" id="city_id" wire:model.live="cityId" class="form-control" @disabled(empty($governRateId))>
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="review-form-name mb-3">
                            <label for="street" class="form-label">Street*</label>
                            <input type="text" name="street" id="street" value="{{ old('street') }}" class="form-control" placeholder="Enter your street address">
                            @error('street')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="review-form-name mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea name="note" id="note" placeholder="Add any additional notes (optional)" class="form-control">{{ old('note') }}</textarea>
                            @error('note')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="checkout-btn mt-4">
                        <button type="submit" class="shop-btn w-100">Create Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
