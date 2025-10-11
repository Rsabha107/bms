$(document).ready(function () {
    // console.log("all tasksJS file");

    // ************************************************** task address_type

    $("body").on("click", "#editAddress_type", function () {
        var id = $(this).data("id");
        var table = $(this).data("table");
        // console.log('edit address_type in address_type.js');
        // console.log('id: '+id);
        // console.log('table: '+table);
        // var target = document.getElementById("edit_address_type_modal");
        // var spinner = new Spinner().spin(target);
        // $("#edit_address_type_modal").modal("show");
        $.ajax({
            url: "/tracki/setup/address_type/" + id + "/get",
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                $("#address_type_id").val(response.address_type.id);
                $("#address_type_name").val(response.address_type.name);
                $("#edit_address_type_table").val(table);
                $("#address_type_active_flag").val(response.address_type.active_flag);
                $("#edit_address_type_modal").modal("show");
            },
        }).done(function(){
            // $("#edit_address_type_modal").modal("show");
        });
    });


    $("body").on("click", "#deleteAddress_type", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert('in deleteAddress_type '+tableID);
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
                    url: "/tracki/setup/address_type/delete/" + id,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                    },
                    dataType: "json",
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            // divToRemove.remove();
                            // $("#fileCount").html("File ("+result["count"]+")");
                            $("#" + tableID).bootstrapTable("refresh");
                            // Swal.fire(
                            //     'Deleted!',
                            //     'Your file has been deleted.',
                            //     'success'
                            //   )
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.address_type);
                        console.log(thrownError);
                    },
                });
            }
        });
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
        '<a href="javascript:void(0);" class="edit-address_type" id="editAddress_type" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' data-table="address_type_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" data-table="address_type_table" class="btn delete" id="deleteAddress_type" data-id=' +
            row.id +
            ' data-type="address_type">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}
