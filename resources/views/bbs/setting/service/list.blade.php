@extends('bbs.admin.layout.admin_template')
@section('main')
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->

    {{-- <div class="content"> --}}
    {{-- <div class="container-fluid"> --}}
    <x-formy.bread_crumb_insert_button_js title="Add Service" selectionId="offcanvas-add-service" table="services_table" activeBread="Service" />

    <x-setting.broadcast-service-card/>
    {{-- </div> --}}

    @include('bbs.setting.modals.service_modals')
    <script>
        var label_update = '<?= get_label('update', 'Update') ?>';
        var label_delete = '<?= get_label('delete', 'Delete') ?>';
        var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
        var label_duplicate = '<?= get_label('duplicate', 'Duplicate') ?>';
    </script>
    <script src="{{ asset('assets/js/pages/mds/services.js') }}"></script>
@endsection

@push('script')
<script>
        // showing the offcanvas for the task creation
        $(document).ready(function() {
            console.log('ready');
            $('.dropify').dropify();

        });
    </script>
@endpush
