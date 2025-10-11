@extends('mds.admin.layout.admin_template')
@section('main')

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->

    {{-- <div class="content"> --}}

    <div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('mds.admin.booking') }}">
                            <?= get_label('booking', 'Booking') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('save', 'Save') ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        @if (session('message'))
            <div class="alert">{{ session('message') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow-none border my-4 col-md-8" style="margin:0 auto;" data-component-card="data-component-card">
            <div class="card-header p-4 border-bottom bg-body">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-body mb-0" data-anchor="data-anchor">Make a booking (MDS)</h4>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="p-4 code-to-copy">
                    <form class="row g-3  px-3 needs-validation" action="{{ route('mds.admin.booking.store') }}"
                        id="form-1" novalidate method="POST">
                        @csrf
                        <input type="hidden" id="add_schedule_period_id" name="schedule_period_id" value="">
                        <input type="hidden" id="add_booking_date" name="booking_date">


                        <x-formy.form_select floating="0" name="venue_id" itemIdForeach="venue_id"
                            itemTitleForeach="venue_name" elementId="add_delivery_area" classLabel="form-label"
                            label="Delivery Area" :forLoopCollection="$venues" class="col-md-10 mb-3" style="margin:0 auto;"
                            required="required" addDynamicButton="0" dynamicModal="#add_delivery_area_modal" />

                        <div id="time_alert" class="col-md-10 mb-3 alert alert-subtle-secondary" style="margin:0 auto;"
                            role="alert">No time slot has been selected!</div>
                        <div class="col-md-6 mb-3" style="margin:0 auto;">
                            <button class="btn btn-subtle-primary d-grid gap-2" id="booking_schedule_availability"
                                style="margin:0 auto;" type="button">Get times Modal</button>
                        </div>
                        <x-formy.form_select floating="0" name="client_id" elementId="add_client_id"
                            classLabel="form-label" label="Clients" :forLoopCollection="$clients" itemIdForeach="id"
                            itemTitleForeach="title" class="col-md-10 mb-2" style="margin:0 auto;" required="required"
                            addDynamicButton="0" dynamicModal="#add_client_id_modal" />

                        <x-formy.form_select floating="0" name="driver_id" elementId="add_driver_id"
                            classLabel="form-label" label="Driver" :forLoopCollection="$drivers" itemIdForeach="id"
                            itemTitleForeach="full_name" class="col-md-10 mb-2" style="margin:0 auto;"
                            required="required" addDynamicButton="0" dynamicModal="#add_driver_id_modal" />

                        <div class="card shadow-none border my-4 col-md-10" style="margin:0 auto;"
                            data-component-card="data-component-card">

                            <div class="mt-3">
                                <h5 class="text-body mb-0" data-anchor="data-anchor">Booking Company</h5>
                            </div>

                            <div class="card-body p-0">
                                <x-formy.form_input floating="0" name="booking_party_company_name"
                                    elementId="add_booking_party_company_name" classLabel="col-sm-3 col-form-label-sm"
                                    label="Company Name" inputType="text" inputValue="" class="row mt-2"
                                    inputWrappingClass="col-sm-8" required="required" disabled="" />

                                <x-formy.form_input floating="0" name="booking_party_contact_name"
                                    elementId="add_booking_party_contact_name" classLabel="col-sm-3 col-form-label-sm"
                                    label="Contact Name" inputValue="" inputType="text" class="row mt-2"
                                    inputWrappingClass="col-sm-8" required="required" disabled="" />

                                <x-formy.form_input floating="0" name="booking_party_contact_email"
                                    elementId="add_booking_party_contact_email" classLabel="col-sm-3 col-form-label-sm"
                                    label="Email Address" inputType="text" inputValue="" class="row mt-2"
                                    inputWrappingClass="col-sm-8" required="required" disabled="" />

                                <x-formy.form_input floating="0" name="booking_party_contact_number"
                                    elementId="add_booking_party_contact_number" classLabel="col-sm-3 col-form-label-sm"
                                    label="Phone Number" inputType="text" inputValue="" class="row mb-3 mt-2"
                                    inputWrappingClass="col-sm-8" required="required" disabled="" />
                            </div>
                        </div>
                        <div class="card shadow-none border my-4 col-md-10" style="margin:0 auto;"
                            data-component-card="data-component-card">
                            <div class="card-body p-0">
                                <div class="mt-3">
                                    <h5 class="text-body mb-0" data-anchor="data-anchor">Vehicle Info</h5>
                                </div>

                                <x-formy.form_select_row name="vehicle_id" itemIdForeach="id"
                                    itemTitleForeach="license_plate" elementId="add_vehicle_id"
                                    classLabel="col-sm-3 col-form-label-sm" label="Vehicle" :forLoopCollection="$vehicles"
                                    class="row mt-2" style="margin:0 auto;" required="required" addDynamicButton="0"
                                    dynamicModal="#add_vehicle_id_modal" />

                                <x-formy.form_select_row name="vehicle_type_id" itemIdForeach="id"
                                    itemTitleForeach="title" elementId="add_vehicle_type_id"
                                    classLabel="col-sm-3 col-form-label-sm" label="Delivery Vehicle Type"
                                    :forLoopCollection="$vehicle_types" class="row mt-2" style="margin:0 auto;" required="required"
                                    addDynamicButton="0" dynamicModal="#add_vehicle_type_id_modal" />


                                <x-formy.form_input floating="0" name="receiver_name" elementId="add_receiver_name"
                                    classLabel="col-sm-3 col-form-label-sm" label="Receiver Name" inputType="text"
                                    inputValue="" class="row mt-2" inputWrappingClass="col-sm-8" required="required"
                                    disabled="" />

                                <x-formy.form_input floating="0" name="receiver_contact_number"
                                    elementId="add_receiver_contact_number" classLabel="col-sm-3 col-form-label-sm"
                                    label="Receiver Contact Number" inputType="text" inputValue="" class="row mt-2"
                                    inputWrappingClass="col-sm-8" required="required" disabled="" />

                                <x-formy.form_select_row name="dispatch_id" itemIdForeach="id" itemTitleForeach="title"
                                    elementId="add_dispatch_id" classLabel="col-sm-3 col-form-label-sm"
                                    label="Deliver/Collection" :forLoopCollection="$delivery_types" class="row mt-2" style="margin:0 auto;"
                                    required="required" addDynamicButton="0" dynamicModal="#add_dispatch_id_modal" />

                                <x-formy.form_select_row name="cargo_id" itemIdForeach="id" itemTitleForeach="title"
                                    elementId="add_cargo_id" classLabel="col-sm-3 col-form-label-sm"
                                    label="Cargo Description" :forLoopCollection="$cargos" class="row mt-2" style="margin:0 auto;"
                                    required="required" addDynamicButton="0" dynamicModal="#add_cargo_id_modal" />

                                <x-formy.form_select_row name="loading_zone_id" itemIdForeach="id"
                                    itemTitleForeach="title" elementId="add_loading_zone_id"
                                    classLabel="col-sm-3 col-form-label-sm" label="Loading/Unloading Zone"
                                    :forLoopCollection="$loading_zones" class="row mb-3 mt-2" style="margin:0 auto;" required="required"
                                    addDynamicButton="0" dynamicModal="#add_loading_zone_id_modal" />
                            </div>
                        </div>
                        <div class="form-check" style="margin:0 auto;">
                            <input class="form-check-input" id="flexCheckChecked" type="checkbox" value=""
                                checked="" />
                            <label class="form-check-label" for="flexCheckChecked">Checked checkbox</label>
                        </div>

                        <!-- <div class="invisible">.</div> -->
                        <div class="col-12 d-flex justify-content-end mt-6">
                            <button class="btn btn-primary" type="submit">Save booking</button>
                        </div>
                        <!-- <button class="btn btn-primary" type="submit">Submit</button> -->
                    </form>
                </div>
            </div>
            <!-- <br /> -->
            <!-- &nbsp; -->
        </div>
    </div>
    <script src="{{ asset('assets/js/pages/mds/booking.js') }}"></script>

    @include('mds.admin.modals.booking_modals')

@endsection

@push('script')
@endpush
