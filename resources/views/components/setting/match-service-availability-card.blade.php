<!-- meetings -->

<div class="card mt-4 mb-4">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            {{$slot}}
            <input type="hidden" id="data_type" value="service">
            <div class="mx-2 mb-2">
                <table id="services_availability_table"
                    data-toggle="table"
                    data-classes="table table-hover  fs-9 mb-0 border-top border-translucent"
                    data-loading-template="loadingTemplate"
                    data-url="{{ route('bbs.match.service.availability.list')}}"
                    data-icons-prefix="bx"
                    data-icons="icons"
                    data-show-export="false"
                    data-show-columns-toggle-all="true"
                    data-show-refresh="true"
                    data-total-field="total"
                    data-height="600"
                    data-fixed-scroll="true"
                    data-trim-on-search="false"
                    data-show-toggle="true"
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
                            <!-- <th data-sortable="true" data-field="id" class="align-middle white-space-wrap fw-bold fs-9"><?= get_label('id', 'ID') ?></th> -->
                            <!-- <th data-sortable="false" data-field="image" data-visible="false" class="align-middle"></th> -->
                            <th data-sortable="false" data-field="match" data-visible="true" class="align-middle">Match</th>
                            <th data-sortable="true" data-field="service" class="align-middle review">Service</th>
                            <th data-sortable="true" data-field="group_key" class="align-middle review">Group Key</th>
                            <th data-sortable="true" data-field="max_slots" class="align-middle review">Max Slots</th>
                            <th data-sortable="true" data-field="available_slots" class="align-middle review">Available Slots</th>
                            <th data-sortable="true" data-field="used_slots" class="align-middle review">Used Slots</th>
                            <th data-sortable="true" data-field="reservation_limit" class="align-middle review">Reservation Limit</th>
                            <th data-sortable="true" data-field="created_at" data-visible="false"><?= get_label('created_at', 'Created at') ?></th>
                            <th data-sortable="true" data-field="updated_at" data-visible="false"><?= get_label('updated_at', 'Updated at') ?></th>
                            <th data-formatter="actionsFormatter" class="text-end"><?= get_label('actions', 'Actions') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>