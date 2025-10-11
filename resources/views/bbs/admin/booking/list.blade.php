@extends('bbs.admin.layout.admin_template')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->


<div class="d-flex justify-content-between m-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}"><?= get_label('home', 'Home') ?></a>
                </li>
                <li class="breadcrumb-item active">
                    <?= get_label('variation', 'Parking Variation') ?>
                </li>
            </ol>
        </nav>
    </div>
    <div>
        <x-button_insert_js title='Add Booking' selectionId="offcanvas-add-parking-variation" dataId="{{session()->get('EVENT_ID')}}"
            table="vapp_variation_table" />
    </div>
</div>
<x-bbs.admin.booking-card/>


{{-- @include('vapp.setting.modal.parking_variation_modals') --}}

<script>
    var label_update = '<?= get_label('update', 'Update') ?>';
    var label_delete = '<?= get_label('delete', 'Delete') ?>';
    var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
    var label_duplicate = '<?= get_label('duplicate', 'Duplicate') ?>';
</script>
@endsection

@push('script')
<script src="{{asset('assets/js/pages/vapp/parking_variation.js')}}"></script>


@endpush

