@php
$roles = auth()->user()->getRoleNames();
    $is_admin = auth()->user()->hasanyrole('SuperAdmin');
    $is_customer = auth()->user()->hasanyrole('Customer');
@endphp

{{-- {{ logger($is_admin?'i am admin':'not admin') }}
{{ logger($is_customer? 'i am customer':'not customer') }}
{{ logger($roles) }} --}}

@extends($is_customer?'mds.customer.layout.customer_template':'mds.admin.layout.admin_template')
@section('main')



{{-- @if(auth()->user()->role('SuperAdmin'))
@extends('mds.admin.layout.admin_template')
@endif --}}

{{-- @hasrole('SuperAdmin')
@extends('mds.admin.layout.admin_template')
@endhasrole --}}



<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

{{-- <div class="content"> --}}
    {{-- <div class="container-fluid"> --}}
        <div class="d-flex justify-content-between m-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('drivers', 'Drivers') ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div>
                <x-button_insert_modal bstitle='Add Driver' bstarget="#create_drivers_modal" />
                <!-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_drivers_modal"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_vehicle_type', 'Create Vehicle Type') ?>"><i class="bx bx-plus"></i></button></a> -->
            </div>
        </div>
        <x-setting.driver-card :drivers="$drivers" />
    {{-- </div> --}}

    @include('mds.setting.modals.driver_modals')
    <script>
        var label_update = '<?= get_label('update', 'Update') ?>';
        var label_delete = '<?= get_label('delete', 'Delete') ?>';
        var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
        var label_duplicate = '<?= get_label('duplicate', 'Duplicate') ?>';
    </script>
    <script src="{{asset('assets/js/pages/mds/driver.js')}}"></script>
    @endsection

    @push('script')


    @endpush
