<div class="offcanvas-body">
    <div class="row">
        <div class="col-sm-12">
            <form class="row g-3 needs-validation form-submit-event" id="{{ $formId }}" novalidate=""
                action="{{ $formAction }}" method="POST">
                @csrf
                <input type="hidden" id="add_table" name="table" value="schedule_table" />
                <div class="card">
                    <div class="card-header d-flex align-items-center border-bottom">
                        <div class="ms-3">
                            <h5 class="mb-0 fs-sm">Add Booking Schedule</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue=""
                                name="event_id" elementId="add_event_id" label="Event" required="required"
                                :forLoopCollection="$events" itemIdForeach="id" itemTitleForeach="name" style=""
                                addDynamicButton="0" />

                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue=""
                                name="venue_id" elementId="add_venue_id" label="Venue" required="required"
                                :forLoopCollection="$venues" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />

                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue=""
                                name="rsp_id" elementId="add_rsp_id" label="RSP" required="required"
                                :forLoopCollection="$rsps" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_date_input class="col-sm-6 col-md-3 mb-3" floating="1" inputType="date"
                                inputValue="" name="booking_date" elementId="add_booking_date" label="Booking Date"
                                required="required" />
                            <x-formy.form_date_input class="col-sm-6 col-md-3 mb-3" floating="1" inputType="date"
                                inputValue="" name="slot_visibility" elementId="add_slot_visibility"
                                label="Visible on date" required="required" />

                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue=""
                                name="rsp_booking_slot" elementId="add_rsp_booking_slot" inputType="text" inputAttributes=""
                                label="Booking Slot Time" required="required" disabled="0" />

                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue=""
                                name="venue_arrival_time" elementId="add_venue_arrival_time" inputType="text" inputAttributes=""
                                label="Venue Arrival Time" required="" disabled="0" />
                        </div>
                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="0"
                                name="bookings_slots_all" elementId="add_bookings_slots_all" inputType="number" inputAttributes=""
                                label="Booking Slot (All)" required="required" disabled="0" />
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="0"
                                name="bookings_slots_cat" elementId="add_bookings_slots_cat" inputType="number" inputAttributes=""
                                label="Booking Slot (Category)" required="required" disabled="0" />
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="0"
                                name="available_slots" elementId="add_available_slots" inputType="number" inputAttributes=""
                                label="Available Slots" required="required" disabled="0" />
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="0"
                                name="used_slots" elementId="add_used_slots" inputType="number" label="Used Slots" inputAttributes=""
                                required="required" disabled="0" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue=""
                            name="match_day" elementId="add_match_day" label="Match Day" required=""
                            :forLoopCollection="$globalYn" itemIdForeach="id" itemTitleForeach="title" style=""
                            addDynamicButton="0" />
                        </div>

                        <x-formy.form_textarea class="col-sm-12 col-md-12 mb-3" floating="1" inputValue=""
                            name="comments" elementId="add_comments" label="Comments" required="" disabled="0"/>

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
                                    <button class="btn btn-primary px-5 px-sm-15" id="submit_btn">Create
                                        Project</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
