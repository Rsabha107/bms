<!-- <script src="{{asset('assets/js/custom.js')}}"></script> -->
<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/businesss.js')}}"></script> -->

<input type="hidden" id="add_business_id_h" name="id" value="{{$company_address->id}}">
<input type="hidden" id="add_business_address_table_h" name="table" value="business_address_table">

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Location Name</label>
                <input name="location_name" id="add_location_name" class="form-control" value="{{$company_address->location_name}}" type="text" placeholder="" required>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Address1</label>
                <input name="address1" id="add_business_address1" class="form-control" value="{{$company_address->address1}}" type="text" placeholder="" required>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Address2</label>
                <input name="address2" id="add_business_address2" class="form-control" type="text" value="{{$company_address->address2}}" placeholder="Address2">
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label class="form-label" for="inputEmail4">City</label>
                    <input name="city" id="add_business_city" class="form-control" type="text" value="{{$company_address->city}}" placeholder="City" required>
                </div>

                <div class="col-md-2">
                    <label class="form-label" for="inputEmail4">State</label>
                    <input name="state" id="add_business_state" maxlength="20" class="form-control" type="text" value="{{$company_address->state}}" placeholder="State">
                </div>

                <div class="col-md-5">
                    <label class="form-label" for="inputEmail4">Zipcode</label>
                    <input name="zipcode" id="add_business_zipcode" class="form-control" type="text" value="{{$company_address->zipcode}}" placeholder="00000">
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label" for="inputEmail4">Country</label>
                <select class="form-select" name="country_id" id="add_business_address_country_id" required>
                    <option value="">Select...</option>
                    @foreach ($countries as $key => $item )
                    @if ($company_address->country_id == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->country_name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->country_name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" id="primaryAddress" name="default_address" value="Y" type="checkbox" {{$company_address->default_address?'checked':''}} />
                <label class="form-check-label" for="primaryAddress">Primary address</label>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
</div>