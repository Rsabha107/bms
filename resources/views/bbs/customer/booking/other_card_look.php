            <div class="col-sm-6 col-md-4 col-lg-3 pull-up">
                <div class="swiper-slide">
                    <a class="text-decoration-none" href="#">
                        <div class="card overflow-hidden h-100">
                            <div class="position-relative">
                                <div class="bg-white" style="height: 100px">
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