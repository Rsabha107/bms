@extends('layouts.admin_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->


<div class="container-fluid">
    <div class="d-flex justify-content-between mb-2 mt-2">
        <div class="d-flex justify-content-between m-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('hr.admin.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('general.settings.company')}}">
                                <?= get_label('settings', 'Settings') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('employee_address', 'Business Address') ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div id="cover-spin" style="display:none;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div>
            <a href="javascript:void(0)" data-table="business_address_table" id="add_business_address" data-id="0">
                <button type="button" class="btn btn-primary px-5" data-bs-toggle="tooltip" data-bs-placement="right"
                    data-bs-original-title=" <?= get_label('add_address', 'Add Address') ?>">
                    <i class="fa-solid fa-plus me-2"></i>Add Address
                </button>
            </a>
        </div>
    </div>
    <!-- <div class="row g-3 mb-4">
        <div class="col-auto">
            <h4 class="mb-0">Addresses</h4>
        </div>
    </div> -->
    <x-generalsettings.gs-addresses-card />
</div>
@include('general.settings.partials.gs_address_modal')
<script src="{{asset('assets/js/pages/general_settings/business_addresses.js')}}"></script>

@endsection

@push('script')


@endpush