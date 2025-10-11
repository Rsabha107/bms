@extends('mds.admin.layout.admin_template')
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

                <section class="container pt-md-4 pb-5 mt-md-2 mt-lg-3 mb-2 mb-sm-3 mb-lg-4 mb-xl-5">
                    <div class="row align-items-start">

                        <!-- Product gallery -->
                        <div class="col-md-6 col-lg-7 sticky-md-top z-1 mb-4 mb-md-0" style="margin-top: -120px">
                            <div class="d-flex" style="padding-top: 120px">

                                <!-- Thumbnails -->
                                <div class="swiper swiper-load swiper-thumbs d-none d-lg-block w-100 me-xl-3 swiper-initialized swiper-vertical swiper-watch-progress swiper-backface-hidden"
                                    id="thumbs"
                                    data-swiper="{
                                        &quot;direction&quot;: &quot;vertical&quot;,
                                        &quot;spaceBetween&quot;: 12,
                                        &quot;slidesPerView&quot;: 4,
                                        &quot;watchSlidesProgress&quot;: true
                                    }"
                                    style="max-width: 96px; height: 420px;">
                                    <div class="swiper-wrapper " id="swiper-wrapper-baf8aa555bf908f5"
                                        aria-live="polite" style="transform: translate3d(0px, 0px, 0px);">
                                        @foreach ($service->service_images as $service_image)
                                            <div class="swiper-slide swiper-thumb swiper-slide-visible swiper-slide-fully-visible swiper-slide-active swiper-slide-thumb-active"
                                                role="group" aria-label="1 / 3"
                                                style="height: 96px; margin-bottom: 12px;">
                                                <div class="ratio ratio-1x1" style="max-width: 94px">
                                                    <img src="{{ asset('storage/upload/service/images/' . $service_image->image_name) }}"
                                                        class="swiper-thumb-img" alt="Thumbnail">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="swiper-slide swiper-thumb swiper-slide-visible swiper-slide-fully-visible swiper-slide-next"
                                            role="group" aria-label="2 / 3" style="height: 96px; margin-bottom: 12px;">
                                            <div class="ratio ratio-1x1" style="max-width: 94px">
                                                <img src="{{ asset('assets/img/shop/grocery/product/th02.png') }}"
                                                    class="swiper-thumb-img" alt="Thumbnail">
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-thumb swiper-slide-visible swiper-slide-fully-visible"
                                            role="group" aria-label="3 / 3" style="height: 96px; margin-bottom: 12px;">
                                            <div class="ratio ratio-1x1" style="max-width: 94px">
                                                <img src="{{ asset('assets/img/shop/grocery/product/th03.png') }}"
                                                    class="swiper-thumb-img" alt="Thumbnail">
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-thumb swiper-slide-visible swiper-slide-fully-visible"
                                            role="group" aria-label="1 / 3" style="height: 96px; margin-bottom: 12px;">
                                            <div class="ratio ratio-1x1" style="max-width: 94px">
                                                <img src="{{ asset('assets/img/shop/grocery/product/th04.png') }}"
                                                    class="swiper-thumb-img" alt="Thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                </div>

                                <!-- Preview (Large image) -->
                                <div class="swiper w-100 swiper-initialized swiper-horizontal swiper-backface-hidden"
                                    data-swiper="{
                                                    &quot;loop&quot;: false,
                                                    &quot;thumbs&quot;: {
                                                    &quot;swiper&quot;: &quot;#thumbs&quot;
                                                    },
                                                    &quot;pagination&quot;: {
                                                    &quot;el&quot;: &quot;.swiper-pagination&quot;,
                                                    &quot;clickable&quot;: true
                                                    }
                                                }">
                                    <div class="swiper-wrapper" id="swiper-wrapper-3637e9723e2010a86" aria-live="polite">
                                        @php
                                            $active_slide = 'swiper-slide-active';
                                        @endphp
                                        @foreach ($service->service_images as $service_image)
                                            <div class="swiper-slide {{ $active_slide }}" role="group" aria-label="1 / 3"
                                                style="width: 634px;">
                                                <a class="ratio ratio-1x1 d-block cursor-zoom-in"
                                                    href="{{ asset('storage/upload/service/images/' . $service_image->image_name) }}"
                                                    data-glightbox="" data-gallery="product-gallery">
                                                    <img src="{{ asset('storage/upload/service/images/' . $service_image->image_name) }}"
                                                        alt="Preview">
                                                </a>
                                            </div>
                                            {{-- @dd($service_image); --}}
                                            @php
                                                $active_slide = 'swiper-slide-active';
                                            @endphp
                                        @endforeach
                                        <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 3"
                                            style="width: 634px;">
                                            <a class="ratio ratio-1x1 d-block cursor-zoom-in"
                                                href="{{ asset('assets/img/shop/grocery/product/02.png') }}"
                                                data-glightbox="" data-gallery="product-gallery">
                                                <img src="{{ asset('assets/img/shop/grocery/product/02.png') }}"
                                                    alt="Preview">
                                            </a>
                                        </div>
                                        <div class="swiper-slide" role="group" aria-label="3 / 3" style="width: 634px;">
                                            <a class="ratio ratio-1x1 d-block cursor-zoom-in"
                                                href="{{ asset('assets/img/shop/grocery/product/03.png') }}"
                                                data-glightbox="" data-gallery="product-gallery">
                                                <img src="{{ asset('assets/img/shop/grocery/product/03.png') }}"
                                                    alt="Preview">
                                            </a>
                                        </div>
                                        <div class="swiper-slide swiper-slide-next" role="group" aria-label="1 / 3"
                                            style="width: 634px;">
                                            <a class="ratio ratio-1x1 d-block cursor-zoom-in"
                                                href="{{ asset('assets/img/shop/grocery/product/04.png') }}"
                                                data-glightbox="" data-gallery="product-gallery">
                                                <img src="{{ asset('assets/img/shop/grocery/product/04.png') }}"
                                                    alt="Preview">
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Slider pagination (Bullets) visible on screens > 991px wide (lg breakpoint) -->
                                    <div
                                        class="swiper-pagination mb-n3 d-lg-none swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal">
                                        <span class="swiper-pagination-bullet swiper-pagination-bullet-active"
                                            tabindex="0" role="button" aria-label="Go to slide 1"
                                            aria-current="true"></span><span class="swiper-pagination-bullet"
                                            tabindex="0" role="button" aria-label="Go to slide 2"></span><span
                                            class="swiper-pagination-bullet" tabindex="0" role="button"
                                            aria-label="Go to slide 3"></span>
                                    </div>
                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Product details -->
                        <div class="col-md-6 col-lg-5 position-relative">
                            <div class="ps-xxl-3">
                                <h1 class="h5 mb-2">{{ $service->title }}</h1>
                                <div class="border rounded-pill px-4 py-2 my-4" >
                                    <div class="text-dark-emphasis fs-sm py-1" style="color: #000 !important;">
                                        {{-- <p class="text-primary-dark fw-bold fs-9 mb-5 mb-lg-0"> --}}
                                        {{ $service->available_slots }}
                                        available
                                    </div>
                                </div>
                               <form action="{{ route('admin.booking.cart.store') }}" method="POST" id="cart-form">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <input type="hidden" name="unit_price" value="{{ $service->unit_price }}">
                                    <div class="h3">QR {{ $service->unit_price }}</div>
                                    <div class="d-flex gap-3 mb-4">
                                        <div class="count-input flex-shrink-0 rounded-pill">
                                            <a href="javascript:void(0)" class="btn btn-icon btn-lg" data-decrement="" aria-label="Decrement quantity" disabled>
                                                <i class="ci-minus"></i>
                                            </a>
                                            <input name='quantity' type="number" class="form-control form-control-lg"
                                                value="1" min="1" max="{{ $service->available_slots }}">
                                            <a href="javascript:void(0)" class="btn btn-icon btn-lg" data-increment="" aria-label="Increment quantity">
                                                <i class="ci-plus"></i>
                                            </a>
                                        </div>
                                        <button class="btn btn-lg btn-primary rounded-pill w-100">Add to cart</button>
                                    </div>
                                </form>
                                <p class="fs-sm mb-4">{{ $service->short_description }}</p>
                                {{-- <div class="d-flex flex-wrap gap-3 gap-xxl-4 fs-sm text-dark-emphasis mb-2">
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ci-gluten-free fs-xl text-body-emphasis me-2"></i>
                                        Gluten-free
                                    </div>
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ci-broccoli fs-xl text-body-emphasis me-2"></i>
                                        Plant based
                                    </div>
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ci-leaf fs-xl text-body-emphasis me-2"></i>
                                        Vegan
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="ci-avocado fs-xl text-body-emphasis me-2"></i>
                                        Keto
                                    </div>
                                </div> --}}

                                <!-- Product info accordion -->
                                <div class="accordion accordion-alt-icon py-2 mb-4" id="productAccordion">
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingProductInfo">
                                            <button type="button" class="accordion-button animate-underline collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#productInfo"
                                                aria-expanded="false" aria-controls="productInfo">
                                                <span class="animate-target me-2">About this product</span>
                                            </button>
                                        </h3>
                                        <div class="accordion-collapse collapse" id="productInfo"
                                            aria-labelledby="headingProductInfo" data-bs-parent="#productAccordion">
                                            <div class="accordion-body">{!! $service->long_description !!}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingProductIngredients">
                                            <button type="button" class="accordion-button animate-underline collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#productIngredients"
                                                aria-expanded="false" aria-controls="productIngredients">
                                                <span class="animate-target me-2">Ingredients</span>
                                            </button>
                                        </h3>
                                        <div class="accordion-collapse collapse" id="productIngredients"
                                            aria-labelledby="headingProductIngredients"
                                            data-bs-parent="#productAccordion">
                                            <div class="accordion-body">
                                                <ul class="m-0">
                                                    <li>Gluten-free oats</li>
                                                    <li>Almonds</li>
                                                    <li>Sunflower seeds</li>
                                                    <li>Pumpkin seeds</li>
                                                    <li>Dried cranberries (cranberries, sugar, sunflower oil)</li>
                                                    <li>Dried apricots (apricots, rice flour)</li>
                                                    <li>Coconut flakes</li>
                                                    <li>Flax seeds</li>
                                                    <li>Chia seeds</li>
                                                    <li>Cinnamon</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingProductCalories">
                                            <button type="button" class="accordion-button animate-underline collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#productCalories"
                                                aria-expanded="false" aria-controls="productCalories">
                                                <span class="animate-target me-2">Calories</span>
                                            </button>
                                        </h3>
                                        <div class="accordion-collapse collapse" id="productCalories"
                                            aria-labelledby="headingProductCalories" data-bs-parent="#productAccordion">
                                            <div class="accordion-body">Approximately <span
                                                    class="text-body-emphasis fw-medium">400 kcal / 100g</span> of product
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingProductDelivery">
                                            <button type="button" class="accordion-button animate-underline collapsed"
                                                data-bs-toggle="collapse" data-bs-target="#productDelivery"
                                                aria-expanded="false" aria-controls="productDelivery">
                                                <span class="animate-target me-2">Delivery info</span>
                                            </button>
                                        </h3>
                                        <div class="accordion-collapse collapse" id="productDelivery"
                                            aria-labelledby="headingProductDelivery" data-bs-parent="#productAccordion">
                                            <div class="accordion-body">
                                                <ul class="m-0">
                                                    <li>Enjoy free delivery for orders <span
                                                            class="text-body-emphasis fw-medium">over $50!</span></li>
                                                    <li>For orders <span class="text-body-emphasis fw-medium">below
                                                            $50</span>, a standard delivery fee of <span
                                                            class="text-body-emphasis fw-medium">$5</span> applies.</li>
                                                    <li>We strive to deliver your order in a timely manner to ensure your
                                                        satisfaction.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                {{-- <div class="d-flex align-items-center position-relative text-dark-emphasis">
                                    <i class="ci-edit fs-lg me-2"></i>
                                    <a class="stretched-link fs-sm text-dark-emphasis" href="#!">Report incorrect
                                        product information</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </section>

                {{-- <div class="row g-10 mb-5 mb-lg-8">
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

                                        </div>
                                        <span class="swiper-notification" aria-live="assertive"
                                            aria-atomic="true"></span>
                                    </div>
                                    <div class="swiper-nav">
                                        <div class="swiper-button-next" tabindex="0" role="button"
                                            aria-label="Next slide" aria-controls="swiper-wrapper-ca42f61f86bf90f6"><svg
                                                class="svg-inline--fa fa-chevron-right nav-icon" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chevron-right"
                                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z">
                                                </path>
                                            </svg><!-- <span class="fas fa-chevron-right nav-icon"></span> Font Awesome fontawesome.com -->
                                        </div>
                                        <div class="swiper-button-prev" tabindex="0" role="button"
                                            aria-label="Previous slide" aria-controls="swiper-wrapper-ca42f61f86bf90f6">
                                            <svg class="svg-inline--fa fa-chevron-left nav-icon" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chevron-left"
                                                role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                data-fa-i2svg="">
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

                                </div>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>

            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/pages/bbs/admin/details.js') }}"></script>

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

        

        // !(function() {
        //     "use strict";
        //     (() => {

        //         const e = document.querySelectorAll(".count-input");
        //         if (0 === e.length) return;
        //         const t = (e) => {
        //                 const t = e.currentTarget.parentNode.querySelector(".form-control"),
        //                     n = parseInt(t.getAttribute("max")) || 1 / 0;
        //                 t.value < n && (t.value++, i(t));
        //             },
        //             n = (e) => {
        //                 const t = e.currentTarget.parentNode.querySelector(".form-control"),
        //                     n = parseInt(t.getAttribute("min")) || 0;
        //                 t.value > n && (t.value--, i(t));
        //             },
        //             i = (e) => {
        //                 const t = e.parentNode.querySelector("[data-decrement]"),
        //                     n = e.parentNode.querySelector("[data-increment]"),
        //                     i = parseInt(e.getAttribute("min")) || 0,
        //                     s = parseInt(e.getAttribute("max")) || 1 / 0;
        //                 (t.disabled = e.value <= i), (n.disabled = e.value >= s);
        //                 const o = e.closest(".count-input");
        //                 if (!o.classList.contains("count-input-collapsible")) return;
        //                 const r = n.querySelector("[data-count-input-value]");
        //                 e.value > 0 ?
        //                     (o.classList.remove("collapsed"), r && (r.textContent = e.value)) :
        //                     (o.classList.add("collapsed"), r && (r.textContent = ""));
        //             };
        //         e.forEach((e) => {
        //             const s = e.querySelector("[data-increment]"),
        //                 o = e.querySelector("[data-decrement]"),
        //                 r = e.querySelector(".form-control");
        //             s.addEventListener("click", t), o.addEventListener("click", n), i(r);
        //         });
        //     })()
        // })();
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".count-input").forEach(counter => {
        const input = counter.querySelector("input[type=number]");
        const btnIncrement = counter.querySelector("[data-increment]");
        const btnDecrement = counter.querySelector("[data-decrement]");

        const updateButtons = () => {
            btnDecrement.disabled = parseInt(input.value) <= parseInt(input.min);
            btnIncrement.disabled = parseInt(input.value) >= parseInt(input.max);
        };

        btnIncrement.addEventListener("click", () => {
            let value = parseInt(input.value);
            if (value < parseInt(input.max)) {
                input.value = value + 1;
                updateButtons();
            }
        });

        btnDecrement.addEventListener("click", () => {
            let value = parseInt(input.value);
            if (value > parseInt(input.min)) {
                input.value = value - 1;
                updateButtons();
            }
        });

        updateButtons(); // initialize button states
    });
});
</script>

@endpush
