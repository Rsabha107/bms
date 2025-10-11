@extends('tracki.layout.dashboard')
@section('tracki')


<div class="content kanban-content">
    <div class="kanban-header">
        <div class="row gx-0 justify-content-between justify-content-md-start">
            <div class="col-auto">


<div class="avatar avatar-xl ">
  <div class="avatar-name rounded-circle"><span>A</span></div>

                    <button class="btn btn-link text-decoration-none text-body-emphasis fs-8 ps-0" type="button"> <span class="fs-7 me-2">{{strtoupper($projects->name)}}</span></button>

            </div>

            <div class="col-md-auto d-flex align-items-center ms-auto mt-2 mt-md-0">
                <ul class="nav w-100 fs-9">
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body ps-0 pe-2 px-xl-3 fw-bold" href="#!" data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span class="me-1 fas fa-search" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Search</span></a></li>
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body px-2 px-xl-3 fw-bold" href="#!"><span class="me-1 fas fa-filter" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Filter</span></a></li>
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body px-2 px-xl-3 fw-bold" href="#!"><span class="me-1 fa-solid fa-right-left" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Export/import</span></a></li>
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body px-2 px-xl-3 fw-bold" href="#!"><span class="me-1 fas fa-palette" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Modify</span></a></li>
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body px-2 px-xl-3 fw-bold" href="#!"><span class="me-1 fa-solid fa-bars-staggered" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Gantt</span></a></li>
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body px-2 px-xl-3 fw-bold" href="#!"><span class="me-1 fa-solid fa-calendar-days" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Calendar</span></a></li>
                    <li class="nav-item"><a class="nav-link d-flex align-items-center text-body px-2 px-xl-3 fw-bold" href="#!"><span class="me-1 fa-solid fa-box-archive" data-fa-transform="up-2" style="min-width: 14px"></span><span class="d-none d-xxl-inline">Archive</span></a></li>
                    <li class="nav-item ms-auto"><a class="nav-link d-flex align-items-center pe-0 ps-1 ps-xl-3 text-body h-100" data-phoenix-toggle="offcanvas" data-phoenix-target="#offcanvasKanban" href="#offcanvasKanban" role="button"><span class="fa-solid fa-bars d-inline" data-fa-transform="up-2" style="min-width: 14px"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="kanban-container scrollbar" data-kanban-container="data-kanban-container">
        @foreach ($task_statuses as $task_status)
        <div class="kanban-column scrollbar">
            <div class="kanban-column-header px-4 hover-actions-trigger">
                <div class="d-flex align-items-center border-bottom border-3 py-3 border-{{$task_status->color}}">
                    <h5 class="mb-0 kanban-column-title">{{$task_status->title}}<span class="kanban-title-badge">3</span></h5>
                    <div class="hover-actions-trigger">
                        <button class="btn btn-sm btn-phoenix-default kanban-header-dropdown-btn hover-actions" type="button" data-boundary="viewport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2" style="width: 15rem;"><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Sort tasks</span><span class="fas fa-angle-right fs-10"></span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Sort all tasks</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Move all tasks</span><span class="fas fa-angle-right fs-10"></span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Remove all tasks</span></a>
                            <hr class="my-2" /><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Import</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Export</span><span class="fas fa-angle-right fs-10"></span></a>
                            <hr class="my-2" /><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Move column</span><span class="fas fa-angle-right fs-10"></span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Duplicate column</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Delete column</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Archive column</span></a>
                            <hr class="my-2" /><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Edit title &amp; description</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Edit colour</span><span class="fas fa-angle-right fs-10"></span></a>
                        </div>
                    </div><span class="uil uil-left-arrow-to-left fs-8 ms-auto kanban-collapse-icon" data-kanban-collapse="data-kanban-collapse"></span><span class="uil uil-arrow-from-right fs-8 ms-auto kanban-collapse-icon" data-kanban-collapse="data-kanban-collapse"></span>
                </div>
            </div>
            <div class="kanban-items-container" data-sortable="data-sortable" id="kic" data-task-status-id="{{$task_status->id}}">
                @foreach ($tasks as $task)
                @if($task->status_id == $task_status->id)
                <div class="sortable-item-wrapper border-bottom border-translucent px-2 py-2" data-task-id="{{$task->id}}">
                    <div class="card sortable-item hover-actions-trigger">
                        <div class="card-body py-3 px-3">
                            <div class="kanban-status mb-1 position-relative lh-1"><span class="fa fa-circle me-2 d-inline-block text-primary" style="min-width:1rem" data-fa-transform="shrink-1 down-3"></span><span class="badge badge-phoenix fs-10 badge-phoenix-primary"><span>{{$task->name}}</span><span class="ms-1 d-inline-block fas fa-check-double" data-fa-transform="up-2" style="height:7.8px;width:7.8px;"></span></span>
                                <button class="btn btn-sm btn-phoenix-default kanban-item-dropdown-btn hover-actions" type="button" data-boundary="viewport" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fa-rotate-90" data-fa-transform="shrink-2"></span></button>
                                <div class="dropdown-menu dropdown-menu-end py-2" style="width: 15rem;"><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Move</span><span class="fas fa-angle-right fs-10"></span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Duplicate</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Jump to top</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Jump to bottom</span></a>
                                    <hr class="my-2" /><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Print/Download</span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Share</span><span class="fas fa-angle-right fs-10"></span></a>
                                    <hr class="my-2" /><a class="dropdown-item d-flex flex-between-center border-1 border-translucent undefined" href="#!"><span>Move to archive</span><span class="fas fa-angle-right fs-10"></span></a><a class="dropdown-item d-flex flex-between-center border-1 border-translucent text-danger" href="#!"><span>Delete</span></a>
                                </div>
                            </div>
                            <p class="mb-0 stretched-link kanbanlongname" data-bs-toggle="modal" data-bs-target="#KanbanItemDetailsModal">{{strip_tags($task->description)}}</p>
                            <div class="d-flex mt-2 align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="py-3 px-4 kanban-add-task">
                <button class="btn bg-sm bg-body-tertiary me-2 px-0" data-bs-toggle="modal" data-bs-target="#kanbanAddTask"><span class="fas fa-plus text-white dark__text-gray-400" data-fa-transform="grow-4 down-1"></span></button>
                <input class="form-control search-input rounded-3 px-3" placeholder="Add new task" />
            </div>
        </div>
        @endforeach
        <div class="kanban-column scrollbar position-relative bg-transparent">
            <div class="d-flex h-100 flex-center fw-bold bg-body-hover"><a class="text-decoration-none stretched-link text-body-secondary" href="#!">
                    <div class="circle-btn bg-body-secondary mx-auto"><span class="fas fa-plus" data-fa-transform="shrink-2"></span></div><span>Add another list</span>
                </a></div>
        </div>
    </div>
    <div class="phoenix-offcanvas phoenix-offcanvas-end bg-body-highlight position-fixed" tabindex="-1" id="offcanvasKanban" style="max-width: 445px">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title">Phoenix Kanban</h3>
            <button class="btn p-1 fw-bolder" type="button" data-phoenix-dismiss="offcanvas" aria-label="Close"><span class="fas fa-times fs-8"> </span></button>
        </div>
        <div class="offcanvas-body">
            <h4 class="text-body-highlight fw-semibold mb-0 mt-6">Admins </h4>
            <div class="d-flex align-items-center mt-3">
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-xl  me-3 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/14.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/14.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Sasha Blaus</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="flex-1"><a class="text-decoration-none text-body-highlight lh-1 fw-semibold" href="#!">Sasha Blaus</a>
                    <h6 class="mb-0 lh-1 text-body-highlight fw-semibold">@potatogirl</h6>
                </div>
            </div>
            <h4 class="text-body-highlight fw-semibold mb-0 mt-5 mb-3">Members
            </h4>
            <div class="d-flex">
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/33.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/33.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Tyrion Lannister</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/30.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/30.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Milind Mikuja</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/31.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/31.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Stanly Drinkwater</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/60.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/60.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Josef Stravinsky</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/65.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/65.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Igor Borvibson</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
            </div>
            <h4 class="text-body-highlight fw-semibold mb-0 mt-3 mb-3">Guests
            </h4>
            <div class="d-flex">
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="../../assets/img//team/2.webp" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img//team/2.webp" alt="" /></div>
                                    <h6 class="text-white">Tyrion Lannister</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="../../assets/img//team/3.webp" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/3.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Milind Mikuja</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="../../assets/img//team/4.webp" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/4.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Stanly Drinkwater</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
                <div class="dropdown"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="avatar avatar-m  me-2 border border-light-subtle rounded-pill">
                            <img class="rounded-circle " src="{{ asset('assets/img/team/5.webp')}}" alt="" />

                        </div>
                    </a>
                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                        <div class="position-relative">
                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="p-3">
                                <div class="text-end">
                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                </div>
                                <div class="text-center">
                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="{{ asset('assets/img/team/5.webp')}}" alt="" /></div>
                                    <h6 class="text-white">Josef Stravinsky</h6>
                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                    <div class="d-flex flex-center mb-3">
                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-body-emphasis">
                            <div class="p-3 border-bottom border-translucent">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                    </div>
                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                </div>
                            </div>
                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                            </ul>
                        </div>
                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                    </div>
                </div>
            </div>
            <h4 class="text-body-highlight fw-semibold mb-0 mt-7 mb-3 border-bottom border-translucent pb-3">Description <span class="fas fa-pencil text-body fs-9 ms-3 cursor-pointer" data-fa-transform="up-2"></span></h4>
            <p>Phoenix is a rich and complex symbol that continues to capture the imagination of people across cultures and time periods. Whether seen as a symbol of hope, renewal, or mystery, the Phoenix retrackis an enduring icon of the human spirit.</p>
            <ul class="list-unstyled mb-0">
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Board Setting</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Duplicate Board</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Manage Labels</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Go to Archive</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Print</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Export As</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Integrations</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Privacy Settings</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3  border-bottom" href="#!"><span>Automation</span><span class="fas fa-angle-right fs-9 me-3"></span></a></li>
                <li><a class="text-body-highlight fw-semibold text-decoration-none d-flex flex-between-center py-3 text-danger pb-0 pb-0" href="#!"><span>Leave Board</span></a></li>
            </ul>
        </div>
    </div>

    <!-- <div class="phoenix-offcanvas-backdrop" data-phoenix-backdrop="data-phoenix-backdrop"></div>
        <footer class="footer position-absolute">
          <div class="row g-0 justify-content-between align-items-center h-100">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 mt-2 mt-sm-0 text-body">Thank you for creating with Phoenix<span class="d-none d-sm-inline-block"></span><span class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none" />2024 &copy;<a class="mx-1" href="https://themewagon.com">Themewagon</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-body-tertiary text-opacity-85">v1.15.0</p>
            </div>
          </div>
        </footer> -->
