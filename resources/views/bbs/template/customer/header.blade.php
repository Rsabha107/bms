@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);

// Determine user events based on role
if($profileData->hasRole('Customer')) {
    $user_events = $profileData->events()->where('active_flag', 1)->orderBy('name')->get();
} else {
    $user_events = App\Models\Event::where('active_flag', 1)->orderBy('name')->get();
}

// Get current event
$event_id = session()->get('EVENT_ID');
$current_event = $event_id ? App\Models\Event::find($event_id) : null;
@endphp

@php
$current_event_id = session()->get('EVENT_ID');
$event = App\Models\Mds\MdsEvent::find($current_event_id);
$current_venue_id = session()->get('VENUE_ID');
$venue = App\Models\Mds\Venue::find($current_venue_id);
$user_venues = auth()->user()->venues->where('active_flag', 1)->sortBy('name');
@endphp


<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-2">
    <div class="container-fluid">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('bbs.customer.booking.list') }}">
            <img src="{{ asset(config('settings.website_logo')) }}" alt="{{ config('settings.website_name') }}" width="150">
            <span class="fw-bold text-secondary fs-5">{{ config('settings.website_name') }}</span><br>
            @if($current_event)
                <span class="ms-2 fw-semibold" style="font-size: 0.95rem; color:#3874ff">
                    ({{ $current_event->name }})
                </span>
            @endif
        </a>

        {{-- Venue breadcrumb --}}
        <ol class="breadcrumb breadcrumb-style1 mb-0 align-items-center">
            <li class="breadcrumb-item active d-flex align-items-center">
                {{ optional($venue)->title }}
            </li>

            <li class="nav-item dropdown ms-2 me-2">
                <a href="#" style="min-width: 2.25rem" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                    <span class="d-block" style="height:20px;width:20px;">
                        <i class="fa-solid fa-repeat"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret"
                    id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                    <div class="card position-relative border-0">
                        <div class="card-header p-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-body-emphasis mb-0">Venues</h5>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar-overlay" style="height: 27rem;">
                                @foreach ($user_venues as $venue)
                                    @php
                                        $isActive = session()->get('VENUE_ID') == $venue->id;
                                    @endphp
                                    <a href="{{ route('bbs.customer.venue.switch', $venue->id) }}"
                                        class="text-decoration-none text-body-emphasis">
                                        <div
                                            class="px-2 px-sm-3 py-3 notification-card position-relative {{ $isActive ? 'read' : 'unread' }} border-bottom">
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-m {{ $isActive ? 'status-online' : '' }} me-3">
                                                        <img class="rounded-circle"
                                                            src="/storage/event/logo/{{ $venue->event_logo ?? 'default.png' }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="flex-1 me-sm-3">
                                                        <h4 class="fs-9 text-body-emphasis mb-0">{{ $venue?->title }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ol>

        {{-- Toggle button for mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar content --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarHeader">
            <ul class="navbar-nav align-items-center">

                {{-- Username --}}
                <li class="nav-item d-flex align-items-center px-2">
                    <h6 class="mb-0">{{ $profileData->name }}</h6>
                </li>

                {{-- Event switch dropdown --}}
                <li class="nav-item dropdown me-3">
                    <a class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span data-feather="calendar" class="me-2"></span>
                        <span class="d-none d-lg-inline">Events</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        @forelse($user_events as $event)
                            <li>
                                <a href="{{ route('bbs.customer.orders.switch', $event->id) }}"
                                    class="dropdown-item d-flex align-items-center justify-content-between @if(session()->get('EVENT_ID') == $event->id) active @endif">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ route('bbs.setting.event.file', $event->event_logo ?? 'default.png') }}" class="rounded-circle me-2" width="30" height="30" alt="{{ $event->name }}">
                                        <span>{{ $event->name }}</span>
                                    </div>
                                    @if(session()->get('EVENT_ID') == $event->id)
                                        <span class="badge bg-success">Current</span>
                                    @endif
                                </a>
                            </li>
                        @empty
                            <li class="dropdown-item text-muted">No events available</li>
                        @endforelse
                    </ul>
                </li>

                {{-- Profile dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ !empty($profileData->photo) ? url('storage/upload/profile_images/' . $profileData->photo) : url('upload/default.png') }}" class="rounded-circle" width="40" height="40">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><a class="dropdown-item" href="/bbs/customer/booking/list"><span data-feather="list" class="me-2"></span>List</a></li>
                        <li><a class="dropdown-item" href="/bbs/customer/booking/cart"><span data-feather="shopping-cart" class="me-2"></span>Cart</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><span data-feather="log-out" class="me-2"></span>Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
