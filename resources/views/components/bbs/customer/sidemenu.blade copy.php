<nav class="navbar navbar-vertical navbar-expand-lg" data-navbar-appearance="darker">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <hr class="navbar-vertical-line" />
                    <div class="nav-item-wrapper mt-4"><a class="nav-link {{ Request::is('bbs/customer/booking') ? 'active' : '' }}" href="{{route('bbs.customer.booking')}}">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">List of Bookings</span></span>
                            </div>
                        </a>
                    </div>
                    <!-- label-->
                    <p class="navbar-vertical-label text-warning">Venue Services and Facilities
                    </p>
                    <hr class="navbar-vertical-line" />
                    <!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator  label-1" href="#nv-venue-services" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-venue-services">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper"><span class="fas fa-caret-right dropdown-indicator-icon"></span></div><span class="nav-link-icon"><span data-feather="dribbble"></span></span><span class="nav-link-text text-wrap">World-Feed Bookable Services</span>
                            </div>
                        </a>

                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent {{ Request::is('bbs/customer/booking')||Request::is('bbs/customer/booking/create')||Request::is('bbs/manager/booking') ? 'show' : '' }}" data-bs-parent="#navbarVerticalCollapse" id="nv-venue-services">
                                <li class="collapsed-nav-item-title d-none">World-Feed Bookable Services
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('bbs/customer/booking') ? 'active' : '' }}" href="{{route('bbs.customer.booking')}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text text-wrap">Commentary Positions</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('bbs/customer/bookingx') ? 'active' : '' }}" href="{{route('bbs.customer.booking')}}">
                                        <div class="d-flex align-items-center"><span class="nav-link-text text-wrap">Stand Ups & Flash Interviews</span>
                                        </div>
                                    </a>
                                    <!-- more inner pages-->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link label-1 {{ Request::is('bbs/setting/driver') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Unilateral Bookable Services/Spaces</span></span>
                            </div>
                        </a>
                    </div>
                    <!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link label-1 {{ Request::is('bbs/setting/driver') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Broadcast Compound Services</span></span>
                            </div>
                        </a>
                    </div>
                    <!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link label-1 {{ Request::is('bbs/setting/driver') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Broadcast Compound Signals</span></span>
                            </div>
                        </a>
                    </div>
                    <!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link label-1 {{ Request::is('bbs/setting/driver') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Other Services</span></span>
                            </div>
                        </a>
                    </div>
                    <!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link label-1 {{ Request::is('bbs/setting/driver') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Main Media Center</span></span>
                            </div>
                        </a>
                    </div>

                </li>

            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button>
    </div>
</nav>