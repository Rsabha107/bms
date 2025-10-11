@if (Request::is('projects/admin/project') ||
Request::is('projects/admin/project/d*') ||
Request::is('tracki/task/*/list') ||
(Request::is('tracki/employee/profile*') && !Request::is('tracki/project/archive')))


<div class="modal fade" id="add_project_members_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Add Memeber</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate=""
                action="{{ route('projects.admin.project.member.update') }}" method="POST" id="project_members">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="add_project_member_projectid" name="project_id">
                                <input type="hidden" id="add_project_member_table" name="table" value="project_members_table">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label" for="inputAddress2">Assign to (multiple)</label>
                                    <select required class="form-select js-select-project-member-assign-multiple"
                                        id="add_project_member" name="assignment_to_id[]" multiple="multiple"
                                        data-with="100%" data-placeholder="<?= get_label('Team', 'Team') ?>">
                                        {{-- <option value="">Select employees</option> --}}
                                        @foreach ($emps as $key => $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->full_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/setup/priority/*'))
<div class="modal fade" id="create_priority_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_priority', 'Create priority') ?>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="create_priority_form" novalidate=""
                action="{{ route('tracki.setup.priority.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="priority_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="priority_title" class="form-label"><?= get_label('title', 'Title') ?>
                                <span class="asterisk">*</span></label>
                            <input type="text" id="addTitle" class="form-control" name="title" required
                                placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span
                                    class="asterisk">*</span></label>
                            <select class="form-select" id="color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary">
                                    <?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary">
                                    <?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success">
                                    <?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger">
                                    <?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning">
                                    <?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info">
                                    <?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark">
                                    <?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary"
                        id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_priority_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_priority_form" novalidate=""
                action="{{ route('tracki.setup.priority.update') }}" method="POST">
                @csrf

                <input type="hidden" id="priority_id" name="id" value="">
                <input type="hidden" id="edit_priority_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="priority_title" class="form-label"><?= get_label('title', 'Title') ?>
                                <span class="asterisk">*</span></label>
                            <input type="text" id="priority_title" class="form-control" name="title"
                                required
                                placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('color', 'Color') ?> <span
                                    class="asterisk">*</span></label>
                            <select class="form-select" id="priority_color" name="color">
                                <option class="badge badge-phoenix badge-phoenix-primary" value="primary">
                                    <?= get_label('primary', 'Primary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-secondary" value="secondary">
                                    <?= get_label('secondary', 'Secondary') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-success" value="success">
                                    <?= get_label('success', 'Success') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-danger" value="danger">
                                    <?= get_label('danger', 'Danger') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-warning" value="warning">
                                    <?= get_label('warning', 'Warning') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-info" value="info">
                                    <?= get_label('info', 'Info') ?></option>
                                <option class="badge badge-phoenix badge-phoenix-dark" value="dark">
                                    <?= get_label('dark', 'Dark') ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('home') || Request::is('todos'))
<div class="modal fade" id="create_todo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content form-submit-event" action="{{ url('/todos/store') }}" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"><?= get_label('create_todo', 'Create todo') ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span
                                class="asterisk">*</span></label>
                        <input type="text" class="form-control" name="title"
                            placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('priority', 'Priority') ?> <span
                                class="asterisk">*</span></label>
                        <select class="form-select" name="priority">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>
                                <?= get_label('low', 'Low') ?></option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>
                                <?= get_label('medium', 'Medium') ?></option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>
                                <?= get_label('high', 'High') ?></option>
                        </select>
                    </div>
                </div>
                <label for="description" class="form-label"><?= get_label('description', 'Description') ?></label>
                <textarea class="form-control" name="description"
                    placeholder="<?= get_label('please_enter_description', 'Please enter description') ?>"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?>
                </button>
                <button type="submit" id="submit_btn"
                    class="btn btn-primary"><?= get_label('create', 'Create') ?></button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_todo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ url('/todos/update') }}" class="modal-content form-submit-event" method="POST">
            <input type="hidden" name="id" id="todo_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">
                    <?= get_label('update_todo', 'Update todo') ?></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('title', 'Title') ?> <span
                                class="asterisk">*</span></label>
                        <input type="text" id="todo_title" class="form-control" name="title"
                            placeholder="<?= get_label('please_enter_title', 'Please enter title') ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label"><?= get_label('priority', 'Priority') ?> <span
                                class="asterisk">*</span></label>
                        <select class="form-select" id="todo_priority" name="priority">
                            <option value="low"><?= get_label('low', 'Low') ?></option>
                            <option value="medium"><?= get_label('medium', 'Medium') ?></option>
                            <option value="high"><?= get_label('high', 'High') ?></option>
                        </select>
                    </div>
                </div>
                <label for="description" class="form-label"><?= get_label('description', 'Description') ?></label>
                <textarea class="form-control" id="todo_description" name="description"
                    placeholder="<?= get_label('please_enter_description', 'Please enter description') ?>"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= get_label('close', 'Close') ?>
                </button>
                <button type="submit" class="btn btn-primary"
                    id="submit_btn"><?= get_label('update', 'Update') ?></span></button>
            </div>
        </form>
    </div>
</div>
@endif


@if (Request::is('tracki/todo/manage'))
<div class="modal fade" id="createTodoModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Create Todo</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation" novalidate="" form-submit-eventx" id="add_new_todo"
                action="{{ route('tracki.todo.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <!-- <input type="hidden" name="parent_task_id" id="subtask_parent_task_id" value=""> -->
                                <!-- <input type="hidden" name="table" value="task_table"> -->

                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Title</label>
                                    <input name="title" class="form-control" type="text" placeholder=""
                                        required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress2">Assigned to</label>
                                    <select name="assigned_to_id[]" class="form-select"
                                        data-choices="data-choices" size="1" multiple="multiple"
                                        data-options='{"removeItemButton":true,"placeholder":true}'
                                        id="floatingSelectRating" required>
                                        <option value="">Select Assinged to</option>
                                        @foreach ($users as $key => $item)
                                        @if (Request::old('id') == $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->full_name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->full_name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress">Priority</label>
                                    <select name="priority_id" class="form-select" id="floatingSelectRating"
                                        required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($priorities as $key => $item)
                                        @if (Request::old('id') == $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->title }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="gridCheck">Description</label>
                                    <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}"
                                        placeholder=""></textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-phoenix-secondary action button-submit" type="submit"
                                        value="save" id="submit_btn">Save</button>
                                    <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                    <a class="btn btn-phoenix-danger me-2 px-6" href="#"
                                        data-bs-dismiss="modal">Cancel</a>
                                    <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('tracki/task/*/list') ||
Request::is('tracki/task/manage') ||
Request::is('tracki/task/*/edit') ||
Request::is('tracki/todo/manage'))
<!-- this is the Add Attachement Modal for tasks -->
<div class="modal fade" id="addAttachementTaskModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Upload Task File</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_task_file" novalidate=""
                action="{{ route('tracki.task.file.store') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="taskAttachId" name="task_id">
                                <input type="hidden" id="taskAttachParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Name</label>
                                    <input class="form-control" type="file" name="file_name" id="fileupld"
                                        required />
                                </div>
                                <div class="form-group">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Request::is('projects/admin/task*') || Request::is('projects/admin/project*'))

