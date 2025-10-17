<div class="offcanvas-body">
    <div class="row">
        <div class="col-sm-12">
            <form class="row g-3 needs-validation form-submit-event" id="{{ $formId }}" novalidate=""
                action="{{ $formAction }}" method="POST">
                @csrf
                <input type="hidden" id="add_table" name="table" value="services_availability_table" />
                <div class="card">
                    <div class="card-header d-flex align-items-center border-bottom">
                        <div class="ms-3">
                            <h5 class="mb-0 fs-sm">Add Service</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-12">
                                    <label class="form-label" for="add_match_id">Match</label>
                                    <select class="form-select" id="add_match_id" name="match_id" required
                                        data-with="100%" data-placeholder="Select match...">
                                        <option value="" selected>Select Match</option>
                                        @foreach ($matches as $match)
                                            <option value="{{ $match->id }}">{{ $match->match_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-6 col-md-12">
                                    <label class="form-label" for="add_service_id">Services</label>
                                    <select class="form-select" id="add_service_id" name="service_id" required
                                        data-with="100%" data-placeholder="Select service...">
                                        <option value="" selected>Select Service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue=""
                                    name="max_slots" elementId="edit_max_slots" inputType="number" inputAttributes=""
                                    label="Max Slots" required="required" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue=""
                                    name="available_slots" elementId="edit_available_slots" inputType="number"
                                    inputAttributes="" label="Available Slots" required="required" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-2 mb-3" floating="1" inputValue=""
                                    name="used_slots" elementId="edit_used_slots" inputType="number" inputAttributes=""
                                    label="Used Slots" required="required" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-2 mb-3" floating="1" inputValue=""
                                    name="group_key" elementId="add_group_key" inputType="text" inputAttributes=""
                                    label="Group Key" required="" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-2 mb-3" floating="1" inputValue=""
                                    name="reservation_limit" elementId="add_reservation_limit" inputType="text"
                                    inputAttributes="" label="Reservation Limit" required="" disabled="0" />
                            </div>

                            <div class="col-12 gy-3">
                                <div class="row g-3 justify-content-end">
                                    <a href="javascript:void(0)" class="col-auto">
                                        <button type="button" class="btn btn-phoenix-danger px-5"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            data-bs-dismiss="offcanvas">
                                            Cancel
                                        </button>
                                    </a>
                                    <div class="col-auto">
                                        <button class="btn btn-primary px-5 px-sm-15" id="submit_btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
