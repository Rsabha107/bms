@extends('bbs.customer.layout.customer_template')
@section('main')

<div class="container">
    <h3 class="fw-bold mb-4">Table of Contents</h3>

    <x-bbs.customer.menu :items="$menus" />
</div>

@endsection

@push('script')
    <script src="{{ asset('assets/js/pages/bbs/customer/booking.js') }}"></script>
@endpush