<!-- this is the Add task Notes Modal -->
<div class="modal fade" id="addTaskNoteModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Add task note</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_task_note" novalidate=""
                action="{{ route('projects.admin.task.note.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="taskNoteId" name="task_id" value="">
                                <input type="hidden" id="taskNoteParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Note</label>
                                    <textarea class="form-control mb-3" id="task_note" name="note_text" rows="4" required> </textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals for change status in project and task -->
<div class="modal fade" id="taskStatusModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Change Status</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" novalidate=""
                action="{{ route('projects.admin.task.status.update') }}" method="POST" id="task_status">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="editTaskId" name="id">
                                <input type="hidden" id="editTaskEventId" name="event_id">
                                <input type="hidden" id="taskStatusParentTable" name="table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Status</label>
                                    <select name="status_id" class="form-select" id="editTaskStatusSelection"
                                        required>
                                        <option selected="selected" value="">Select</option>
                                        @foreach ($statuses as $key => $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <input class="form-control" type="number" max="100" min="0" name="prorgress_number" id="editPoregessNumber" required /> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="submit_btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- //****************************************** add_task_modal ******************************************/ */ -->
{{-- <div class="modal fade" id="add_task_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="add_task_modal_label"><?= get_label('add_task', 'Edit task') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form class="row g-3  px-3  form-submit-event needs-validation" id="add_task_form" novalidate=""
                action="{{ route('projects.admin.task.store') }}" method="POST">
                @csrf

                @if (!$projects instanceof \Illuminate\Database\Eloquent\Collection)
                <input type="hidden" id="add_task_id_h" name="project_id"
                    value="{{ $project->id }}">
                @endif
                <input type="hidden" id="add_task_table_h" name="table" value="">
                <!-- <input type="hidden" id="add_task_event_id" name="event_id" value=""> -->

                <div class="modal-body">

                    @if ($projects instanceof \Illuminate\Database\Eloquent\Collection)

                    <div class="mb-3 col-sm-6 col-md-12">
                        <div class="form-floating">
                            <select name="project_id" id="add_task_project_id" class="form-select" onChange="getProjectAssigned(this.value);" required>
                                <option selected="selected" value="">Select...</option>
                                @foreach ($projects as $key => $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a project.
                            </div>
                            <label for="add_task_project_id">Project</label>
                        </div>
                    </div>

                    @endif

                    <div class="mb-3 col-sm-6 col-md-12">
                        <div class="form-floating">
                            <input class="form-control" name="name" id="add_task_name" type="text"
                                placeholder="Project title" required />
                            <label for="add_task_name">Task Title</label>
                            <div class="invalid-feedback">
                                Please enter a title.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="mb-3 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="status_id" class="form-select" id="add_task_status">
                                    <option selected="selected" value="">Select...</option>
                                    @foreach ($statuses as $key => $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->title }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="add_task_status">Status</label>
                            </div>
                        </div>
                        <div class="mb-3 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="milestone" class="form-select" id="add_task_milestone">
                                    <option selected="selected" value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                <label for="add_task_milestone">Milestone</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6 col-md-6">
                            <div class="flatpickr-input-container">
                                <div class="form-floating">
                                    <input class="form-control datetimepicker" id="add_task_start_date" type="date"
                                        placeholder="dd/mm/yyyy" placeholder="start date" name="start_date" required
                                        data-options='{"disableMobile":true,"dateFormat":"d/m/Y","allowInput":true,}'  />
                                    <div class="invalid-feedback">
                                        Please enter start date.
                                    </div>
                                    <label class="ps-6" for="add_task_start_date">Start date</label><span
                                        class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="flatpickr-input-container">
                                <div class="form-floating">
                                    <input class="form-control datetimepicker" id="add_task_due_date" type="date"
                                        placeholder="dd/mm/yyyy" placeholder="deadline" name="due_date"
                                        data-options='{"disableMobile":true,"dateFormat":"d/m/Y","allowInput":true,}' />
                                    <label class="ps-6" for="add_task_start_date">Deadline</label><span
                                        class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputAddress2">Assign to (multiple)</label>
                            <select class="form-select js-select-task-assign-multiple" data-control="select2"
                                id="add_task_assigned_to" name="assignment_to_id[]" multiple="multiple"
                                data-with="100%">
                                @foreach ($employees as $key => $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->full_name }}
                                </option>
                                @endforeach
                            </select>
                            <!-- <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                Please choose a username.
                            </div> -->
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputAddress2">Tags (multiple)</label>
                            <select class="form-select js-select-task-tags-multiple" id="add_task_tag"
                                name="tag_id[]" multiple="multiple" data-with="100%">
                                @foreach ($tags as $key => $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="mb-3 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <input class="form-control" name="budget_allocation" id="add_task_budget" type="number" step="0.01"
                                    placeholder="" />
                                <label for="add_task_budget">Cost</label>
                            </div>
                        </div>

                        <div class="mb-3 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <input class="form-control" name="actual_budget_allocated" id="add_task_budget_utilization" type="number" step="0.01"
                                    placeholder="" />
                                <label for="add_task_name">Sales</label>
                            </div>
                        </div>
                    </div>
                    <!-- <h4 class="mt-6">Other Information</h4> -->

                    <div class="col-12 gy-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" id="add_task_description" placeholder="" style="height: 100px" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a description.
                            </div>
                            <label for="add_task_description">Description</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                    <button type="submit" class="btn btn-primary"
                        id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
<!-- //****************************************** edit_task_modal ******************************************/ */ -->
<div class="modal fade" id="edit_task_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <!-- <div class="d-flex justify-content-center">
        <div id="cover-spin" style="display:none;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-body-highlight">
            <div class="modal-header bg-modal-header">
                <h3 class="mb-0" id="edit_task_modal_label"><?= get_label('edit_task', 'Edit task') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <?php
            $workspace_id = session()->get('workspace_id');
            $is_workspace_id_set = $workspace_id ? true : false;
            //
            ?>
            <form class="row g-3  px-3 needs-validation form-submit-event" id="edit_task_form" novalidate=""
                action="{{ route('projects.admin.task.update') }}" method="POST">
                @csrf
                <div id="edit_task_modal_form"></div>
            </form>
        </div>
    </div>
</div>

<!-- Subtask modal -->
<div class="modal fade" id="createSubTaskModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Create subtask</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_new_subtasktask" novalidate=""
                action="{{ route('projects.admin.task.subtask.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" name="parent_task_id" id="subtask_parent_task_id"
                                    value="">
                                <input type="hidden" name="table" value="task_table">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="inputEmail4">Title</label>
                                    <input name="title" class="form-control" type="text" placeholder=""
                                        required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="inputAddress">Status</label>
                                    <select name="priority_id" class="form-select" id="floatingSelectRating"
                                        required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($priorities as $key => $item)
                                        @if (Request::old('id') == $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->title }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="gridCheck">Description</label>
                                    <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}"
                                        placeholder=""></textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-6">
                                    <button class="btn btn-phoenix-secondary action button-submit"
                                        type="submit" value="save" id="submit_btn">Save</button>
                                    <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                    <a class="btn btn-phoenix-danger me-2 px-6" href="#"
                                        data-bs-dismiss="modal">Cancel</a>
                                    <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- The main Task overview ***************************************************************************************************-->
<div class="modal fade" id="taskCardViewModal" tabindex="-1" aria-labelledby="taskCardViewModal"
    aria-hidden="true">

    <!-- <div class="d-flex justify-content-center">
        <div class="spinner-border" style="display:block;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <div class="mb-0">
                    <h3 class="fw-bolder lh-sm" id="overviewtaskTitle">Task quick view</h3>
                    <p class="text-body-highlight fw-semibold mb-0">Project <a class="ms-1 fw-bold"
                            href="#!" id="overviewProjectName">Review </a></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-2 px-md-3 bg-body">
                <div class="row g-2">
                    <div class="col-12 col-md-12">
                        <div class="d-md-flex mt-5 mb-0">
                            <p class="text-body-highlight fw-semibold mb-0" id="overviewtaskStatus"></p>
                            <div class="d-flex gap-2 ms-md-auto mt-3 mt-md-0">
                                <div class="d-flex">
                                    <p id="overviewtaskAssignees" class="d-flex"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card py-3 px-3 mb-3">
                            <table class="lh-sm mb-3">
                                <tbody>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Started : </td>
                                        <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3"
                                            id="overviewtaskStartDate"></td>
                                    </tr>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Deadline :</td>
                                        <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3"
                                            id="overviewtaskDueDate"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Budget Allocated
                                            :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3"
                                            id="overviewtaskAllocatedBudget"></td>
                                    </tr>
                                    <tr class="mb-5">
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Expenses :</td>
                                        <td class="text-body-tertiary fw-semibold ps-3"
                                            id="overviewtaskActualBudget"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="lh-sm mb-4">
                                <tbody>
                                    <tr>
                                        <td class="align-top py-1 text-body text-nowrap fw-bold">Labels :</td>
                                        <td class="text-warning fw-semibold ps-9">
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="badge badge-phoenix badge-phoenix-info fs-10 me-2">INFO</span>
                                                <span
                                                    class="badge badge-phoenix badge-phoenix-warning fs-10 me-2">URGENT</span>
                                                <span
                                                    class="badge badge-phoenix badge-phoenix-success fs-10 me-2">DONE</span>
                                                <a class="text-body fw-bolder fs-9 lh-1 text-decoration-none"
                                                    href="#!">
                                                    <!-- <span class="fa-solid fa-plus me-1"></span>Add another</a> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <h5 class="me-3">Description</h5>
                                    <a href="#"><button class="btn btn-link p-0"><span
                                                class="fa-solid fa-pen"></span></button></a>
                                </div>
                                <p class="text-body-highlight" id="overviewtaskDescription"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="card py-3 px-3 mb-3">
                            <ul class="nav nav-underline fs-9 border-bottom" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="task-note-tab"
                                        data-taskid="" data-bs-toggle="tab" href="#tab-task-note"
                                        role="tab" aria-controls="tab-task-note"
                                        aria-selected="false">Notes</a></li>
                                <li class="nav-item"><a class="nav-link" id="task-file-tab"
                                        data-bs-toggle="tab" href="#tab-task-file" role="tab"
                                        aria-controls="tab-home" aria-selected="true">Files</a></li>
                                <li class="nav-item"><a class="nav-link" id="task-subtask-tab"
                                        data-bs-toggle="tab" href="#tab-task-subtask" role="tab"
                                        aria-controls="tab-task-subtask" aria-selected="false">Subtask</a></li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade active show" id="tab-task-note" role="tabpanel"
                                    aria-labelledby="task-note-tab">

                                    <a id="collapse_task_note" class="btn btn-link p-0 collapsed mb-4"
                                        data-bs-toggle="collapse" href="#collapseTaskNote"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        + Add note
                                    </a>
                                    <div class="collapse" id="collapseTaskNote">
                                        <form class="needs-validation form-submit-task-new-note" novalidate=""
                                            action="{{ route('projects.admin.task.note.store') }}"
                                            method="POST" id="form_submit_task_new_note">
                                            @csrf
                                            <input type="hidden" id="note_parent_task_id_overview"
                                                name="task_id">
                                            <input type="hidden" id="taskNoteParentTable" name="table"
                                                value="task_table">
                                            <textarea class="form-control form-control mb-3" data-tinymce="{}" rows="3" id="task_note_text"
                                                name="note_text" placeholder="Add comment" required></textarea>
                                            <div class="d-flex flex-between-center pb-3 mb-3">
                                                <div class="d-flex">
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary px-6"
                                                    type="submit" id="add_comment_btn">Save comment</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="taskTabNotes"></div>
                                </div>
                                <div class="tab-pane fade" id="tab-task-file" role="tabpanel"
                                    aria-labelledby="task-file-tab">
                                    <a id="collapse_task_file" class="btn btn-link p-0 collapsed mb-2"
                                        data-bs-toggle="collapse" href="#collapseTaskFile"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        + Upload file
                                    </a>
                                    <div class="collapse" id="collapseTaskFile">
                                        <!-- <div class="card card-body"> -->

                                        <form id="form_submit_task_new_file"
                                            class="needs-validation form-submit-task-new-file" novalidate=""
                                            action="{{ route('projects.admin.task.file.store') }}"
                                            method="POST" enctype='multipart/form-data'>
                                            @csrf
                                            <div class="modal-body">
                                                <div class="modal-body px-0">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <input type="hidden"
                                                                id="file_parent_task_id_overview"
                                                                name="task_id">
                                                            <input type="hidden" id="task_parent_table"
                                                                name="table" value="task_table">
                                                            <div class="mb-4">
                                                                <label class="text-1000 fw-bold mb-2">upload
                                                                    file</label>
                                                                <input class="form-control" type="file"
                                                                    name="file_name" id="fileupld" required />
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                        role="progressbar" aria-valuenow="0"
                                                                        aria-valuemin="0" aria-valuemax="100"
                                                                        style="width: 0%"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="modal-footer"> -->
                                            <button class="btn btn-sm btn-outline-primary px-6" type="submit"
                                                id="add_file_btn">Upload file</button>
                                            <!-- </div> -->
                                        </form>
                                        <!-- </div> -->
                                    </div>
                                    <div id="taskTabFiles"></div>
                                </div>

                                <div class="tab-pane fade" id="tab-task-subtask" role="tabpanel"
                                    aria-labelledby="task-subtask-tab">
                                    <a id="collapse_task_subtask" class="btn btn-link p-0 collapsed mb-2"
                                        data-bs-toggle="collapse" href="#collapseTaskSubtask"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        + Add new subtask
                                    </a>
                                    <div class="collapse" id="collapseTaskSubtask">
                                        <!-- <div class="card card-body"> -->

                                        <form class="needs-validation form-submit-task-new-subtask"
                                            id="form_submit_task_new_subtask" novalidate=""
                                            action="{{ route('projects.admin.task.subtask.store') }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="modal-body px-0">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12">
                                                            <input type="hidden" name="parent_task_id"
                                                                id="subtask_parent_task_id_overview"
                                                                value="">
                                                            <input type="hidden" name="table"
                                                                value="task_table">

                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label"
                                                                    for="inputEmail4">Title</label>
                                                                <input name="title" class="form-control"
                                                                    type="text" placeholder="" required>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label"
                                                                    for="inputAddress">Priority</label>
                                                                <select name="priority_id" class="form-select"
                                                                    id="floatingSelectRating" required>
                                                                    <option selected="selected" value="">
                                                                        Select...</option>
                                                                    @foreach ($priorities as $key => $item)
                                                                    @if (Request::old('id') == $item->id)
                                                                    <option value="{{ $item->id }}"
                                                                        selected>
                                                                        {{ $item->title }}
                                                                    </option>
                                                                    @else
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->title }}
                                                                    </option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label"
                                                                    for="gridCheck">Description</label>
                                                                <textarea required name="description" class="form-control" id="floatingProjectOverview" data-tinymce="{}"
                                                                    placeholder=""></textarea>
                                                            </div>
                                                            <div class="col-12 d-flex justify-content-end mt-6">
                                                                <button
                                                                    class="btn btn-sm btn-outline-primary px-6 action button-submit"
                                                                    type="submit" value="save"
                                                                    id="add_subtask_btn">Save</button>
                                                                <!-- <button class="btn btn-phoenix-secondary action" type="submit" value="save">Save</button> -->
                                                                <!-- <a class="btn btn-phoenix-danger me-2 px-6" href="#" data-bs-dismiss="modal">Cancel</a> -->
                                                                <!-- <button class="btn btn-primary action" type="submit" value="publish">Publish</button> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        <!-- </div> -->
                                    </div>
                                    <div id="taskTabSub"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (Request::is('projects/admin/task/template*'))
<div class="modal fade" id="add_task_template_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Edit</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="add_task_template_form" novalidate="" action="{{ route('projects.admin.task.template.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="editId" name="id" value="">
                                <input type="hidden" name="table" id="edit_task_template_table" value="task_template_table">

                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Task Name</label>
                                    <input class="form-control" type="text" placeholder="Enter name" name="task_line_name" required />
                                </div>
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Project Type</label>
                                    <select name="project_type_id" class="form-select" id="add_edit_project_location"
                                        required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($project_type as $key => $item)
                                        @if (Request::old('id') == $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Order</label>
                                    <input class="form-control" type="text" placeholder="Enter order" name="task_line_order" required />
                                </div>
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Status</label>
                                    <select class="form-select" name="active_flag" id="editActiveFlag" required>
                                        <option value="">Select</option>
                                        <option value="1" selected>Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_task_template_modal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">
                <h3 class=" text-white mb-0" id="staticBackdropLabel">Edit</h3>
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                        class="fas fa-times fs--1 text-danger"></span></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_task_template_form" novalidate="" action="{{ route('projects.admin.task.template.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="modal-body px-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <input type="hidden" id="edit_task_template_id" name="id" value="">
                                <input type="hidden" name="table" id="edit_task_template_table" value="task_template_table">
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Task Name</label>
                                    <input class="form-control" type="text" placeholder="Enter name" name="task_line_name" id="edit_task_template_name" required />
                                </div>
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Project Type</label>
                                    <select name="project_type_id" class="form-select" id="edit_task_template_project_id"
                                        required>
                                        <option selected="selected" value="">Select...</option>
                                        @foreach ($project_type as $key => $item)
                                        @if (Request::old('id') == $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->name }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Order</label>
                                    <input class="form-control" type="text" placeholder="Enter order" name="task_line_order" id="edit_task_template_order" required />
                                </div>
                                <div class="mb-4">
                                    <label class="text-1000 fw-bold mb-2">Status</label>
                                    <select class="form-select" name="active_flag" id="edit_task_template_active_flag" required>
                                        <option value="">Select</option>
                                        <option value="1" selected>Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endif