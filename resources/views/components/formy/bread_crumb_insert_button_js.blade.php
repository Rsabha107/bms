<div class="d-flex justify-content-between m-2">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $activeBread }}</li>
                </ol>
            </nav>
        </div>
        <div>
        <x-formy.button_insert_js title="{{ $title }}" selectionId="{{ $selectionId }}" dataId="0" table="services_table" />
        </div>
    </div>

    <div class="d-flex justify-content-center mb-3">
        <div id="cover-spin" style="display:none;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>