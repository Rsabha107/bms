@extends('tracki.layout.dashboard')
@section('main')


<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between m-2">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"><?= get_label('home', 'Home') ?></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('tracki.client.manage')}}"><?= get_label('clients', 'Clients') ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= get_label('all', 'All') ?>
                        </li>
                    </ol>
                </nav>
            </div>
            @if (Auth::user()->can('task.create'))
            <div>
                <a href="{{route('tracki.client.create')}}" id="add_edit_task" data-action="store" data-source="manage" data-type="add" data-table="task_table" data-id="0"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_task', 'Create task') ?>"><i class="bx bx-plus"></i></button></a>
            </div>
            @endif
        </div>

        <div class="card mt-0">
            <div class="card-body">
                <div class="table-responsive text-nowrap">

                    @if (is_countable($clients) && count($clients) > 0)
                    <input type="hidden" id="data_type" value="alltasks">
                    <div class="mx-2 mb-2">
                        <table table-stripped id="task_table" data-toggle="table" data-classes="table table-hover fs-9 mb-0 border-top border-translucent" data-loading-template="loadingTemplate" data-url="{{ route('tracki.client.all')}}" data-icons-prefix="bx" data-icons="icons" data-show-export="true" data-show-refresh="true" data-show-columns-toggle-all="true" data-show-toggle="true" data-show-fullscreen="true" data-total-field="total" data-trim-on-search="false" data-data-field="rows" data-page-size="10" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-side-pagination="server" data-show-columns="true" data-pagination="true" data-sort-name="id" data-sort-order="desc" data-mobile-responsive="true" data-buttons-class="secondary" data-query-params="queryParams">
                            <thead>
                                <tr>
                                    <!-- <th data-checkbox="true"></th> -->
                                    <th data-sortable="true" data-field="id1"><?= get_label('id', 'ID') ?></th>
                                    <!-- <th data-field="attributes"></th> -->
                                    <th data-formatter="clientFormatter" data-sortable="true"><?= get_label('client', 'Client') ?></th>
                                    <th data-sortable="true" data-field="company"><?= get_label('company', 'Company') ?></th>
                                    <th data-sortable="false" data-field="phone"><?= get_label('phone_number', 'Phone number') ?></th>
                                    <th data-sortable="false" data-field="projects" ><?= get_label('projects', 'Projects') ?></th>
                                    <!-- <th data-sortable="false" data-field="tasks" data-formatter="tasksAssignedFormatter"><?= get_label('tasks', 'Tasks') ?></th> -->

                                    <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                                    <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                                    <th data-formatter="actionsFormatter"><?= get_label('actions', 'Actions') ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        var label_update = '<?= get_label('update', 'Update') ?>';
        var label_delete = '<?= get_label('delete', 'Delete') ?>';
        var label_not_assigned = '<?= get_label('not_assigned', 'Not assigned') ?>';
        var label_projects = '<?= get_label('projects', 'Projects') ?>';
        var label_tasks = '<?= get_label('tasks', 'Tasks') ?>';
        var can_edit = <?= (Auth::user()->can('task.edit')) == '' ? '0' : '1' ?>;
        var can_delete = <?= (Auth::user()->can('task.delete')) == '' ? '0' : '1' ?>;
        var x_source = 'client';
    </script>
    <script src="{{asset('assets/js/pages/clients.js')}}"></script>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    @endsection

    @push('script')


    @endpush
