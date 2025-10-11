@extends('bbs.admin.layout.template')
@section('main')

<div class="row flex-center min-vh-100 py-5">
    <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-8">
        <div class="card shadow-sm">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-7">
                    <h3 class="text-body-highlight"><a href="#">Create User</a></h3>
                    <p class="text-muted">Create account today</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('sec.adminuser.create') }}" class="forms-sample" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 text-start">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label" for="email">Email address</label>
                        <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label" for="phone">Phone</label>
                        <input class="form-control" id="phone" name="phone" type="phone" placeholder="phone number" value="{{ old('phone') }}" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label" for="photo"><?= get_label('photo', 'photo') ?></label>
                        <input class="form-control" id="profile_image" name="photo" type="file" placeholder="photo">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label"><?= get_label('require_email_verification', 'Require email verification?') ?></label>
                        <div class="btn-group btn-group d-flex justify-content-center">
                            <input type="radio" class="btn-check" id="require_ev_yes" name="require_ev" value="1" checked>
                            <label class="btn btn-outline-primary" for="require_ev_yes"><?= get_label('yes', 'Yes') ?></label>
                            <input type="radio" class="btn-check" id="require_ev_no" name="require_ev" value="0">
                            <label class="btn btn-outline-primary" for="require_ev_no"><?= get_label('no', 'No') ?></label>
                        </div>
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label"><?= get_label('status', 'Status') ?> (<small class="text-muted">If Deactive, user won't be able to log in</small>)</label>
                        <div class="btn-group btn-group d-flex justify-content-center">
                            <input type="radio" class="btn-check" id="user_active" name="status" value="1">
                            <label class="btn btn-outline-primary" for="user_active"><?= get_label('active', 'Active') ?></label>
                            <input type="radio" class="btn-check" id="user_deactive" name="status" value="0" checked>
                            <label class="btn btn-outline-primary" for="user_deactive"><?= get_label('deactive', 'Deactive') ?></label>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="userUser" type="radio" name="usertype" value="user" checked required>
                            <label class="form-check-label" for="userUser">User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="adminUser" type="radio" name="usertype" value="admin" required>
                            <label class="form-check-label" for="adminUser">Admin</label>
                        </div>
                    </div>

                    <div class="col-12 gy-3 mb-3">
                        <label class="form-label">Events (multiple)</label>
                        <select class="form-select js-select-event-assign-multiple" id="add_event_assigned_to" name="event_id[]" multiple data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-12 gy-3 mb-3">
                        <label class="form-label">Venues (multiple)</label>
                        <select class="form-select js-select-venue-assign-multiple" id="add_venue_assigned_to" name="venue_id[]" multiple data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            @foreach ($venues as $venue)
                                <option value="{{ $venue->id }}">{{ $venue->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="col-12 gy-3 mb-3">
                        <label class="form-label">Functional Area (multiple)</label>
                        <select class="form-select js-select-fa-assign-multiple" id="add_fa_assigned_to" name="fa_id[]" multiple data-placeholder="<?= get_label('type_to_search', 'Type to search') ?>">
                            @foreach ($functional_areas as $functional_area)
                                <option value="{{ $functional_area->id }}">{{ $functional_area->title }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="row g-3 mb-3">
                        <div class="col-xl-6">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control form-icon-input" name="password" id="password" type="password" placeholder="Password" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input class="form-control form-icon-input" name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-9 mb-3">
                        @foreach ($roles as $item)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="inlineCheckbox{{ $item->id }}" type="checkbox" name="roles[]" value="{{ $item->id }}">
                                <label class="form-check-label" for="inlineCheckbox{{ $item->id }}">{{ $item->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button class="btn btn-primary w-100 mb-3" type="submit">Create now</button>
                    <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('sec.adminuser.list') }}">Go back to list</a></div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="{{ asset('assets/js/pages/sec/users.js') }}"></script>
@endpush
