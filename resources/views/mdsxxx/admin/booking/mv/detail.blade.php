<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<script src="{{ asset ('assets/js/pages/mds/booking.js') }}"></script>

<div class="modal-dialog modal-lg modal-dialog-top">
    <div class="modal-content bg-100">
        <div class="modal-header">
            <div class="mb-0">
                <h4 class="fw-bolder lh-sm" id="overviewtaskTitle">Reference: {{$booking->booking_ref_number}}</h4>
                <p class="text-body-highlight fw-semibold mb-0">Booking Status:
                    <!-- <a class="ms-1 fw-bold" href="#!" id="overviewProjectName">Review </a> -->
                    <span class="badge badge-phoenix badge-phoenix-{{$booking->status->color}} fs-10 me-2">{{$booking->status->title}}</span>
                </p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-2 px-md-3 bg-body mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="row align-items-center justify-content-between g-3 mb-3">
                        <div class="col-12 col-md-auto">
                            <h6 class="fw-bolder lh-sm" id="overviewtaskTitle">Scheduled Date: {{format_date($booking->booking_date)}}</h6>
                            <h6 class="fw-bolder lh-sm" id="overviewtaskTitle">Time: {{$booking->schedule->rsp_booking_slot}}</h6>
                            <h6 class="fw-bolder lh-sm" id="overviewtaskTitle">Site: {{$booking->venue?->title}}</h6>
                            <h6 class="fw-bolder lh-sm" id="overviewtaskTitle">RSP: {{$booking->schedule->rsp->title}}</h6>
                        </div>
                        <div class="col-12 col-md-auto">
                            <div class="d-flex">
                                <!-- <div class="flex-1">
                                    <button class="btn px-3 btn-outline-primary  me-2" data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn">
                                        <span class="fas fa-paperclip"></span></button>
                                </div> -->
                                <button class="btn btn-primary me-2"><a href="{{route('mds.admin.booking.edit', $booking->id)}}" class="text-white">
                                        <span class="far fa-edit me-2"></span><span>Edit</span></a></button>
                                <button class="btn btn-primary me-2"><a href="{{route('mds.admin.booking.pass.pdf', $booking->id)}}" class="text-white" target="_blank">
                                        <span class="far fa-edit me-2"></span><span>Generate Pass</span></a></button>
                                {{-- <button class="btn btn-phoenix-secondary px-3 px-sm-5 me-2">
                                    <span class="far fa-copy me-sm-2"></span><span class="d-none d-sm-inline">Duplicate</span></button>
                                <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                <span class="fa-solid fa-ellipsis"></span></button>
                                <ul class="dropdown-menu dropdown-menu-end p-0" style="z-index: 9999;">
                                    <!-- <li><a class="dropdown-item" href="#!">Duplicate</a></li> -->
                                    <li><a class="dropdown-item" href="{{route('mds.admin.booking.pass.pdf', $booking->id)}}" target="_blank" id="generateBookingPass" data-id="{{$booking->id}}">Pass</a></li>
                                    <li><a class="dropdown-item text-danger" href="#!">Cancel Booking</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <!-- <div class="col-12 col-md-12"> -->
                <!-- <div class="col-12 col-md-12">
                    <div class="card py-3 px-3 mb-3">
                        <table class="lh-sm mb-3">
                            <tbody>
                                <tr>
                                    <td class="align-top py-1 text-body text-nowrap fw-bold">Started : </td>
                                    <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3" id="overviewtaskStartDate"></td>
                                </tr>
                                <tr>
                                    <td class="align-top py-1 text-body text-nowrap fw-bold">Deadline :</td>
                                    <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3" id="overviewtaskDueDate"></td>
                                </tr>
                                <tr class="mb-5">
                                    <td class="align-top py-1 text-body text-nowrap fw-bold">Budget Allocated :</td>
                                    <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskAllocatedBudget"></td>
                                </tr>
                                <tr class="mb-5">
                                    <td class="align-top py-1 text-body text-nowrap fw-bold">Expenses :</td>
                                    <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskActualBudget"></td>
                                </tr>
                                <tr class="mb-5">
                                    <td class="align-top py-1 text-body text-nowrap fw-bold">Department :</td>
                                    <td class="text-body-tertiary fw-semibold ps-3" id="overviewtaskDepartment"></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="lh-sm mb-4">
                            <tbody>
                                <tr>
                                    <td class="align-top py-1 text-body text-nowrap fw-bold">Labels :</td>
                                    <td class="text-warning fw-semibold ps-9">
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-phoenix badge-phoenix-info fs-10 me-2">INFO</span>
                                            <span class="badge badge-phoenix badge-phoenix-warning fs-10 me-2">URGENT</span>
                                            <span class="badge badge-phoenix badge-phoenix-success fs-10 me-2">DONE</span>
                                            <a class="text-body fw-bolder fs-9 lh-1 text-decoration-none" href="#!">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="me-3">Description</h5>
                                <a href="#"><button class="btn btn-link p-0"><span class="fa-solid fa-pen"></span></button></a>
                            </div>
                            <p class="text-body-highlight" id="overviewtaskDescription"></p>
                        </div>
                    </div>
                </div> -->
                <div class="col-12 col-md-12">
                    <div class="card py-3 px-3 mb-3">
                        <ul class="nav nav-underline fs-9 border-bottom" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-id="{{$booking->id}}" id="booking-info-tab" data-bookingid="" data-bs-toggle="tab" href="#tab-booking-info" role="tab" aria-controls="tab-booking-info" aria-selected="ttrue">Booking Information</a></li>
                            <li class="nav-item"><a class="nav-link" id="task-file-tab" data-bs-toggle="tab" href="#tab-task-file" role="tab" aria-controls="tab-home" aria-selected="false">Recent Activity</a></li>
                            <li class="nav-item"><a class="nav-link" data-id="{{$booking->id}}" id="booking-note-tab" data-bs-toggle="tab" href="#tab-booking-note" role="tab" aria-controls="tab-booking-note" aria-selected="false">Comments</a></li>
                            <li class="nav-item"><a class="nav-link" id="booking-file-tab" data-bs-toggle="tab" href="#tab-booking-file" role="tab" aria-controls="tab-home" aria-selected="false">Attachements</a></li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">

                            <div class="tab-pane fade" id="tab-booking-note" role="tabpanel" aria-labelledby="booking-note-tab">
                                <a id="collapse_booking_note" class="btn btn-link p-0 collapsed mb-4" data-bs-toggle="collapse" href="#collapseBookingNote" aria-expanded="false" aria-controls="collapseExample">
                                    + Add note
                                </a>
                                <div class="collapse" id="collapseBookingNote">
                                    <form class="needs-validation form-submit-booking-new-note" novalidate="" action="{{ route('mds.admin.booking.note.store') }}" method="POST" id="form_submit_booking_new_note">
                                        @csrf
                                        <input type="hidden" id="note_parent_booking_id_overview" name="booking_id" value="{{$booking->id}}">
                                        <input type="hidden" id="bookingNoteParentTable" name="table" value="bookings_table">
                                        <textarea class="form-control form-control mb-3" data-tinymce="{}" rows="3" id="booking_note_text" name="note_text" placeholder="Add comment" required></textarea>
                                        <div class="d-flex flex-between-center pb-3 mb-3">
                                            <div class="d-flex">
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary px-6" type="submit" id="add_comment_btn">Save comment</button>
                                        </div>
                                    </form>
                                </div>

                                <div id="bookingTabNotes"></div>
                            </div>

                            <div class="tab-pane fade" id="tab-booking-file" role="tabpanel" aria-labelledby="mds-file-tab">
                                <a id="collapse_booking_file" class="btn btn-link p-0 collapsed mb-2" data-bs-toggle="collapse" href="#collapseBookingFile" aria-expanded="false" aria-controls="collapseExample">
                                    + Upload file
                                </a>
                                <div class="collapse" id="collapseBookingFile">
                                    <!-- <div class="card card-body"> -->

                                    <form id="form_submit_task_new_file" class="needs-validation form-submit-booking-new-file" novalidate="" action="{{ route('mds.admin') }}" method="POST" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="modal-body">
                                            <div class="modal-body px-0">
                                                <div class="row g-4">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" id="file_parent_task_id_overview" name="task_id">
                                                        <input type="hidden" id="booking_parent_table" name="table" value="bookings_table">
                                                        <div class="mb-4">
                                                            <label class="text-1000 fw-bold mb-2">upload file</label>
                                                            <input class="form-control" type="file" name="file_name" id="fileupld" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer"> -->
                                        <button class="btn btn-sm btn-outline-primary px-6" type="submit" id="add_file_btn">Upload file</button>
                                        <!-- </div> -->
                                    </form>
                                    <!-- </div> -->
                                </div>
                                <div id="taskTabFiles"></div>
                            </div>

                            <div class="tab-pane fade  active show" id="tab-booking-info" role="tabpanel" aria-labelledby="booking-info-tab">

                                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-2 row-cols-xxl-2 g-3 mb-9">
                                    <div class="col">
                                        <div class="card h-100 ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="me-1">Company Party</h4>
                                                    <button class="btn btn-link p-0">
                                                        <!-- <span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span> -->
                                                    </button>
                                                </div>

                                                <div class="col-12 col-sm-auto flex-1">
                                                    <table class="lh-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Company : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->booking_party_company_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Name : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->booking_party_contact_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Email :</td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->booking_party_contact_email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Phone :</td>
                                                                <td class="text-warning fw-semibold ps-3">{{$booking->booking_party_contact_number}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card h-100 ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="me-1">Delivering Company</h4>
                                                    <button class="btn btn-link p-0">
                                                        <!-- <span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span> -->
                                                    </button>
                                                </div>

                                                <div class="col-12 col-sm-auto flex-1">
                                                    <table class="lh-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Company : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->delivering_party_company_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Email : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->delivering_party_contact_email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Phone :</td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->delivering_party_contact_name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card h-100 ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="me-1">Driver Information</h4>
                                                    <button class="btn btn-link p-0">
                                                        <!-- <span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span> -->
                                                    </button>
                                                </div>

                                                <div class="col-12 col-sm-auto flex-1">
                                                    <table class="lh-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Name : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->driver->first_name}} {{$booking->driver->last_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Phone : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->driver->mobile_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">QID/Passport :</td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->driver->national_identifier_number}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card h-100 ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="me-1">Vehicle Information</h4>
                                                    <button class="btn btn-link p-0">
                                                        <!-- <span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span> -->
                                                    </button>
                                                </div>

                                                <div class="col-12 col-sm-auto flex-1">
                                                    <table class="lh-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Type : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->vehicle_type->title}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">License Plate : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->vehicle->license_plate}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Make : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->vehicle->make}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Cargo : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->cargo->title}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card h-100 ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="me-1">Delivery Information</h4>
                                                    <button class="btn btn-link p-0">
                                                        <!-- <span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span> -->
                                                    </button>
                                                </div>

                                                <div class="col-12 col-sm-auto flex-1">
                                                    <table class="lh-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Client : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->client?->title}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Receiver Name : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->receiver_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Delivery/Collection : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->delivery_type->title}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Loading Zone : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->zone->title}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card h-100 ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <h4 class="me-1">Booking</h4>
                                                    <button class="btn btn-link p-0">
                                                        <!-- <span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span> -->
                                                    </button>
                                                </div>

                                                <div class="col-12 col-sm-auto flex-1">
                                                    <table class="lh-sm">
                                                        <tbody>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Created by : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->created_by_who->name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Created at : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{format_date($booking->created_at)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">Email : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->created_by_who->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="align-top py-1 text-body text-nowrap fw-bold">phone : </td>
                                                                <td class="text-body-tertiary text-opacity-85 fw-semibold ps-3">{{$booking->created_by_who->phone}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>