<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>

<input type="hidden" name="table" value="schedules_table" />
<input type="hidden" id="edit_schedule_id" name="id" value="{{$schedule->id}}">
<!-- <input type="hidden" id="page_refresh_type" value="page_refresh"> -->

<div>
    <div class="card">
        <div class="card-header d-flex align-items-center border-bottom">
            <div class="ms-3">
                <h5 class="mb-0 fs-sm">Edit Booking Schedule</h5>
            </div>
        </div>
        <div class="card-body">

        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue="{{ $schedule->event_id }}"
                                name="event_id" elementId="add_event_id" label="Event" required="required"
                                :forLoopCollection="$events" itemIdForeach="id" itemTitleForeach="name" style=""
                                addDynamicButton="0" />

                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue="{{ $schedule->venue_id }}"
                                name="venue_id" elementId="add_venue_id" label="Venue" required="required"
                                :forLoopCollection="$venues" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />

                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue="{{ $schedule->rsp_id }}"
                                name="rsp_id" elementId="add_rsp_id" label="RSP" required="required"
                                :forLoopCollection="$rsps" itemIdForeach="id" itemTitleForeach="title" style=""
                                addDynamicButton="0" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_date_input class="col-sm-6 col-md-3 mb-3" floating="1" inputType="text"
                                inputValue="{{ $schedule->booking_date ? \Carbon\Carbon::parse($schedule->booking_date)->format('d/m/Y') : null }}"  name="booking_date" elementId="add_booking_date" label="Booking Date"
                                required="required" />
                            <x-formy.form_date_input class="col-sm-6 col-md-3 mb-3" floating="1" inputType="text"
                                inputValue="{{ $schedule->slot_visibility ? \Carbon\Carbon::parse($schedule->slot_visibility)->format('d/m/Y') : null }}" name="slot_visibility" elementId="add_slot_visibility"
                                label="Visible on date" required="required" />

                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="{{ $schedule->rsp_booking_slot }}"
                                name="rsp_booking_slot" elementId="add_rsp_booking_slot" inputType="text" inputAttributes=""
                                label="Booking Slot Time" required="required" disabled="0" />

                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="{{ $schedule->venue_arrival_time }}"
                                name="venue_arrival_time" elementId="add_venue_arrival_time" inputType="text" inputAttributes=""
                                label="Venue Arrival Time" required="" disabled="0" />
                        </div>
                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="{{ $schedule->bookings_slots_all?$schedule->bookings_slots_all:0 }}"
                                name="bookings_slots_all" elementId="add_bookings_slots_all" inputType="number" inputAttributes=""
                                label="Booking Slot (All)" required="required" disabled="0" />
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="{{ $schedule->bookings_slots_cat?$schedule->bookings_slots_cat:0 }}"
                                name="bookings_slots_cat" elementId="add_bookings_slots_cat" inputType="number" inputAttributes=""
                                label="Booking Slot (Category)" required="required" disabled="0" />
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="{{ $schedule->available_slots?$schedule->available_slots:0 }}"
                                name="available_slots" elementId="add_available_slots" inputType="number" inputAttributes=""
                                label="Available Slots" required="required" disabled="0" />
                            <x-formy.form_input class="col-sm-6 col-md-3 mb-3" floating="1" inputValue="{{ $schedule->used_slots?$schedule->used_slots:0 }}"
                                name="used_slots" elementId="add_used_slots" inputType="number" label="Used Slots" inputAttributes=""
                                required="required" disabled="0" />
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_select class="col-sm-6 col-md-4 mb-3" floating="1" selectedValue="{{ $schedule->match_day }}"
                            name="match_day" elementId="add_match_day" label="Match Day" required=""
                            :forLoopCollection="$globalYn" itemIdForeach="id" itemTitleForeach="title" style=""
                            addDynamicButton="0" />
                        </div>

                        <x-formy.form_textarea class="col-sm-12 col-md-12 mb-3" floating="1" inputValue="{{ $schedule->comments }}"
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
                        <button class="btn btn-primary px-5 px-sm-15" id="submit_btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>