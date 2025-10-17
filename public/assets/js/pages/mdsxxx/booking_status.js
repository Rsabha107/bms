$(document).ready(function () {
    // console.log("all tasksJS file");

    // ************************************************** task zones

    $("body").on("click", "#editBookinStatus", function () {
        console.log('inside editBookinStatus')
        var id = $(this).data("id");
        var table = $(this).data("table");
        // console.log('edit zones in zones.js');
        // console.log('id: '+id);
        // console.log('table: '+table);
        // var target = document.getElementById("edit_zones_modal");
        // var spinner = new Spinner().spin(target);
        // $("#edit_zones_modal").modal("show");
        $.ajax({
            url: "/mds/setting/status/booking/get/" + id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response)
                $("#edit_booking_status_id").val(response.status.id);
                $("#edit_booking_status_title").val(response.status.title);
                $("#edit_booking_status_color").val(response.status.color);
                $("#edit_booking_status_table").val(table);
                // $("#edit_zones_modal").modal("show");
            },
        }).done(function () {
            $("#edit_booking_status_modal").modal("show");
        });
    });
});

$("body").on("click", "#deleteBookingStatus", function (e) {
    var id = $(this).data("id");
    var tableID = $(this).data("table");
    e.preventDefault();
    // alert('in deleteStatus '+tableID);
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you sure?",
        text: "Delete This Data?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/mds/setting/status/booking/delete/" + id,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                },
                dataType: "json",
                success: function (result) {
                    if (!result["error"]) {
                        toastr.success(result["message"]);
                        $("#" + tableID).bootstrapTable("refresh");
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        //   )
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                },
            });
        }
    });
});

("use strict");
function queryParams(p) {
    return {
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
};

function loadingTemplate(message) {
    return '<i class="bx bx-loader-alt bx-spin bx-flip-vertical" ></i>';
}



function actionsFormatter(value, row, index) {
    return [
        '<a href="javascript:void(0);" class="edit-zones" id="editBookinStatus" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' data-table="booking_status_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" data-table="booking_status_table" class="btn delete" id="deleteBookingStatus" data-id=' +
            row.id +
            ' data-type="status">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}
