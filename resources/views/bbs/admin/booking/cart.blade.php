@extends('mds.admin.layout.admin_template')
@section('main')

<section class="pt-5 pb-9">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav class="mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb bg-light rounded-3 p-2">
                <li class="breadcrumb-item"><a href="#!">Home</a></li>
                <li class="breadcrumb-item"><a href="#!">List of Bookings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Booked Services</h2>
            <a href="{{ route('bbs.admin.booking.list') }}" class="btn btn-primary">Book Another</a>
        </div>

        {{-- Cart Table --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px;"></th>
                                <th>Service</th>
                                <th style="width:120px;">Quantity</th>
                                <th style="width:120px;">Unit Price</th>
                                <th style="width:120px;">Total Price</th>
                                <th style="width:60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                {{-- Service Image --}}
                                <td>
                                    <img src="{{ $booking->service->image ? asset('storage/upload/service/images/' . $booking->service->image) : asset('assets/img/placeholder.png') }}" 
                                        alt="{{ $booking->service->title }}" 
                                        class="rounded" 
                                        style="width:50px; height:50px; object-fit:cover;">
                                </td>

                                {{-- Service Title --}}
                                <td class="fw-semibold">{{ $booking->service->title }}</td>
                                
                                {{-- Quantity --}}
                                <td>{{ $booking->quantity }}</td>

                                {{-- Unit Price --}}
                                <td>QR {{ number_format($booking->unit_price, 2) }}</td>

                                {{-- Total Price --}}
                                <td>QR {{ number_format($booking->total_price, 2) }}</td>

                                {{-- Delete Button --}}
                                <td>
                                    <form action="{{ route('bbs.admin.booking.delete', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger show_confirm">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No bookings available.</td>
                            </tr>
                            @endforelse

                            {{-- Total Row --}}
                            @if($bookings->count())
                            <tr class="fw-bold bg-light">
                                <td colspan="4" class="text-end">Total</td>
                                <td>QR {{ number_format($bookings->sum('total_price'), 2) }}</td>
                                <td></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection