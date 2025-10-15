<div class="modal fade" id="create_event_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">Add Event
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="form_submit_event" action="{{route('bbs.setting.event.store')}}" method="POST">
                @csrf
                <input type="hidden" name="table" value="event_table">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label"><?= get_label('name', 'name') ?> <span class="asterisk">*</span></label>
                            <input required type="text" id="nameBasic" class="form-control" name="name" placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <div class="mb-3 text-start">
                            <input type="file" name="file_name" class="dropify"
                                data-height="200"
                                data-default-file="{{ !empty($user->photo) ? url('storage/upload/profile_images/' . $user->photo) : url('storage/upload/default.png') }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <?= get_label('close', 'Close') ?></label>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('save', 'Save') ?></label></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_event_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-100">
            <div class="modal-header bg-modal-header">Edit Event
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form novalidate="" class="modal-content form-submit-event needs-validation" id="edit_form_submit_event" action="{{route('bbs.setting.event.update')}}" method="POST">
                @csrf

                <div id="global-edit-event-slot-content"></div>
            </form>
        </div>
    </div>
</div>
