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
