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


            <div class="gallery-container">
                <div class="swiper-container gallery-main">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="gallery-title"></div>
                            <img src="https://picsum.photos/seed/slide1/600/300" alt="">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 02</div>
                            <img src="https://picsum.photos/seed/slide2/600/300" alt="Slide 02">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 03</div>
                            <img src="https://picsum.photos/seed/slide3/600/300" alt="Slide 03">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 04</div>
                            <img src="https://picsum.photos/seed/slide4/600/300" alt="Slide 04">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 04</div>
                            <img src="https://picsum.photos/seed/slide5/600/300" alt="Slide 05">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 06</div>
                            <img src="https://picsum.photos/seed/slide6/600/300" alt="Slide 06">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 07</div>
                            <img src="https://picsum.photos/seed/slide7/600/300" alt="Slide 07">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 08</div>
                            <img src="https://picsum.photos/seed/slide8/600/300" alt="Slide 08">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 09</div>
                            <img src="https://picsum.photos/seed/slide9/600/300" alt="Slide 09">
                        </div>
                        <div class="swiper-slide">
                            <div class="gallery-title">Slide 10</div>
                            <img src="https://picsum.photos/seed/slide10/600/300" alt="Slide 10">
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-container gallery-thumbs me-7">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide mb-1">
                            <img class="rounded-3" src="https://picsum.photos/seed/slide1/115/100" alt="Slide 01">
                        </div>
                        <div class="swiper-slide mb-1">
                            <img src="https://picsum.photos/seed/slide2/115/100" alt="Slide 02">
                        </div>
                        <div class="swiper-slide mb-1">
                            <img src="https://picsum.photos/seed/slide3/115/100" alt="Slide 03">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide4/115/100" alt="Slide 04">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide5/115/100" alt="Slide 05">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide6/115/100" alt="Slide 06">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide7/115/100" alt="Slide 07">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide8/115/100" alt="Slide 08">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide9/115/100" alt="Slide 09">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://picsum.photos/seed/slide10/115/100" alt="Slide 10">
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
</script>
@endpush