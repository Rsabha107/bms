@props(['items', 'prefix' => ''])

<nav class="navbar navbar-vertical navbar-expand-lg" data-navbar-appearance="darker">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- label-->
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper mt-5"><a
                            class="nav-link {{ Request::is('bbs/customer/booking') ? 'active' : '' }}"
                            href="{{ route('bbs.customer.booking') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="server"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">My Services</span></span>
                            </div>
                        </a>
                    </div>
                    <p class="navbar-vertical-label text-warning">Venue Services and Facilities
                    </p>
                    <hr class="navbar-vertical-line" />
                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link {{ Request::is('bbs/customer/booking/service/list') ? 'active' : '' }}"
                            href="{{ route('bbs.customer.booking.service.list') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="server"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">All Services</span></span>
                            </div>
                        </a>
                    </div>
                    {{-- // start the loop into menu items --}}
                    @foreach ($items as $item)
                        {{-- Check if the item has children --}}
                        @if ($item->children->isNotEmpty())
                            <!-- multi item-->
                            <div class="nav-item-wrapper">
                                <a class="nav-link dropdown-indicator label-1" href="#nv-forms" role="button"
                                    data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-forms">
                                    <div class="d-flex align-items-center">
                                        <div class="dropdown-indicator-icon-wrapper"><span
                                                class="fas fa-caret-right dropdown-indicator-icon"></span></div><span
                                            class="nav-link-icon"><span data-feather="file-text"></span></span><span
                                            class="nav-link-text">{{ $item->title }}</span>
                                    </div>
                                </a>
                                <div class="parent-wrapper label-1">
                                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse"
                                        id="nv-forms">
                                        <li class="collapsed-nav-item-title d-none">{{ $item->title }}
                                        </li>
                                        @foreach ($item->children as $child)
                                            @if ($child->children->isEmpty())
                                                <!-- single item-->
                                                <li class="nav-item">
                                                    <a class="nav-link {{ session()->get($child->link) == 'active' ? 'active' : '' }}"
                                                        href="{{ route('bbs.customer.booking.menu.show.services', $child->id) }}">
                                                        <div class="d-flex align-items-center"><span
                                                                class="nav-link-text">{{ $child->title }}</span>
                                                        </div>
                                                    </a>
                                                    <!-- more inner pages-->
                                                </li>
                                            @else
                                                <!-- multi item-->
                                                <li class="nav-item">
                                                    <a class="nav-link dropdown-indicator"
                                                        href="#nv-basic" data-bs-toggle="collapse" aria-expanded="false"
                                                        aria-controls="nv-basic">
                                                        <div class="d-flex align-items-center">
                                                            <div class="dropdown-indicator-icon-wrapper"><span
                                                                    class="fas fa-caret-right dropdown-indicator-icon"></span>
                                                            </div>
                                                            <span class="nav-link-text">{{ $child->title }}</span>
                                                        </div>
                                                    </a>
                                                    <!-- more inner pages-->
                                                    <div class="parent-wrapper">
                                                        <ul class="nav collapse parent" data-bs-parent="#forms"
                                                            id="nv-basic">
                                                            @foreach ($child->children as $subchild)
                                                            <li class="nav-item"><a class="nav-link"
                                                                    href="{{ route('bbs.customer.booking.menu.show.services', $subchild->id) }}">
                                                                    <div class="d-flex align-items-center"><span
                                                                            class="nav-link-text">{{ $subchild->title }}</span>
                                                                    </div>
                                                                </a>
                                                                <!-- more inner pages-->
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            <!-- single item-->
                            <div class="nav-item-wrapper">
                                <a class="nav-link  {{ session()->get($item->link) == 'active' ? 'active' : '' }}"
                                    href="{{ route('bbs.customer.booking.menu.show.services', $item->id) }}"
                                    role="button" data-bs-toggle="" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                data-feather="server"></span></span><span
                                            class="nav-link-text-wrapper"><span
                                                class="nav-link-text">{{ $item->title }}</span></span>
                                    </div>
                                </a>
                            </div>
                            <!-- parent pages-->
                        @endif
                    @endforeach
                    {{-- // end the loop into menu items --}}
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span
                class="uil uil-left-arrow-to-left fs-8"></span><span
                class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed
                View</span></button>
    </div>
</nav>
