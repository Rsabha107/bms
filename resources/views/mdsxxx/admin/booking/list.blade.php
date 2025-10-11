@extends('mds.admin.layout.admin_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<!-- <div class="content"> -->
<!-- <div class="container-fluid"> -->
<div class="d-flex justify-content-between m-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}"><?= get_label('home', 'Home') ?></a>
                </li>
                <li class="breadcrumb-item active">
                    <?= get_label('bookings', 'Bookings') ?>
                </li>
            </ol>
        </nav>
    </div>
    <div>
        <x-formy.button
            url="{{route('mds.admin.booking.create')}}"
            title="New Booking"
            icon="fa-solid fa-plus"
            class="btn btn-subtle-primary px-3 px-sm-5 me-2" />
            <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#bookingFilterOffcanvas" aria-haspopup="true" aria-expanded="false"
                data-bs-reference="parent"><svg class="svg-inline--fa fa-filter text-primary" data-fa-transform="down-3"
                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="filter" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
                    style="transform-origin: 0.5em 0.6875em;">
                    <g transform="translate(256 256)">
                        <g transform="translate(0, 96)  scale(1, 1)  rotate(0 0 0)">
                            <path fill="currentColor"
                                d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"
                                transform="translate(-256 -256)"></path>
                        </g>
                    </g>
                </svg><!-- <span class="fa-solid fa-filter text-primary" data-fa-transform="down-3"></span> Font Awesome fontawesome.com -->
            </button>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div id="cover-spin" style="display:none;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
{{-- <div class="col-12 col-sm-auto">
    <div class="btn-group position-static" role="group">
        <div class="py-0 me-2">
            <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none"
                id="mds_schedule_event_filter">
                <option value="" selected>Filter by Event .... </option>
                @foreach ($events as $key => $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="py-0 me-2">
            <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none"
                id="mds_schedule_venue_filter">
                <option value="" selected>Filter by Venue .... </option>
                @foreach ($venues as $key => $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="py-0 me-2">
            <select class="form-select form-select-sm py-2 ms-n2 border-0 shadow-none"
                id="mds_schedule_rsp_filter">
                <option value="" selected>Filter by RSP .... </option>
                @foreach ($rsps as $key => $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="py-0 me-2">
            <input class="form-control datetimepicker" id="mds_date_range_filter" type="text" placeholder="d/m/y to d/m/y"
                data-options='{"mode":"range","dateFormat":"d/m/y","disableMobile":true}' />
        </div>

        <!-- <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0">More filters</button> -->
    </div>
</div> --}}
@include('mds.admin.modals.booking_modals')

<x-mds.admin.booking-card :bookings="$bookings" />
<!-- </div> -->

<script src="{{asset('assets/js/pages/mds/booking.js')}}"></script>
@endsection

@push('script')


@endpush