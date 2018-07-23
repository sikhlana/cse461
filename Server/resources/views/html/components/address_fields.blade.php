<div class="field">
    <label for="ctrl_street_1">Street Address 1</label>
    <input id="ctrl_street_1" name="street_1" value="{{ $address->street_1 }}">
</div>

<div class="field">
    <label for="ctrl_street_2">Street Address 2</label>
    <input id="ctrl_street_2" name="street_2" value="{{ $address->street_2 }}">
</div>

<div class="field">
    <label for="ctrl_city">City</label>
    <input id="ctrl_city" name="city" value="{{ $address->city }}">
</div>

<div class="field">
    <label for="ctrl_state">State</label>
    <input id="ctrl_state" name="state" value="{{ $address->state }}">
</div>

<div class="field">
    <label for="ctrl_country">Country</label>
    <select id="ctrl_country" class="ui fluid search selection dropdown" name="country" data-value="{{ $address->country }}">
        <option value="">Select a country</option>
        @foreach (country()->all() as $code => $name)
            <option value="{{ $code }}">{{ $name }}</option>
        @endforeach
    </select>
</div>