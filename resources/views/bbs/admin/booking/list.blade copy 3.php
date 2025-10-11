@extends('mds.admin.layout.admin_template')
@section('main')
<section class="py-5">
    <div class="container">

        {{-- Header --}}
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold">Available Services</h2>
                <p class="text-muted">Explore and book services easily.</p>
            </div>
        </div>

        {{-- Services Grid --}}
        <div class="row g-4">
            @foreach($services as $service)
                @php
                    $isAvailable = $service->available_slots > 0;
                    $badgeClass = $isAvailable ? 'bg-success' : 'bg-danger';
                    $statusText = $isAvailable 
                        ? 'Available (' . $service->available_slots . ' slots left)' 
                        : 'Sold Out';
                    $serviceUrl = $isAvailable ? route('bbs.admin.booking.detail', $service->id) : '#';
                @endphp

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden">
                        {{-- Service Image --}}
                        <div class="position-relative">
                            <a href="{{ $serviceUrl }}">
                                <img 
                                src="{{ $service->image 
                                    ? asset('storage/upload/service/images/' . $service->image) 
                                    : asset('assets/img/placeholder.png') }}" 
                                class="card-img-top" 
                                alt="{{ $service->title }}"
                                style="height: 200px; object-fit: cover;">
                            </a>
                            {{-- Availability Badge --}}
                            <span class="badge {{ $badgeClass }} position-absolute top-0 start-0 m-2 px-3 py-2 fs-8">
                                {{ $statusText }}
                            </span>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold mb-2 line-clamp-2">{{ $service->title }}</h5>
                            <p class="text-muted mb-3 line-clamp-3">{{ $service->short_description }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">QR {{ $service->unit_price }}</span>
                                @if($isAvailable)
                                    <a href="{{ $serviceUrl }}" class="btn btn-sm btn-primary">Book Now</a>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>Unavailable</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endsection
