$(document).ready(function () {
    // console.log("all tasksJS file");

    $("#taskFileUploadForm").ajaxForm({
        beforeSend: function () {
            var percentage = "0";
            // console.log(
            //     "File has uploaded: " +
            //         "{{ route('main.task.list',$eventData->id) }}"
            // );
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentage = percentComplete;
            $(".progress .progress-bar").css(
                "width",
                percentage + "%",
                function () {
                    return $(this).attr("aria-valuenow", percentage) + "%";
                }
            );
        },
        complete: function (xhr) {
            // console.log(
            //     "File has uploaded: " +
            //         "{{ route('main.task.list',$eventData->id) }}"
            // );
            // window.location.href =
            //     "{{ route('main.task.list',$eventData->id) }}";
        },
    });

    // add new file to task overview modal
    $(".form-submit-task-new-file").submit(function (event) {
        // alert("inside add note comment");
        var formData = new FormData(this);
        var currentForm = $(this);
        var submit_btn = $(this).find("#add_file_btn");
        var btn_html = submit_btn.html();
        var btn_val = submit_btn.val();
        var tableInput = currentForm.find('input[name="table"]');
        var tableID = tableInput.length ? tableInput.val() : "table";
        var button_text =
            btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;

        // alert("url: " + $(this).attr("action"));

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            beforeSend: function () {
                submit_btn.html(label_please_wait);
                submit_btn.attr("disabled", true);
            },
            // data: formData, //form.serialize(),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            // async: false,
            success: function (result) {
                if (!result["error"]) {
                    // console.log("inside success ajax");
                    // console.log(result);
                    //  events = result;
                    // var modalWithClass = $('.modal.fade.show');
                    submit_btn.html(button_text);
                    submit_btn.attr("disabled", false);

                    html = "";

                    html += '<div class="border-top py-3">';
                    html += '  <div class="me-n3">';
                    html += '    <div class="d-flex flex-between-center">';
                    html +=
                        '       <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>';
                    html +=
                        '         <p class="text-body-highlight mb-0 lh-1"><a href="../../../storage/upload/event_files/' +
                        result["file_name"] +
                        '" target="_blank">' +
                        result["original_file_name"] +
                        "</a></p>";
                    html += " </div>";
                    html +=
                        ' <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>';
                    html +=
                        ' <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item text-danger removeFileDiv" href="#!" id="deletexx"  data-table="task_table" data-id=' +
                        result["task_file_id"] +
                        ">Delete</a></div>";
                    html += "                    </div>";
                    html +=
                        '                    <p class="fs-9 text-body-tertiary mb-1"><span>' +
                        result["file_size"] / 100 +
                        'kb </span><span class="text-body-quaternary mx-1">| </span><a href="#!">' +
                        result["user_name"] +
                        ' </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">' +
                        result["created_at"] +
                        "</span></p>";

                    if (
                        result["file_extension"].toLowerCase() == "jpg" ||
                        result["file_extension"].toLowerCase() == "jpeg" ||
                        result["file_extension"].toLowerCase() == "png"
                    ) {
                        // console.log('file path: '+ result["file_path"])
                        // console.log('file name: '+ result["file_name"])
                        html +=
                            '<a href="' +
                            result["file_path"] +
                            result["file_name"] +
                            '" target="_blank"><img class="rounded-2 img-thumbnail" src="' +
                            result["file_path"] +
                            result["file_name"] +
                            '" alt="" width="200" height="200" /></a>';
                    }

                    html += "                </div>";
                    html += "            </div>";

                    $("#taskTabFiles").append(html);

                    // $(":input", "#form_submit_event_new_note")
                    //     .not(":button, :submit, :reset, :hidden")
                    //     .val("")
                    //     .removeAttr("checked")
                    //     .removeAttr("selected");

                    $(".form-submit-task-new-file")[0].reset();
                    $(".form-submit-task-new-file")[0].classList.remove(
                        "was-validated"
                    );
                    toastr.success(result["message"]);
                    $("#" + tableID).bootstrapTable("refresh");
                } else {
                    submit_btn.html(button_text);
                    submit_btn.attr("disabled", false);
                    toastr.error(result["message"]);
                }
            }, // /success function
            error: function (jqXhr, textStatus, errorMessage) {
                // error callback
                // add spinner to button
                var responseText = jQuery.parseJSON(jqXhr.responseText);
                // console.log(responseText["message"]);
                toastr.error(responseText["message"]);

                // console.log(
                //     "Error: " + jqXhr.responseText + " **** " + errorMessage
                // );
                // console.log(jqXhr.status);
                // console.log(errorMessage);
            }, // /error function // /response
        }); // /ajax
        // alert('id: '+id);
        event.preventDefault();
    });

    // delete task item
    $("body").on("click", "#deleteTaskFile", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert(tableID);
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
                    url: "/tracki/task/file/" + id + "/delete",
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
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
                        console.log(xhr.status);
                        console.log(thrownError);
                    },
                });
            }
        });
    });

});

//*********************************************** */ this is for task attachment modal
$("body").on("click", "#addTaskAttch", function (event) {
    // event.preventDefault();
    var id = $(this).data("id");
    var table = $(this).data("table");
    // console.log("click of addTaskAttch");
    // console.log("id: " + id);
    // $('#staticBackdropLabel').html("Add");

    $("#taskAttachId").val(id);
    $("#taskAttachParentTable").val(table);
    $("#fileupld").val("");

    // $('#submit').val("Edit category");
    $("#addAttachementTaskModal").modal("show");
});

$(function () {
    $("#task_table").bootstrapTable();
});

("use strict");

function queryParams(p) {
    return {
        status: $("#task_status_filter").val(),
        person_id: $("#tasks_person_filter").val(),
        // client_id: $("#tasks_client_filter").val(),
        project_id: $("#tasks_project_filter").val(),
        task_start_date_from: $("#task_start_date_from").val(),
        task_start_date_to: $("#task_start_date_to").val(),
        task_end_date_from: $("#task_end_date_from").val(),
        task_end_date_to: $("#task_end_date_to").val(),
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

function actionsFormatterFiles(value, row, index) {
    return [
        '<button title="' +
            label_delete +
            '" type="button" class="btn delete" data-id=' +
            row.id +
            ' data-table="task_file_table" data-type="tags" id="deleteTaskFile">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            '</button>',
    ];
}

function buttons() {
    return {
        btnUsersAdd: {
            text: "Highlight Users",
            icon: "fa-users",
            event: function () {
                alert(
                    "Do some stuff to e.g. search all users which has logged in the last week"
                );
            },
            attributes: {
                title: "Search all users which has logged in the last week",
            },
        },
        btnAdd: {
            text: "Add new row",
            icon: "fa-plus",
            event: function () {
                alert("Do some stuff to e.g. add a new row");
            },
            attributes: {
                title: "Add a new row to the table",
            },
        },
    };
}

$("#task_status_filter,#tasks_person_filter,#tasks_project_filter").on(
    "change",
    function (e) {
        e.preventDefault();
        $("#task_table").bootstrapTable("refresh");
    }
);
