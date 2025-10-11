<div class="offcanvas offcanvas-end offcanvas-global-modal in" id="offcanvas-edit-booking-slot-modal" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <a class="close-task-detail in" id="close-task-detail" style="display: block;" data-bs-dismiss="offcanvas">
        <span><svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fa"
                data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                data-fa-i2svg="">
                <path fill="currentColor"
                    d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                </path>
            </svg><!-- <i class="fa fa-times"></i> Font Awesome fontawesome.com --></span>
    </a>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="row g-3 needs-validation form-submit-event" id="edit_booking_slot_form" novalidate=""
                    action="{{ route('mds.setting.schedule.update') }}" method="POST">
                    @csrf
                    <div id="global-edit-booking-slot-content"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end offcanvas-global-modal in" id="offcanvas-add-booking-slot-modal" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <a class="close-task-detail in" id="close-task-detail" style="display: block;" data-bs-dismiss="offcanvas">
        <span>
            <i class="fa fa-times"></i>
        </span>
    </a>
    <x-mds.admin.admin-booking-slot-drawer id="" formAction="{{ route('mds.setting.schedule.store') }}"
        formId="add_booking_slot_form" :events="$events" :venues="$venues" :rsps="$rsps" :schedules="$schedules"
        :globalYn="$global_yn" />
</div>

<div class="offcanvas offcanvas-end offcanvas-filter-modal in" id="scheduleFilterOffcanvas" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <x-setting.admin-schedule-filter-drawer id="" formAction="" formId="filter_schedule_form"
        :events="$events" :venues="$venues" :rsps="$rsps" :schedules="$schedules" :globalYn="$global_yn" />
</div>
