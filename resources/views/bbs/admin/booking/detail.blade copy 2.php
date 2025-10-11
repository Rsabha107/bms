@extends('bbs.template.customer.customer_template')
@section('main')
    <div class="pt-5 pb-9">

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0">

            <div class="container-small">
                <nav class="mb-3" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Service</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                    </ol>
                </nav>

                <div class="row g-10 mb-5 mb-lg-8">
                    <div class="col-12 col-xl-4 order-1 order-xl-0">
                        <div class="mb-2">
                            <div class="card shadow-none border mb-3" data-component-card="data-component-card">

                                <div class="swiper-theme-container">
                                    <div class="swiper theme-slider swiper-initialized swiper-horizontal swiper-backface-hidden"
                                        data-swiper="{&quot;spaceBetween&quot;:8,&quot;loop&quot;:true,&quot;loopedSlides&quot;:5,&quot;thumb&quot;:{&quot;spaceBetween&quot;:8,&quot;slidesPerView&quot;:5,&quot;loop&quot;:true,&quot;freeMode&quot;:true,&quot;grabCursor&quot;:true,&quot;loopedSlides&quot;:5,&quot;centeredSlides&quot;:true,&quot;slideToClickedSlide&quot;:true,&quot;watchSlidesVisibility&quot;:true,&quot;watchSlidesProgress&quot;:true},&quot;slideToClickedSlide&quot;:true}">
                                        <div class="swiper-wrapper">
                                            @php
                                                $counter = 0;
                                                $active_flag = 'active';
                                            @endphp
                                            @foreach ($service->service_images as $service_image)
                                                <div class="swiper-slide" role="group" aria-label="1 / 6"
                                                    data-swiper-slide-index={{ $counter }}
                                                    style="width: 697px; margin-right: 8px;">
                                                    <img class="rounded-1 img-fluid"
                                                        src="{{ asset('storage/upload/service/images/' . $service_image->image_name) }}"
                                                        alt="">
                                                </div>
                                                @php
                                                    $counter++;
                                                    $active_flag = '';
                                                @endphp
                                            @endforeach
                                            {{-- <div class="swiper-slide" role="group" aria-label="1 / 6"
                                            data-swiper-slide-index="0" style="width: 697px; margin-right: 8px;"><img
                                                class="rounded-1 img-fluid" src="../../../assets/img/generic/30.jpg"
                                                alt=""></div>
                                        <div class="swiper-slide" role="group" aria-label="1 / 6"
                                            data-swiper-slide-index="1" style="width: 697px; margin-right: 8px;"> <img
                                                class="rounded-1 img-fluid" src="../../../assets/img/generic/31.jpg"
                                                alt=""></div>
                                        <div class="swiper-slide" role="group" aria-label="1 / 6"
                                            data-swiper-slide-index="2" style="width: 697px; margin-right: 8px;"> <img
                                                class="rounded-1 img-fluid" src="../../../assets/img/generic/32.jpg"
                                                alt=""></div>
                                        <div class="swiper-slide swiper-slide-prev" role="group" aria-label="1 / 6"
                                            data-swiper-slide-index="3" style="width: 697px; margin-right: 8px;"> <img
                                                class="rounded-1 img-fluid" src="../../../assets/img/generic/33.jpg"
                                                alt=""></div>
                                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 6"
                                            data-swiper-slide-index="4" style="width: 697px; margin-right: 8px;"> <img
                                                class="rounded-1 img-fluid" src="../../../assets/img/generic/34.jpg"
                                                alt=""></div>
                                        <div class="swiper-slide swiper-slide-next" role="group" aria-label="1 / 6"
                                            data-swiper-slide-index="5" style="width: 697px; margin-right: 8px;"> <img
                                                class="rounded-1 img-fluid" src="../../../assets/img/generic/35.jpg"
                                                alt=""></div> --}}
                                        </div>
                                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                    </div>
                                    <div class="swiper-nav">
                                        <div class="swiper-button-next" tabindex="0" role="button"
                                            aria-label="Next slide" aria-controls="swiper-wrapper-ca42f61f86bf90f6"><svg
                                                class="svg-inline--fa fa-chevron-right nav-icon" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chevron-right" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                                                </path>
                                            </svg><!-- <span class="fas fa-chevron-right nav-icon"></span> Font Awesome fontawesome.com -->
                                        </div>
                                        <div class="swiper-button-prev" tabindex="0" role="button"
                                            aria-label="Previous slide" aria-controls="swiper-wrapper-ca42f61f86bf90f6"><svg
                                                class="svg-inline--fa fa-chevron-left nav-icon" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chevron-left" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z">
                                                </path>
                                            </svg><!-- <span class="fas fa-chevron-left nav-icon"></span> Font Awesome fontawesome.com -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <form action="{{ route('customer.booking.cart.store') }}" method="POST" id="cart-form">
                            @csrf
                            <div class="d-flex flex-column justify-content-between h-100">
                                <div>
                                    <h3 class="mb-3 lh-sm">{{ $service->title }}</h3>
                                    <div class="mb-5 mb-lg-5">

                                        <p class="mb-2 text-body-secondary">{{ $service->short_description }} </p>
                                        <p class="text-primary-dark fw-bold fs-9 mb-5 mb-lg-0">
                                            {{ $service->available_slots }}
                                            available
                                        </p>
                                    </div>

                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <div class="d-flex gap-3 mb-4">
                                        <div class="count-input flex-shrink-0 rounded-pill">
                                            <a type="button" class="btn btn-icon btn-lg" data-decrement=""
                                                aria-label="Decrement quantity" disabled="">
                                                <i class="ci-minus"></i>
                                            </a>
                                            <input name="quantity" type="quantity" class="form-control form-control-lg"
                                                value="1" min="1" max="{{ $service->available_slots }}"
                                                readonly="">
                                            <a type="button" class="btn btn-icon btn-lg" data-increment=""
                                                aria-label="Increment quantity">
                                                <i class="ci-plus"></i>
                                            </a>
                                        </div>
                                        <button class="btn btn-lg btn-primary rounded-pill w-100">Add to
                                            cart</button>
                                        {{-- <button class="btn btn-lg btn-warning rounded-pill fs-9 fs-sm-8">
                                            <span class="fas fa-shopping-cart me-2"></span>Add to Cart
                                        </button> --}}
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item border-top">
                                            <h2 class="accordion-header" id="headingOne">

                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    About the product

                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse show" id="collapseOne"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body pt-0">
                                                    <strong>This is the first item&apos;s accordion body.</strong>
                                                    It is shown by default, until the collapse plugin adds the appropriate
                                                    classes that we use to style each element. These classes control the
                                                    overall appearance, as well as the showing and hiding via CSS
                                                    transitions. You can modify any of this with custom CSS or overriding
                                                    our default variables. It&apos;s also worth noting that just about any
                                                    HTML can go within the <code>.accordion-body</code>, though the
                                                    transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">

                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Ingredients

                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapseTwo"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body pt-0">
                                                    <strong>This is the second item&apos;s accordion body.</strong>
                                                    It is hidden by default, until the collapse plugin adds the appropriate
                                                    classes that we use to style each element. These classes control the
                                                    overall appearance, as well as the showing and hiding via CSS
                                                    transitions. You can modify any of this with custom CSS or overriding
                                                    our default variables. It&apos;s also worth noting that just about any
                                                    HTML can go within the <code>.accordion-body</code>, though the
                                                    transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">

                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    Calories

                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapseThree"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body pt-0">
                                                    <strong>This is the third item&apos;s accordion body.</strong> It is
                                                    hidden by default, until the collapse plugin adds the appropriate
                                                    classes that we use to style each element. These classes control the
                                                    overall appearance, as well as the showing and hiding via CSS
                                                    transitions. You can modify any of this with custom CSS or overriding
                                                    our default variables. It&apos;s also worth noting that just about any
                                                    HTML can go within the <code>.accordion-body</code>, though the
                                                    transition does limit overflow.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="row g-3 g-sm-5 align-items-end">
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <div class="col-12 col-sm">
                                            <p class="fw-semibold mb-2 text-body">Quantity : </p>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div class="d-flex flex-between-center" data-quantity="data-quantity">
                                                    <a class="btn btn-phoenix-primary px-3" data-type="minus"><svg
                                                            class="svg-inline--fa fa-minus" aria-hidden="true"
                                                            focusable="false" data-prefix="fas" data-icon="minus"
                                                            role="img" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z">
                                                            </path>
                                                        </svg><!-- <span class="fas fa-minus"></span> Font Awesome fontawesome.com --></a>
                                                    <input name="quantity"
                                                        class="form-control text-center input-spin-none bg-transparent border-0 outline-none"
                                                        style="width:50px;" type="number" min="1" value="1"
                                                        max="{{ $service->available_slots }}">
                                                    <a class="btn btn-phoenix-primary px-3" data-type="plus"><svg
                                                            class="svg-inline--fa fa-plus" aria-hidden="true"
                                                            focusable="false" data-prefix="fas" data-icon="plus"
                                                            role="img" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor"
                                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z">
                                                            </path>
                                                        </svg><!-- <span class="fas fa-plus"></span> Font Awesome fontawesome.com --></a>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-lg btn-warning rounded-pill fs-9 fs-sm-8">
                                            <span class="fas fa-shopping-cart me-2"></span>Book this service
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0">

            <div class="container-small">
                <ul class="nav nav-underline fs-9 mb-4" id="productTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a></li>
                    <li class="nav-item"><a class="nav-link" id="specification-tab" data-bs-toggle="tab"
                            href="#tab-specification" role="tab" aria-controls="tab-specification"
                            aria-selected="false">Specification</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Ratings &amp; reviews</a></li> --}}
                </ul>
                <div class="row gx-3 gy-">
                    <div class="col-12 col-lg-7 col-xl-8">
                        <div class="tab-content" id="productTabContent">
                            <div class="tab-pane pe-lg-6 pe-xl-12 fade show active text-body-emphasis"
                                id="tab-description" role="tabpanel" aria-labelledby="description-tab">
                                <p class="mb-5">{!! $service->long_description !!}</p>
                            </div>
                            <div class="tab-pane pe-lg-6 pe-xl-12 fade" id="tab-specification" role="tabpanel"
                                aria-labelledby="specification-tab">
                                <h3 class="mb-0 ms-4 fw-bold">Processor/Chipset</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%"> </th>
                                            <th style="width: 60%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Chip
                                                    name</h6>
                                            </td>
                                            <td class="px-5 mb-0">Apple M1 chip</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Cpu
                                                    core</h6>
                                            </td>
                                            <td class="px-5 mb-0">8 (4 performance and 4 efficiency)</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Gpu
                                                    core</h6>
                                            </td>
                                            <td class="px-5 mb-0">7</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Neural
                                                    engine</h6>
                                            </td>
                                            <td class="px-5 mb-0">16 cores</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3 class="mb-0 mt-6 ms-4 fw-bold">Storage</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%"></th>
                                            <th style="width: 60%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Memory
                                                </h6>
                                            </td>
                                            <td class="px-5 mb-0">8 GB unified</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">SSD
                                                </h6>
                                            </td>
                                            <td class="px-5 mb-0">256 GB</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3 class="mb-0 mt-6 ms-4 fw-bold">Display</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%"> </th>
                                            <th style="width: 60%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Display
                                                    type</h6>
                                            </td>
                                            <td class="px-5 mb-0">Retina</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Size
                                                </h6>
                                            </td>
                                            <td class="px-5 mb-0">24” (actual diagonal 23.5”)</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Resolution</h6>
                                            </td>
                                            <td class="px-5 mb-0">4480 x 2520 </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Brightness</h6>
                                            </td>
                                            <td class="px-5 mb-0">500 nits</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3 class="mb-0 mt-6 ms-4 fw-bold">Additional Specifications</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%"> </th>
                                            <th style="width: 60%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Camera
                                                </h6>
                                            </td>
                                            <td class="px-5 mb-0">1080p FaceTime HD camera</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight">
                                                <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Video </h6>
                                            </td>
                                            <td class="px-5 mb-0">Full native resolution on built-in display at 1 billion
                                                colors; <br>One external display with up to 6K resolution at 60Hz</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight">
                                                <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Audio</h6>
                                            </td>
                                            <td class="px-5 mb-0">High-fidelity six-speaker with force-cancelling woofers
                                                <br>Wide stereo sound <br>Spatial audio with Dolby Atmos3<br>Studio-quality
                                                three-mic array with directional beamforming
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight">
                                                <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Inputs </h6>
                                            </td>
                                            <td class="px-5 mb-0">Magic Keyboard<br>Magic Mouse</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight">
                                                <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Wireless </h6>
                                            </td>
                                            <td class="px-5 mb-0">802.11ax Wi-Fi 6 (IEEE 802.11a/b/g/n/ac
                                                compatible)<br>Bluetooth 5.0 wireless technology</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight">
                                                <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    I/O &amp; expantions </h6>
                                            </td>
                                            <td class="px-5 mb-0">Thunderbolt / USB 4 ports x 2<br>3.5 mm headphone
                                                jack<br>Gigabit Ethernet<br>USB 3 ports x2</td>
                                        </tr>
                                        <tr>
                                            <td class="bg-body-highlight align-middle">
                                                <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">
                                                    Operating System</h6>
                                            </td>
                                            <td class="px-5 mb-0">macOS Monterey </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3 class="mb-3 mt-6 ms-4 fw-bold">In The Box</h3>
                                <p class="lh-sm border-top border-translucent mb-0 py-3 px-4">iMac 24”</p>
                                <p class="lh-sm border-top border-translucent mb-0 py-3 px-4">Magic Keyboard </p>
                                <p class="lh-sm border-top border-translucent mb-0 py-3 px-4">Magic Mouse</p>
                                <p class="lh-sm border-top border-translucent mb-0 py-3 px-4">143W power adapter</p>
                                <p class="lh-sm border-top border-translucent mb-0 py-3 px-4">2m Power Cord</p>
                                <p class="lh-sm border-y border-translucent mb-0 py-3 px-4">USB-C to Lightning Cable</p>
                            </div>
                        </div>
                    </div>
                    <!-- end of .container-->
                </div>
        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->

    </div>
