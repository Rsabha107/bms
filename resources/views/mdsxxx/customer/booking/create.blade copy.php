@extends('mds.customer.layout.customer_template')
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
                        <a href="{{route('home')}}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('mds.customer.booking')}}">
                            <?= get_label('booking', 'Booking') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('save','Save') ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- <div class="row justify-content-between align-items-end mb-4 g-3">
        <div class="col-12 col-sm-auto">
            <h4 class="mb-0">Make a booking (MDS)<span class="fw-normal text-700 ms-3"></span></h4>
        </div>
        <div class="col-12 col-sm-auto">
            <div class="d-flex align-items-center">
                <div class="search-box me-3">
                </div>
                <a class="btn btn-primary px-5" href="#!" id="add_new_project" data-workspace-id=""><i class="bx bx-plus"></i></a>
                <a href="#" id="add_new_project" data-workspace-id=""><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_project', 'Create project') ?>"><i class="bx bx-plus"></i></button></a>
            </div>
        </div>
    </div> -->
    <!-- <div id="time_alert" class="col-md-10 mb-3 alert alert-subtle-secondary" style="margin:0 auto;" role="alert">No time slot has been selected!</div> -->

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
                    <form class="row g-3  px-3 needs-validation" action="{{route('mds.customer.booking.store')}}" id="form-1" novalidate method="POST">
                        @csrf
                        <input type="hidden" id="add_schedule_period_id" name="schedule_period_id" value="" required>
                        <input id="add_booking_date" name="booking_date" type="hidden" required>

                        <!-- <div class="col-md-10 mb-3" style="margin:0 auto;">
                            <label class="form-label" for="inputEmail4">Date</label>
                            <input class="form-control datetimepicker" id="add_booking_date" data-target="#floatingInputStartDate" name="booking_date" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' required>
                        </div> -->
                        <div class="col-md-10 mb-3" style="margin:0 auto;">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Delivery Areas</label>
                            <select class="form-select" name="venue_id" id="add_delivery_area" required="required">
                                <option value="">Select delivery areas...</option>
                                @foreach ($venues as $key => $item )
                                <option value="{{ $item->venue_id  }}">
                                    {{ $item->venue_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="time_alert" class="col-md-10 mb-3 alert alert-subtle-secondary" style="margin:0 auto;" role="alert">
                            No time slot has been selected!
                        </div>
                        <!-- <div class="col-md-6 mb-3" style="margin:0 auto;">
                            <button class="btn btn-subtle-primary d-grid gap-2" id="show_shcedule_times_modal" style="margin:0 auto;" type="button">Get times</button>
                        </div> -->
                        <div class="col-md-6 mb-3" style="margin:0 auto;">
                            <button class="btn btn-subtle-primary d-grid gap-2" id="booking_schedule_availability" style="margin:0 auto;" type="button">Get times Modal</button>
                        </div>
                        <div class="col-md-10 mb-3" style="margin:0 auto;">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Clients</label>
                            <select class="form-select" name="client_id" id="add_employee_employee_type" required="required">
                                <option value="">Select clients...</option>
                                @foreach ($clients as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-10 mb-3" style="margin:0 auto;">
                            <label class="form-label" for="bootstrap-wizard-validation-gender">Driver</label>
                            <select class="form-select" name="driver_id" id="add_employee_employee_type" required="required">
                                <option value="">Select driver...</option>
                                @foreach ($drivers as $key => $item )
                                <option value="{{ $item->id  }}">
                                    {{ $item->first_name }}
                                    {{ $item->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card shadow-none border my-4 col-md-10" style="margin:0 auto;" data-component-card="data-component-card">
                            <div class="card-body p-0">
                                <div class="mt-3">
                                    <h5 class="text-body mb-0" data-anchor="data-anchor">Booking Company</h5>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Company Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="booking_party_company_name" type="text" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Contact Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="booking_party_contact_name" type="text" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Email Address</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="booking_party_contact_email" type="email" />
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Phone Number</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="booking_party_contact_number" type="text" />
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-body p-0">
                                <div class="mt-3">
                                    <h5 class="text-body mb-0" data-anchor="data-anchor">Delivering Company</h5>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Company Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="delivering_party_company_name" type="text" />
                                    </div>
                                </div>
                                <div class="row mt-2 mb-3">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Email Address</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="delivering_party_contact_email" type="email" />
                                    </div>
                                </div>
                                <div class="row mt-2 mb-3">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Phone Number</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="delivering_party_contact_number" type="text" />
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card shadow-none border my-4 col-md-10" style="margin:0 auto;" data-component-card="data-component-card">
                            <div class="card-body p-0">
                                <div class="mt-3">
                                    <h5 class="text-body mb-0" data-anchor="data-anchor">Vehicle Info</h5>
                                </div>
                                <div class="row mt-3">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Vehicle</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="vehicle_id" id="add_employee_employee_type" required="required">
                                            <option value="">Select vehicle...</option>
                                            @foreach ($vehicles as $key => $item )
                                            <option value="{{ $item->id  }}">
                                                {{ $item->license_plate }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Delivery Vehicle Type</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="vehicle_type_id" id="add_employee_employee_type" required="required">
                                            <option value="">Select vehicle type...</option>
                                            @foreach ($vehicle_types as $key => $item )
                                            <option value="{{ $item->id  }}">
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Receiver Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="inputEmail3" name="receiver_name" type="text" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Receiver Contact Number</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="inputEmail3" name="receiver_contact_number" type="text" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Deliver/Collection</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="dispatch_id" id="add_employee_employee_type" required="required">
                                            <option value="">Select delivery or collection...</option>
                                            @foreach ($delivery_types as $key => $item )
                                            <option value="{{ $item->id  }}">
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Cargo Description</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="cargo_id" id="add_employee_employee_type" required="required">
                                            <option value="">Select cargo description...</option>
                                            @foreach ($cargos as $key => $item )
                                            <option value="{{ $item->id  }}">
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label class="col-sm-3 col-form-label-sm" for="inputEmail3">Loading/Unloading Zone</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" name="loading_zone_id" id="add_employee_employee_type" required="required">
                                            <option value="">Select zone...</option>
                                            @foreach ($loading_zones as $key => $item )
                                            <option value="{{ $item->id  }}">
                                                {{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check" style="margin:0 auto;">
                            <input class="form-check-input" id="flexCheckChecked" type="checkbox" value="" checked="" />
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
    <script src="{{asset('assets/js/pages/mds/customer/booking.js')}}"></script>


    <!-- Confirm Modal -->
    <!-- <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Congratulations! Your order is placed.</div>
            <div id="jsonOutput"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="closeModal()">
                    Ok, close and reset
                </button>
            </div>
        </div>
    </div>
</div> -->
    @include('mds.customer.partials.booking_modals')
    

    @endsection

    @push('script')

    <!-- Include SmartWizard JavaScript source -->
    <!-- <script type="text/javascript" src="{{ asset('assets/smartwizard/js/demo.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('assets/smartwizard/dist/js/jquery.smartWizard.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/smartwizard/js/smartwizard.js') }}"></script> -->

    <!-- <script>
        $(document).ready(function() {
            console.log("ready!");
            // Reset wizard
            $('#smartwizard').smartWizard("reset");

            // Reset form
            document.getElementById("form-1").reset();
            // document.getElementById("form-2").reset();
            // document.getElementById("form-3").reset();
            // document.getElementById("form-4").reset();
        });
    </script> -->

    @endpush