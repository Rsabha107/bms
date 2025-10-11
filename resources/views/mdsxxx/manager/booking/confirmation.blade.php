@extends('mds.customer.layout.customer_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">

    <div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('mds.customer.booking.create')}}">
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
            <!-- <div class="card-header p-4 border-bottom bg-body">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-body mb-0" data-anchor="data-anchor">Make a booking (MDS)</h4>
                    </div>
                </div>
            </div> -->
            <div class="row justify-content-between align-items-end mb-4 p-4 g-3">
                <div class="col-12 col-sm-auto">
                    <img src="{{ asset('assets/img/gallery/afc-asian-cup-qatar-2023.jpg') }}" alt="laravel daily" width="100" />
                </div>
                <div class="col-12 col-sm-auto">
                    <div class="d-flex align-items-center">
                        <div class="search-box me-3">
                        </div>
                        <!-- <a class="btn btn-primary px-5" href="#!" id="add_new_project" data-workspace-id=""><i class="bx bx-plus"></i></a> -->
                        <!-- <a href="#" id="add_new_project" data-workspace-id=""><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" Create project"><i class="bx bx-plus"></i></button></a> -->
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="p-4 code-to-copy">

                    <p class="fs-8 mb-3">Thank you for your booking request.  You will .....</p>
                    <p class="fs-9 mb-3">** Please note the following roules: **</p>
                    <p class="fs-8 mb-3">1 - Driver .....</p>
                    <p class="fs-8 mb-3">Below is oyur unique book reference:</p>

                    <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col-12 col-md-auto">
              <h4 class="mb-0">{{$data->booking_ref_number}}</h4>
            </div>
            <div class="col-12 col-md-auto d-flex">
              <a href="{{route('mds.customer.booking')}}"><button class="btn btn-phoenix-secondary px-3 px-sm-5 me-2">
              <!-- <span class="fa-solid fa-edit me-sm-2"></span> -->
              <span class="d-none d-sm-inline">See booking details</span></button></a>
              <a href="{{route('mds.customer.booking.pass.pdf', $data->id)}}" target="_blank"><button class="btn btn-phoenix-primary me-2">
                <!-- <span class="fa-solid fa-trash me-2"></span> -->
                <span>Pass</span></button></a>
            </div>
          </div>

                </div>
            </div>
            <br />
            &nbsp;
        </div>
    </div>

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

    <script src="{{asset('assets/js/pages/customer/booking.js')}}"></script>

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