@endsection

@push('script')
    <script>
        var galleryThumbs = new Swiper(".gallery-thumbs", {
            centeredSlides: true,
            centeredSlidesBounds: true,
            slidesPerView: 3,
            watchOverflow: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            direction: 'vertical'
        });

        var galleryMain = new Swiper(".gallery-main", {
            watchOverflow: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            preventInteractionOnTransition: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            thumbs: {
                swiper: galleryThumbs
            }
        });

        galleryMain.on('slideChangeTransitionStart', function() {
            galleryThumbs.slideTo(galleryMain.activeIndex);
        });

        galleryThumbs.on('transitionStart', function() {
            galleryMain.slideTo(galleryThumbs.activeIndex);
        });

        !(function() {
            "use strict";
            (() => {

                const e = document.querySelectorAll(".count-input");
                if (0 === e.length) return;
                const t = (e) => {
                        const t = e.currentTarget.parentNode.querySelector(".form-control"),
                            n = parseInt(t.getAttribute("max")) || 1 / 0;
                        t.value < n && (t.value++, i(t));
                    },
                    n = (e) => {
                        const t = e.currentTarget.parentNode.querySelector(".form-control"),
                            n = parseInt(t.getAttribute("min")) || 0;
                        t.value > n && (t.value--, i(t));
                    },
                    i = (e) => {
                        const t = e.parentNode.querySelector("[data-decrement]"),
                            n = e.parentNode.querySelector("[data-increment]"),
                            i = parseInt(e.getAttribute("min")) || 0,
                            s = parseInt(e.getAttribute("max")) || 1 / 0;
                        (t.disabled = e.value <= i), (n.disabled = e.value >= s);
                        const o = e.closest(".count-input");
                        if (!o.classList.contains("count-input-collapsible")) return;
                        const r = n.querySelector("[data-count-input-value]");
                        e.value > 0 ?
                            (o.classList.remove("collapsed"), r && (r.textContent = e.value)) :
                            (o.classList.add("collapsed"), r && (r.textContent = ""));
                    };
                e.forEach((e) => {
                    const s = e.querySelector("[data-increment]"),
                        o = e.querySelector("[data-decrement]"),
                        r = e.querySelector(".form-control");
                    s.addEventListener("click", t), o.addEventListener("click", n), i(r);
                });
            })()
        })();
    </script>
@endpush
