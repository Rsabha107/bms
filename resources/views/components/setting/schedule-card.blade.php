<!-- meetings -->

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="schedule">
            <div class="mx-2 mb-2">
                <table id="schedules_table"
                    data-toggle="table"
                    data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                    data-loading-template="loadingTemplate"
                    data-url="{{ route('mds.setting.schedule.list')}}"
                    data-icons-prefix="bx"
                    data-icons="icons"
                    data-show-export="true"
                    data-export-data-type='all'
                    data-show-columns-toggle-all="true"
                    data-show-refresh="true"
                    data-show-toggle="true"
                    data-total-field="total"
                    data-trim-on-search="false"
                    data-data-field="rows"
                    data-page-list="[5, 10, 20, 50, 100, all]"
                    data-search="true"
                    data-side-pagination="server"
                    data-show-columns="true"
                    data-pagination="true"
                    data-sort-name="id"
                    data-sort-order="asc"
                    data-mobile-responsive="true"
                    data-buttons-class="secondary"
                    data-query-params="mdsScheduleQueryParams">
                    <thead>
                        <tr>
                            <!-- <th data-checkbox="true"></th> -->
                            <!-- <th data-sortable="true" data-field="id" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('id', 'ID') ?></th> -->
                            <th data-sortable="true" data-field="event">Event</th>
                            <th data-sortable="true" data-field="venue">Venue</th>
                            <th data-sortable="true" data-field="booking_date">Booking Date</th>
                            <th data-sortable="true" data-field="rsp_booking_slot">RSP Booking Slot</th>
                            <th data-sortable="true" data-field="venue_arrival_time">Venue Arrival Time</th>
                            <th data-sortable="true" data-field="bookings_slots_all">Booking Slots (ALL)</th>
                            <th data-sortable="true" data-field="available_slots">Available Slots</th>
                            <th data-sortable="true" data-field="used_slots">Used Slots</th>
                            <th data-sortable="true" data-field="bookings_slots_cat">Booking Slots (CAT)</th>
                            <th data-sortable="true" data-field="slot_visibility">Slot Visibility</th>
                            <th data-sortable="true" data-field="rsp_id">RSP</th>
                            <th data-sortable="true" data-field="match_day">Match Day</th>
                            <th data-sortable="true" data-field="comments">Comments</th>
                            <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                            <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                            <th data-sortable="false" data-field="actions" data-visible="true"  class="text-end">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    ("use strict");

    function mdsScheduleQueryParams(p) {
        return {
            mds_schedule_event_filter: $("#mds_schedule_event_filter").val(),
            mds_schedule_venue_filter: $("#mds_schedule_venue_filter").val(),
            mds_schedule_rsp_filter: $("#mds_schedule_rsp_filter").val(),
            mds_date_range_filter: $("#mds_date_range_filter").val(),
            page: p.offset / p.limit + 1,
            limit: p.limit,
            sort: p.sort,
            order: p.order,
            offset: p.offset,
            search: p.search,
        };
    }
    window.icons = {
        refresh: "bx-refresh",
        toggleOn: "bx-toggle-right",
        toggleOff: "bx-toggle-left",
        fullscreen: "bx-fullscreen",
        columns: "bx-list-ul",
        export_data: "bx-list-ul",
        paginationSwitch: "bx-list-ul",
    };

    function loadingTemplate(message) {
        return '<i class="bx bx-loader-circle bx-spin bx-flip-vertical" ></i>';
    }

    $("#mds_schedule_event_filter,#mds_schedule_venue_filter,#mds_schedule_rsp_filter,#mds_date_range_filter").on("change", function(e) {
        e.preventDefault();
        console.log("tasks.js on change");
        $("#schedules_table").bootstrapTable("refresh");
    });
</script>