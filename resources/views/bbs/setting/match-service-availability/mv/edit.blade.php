<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>
<script>
    // showing the offcanvas for the task creation
    $(document).ready(function() {
        console.log('ready');
        $('.dropify').dropify();

    });
</script>

<input type="hidden" id="edit_table" name="table" value="services_availability_table" />
<input type="hidden" id="edit_service_id" name="id" value="{{ $match_service_availability->id }}">
<div class="card">
    <div class="card-header d-flex align-items-center border-bottom">
        <div class="ms-3">
            <h5 class="mb-0 fs-sm">Update Match Service Availability</h5>
        </div>
    </div>
    <div class="card-body">

        <div class="row mb-3">


            <div class="row mb-3">
                <div class="col-sm-6 col-md-12">
                    <label class="form-label" for="edit_match_id">Match</label>
                    <select class="form-select" id="edit_match_id" name="match_id" required data-with="100%"
                        data-placeholder="Select match...">
                        <option value="" selected>Select Match</option>
                        @foreach ($matches as $match)
                            <option value="{{ $match->id }}" {{ $match->id == $match_service_availability->match_id ? 'selected' : '' }}>{{ $match->match_code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 col-md-12">
                    <label class="form-label" for="edit_service_id">Services</label>
                    <select class="form-select" id="edit_service_id" name="service_id" required data-with="100%"
                        data-placeholder="Select service...">
                        <option value="" selected>Select Service</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ $service->id == $match_service_availability->service_id ? 'selected' : '' }}>{{ $service->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue="{{ $match_service_availability->max_slots }}" name="max_slots"
                    elementId="edit_max_slots" inputType="number" inputAttributes="" label="Max Slots"
                    required="required" disabled="0" />
                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue="{{ $match_service_availability->available_slots }}" name="available_slots"
                    elementId="edit_available_slots" inputType="number" inputAttributes="" label="Available Slots"
                    required="required" disabled="0" />
                <x-formy.form_input class="col-sm-12 col-md-2 mb-2" floating="1" inputValue="{{ $match_service_availability->used_slots }}" name="used_slots"
                    elementId="edit_used_slots" inputType="number" inputAttributes="" label="Used Slots"
                    required="required" disabled="0" />
                <x-formy.form_input class="col-sm-12 col-md-2 mb-2" floating="1" inputValue="{{ $match_service_availability->group_key }}" name="group_key"
                    elementId="edit_group_key" inputType="text" inputAttributes="" label="Group Key" required=""
                    disabled="0" />
                <x-formy.form_input class="col-sm-12 col-md-2 mb-2" floating="1" inputValue="{{ $match_service_availability->reservation_limit }}"
                    name="reservation_limit" elementId="add_reservation_limit" inputType="text"
                    inputAttributes="" label="Reservation Limit" required="" disabled="0" />
            </div>

            <div class="col-12 gy-3">
                <div class="row g-3 justify-content-end">
                    <a href="javascript:void(0)" class="col-auto">
                        <button type="button" class="btn btn-phoenix-danger px-5" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-dismiss="offcanvas">
                            Cancel
                        </button>
                    </a>
                    {{-- <button type="button" class="col-auto btn btn-phoenix-primary px-5"
                        data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-dismiss="offcanvas" id="get_tinymce_content">
                        tiny content
                    </button> --}}
                    <div class="col-auto">
                        <button class="btn btn-primary px-5 px-sm-15" id="submit_btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
