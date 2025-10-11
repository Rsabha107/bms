@extends('mds.admin.layout.dashboard')
@section('main')



<div class="content">
    <div class="widgets-scrollspy-nav mt-n5 bg-body-emphasis z-5 mx-n4 mx-lg-n6 border-bottom">
        <nav class="simplebar-scrollspy navbar py-0 scrollbar-overlay" id="widgets-scrollspy">
            <ul class="nav flex-nowrap">
                <li class="nav-item"> <a class="nav-link text-body-tertiary fw-bold py-3 lh-1 text-nowrap" href="#scrollspyStats">Number Stats and Charts</a></li>
                <li class="nav-item"> <a class="nav-link text-body-tertiary fw-bold py-3 lh-1 text-nowrap" href="#scrollspyEcommerce">E-commerce</a></li>
            </ul>
        </nav>
    </div>
    <div class="mb-9" data-bs-spy="scroll" data-bs-target="#widgets-scrollspy">
        <div class="d-flex mb-5 pt-8" id="scrollspyStats"><span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-primary"></i><i class="fa-inverse fa-stack-1x text-primary-subtle fas fa-percentage"></i></span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-body pe-2">Number Stats &amp; Charts</span><span class="border border-primary-lighter position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span></h3>
                <p class="mb-0">{{date("h:i:sa")}}</p>
            </div>
        </div>
        <div class="px-3 mb-5">
            <div class="row justify-content-between">
                <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 "><span class="uil fs-5 lh-1 uil-books text-primary"></span>
                    <h1 class="fs-5 pt-3"><a href="{{ route('tracki.project.show.card')}}"> {{$project_count}} </a></h1>
                    <p class="fs-9 mb-0">Total Projects</p>
                </div>
                <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0"><span class="uil fs-5 lh-1 uil-equal-circle text-info"></span>
                    <h1 class="fs-5 pt-3"><a href="{{ route('tracki.task.manage')}}"> {{$task_count}}</a></h1>
                    <p class="fs-9 mb-0">Total Tasks</p>
                </div>
                <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0"><span class="uil fs-5 lh-1 uil-ambulance text-danger"></span>
                    <h1 class="fs-5 pt-3"><a href="{{ route('tracki.task.lt')}}">{{$late_tasks_count}}</a></h1>
                    <p class="fs-9 mb-0">Late Tasks</p>
                </div>
                <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-md border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0"><span class="uil fs-5 lh-1 uil-bell text-danger"></span>
                    <h1 class="fs-5 pt-3"><a href="{{ route('tracki.task.est')}}">{{$ending_tasks_count}}</a></h1>
                    <p class="fs-9 mb-0">Ending Soon</p>
                </div>
                <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end border-end-xxl-0 pb-md-4 pb-xxl-0 pt-4 pt-xxl-0"><span class="uil fs-5 lh-1 uil-bell-school text-success"></span>
                    <h1 class="fs-5 pt-3"><a href="{{ route('tracki.task.sst')}}">{{$starting_tasks_count}}</a></h1>
                    <p class="fs-9 mb-0">Staring Soon</p>
                </div>
                <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl pb-md-4 pb-xxl-0 pt-4 pt-xxl-0"><span class="uil fs-5 lh-1 uil-file-contract-dollar text-danger"></span>
                    <h1 class="fs-5 pt-3"><a href="{{ route('tracki.project.show.card', 'unbudgeted')}}">{{ $unbudgeted_proj_count }}</a></h1>
                    <p class="fs-9 mb-0">Unbudgeted Projects</p>
                </div>
            </div>
        </div>
        <div class="row g-3 mb-5">
            <div class="col-md-6 col-xxl-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-2">Total Spent</h5>
                                <h6 class="text-body-tertiary">Budget: {{ number_format($total_yearly_budget?->budget_amount) }}</h6>
                            </div>
                            <h4>{{ number_format($total_yearly_spent->total_spent) }}</h4>
                        </div>
                        <div class="d-flex justify-content-center pt-3 flex-1">
                            <div class="echarts-budget-utilization" style="height:100%;width:100%;" data-percent="{{ number_format($budget_percentage_used, 2) }}"></div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Budget Uitlization</h6>
                                <h6 class="text-body fw-semibold mb-0">{{ number_format($budget_percentage_used, 2)}}%</h6>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <div class="bullet-item bg-primary-subtle me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Non-paying customer</h6>
                                <h6 class="text-body fw-semibold mb-0">70%</h6>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-1">Total projects completing</h5>
                                <h6 class="text-body-tertiary">By month</h6>
                            </div>
                            <h4>{{$project_count}}</h4>
                        </div>
                        <div class="d-flex justify-content-center px-4 py-6">
                            <div class="echart-total-project-by-month" style="height:85px;width:115px"></div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Total</h6>
                                <h6 class="text-body fw-semibold mb-0">{{$project_count}}</h6>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <div class="bullet-item bg-primary-subtle me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                <h6 class="text-body fw-semibold mb-0">48%</h6>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xxl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-1">New customers<span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"> <span class="badge-label">+26.5%</span></span></h5>
                                <h6 class="text-body-tertiary">Last 7 days</h6>
                            </div>
                            <h4>356</h4>
                        </div>
                        <div class="pb-0 pt-4">
                            <div class="echarts-new-customers-tracki" style="height:180px;width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xxl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-2">Top coupons</h5>
                                <h6 class="text-body-tertiary">Last 7 days</h6>
                            </div>
                        </div>
                        <div class="pb-4 pt-3">
                            <div class="echart-top-coupons-tracki" style="height:115px;width:100%;"></div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Percentage discount</h6>
                                <h6 class="text-body fw-semibold mb-0">72%</h6>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="bullet-item bg-primary-lighter me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Fixed card discount</h6>
                                <h6 class="text-body fw-semibold mb-0">18%</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="bullet-item bg-info-dark me-2"></div>
                                <h6 class="text-body fw-semibold flex-1 mb-0">Fixed product discount</h6>
                                <h6 class="text-body fw-semibold mb-0">10%</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-4 gy-6 pb-5 bg-body-emphasis">
            <div class="col-xl-6">
                <div class="card shadow-none" data-component-card="data-component-card">
                    <div class="card-header p-4">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0" data-anchor="data-anchor">Completed Projects by Month</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <!-- Find the JS file for the following chart at: src/js/charts/echarts/examples/basic-bar-chart.js-->
                            <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/echarts-example.js-->
                            <div class="echart-completed-projects-by-month" style="min-height:300px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card shadow-none" data-component-card="data-component-card">
                    <div class="card-header p-4">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0" data-anchor="data-anchor">Project statistics </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <!-- Find the JS file for the following chart at: src/js/charts/echarts/examples/basic-bar-chart.js-->
                            <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/echarts-example.js-->
                            <div class="echart-project-status-pie-label-align-chart" style="min-height:300px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card shadow-none" data-component-card="data-component-card">
                    <div class="card-header p-4">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0" data-anchor="data-anchor">Todo statistics </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <!-- Find the JS file for the following chart at: src/js/charts/echarts/examples/basic-bar-chart.js-->
                            <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/echarts-example.js-->
                            <div class="echart-todo-status-pie-label-align-chart" style="min-height:300px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xxl-6">
                <div class="row">
                    <div class="col-sm-7 col-md-8 col-xxl-8 mb-md-3 mb-lg-0">
                        <h3>Spending by Department</h3>
                        <p class="text-body-tertiary">Budget utilization across all channels</p>
                        <div class="row g-0">
                            @foreach($total_spent_by_department as $spent_by_department)
                            <div class="col-6 col-xl-4">
                                <div class="d-flex flex-column flex-center align-items-sm-start flex-md-row justify-content-md-between flex-xxl-column p-3 ps-sm-3 ps-md-4 p-md-3 h-100 border-1 border-bottom border-end border-translucent">
                                    <div class="d-flex align-items-center mb-1"><span class="fa-solid fa-square fs-11 me-2 text-primary" data-fa-transform="up-2"></span><span class="mb-0 fs-9 text-body">{{ $spent_by_department->name }}</span></div>
                                    <h3 class="fw-semibold ms-xl-3 ms-xxl-0 pe-md-2 pe-xxl-0 mb-0 mb-sm-3">{{ number_format($spent_by_department->value) }}</h3>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-5 col-md-4 col-xxl-4 my-3 my-sm-0">
                        <div class="position-relative d-flex flex-center mb-sm-4 mb-xl-0 echart-contact-by-source-container mt-sm-7 mt-lg-4 mt-xl-0">
                            <div class="echart-contact-by-source" style="min-height:245px;width:100%"></div>
                            <div class="position-absolute rounded-circle bg-primary-subtle top-50 start-50 translate-middle d-flex flex-center" style="height:100px; width:100px;">
                                <h3 class="mb-0 text-primary-dark fw-bolder" data-label="data-label"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis py-5">
            <div class="row g-6">
                <div class="col-12 col-xl-6">
                    <div class="me-xl-4">
                        <div>
                            <h3>Projection vs actual</h3>
                            <p class="mb-1 text-body-tertiary">Actual earnings vs projected earnings</p>
                        </div>
                        <div class="echart-projection-actual" style="height:300px; width:100%"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-7 col-xxl-6">
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <h3 class="text-body-emphasis text-nowrap">Spendind by Department</h3>
                            <p class="text-body-tertiary mb-md-7">Budget utilization across all channels</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0 fw-bold">Department </p>
                                <p class="mb-0 fs-9">Total spend <span class="fw-bold">{{ number_format($total_yearly_spent->total_spent) }}</span></p>
                            </div>
                            @foreach($total_spent_by_department as $spent_by_department)
                            <hr class="bg-body-secondary mb-2 mt-2" />
                            <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-info-light bullet-item me-2"></span>
                                <p class="mb-0 fw-semibold text-body lh-sm flex-1">{{ $spent_by_department->name }}</p>
                                <h5 class="mb-0 text-body">{{ number_format($spent_by_department->value) }}</h5>
                            </div>
                            @endforeach
                            <button class="btn btn-outline-primary mt-5">See Details<span class="fas fa-angle-right ms-2 fs-10 text-center"></span></button>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="position-relative mb-sm-4 mb-xl-0">
                                <div class="echart-spend-by-department" style="min-height:390px;width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-12 col-xl-6">
                    <div>
                        <h3>Returning customer rate</h3>
                        <p class="mb-1 text-body-tertiary">Rate of customers returning to your shop over time</p>
                    </div>
                    <div class="echart-returning-customer2" style="height:300px;"></div>
                </div> -->
            </div>
        </div>
        <!-- <div class="row g-6 pt-6 align-items-center">
            <div class="col-xxl-6">
                <div class="row flex-between-center mb-4 g-3">
                    <div class="col-auto">
                        <h3>Total sells</h3>
                        <p class="text-body-tertiary lh-sm mb-0">Payment received across all channels</p>
                    </div>
                    <div class="col-8 col-sm-4">
                        <select class="form-select form-select-sm" id="select-gross-revenue-month">
                            <option>Mar 1 - 31, 2022</option>
                            <option>April 1 - 30, 2022</option>
                            <option>May 1 - 31, 2022</option>
                        </select>
                    </div>
                </div>
                <div class="echart-total-sales-by-month-chart" style="min-height:320px;width:100%"></div>
            </div>
            <div class="col-xxl-6">
                <div class="mx-xxl-0">
                    <h3>Project: zero Roadmap</h3>
                    <p class="text-body-tertiary">Phase 2 is now ongoing</p>
                    <div class="gantt-zero-roadmap">
                        <div class="row g-2 flex-between-center mb-3">
                            <div class="col-12 col-sm-auto">
                                <div class="d-flex">
                                    <div class="d-flex align-items-end me-3">
                                        <label class="form-check-label mb-0 me-2 lh-1 text-body" for="progress">Progress</label>
                                        <div class="form-check form-switch min-h-auto mb-0">
                                            <input class="form-check-input" id="progress" type="checkbox" checked="" data-gantt-progress="data-gantt-progress" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end flex-1">
                                        <label class="form-check-label mb-0 me-2 lh-1 text-body" for="links">Links</label>
                                        <div class="form-check form-switch min-h-auto flex-1 mb-0">
                                            <input class="form-check-input" id="links" type="checkbox" checked="" data-gantt-links="data-gantt-links" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-auto">
                                <div class="btn-group" role="group" data-gantt-scale="data-gantt-scale">
                                    <input class="btn-check" id="weekView" type="radio" name="scaleView" value="week" checked="" />
                                    <label class="btn btn-phoenix-secondary bg-body-highlight-hover fs-10 py-1 mb-0" for="weekView">Week</label>
                                    <input class="btn-check" id="monthView" type="radio" name="scaleView" value="month" />
                                    <label class="btn btn-phoenix-secondary bg-body-highlight-hover fs-10 py-1 mb-0" for="monthView">Month</label>
                                    <input class="btn-check" id="yearView" type="radio" name="scaleView" value="year" />
                                    <label class="btn btn-phoenix-secondary bg-body-highlight-hover fs-10 py-1 mb-0" for="yearView">Year</label>
                                </div>
                            </div>
                        </div>
                        <div class="gantt-zero-roadmap-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-3 mt-6">
            <div class="row">
                <div class="col-12 col-xl-7 col-xxl-6">
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <h3 class="text-body-emphasis text-nowrap">Spendind by Department</h3>
                            <p class="text-body-tertiary mb-md-7">Budget utilization across all channels</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0 fw-bold">Department </p>
                                <p class="mb-0 fs-9">Total spend <span class="fw-bold">{{ number_format($total_yearly_spent->total_spent) }}</span></p>
                            </div>
                            @foreach($total_spent_by_department as $spent_by_department)
                            <hr class="bg-body-secondary mb-2 mt-2" />
                            <div class="d-flex align-items-center mb-1"><span class="d-inline-block bg-info-light bullet-item me-2"></span>
                                <p class="mb-0 fw-semibold text-body lh-sm flex-1">{{ $spent_by_department->name }}</p>
                                <h5 class="mb-0 text-body">{{ number_format($spent_by_department->value) }}</h5>
                            </div>
                            @endforeach
                            <button class="btn btn-outline-primary mt-5">See Details<span class="fas fa-angle-right ms-2 fs-10 text-center"></span></button>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="position-relative mb-sm-4 mb-xl-0">
                                <div class="echart-spend-by-department" style="min-height:390px;width:100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5 col-xxl-6">
                    <h3>Project: eleven Progress</h3>
                    <p class="text-body-tertiary mb-0 mb-xl-3">Deadline &amp; progress</p>
                    <div class="echart-zero-burnout-chart" style="min-height:320px;width:100%"></div>
                </div>
            </div>
        </div> -->
        <!-- <div class="mx-lg-n4">
            <div class="row g-3 pt-3">
                <div class="col-xl-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3>Lead Conversion</h3>
                            <p class="text-body-tertiary mb-0">Stages of deals &amp; conversion</p>
                            <div class="echart-lead-conversion" style="min-height: 250px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3>Revenue Target</h3>
                            <p class="text-body-tertiary">Country-wise target fulfilment</p>
                            <div class="echart-revenue-target-conversion" style="min-height: 230px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="row g-6 mt-0">
            <div class="col-12 col-md-6">
                <div class="row justify-content-between mb-4">
                    <div class="col-12">
                        <h3>Sales Trends</h3>
                        <p class="text-body-tertiary">Updated inventory &amp; the sales report.</p>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="d-flex">
                            <div class="fa-solid fa-circle text-info-light me-2"></div>
                            <h6 class="mb-0 me-3 lh-base">Profit</h6>
                        </div>
                        <div class="d-flex">
                            <div class="fa-solid fa-circle text-primary-lighter me-2"></div>
                            <h6 class="mb-0 lh-base">Revenue</h6>
                        </div>
                    </div>
                </div>
                <div class="echart-sales-trends" style="height:270px; width:100%"></div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row justify-content-between mb-4">
                    <div class="col-auto">
                        <h3>Call Campaign Reports</h3>
                        <p class="text-body-tertiary">All call campaigns succeeded.</p>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="d-flex">
                            <div class="fa-solid fa-circle text-primary me-2"></div>
                            <h6 class="mb-0 me-3 lh-base">Campaign</h6>
                        </div>
                    </div>
                </div>
                <div class="echart-call-campaign" style="height:290px; width:100%"></div>
            </div>
        </div> -->
        <!-- <div class="mt-3 mx-lg-n4">
            <div class="row g-3">
                <div class="col-12 col-xl-6 col-xxl-7">
                    <div class="card todo-list h-100">
                        <div class="card-header border-bottom-0 pb-0">
                            <div class="row justify-content-between align-items-center mb-4">
                                <div class="col-auto">
                                    <h3 class="text-body-emphasis">To do</h3>
                                    <p class="mb-0 text-body-tertiary">Task assigned to me</p>
                                </div>
                                <div class="col-auto w-100 w-md-auto">
                                    <div class="row align-items-center g-0 justify-content-between">
                                        <div class="col-12 col-sm-auto">
                                            <div class="search-box w-100 mb-2 mb-sm-0" style="max-width:30rem;">
                                                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                                    <input class="form-control search-input search" type="search" placeholder="Search tasks" aria-label="Search" />
                                                    <span class="fas fa-search search-box-icon"></span>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex">
                                            <p class="mb-0 ms-sm-3 fs-9 text-body-tertiary fw-bold"><span class="fas fa-filter me-1 fw-extra-bold fs-10"></span>23 tasks</p>
                                            <button class="btn btn-link p-0 ms-3 fs-9 text-primary fw-bold"><span class="fas fa-sort me-1 fw-extra-bold fs-10"></span>Sorting</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-0 scrollbar to-do-list-body">
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-0" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Designing the dungeon</label><span class="badge badge-phoenix ms-auto fs-10 badge-phoenix-primary">DRAFT</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>2</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">12 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">12:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-1" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Hiring a motion graphic designer</label><span class="badge badge-phoenix ms-auto fs-10 badge-phoenix-warning">URGENT</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>2</a><a class="text-warning fw-bold fs-10 me-2" href="#!"><span class="fas fa-tasks me-1"></span>3</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">12 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">12:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-2" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Daily Meetings Purpose, participants</label><span class="badge badge-phoenix ms-auto fs-10 badge-phoenix-info">ON PROCESS</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>4</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">12 Dec, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">05:00 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-3" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Finalizing the geometric shapes</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>3</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">12 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">12:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-4" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Daily meeting with team members</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center">
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">1 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">12:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-5" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Daily Standup Meetings</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center">
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">13 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">10:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-6" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Procrastinate for a month</label><span class="badge badge-phoenix ms-auto fs-10 badge-phoenix-info">ON PROCESS</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>3</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">12 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">12:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-7" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">warming up</label><span class="badge badge-phoenix ms-auto fs-10 badge-phoenix-info">CLOSE</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>3</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">12 Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">12:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex hover-actions-trigger py-3 border-top border-bottom">
                                <input class="form-check-input form-check-input-todolist flex-shrink-0 my-1 me-2 form-check-input-undefined" type="checkbox" id="checkbox-todo-8" data-event-propagation-prevent="data-event-propagation-prevent" />
                                <div class="row justify-content-between align-items-md-center btn-reveal-trigger border-translucent gx-0 flex-1 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="mb-1 mb-md-0 d-flex align-items-center lh-1">
                                            <label class="form-check-label mb-1 mb-md-0 mb-xl-1 mb-xxl-0 fs-8 me-2 line-clamp-1 text-body cursor-pointer">Make ready for release</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-auto col-xl-12 col-xxl-auto">
                                        <div class="d-flex lh-1 align-items-center"><a class="text-body-tertiary fw-bold fs-10 me-2" href="#!"><span class="fas fa-paperclip me-1"></span>2</a>
                                            <p class="text-body-tertiary fs-10 mb-md-0 me-2 me-md-3 me-xl-2 me-xxl-3 mb-0">2o Nov, 2021</p>
                                            <div class="hover-md-hide hover-xl-show hover-xxl-hide">
                                                <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0 ps-md-3 ps-xl-0 ps-xxl-3 border-start-md border-xl-0 border-start-xxl">1:00 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-none d-md-block d-xl-none d-xxl-block end-0 position-absolute" style="top: 23%;" data-event-propagation-prevent="data-event-propagation-prevent">
                                    <div class="hover-actions end-0" data-event-propagation-prevent="data-event-propagation-prevent">
                                        <button class="btn btn-phoenix-secondary btn-icon me-1 fs-10 text-body px-0 me-1" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-edit"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon fs-10 text-danger px-0" data-event-propagation-prevent="data-event-propagation-prevent"><span class="fas fa-trash"></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content bg-body overflow-hidden">
                                        <div class="modal-header px-6 py-5 pe-sm-5 px-md-6 dark__bg-gray-1100">
                                            <h3 class="text-body-highlight fw-bolder mb-0">Designing the Dungeon Blueprint</h3>
                                            <button class="btn btn-phoenix-secondary btn-icon btn-icon-xl flex-shrink-0" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fa-solid fa-xmark"></span></button>
                                        </div>
                                        <div class="modal-body bg-body-highlight px-6 py-0">
                                            <div class="row gx-14">
                                                <div class="col-12 col-lg-7 border-end-lg">
                                                    <div class="py-6">
                                                        <div class="mb-7">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <h4 class="text-body me-3">Description</h4><a class="btn btn-link text-decoration-none p-0" href="#!"><span class="fa-solid fa-pen"></span></a>
                                                            </div>
                                                            <p class="text-body-highlight mb-0">The female circus horse-rider is a recurring subject in Chagall’s work. In 1926 the art dealer Ambroise Vollard invited Chagall to make a project based on the circus. They visited Paris’s historic Cirque d’Hiver Bouglione together; Vollard lent Chagall his private box seats. Chagall completed 19 gouaches Chagall’s work. In 1926 the art dealer Ambroise Vollard invited Chagall to make a project based on the circus.</p>
                                                        </div>
                                                        <div class="mb-7">
                                                            <h4 class="mb-3">Subtasks</h4>
                                                            <div class="d-flex flex-between-center hover-actions-trigger py-3 border-top">
                                                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1 min-h-auto">
                                                                    <input class="subtask-checkbox form-check-input form-check-line-through mt-0 me-3" type="checkbox" id="subtaskundefined1" />
                                                                    <label class="form-check-label mb-0 fs-8" for="subtaskundefined1">Study Dragons</label>
                                                                </div>
                                                                <div class="hover-actions end-0">
                                                                    <button class="btn btn-sm me-1 fs-10 text-body-tertiary px-0 me-3"><span class="fa-solid fa-pencil"></span></button>
                                                                    <button class="btn btn-sm text-body-tertiary px-0"><span class="fa-solid fa-xmark fs-8"></span></button>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-between-center hover-actions-trigger py-3 border-top">
                                                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1 min-h-auto">
                                                                    <input class="subtask-checkbox form-check-input form-check-line-through mt-0 me-3" type="checkbox" id="subtaskundefined2" />
                                                                    <label class="form-check-label mb-0 fs-8" for="subtaskundefined2">Procrastinate a bit</label>
                                                                </div>
                                                                <div class="hover-actions end-0">
                                                                    <button class="btn btn-sm me-1 fs-10 text-body-tertiary px-0 me-3"><span class="fa-solid fa-pencil"></span></button>
                                                                    <button class="btn btn-sm text-body-tertiary px-0"><span class="fa-solid fa-xmark fs-8"></span></button>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-between-center hover-actions-trigger py-3 border-top border-bottom mb-3">
                                                                <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1 min-h-auto">
                                                                    <input class="subtask-checkbox form-check-input form-check-line-through mt-0 me-3" type="checkbox" id="subtaskundefined3" />
                                                                    <label class="form-check-label mb-0 fs-8" for="subtaskundefined3">Staring at the notebook for 5 mins</label>
                                                                </div>
                                                                <div class="hover-actions end-0">
                                                                    <button class="btn btn-sm me-1 fs-10 text-body-tertiary px-0 me-3"><span class="fa-solid fa-pencil"></span></button>
                                                                    <button class="btn btn-sm text-body-tertiary px-0"><span class="fa-solid fa-xmark fs-8"></span></button>
                                                                </div>
                                                            </div><a class="fw-bold fs-9" href="#!"><span class="fas fa-plus me-1"></span>Add subtask</a>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div>
                                                                <h4 class="mb-3">Files</h4>
                                                            </div>
                                                            <div class="border-top px-0 pt-4 pb-3">
                                                                <div class="me-n3">
                                                                    <div class="d-flex flex-between-center">
                                                                        <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>
                                                                            <p class="text-body-highlight mb-0 lh-1">Silly_sight_1.png</p>
                                                                        </div>
                                                                        <div class="btn-reveal-trigger">
                                                                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                                                                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex fs-9 text-body-tertiary mb-2 flex-wrap"><span>768 kb</span><span class="text-body-quaternary mx-1">| </span><a href="#!">Shantinan Mekalan </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">21st Dec, 12:56 PM</span></div><img class="rounded-2" src="assets/img/generic/40.png" alt="" style="max-width:230px" />
                                                                </div>
                                                            </div>
                                                            <div class="border-top px-0 pt-4 pb-3">
                                                                <div class="me-n3">
                                                                    <div class="d-flex flex-between-center">
                                                                        <div>
                                                                            <div class="d-flex align-items-center mb-1"><span class="fa-solid fa-image me-2 fs-9 text-body-tertiary"></span>
                                                                                <p class="text-body-highlight mb-0 lh-1">All_images.zip</p>
                                                                            </div>
                                                                            <div class="d-flex fs-9 text-body-tertiary mb-0 flex-wrap"><span>12.8 mb</span><span class="text-body-quaternary mx-1">| </span><a href="#!">Yves Tanguy </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">19th Dec, 08:56 PM</span></div>
                                                                        </div>
                                                                        <div class="btn-reveal-trigger">
                                                                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                                                                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="border-top border-bottom px-0 pt-4 pb-3">
                                                                <div class="me-n3">
                                                                    <div class="d-flex flex-between-center">
                                                                        <div>
                                                                            <div class="d-flex align-items-center mb-1 flex-wrap"><span class="fa-solid fa-file-lines me-2 fs-9 text-body-tertiary"></span>
                                                                                <p class="text-body-highlight mb-0 lh-1">Project.txt</p>
                                                                            </div>
                                                                            <div class="d-flex fs-9 text-body-tertiary mb-0 flex-wrap"><span>123 kb</span><span class="text-body-quaternary mx-1">| </span><a href="#!">Shantinan Mekalan </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">12th Dec, 12:56 PM</span></div>
                                                                        </div>
                                                                        <div class="btn-reveal-trigger">
                                                                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>
                                                                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><a class="fw-bold fs-9" href="#!"><span class="fas fa-plus me-1"></span>Add file(s)</a>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-5">
                                                    <div class="py-6">
                                                        <h4 class="mb-4 text-body-emphasis">Others Information</h4>
                                                        <h5 class="text-body-highlight mb-2">Status</h5>
                                                        <select class="form-select mb-4" aria-label="Default select example">
                                                            <option selected="">Select</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                        <h5 class="text-body-highlight mb-2">Due Date</h5>
                                                        <div class="flatpickr-input-container mb-4">
                                                            <input class="form-control datetimepicker ps-6" type="text" placeholder="Set the due date" data-options='{"disableMobile":true}' /><span class="uil uil-calendar-alt flatpickr-icon text-body-tertiary"></span>
                                                        </div>
                                                        <h5 class="text-body-highlight mb-2">Reminder</h5>
                                                        <div class="flatpickr-input-container mb-4">
                                                            <input class="form-control datetimepicker ps-6" type="text" placeholder="Reminder" data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true,"static":true}' /><span class="uil uil-bell-school flatpickr-icon text-body-tertiary"></span>
                                                        </div>
                                                        <h5 class="text-body-highlight mb-2">Tag</h5>
                                                        <div class="choices-select-container mb-6">
                                                            <select class="form-select" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'>
                                                                <option value="">Select organizer...</option>
                                                                <option>Massachusetts Institute of Technology</option>
                                                                <option>University of Chicago</option>
                                                                <option>GSAS Open Labs At Harvard</option>
                                                                <option>California Institute of Technology</option>
                                                            </select><span class="uil uil-tag-alt choices-icon text-body-tertiary" style="top: 26%;"></span>
                                                        </div>
                                                        <div class="text-end mb-9">
                                                            <button class="btn btn-phoenix-danger">Delete Task</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0"><a class="fw-bold fs-9 mt-4" href="#!"><span class="fas fa-plus me-1"></span>Add new task</a></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6 col-xxl-5">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title mb-1">
                                <h3 class="text-body-emphasis">Activity</h3>
                            </div>
                            <p class="text-body-tertiary mb-4">Recent activity across all projects</p>
                            <div class="timeline-vertical timeline-with-details">
                                <div class="timeline-item position-relative">
                                    <div class="row g-md-3">
                                        <div class="col-12 col-md-auto d-flex">
                                            <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                                <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">01 DEC, 2023<br class="d-none d-md-block" /> 10:30 AM</p>
                                            </div>
                                            <div class="timeline-item-bar position-md-relative me-3 me-md-0">
                                                <div class="icon-item icon-item-sm rounded-7 shadow-none bg-primary-subtle"><span class="fa-solid fa-chess text-primary-dark fs-10"></span></div><span class="timeline-bar border-end border-dashed"></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="timeline-item-content ps-6 ps-md-3">
                                                <h5 class="fs-9 lh-sm">Phoenix Template: Unleashing Creative Possibilities</h5>
                                                <p class="fs-9">by <a class="fw-semibold" href="#!">Shantinon Mekalan</a></p>
                                                <p class="fs-9 text-body-secondary mb-5">Discover limitless creativity with the Phoenix template! Our latest update offers an array of innovative features and design options.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item position-relative">
                                    <div class="row g-md-3">
                                        <div class="col-12 col-md-auto d-flex">
                                            <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                                <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">05 DEC, 2023<br class="d-none d-md-block" /> 12:30 AM</p>
                                            </div>
                                            <div class="timeline-item-bar position-md-relative me-3 me-md-0">
                                                <div class="icon-item icon-item-sm rounded-7 shadow-none bg-primary-subtle"><span class="fa-solid fa-dove text-primary-dark fs-10"></span></div><span class="timeline-bar border-end border-dashed"></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="timeline-item-content ps-6 ps-md-3">
                                                <h5 class="fs-9 lh-sm">Empower Your Digital Presence: The Phoenix Template Unveiled</h5>
                                                <p class="fs-9">by <a class="fw-semibold" href="#!">Bookworm22</a></p>
                                                <p class="fs-9 text-body-secondary mb-5">Unveiling the Phoenix template, a game-changer for your digital presence. With its powerful features and sleek design,</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item position-relative">
                                    <div class="row g-md-3">
                                        <div class="col-12 col-md-auto d-flex">
                                            <div class="timeline-item-date order-1 order-md-0 me-md-4">
                                                <p class="fs-10 fw-semibold text-body-tertiary text-opacity-85 text-end">15 DEC, 2023<br class="d-none d-md-block" /> 2:30 AM</p>
                                            </div>
                                            <div class="timeline-item-bar position-md-relative me-3 me-md-0">
                                                <div class="icon-item icon-item-sm rounded-7 shadow-none bg-primary-subtle"><span class="fa-solid fa-dungeon text-primary-dark fs-10"></span></div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="timeline-item-content ps-6 ps-md-3">
                                                <h5 class="fs-9 lh-sm">Phoenix Template: Simplified Design, Maximum Impact</h5>
                                                <p class="fs-9">by <a class="fw-semibold" href="#!">Sharuka Nijibum</a></p>
                                                <p class="fs-9 text-body-secondary mb-0">Introducing the Phoenix template, where simplified design meets maximum impact. Elevate your digital presence with its sleek and intuitive features.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="d-flex mb-5 pt-7" id="scrollspyEcommerce"><span class="fa-stack me-2 ms-n1"><i class="fas fa-circle fa-stack-2x text-primary"></i><i class="fa-inverse fa-stack-1x text-primary-subtle fas fa-cart-plus" data-fa-transform="shrink-4"></i></span>
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold"><span class="bg-body pe-2">E-commerce</span><span class="border border-primary-lighter position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span></h3>
                <p class="mb-0">Find more cards which are dedicatedly made for E-commerce.</p>
            </div>
        </div>
        <div>
            <h3 class="mb-3">Cart</h3>
            <div id="cartTable" data-list='{"valueNames":["products","color","size","price","quantity","total"],"page":10}'>
                <div class="table-responsive scrollbar mx-n1 px-1">
                    <table class="table fs-9 mb-0 border-top border-translucent">
                        <thead>
                            <tr>
                                <th class="sort white-space-nowrap align-middle fs-10" scope="col"></th>
                                <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:250px;">PRODUCTS</th>
                                <th class="sort align-middle" scope="col" style="width:80px;">COLOR</th>
                                <th class="sort align-middle" scope="col" style="width:150px;">SIZE</th>
                                <th class="sort align-middle text-end" scope="col" style="width:300px;">PRICE</th>
                                <th class="sort align-middle ps-5" scope="col" style="width:200px;">QUANTITY</th>
                                <th class="sort align-middle text-end" scope="col" style="width:250px;">TOTAL</th>
                                <th class="sort text-end align-middle pe-0" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="cart-table-body">
                            <tr class="cart-table-row btn-reveal-trigger">
                                <td class="align-middle white-space-nowrap py-0"><a class="d-block border border-translucent rounded-2" href="apps/e-commerce/landing/product-details.html"><img src="assets/img//products/1.png" alt="" width="53" /></a></td>
                                <td class="products align-middle"><a class="fw-semibold mb-0 line-clamp-2" href="apps/e-commerce/landing/product-details.html">Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management &amp; Skin Temperature Trends, Carbon/Graphite, One Size (S &amp; L Bands)</a></td>
                                <td class="color align-middle white-space-nowrap fs-9 text-body">Glossy black</td>
                                <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">XL</td>
                                <td class="price align-middle text-body fs-9 fw-semibold text-end">$199</td>
                                <td class="quantity align-middle fs-8 ps-5">
                                    <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity">
                                        <button class="btn btn-sm px-2" data-type="minus">-</button>
                                        <input class="form-control text-center input-spin-none bg-transparent border-0 px-0" type="number" min="1" value="2" aria-label="Amount (to the nearest dollar)" />
                                        <button class="btn btn-sm px-2" data-type="plus">+</button>
                                    </div>
                                </td>
                                <td class="total align-middle fw-bold text-body-highlight text-end">$398</td>
                                <td class="align-middle white-space-nowrap text-end pe-0 ps-3">
                                    <button class="btn btn-sm text-body-tertiary text-opacity-85 text-body-tertiary-hover me-2"><span class="fas fa-trash"></span></button>
                                </td>
                            </tr>
                            <tr class="cart-table-row btn-reveal-trigger">
                                <td class="align-middle white-space-nowrap py-0"><a class="d-block border border-translucent rounded-2" href="apps/e-commerce/landing/product-details.html"><img src="assets/img//products/2.png" alt="" width="53" /></a></td>
                                <td class="products align-middle"><a class="fw-semibold mb-0 line-clamp-2" href="apps/e-commerce/landing/product-details.html">iPhone 13 pro max-Pacific Blue-128GB storage</a></td>
                                <td class="color align-middle white-space-nowrap fs-9 text-body">Glossy black</td>
                                <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">XL</td>
                                <td class="price align-middle text-body fs-9 fw-semibold text-end">$150</td>
                                <td class="quantity align-middle fs-8 ps-5">
                                    <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity">
                                        <button class="btn btn-sm px-2" data-type="minus">-</button>
                                        <input class="form-control text-center input-spin-none bg-transparent border-0 px-0" type="number" min="1" value="2" aria-label="Amount (to the nearest dollar)" />
                                        <button class="btn btn-sm px-2" data-type="plus">+</button>
                                    </div>
                                </td>
                                <td class="total align-middle fw-bold text-body-highlight text-end">$300</td>
                                <td class="align-middle white-space-nowrap text-end pe-0 ps-3">
                                    <button class="btn btn-sm text-body-tertiary text-opacity-85 text-body-tertiary-hover me-2"><span class="fas fa-trash"></span></button>
                                </td>
                            </tr>
                            <tr class="cart-table-row btn-reveal-trigger">
                                <td class="align-middle white-space-nowrap py-0"><a class="d-block border border-translucent rounded-2" href="apps/e-commerce/landing/product-details.html"><img src="assets/img//products/3.png" alt="" width="53" /></a></td>
                                <td class="products align-middle"><a class="fw-semibold mb-0 line-clamp-2" href="apps/e-commerce/landing/product-details.html">Apple MacBook Pro 13 inch-M1-8/256GB-space</a></td>
                                <td class="color align-middle white-space-nowrap fs-9 text-body">Glossy Golden</td>
                                <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">34mm</td>
                                <td class="price align-middle text-body fs-9 fw-semibold text-end">$65</td>
                                <td class="quantity align-middle fs-8 ps-5">
                                    <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity">
                                        <button class="btn btn-sm px-2" data-type="minus">-</button>
                                        <input class="form-control text-center input-spin-none bg-transparent border-0 px-0" type="number" min="1" value="2" aria-label="Amount (to the nearest dollar)" />
                                        <button class="btn btn-sm px-2" data-type="plus">+</button>
                                    </div>
                                </td>
                                <td class="total align-middle fw-bold text-body-highlight text-end">$130</td>
                                <td class="align-middle white-space-nowrap text-end pe-0 ps-3">
                                    <button class="btn btn-sm text-body-tertiary text-opacity-85 text-body-tertiary-hover me-2"><span class="fas fa-trash"></span></button>
                                </td>
                            </tr>
                            <tr class="cart-table-row btn-reveal-trigger">
                                <td class="text-body-emphasis fw-semibold ps-0 fs-8" colspan="6">Items subtotal :</td>
                                <td class="text-body-emphasis fw-bold text-end fs-8">$691</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection

        @push('script')

        @include('tracki.partials.charts-js')

        @endpush
