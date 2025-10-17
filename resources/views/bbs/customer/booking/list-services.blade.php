@extends('bbs.customer.layout.customer_template')
@section('main')
    <div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><?= get_label('home', 'Home') ?></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Services
                    </li>
                </ol>
            </nav>
        </div>
        {{-- <div>
            <x-button_insert_modal bstitle='Add Event' bstarget="#create_event_modal" />
            <!-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_event_modal"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_event', 'Create Event') ?>"><i class="bx bx-plus"></i></button></a> -->
        </div> --}}
    </div>
    <h3 class="text-white mb-4">{{ $selected_menu_display }}</h3>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-7 mb-5">
        @foreach ($services as $service)
            @php
                $badge_bg_color = $service->available_slots > 0 ? 'success' : 'danger';
                $form_action = $service->available_slots > 0 ? "route('customer.booking.cart.store')" : '#';
                $disabled = $service->available_slots > 0 ? '' : 'disabled';
                //    $show_form = $service->available_slots > 0 ? true : false;
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 pull-up">
                <div class="swiper-slide">

                    <div class="card overflow-hidden h-100 shadow-sm border-0 rounded-4 service-card">
                        <div class="card-body text-center p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2" style="height: 70px">
                                <h5 class="fw-bold mb-0 text-start">{{ $service->title }}</h5>
                                <div id="available_slots">
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="text-start mb-5">
                                <form action="{{ route('customer.booking.cart.store') }}" method="POST" id="cart-form">
                                    @csrf
                                    <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}">
                                    <input type="hidden" name="unit_price" value="{{ $service->unit_price }}">

                                    <div class="mb-3">
                                        <select class="form-select" name="venue_id" id="select_venue_id" required
                                            {{ $disabled }}>
                                            <option value="" selected disabled>Select Venue</option>
                                            @foreach ($venues as $venue)
                                                <option value="{{ $venue->id }}">{{ $venue->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-select" name="match_id" id="select_match_id" required
                                            {{ $disabled }}>
                                            <option value="" selected disabled>Select Match</option>
                                            @foreach ($matches as $match)
                                                <option value="{{ $match->id }}">{{ $match->match_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="d-flex flex-between-center">
                                            <input class="form-control text-center input-spin-none " style="width:50px;"
                                                type="number" name="quantity" min="1" value="1" id="quantity"
                                                max="{{ $service->available_slots }}" {{ $disabled }}>
                                            <button class="btn btn-phoenix-success border-0 ms-3"
                                                {{ $disabled }}>Reserve
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a href="#" class="btn w-100 text-white fw-semibold rounded-3" data-bs-toggle="modal"
                                data-bs-target="#descModal{{ $service->id }}"
                                style="background: linear-gradient(90deg, #5e9bff, #7ecbff);">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="descModal{{ $service->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $service->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            {!! $service->long_description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/pages/bbs/customer/booking.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/pages/bbs/customer/details.js') }}"></script> --}}

    <script>
        function incrementCount(btn) {
            event.preventDefault();
            let input = btn.parentNode.querySelector('input[type=number]');
            input.stepUp();
        }

        function decrementCount(btn) {
            event.preventDefault();
            let input = btn.parentNode.querySelector('input[type=number]');
            input.stepDown();
        }
    </script>
@endpush
