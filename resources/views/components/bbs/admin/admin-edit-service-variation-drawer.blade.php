<div class="offcanvas-body">
    <div class="row">
        <div class="col-sm-12">
            <form class="row g-3 needs-validation form-submit-event" id="{{ $formId }}" novalidate=""
                action="{{ $formAction }}" method="POST">
                @csrf
                <input type="hidden" id="edit_table" name="table" value="service_variation_table" />
                <input type="hidden" id="edit_variation_id" name="id" value="">
                <div class="card">
                    <div class="card-header d-flex align-items-center border-bottom">
                        <div class="ms-3">
                            <h5 class="mb-0 fs-sm">Edit Service variation</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-12" floating="1" selectedValue=""
                                name="event_id" elementId="edit_event_id" label="Event" required="required"
                                :forLoopCollection="$events" itemIdForeach="id" itemTitleForeach="name" style=""
                                addDynamicButton="0" />
                        </div>
                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-12" floating="1" selectedValue=""
                                name="service_id" elementId="edit_service_id" label="Services" required="required"
                                :forLoopCollection="$services" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />
                        </div>
                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-12" floating="1" selectedValue=""
                                name="venue_id" elementId="edit_venue_id" label="Venue" required="required"
                                :forLoopCollection="$venues" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-12" floating="1" inputValue=""
                                name="max_slots" elementId="edit_max_slots" inputType="text" label="Max Slots"
                                required="required" disabled="0" inputAttributes="" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-12" floating="1" inputValue=""
                                name="limit_slots" elementId="edit_limit_slots" inputType="text" label="Limit Slots"
                                required="required" disabled="0" inputAttributes="" />
                        </div>

                        <div class="col-12 gy-3">
                            <div class="row g-3 justify-content-end">
                                <a href="javascript:void(0)" class="col-auto">
                                    <button type="button" class="btn btn-phoenix-danger px-5" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-dismiss="offcanvas">
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
            </form>
        </div>
    </div>
</div>