@extends('main.layout.dashboard')
@section('main')


<div class="content">
    <div class="position-fixed w-100 z-index-5 mx-n4 mx-lg-n6 bg-white border-bottom border-300" style="top: 65px">
        <nav class="simplebar-scrollspy navbar py-0 scrollbar-overlay" id="widgets-scrollspy">
            <ul class="nav">
                <li class="nav-item"> <a class="test nav-link text-700 fw-bold py-3 lh-1 text-nowrap"
                        href="#scrollspyOrderform">Order Details</a></li>
                <li class="nav-item"> <a class="test nav-link text-700 fw-bold py-3 lh-1 text-nowrap"
                        href="#scrollspyOrderItems">Order Items</a></li>

            </ul>
        </nav>
    </div>
    <div class="mb-9" data-bs-spy="scroll" data-bs-target="#widgets-scrollspy">

    <!-- @include('main.partials.flash-message') -->
        <div class="d-flex mb-5 pt-7" id="scrollspyOrderform"><span class="fa-stack me-2 ms-n1"><i
                    class="fas fa-circle fa-stack-2x text-primary"></i><i
                    class="fa-inverse fa-stack-1x text-primary-soft fas fa-user-friends"
                    data-fa-transform="shrink-4"></i></span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">Order
                        Details</span><span
                        class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                </h3>
                <p class="mb-0">User engagement and personalized content presentation.</p>
            </div>
        </div>
        <!-- <form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm"> -->
        <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{ route('main.order.store') }}" id="createOrderForm">
            @csrf
            <div class="card mb-5">
                <!-- <div class="card-header"> -->
                <!-- <h5 class="fs-1 mb-0">Orders Details</h2> -->
                <!-- </div> -->
                <!-- <div class="card-body">
                        <h1 class="lh-sm fs-2 fs-xxl-4 mb-2">Brandmyth presents- Shironamhin 25 years celebration with
                            symphony orchestra</h1> -->
                <div class="card-body">
                    <!-- <h5 class="fs-1 mb-5">Orders Details</h2> -->

                    <div class="row justify-content-xl-between">
                        <div class="col-auto">
                            <div class="col-xxl-12">
                                <div class="row gx-3 gy-4">
                                    <!-- <h4 class="fs-1 mb-0">Event Details</h4> -->
                                    <!-- <div class="col-sm-6 col-md-12">
                                        <div class="form-floating">
                                            <input name="venue_name" class="form-control" id="floatingVenueNameInput" type="text"
                                                placeholder="Event title" required="">
                                            <label for="floatingEventInput">Venue Name</label>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please provide a value.</div>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-floating">
                                            <select name="site_type" class="form-select" id="floatingSiteType" required>
                                                <option selected="selected" value="">Select site type</option>
                                                @foreach ($venue_type as $venue_types)
                                                @if (Request::old('site_type') == $venue_types->id )
                                                <option value="{{ $venue_types->id  }}" selected>
                                                    {{ $venue_types->name }}
                                                </option>
                                                @else
                                                <option value="{{ $venue_types->id  }}">
                                                    {{ $venue_types->name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <label for="floatingSelectTask">Site type</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-floating">
                                            <select name="site_category" class="form-select getSiteCategory"
                                                id="floatingSiteCategory" required>
                                            </select>
                                            <label for="floatingSelectTask">Site category</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-floating">
                                            <select name="site_code" class="form-select getSiteCode"
                                                id="floatingSiteCode" required>
                                            </select>
                                            <label for="floatingSelectTask">Site code</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="form-floating">
                                            <select name="site_name" class="form-select getSiteName"
                                                id="floatingSiteName">
                                                <option value="" selected="selected">Select site name</option>
                                            </select>
                                            <label for="floatingSelectPrivacy">Site name</label>
                                        </div>
                                    </div>
                                    <!-- 2 cards -->
                                    <div class="col-12 col-xl-12">
                                        <div class="row g-2">
                                            <!-- <div class="row g-5"> -->
                                            <div class="col-12 col-xl-6">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-wrap mb-2">
                                                            <h4 class="card-title mb-4 pe-2">Logical Space Details</h4>
                                                            <div class="form-check form-switch ">

                                                                <input class="form-check-input"
                                                                    id="flexSwitchCheckDefault" type="checkbox" />

                                                                <label class="form-check-label"
                                                                    for="flexSwitchCheckDefault">Buildbase
                                                                    structure</label>
                                                            </div>
                                                        </div>
                                                        <div class="row gx-3">
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="mb-4">
                                                                    <div class="d-flex flex-wrap mb-2">
                                                                        <h5 class="mb-0 text-1000 me-2">Category</h5><a
                                                                            class="fw-bold fs--1" href="#!">Add new
                                                                            category</a>
                                                                    </div>
                                                                    <select
                                                                        class="form-select mb-3 getLogicalSpaceCategory"
                                                                        id="floatingLogicalSpaceCategory"
                                                                        name="logical_space_category"
                                                                        aria-label="logical_space_category">
                                                                        <option value="" selected>Select category
                                                                        </option>
                                                                        @foreach ($logical_space_categories as $logical_space_category)
                                                                        @if (Request::old('logical_space_category') === $logical_space_category->categories_id )
                                                                        <option
                                                                            value="{{ $logical_space_category->categories_id  }}"
                                                                            selected>
                                                                            {{ $logical_space_category->categories_name }}
                                                                        </option>
                                                                        @else
                                                                        <option
                                                                            value="{{ $logical_space_category->categories_id  }}">
                                                                            {{ $logical_space_category->categories_name }}
                                                                        </option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="mb-4">
                                                                    <div class="d-flex flex-wrap mb-2">
                                                                        <h5 class="mb-0 text-1000 me-2">Subcategory</h5>
                                                                        <a class="fw-bold fs--1" href="#!">Add new
                                                                            vendor</a>
                                                                    </div>
                                                                    <select
                                                                        class="form-select mb-3 getLogicalSpaceSubcategory"
                                                                        id="floatingLogicalspaceSubcategory"
                                                                        name="logical_space_subcategory"
                                                                        aria-label="logical_space_subcategory">
                                                                        <option value="" selected="selected">Select
                                                                            value</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="mb-4">
                                                                    <div class="d-flex flex-wrap mb-2">
                                                                        <h5 class="mb-0 text-1000 me-2">Space name</h5>
                                                                        <a class="fw-bold fs--1" href="#!">Add new
                                                                            Space name</a>
                                                                    </div>
                                                                    <select class="form-select mb-3 getLogicalSpaceName"
                                                                        id="floatingLogicalspaceName"
                                                                        name="logical_space_name"
                                                                        aria-label="logical_space_name">
                                                                        <option value="" selected="selected">Select
                                                                            value</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="d-flex flex-wrap mb-2">
                                                                    <h5 class="mb-0 text-1000 me-2">Space code</h5><a
                                                                        class="fw-bold fs--1 lh-sm" href="#!">View all
                                                                        tags</a>
                                                                </div>
                                                                <select class="form-select mb-3 getLogicalSpaceCode"
                                                                    id="floatingLogicalspaceCode"
                                                                    name="logical_space_code"
                                                                    aria-label="logical_space_code">
                                                                    <option value="" selected="selected">Select value
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-6">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-4">Other Info</h4>
                                                        <div class="row gx-3">
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="mb-4">
                                                                    <div class="d-flex flex-wrap mb-2">
                                                                        <h5 class="mb-0 text-1000 me-2">Category</h5><a
                                                                            class="fw-bold fs--1" href="#!">Add new
                                                                            category</a>
                                                                    </div>
                                                                    <select class="form-select mb-3"
                                                                        aria-label="category">
                                                                        <option value="men-cloth">Men's Clothing
                                                                        </option>
                                                                        <option value="women-cloth">Womens's Clothing
                                                                        </option>
                                                                        <option value="kid-cloth">Kid's Clothing
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="mb-4">
                                                                    <div class="d-flex flex-wrap mb-2">
                                                                        <h5 class="mb-0 text-1000 me-2">Vendor</h5><a
                                                                            class="fw-bold fs--1" href="#!">Add new
                                                                            vendor</a>
                                                                    </div>
                                                                    <select class="form-select mb-3"
                                                                        aria-label="category">
                                                                        <option value="men-cloth">Men's Clothing
                                                                        </option>
                                                                        <option value="women-cloth">Womens's Clothing
                                                                        </option>
                                                                        <option value="kid-cloth">Kid's Clothing
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="mb-4">
                                                                    <h5 class="mb-2 text-1000">Collection</h5>
                                                                    <input class="form-control mb-xl-3" type="text"
                                                                        placeholder="Collection" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-6 col-xl-12">
                                                                <div class="d-flex flex-wrap mb-2">
                                                                    <h5 class="mb-0 text-1000 me-2">Tags</h5><a
                                                                        class="fw-bold fs--1 lh-sm" href="#!">View all
                                                                        tags</a>
                                                                </div>
                                                                <select class="form-select" aria-label="category">
                                                                    <option value="men-cloth">Men's Clothing</option>
                                                                    <option value="women-cloth">Womens's Clothing
                                                                    </option>
                                                                    <option value="kid-cloth">Kid's Clothing</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of 2 cards -->

                                    <!-- <h4 class="text-900 mb-0" data-anchor="data-anchor" id="validation-example">
                                        Logical Space<a class="anchorjs-link " aria-label="Anchor"
                                            data-anchorjs-icon="#" href="javascript void(0)"
                                            style="padding-left: 0.375em;"></a></h4>

                                    <div class="col-12 mt-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineRadio1" type="radio"
                                                name="inlineRadioOptions" value="option1" checked="checked" />
                                            <label class="form-check-label" for="inlineRadio1">Online</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineRadio2" type="radio"
                                                name="inlineRadioOptions" value="option2" />
                                            <label class="form-check-label" for="inlineRadio2">Offline</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" id="inlineRadio3" type="radio"
                                                name="inlineRadioOptions" value="option3" />
                                            <label class="form-check-label" for="inlineRadio3">Both</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-12 mt-md-0 mt-lg-1">
                                        <div class="form-floating">
                                            <input class="form-control" id="floatingVenueInput" type="text"
                                                placeholder="Venue" />
                                            <label for="floatingVenueInput">Venue</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelectCountry">
                                                <option selected="selected">Select Country</option>
                                                <option value="1">Country One</option>
                                                <option value="2">Country Two</option>
                                                <option value="3">Country Three</option>
                                            </select>
                                            <label for="floatingSelectCountry">Country</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelectState">
                                                <option selected="selected">Select State </option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                            <label for="floatingSelectState"> State</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelectCity">
                                                <option selected="selected">Select city</option>
                                                <option value="1">Data Privacy One</option>
                                                <option value="2">Data Privacy Two</option>
                                                <option value="3">Data Privacy Three</option>
                                            </select>
                                            <label for="floatingSelectCity">City</label>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- **************************************  ITEMS ******************************************** -->
            <div class="d-flex mb-5 pt-1" id="scrollspyOrderItems"><span class="fa-stack me-2 ms-n1"><i
                        class="fas fa-circle fa-stack-2x text-primary"></i><i
                        class="fa-inverse fa-stack-1x text-primary-soft fas fa-file-alt"
                        data-fa-transform="shrink-2"></i></span>
                <div class="col">
                    <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-soft pe-2">
                            Item Selection</span><span
                            class="border border-primary-200 position-absolute top-50 translate-middle-y w-100 start-0 z-index--1"></span>
                    </h3>
                    <p class="mb-0">Get different types of data from the user by using Phoenix's customizable form.</p>
                </div>
            </div>
            <div class="row g-1">
                <div class="col-xxl-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <!-- <h5 class="fs-1 mb-5">Item Selection</h2> -->

                            <!-- </div> -->
                            <div class="row g-3">
                                <table class="table" id="productTable">
                                    <tr>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Delivery Date</th>
                                        <th>Comment</th>
                                        <th></th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    <tr>
                                        <td>

                                            <select class="form-select item_category" data-width="100%"
                                                tabindex="-1" aria-hidden="true" id="item_category1"
                                                name="item_category[]" data-id="1" >
                                                <option value="" selected>Select value</option>
                                                @foreach ($item_category as $item_cat)
                                                @if (Request::old('item_category') == $item_cat->item_category_id )
                                                <option value="{{ $item_cat->item_category_id  }}" selected>
                                                    {{ $item_cat->item_category_name }}
                                                </option>
                                                @else
                                                <option value="{{ $item_cat->item_category_id  }}">
                                                    {{ $item_cat->item_category_name }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>

                                        <td><select class="form-select item_subcategory" data-width="100%"
                                                data-id="1" tabindex="-1" aria-hidden="true"
                                                id="item_subcategory1" name="item_subcategory[]" >
                                                <option value="" selected>Select value</option>
                                            </select></td>

                                        <td><select class="form-select item_name" data-width="100%" data-id="1"
                                                tabindex="-1" aria-hidden="true" id="item_name1" name="item_name[0]"
                                                >
                                                <option value="" selected>Select value</option>
                                            </select></td>

                                        <td><input type="number" name="quatity[]" placeholder="Enter title"
                                                class="form-control" ></td>
                                        <td>
                                            <input class="form-control datetimepicker" id="delivery_date1" data-target="#delivery_date1"
                                                name="delivery_date[]" type="date" placeholder="dd/mm/yyyy"
                                                data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}'>
                                        </td>
                                        <td><input type="text" name="comment[]" placeholder="Enter title"
                                                class="form-control" ></td>
                                        <td><button class="btn btn-phoenix-primary w-100 add-select" type="button"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Add more item lines"><span
                                                    class="fa-solid fa-add"></span></button></td>
                                    </tr>
                                </table>

                                <div class="row g-2 mt-7">
                                    <div class="col-12 col-md-auto flex-md-grow-1">
                                        <button class="btn btn-primary w-100" type="submit">Save</button>
                                    </div>
                                    <div class="col-12 col-sm-auto flex-sm-grow-1 flex-md-grow-0">
                                        <button class="btn btn-phoenix-primary w-100" type="button"><span
                                                class="fa-regular fa-calendar-plus me-2"></span>Add to Calendar
                                        </button>
                                    </div>
                                    <!-- <div class="col-6 col-sm-auto">
                                        <button class="btn btn-phoenix-primary w-100" type="button"><span
                                                class="fa-solid fa-heart me-2"></span>3677</button>
                                    </div> -->
                                    <div class="col-6 col-sm-auto">
                                        <button class="btn btn-phoenix-primary w-100 add-select" type="button"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Add more item lines"><span class="fa-solid fa-add"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

    </div>


    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    @endsection

    @push('script')

    <script src="{{ asset ('assets/js/order-form-custom.js') }}"></script>

    @include('main.partials.order-form-js')

    @endpush
