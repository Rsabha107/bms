<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementing Yajra Datatables in Laravel 10</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel='stylesheet' href="{{ asset ('assets/vendors/bootstrap-5.2.3-dist/css/bootstrap.min.css')}}">
    <link rel='stylesheet' href="{{ asset ('assets/datatables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css')}}">
    <link rel='stylesheet' href="{{ asset ('assets/datatables/Responsive-2.5.0/css/responsive.bootstrap5.min.css')}}">
    <link rel='stylesheet' href="{{ asset ('assets/datatables/Buttons-2.4.2/css/buttons.bootstrap5.min.css')}}"> -->

    <!-- <script src="{{ asset('assets/jquery/dist/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('assets/jquery/validation/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/datatables/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('assets/vendors/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/datatables/DataTables-1.13.8/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/datatables/JSZip-3.10.1/jszip.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.colVis.min.js')}}"></script> -->

    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel='stylesheet' href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
    <link rel='stylesheet' href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.bootstrap5.css">
    <link rel='stylesheet' href="{{ asset ('assets/css/custom/datatable_custom.css')}}">


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.bootstrap5.js"></script>

    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/datatables/JSZip-3.10.1/jszip.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.colVis.min.js')}}"></script>

    <!-- <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> -->

</head>

<body>
    <div class="dt-container">
        <h1>Implementing Yajra Datatables in Laravel 10</h1>
        <table class="table data-table table-hover" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Reference</th>
                    <th>receiver</th>
                    <th>booking_date</th>
                    <th>venue</th>
                    <th width="105px">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(function() {
            gb_DataTable = $(".data-table").DataTable({
                autoWidth: true,
                order: [0, "ASC"],
                pagingType: 'simple_numbers',
                processing: true,
                serverSide: true,
                // searchDelay: 2000,
                paging: true,
                scrollX: true,
                ajax: "{{ route('mds.booking.test') }}",
                // iDisplayLength: "25",
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'colvis',
                //     {
                //         text: 'Reload',
                //         action: function(e, dt, node, config) {
                //             dt.ajax.reload();
                //         }
                //     }
                // ],
                // buttons: [
                //     'pageLength',
                //     {
                //         extend: 'copy',
                //         className: 'btn btn-primary btn-sm'
                //     },
                //     {
                //         extend: 'excel',
                //         className: 'btn btn-primary btn-sm'
                //     },
                //     {
                //         text: 'Reload',
                //         className: 'btn btn-primary btn-sm',
                //         action: function(e, dt, node, config) {
                //             dt.ajax.reload();
                //         }
                //     },
                //     {
                //         extend: 'colvis',
                //         className: 'btn btn-primary btn-sm'
                //     },
                // ],
                layout: {
                    topStart: {
                        buttons: [
                            'pageLength',
                            {
                                extend: 'csv',
                                split: ['pdf', 'excel', 'colvis', ]
                            },


                            {
                                text: 'Reload',
                                className: 'btn btn-primary btn-sm',
                                action: function(e, dt, node, config) {
                                    dt.ajax.reload();
                                }
                            },
                        ]
                    },
                    // topEnd: {
                    //     search: {
                    //         placeholder: 'Type search here'
                    //     }
                    // },
                    // bottomEnd: 'paging',
                },
                columns: [{
                        visible: false,
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'booking_ref_number',
                        name: 'booking_ref_number'
                    },
                    {
                        data: 'receiver_name',
                        name: 'receiver_name'
                    },
                    {
                        data: 'booking_date',
                        name: 'booking_date'
                    },
                    {
                        data: 'venue_id',
                        name: 'venue_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                lengthMenu: [5, 10, 25, 50, {
                    label: 'All',
                    value: -1
                }],
            });
        });
    </script>
</body>

</html>
