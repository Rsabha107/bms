<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>
<script src="{{asset('assets/js/pages/vapp/parking_variation.js')}}"></script>

<script>
    $(".js-select-event-assign-multiple-edit_venue_id").select2({
        closeOnSelect: false,
        placeholder: "Select ...",
    });

    $(".js-select-event-assign-multiple-edit_vapp_size_id").select2({
        closeOnSelect: false,
        placeholder: "Select ...",
    });
</script>

<input type="hidden" name="table" value="vapp_variation_table" />
<input type="hidden" id="edit_variation_id" name="id" value="{{ $variation->id }}">
<!-- <input type="hidden" id="page_refresh_type" value="page_refresh"> -->

<div>
    <div class="card">
        <div class="card-header d-flex align-items-center border-bottom">
            <div class="ms-3">
                <h5 class="mb-0 fs-sm">Edit VAPP Variation</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <x-formy.form_select class="col-sm-6 col-md-12" floating="1" selectedValue="{{ $variation->event_id }}" name="event_id"
                    elementId="edit_event_id" label="Event" required="required" :forLoopCollection="$events" itemIdForeach="id"
                    itemTitleForeach="name" style="" addDynamicButton="0" />
            </div>
            <div class="row mb-3">
                <x-formy.form_select class="col-sm-6 col-md-12" floating="1" selectedValue="{{ $variation->parking_id }}" name="parking_id"
                    elementId="edit_parking_id" label="VAPP Code" required="required" :forLoopCollection="$parkings"
                    itemIdForeach="id" itemTitleForeach="parking_code" style="" addDynamicButton="0" />
            </div>
            <div class="row mb-3">
                <x-formy.form_select class="col-sm-6 col-md-12" floating="1" selectedValue="{{ $variation->match_id }}" name="match_id"
                    elementId="edit_match_id" label="Match Code" required="required" :forLoopCollection="$matchs" itemIdForeach="id"
                    itemTitleForeach="match_code" style="" addDynamicButton="0" />
            </div>
            <div class="row mb-3">
                <x-formy.select_multiple class="col-sm-6 col-md-12" name="venue_id[]" elementId="edit_venue_id"
                    label="Venue assignment (multiple)" :forLoopCollection="$venues" itemIdForeach="id" itemTitleForeach="title"
                    required="" style="width: 100%" edit="1"  :baseModel="$variation" relation="venues" />
            </div>
            <div class="row mb-3">
                <x-formy.select_multiple class="col-sm-6 col-md-12" name="vapp_size_id[]" elementId="edit_vapp_size_id"
                    label="VAPP Size assignment (multiple)" :forLoopCollection="$vappSizes" itemIdForeach="id"
                    itemTitleForeach="title" required="" style="width: 100%" edit="1" :baseModel="$variation" relation="vapp_sizes" />
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
</div>
