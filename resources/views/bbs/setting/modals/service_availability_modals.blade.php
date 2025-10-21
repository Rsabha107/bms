<div class="offcanvas offcanvas-end offcanvas-global-modal in65" id="offcanvas-edit-match-service-availability-modal" tabindex="-1"
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
                <form class="row g-3 needs-validation form-submit-event" id="edit_service_form" novalidate=""
                    action="{{ route('bbs.match.service.availability.update') }}" method="POST">
                    @csrf
                    <div id="global-edit-match-service-availability-content"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end offcanvas-global-modal in65" id="offcanvas-add-match-service-availability-modal" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <a class="close-task-detail in" id="close-task-detail" style="display: block;" data-bs-dismiss="offcanvas">
        <span>
            <i class="fa fa-times"></i>
        </span>
    </a>
    <x-setting.admin-service-availability-drawer id="" formAction="{{ route('bbs.match.service.availability.store') }}"
        formId="add_service_form" :services="$broadcast_services" :matches="$matches"
        />
</div>

<div class="offcanvas offcanvas-end custom-offcanvas offcanvas-filter-modal in" id="filterOffcanvas" tabindex="-1"
    aria-labelledby="offcanvasWithBackdropLabel">
    <x-bbs.admin.admin-booking-filter-drawer id="" formAction="" formId="filter_order_form" 
        :venues="$venues" :matches="$matches" :services="$broadcast_services"/>
</div>