<!-- </div> -->
<!-- <div class="modal fade" id="KanbanItemDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-0">
                <div class="position-relative" style="height:200px; width:100%">
                    <div class="bg-holder" style="background-image:url(../../assets/img/kanban/modal-bg.jpg);">
                    </div>

                </div>
                <div class="row gy-4 py-0 gx-0">
                    <div class="col-lg-8 col-12">
                        <div class="row mt-0 gy-4 pb-3 gx-0 px-3">
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">TITLE </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <h4 class="mb-0 text-body-emphasis lh-sm">Reproduced below for those interested</h4>
                            </div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">DESCRIPTION </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <P class="fs-9 mb-0">Reproduced below for those interested" is a phrase used to provide additional content or details for individuals who have expressed interest in a particular topic. It signals that what follows is optional and caters specifically to those who want to delve deeper into the subject matter.</P>
                            </div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">BOARD </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <P class="mb-0 text-body-emphasis fw-semibold">Phoenix</P>
                            </div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">COLUMN </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <P class="mb-0 text-body-emphasis fw-semibold d-inline-block kanban-column-underline-warning">Doing</P>
                            </div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">ASSAIGNED TO </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <div class="d-flex align-items-center"><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        <div class="avatar avatar-s  me-1">
                                            <img class="rounded-circle " src="../../assets/img/team/30.webp" alt="" />

                                        </div>
                                    </a>
                                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                                        <div class="position-relative">
                                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                                            </div>

                                            <div class="p-3">
                                                <div class="text-end">
                                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                                </div>
                                                <div class="text-center">
                                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/30.webp" alt="" /></div>
                                                    <h6 class="text-white">Stanly Drinkwater</h6>
                                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                                    <div class="d-flex flex-center mb-3">
                                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-body-emphasis">
                                            <div class="p-3 border-bottom border-translucent">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex">
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                                    </div>
                                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                                </div>
                                            </div>
                                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                                    </div><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        <div class="avatar avatar-s  me-1">
                                            <img class="rounded-circle " src="../../assets/img/team/60.webp" alt="" />

                                        </div>
                                    </a>
                                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                                        <div class="position-relative">
                                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                                            </div>

                                            <div class="p-3">
                                                <div class="text-end">
                                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                                </div>
                                                <div class="text-center">
                                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/60.webp" alt="" /></div>
                                                    <h6 class="text-white">Emma Watson</h6>
                                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                                    <div class="d-flex flex-center mb-3">
                                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-body-emphasis">
                                            <div class="p-3 border-bottom border-translucent">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex">
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                                    </div>
                                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                                </div>
                                            </div>
                                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                                    </div><a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        <div class="avatar avatar-s  me-1">
                                            <img class="rounded-circle " src="../../assets/img/team/25.webp" alt="" />

                                        </div>
                                    </a>
                                    <div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">
                                        <div class="position-relative">
                                            <div class="bg-holder z-n1" style="background-image:url(../../assets/img/bg/bg-32.png);background-size: auto;">
                                            </div>

                                            <div class="p-3">
                                                <div class="text-end">
                                                    <button class="btn p-0 me-2"><span class="fa-solid fa-user-plus text-white"></span></button>
                                                    <button class="btn p-0"><span class="fa-solid fa-ellipsis text-white"></span></button>
                                                </div>
                                                <div class="text-center">
                                                    <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" src="../../assets/img/team/25.webp" alt="" /></div>
                                                    <h6 class="text-white">Igor Borvibson</h6>
                                                    <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">@tyrion222</p>
                                                    <div class="d-flex flex-center mb-3">
                                                        <h6 class="text-white mb-0">224 <span class="fw-normal text-light text-opacity-75">connections</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>
                                                        <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">mutual</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-body-emphasis">
                                            <div class="p-3 border-bottom border-translucent">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex">
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-phone"></span></button>
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg me-2"><span class="fa-solid fa-message"></span></button>
                                                        <button class="btn btn-phoenix-secondary btn-icon btn-icon-lg"><span class="fa-solid fa-video"></span></button>
                                                    </div>
                                                    <button class="btn btn-phoenix-primary"><span class="fa-solid fa-envelope me-2"></span>Send Email</button>
                                                </div>
                                            </div>
                                            <ul class="nav d-flex flex-column py-3 border-bottom">
                                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body d-inline-block" data-feather="clipboard"></span><span class="text-body-highlight flex-1">Assigned Projects</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                                <li class="nav-item"><a class="nav-link px-3 d-flex flex-between-center" href="#!"> <span class="me-2 text-body" data-feather="pie-chart"></span><span class="text-body-highlight flex-1">View activiy</span><span class="fa-solid fa-chevron-right fs-11"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="#!">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">PRIORITY </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <P class="mb-0 text-body-emphasis fw-semibold"><span class="fa fa-circle m text-warning" data-fa-transform="shrink-6 down-1"></span>High</P>
                            </div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">CATEGORY </h6>
                            </div>
                            <div class="col-8 col-sm-9"><span class="badge badge-phoenix fs-10 badge-phoenix-danger"><span>Bug</span><span class="ms-1 fas fa-bug item.icon" data-fa-transform="up-2" style="height:7.8px;width:7.8px;"></span></span></div>
                            <div class="col-4 col-sm-3">
                                <h6 class="text-body-tertiary fw-bolder lh-sm mt-1">ATTACHMENTS </h6>
                            </div>
                            <div class="col-8 col-sm-9">
                                <div class="border-bottom border-translucent d-flex flex-row pb-3"><img class="rounded-3" src="../../assets/img/kanban/a1.jpg" width="64" height="64" alt="" />
                                    <div class="flex-1 ms-3 d-flex flex-column">
                                        <h5 class="lh-sm">Silly_sight_1.png</h5>
                                        <p class="lh-1 fs-9 text-body-tertiary fw-medium mb-0">21st Decemver, 12:56 PM</p>
                                        <div class="d-flex text-body-tertiary mt-auto"><span class="fas fa-comment me-3" data-fa-transform="shrink-4"></span><span class="fas fa-trash me-3" data-fa-transform="shrink-4"></span><span class="fas fa-pencil" data-fa-transform="shrink-4"></span></div>
                                    </div>
                                </div>
                                <div class="border-bottom border-translucent d-flex flex-row pb-3 mt-3">
                                    <div class="border border-translucent rounded-3 flex-center d-flex" style="width:64px; height: 64px">
                                        <div class="fa-solid fa-file-zipper fa-2x text-body-quaternary text-opacity-75"></div>
                                    </div>
                                    <div class="flex-1 ms-3 d-flex flex-column">
                                        <h5 class="lh-sm">All_images.zip</h5>
                                        <p class="lh-1 fs-9 text-body-tertiary fw-medium mb-0">21st Decemver, 12:56 PM</p>
                                        <div class="d-flex text-body-tertiary mt-auto"><span class="fas fa-comment me-3" data-fa-transform="shrink-4"></span><span class="fas fa-trash me-3" data-fa-transform="shrink-4"></span><span class="fas fa-pencil" data-fa-transform="shrink-4"></span></div>
                                    </div>
                                </div>
                                <button class="btn btn-link ps-0"><span class="fas fa-plus me-2" data-fa-transform="shrink-3"></span>Add an Attachment</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 border-start-lg">
                        <div class="scrollbar" style="max-height: 667px;">
                            <div class="px-3">
                                <h5 class="mb-3 mt-4">Actions</h5>
                                <ul class="nav flex-column flex-sm-row flex-lg-column list-unstyled">
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-file-export"></span>Move</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-clone"></span>Duplicate</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-share-nodes"></span>Share</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-square-plus"></span>Create template</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-arrows-up-to-line"></span>Jump to top</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-box-archive"></span>Move to Archive</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-trash-can"></span>Move to Trash</a></li>
                                    <li class="kanban-action-item lh-sm nav-item me-2"><a class="nav-link text-body-emphasis fw-semibold fs-9 stretched-link" href="#!"><span class="me-2 fa-solid fa-download"></span>Print/Download</a></li>
                                </ul>
                                <h5 class="mt-6">Activities</h5>
                                <div class="d-flex border-bottom ">
                                    <div class="pt-3 text-warning"><span class="border border-translucent rounded-pill p-1 fas fa-random" data-fa-transform="shrink-4"></span></div>
                                    <div class="activity-item ps-2 py-3">
                                        <p class="mb-1 fs-9"><span class="fw-bold"> Alfen Loebe </span> Moved the task <a href="#!">"the standard chunk" </a>from <span class="fw-bold">Doing</span> to <span class="fw-bold">To Do</span></p>
                                        <div class="d-flex">
                                            <p class="mb-0 fs-9 me-3"> <span class="fa-regular fa-clock me-1"></span>10:41 AM</p>
                                            <p class="mb-0 fs-9">Aughst 7,2022</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom ">
                                    <div class="pt-3 text-info"><span class="border border-translucent rounded-pill p-1 fa-solid fa-paperclip" data-fa-transform="shrink-4"></span></div>
                                    <div class="activity-item ps-2 py-3">
                                        <p class="mb-1 fs-9"><span class="fw-bold"> Jessie Samson </span> Attached image3.png to the task <a href="#!">"the standard chunk" </a></p>
                                        <div class="d-flex">
                                            <p class="mb-0 fs-9 me-3"> <span class="fa-regular fa-clock me-1"></span>10:41 AM</p>
                                            <p class="mb-0 fs-9">Aughst 7,2022</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border-bottom ">
                                    <div class="pt-3 text-info"><span class="border border-translucent rounded-pill p-1 fas fa-plus" data-fa-transform="shrink-4"></span></div>
                                    <div class="activity-item ps-2 py-3">
                                        <p class="mb-1 fs-9"><span class="fw-bold"> Alfen Loebe </span> Moved the task <a href="#!">"the standard chunk" </a>from <span class="fw-bold">Doing</span> to <span class="fw-bold">To Do</span></p>
                                        <div class="d-flex">
                                            <p class="mb-0 fs-9 me-3"> <span class="fa-regular fa-clock me-1"></span>10:41 AM</p>
                                            <p class="mb-0 fs-9">Aughst 7,2022</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex  ">
                                    <div class="pt-3 text-primary"><span class="border border-translucent rounded-pill p-1 fas fa-random" data-fa-transform="shrink-4"></span></div>
                                    <div class="activity-item ps-2 py-3">
                                        <p class="mb-1 fs-9"><span class="fw-bold"> Alfen Loebe </span> Moved the task <a href="#!">"the standard chunk" </a>from <span class="fw-bold">Doing</span> to <span class="fw-bold">To Do</span></p>
                                        <div class="d-flex">
                                            <p class="mb-0 fs-9 me-3"> <span class="fa-regular fa-clock me-1"></span>10:41 AM</p>
                                            <p class="mb-0 fs-9">Aughst 7,2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs-10 me-1" data-fa-transform="up-1"></span>Close</button>
                <button class="btn btn-phoenix-primary px-6" type="button" data-bs-target="#kanbanAddTask" data-bs-toggle="modal">Edit<span class="fas fa-edit ms-2" data-fa-transform="shrink-3"></span></button>
            </div>
        </div>
    </div>
</div> -->

<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->

@endsection

@push('script')


@endpush
