@extends('bbs.customer.layout.customer_template')
@section('main')
    <div class="d-flex justify-content-between m-2">
        {{-- <div>
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
        <div> --}}
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    @foreach ($breadcrumb as $item)
                        @if ($item['url'])
                            <li class="breadcrumb-item">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">
                                <span>{{ $item['title'] }}</span>
                            </li>
                        @endif

                        {{-- @if (!$loop->last)
                            <span> &gt; </span>
                        @endif --}}
                    @endforeach
            </nav>
        </div>
    </div>
    {{-- <div>
            <x-button_insert_modal bstitle='Add Event' bstarget="#create_event_modal" />
            <!-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_event_modal"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_event', 'Create Event') ?>"><i class="bx bx-plus"></i></button></a> -->
        </div> --}}
    {{-- </div> --}}
    {{-- <h3 class="text-white mb-4">{{ $selected_menu_display }}</h3> --}}

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
                // $show_form = $service->available_slots > 0 ? true : false;
                $menu_name = $service->menu_item?->title ?? 'Service';
                $menu_parent_name = $service->menu_item?->parent?->title ?? null;
            @endphp
            @if ($service->service_type == null)
                <div class="col-md-6 col-xxl-3 pull-up">
                    <div class="card h-90 service-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="height: 110px">
                                <div>
                                    <h5 class="mb-3">{{ $service->title }}
                                        {{-- <span
                                        class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"><span
                                            class="badge-label">-6.8%</span></span></h5>  --}}
                                        @if ($menu_parent_name)
                                            <h6 class="text-body-tertiary">{{ $menu_parent_name }} > {{ $menu_name }}
                                            </h6>
                                        @else
                                            <h6 class="text-body-tertiary">{{ $menu_name }}</h6>
                                        @endif
                                </div>
                                {{-- <h4>16,247</h4> --}}
                                <div id="available_slots">
                                </div>
                            </div>
                            <hr class="my-3">

                            <div class="d-flex justify-content-center">
                                {{-- <div class="d-flex justify-content-center py-3"> --}}
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
                                            {{-- @foreach ($matches as $match)
                                            <option value="{{ $match->id }}">{{ $match->match_code }}</option>
                                        @endforeach --}}
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
                            <div class="d-flex justify-content-center px-4 py-6">
                                <a href="#" class="btn w-100 text-white fw-semibold rounded-3" data-bs-toggle="modal"
                                    data-bs-target="#descModal{{ $service->id }}"
                                    style="background: linear-gradient(90deg, #5e9bff, #7ecbff);">
                                    Read more
                                </a>
                                {{-- <div class="echart-total-orders" style="height:85px;width:115px"></div> --}}
                            </div>
                            {{-- <div class="mt-2">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Completed</h6>
                                <h6 class="text-body fw-semibold mb-0">52%</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bullet-item bg-primary-subtle me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                <h6 class="text-body fw-semibold mb-0">48%</h6>
                            </div>
                        </div> --}}
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
            @elseif ($service->service_type == 'mmc-studio')
                <div class="col-md-6 col-xxl-3 pull-up">
                    <div class="card h-90 service-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="height: 110px">
                                <div>
                                    <h5 class="mb-3">{{ $service->title }}
                                        {{-- <span
                                        class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"><span
                                            class="badge-label">-6.8%</span></span></h5>  --}}
                                        @if ($menu_parent_name)
                                            <h6 class="text-body-tertiary">{{ $menu_parent_name }} > {{ $menu_name }}
                                            </h6>
                                        @else
                                            <h6 class="text-body-tertiary">{{ $menu_name }}</h6>
                                        @endif
                                </div>
                                {{-- <h4>16,247</h4> --}}
                                <div id="available_slots">
                                </div>
                            </div>
                            <hr class="my-3">

                            <div class="d-flex justify-content-center">
                                {{-- <div class="d-flex justify-content-center py-3"> --}}
                                <form action="{{ route('customer.booking.cart.store') }}" method="POST" id="cart-form">
                                    @csrf
                                    <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}">
                                    <input type="hidden" name="unit_price" value="{{ $service->unit_price }}">

                                    <div class="mb-3">
                                        <select class="form-select" name="venue_id" id="select_mmc" required
                                            {{ $disabled }}>
                                            <option value="" selected disabled>Select Space</option>
                                            @foreach ($mmc_studios as $space)
                                                <option value="{{ $space->id }}">{{ $space->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-select" name="match_id" id="select_match_id" required
                                            {{ $disabled }}>
                                            <option value="" selected disabled>Select Match</option>
                                            {{-- @foreach ($matches as $match)
                                            <option value="{{ $match->id }}">{{ $match->match_code }}</option>
                                        @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="d-flex flex-between-center">
                                            <input class="form-control text-center input-spin-none " style="width:50px;"
                                                type="number" name="quantity" min="1" value="1"
                                                id="quantity" max="{{ $service->available_slots }}"
                                                {{ $disabled }}>
                                            <button class="btn btn-phoenix-success border-0 ms-3"
                                                {{ $disabled }}>Reserve
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-center px-4 py-6">
                                <a href="#" class="btn w-100 text-white fw-semibold rounded-3"
                                    data-bs-toggle="modal" data-bs-target="#descModal{{ $service->id }}"
                                    style="background: linear-gradient(90deg, #5e9bff, #7ecbff);">
                                    Read more
                                </a>
                                {{-- <div class="echart-total-orders" style="height:85px;width:115px"></div> --}}
                            </div>
                            {{-- <div class="mt-2">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Completed</h6>
                                <h6 class="text-body fw-semibold mb-0">52%</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bullet-item bg-primary-subtle me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                <h6 class="text-body fw-semibold mb-0">48%</h6>
                            </div>
                        </div> --}}
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
            @elseif ($service->service_type == 'mmc-conference')
                <div class="col-md-6 col-xxl-3 pull-up">
                    <div class="card h-90 service-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="height: 110px">
                                <div>
                                    <h5 class="mb-3">{{ $service->title }}
                                        {{-- <span
                                        class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"><span
                                            class="badge-label">-6.8%</span></span></h5>  --}}
                                        @if ($menu_parent_name)
                                            <h6 class="text-body-tertiary">{{ $menu_parent_name }} > {{ $menu_name }}
                                            </h6>
                                        @else
                                            <h6 class="text-body-tertiary">{{ $menu_name }}</h6>
                                        @endif
                                </div>
                                {{-- <h4>16,247</h4> --}}
                                <div id="available_slots">
                                </div>
                            </div>
                            <hr class="my-3">

                            <div class="d-flex justify-content-center">
                                {{-- <div class="d-flex justify-content-center py-3"> --}}
                                <form action="{{ route('customer.booking.cart.store') }}" method="POST" id="cart-form">
                                    @csrf
                                    <input type="hidden" name="service_id" id="service_id"
                                        value="{{ $service->id }}">
                                    <input type="hidden" name="unit_price" value="{{ $service->unit_price }}">

                                    <div class="mb-3">
                                        <select class="form-select" name="venue_id" id="select_mmc" required
                                            {{ $disabled }}>
                                            <option value="" selected disabled>Select Space</option>
                                            @foreach ($mmc_confs as $space)
                                                <option value="{{ $space->id }}">{{ $space->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-select" name="match_id" id="select_match_id" required
                                            {{ $disabled }}>
                                            <option value="" selected disabled>Select Match</option>
                                            {{-- @foreach ($matches as $match)
                                            <option value="{{ $match->id }}">{{ $match->match_code }}</option>
                                        @endforeach --}}
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="d-flex flex-between-center">
                                            <input class="form-control text-center input-spin-none " style="width:50px;"
                                                type="number" name="quantity" min="1" value="1"
                                                id="quantity" max="{{ $service->available_slots }}"
                                                {{ $disabled }}>
                                            <button class="btn btn-phoenix-success border-0 ms-3"
                                                {{ $disabled }}>Reserve
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-center px-4 py-6">
                                <a href="#" class="btn w-100 text-white fw-semibold rounded-3"
                                    data-bs-toggle="modal" data-bs-target="#descModal{{ $service->id }}"
                                    style="background: linear-gradient(90deg, #5e9bff, #7ecbff);">
                                    Read more
                                </a>
                                {{-- <div class="echart-total-orders" style="height:85px;width:115px"></div> --}}
                            </div>
                            {{-- <div class="mt-2">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Completed</h6>
                                <h6 class="text-body fw-semibold mb-0">52%</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bullet-item bg-primary-subtle me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                <h6 class="text-body fw-semibold mb-0">48%</h6>
                            </div>
                        </div> --}}
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
            @endif
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
