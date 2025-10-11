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
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-2 col-lg-12 col-xl-2">
                        {{-- // thumb image --}}
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-10 col-lg-12 col-xl-8">
                        <div class="d-flex border border-translucent rounded-3 text-center">
                            {{-- // main image --}}
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="swiper mySwiper2">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
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
                <div class="row gx-3 gy-7">
                    <div class="col-12 col-lg-7 col-xl-8">
                        <div class="tab-content" id="productTabContent">
                            <div class="tab-pane pe-lg-6 pe-xl-12 fade show active text-body-emphasis" id="tab-description"
                                role="tabpanel" aria-labelledby="description-tab">
                                <p class="mb-5">{{ $service->long_description }}</p>
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
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 6,
            loopedSlides: 50,
            // freeMode: true,
            slideToClickedSlide: true,
            // watchSlidesProgress: true,
            direction: 'vertical',
        });
        var swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endpush
