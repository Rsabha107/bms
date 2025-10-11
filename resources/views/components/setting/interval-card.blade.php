<!-- meetings -->

<!-- <div class="card mt-4">
    <div class="card-body"> -->
        <div class="table-responsive text-nowrap">
            {{$slot}}
            @if (is_countable($intervals) && count($intervals) > 0)
            <input type="hidden" id="data_type" value="interval">
            <div class="mx-2 mb-2">
                <table  id="intervals_table"
                        data-toggle="table"
                        data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                        data-loading-template="loadingTemplate"
                        data-url="{{ route('mds.setting.interval.list', $schedule->id)}}"
                        data-icons-prefix="bx"
                        data-icons="icons"
                        data-show-export="true"
                        data-show-columns-toggle-all="true"
                        data-show-refresh="true"
                        data-total-field="total"
                        data-trim-on-search="false"
                        data-data-field="rows"
                        data-page-list="[5, 10, 20, 50, 100, 200]"
                        data-search="true"
                        data-side-pagination="server"
                        data-show-columns="true"
                        data-pagination="true"
                        data-sort-name="id"
                        data-sort-order="asc"
                        data-mobile-responsive="true"
                        data-buttons-class="secondary"
                        data-query-params="queryParams">
                    <thead>
                        <tr>
                        <!-- <th data-checkbox="true"></th> -->
                        <th data-sortable="true" data-field="id" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('id', 'ID') ?></th>
                        <th data-sortable="true" data-field="period_date" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('period_date', 'Date') ?></th>
                        <th data-sortable="true" data-field="period" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('period', 'Period') ?></th>
                        <th data-sortable="true" data-field="venue" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('venue', 'Venue') ?></th>
                        <th data-sortable="true" data-field="max_slots" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('max_slot', 'Max Slots') ?></th>
                        <th data-sortable="true" data-field="available_slots" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('available_slot', 'Available Slots') ?></th>
                        <th data-sortable="true" data-field="used_slots" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('used_slot', 'Used Slots') ?></th>
                        <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                        <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                        <th data-formatter="actionsFormatter" class="text-end"><?= get_label('actions', 'Actions') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            @else
            <?php
            $type = 'Intervals'; ?>
            <x-empty-state-card :type="$type" />
            @endif
        </div>
    <!-- </div>
</div> -->
