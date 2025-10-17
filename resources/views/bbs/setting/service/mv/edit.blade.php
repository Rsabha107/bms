@php
    $menus = App\Models\Bbs\MenuItem::with('children')
        ->orderBy('order_number', 'asc')
        ->orderBy('parent_id', 'asc')
        ->get();
@endphp

<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>
<script>
    // showing the offcanvas for the task creation
    $(document).ready(function() {
        console.log('ready');
        $('.dropify').dropify();

    });
</script>

<input type="hidden" id="edit_service_id" name="id" value="{{ $service->id }}">
<input type="hidden" id="add_table" name="table" value="services_table" />
<div class="card">
    <div class="card-header d-flex align-items-center border-bottom">
        <div class="ms-3">
            <h5 class="mb-0 fs-sm">Update Service</h5>
        </div>
    </div>
    <div class="card-body">

        <div class="row mb-3">

            {{-- <div class="text-center mb-3">
                <div class="mb-3 text-start">
                    <input type="file" name="file_name" class="dropify" data-height="200"
                        data-default-file="{{ !empty($service->image) ? asset('storage/upload/service/images/' . $service->image) : url('storage/upload/default.png') }}" />
            <!-- data-default-file="{{ !empty($service->image) ? route('bbs.setting.service.file', $service->image) : url('storage/upload/default.png') }}" /> -->
        </div>
    </div> --}}

            <div class="row mb-3">
                <div class="col-sm-6 col-md-12">
                    <label class="form-label" for="add_menu_item_id">Menu Item</label>
                    <select class="form-select" id="add_menu_item_id" name="menu_item_id" data-with="100%" required
                        data-placeholder="Select menu...">
                        <option value="" selected>Select Menu Item</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}"
                                {{ $menu->id == $service->menu_item_id ? 'selected' : '' }}>
                                {{ $menu->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <x-formy.form_input class="col-sm-12 col-md-12 mb-3" floating="1" inputValue="{{ $service->title }}"
                    name="title" elementId="add_title" inputType="text" inputAttributes="" label="title"
                    required="required" disabled="0" />
            </div>
            <div class="row mb-3">
                <x-formy.form_input class="col-sm-12 col-md-12 mb-3" floating="1"
                    inputValue="{{ $service->short_description }}" name="short_description"
                    elementId="add_short_description" inputType="text" inputAttributes="" label="short_description"
                    required="required" disabled="0" />
            </div>
            <div class="row mb-3">
                <x-formy.form_text_editor class="col-sm-12 col-md-12 mb-3" inputValue="{!! $service->long_description !!}"
                    elementId="long_description" name="long_description" label="long Description"
                    classLabel="form-label" required="required" disabled="0" />
            </div>

            <div class="row mb-3">
                <x-formy.form_input class="col-sm-12 col-md-4 mb-3" floating="1"
                    inputValue="{{ $service->slots_per_match }}" name="slots_per_match" elementId="edit_slots_per_match"
                    inputType="number" inputAttributes="" label="Slots Per Match" required="required" disabled="0" />
                <x-formy.form_input class="col-sm-12 col-md-4 mb-3" floating="1"
                    inputValue="{{ $service->reservation_limit }}" name="reservation_limit"
                    elementId="edit_reservation_limit" inputType="number" inputAttributes="" label="Reservation Limit"
                    required="required" disabled="0" />
                <x-formy.form_input class="col-sm-12 col-md-4 mb-3" floating="1"
                    inputValue="{{ $service->group_key }}" name="group_key" elementId="edit_group_key"
                    inputType="text" inputAttributes="" label="Group Key" required="" disabled="0" />
                {{-- <x-formy.form_input class="col-sm-6 col-md-4 mb-3" floating="1" inputValue="{{ $service->max_slots }}"
            name="max_slots" elementId="add_max_slots" inputType="number" inputAttributes="" label="Max Slots"
            required="required" disabled="0" />
        <x-formy.form_input class="col-sm-6 col-md-4 mb-3" floating="1"
            inputValue="{{ $service->available_slots }}" name="available_slots" elementId="add_available_slots"
            inputType="number" inputAttributes="" label="Available Slots" required="required" disabled="0" />
        <x-formy.form_input class="col-sm-6 col-md-4 mb-3" floating="1"
            inputValue="{{ $service->used_slots }}" name="used_slots" elementId="add_used_slots"
            inputType="number" label="Used Slots" inputAttributes="" required="required" disabled="0" /> --}}
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
