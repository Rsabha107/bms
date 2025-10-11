<div class="modal fade" id="add_currency" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel"><?= get_label('create_currency', 'Add Currency') ?></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation px-3 form-submit-event" id="create_currency_form" novalidate="" action="{{ route('general.settings.currency.store') }}" method="POST">
                @csrf

                <input type="hidden" name="table" value="currency_table">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name" class="form-label"><?= get_label('name', 'Name') ?> <span class="red">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="code" class="form-label"><?= get_label('code', 'code') ?> <span class="red">*</span></label>
                            <input type="text" class="form-control" name="code" required placeholder="<?= get_label('please_enter_name', 'Please enter code') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="symbol" class="form-label"><?= get_label('symbol', 'Symbol') ?> <span class="red">*</span></label>
                            <input type="text" class="form-control" name="symbol" required placeholder="<?= get_label('please_enter_symbol', 'Please enter symbol') ?>" />
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                        <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_currency_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content bg-100">
            <div class="modal-header">
                <h3 class="mb-0" id="staticBackdropLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation form-submit-event" id="edit_currency_form" novalidate="" action="{{ route('general.settings.currency.update') }}" method="POST">
                @csrf

                <input type="hidden" id="edit_currency_id" name="id" value="">
                <input type="hidden" id="edit_currency_table" name="table" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-1">
                            <label for="name" class="form-label"><?= get_label('name', 'Name') ?> <span class="red">*</span></label>
                            <input type="text" maxlength="50" class="form-control" id="edit_currency_name" name="name" required placeholder="<?= get_label('please_enter_name', 'Please enter name') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1">
                            <label for="code" class="form-label"><?= get_label('code', 'code') ?> <span class="red">*</span></label>
                            <input type="text" class="form-control" maxlength="10" id="edit_currency_code"  name="code" required placeholder="<?= get_label('please_enter_name', 'Please enter code') ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="symbol" class="form-label"><?= get_label('symbol', 'Symbol') ?> <span class="red">*</span></label>
                            <input type="text" class="form-control" maxlength="10" id="edit_currency_symbol"  name="symbol" required placeholder="<?= get_label('please_enter_symbol', 'Please enter symbol') ?>" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><?= get_label('close', 'Close') ?></label></button>
                        <button type="submit" class="btn btn-primary" id="submit_btn"><?= get_label('create', 'Create') ?></label></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- </div> -->