<!-- @php
    $globalEventId = session()->get('EVENT_ID');
    // echo $globalEventId;
@endphp -->
<div class="offcanvas-body position-relative">
    <div class="row">
        <div class="col-sm-12">
            <form class="row g-3 needs-validation form-submit-event" id="{{ $formId }}" novalidate=""
                action="{{ $formAction }}" method="POST">
                @csrf
                <input type="hidden" id="add_table" name="table" value="vapp_variation_table" />
                <input type="hidden" id="add_event_id" name="event_id" />
                <div class="card">
                    <div class="card-header d-flex align-items-center border-bottom">
                        <div class="ms-3">
                            <h5 class="mb-0 fs-sm">Add Service variation</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-12" floating="0" selectedValue=""
                                name="event_id" elementId="add_event_id" label="Event" required="required"
                                :forLoopCollection="$events" itemIdForeach="id" itemTitleForeach="name" style=""
                                addDynamicButton="0" />
                        </div> --}}
                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-12" floating="0" selectedValue=""
                                name="service_id" elementId="add_service_id" label="Serivces" required="required"
                                :forLoopCollection="$services" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-sm-6 col-md-12">
                                <label class="form-label" for="add_venue_id">Functional Area assignment
                                    (multiple)</label>
                                <select class="form-select js-select-event-assign-multiple-add_fa_id" id="add_fa_id"
                                    name="fa_id[]" multiple="multiple" data-with="100%"
                                    data-placeholder="Select Fuctional Area...">
                                    <!-- Options loaded dynamically -->
                                </select>
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <x-formy.select_multiple class="col-sm-6 col-md-12" name="venue_id[]"
                                elementId="add_venue_id" label="Venue assignment (multiple)" :forLoopCollection="$venues"
                                itemIdForeach="id" itemTitleForeach="title" required="" style="width: 100%"
                                edit="0" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-12" floating="1" inputValue=""
                                name="max_slots" elementId="add_max_slots" inputType="text" label="Max Slots"
                                required="required" disabled="0" inputAttributes="" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-12" floating="1" inputValue=""
                                name="limit_slots" elementId="add_limit_slots" inputType="text" label="Limit Slots"
                                required="required" disabled="0" inputAttributes="" />
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-sm-6 col-md-12">
                                <label class="form-label" for="add_vapp_size_id">VAPP Size assignment (multiple)</label>
                                <select class="form-select js-select-event-assign-multiple-add_vapp_size_id"
                                    id="add_vapp_size_id" name="vapp_size_id[]" multiple="multiple" data-with="100%"
                                    data-placeholder="VAPP Size assignment (multiple)...">
                                    <!-- Options loaded dynamically -->
                                </select>
                            </div>
                        </div> --}}

                        {{-- <div class="row mb-3">
                            <x-formy.select_multiple class="col-sm-6 col-md-12" name="vapp_size_id[]"
                                elementId="add_vapp_size_id" label="VAPP Size assignment (multiple)" :forLoopCollection="$vappSizes"
                                itemIdForeach="id" itemTitleForeach="title" required="" style="width: 100%"
                                edit="0" />
                        </div> --}}

                        {{-- <div class="col-12 gy-3"> --}}
                        <div class="row g-3 justify-content-end">

                            <div class="col-auto">
                                {{-- <button class="btn btn-primary px-5 " id="submit_btn">Save</button> --}}
                                <a href="javascript:void(0)" class="col-auto">
                                    <button type="button" class="btn btn-phoenix-danger px-5" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-dismiss="offcanvas">
                                        Cancel
                                    </button>
                                </a>
                                <button class="btn btn-primary px-5 " id="submit_btn">Save</button>
                            </div>
                        </div>
                        {{-- </div> --}}
                    </div>
                    <!-- Overlay Spinner -->
                    <div id="offcanvas-spinner-overlay"
                        class="position-absolute top-50 start-50 translate-middle d-none">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
