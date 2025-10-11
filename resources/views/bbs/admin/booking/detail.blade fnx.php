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
      <div class="row g-5 mb-5 mb-lg-8" data-product-details="data-product-details">
        <div class="col-12 col-lg-6">
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-2 col-lg-12 col-xl-2">
              <div class="swiper-products-thumb swiper swiper theme-slider overflow-visible" id="swiper-products-thumb"></div>
            </div>
            <div class="col-12 col-md-10 col-lg-12 col-xl-10">
              <div class="d-flex align-items-center border border-translucent rounded-3 text-center p-5 h-100">
                <div class="swiper swiper theme-slider" data-thumb-target="swiper-products-thumb" data-products-swiper='{"slidesPerView":1,"spaceBetween":16,"thumbsEl":".swiper-products-thumb"}'></div>
              </div>
            </div>
          </div>
          {{-- <div class="d-flex">
            <button class="btn btn-lg btn-outline-warning rounded-pill w-100 me-3 px-2 px-sm-4 fs-9 fs-sm-8"><span class="me-2 far fa-heart"></span>Add to wishlist</button>
            <button class="btn btn-lg btn-warning rounded-pill w-100 fs-9 fs-sm-8"><span class="fas fa-shopping-cart me-2"></span>Add to cart</button>
          </div> --}}
        </div>
        <div class="col-12 col-lg-6">
          <div class="d-flex flex-column justify-content h-100">
            <div>
              {{-- <div class="d-flex flex-wrap">
                <div class="me-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span>
                </div>
                <p class="text-primary fw-semibold mb-2">6548 People rated and reviewed </p>
              </div> --}}
              <h3 class="mb-3 lh-sm">{{ $service->title }}</h3>
              {{-- <div class="d-flex flex-wrap align-items-start mb-3"><span class="badge text-bg-success fs-9 rounded-pill me-2 fw-semibold">#1 Best seller</span><a class="fw-semibold" href="#!">in Phoenix sell analytics 2021</a></div> --}}
              {{-- <div class="d-flex flex-wrap align-items-center">
                <h1 class="me-3">$1349.99</h1>
                <p class="text-body-quaternary text-decoration-line-through fs-6 mb-0 me-3">$1499.99</p>
                <p class="text-warning fw-bolder fs-6 mb-0">10% off</p>
              </div> --}}
              <p class="text-success fw-semibold fs-7 mb-2">{{ $service->available_slots }} available</p>
              <p class="fs-9 text-body-quaternary fw-bold mb-2">{{ $service->short_description }}</p>

              {{-- <p class="mb-2 text-body-secondary"><strong class="text-body-highlight">Do you want it on Saturday, July 29th?</strong> Choose <strong class="text-body-highlight">Saturday Delivery </strong>at checkout if you want your order delivered within 12 hours 43 minutes, <a class="fw-bold" href="#!">Details. </a><strong class="text-body-highlight">Gift wrapping is available.</strong></p>
              <p class="text-danger-dark fw-bold mb-5 mb-lg-0">Special offer ends in 23:00:45 hours</p> --}}
            </div>
            <div>
              @php
                $image = null;
              @endphp
              @foreach ($service->service_images as $service_image)
                @php
                  $image = $image.'"'.asset('assets/img/bbs/'.$service_image->image_name).'",';
                @endphp
                {{-- <div class="mb-3"><img class="rounded-3" src="{{ asset('assets/img/bbs/'.$service_image->image) }}" alt="" width="100%" /></div> --}}
              @endforeach
              @php
                $image = substr($image, 0, -1);
              @endphp
              {{-- @php
                $image = '"'.asset('assets/img/bbs/non_equipped_regular_commentart_position.png').'"'; 
              @endphp --}}
              {{ logger($image) }}
              <div class="mb-0">
                <!-- <p class="fw-semibold mb-2 text-body">Color : <span class="text-body-emphasis" data-product-color="data-product-color">Blue</span></p> -->
                <div class="d-flex product-color-variants" data-product-color-variants="data-product-color-variants">
                  <!-- <div class="active" data-variant="Blue" data-products-images='[{{ $image }}]'></div> -->
                  <div class="rounded-1 border border-translucent me-2 active" data-variant="Blue" data-products-images='["../../../assets/img/products/details/blue_front.png","../../../assets/img/products/details/blue_back.png","../../../assets/img/products/details/blue_side.png"]'><img src="../../../assets/img/products/details/blue_front.png" alt="" width="38" /></div>
                  <div class="rounded-1 border border-translucent me-2" data-variant="Red" data-products-images='["../../../assets/img/products/details/red_front.png","../../../assets/img/products/details/red_back.png","../../../assets/img/products/details/red_side.png"]'><img src="../../../assets/img/products/details/red_front.png" alt="" width="38" /></div>
                  <div class="rounded-1 border border-translucent me-2" data-variant="Green" data-products-images='["../../../assets/img/products/details/green_front.png","../../../assets/img/products/details/green_back.png","../../../assets/img/products/details/green_side.png"]'><img src="../../../assets/img/products/details/green_front.png" alt="" width="38" /></div>
                  <div class="rounded-1 border border-translucent me-2" data-variant="Purple" data-products-images='["../../../assets/img/products/details/purple_front.png","../../../assets/img/products/details/purple_back.png","../../../assets/img/products/details/purple_side.png"]'><img src="../../../assets/img/products/details/purple_front.png" alt="" width="38" /></div>
                  <div class="rounded-1 border border-translucent me-2" data-variant="Silver" data-products-images='["../../../assets/img/products/details/silver_front.png","../../../assets/img/products/details/silver_back.png","../../../assets/img/products/details/silver_side.png"]'><img src="../../../assets/img/products/details/silver_front.png" alt="" width="38" /></div>
                  <div class="rounded-1 border border-translucent me-2" data-variant="Yellow" data-products-images='["../../../assets/img/products/details/yellow_front.png","../../../assets/img/products/details/yellow_back.png","../../../assets/img/products/details/yellow_side.png"]'><img src="../../../assets/img/products/details/yellow_front.png" alt="" width="38" /></div>
                  <div class="rounded-1 border border-translucent me-2" data-variant="Orange" data-products-images='["../../../assets/img/products/details/orange_front.png","../../../assets/img/products/details/orange_back.png","../../../assets/img/products/details/orange_side.png"]'><img src="../../../assets/img/products/details/orange_front.png" alt="" width="38" /></div>
                </div>
              </div>
              <div class="row g-3 g-sm-5 mb-5 align-items-end">
                {{-- <div class="col-12 col-sm-auto">
                  <p class="fw-semibold mb-2 text-body">Size : </p>
                  <div class="d-flex align-items-center">
                    <select class="form-select w-auto">
                      <option value="44">44</option>
                      <option value="22">22</option>
                      <option value="18">18</option>
                    </select><a class="ms-2 fs-9 fw-semibold" href="#!">Size chart</a>
                  </div>
                </div> --}}
                <div class="col-12 col-sm">
                  <p class="fw-semibold mb-2 text-body">Quantity : </p>
                  <div class="d-flex justify-content-between align-items-end">
                    <div class="d-flex flex-between-center" data-quantity="data-quantity">
                      <button class="btn btn-phoenix-primary px-3" data-type="minus"><span class="fas fa-minus"></span></button>
                      <input class="form-control text-center input-spin-none bg-transparent border-0 outline-none" style="width:50px;" type="number" min="1" value="2" />
                      <button class="btn btn-phoenix-primary px-3" data-type="plus"><span class="fas fa-plus"></span></button>
                    </div>
                    {{-- <button class="btn btn-phoenix-primary px-3 border-0"><span class="fas fa-share-alt fs-7"></span></button> --}}
                  </div>
                </div>
                <div class="col-12 col-sm ">
                  <button class="btn btn-lg btn-warning  w-100 fs-9 fs-sm-8"><span class="fas fa-shopping-cart me-2"></span>Add to cart</button>

                </div>
              </div>

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
        <li class="nav-item"><a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a></li>
        <li class="nav-item"><a class="nav-link" id="specification-tab" data-bs-toggle="tab" href="#tab-specification" role="tab" aria-controls="tab-specification" aria-selected="false">Specification</a></li>
        {{-- <li class="nav-item"><a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Ratings &amp; reviews</a></li> --}}
      </ul>
      <div class="row gx-3 gy-7">
        <div class="col-12 col-lg-7 col-xl-8">
          <div class="tab-content" id="productTabContent">
            <div class="tab-pane pe-lg-6 pe-xl-12 fade show active text-body-emphasis" id="tab-description" role="tabpanel" aria-labelledby="description-tab">
              <p class="mb-5">{{ $service->long_description }}</p>
              </div>
            <div class="tab-pane pe-lg-6 pe-xl-12 fade" id="tab-specification" role="tabpanel" aria-labelledby="specification-tab">
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
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Chip name</h6>
                    </td>
                    <td class="px-5 mb-0">Apple M1 chip</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Cpu core</h6>
                    </td>
                    <td class="px-5 mb-0">8 (4 performance and 4 efficiency)</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Gpu core</h6>
                    </td>
                    <td class="px-5 mb-0">7</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Neural engine</h6>
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
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Memory</h6>
                    </td>
                    <td class="px-5 mb-0">8 GB unified</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">SSD</h6>
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
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Display type</h6>
                    </td>
                    <td class="px-5 mb-0">Retina</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Size</h6>
                    </td>
                    <td class="px-5 mb-0">24” (actual diagonal 23.5”)</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Resolution</h6>
                    </td>
                    <td class="px-5 mb-0">4480 x 2520 </td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Brightness</h6>
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
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Camera</h6>
                    </td>
                    <td class="px-5 mb-0">1080p FaceTime HD camera</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight">
                      <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Video </h6>
                    </td>
                    <td class="px-5 mb-0">Full native resolution on built-in display at 1 billion colors; <br>One external display with up to 6K resolution at 60Hz</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight">
                      <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Audio</h6>
                    </td>
                    <td class="px-5 mb-0">High-fidelity six-speaker with force-cancelling woofers <br>Wide stereo sound <br>Spatial audio with Dolby Atmos3<br>Studio-quality three-mic array with directional beamforming</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight">
                      <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Inputs </h6>
                    </td>
                    <td class="px-5 mb-0">Magic Keyboard<br>Magic Mouse</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight">
                      <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Wireless </h6>
                    </td>
                    <td class="px-5 mb-0">802.11ax Wi-Fi 6 (IEEE 802.11a/b/g/n/ac compatible)<br>Bluetooth 5.0 wireless technology</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight">
                      <h6 class="mb-0 mt-1 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">I/O &amp; expantions </h6>
                    </td>
                    <td class="px-5 mb-0">Thunderbolt / USB 4 ports x 2<br>3.5 mm headphone jack<br>Gigabit Ethernet<br>USB 3 ports x2</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Operating System</h6>
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
            {{-- <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="bg-body-emphasis rounded-3 p-4 border border-translucent">
                <div class="row g-3 justify-content-between mb-4">
                  <div class="col-auto">
                    <div class="d-flex align-items-center flex-wrap">
                      <h2 class="fw-bolder me-3">4.9<span class="fs-8 text-body-quaternary fw-bold">/5</span></h2>
                      <div class="me-3"><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star-half-alt star-icon text-warning fs-6"></span>
                      </div>
                      <p class="text-body mb-0 fw-semibold fs-7">6548 ratings and 567 reviews</p>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#reviewModal">Rate this product</button>
                    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-4">
                          <div class="d-flex flex-between-center mb-2">
                            <h5 class="modal-title fs-8 mb-0">Your rating</h5>
                            <button class="btn p-0 fs-10">Clear</button>
                          </div>
                          <div class="mb-3" data-rater='{"starSize":32,"step":0.5}'></div>
                          <div class="mb-3">
                            <h5 class="text-body-highlight mb-3">Your review</h5>
                            <textarea class="form-control" id="reviewTextarea" rows="5" placeholder="Write your review"> </textarea>
                          </div>
                          <div class="dropzone dropzone-multiple p-0 mb-3" id="my-awesome-dropzone" data-dropzone>
                            <div class="fallback">
                              <input name="file" type="file" multiple>
                            </div>
                            <div class="dz-preview d-flex flex-wrap">
                              <div class="border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:80px;width:80px;"><img class="dz-image" src="../../../assets/img/products/23.png" alt="..." data-dz-thumbnail><a class="dz-remove text-body-quaternary" href="#!" data-dz-remove><span data-feather="x"></span></a></div>
                            </div>
                            <div class="dz-message text-body-tertiary text-opacity-85 fw-bold fs-9 p-4" data-dz-message>
                              Drag your photo here <span class="text-body-secondary">or </span>
                              <button class="btn btn-link p-0">Browse from device </button><br><img class="mt-3 me-2" src="../../../assets/img/icons/image-icon.png" width="24" alt="">
                            </div>
                          </div>
                          <div class="d-sm-flex flex-between-center">
                            <div class="form-check flex-1">
                              <input class="form-check-input" id="reviewAnonymously" type="checkbox" value="" checked="">
                              <label class="form-check-label mb-0 text-body-emphasis fw-semibold" for="reviewAnonymously">Review anonymously</label>
                            </div>
                            <button class="btn ps-0" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary rounded-pill">Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="text-body-secondary ms-1"> by</span> Zingko Kudobum
                    </h5>
                    <div class="btn-reveal-trigger position-static">
                      <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">35 mins ago</p>
                  <p class="text-body-highlight mb-3">100% satisfied</p>
                  <div class="row g-2 mb-2">
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-11.jpg" data-gallery="gallery-0"><img src="../../../assets/img/e-commerce/review-11.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-12.jpg" data-gallery="gallery-0"><img src="../../../assets/img/e-commerce/review-12.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-13.jpg" data-gallery="gallery-0"><img src="../../../assets/img/e-commerce/review-13.jpg" alt="" height="164" /></a></div>
                  </div>
                  <div class="d-flex"><span class="fas fa-reply fa-rotate-180 me-2"></span>
                    <div>
                      <h5>Respond from store<span class="text-body-tertiary fs-9 ms-2">5 mins ago</span></h5>
                      <p class="text-body-highlight mb-0">Thank you for your valuable feedback</p>
                    </div>
                  </div>
                  <div class="hover-actions top-0">
                    <button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button>
                    <button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button>
                  </div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span><span class="text-body-secondary ms-1"> by</span> Piere Auguste Renoir
                    </h5>
                    <div class="btn-reveal-trigger position-static">
                      <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">23 Oct, 12:09 PM</p>
                  <p class="text-body-highlight mb-1">Since the spring loaded event, I've been wanting an iMac, and it's exceeded my expectations. The screen is clear, the colors are vibrant (I got the blue one! ), and the performance is more than adequate for my needs as a college student. That's how good it is.</p>
                  <div class="hover-actions top-0">
                    <button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button>
                    <button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button>
                  </div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span><span class="fa-regular fa-star text-warning-light" data-bs-theme="light"></span><span class="text-body-secondary ms-1"> by</span> Abel Kablmann
                    </h5>
                    <div class="btn-reveal-trigger position-static">
                      <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">21 Oct, 12:00 PM</p>
                  <p class="text-body-highlight mb-1">Over the years, I've preferred Apple products. My job has allowed me to use Windows products on laptops and PCs. I've owned Windows laptops and desktops for home use in the past and will never use them again.</p>
                  <div class="hover-actions top-0">
                    <button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button>
                    <button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button>
                  </div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="text-body-secondary ms-1"> by</span> Pennywise Alfred
                    </h5>
                    <div class="btn-reveal-trigger position-static">
                      <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">35 mins ago</p>
                  <p class="text-body-highlight mb-3">Nice and beautiful product.</p>
                  <div class="row g-2 mb-2">
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-14.jpg" data-gallery="gallery-3"><img src="../../../assets/img/e-commerce/review-14.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-15.jpg" data-gallery="gallery-3"><img src="../../../assets/img/e-commerce/review-15.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-16.jpg" data-gallery="gallery-3"><img src="../../../assets/img/e-commerce/review-16.jpg" alt="" height="164" /></a></div>
                  </div>
                  <div class="hover-actions top-0">
                    <button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button>
                    <button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button>
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                  <nav>
                    <ul class="pagination mb-0">
                      <li class="page-item"><a class="page-link" href="#!"><span class="fas fa-chevron-left"> </span></a></li>
                      <li class="page-item"><a class="page-link" href="#!">1</a></li>
                      <li class="page-item"><a class="page-link" href="#!">2</a></li>
                      <li class="page-item"><a class="page-link" href="#!">3</a></li>
                      <li class="page-item active"><a class="page-link" href="#!">4</a></li>
                      <li class="page-item"><a class="page-link" href="#!">5</a></li>
                      <li class="page-item"><a class="page-link" href="#!"><span class="fas fa-chevron-right"></span></a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        {{-- <div class="col-12 col-lg-5 col-xl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="text-body-emphasis">Usually Bought Together</h5>
              <div class="w-75">
                <p class="text-body-tertiary fs-9 fw-bold line-clamp-1">with 24" iMac® with Retina 4.5K display - Apple M1 8GB Memory - 256GB SSD - w/Touch ID (Latest Model) - Blue</p>
              </div>
              <div class="border-dashed border-y border-translucent py-4">
                <div class="d-flex align-items-center mb-5">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" checked="checked" />
                    <label class="form-check-label"></label>
                  </div><a href="../../../apps/e-commerce/landing/product-details.html"> <img class="border border-translucent rounded" src="../../../assets/img/products/2.png" width="53" alt="" /></a>
                  <div class="ms-2"><a class="fs-9 fw-bold line-clamp-2 mb-2" href="../../../apps/e-commerce/landing/product-details.html"> iPhone 13 pro max-Pacific Blue- 128GB</a>
                    <h5>$899.99</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center mb-5">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" checked="checked" />
                    <label class="form-check-label"></label>
                  </div><a href="../../../apps/e-commerce/landing/product-details.html"> <img class="border border-translucent rounded" src="../../../assets/img/products/16.png" width="53" alt="" /></a>
                  <div class="ms-2"><a class="fs-9 fw-bold line-clamp-2 mb-2" href="../../../apps/e-commerce/landing/product-details.html">Apple AirPods Pro</a>
                    <h5>$59.00</h5>
                  </div>
                </div>
                <div class="d-flex align-items-center mb-0">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" />
                    <label class="form-check-label"></label>
                  </div><a href="../../../apps/e-commerce/landing/product-details.html"> <img class="border border-translucent rounded" src="../../../assets/img/products/10.png" width="53" alt="" /></a>
                  <div class="ms-2"><a class="fs-9 fw-bold line-clamp-2 mb-2" href="../../../apps/e-commerce/landing/product-details.html">Apple Magic Mouse (Wireless, Rechargable) - Silver, Worst mouse ever</a>
                    <h5>$89.00</h5>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-end justify-content-between pt-3">
                <div>
                  <h5 class="mb-2 text-body-tertiary text-opacity-85">Total</h5>
                  <h4 class="mb-0 text-body-emphasis">$958.99</h4>
                </div>
                <div class="btn btn-outline-warning">Add 3 items to cart<span class="fas fa-shopping-cart ms-2"></span></div>
              </div>
            </div>
          </div>
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
@endpush