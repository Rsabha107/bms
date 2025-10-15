<script src="{{ asset('fnx/assets/js/phoenix.js') }}"></script>
<script>
    $(".js-select-event-assign-multiple-add_fa_id").select2({
        closeOnSelect: false,
        placeholder: "Select ...",
    });
</script>

<div class="row mb-3">
    <div class="col-sm-6 col-md-12">
        <label class="form-label" for="add_venue_id">Functional Area</label>
        <select class="form-select js-select-event-assign-multiple-add_fa_id"
            id="add_fa_id" name="venue_id[]" multiple="multiple" data-with="100%"
            data-placeholder="Select Fuctional Area...">
            <!-- <select name="assignment_to_id[]" class="form-select" data-choices="data-choices" size="1" multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}' id="floatingSelectRating" required> -->
            @foreach ($functional_areas as $item)
            <option value="{{ $item->id }}">
                {{ $item->title }}
            </option>
            @endforeach
        </select>
    </div>
</div>