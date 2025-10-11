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
        <div>
            <x-button_insert_modal bstitle='Add Event' bstarget="#create_event_modal" />
            <!-- <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#create_event_modal"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_event', 'Create Event') ?>"><i class="bx bx-plus"></i></button></a> -->
        </div>
    </div>
    <h3 class="text-white mb-4">{{ $parent_menu }}</h3>

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

    <div class="row g-4 mb-5">
        @foreach ($services as $service)
            @php
                $badge_bg_color = $service->available_slots > 0 ? 'success' : 'danger';
                $form_action = $service->available_slots > 0 ? "route('customer.booking.cart.store')" : '#';
                $disabled = $service->available_slots > 0 ? '' : 'disabled';
                //    $show_form = $service->available_slots > 0 ? true : false;
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 pull-up">
                <div class="swiper-slide"><a class="text-decoration-none" href="#">
                        <div class="card overflow-hidden h-100">
                            <div class="position-relative">
                                <div class="bg-secondary-lighter" style="height: 100px">
                                    <span
                                        class="badge text-bg-{{ $badge_bg_color }} position-absolute top-0 end-0 z-2 mt-1 mt-sm-2 me-2 me-sm-2">{{ $service->available_slots }}
                                        available
                                    </span>
                                    <h5 class="text-body px-3 py-7">{{ $service->title }}</h5>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between mb-3">
                                <div>
                                    {{-- <p class="text-body-tertiary mb-4">Daily task</p> --}}
                                    {{-- <span class="badge text-bg-{{ $badge_bg_color }} mb-3">{{ $service->available_slots }}
                                        available
                                    </span> --}}
                                    <form action="{{ route('customer.booking.cart.store') }}" method="POST" id="cart-form">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <input type="hidden" name="unit_price" value="{{ $service->unit_price }}">

                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="d-flex flex-between-center">
                                                <input class="form-control text-center input-spin-none " style="width:50px;"
                                                    type="number" name="quantity" min="1" value="1"
                                                    max="{{ $service->available_slots }}" {{ $disabled }}>
                                                <button class="btn btn-phoenix-success border-0 ms-3"
                                                    {{ $disabled }}>Reserve
                                                    Now</button>
                                            </div>
                                        </div>
                                        {{-- <div class="d-flex justify-content-between align-items-end">
                                            <div class="d-flex flex-between-center">
                                                <button class="btn btn-phoenix-primary px-3" data-type="minus"
                                                    onclick="decrementCount(this)"><svg class="svg-inline--fa fa-minus"
                                                        aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="minus" role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 448 512" data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z">
                                                        </path>
                                                    </svg><!-- <span class="fas fa-minus"></span> Font Awesome fontawesome.com --></button>
                                                <input
                                                    class="form-control text-center input-spin-none bg-transparent border-0 outline-none"
                                                    style="width:50px;" type="number" name="quantity" min="1"
                                                    value="2">
                                                <button class="btn btn-phoenix-primary px-3" data-type="plus"
                                                    onclick="incrementCount(this)"><svg class="svg-inline--fa fa-plus"
                                                        aria-hidden="true" focusable="false" data-prefix="fas"
                                                        data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 448 512" data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z">
                                                        </path>
                                                    </svg><!-- <span class="fas fa-plus"></span> Font Awesome fontawesome.com --></button>
                                            </div>
                                            <button class="btn btn-phoenix-primary px-3 border-0"><svg
                                                    class="svg-inline--fa fa-share-nodes fs-7" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="share-nodes"
                                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M352 224c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96c0 4 .2 8 .7 11.9l-94.1 47C145.4 170.2 121.9 160 96 160c-53 0-96 43-96 96s43 96 96 96c25.9 0 49.4-10.2 66.6-26.9l94.1 47c-.5 3.9-.7 7.8-.7 11.9c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-25.9 0-49.4 10.2-66.6 26.9l-94.1-47c.5-3.9 .7-7.8 .7-11.9s-.2-8-.7-11.9l94.1-47C302.6 213.8 326.1 224 352 224z">
                                                    </path>
                                                </svg><!-- <span class="fas fa-share-alt fs-7"></span> Font Awesome fontawesome.com --></button>
                                        </div> --}}
                                    </form>
                                    {{-- <div class="d-flex flex-between-center" >
                                        <button class="btn btn-phoenix-primary px-3" data-type="minus" onclick="decrementCount(this)"><svg
                                                class="svg-inline--fa fa-minus" aria-hidden="true" focusable="false"
                                                data-prefix="fas" data-icon="minus" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z">
                                                </path>
                                            </svg><!-- <span class="fas fa-minus"></span> Font Awesome fontawesome.com --></button>
                                        <input
                                            class="form-control text-center input-spin-none bg-transparent border-0 outline-none"
                                            style="width:50px;" type="number" min="1" value="2">
                                        <button class="btn btn-phoenix-primary px-3" data-type="plus" onclick="incrementCount(this)"><svg
                                                class="svg-inline--fa fa-plus" aria-hidden="true" focusable="false"
                                                data-prefix="fas" data-icon="plus" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z">
                                                </path>
                                            </svg><!-- <span class="fas fa-plus"></span> Font Awesome fontawesome.com --></button>
                                    </div> --}}

                                </div>
                                {{-- <div class="d-flex gap-4 mt-3">
                                    <h5 class="text-body"><span
                                            class="fa-solid fa-list-check text-body-tertiary me-1"></span>44</h5>
                                    <h5 class="text-body"><span
                                            class="fa-solid fa-comment text-body-tertiary me-1"></span>12</h5>
                                    <h5 class="text-body"><span
                                            class="fa-solid fa-calendar-xmark text-body-tertiary me-1"></span>3</h5>
                                </div> --}}
                            </div>
                            <button class="btn btn-sm btn-subtle-primary" data-bs-toggle="modal"
                                data-bs-target="#descModal{{ $service->id }}">
                                Read more
                            </button>
                        </div>
                    </a>
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
    <script src="{{ asset('assets/js/pages/bbs/customer/details.js') }}"></script>

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
