@php
    $roles = auth()->user()->getRoleNames();
    $is_admin = auth()->user()->hasanyrole('SuperAdmin');
    $is_customer = auth()->user()->hasanyrole('Customer');
@endphp

{{-- {{ logger($is_admin?'i am admin':'not admin') }}
{{ logger($is_customer? 'i am customer':'not customer') }}
{{ logger($roles) }} --}}

@extends($is_customer ? 'mds.customer.layout.customer_template' : 'mds.admin.layout.admin_template')
@section('main')
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
                        <a href="{{ route('home') }}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= get_label('vehicles', 'Vehicles') ?>
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <x-button_insert_modal bstitle='Add Vehicle' bstarget="#create_vehicles_modal" />
        </div>
    </div>
    <x-setting.vehicle-card :vehicles="$vehicles" />
    {{-- </div> --}}

    @include('mds.setting.modals.vehicle_modals')
    <script>
        var label_update = '<?= get_label('update', 'Update') ?>';
        var label_delete = '<?= get_label('delete', 'Delete') ?>';
        var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
        var label_duplicate = '<?= get_label('duplicate', 'Duplicate') ?>';
    </script>
    <script src="{{ asset('assets/js/pages/mds/vehicle.js') }}"></script>
@endsection

@push('script')
@endpush
