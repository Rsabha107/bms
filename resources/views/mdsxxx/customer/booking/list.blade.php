@extends('mds.customer.layout.customer_template')
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
                    url="{{route('mds.customer.booking.create')}}"
                    title="New Booking"
                    icon="fa-solid fa-plus"
                    class="btn btn-subtle-primary px-3 px-sm-5 me-2"
                />
                {{-- <a href="{{route('mds.customer.booking.create')}}"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_vehicle_type', 'Create Vehicle Type') ?>"><i class="bx bx-plus"></i></button></a> --}}
            </div>
        </div>
        <x-mds.customer.booking-card :bookings="$bookings" />
    <!-- </div> -->

    @include('mds.customer.modals.booking_modals')
    <script>
        var label_update = '<?= get_label('update', 'Update') ?>';
        var label_delete = '<?= get_label('delete', 'Delete') ?>';
        var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
        var label_duplicate = '<?= get_label('duplicate', 'Duplicate') ?>';
        var label_generate_pass = '<?= get_label('label_generate_pass', 'Pass') ?>';
    </script>
    <script src="{{asset('assets/js/pages/mds/customer/booking.js')}}"></script>
    @endsection

    @push('script')


    @endpush
