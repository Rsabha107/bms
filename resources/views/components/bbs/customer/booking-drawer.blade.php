@php
$eventId = session()->get('EVENT_ID');
$venueId = session()->get('VENUE_ID');

// echo $globalEventId;
@endphp
<div class="offcanvas-body">
    <div class="row">
        <div class="col-sm-12">
            <form class="row g-3 needs-validation form-submit-event" id="{{ $formId }}" novalidate=""
                action="{{ $formAction }}" method="POST">
                @csrf
                <input type="hidden" id="add_table" name="table" value="bookings_table" />
                <input type="hidden" id="add_event_id" name="event_id" value="{{ $eventId }}" />
                <input type="hidden" id="add_venue_id" name="venue_id" value="{{ $venueId }}" />
                <div class="card">
                    <div class="card-header d-flex align-items-center border-bottom">
                        <div class="ms-3">
                            <h5 class="mb-0 fs-sm">Add Inventory</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6 col-md-12">
                                <label class="form-label" for="add_service_id">Service</label>
                                <select class="form-select" id="add_service_id" name="service_id" data-with="100%"
                                    data-placeholder="Select Service...">
                                    <option value="" selected>Select Service</option>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <x-formy.form_input class="col-sm-6 col-md-12" floating="1" inputAttributes=""
                                inputValue="" name="quantity" elementId="add_quantity" inputType="text"
                                label="Quantity" required="required" disabled="0" />
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