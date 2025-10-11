<!-- <script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<script src="{{ asset ('assets/js/pages/booking.js') }}"></script> -->

<div class="d-flex justify-content-center">
    <div class="spinner-border" style="display:none;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="mb-5">
    @if ($booking->notes->isEmpty())
    <div class="d-flex flex-wrap p-20" id="booking-file-list">
        <div class="align-items-center d-flex flex-column text-lightest p-20 w-100">
            <svg class="svg-inline--fa fa-file fa-w-12 f-21 w-100" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                <path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm160-14.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"></path>
            </svg><!-- <i class="fa fa-file f-21 w-100"></i> Font Awesome fontawesome.com -->

            <div class="f-15 mt-4">
                - No notes found. -
            </div>
        </div>
    </div>
    @else
    @foreach ($booking->notes as $key => $note )
    <div class="border-bottom border-dashed mb-3">
        <div class="d-flex align-items-center mb-3">
            <a href="#!">
                <div class="avatar avatar-xl me-2">
                    <img class="rounded-circle" src="{{asset('assets/tracki/img//team/30.webp')}}" alt="" />
                </div>
            </a>
            <div class="flex-1">
                <a class="fw-bold mb-0 text-body-emphasis" href="#!">{{$note->user_name}}</a>
                <p class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">
                    {{ Carbon\Carbon::parse($note->created_at)->format('d-M-Y h:m:i a') }}
                </p>
            </div>
            <div class="btn-reveal-trigger">
                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none d-flex btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                    <span class="fas fa-ellipsis-h"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end py-2">
                    <!-- <a class="dropdown-item" href="#!">Edit</a> -->
                    <a class="dropdown-item text-danger removeNoteDiv" data-table="bookings_table" data-id="{{$note->id}}" href="#!">Delete</a>
                    <!-- <a class="dropdown-item" href="#!">Download</a>
                            <a class="dropdown-item" href="#!">Report abuse</a> -->
                </div>
            </div>
        </div>
        <p class="text-body-secondary">
            {{$note->note_text}}
        </p>
    </div>
    @endforeach
    @endif
</div>
<!-- </div>
</div> -->
