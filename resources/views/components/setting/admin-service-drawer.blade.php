<div class="offcanvas-body">
    <div class="row">
        <div class="col-sm-12">
            <form class="row g-3 needs-validation form-submit-event" id="{{ $formId }}" novalidate=""
                action="{{ $formAction }}" method="POST">
                @csrf
                <input type="hidden" id="add_table" name="table" value="services_table" />
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
                                    <label class="form-label" for="add_menu_item_id">Menu Item</label>
                                    <select class="form-select" id="add_menu_item_id" name="menu_item_id" required
                                        data-with="100%" data-placeholder="Select menu...">
                                        <option value="" selected>Select Menu Item</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <x-formy.form_input class="col-sm-12 col-md-12 mb-3" floating="1" inputValue=""
                                    name="title" elementId="add_title" inputType="text" inputAttributes=""
                                    label="title" required="required" disabled="0" />
                            </div>
                            <div class="row mb-3">
                                <x-formy.form_input class="col-sm-12 col-md-12 mb-3" floating="1" inputValue=""
                                    name="short_description" elementId="add_short_description" inputType="text"
                                    inputAttributes="" label="short_description" required="required" disabled="0" />
                            </div>
                            <div class="row mb-3">
                                <x-formy.form_text_editor class="col-sm-12 col-md-12 mb-3" inputValue=""
                                    elementId="long_description" name="long_description" label="long Description"
                                    classLabel="form-label" required="required" disabled="0" />
                            </div>

                            <div class="row mb-3">
                                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue=""
                                    name="slots_per_match" elementId="edit_slots_per_match" inputType="number"
                                    inputAttributes="" label="Slots Per Match" required="required" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue=""
                                    name="reservation_limit" elementId="edit_reservation_limit" inputType="number"
                                    inputAttributes="" label="Reservation Limit" required="required" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue=""
                                    name="unit_price" elementId="edit_unit_price" inputType="number"
                                    inputAttributes="" label="Unit Price" required="required" disabled="0" />
                                <x-formy.form_input class="col-sm-12 col-md-3 mb-3" floating="1" inputValue=""
                                    name="group_key" elementId="add_group_key" inputType="text" inputAttributes=""
                                    label="Group Key" required="" disabled="0" />
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
