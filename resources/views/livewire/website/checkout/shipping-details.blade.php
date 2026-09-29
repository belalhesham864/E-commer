<div>
    <div class="checkout-wrapper">
        <a href="login.html" class="shop-btn">Log into Your Account</a>
        <div class="account-section billing-section">
            <h5 class="wrapper-heading">Billing Details</h5>
            <div class="review-form">
                <div class=" account-inner-form">
                    <div class="review-form-name">
                        <label for="fname" class="form-label">First Name*</label>
                        <input type="text" id="fname" class="form-control" placeholder="First Name">
                    </div>
                    <div class="review-form-name">
                        <label for="lname" class="form-label">Last Name*</label>
                        <input type="text" id="lname" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class=" account-inner-form">
                    <div class="review-form-name">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" id="email" class="form-control" placeholder="user@gmail.com">
                    </div>
                    <div class="review-form-name">
                        <label for="phone" class="form-label">Phone*</label>
                        <input type="tel" id="phone" class="form-control" placeholder="+880388**0899">
                    </div>
                </div>
         <div>

    <label>Country:</label>

    <select name="country_id" id="country_id" wire:model.live="countryId" class="form-control">
        <option value="">Select Country</option>

        @foreach ($countries as $country)
            <option value="{{ $country->id }}">
                {{ $country->name }}
            </option>
        @endforeach
    </select>

<span class="text-danger" id="error-country_id"></span>


    <br>


    <label>GovernRate:</label>

    <select name="governrate_id" id="governrate_id" wire:model.live="governRateId" class="form-control"
        @disabled(empty($countryId))>
        <option value="">Select GovernRate</option>

        @foreach ($governrates as $gov)
            <option value="{{ $gov->id }}">
                {{ $gov->name }}
            </option>
        @endforeach
    </select>

  <span class="text-danger" id="error-governrate_id"></span>


    <br>


    <label>City:</label>

    <select name="city_id" id="city_id" wire:model.live="cityId" class="form-control" @disabled(empty($governRateId))>
        <option value="">Select City</option>

        @foreach ($cities as $city)
            <option value="{{ $city->id }}">
                {{ $city->name }}
            </option>
        @endforeach
    </select>
<span class="text-danger" id="error-city_id"></span>

</div>

                <div class="review-form-name checkbox">
                    <div class="checkbox-item">
                        <input type="checkbox" id="account">
                        <label for="account" class="form-label">
                            Create an account?</label>
                    </div>
                </div>
                <div class="review-form-name shipping">
                    <h5 class="wrapper-heading">Shipping Address</h5>
                    <div class="checkbox-item">
                        <input type="checkbox" id="remember">
                        <label for="remember" class="form-label">
                            Create an account?</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
