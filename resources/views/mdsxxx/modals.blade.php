

@if (Request::is('mds/setting/schedule'))
<!-- schedules modal -->
<div class="modal fade" id="create_schedules_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_schedules', 'Create schedule') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('mds.setting.schedule.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="schedules_table">
                <div class="modal-body">

                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="inputEmail4"><?= get_label('regime_start_date', 'Regime start date') ?></label>
                        <input class="form-control datetimepicker" data-target="#floatingInputStartDate" name="regime_start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="inputEmail4"><?= get_label('regime_end_date', 'Regime end date') ?></label>
                        <input class="form-control datetimepicker" data-target="#floatingInputEndDate" name="regime_end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                    </div>

                    <div class="mb-2 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('venue', 'Venue') ?><span class="asterisk">*</span></label>
                        <select class="form-select" name="schedule_venue_id" required>
                            <option value="" selected>Select venue...</option>
                            @foreach ($venues as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('rsp', 'RSP') ?><span class="asterisk">*</span></label>
                        <select class="form-select" name="schedule_rsp_id" required>
                            <option value="" selected>Select RSP...</option>
                            @foreach ($rsps as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('timeslots', 'Timeslots') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="time_slots" placeholder="<?= get_label('please_enter_timeslots', 'Please enter timeslots') ?>" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_schedules_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('mds.setting.schedule.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_schedules_id" name="id" value="">
                <input type="hidden" id="edit_schedules_table" name="table">
                <div class="modal-body">

                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="inputEmail4"><?= get_label('regime_start_date', 'Regime start date') ?></label>
                        <input class="form-control datetimepicker" data-target="#floatingInputStartDate" id="edit_regime_start_date" name="regime_start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label class="form-label" for="inputEmail4"><?= get_label('regime_end_date', 'Regime end date') ?></label>
                        <input class="form-control datetimepicker" data-target="#floatingInputEndDate" id="edit_regime_end_date" name="regime_end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                    </div>

                    <div class="mb-2 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('venue', 'Venue') ?><span class="asterisk">*</span></label>
                        <select class="form-select" name="schedule_venue_id" id="edit_schedule_venue_id" required>
                            <option value="" selected>Select venue...</option>
                            @foreach ($venues as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('rsp', 'RSP') ?><span class="asterisk">*</span></label>
                        <select class="form-select" name="schedule_rsp_id" id="edit_schedule_rsp_id" required>
                            <option value="" selected>Select RSP...</option>
                            @foreach ($rsps as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('timeslots', 'Timeslots') ?> <span class="asterisk">*</span></label>
                        <input required type="text" class="form-control" id="edit_time_slots" name="time_slots" placeholder="<?= get_label('please_enter_timeslots', 'Please enter timeslots') ?>" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif


@if (Request::is('mds/setting/driver*'))
<!-- drivers modal -->
<div class="modal fade" id="create_drivers_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_drivers', 'Create vehicle types') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('mds.setting.driver.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="drivers_table">
                <div class="modal-body">

                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('first_name', 'First Name') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="first_name" placeholder="<?= get_label('please_enter_first_name', 'Please enter first name') ?>" />
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('last_name', 'Last Name') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="last_name" placeholder="<?= get_label('please_enter_last_name', 'Please enter last name') ?>" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('mobile_number', 'Mobile Number') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="mobile_number" placeholder="<?= get_label('please_enter_mobile_number', 'Please enter mobile number') ?>" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('qid_passport', 'QID/Passport') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="national_identifier_number" placeholder="<?= get_label('please_enter_national_identifier_number', 'Please enter QID/Passport') ?>" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_drivers_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('mds.setting.driver.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_drivers_id" name="id" value="">
                <input type="hidden" id="edit_drivers_table" name="table">
                <div class="modal-body">
                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('first_name', 'First Name') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="edit_drivers_first_name" class="form-control" name="first_name" placeholder="<?= get_label('please_enter_first_name', 'Please enter first name') ?>" />
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('last_name', 'Last Name') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="edit_drivers_last_name" class="form-control" name="last_name" placeholder="<?= get_label('please_enter_last_name', 'Please enter last name') ?>" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('mobile_number', 'Mobile Number') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="edit_drivers_mobile_number" class="form-control" name="mobile_number" placeholder="<?= get_label('please_enter_mobile_number', 'Please enter mobile number') ?>" />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="nameBasic" class="form-label"><?= get_label('qid_passport', 'QID/Passport') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="edit_drivers_national_identifier_number" class="form-control" name="national_identifier_number" placeholder="<?= get_label('please_enter_national_identifier_number', 'Please enter QID/Passport') ?>" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="driverStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('mds.driver.status.update')}}" method="POST" id="task_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/task/status/update')}}" method="POST" id="task_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="editDriverId" name="id">
                                <input type="hidden" id="driverStatusTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Status</label>
                                    <select name="status_id" class="form-select" id="editDriverStatusSelection" required>
                                        <option selected="selected" value="">Select</option>
                                        @foreach ($driver_statuses as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endif


@if (Request::is('mds/setting/delivery_type*'))
<!-- delivery_types modal -->
<div class="modal fade" id="create_delivery_types_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_delivery_types', 'Create delivery types') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('mds.setting.delivery_type.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="delivery_types_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_delivery_types_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('mds.setting.delivery_type.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_delivery_types_id" name="id" value="">
                <input type="hidden" id="edit_delivery_types_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_delivery_types_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('mds/setting/venue*'))
<!-- venues modal -->
<div class="modal fade" id="create_venues_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_venues', 'Create venues') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('bbs.setting.venue.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="venues_table">
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('short_name', 'Short Name') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="short_name" placeholder="<?= get_label('please_enter_short_name', 'Please enter short name') ?>" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_venues_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('bbs.setting.venue.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_venues_id" name="id" value="">
                <input type="hidden" id="edit_venues_table" name="table">
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('short_name', 'Short Name') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="edit_venues_short_name" class="form-control" name="short_name" placeholder="<?= get_label('please_enter_short_name', 'Please enter short name') ?>" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_venues_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- End Modals for bbs -->


@if (Request::is('tracki/employee_addressxxx'))
<!-- //****************************************** add employee_address modal ******************************************/ */ -->

<div class="modal fade" id="add_employee_address_modal_wizard" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_address_modal_label"><?= get_label('add_employee_address', 'Add employee_address') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <!-- <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_address_form" novalidate="" action="{{ route ('tracki.employee_address.store') }}" method="POST"> -->
            <!-- @csrf -->

            <!-- <input type="hidden" id="add_employee_address_id_h" name="id" value="">
                <input type="hidden" id="add_employee_address_table_h" name="table" value=""> -->

            <div class="modal-body">
                <!-- <div class="p-4 code-to-copy"> -->
                <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">
                    <div class="card-header bg-body-highlight pt-3 pb-2 border-bottom-0">
                        <ul class="nav justify-content-between nav-wizard nav-wizard-success">
                            <li class="nav-item"><a class="nav-link active fw-semibold" href="#bootstrap-wizard-tab1" data-bs-toggle="tab" data-wizard-step="1">
                                    <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-lock"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Account</span></div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab2" data-bs-toggle="tab" data-wizard-step="2">
                                    <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-lock"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Account</span></div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab3" data-bs-toggle="tab" data-wizard-step="3">
                                    <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-user"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Personal</span></div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab4" data-bs-toggle="tab" data-wizard-step="4">
                                    <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-file-alt"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Billing</span></div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link fw-semibold" href="#bootstrap-wizard-tab5" data-bs-toggle="tab" data-wizard-step="5">
                                    <div class="text-center d-inline-block"><span class="nav-item-circle-parent"><span class="nav-item-circle"><span class="fas fa-check"></span></span></span><span class="d-none d-md-block mt-1 fs-9">Done</span></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body pt-4 pb-0">
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-wizard-tab1" id="bootstrap-wizard-tab1">
                                <form id="wizardForm1" novalidate="novalidate" data-wizard-form="1">
                                    <div class="row mb-3">
                                        <!-- begining of left div -->
                                        <div class="col-md-6">
                                            <!-- <div class="mb-3 row"> -->

                                            <div class="col-md-12">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">employee_address Type</label>
                                                <select class="form-select" name="employee_address_type" id="add_employee_address_employee_address_type" required="required">
                                                    <option value="">Select ...</option>
                                                    @foreach ($employee_address_types as $key => $item )
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label" for="inputAddress">Prefix</label>
                                                <select name="salutation" class="form-select" id="add_employee_address_salutation">
                                                    <option selected="selected" value="">Select...</option>
                                                    @foreach ($salutations as $key => $item )
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>

                                            <!-- </div> -->

                                            <!-- <div class="mb-3 row"> -->
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">First Name</label>
                                                <input name="first_name" id="add_employee_address_first_name" class="form-control" type="text" placeholder="" required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Middle Name</label>
                                                <input name="middle_name" id="add_employee_address_middle_name" class="form-control" type="text" placeholder="">
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Last Name</label>
                                                <input name="last_name" id="add_employee_address_last_name" class="form-control" type="text" placeholder="" required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <!-- </div> -->
                                            <!-- <div class="mb-3 row"> -->
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Email</label>
                                                <input name="email_address" id="add_employee_address_email_address" class="form-control" type="text" placeholder="" required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">National Identificaton Number</label>
                                                <input name="national_identifier_number" id="add_employee_address_national_identifier_number" class="form-control" type="text" placeholder="" required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <!-- </div> -->

                                            <!-- <div class="mb-3 row"> -->
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Phone</label>
                                                <input name="phone_number" id="add_employee_address_phone_number" class="form-control" type="text" placeholder="" required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <label class="form-label" for="inputEmail4">Alternate Phone</label>
                                                <input name="alt_phone_number" id="add_employee_address_alt_phone_number" class="form-control" type="text" placeholder="">
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <!-- </div> -->
                                            <div class="col-md-12">
                                                <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                                            </div>
                                        </div>
                                        <!-- end of left div -->

                                        <!-- begining of right div -->
                                        <div class="col-md-6 mb-3">
                                            <!-- <div class="mb-3 row"> -->
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Birth Date</label>
                                                <input class="form-control datetimepicker" id="add_employee_address_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Town of birth</label>
                                                <input name="town_of_birth" id="add_employee_address_town_of_birth" class="form-control" type="text" placeholder="" required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <!-- </div> -->
                                            <!-- <div class="mb-3 row"> -->
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Hire Date</label>
                                                <input class="form-control datetimepicker" id="edit_employee_address_date_of_hire" data-target="#floatingInputStartDate" name="date_of_hire" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="inputEmail4">Joining Date</label>
                                                <input class="form-control datetimepicker" id="edit_employee_address_join_date" data-target="#floatingInputStartDate" name="join_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <!-- </div> -->
                                            <div class="col-md-12">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">Gender</label>
                                                <select class="form-select" name="gender" id="add_employee_address_gender" required="required">
                                                    <option value="">Select ...</option>
                                                    @foreach ($genders as $key => $item )
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                                                <select class="form-select" name="marital_status" id="add_employee_address_marital_status" required="required">
                                                    <option value="">Select ...</option>
                                                    @foreach ($marital_statuses as $key => $item )
                                                    <option value="{{ $item->id  }}" selected>
                                                        {{ $item->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">Language</label>
                                                <select class="form-select" name="language" id="add_employee_address_language" required="required">
                                                    <option value="">Select ...</option>
                                                    <option value="1">English</option>
                                                    <option value="2">French</option>
                                                    <option value="3">Spanish</option>
                                                    <option value="4">Others</option>
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                                                <select class="form-select" name="country_of_birth" id="add_employee_address_country_of_birth" required="required">
                                                    <option value="">Select ...</option>
                                                    @foreach ($countries as $key => $item )
                                                    @if (Request::old('id') == $item->id )
                                                    <option value="{{ $item->id  }}" selected>
                                                        {{ $item->country_name }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->country_name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>



                                            <div class="col-md-12">
                                                <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                                                <select class="form-select" name="nationality" id="add_employee_address_nationality" required="required">
                                                    <option value="">Select ...</option>
                                                    @foreach ($nationalities as $key => $item )
                                                    @if (Request::old('id') == $item->id )
                                                    <option value="{{ $item->id  }}" selected>
                                                        {{ $item->nationality }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->nationality }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                                            </div>
                                        </div>

                                        <!-- end of right div -->
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab2" id="bootstrap-wizard-tab2">
                                <form id="wizardForm2" novalidate="novalidate" data-wizard-form="2">
                                    <div class="mb-2">
                                        <label class="form-label text-body" for="bootstrap-wizard-wizard-name">Name</label>
                                        <input class="form-control" type="text" name="name" placeholder="John Smith" id="bootstrap-wizard-wizard-name" />
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="bootstrap-wizard-wizard-email">Email*</label>
                                        <input class="form-control" type="email" name="email" placeholder="Email address" pattern="^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$" id="bootstrap-wizard-wizard-email" />
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6">
                                            <div class="mb-2 mb-sm-0">
                                                <label class="form-label text-body" for="bootstrap-wizard-wizard-password">Password*</label>
                                                <input class="form-control" type="password" name="password" placeholder="Password" id="bootstrap-wizard-wizard-password" data-wizard-password="true" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-2">
                                                <label class="form-label text-body" for="bootstrap-wizard-wizard-confirm-password">Confirm Password*</label>
                                                <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password" id="bootstrap-wizard-wizard-confirm-password" data-wizard-confirm-password="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" checked="checked" id="bootstrap-wizard-wizard-checkbox" />
                                        <label class="form-check-label text-body" for="bootstrap-wizard-wizard-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab3" id="bootstrap-wizard-tab3">
                                <form id="wizardForm3" novalidate="novalidate" data-wizard-form="3">
                                    <div class="row g-4 mb-4" data-dropzone="data-dropzone" data-options='{"maxFiles":1,"data":[{"name":"avatar.webp","size":"54kb","url":"../../assets/img/team"}]}'>
                                        <div class="fallback">
                                            <input type="file" name="file" />
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="dz-preview dz-preview-single">
                                                <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                                    <div class="avatar avatar-4xl"><img class="rounded-circle avatar-placeholder" src="../../assets/img/team/avatar.webp" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="dz-message dropzone-area px-2 py-3" data-dz-message="data-dz-message">
                                                <div class="text-center text-body-emphasis">
                                                    <h5 class="mb-2"><span class="fa-solid fa-upload me-2"></span>Upload Profile Picture</h5>
                                                    <p class="mb-0 fs-9 text-body-tertiary text-opacity-85 lh-sm">Upload a 300x300 jpg image with <br />a maximum size of 400KB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="bootstrap-wizard-gender">Gender</label>
                                        <select class="form-select" name="gender" id="bootstrap-wizard-gender">
                                            <option value="">Select your gender ...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="bootstrap-wizard-wizard-phone">Phone</label>
                                        <input class="form-control" type="text" name="phone" placeholder="Phone" id="bootstrap-wizard-wizard-phone" />
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="bootstrap-wizard-wizard-datepicker">Date of Birth</label>
                                        <input class="form-control datetimepicker" type="text" placeholder="d/m/y" data-options='{"dateFormat":"d/m/y","disableMobile":true}' id="bootstrap-wizard-wizard-datepicker" />
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label" for="bootstrap-wizard-wizard-address">Address</label>
                                        <textarea class="form-control" rows="4" id="bootstrap-wizard-wizard-address"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab4" id="bootstrap-wizard-tab4">
                                <form class="mb-2" id="wizardForm4" novalidate="novalidate" data-wizard-form="4">
                                    <div class="row gx-3 gy-2">
                                        <div class="col-6">
                                            <label class="form-label" for="bootstrap-wizard-card-number">Card Number</label>
                                            <input class="form-control" placeholder="XXXX XXXX XXXX XXXX" type="text" id="bootstrap-wizard-card-number" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="bootstrap-wizard-card-name">Name</label>
                                            <input class="form-control" placeholder="John Doe" name="cardName" type="text" id="bootstrap-wizard-card-name" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="bootstrap-wizard-card-holder-country">Country</label>
                                            <select class="form-select" name="customSelectCountry" id="bootstrap-wizard-card-holder-country">
                                                <option value="">Select your country ...</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="bootstrap-wizard-card-holder-zip-code">Zip</label>
                                            <input class="form-control" placeholder="1234" name="zipCode" type="text" id="bootstrap-wizard-card-holder-zip-code" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="bootstrap-wizard-card-exp-date">Date of Expire</label>
                                            <input class="form-control" placeholder="15/2024" name="expDate" type="text" id="bootstrap-wizard-card-exp-date" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="bootstrap-wizard-card-cvv">CVV</label>
                                            <input class="form-control" placeholder="123" name="cvv" maxlength="3" pattern="[0-9]{3}" type="number" id="bootstrap-wizard-card-cvv" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-wizard-tab5" id="bootstrap-wizard-tab5">
                                <div class="row flex-center pb-8 pt-4 gx-3 gy-4">
                                    <div class="col-12 col-sm-auto">
                                        <div class="text-center text-sm-start"><img class="d-dark-none" src="../../assets/img/spot-illustrations/38.webp" alt="" width="220" /><img class="d-light-none" src="../../assets/img/spot-illustrations/dark_38.webp" alt="" width="220" /></div>
                                    </div>
                                    <div class="col-12 col-sm-auto">
                                        <div class="text-center text-sm-start">
                                            <h5 class="mb-3">You are all set!</h5>
                                            <p class="text-body-emphasis fs-9">Now you can access your account<br />anytime anywhere</p><a class="btn btn-primary px-6" href="../../modules/forms/wizard.html">Start Over</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top-0" data-wizard-footer="data-wizard-footer">
                        <div class="d-flex pager wizard list-inline mb-0">
                            <button class="d-none btn btn-link ps-0" type="button" data-wizard-prev-btn="data-wizard-prev-btn"><span class="fas fa-chevron-left me-1" data-fa-transform="shrink-3"></span>Previous</button>
                            <div class="flex-1 text-end">
                                <button class="btn btn-primary px-6 px-sm-6" type="submit" data-wizard-next-btn="data-wizard-next-btn">Next<span class="fas fa-chevron-right ms-1" data-fa-transform="shrink-3"> </span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div> -->
            <!-- </form> -->
        </div>
    </div>
</div>

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <div class="modal-header justify-content-between border-gray-100 p-3">
                <h4 class="text-body-secondary mb-0">Access Denied!</h4>
                <button class="btn p-0 btn-link text-danger" data-bs-dismiss="modal"><span class="fas fa-times"></span></button>
            </div>
            <div class="modal-body px-4 py-6">
                <div class="d-flex align-items-center"><img class="me-4" src="../../assets/img/icons/stop.png" alt="" />
                    <div class="flex-1">
                        <p class="mb-0 fw-semibold text-body-tertiary">You do not have the link to access. Please start <br />over to get access for the next session.<br />Thank You!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add_employee_modal_tab" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee', 'Add employee') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <div class="modal-body">

                <div id="smartwizard" dir="rtl-">
                    <ul class="nav nav-progress mb-3">
                        <li class="nav-item">
                            <a class="nav-link" href="#step-1">
                                <div class="num">1</div>
                                Basic Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-2">
                                <span class="num">2</span>
                                Assignment Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-3">
                                <span class="num">3</span>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-4">
                                <span class="num">4</span>
                                Confirm Order
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#step-5">
                                <span class="num">5</span>
                                Confirm Order
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <form class="row g-3  px-3 needs-validation form-submit-event" id="form-1" novalidate method="POST">
                                <!-- <form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate> -->
                                <div class="row mb-3">
                                    <!-- begining of left div -->
                                    <div class="col-md-6">
                                        <!-- <div class="mb-3 row"> -->

                                        <div class="col-md-12">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Employee Type</label>
                                            <select class="form-select" name="employee_type" id="add_employee_employee_type" required="required">
                                                <option value="">Select ...</option>
                                                @foreach ($employee_types as $key => $item )
                                                <option value="{{ $item->id  }}">
                                                    {{ $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="inputAddress">Prefix</label>
                                            <select name="salutation" class="form-select" id="add_employee_salutation">
                                                <option selected="selected" value="">Select...</option>
                                                @foreach ($salutations as $key => $item )
                                                <option value="{{ $item->id  }}">
                                                    {{ $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>

                                        <!-- </div> -->

                                        <!-- <div class="mb-3 row"> -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">First Name</label>
                                            <input name="first_name" id="add_employee_first_name" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Middle Name</label>
                                            <input name="middle_name" id="add_employee_middle_name" class="form-control" type="text" placeholder="">
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Last Name</label>
                                            <input name="last_name" id="add_employee_last_name" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <!-- </div> -->
                                        <!-- <div class="mb-3 row"> -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Email</label>
                                            <input name="email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">National Identificaton Number</label>
                                            <input name="national_identifier_number" id="add_employee_national_identifier_number" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <!-- </div> -->

                                        <!-- <div class="mb-3 row"> -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Phone</label>
                                            <input name="phone_number" id="add_employee_phone_number" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label" for="inputEmail4">Alternate Phone</label>
                                            <input name="alt_phone_number" id="add_employee_alt_phone_number" class="form-control" type="text" placeholder="">
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <!-- </div> -->
                                        <div class="col-md-12">
                                            <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                                        </div>
                                    </div>
                                    <!-- end of left div -->

                                    <!-- begining of right div -->
                                    <div class="col-md-6 mb-3">
                                        <!-- <div class="mb-3 row"> -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Birth Date</label>
                                            <input class="form-control datetimepicker" id="add_employee_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Town of birth</label>
                                            <input name="town_of_birth" id="add_employee_town_of_birth" class="form-control" type="text" placeholder="" required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <!-- </div> -->
                                        <!-- <div class="mb-3 row"> -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Hire Date</label>
                                            <input class="form-control datetimepicker" id="edit_employee_date_of_hire" data-target="#floatingInputStartDate" name="date_of_hire" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="inputEmail4">Joining Date</label>
                                            <input class="form-control datetimepicker" id="edit_employee_join_date" data-target="#floatingInputStartDate" name="join_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <!-- </div> -->
                                        <div class="col-md-12">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Gender</label>
                                            <select class="form-select" name="gender" id="add_employee_gender" required="required">
                                                <option value="">Select ...</option>
                                                @foreach ($genders as $key => $item )
                                                <option value="{{ $item->id  }}">
                                                    {{ $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                                            <select class="form-select" name="marital_status" id="add_employee_marital_status" required="required">
                                                <option value="">Select ...</option>
                                                @foreach ($marital_statuses as $key => $item )
                                                <option value="{{ $item->id  }}" selected>
                                                    {{ $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Language</label>
                                            <select class="form-select" name="language" id="add_employee_language" required="required">
                                                <option value="">Select ...</option>
                                                <option value="1">English</option>
                                                <option value="2">French</option>
                                                <option value="3">Spanish</option>
                                                <option value="4">Others</option>
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                                            <select class="form-select" name="country_of_birth" id="add_employee_country_of_birth" required="required">
                                                <option value="">Select ...</option>
                                                @foreach ($countries as $key => $item )
                                                @if (Request::old('id') == $item->id )
                                                <option value="{{ $item->id  }}" selected>
                                                    {{ $item->country_name }}
                                                </option>
                                                @else
                                                <option value="{{ $item->id  }}">
                                                    {{ $item->country_name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>



                                        <div class="col-md-12">
                                            <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                                            <select class="form-select" name="nationality" id="add_employee_nationality" required="required">
                                                <option value="">Select ...</option>
                                                @foreach ($nationalities as $key => $item )
                                                @if (Request::old('id') == $item->id )
                                                <option value="{{ $item->id  }}" selected>
                                                    {{ $item->nationality }}
                                                </option>
                                                @else
                                                <option value="{{ $item->id  }}">
                                                    {{ $item->nationality }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <!-- <div class="invalid-feedback">This field is required.</div> -->
                                        </div>
                                    </div>

                                    <!-- end of right div -->
                                </div>

                            </form>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label">Product</label>
                                    <select class="form-select" id="sel-products" name="product" multiple required>
                                        <option value="Apple iPhone 13" selected>Apple iPhone 13</option>
                                        <option value="Apple iPhone 12">Apple iPhone 12</option>
                                        <option value="Samsung Galaxy S10">Samsung Galaxy S10</option>
                                        <option value="Motorola G5">Motorola G5</option>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please select product.</div>
                                </div>
                            </form>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                <div class="col">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="1234 Main St" placeholder="1234 Main St" required="" />
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="validationCustom04" class="form-label">State</label>
                                    <select class="form-select" id="state" name="state" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option>State 1</option>
                                        <option>State 2</option>
                                        <option>State 3</option>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please select a valid state.</div>
                                </div>
                                <div class="col">
                                    <label for="validationCustom05" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="00000" required />
                                    <div class="invalid-feedback">Please provide a valid zip.</div>
                                </div>
                            </form>
                        </div>
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <form id="form-4" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                <div class="col">
                                    <div class="mb-3 text-muted">
                                        Please confirm your order details
                                    </div>

                                    <div id="order-detailsx"></div>

                                    <h4 class="mt-3">Payment</h4>
                                    <hr class="my-2" />

                                    <div class="row gy-3">
                                        <div class="col-md-3">
                                            <label for="cc-name" class="form-label">Name on card</label>
                                            <input type="text" class="form-control" id="cc-name" value="My Name" placeholder="" required="" />
                                            <small class="text-muted">Full name as displayed on card</small>
                                            <div class="invalid-feedback">Name on card is required</div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-number" class="form-label">Credit card number</label>
                                            <input type="text" class="form-control" id="cc-number" value="54545454545454" placeholder="" required="" />
                                            <div class="invalid-feedback">
                                                Credit card number is required
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-expiration" class="form-label">Expiration</label>
                                            <input type="text" class="form-control" id="cc-expiration" value="1/28" placeholder="" required="" />
                                            <div class="invalid-feedback">Expiration date required</div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="cc-cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" value="123" placeholder="" required="" />
                                            <div class="invalid-feedback">Security code required</div>
                                        </div>

                                        <div class="col">
                                            <input type="checkbox" checked class="form-check-input" id="save-info" required />
                                            <label class="form-check-label" for="save-info">I agree to the terms and conditions</label>
                                        </div>

                                        <small class="text-muted">This is an example page, do not enter any real data, even
                                            tho we don't submit this information!</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="step-5" class="tab-pane" role="tabpanel" aria-labelledby="step-5">
                            <form id="form-5" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                <div class="col">
                                    <div class="mb-3 text-muted">
                                        Please confirm your order details
                                    </div>

                                    <div id="order-details"></div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee'))
<div class="modal fade" id="add_employee_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('add_employee', 'Add employee') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_form" novalidate="" action="{{ route ('tracki.employee.store') }}" method="POST">
                @csrf

                <input type="hidden" id="add_employee_id_h" name="id" value="">
                <input type="hidden" id="add_employee_table_h" name="table" value="employee_table">

                <div class="modal-body">
                    <div class="row">
                        <!-- begining of left div -->
                        <div class="col-md-8">
                            <div class="mb-3 row">

                                <div class="col-md-6">
                                    <label class="form-label" for="inputAddress">Prefix</label>
                                    <select name="salutation" class="form-select" id="add_employee_salutation">
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($salutations as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">National Identificaton Number</label>
                                    <input name="national_identifier_number" id="add_employee_national_identifier_number" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">First Name</label>
                                    <input name="first_name" id="add_employee_first_name" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">Middle Name</label>
                                    <input name="middle_name" id="add_employee_middle_name" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="inputEmail4">Last Name</label>
                                    <input name="last_name" id="add_employee_last_name" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Personal Email</label>
                                    <input name="email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Work Email</label>
                                    <input name="email_address" id="add_employee_email_address" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Department</label>
                                    <select class="form-select" name="department_id" id="add_department_id" required>
                                        <option value="">Select...</option>
                                        @foreach ($departments as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Designation</label>
                                    <select class="form-select" name="designation_id" id="add_designation_id" required>
                                        <option value="">Select...</option>
                                        @foreach ($designations as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Phone</label>
                                    <input name="phone_number" id="add_employee_phone_number" class="form-control" type="text" placeholder="" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Alternate Phone</label>
                                    <input name="alt_phone_number" id="add_employee_alt_phone_number" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Birth Date</label>
                                    <input class="form-control datetimepicker" id="add_employee_date_of_birth" data-target="#floatingInputStartDate" name="date_of_birth" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Town of birth</label>
                                    <input name="town_of_birth" id="add_employee_town_of_birth" class="form-control" type="text" placeholder="">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Hire Date</label>
                                    <input class="form-control datetimepicker" id="edit_employee_date_of_hire" data-target="#floatingInputStartDate" name="date_of_hire" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Joining Date</label>
                                    <input class="form-control datetimepicker" id="edit_employee_join_date" data-target="#floatingInputStartDate" name="join_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                            </div>
                        </div>
                        <!-- end of left div -->

                        <!-- begining of right div -->
                        <div class="col-md-4">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="bootstrap-wizard-validation-gender">Employee Type</label>
                                <select class="form-select" name="employee_type" id="add_employee_employee_type" required="required">
                                    <option value="">Select ...</option>
                                    @foreach ($employee_types as $key => $item )
                                    <option value="{{ $item->id  }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>

                            <div class="mb-3 row">

                                <div class="col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Report to</label>
                                    <select class="form-select" name="reporting_to_id" id="add_employee_reporting_to_id" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($emps as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->first_name}} {{$item->last_name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->first_name}} {{$item->last_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Gender</label>
                                    <select class="form-select" name="gender" id="add_employee_gender" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($genders as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Marital Status</label>
                                    <select class="form-select" name="marital_status" id="add_employee_marital_status" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($marital_statuses as $key => $item )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <!-- <div class="col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Language</label>
                                    <select class="form-select" name="language" id="add_employee_language" required="required">
                                        <option value="">Select ...</option>
                                        <option value="1">English</option>
                                        <option value="2">French</option>
                                        <option value="3">Spanish</option>
                                        <option value="4">Others</option>
                                    </select>
                                </div> -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Country of birth</label>
                                    <select class="form-select" name="country_of_birth" id="add_employee_country_of_birth" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($countries as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->country_name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->country_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="bootstrap-wizard-validation-gender">Nationality</label>
                                    <select class="form-select" name="nationality_id" id="add_employee_nationality" required="required">
                                        <option value="">Select ...</option>
                                        @foreach ($nationalities as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->nationality }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->nationality }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                                <div class="col-md-auto mb-3">
                                    <div class="dz-preview dz-preview-single">
                                        <div class="dz-preview-cover d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                            <div class="avatar avatar-4xl"><img id="showImage" class="rounded-circle avatar-placeholder" src="{{(!empty($emp->emp_files->file_name)) ? url($emp->emp_files->file_path.$emp->emp_files->file_name) : url('upload/no_image.jpg')}}" alt="..." data-dz-thumbnail="data-dz-thumbnail" /></div>
                                            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="form-control form-control-sm" type="file" name="profile_image_name" id="profile_image_name" />
                                </div>
                            </div>
                        </div>
                        <!-- end of right div -->
                    </div>
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_modal_label"><?= get_label('edit_employee', 'Edit employee') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_form" novalidate="" action="{{ route ('tracki.employee.update') }}" method="POST">
                @csrf
                <div id="employeeEditView"></div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/employee/address') || Request::is('tracki/employee/profile*'))
<div class="modal fade" id="add_employee_address_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content ">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_address_modal_label"><?= get_label('add_employee_address', 'Add employee address') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_employee_address_form" novalidate="" action="{{ route ('tracki.employee.address.store') }}" method="POST">
                @csrf

                <input type="hidden" id="add_employee_id_h" name="id" value="{{$emp->id}}">
                <input type="hidden" id="add_employee_address_table_h" name="table" value="employee_address_table">

                <div class="modal-body">
                    <div class="row">
                        <!-- begining of left div -->
                        <div class="col-md-12">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Address Type</label>
                                <select class="form-select" name="employee_address_type" id="employee_address_type_id" required>
                                    <option value="">Select...</option>
                                    @foreach ($address_types as $key => $item )
                                    <option value="{{ $item->id  }}" selected>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Address1</label>
                                <input name="employee_address1" id="add_employee_address1" class="form-control" type="text" placeholder="" required>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="inputEmail4">Address2</label>
                                <input name="employee_address2" id="add_employee_address2" class="form-control" type="text" placeholder="Address2">
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label" for="inputEmail4">City</label>
                                    <input name="employee_city" id="add_employee_city" class="form-control" type="text" placeholder="City" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label" for="inputEmail4">State</label>
                                    <input name="employee_state" id="add_employee_state" class="form-control" type="text" placeholder="State">
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label" for="inputEmail4">Zipcode</label>
                                    <input name="employee_zipcode" id="add_employee_zipcode" class="form-control" type="text" placeholder="00000" required>
                                    <!-- <div class="invalid-feedback">This field is required.</div> -->
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="inputEmail4">Country</label>
                                <select class="form-select" name="employee_address_country" id="add_employee_address_country_id" required>
                                    <option value="">Select...</option>
                                    @foreach ($countries as $key => $item )
                                    @if (Request::old('id') == $item->id )
                                    <option value="{{ $item->id  }}" selected>
                                        {{ $item->country_name }}
                                    </option>
                                    @else
                                    <option value="{{ $item->id  }}">
                                        {{ $item->country_name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- <div class="invalid-feedback">This field is required.</div> -->
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="flexCheckDefault" name="employee_address_primary" type="checkbox" value="Y" />
                                <label class="form-check-label" for="flexCheckDefault">Primary address</label>
                            </div>

                        </div>
                        <!-- end of left div -->

                        <!-- begining of right div -->
                        <!-- end of right div -->
                    </div>
                    <!-- <div class="mb-3">
                        <input class="form-control form-control-sm" id="customFileSm" type="file" name="profile_image_name" id="fileupld" />
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_employee_address_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_employee_address_modal_label"><?= get_label('edit_employee_address', 'Edit employee_address') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_employee_address_form" novalidate="" action="{{ route ('tracki.employee.address.update') }}" method="POST">
                @csrf
                <div id="employee_addressEditView"></div>
            </form>
        </div>
    </div>
</div>
@endif

@if ((Request::is('tracki/project/*') || Request::is('tracki/users/create-new') || Request::is('tracki/task/*/list')) || Request::is('tracki/employee/profile*') && !Request::is('tracki/project/archive'))
<div class="modal fade" id="add_edit_project_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_edit_project_modal_label"><?= get_label('create_project', 'Create project') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_edit_project_form" novalidate="" action="{{ route ('tracki.project.create') }}" method="POST">
                @csrf

                <input type="hidden" name="id" id="add_edit_project_id_h" value="">
                <input type="hidden" name="table" id="add_edit_project_table_h" value="task_table">
                <input type="hidden" name="redirect" id="add_edit_project_redirect_h" value="">

                <div class="modal-body">

                    @if (!$is_workspace_id_set)
                    <div class="col-12">
                        <!-- <label class="form-label" for="inputAddress">Workspace</label> -->
                        <label class="col-sm-2 col-form-label col-form-label-sm" for="colFormLabelSm">Workspace</label>
                        <select name="workspace_id" class="form-select" id="add_edit_project_workspace_id" required style="background-color: #ADC5FF;">
                            <option selected="selected" value="">Select...</option>
                            @foreach ($workspaces as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="inputEmail4">Title</label>
                        <input name="name" id="add_edit_project_name" class="form-control" type="text" placeholder="" required>
                    </div>
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputAddress2">Assign to (multiple)</label>
                            <select required class="form-select js-example-basic-multiple2" id="add_edit_project_assigned_to" name="assignment_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('Team', 'Team') ?>">
                                <option value="">Select users</option>
                                @foreach ($employees as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->full_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputAddress2">Tags (multiple)</label>
                            <select class="form-select js-example-basic-multiple" id="add_edit_project_tag" name="tag_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('Tags', 'Tags') ?>">
                                <option value="">Select tag</option>
                                @foreach ($tags as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-3 col-md-3">
                            <label class="form-label" for="inputAddress">Project type</label>
                            <select name="project_type_id" class="form-select" id="add_edit_project_project_type" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($project_type as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <label class="form-label" for="inputAddress">Category</label>
                            <select name="category_id" class="form-select" id="add_edit_project_category" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($event_category as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <label class="form-label" for="inputAddress">Audience</label>
                            <select name="audience_id" class="form-select" id="add_edit_project_audience" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($event_audience as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="inputAddress">Client</label>
                            <select name="client_id" class="form-select" id="add_edit_project_client" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($clients as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->first_name.' '.$item->last_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">

                        <div class="col-md-3">
                            <label class="form-label" for="inputAddress">Venue</label>
                            <select name="venue_id" class="form-select" id="add_edit_project_venue" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($event_venue as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="inputAddress">Location</label>
                            <select name="location_id" class="form-select" id="add_edit_project_location" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($event_location as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="inputAddress">Fund</label>
                            <select name="fund_category_id" class="form-select" id="add_edit_project_fund" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($fund_category as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="inputAddress">Budget</label>
                            <select name="budget_name_id" class="form-select" id="add_edit_project_budget" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($budget_name as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">

                        <!-- <h4 class="mt-6">Schedule</h4> -->
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Start Date</label>
                            <input class="form-control datetimepicker" id="add_edit_project_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">End Date</label>
                            <input class="form-control datetimepicker" id="add_edit_project_end_date" data-target="#floatingInputStartDate" name="end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                    </div>
                    <!-- <h4 class="mt-6">Other Information</h4> -->
                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <label class="form-label" for="inputCity">Budget allocated</label>
                            <input name="budget_allocation" class="form-control" id="add_edit_project_budget_allocation" type="number" step="0.01" placeholder="" value="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputState">Attendance forcast</label>
                            <input name="attendance_forcast" class="form-control" id="add_edit_project_attendance" type="number" step="0.01" placeholder="" value="0" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="gridCheck">Description</label>
                        <textarea required name="description" class="form-control tinymce" id="add_edit_project_description" data-tinymce="{}" placeholder=""></textarea>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if ((Request::is('xxxtracki/project/*') || Request::is('xxxtracki/users/create-new') || Request::is('xxxtracki/task/*/list')) && !Request::is('xxxtracki/project/archive'))
<div class="offcanvas offcanvas-start w-50" id="offcanvasAddEditProject" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="add_edit_project_modal_label">Create new project</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <?php
        $workspace_id = session()->get('workspace_id');
        $is_workspace_id_set = ($workspace_id) ? true : false;
        ?>
        <!-- <h4 class="mb-3">Information </h4> -->
        <form class="row g-3 needs-validation form-submit-event" id="add_edit_project_form" novalidate="" action="{{ route ('tracki.project.create') }}" method="POST">
            @csrf

            <input type="hidden" name="id" id="add_edit_project_id_h" value="">
            <input type="hidden" name="table" id="add_edit_project_table_h" value="task_table">
            <input type="hidden" name="redirect" id="add_edit_project_redirect_h" value="">

            @if (!$is_workspace_id_set)
            <div class="col-12">
                <!-- <label class="form-label" for="inputAddress">Workspace</label> -->
                <label class="col-sm-2 col-form-label col-form-label-sm" for="colFormLabelSm">Workspace</label>
                <select name="workspace_id" class="form-select" id="add_edit_project_workspace_id" required style="background-color: #ADC5FF;">
                    <option selected="selected" value="">Select...</option>
                    @foreach ($workspaces as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="col-12 gy-6">
                <div class="form-floating form-floating-advance-select">
                    <label>Add tags</label>
                    <select class="form-select" id="organizerMultiple" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                        <option selected="selected">Stupidity</option>
                        <option>Jerry</option>
                        <option>Not_the_mouse</option>
                        <option>Brainlessness</option>
                    </select>
                </div>
            </div>
            <div class="col-12 gy-6">
                <label for="organizerMultiple">Multiple</label>
                <select class="form-select" id="organizerMultiple" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                    <option value="">Select organizer...</option>
                    <option>Massachusetts Institute of Technology</option>
                    <option>University of Chicago</option>
                    <option>GSAS Open Labs At Harvard</option>
                    <option>California Institute of Technology</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Title</label>
                <input name="name" id="add_edit_project_name" class="form-control" type="text" placeholder="" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Tags (multiple)</label>

                <select required class="form-select js-example-basic-multiple" id="add_edit_project_tag" name="tag_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('Tags', 'Tags') ?>">
                    <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                    <option value="">Select tag</option>
                    @foreach ($tags as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Project type</label>
                <select name="project_type_id" class="form-select" id="add_edit_project_project_type" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($project_type as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Category</label>
                <select name="category_id" class="form-select" id="add_edit_project_category" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_category as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Audience</label>
                <select name="audience_id" class="form-select" id="add_edit_project_audience" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_audience as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Client</label>
                <select name="client_id" class="form-select" id="add_edit_project_client" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($clients as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->first_name.' '.$item->last_name}}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Venue</label>
                <select name="venue_id" class="form-select" id="add_edit_project_venue" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_venue as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Location</label>
                <select name="location_id" class="form-select" id="add_edit_project_location" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($event_location as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Fund</label>
                <select name="fund_category_id" class="form-select" id="add_edit_project_fund" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($fund_category as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="inputAddress">Budget</label>
                <select name="budget_name_id" class="form-select" id="add_edit_project_budget" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($budget_name as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <!-- <h4 class="mt-6">Schedule</h4> -->
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Start Date</label>
                <input class="form-control datetimepicker" id="add_edit_project_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">End Date</label>
                <input class="form-control datetimepicker" id="add_edit_project_end_date" data-target="#floatingInputStartDate" name="end_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <!-- <h4 class="mt-6">Other Information</h4> -->
            <div class="col-md-6">
                <label class="form-label" for="inputCity">Budget allocated</label>
                <input name="budget_allocation" class="form-control" id="add_edit_project_budget_allocation" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputState">Attendance forcast</label>
                <input name="attendance_forcast" class="form-control" id="add_edit_project_attendance" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="gridCheck">Description</label>
                <textarea required name="description" class="form-control tinymce" id="add_edit_project_description" data-tinymce="{}" placeholder=""></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#">Cancel</a> -->
                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
            </div>
        </form>

    </div>
</div>
@endif

@if (Request::is('tracki/setup/address_type/*'))
<div class="modal fade" id="create_address_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_address_type', 'Create address_type') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_address_type_form" novalidate="" action="{{ route('tracki.setup.address_type.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="address_type_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address_type_name" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="address_type_name" class="form-control" name="name" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('active_flag', 'Active flag') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="address_type_active_flag" name="active_flag" required>
                                <option>Select ...</option>
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_address_type_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_address_type_form" novalidate="" action="{{ route('tracki.setup.address_type.update') }}" method="POST">
                @csrf

                <input type="hidden" id="address_type_id" name="id" value="">
                <input type="hidden" id="edit_address_type_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address_type_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="address_type_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="address_type_color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/status/*'))
<div class="modal fade" id="create_status_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_status', 'Create status') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_status_form" novalidate="" action="{{ route('tracki.setup.status.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="status_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="status_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="addTitle" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_status_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_status_form" novalidate="" action="{{ route('tracki.setup.status.update') }}" method="POST">
                @csrf

                <input type="hidden" id="status_id" name="id" value="">
                <input type="hidden" id="edit_status_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="status_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="status_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="status_color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/priority/*'))
<div class="modal fade" id="create_priority_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_priority', 'Create priority') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="create_priority_form" novalidate="" action="{{ route('tracki.setup.priority.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="priority_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="priority_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="addTitle" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_priority_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_priority_form" novalidate="" action="{{ route('tracki.setup.priority.update') }}" method="POST">
                @csrf

                <input type="hidden" id="priority_id" name="id" value="">
                <input type="hidden" id="edit_priority_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="priority_title" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="priority_title" class="form-control" name="title" required placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                            <select class="form-select" id="priority_color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary"><?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary"><?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success"><?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger"><?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning"><?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info"><?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark"><?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('home') || Request::is('todos'))
<div class="modal fade" id="create_todo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content form-submit-event" action="{{url('/todos/store')}}" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_todo', 'Create todo') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('priority', 'Priority') ?> <span class="asterisk">*</span></label>
                        <select class="form-select" name="priority">
                            <option value="low" {{ old('priority') == "low" ? "selected" : "" }}><?= get_label('low', 'Low') ?></option>
                            <option value="medium" {{ old('priority') == "medium" ? "selected" : "" }}><?= get_label('medium', 'Medium') ?></option>
                            <option value="high" {{ old('priority') == "high" ? "selected" : "" }}><?= get_label('high', 'High') ?></option>
                        </select>
                    </div>
                </div>
                <label for="description" class="form-label"><?= get_label('description', 'Description') ?></label>
                <textarea class="form-control" name="description" placeholder="<?= get_label('please_enter_description', 'Please enter description') ?>"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?>
                </button>
                <button type="submit" id="submit_btn" class="btn btn-primary"><?= get_label('save','Save') ?></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_todo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url('/todos/update')}}" class="modal-content form-submit-event" method="POST">
            <input type="hidden" name="id" id="todo_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('update_todo', 'Update todo') ?></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="todo_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('priority', 'Priority') ?> <span class="asterisk">*</span></label>
                        <select class="form-select" id="todo_priority" name="priority">
                            <option value="low"><?= get_label('low', 'Low') ?></option>
                            <option value="medium"><?= get_label('medium', 'Medium') ?></option>
                            <option value="high"><?= get_label('high', 'High') ?></option>
                        </select>
                    </div>
                </div>
                <label for="description" class="form-label"><?= get_label('description', 'Description') ?></label>
                <textarea class="form-control" id="todo_description" name="description" placeholder="<?= get_label('please_enter_description', 'Please enter description') ?>"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('update', 'Update') ?></span></button>
            </div>
        </form>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/tags'))
<!-- tags modal -->
<div class="modal fade" id="create_tags_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.tags.store')}}" method="POST">
            <input type="hidden" name="table" value="tags_table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_tags', 'Create tags') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input required type="text" id="nameBasic" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                        <input required type="color" value="#d6fafc" id="tags_color" name="color" class="form-control" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_tags_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.tags.update')}}" method="POST">
            <input type="hidden" id="edit_tags_id" name="id" value="">
            <input type="hidden" id="edit_tags_table" name="table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('edit_tags', 'Edit tags') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_tags_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span class="asterisk">*</span></label>
                        <input required type="color" id="edit_tags_color" name="color" class="form-control" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
            </div>
        </form>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/designations'))
<!-- designations modal -->
<div class="modal fade" id="create_designations_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_designations', 'Create designations') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.designations.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="designations_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('Department', 'department') ?></label>
                        <select class="form-select" name="department_id" id="add_department_id">
                            <option value="">Select department...</option>
                            @foreach ($departments as $key => $item )
                            @if (Request::old('id') == $item->id )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->name }}
                            </option>
                            @else
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_designations_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.designations.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_designations_id" name="id" value="">
                <input type="hidden" id="edit_designations_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('name', 'Name') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_designations_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('Department', 'department') ?></label>
                        <select class="form-select" name="department_id" id="edit_department_id">
                            <option value="">Select department...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/departments'))
<!-- departments modal -->
<div class="modal fade" id="create_departments_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_departments', 'Create departments') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.departments.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="departments_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('parent_department', 'Parent department') ?></label>
                        <select class="form-select" name="parent_id" id="edit_parent_id">
                            <option value="" selected>Select department...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_departments_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.departments.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_departments_id" name="id" value="">
                <input type="hidden" id="edit_departments_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_departments_title" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('parent_department', 'Parent department') ?></label>
                        <select class="form-select" name="parent_id" id="edit_parent_id">
                            <option value="" selected>Select department...</option>
                            @foreach ($departments as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/locations'))
<!-- locations modal -->
<div class="modal fade" id="create_locations_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_locations', 'Create locations') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.locations.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="locations_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_locations_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.locations.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_locations_id" name="id" value="">
                <input type="hidden" id="edit_locations_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_locations_title" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/venue'))
<!-- venues modal -->
<div class="modal fade" id="create_venues_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_venues', 'Create venues') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.venue.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="venues_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="add_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_venues_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.venue.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_venues_id" name="id" value="">
                <input type="hidden" id="edit_venues_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_venues_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="edit_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/venue'))
<!-- venues modal -->
<div class="modal fade" id="create_venues_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_venues', 'Create venues') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.venue.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="venues_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="add_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_venues_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('tracki.setup.venue.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit_venues_id" name="id" value="">
                <input type="hidden" id="edit_venues_table" name="table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                            <input type="text" id="edit_venues_name" class="form-control" name="name" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="bootstrap-wizard-validation-gender"><?= get_label('location', 'Location') ?></label>
                        <select class="form-select" name="location_id" id="edit_location_id">
                            <option value="" selected>Select venue...</option>
                            @foreach ($locations as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- <div class="invalid-feedback">This field is required.</div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


@if (Request::is('tracki/setup/workspace'))
<!-- workspace modal -->
<div class="modal fade" id="create_workspace_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.workspace.store')}}" method="POST">
            <input type="hidden" name="table" value="workspace_table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_workspace', 'Create workspace') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="nameBasic" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>

                <div class="row">

                    <div class="col-12">
                        <label class="form-label" for="inputAddress2">Assigned to</label>
                        <select class="form-select js-example-basic-multiple" name="assigned_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <!-- <select name="assigned_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                            <option value="">Select Assinged to</option>
                            @foreach ($employees as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 gy-6">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_workspace_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('tracki.setup.workspace.update')}}" method="POST">
            <input type="hidden" name="table" value="workspace_table">
            <input type="hidden" id="id" name="id" value="">
            <input type="hidden" id="table" name="table">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('edit_workspace', 'Edit workspace') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span class="asterisk">*</span></label>
                        <input type="text" id="edit_ws_title" class="form-control" name="title" placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="user_id"><?= get_label('select_users', 'Select users') ?> <span id="task_update_users_associated_with_project"></span></label>
                        <select id="edit_ws_asg_id" class="form-select js-asg-basic-multiple" name="assigned_to_id[]" multiple="multiple" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <option value="">Select Assinged to</option>
                            @foreach ($employees as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label" for="user_id"><?= get_label('select_clients', 'Select clients') ?> <span id="task_update_users_associated_with_project"></span></label>
                        <select id="edit_ws_client_id" class="form-select js-client-basic-multiple" name="client_id[]" multiple="multiple" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <option value="">Select Assinged to</option>
                            @foreach ($clients as $key => $item )
                            <option value="{{ $item->id  }}">
                                {{ $item->first_name.' '.$item->last_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?></label>
                </button>
                <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save','Save') ?></label></button>
            </div>
        </form>
    </div>
</div>
@endif

@if (Request::is('tracki/todo/manage'))
<div class="modal fade" id="createTodoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Create Todo</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation" novalidate="" form-submit-eventx" id="add_new_todo" action="{{ route('tracki.todo.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <!-- <input type="hidden" name="parent_task_id" id="subtask_parent_task_id" value=""> -->
                                <!-- <input type="hidden" name="table" value="task_table"> -->

                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Title</label>
                                    <input name="title" class="form-control" type="text" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress2">Assigned to</label>
                                    <select name="assigned_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required>
                                        <option value="">Select Assinged to</option>
                                        @foreach ($users as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress">Priority</label>
                                    <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($priorities as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->title }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="gridCheck">Description</label>
                                    <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                                    <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                    <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a>
                                    <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/task/*/list') || Request::is('tracki/task/manage') || Request::is('tracki/task/*/edit')||Request::is('tracki/todo/manage'))
<!-- this is the Add Attachement Modal for tasks -->
<div class="modal fade" id="addAttachementTaskModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Upload Task File</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_task_file" novalidate="" action="{{ route('tracki.task.file.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="taskAttachId" name="task_id">
                                <input type="hidden" id="taskAttachParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Name</label>
                                    <input class="form-control" type="file" name="file_name" id="fileupld" required />
                                </div>
                                <div class="form-group">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/task/*/list') || Request::is('tracki/task/manage') || Request::is('tracki/task/*/edit') ||Request::is('tracki/users/*'))

<!-- this is the Add task Notes Modal -->
<div class="modal fade" id="addTaskNoteModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Add task note</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_task_note" novalidate="" action="{{ route('tracki.task.note.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="taskNoteId" name="task_id" value="">
                                <input type="hidden" id="taskNoteParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Note</label>
                                    <textarea class="form-control mb-3" id="task_note" name="note_text" rows="4" required> </textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals for change status in project and task -->
<div class="modal fade" id="taskStatusModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate="" action="{{route('tracki.task.status.update')}}" method="POST" id="task_status">
                <!-- <form class="needs-validation" novalidate="" action="{{url('/tracki/task/status/update')}}" method="POST" id="task_status"> -->
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="editTaskId" name="id">
                                <input type="hidden" id="editTaskEventId" name="event_id">
                                <input type="hidden" id="taskStatusParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Status</label>
                                    <select name="status_id" class="form-select" id="editTaskStatusSelection" required>
                                        <option selected="selected" value="">Select</option>
                                        @foreach ($statuses as $key => $item )
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- //****************************************** add_task_modal ******************************************/ */ -->
<div class="modal fade" id="add_task_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_task_modal_label"><?= get_label('add_task', 'Edit task') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="add_task_form" novalidate="" action="{{ route ('tracki.task.store') }}" method="POST">
                @csrf

                <input type="hidden" id="add_task_id_h" name="id" value="">
                <input type="hidden" id="add_task_table_h" name="table" value="">
                <!-- <input type="hidden" id="add_task_event_id" name="event_id" value=""> -->


                <div class="modal-body">


                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="inputEmail4">Title</label>
                        <input name="name" id="add_task_name" class="form-control" type="text" placeholder="" required>
                    </div>
                    @if (Request::is('tracki/task/manage'))
                    <div class="col-12">
                        <label class="form-label" for="inputAddress">Project</label>
                        <select name="event_id" id="add_task_event_id" onChange="getProjectUsers(this.value);" class="form-select" id="floatingSelectRating" required>
                            <option selected="selected" value="">Select...</option>
                            @foreach ($projects as $key => $item )
                            @if (Request::old('id') == $item->id )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->name }}
                            </option>
                            @else
                            <option value="{{ $item->id  }}">
                                {{ $item->name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @elseif (Request::is('tracki/task/*/list'))
                    <input type="hidden" id="add_task_event_id" name="event_id" value="">
                    @endif
                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Start Date</label>
                            <input class="form-control datetimepicker" id="add_task_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputEmail4">Due Date</label>
                            <input class="form-control datetimepicker" id="add_task_due_date" data-target="#floatingInputStartDate" name="due_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label" for="inputAddress">Status</label>
                            <select name="status_id" class="form-select" id="add_task_status" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($statuses as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->title }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputAddress">Department</label>
                            <select name="department_assignment_id" id="add_task_department_id" class="form-select" id="floatingSelectRating" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($departments as $key => $item )
                                @if (Request::old('id') == $item->id )
                                <option value="{{ $item->id  }}" selected>
                                    {{ $item->name }}
                                </option>
                                @else
                                <option value="{{ $item->id  }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <label class="form-label" for="inputAddress2">Assigned to (multiple)</label>

                        <select required class="form-select js-example-basic-multiple" id="add_task_assigned_to" name="assignment_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                            <option value="">Select Assinged to</option>
                            @foreach ($employees as $key => $item )
                            @if (Request::old('id') == $item->id )
                            <option value="{{ $item->id  }}" selected>
                                {{ $item->full_name }}
                            </option>
                            @else
                            <option value="{{ $item->id  }}">
                                {{ $item->full_name }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 row">

                        <div class="col-md-6">
                            <label class="form-label" for="inputCity">Budget allocated</label>
                            <input name="budget_allocation" class="form-control" id="add_task_budget" type="number" step="0.01" placeholder="" value="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="inputState">Actual budget utilized</label>
                            <input name="actual_budget_allocated" class="form-control" id="add_task_budget_utilization" type="number" step="0.01" placeholder="" value="0" required>
                        </div>
                    </div>
                    <!-- <h4 class="mt-6">Other Information</h4> -->

                    <div class="col-12">
                        <label class="form-label" for="gridCheck">Description</label>
                        <textarea style="height: 200px;" required name="description" class="form-control tinymce" id="add_task_description" data-tinymce="{}" placeholder=""></textarea>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- //****************************************** edit_task_modal ******************************************/ */ -->
<div class="modal fade" id="edit_task_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="d-flex justify-content-center">
        <div id="cover-spin" style="display:none;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="edit_task_modal_label"><?= get_label('edit_task', 'Edit task') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = ($workspace_id) ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_task_form" novalidate="" action="{{ route ('tracki.task.update') }}" method="POST">
                @csrf
                <div id="edit_task_modal_form"></div>
            </form>
        </div>
    </div>
</div>

<!-- //****************************************** offcanvasAddEditTask (not used but can be an option.  will add it to config) ******************************************/ */ -->
<div class="offcanvas offcanvas-start" id="offcanvasAddEditTask" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="add_edit_task_modal_label">Edit task for ( )</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form class="row g-3 needs-validation form-submit-event" id="add_edit_task_form" novalidate="" action="" method="POST">
            @csrf
            <input type="hidden" id="add_edit_task_id_h" name="id" value="">
            <input type="hidden" id="add_edit_task_table_h" name="table" value="">

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Title</label>
                <input name="name" id="add_edit_task_name" class="form-control" type="text" placeholder="" required>
            </div>
            @if (Request::is('tracki/task/manage'))
            <div class="col-12">
                <label class="form-label" for="inputAddress">Project</label>
                <select name="event_id" id="add_edit_task_event_id" onChange="getProjectUsers(this.value);" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($projects as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            @elseif (Request::is('tracki/task/*/list'))
            <input type="hidden" id="add_edit_task_event_id" name="event_id" value="">
            @endif
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Start Date</label>
                <input class="form-control datetimepicker" id="add_edit_task_start_date" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Due Date</label>
                <input class="form-control datetimepicker" id="add_edit_task_due_date" data-target="#floatingInputStartDate" name="due_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>

            <div class="col-6">
                <label class="form-label" for="inputAddress">Status</label>
                <select name="status_id" class="form-select" id="add_edit_task_status" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($statuses as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->title }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label class="form-label" for="inputAddress">Department</label>
                <select name="department_assignment_id" id="add_edit_task_department_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($departments as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Assigned to (multiple)</label>

                <select required class="form-select js-example-basic-multiple" id="add_edit_task_assigned_to" name="assignment_to_id[]" multiple="multiple" data-with="100%" data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                    <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
                    <option value="">Select Assinged to</option>
                    @foreach ($users as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="inputCity">Budget allocated</label>
                <input name="budget_allocation" class="form-control" id="add_edit_task_budget" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputState">Actual budget utilized</label>
                <input name="actual_budget_allocated" class="form-control" id="add_edit_task_budget_utilization" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="gridCheck">Description</label>
                <textarea required name="description" class="form-control tinymce" id="add_edit_task_description" data-tinymce="{}" placeholder=""></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#">Cancel</a> -->
                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
            </div>
        </form>

    </div>
</div>
<!-- </div> -->

<!-- add new task used in list and manage -->
<div class="offcanvas offcanvas-start" id="offcanvasCreateSubTask" tabindex="-1" aria-labelledby="offcanvasWithBackdropLabel">
    @if (Request::is('tracki/task/*/list'))
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Create subtask for {{Session::get('record_type')}} ( {{$eventData->name}} )</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @elseif (Request::is('tracki/task/manage'))
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Create new task</h5>
        <button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @endif
    <div class="offcanvas-body">

        <form class="row g-3 needs-validation form-submit-event" id="add_new_task" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
            @csrf
            @if (Request::is('tracki/task/*/list'))
            <input type="hidden" name="event_id" value="{{ $eventData->id }}">
            @endif
            <input type="hidden" name="table" value="task_table">

            <div class="col-md-12">
                <label class="form-label" for="inputEmail4">Title</label>
                <input name="name" class="form-control" type="text" placeholder="" required>
            </div>
            @if (Request::is('tracki/task/manage'))
            <div class="col-12">
                <label class="form-label" for="inputAddress">Project</label>
                <select name="event_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($projects as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            @endif
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Start Date</label>
                <input class="form-control datetimepicker" id="floatingInputStartDate" data-target="#floatingInputStartDate" name="start_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Due Date</label>
                <input class="form-control datetimepicker" id="floatingInputStartDate" data-target="#floatingInputStartDate" name="due_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
            </div>

            <div class="col-6">
                <label class="form-label" for="inputAddress">Status</label>
                <select name="status_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($statuses as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->title }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->title }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label class="form-label" for="inputAddress">Department</label>
                <select name="department_assignment_id" class="form-select" id="floatingSelectRating" required>
                    <option selected="selected" value="">Select...</option>
                    @foreach ($departments as $key => $item )
                    @if (Request::old('id') == $item->id )
                    <option value="{{ $item->id  }}" selected>
                        {{ $item->name }}
                    </option>
                    @else
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Assigned to</label>
                <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required>
                    <option value="">Select Assinged to</option>
                    @foreach ($users as $key => $item )
                    <option value="{{ $item->id  }}">
                        {{ $item->name }}
                    </option>

                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="inputCity">Budget allocated</label>
                <input name="budget_allocation" class="form-control" id="floatingInputLinkedin" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputState">Actual budget utilized</label>
                <input name="actual_budget_allocated" class="form-control" id="floatingInputLinkedin" type="number" step="0.01" placeholder="" value="0" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="gridCheck">Description</label>
                <textarea required name="description" class="form-control tinymce" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
            </div>
            <div class="col-12 d-flex justify-content-end mt-6">
                <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                <a class="btn btn-phoenix-danger me-2 px-6" href="#">Cancel</a>
                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
            </div>
        </form>

    </div>
</div>

<!-- Subtask modal -->
<div class="modal fade" id="createSubTaskModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Create subtask</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_subtasktask" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" name="parent_task_id" id="subtask_parent_task_id" value="">
                                <input type="hidden" name="table" value="task_table">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Title</label>
                                    <input name="title" class="form-control" type="text" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress">Status</label>
                                    <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($priorities as $key => $item )
                                        @if (Request::old('id') == $item->id )
                                        <option value="{{ $item->id  }}" selected>
                                            {{ $item->title }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id  }}">
                                            {{ $item->title }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="gridCheck">Description</label>
                                    <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-phoenix-secondary action button-submit" type="submit" value="save" id="submit_btn">Save</button>
                                    <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                    <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a>
                                    <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- The main Task overview ***************************************************************************************************-->
<div class="modal fade" id="bookingDetails" tabindex="-1" aria-labelledby="bookingDetails" aria-hidden="true">

    <!-- <div class="d-flex justify-content-center">
        <div class="spinner-border" style="display:block;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <div class="mb-0">
                    <h3 class="fw-bolder lh-sm" id="overviewtaskTitle">Task quick view</h3>
                    <p class="text-body-highlight fw-semibold mb-0">Project <a class="ms-1 fw-bold" href="#!" id="overviewProjectName">Review </a></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 px-md-3 bg-body">
                <div class="row g-2">
                    <div class="col-12 col-md-12">
                        <div class="d-md-flex mt-5 mb-0">
                            <p class="text-body-highlight fw-semibold mb-0" id="overviewtaskStatus"></p>
                            <p class="text-body-highlight fw-semibold mb-0" id="overviewtaskWorkspace"></p>
                            <div class="d-flex gap-2 ms-md-auto mt-3 mt-md-0">
                                <div class="d-flex">
                                    <p id="overviewtaskAssignees" class="d-flex"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card py-3 px-3 mb-3">
                            <table class="lh-sm mb-3">
                                <tbody>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Started : </td>
                                        <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3" id="overviewtaskStartDate"></td>
                                    </tr>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Deadline :</td>
                                        <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3" id="overviewtaskDueDate"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Budget Allocated :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskAllocatedBudget"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Expenses :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskActualBudget"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Department :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskDepartment"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="lh-sm mb-4">
                                <tbody>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Labels :</td>
                                        <td class="text-warning fw-semibold ps-9">
                                            <div class="d-flex align-items-center">
                                                <span class="badge badge-phoenix badge-phoenix-info fs-10 me-2">INFO</span>
                                                <span class="badge badge-phoenix badge-phoenix-warning fs-10 me-2">URGENT</span>
                                                <span class="badge badge-phoenix badge-phoenix-success fs-10 me-2">DONE</span>
                                                <a class="text-body fw-bolder fs-9 lh-1 text-decoration-none" href="#!">
                                                    <!-- <span class="fa-solid fa-plus me-1"></span>Add another</a> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="me-3">Description</h5>
                                    <a href="#"><button class="btn btn-link p-0"><span class="fa-solid fa-pen"></span></button></a>
                                </div>
                                <p class="text-body-highlight" id="overviewtaskDescription"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card py-3 px-3 mb-3">
                            <ul class="nav nav-underline fs-9 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="task-note-tab" data-taskid="" data-bs-toggle="tab" href="#tab-task-note" role="tab" aria-controls="tab-task-note" aria-selected="false">Notes</a></li>
                                <li class="nav-item"><a class="nav-link" id="task-file-tab" data-bs-toggle="tab" href="#tab-task-file" role="tab" aria-controls="tab-home" aria-selected="true">Files</a></li>
                                <li class="nav-item"><a class="nav-link" id="task-subtask-tab" data-bs-toggle="tab" href="#tab-task-subtask" role="tab" aria-controls="tab-task-subtask" aria-selected="false">Subtask</a></li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade active show" id="tab-task-note" role="tabpanel" aria-labelledby="task-note-tab">

                                    <a id="collapse_task_note" class="btn btn-link p-0 collapsed mb-4" data-bs-toggle="collapse" href="#collapseTaskNote" aria-expanded="false" aria-controls="collapseExample">
                                        + Add note
                                    </a>
                                    <div class="collapse" id="collapseTaskNote">
                                        <form class="needs-validation form-submit-task-new-note" novalidate="" action="{{ route('tracki.task.note.store') }}" method="POST" id="form_submit_task_new_note">
                                            @csrf
                                            <input type="hidden" id="note_parent_task_id_overview" name="task_id">
                                            <input type="hidden" id="taskNoteParentTable" name="table" value="task_table">
                                            <textarea class="form-control form-control mb-3" data-tinymce="{}" rows="3" id="task_note_text" name="note_text" placeholder="Add comment" required></textarea>
                                            <div class="d-flex flex-between-center pb-3 mb-3">
                                                <div class="d-flex">
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary px-6" type="submit" id="add_comment_btn">Save comment</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="taskTabNotes"></div>
                                </div>
                                <div class="tab-pane fade" id="tab-task-file" role="tabpanel" aria-labelledby="task-file-tab">
                                    <a id="collapse_task_file" class="btn btn-link p-0 collapsed mb-2" data-bs-toggle="collapse" href="#collapseTaskFile" aria-expanded="false" aria-controls="collapseExample">
                                        + Upload file
                                    </a>
                                    <div class="collapse" id="collapseTaskFile">
                                        <!-- <div class="card card-body"> -->

                                        <form id="form_submit_task_new_file" class="needs-validation form-submit-task-new-file" novalidate="" action="{{ route('tracki.task.file.store') }}" method="POST" enctype='multipart/form-data'>
                                            @csrf
                                            <div class="modal-body">
                                                <div class="modal-body px-0">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <input type="hidden" id="file_parent_task_id_overview" name="task_id">
                                                            <input type="hidden" id="task_parent_table" name="table" value="task_table">
                                                            <div class="mb-4">
                                                                <label class="text-1000 fw-bold mb-2">upload file</label>
                                                                <input class="form-control" type="file" name="file_name" id="fileupld" required />
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="modal-footer"> -->
                                            <button class="btn btn-sm btn-outline-primary px-6" type="submit" id="add_file_btn">Upload file</button>
                                            <!-- </div> -->
                                        </form>
                                        <!-- </div> -->
                                    </div>
                                    <div id="taskTabFiles"></div>
                                </div>

                                <div class="tab-pane fade" id="tab-task-subtask" role="tabpanel" aria-labelledby="task-subtask-tab">
                                    <a id="collapse_task_subtask" class="btn btn-link p-0 collapsed mb-2" data-bs-toggle="collapse" href="#collapseTaskSubtask" aria-expanded="false" aria-controls="collapseExample">
                                        + Add new subtask
                                    </a>
                                    <div class="collapse" id="collapseTaskSubtask">
                                        <!-- <div class="card card-body"> -->

                                        <form class="needs-validation form-submit-task-new-subtask" id="form_submit_task_new_subtask" novalidate="" action="{{ route('tracki.task.subtask.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="modal-body px-0">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <input type="hidden" name="parent_task_id" id="subtask_parent_task_id_overview" value="">
                                                            <input type="hidden" name="table" value="task_table">

                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label" for="inputEmail4">Title</label>
                                                                <input name="title" class="form-control" type="text" placeholder="" required>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label" for="inputAddress">Priority</label>
                                                                <select name="priority_id" class="form-select" id="floatingSelectRating" required>
                                                                    <option selected="selected" value="">Select...</option>
                                                                    @foreach ($priorities as $key => $item )
                                                                    @if (Request::old('id') == $item->id )
                                                                    <option value="{{ $item->id  }}" selected>
                                                                        {{ $item->title }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $item->id  }}">
                                                                        {{ $item->title }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label" for="gridCheck">Description</label>
                                                                <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}" placeholder=""></textarea>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end mt-6">
                                                                <button class="btn btn-sm btn-outline-primary px-6 action button-submit" type="submit" value="save" id="add_subtask_btn">Save</button>
                                                                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                                                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a> -->
                                                                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        <!-- </div> -->
                                    </div>
                                    <div id="taskTabSub"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
