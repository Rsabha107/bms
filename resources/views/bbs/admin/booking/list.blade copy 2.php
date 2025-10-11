@extends('bbs.template.customer.customer_template')
@section('main')
<!-- ============================================-->
<!-- <section icons> begin ============================-->
<div class="ecommerce-homepage pt-5 mb-9">
  <!-- <section services> begin ============================-->
  <section class="py-0 px-xl-3">
    <div class="container-small px-xl-0 px-xxl-3">
      <div class="row g-4 mb-6">
        <div class="col-12 col-lg-9 col-xxl-12">
          <div class="row g-3 mb-9">
            {{-- start loop here --}}
            @foreach ($services as $service)
            <div class="col-12 col-sm-6 col-md-4 col-xxl-2">
              <div class="position-relative text-decoration-none product-card h-100">
                <div class="d-flex flex-column justify-content h-100">
                  <div>
                    <div
                      class="border border-1 border-translucent rounded-3 position-relative mb-3">
                      {{-- wishlist enabled? --}}
                      @if ($service->is_wishlist_enabled == 1)
                      <button class="btn btn-wish btn-wish-primary z-2 d-toggle-container"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Add to wishlist"><span class="fas fa-heart d-block-hover"
                          data-fa-transform="down-1"></span><span
                          class="far fa-heart d-none-hover"
                          data-fa-transform="down-1"></span>
                      </button>
                      @endif

                      {{-- end of wishlist button --}}
                      <img class="img-fluid"
                        src="{{ asset('assets/img/bbs/' . $service->image) }}"
                        alt="" />
                    </div>
                    <a class="stretched-link" href="javascript:void(0)">
                      <h6 class="mb-2 lh-sm line-clamp-3 product-name">{{ $service->title }}
                      </h6>
                    </a>
                  </div>
                  <div>
                    <p class="fs-9 text-body-quaternary fw-bold mb-2">
                      {{ $service->short_description }}
                    </p>
                    <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">
                      {{ $service->available_slots }} available
                    </p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            {{-- end loop here --}}
          </div>
          <div class="col-12 d-lg-none"><a href="#!"><img class="w-100 rounded-3"
                src="../../../assets/img/e-commerce/6.png" alt="" /></a>
          </div>
        </div>
      </div>
    </div>
    <!-- end of .container-->
  </section>
</div>
<!-- <section> close ============================-->
<!-- ============================================-->
@endsection

@push('script')
@endpush