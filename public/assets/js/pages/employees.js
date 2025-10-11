function refreshEmpEdit(val) {
    var g_response;
    // alert('refreshTaskNotes')
    $.ajax({
        url: "/tracki/employee/mv/edit" + val,
        method: "GET",
        async: false,
        success: function (response) {
            g_response = response.view;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });

    // console.log('return: '+g_response);
    return g_response;
}

function checkModelOpen(e) {
    if (Element.data("bs.modal").isShown) {
        return true;
    }

    return false;
}

function convertToJson() {
    let personalForm = document.getElementById("personalForm");
    let basicForm = document.getElementById("basicForm");
    let addressForm = document.getElementById("addressForm");
    var myFile = document.getElementById("profile_image_name");
    var files = myFile.files;
    var file = files[0];

    console.log("personalForm: " + personalForm);
    console.log("myFile: " + myFile);
    console.log("files: " + files);
    console.log("file: " + file);

    let formData = {};
    let formData1 = new FormData();
    for (let i = 0; i < basicForm.elements.length; i++) {
        let element = basicForm.elements[i];
        // console.log('element name: '+element.name)
        if (element.type !== "submit") {
            if (element.type == "file" && element.value.length) {
                formData1.append(element.name, file, file.name);
            } else {
                formData1.append(element.name, element.value);
            }
            formData[element.name] = element.value;
        }
    }

    for (let i = 0; i < personalForm.elements.length; i++) {
        let element = personalForm.elements[i];
        // console.log('element name: '+element.name)
        if (element.type !== "submit") {
            if (element.type == "file" && element.value.length) {
                formData1.append(element.name, file, file.name);
            } else {
                formData1.append(element.name, element.value);
            }
            formData[element.name] = element.value;
        }
    }

    for (let i = 0; i < addressForm.elements.length; i++) {
        let element = addressForm.elements[i];
        // console.log('element name: '+element.name)
        if (element.type !== "submit") {
            if (element.type == "file" && element.value.length) {
                formData1.append(element.name, file, file.name);
            } else {
                formData1.append(element.name, element.value);
            }
            formData[element.name] = element.value;
        }
    }

    // Display the key/value pairs
    for (var pair of formData1.entries()) {
        console.log(pair[0] + ", " + pair[1]);
    }
    // let form2 = document.getElementById("form-2");
    // console.log('form: '+form2)
    // let formData2 = {};
    // // let formData = {};
    // for (let i = 0; i < form2.elements.length; i++) {
    //     let element = form2.elements[i];
    //     console.log('element name: '+element.name)
    //     if (element.type !== "submit") {
    //         formData2[element.name] = element.value;
    //     }
    // }

    // let form3 = document.getElementById("form-3");
    // console.log('form: '+form3)
    // let formData3 = {};
    // for (let i = 0; i < form3.elements.length; i++) {
    //     let element = form3.elements[i];
    //     console.log('element name: '+element.name)
    //     if (element.type !== "submit") {
    //         formData3[element.name] = element.value;
    //     }
    // }

    // let jsonData = formData;
    // let jsonData2 = formData2;
    // let jsonData3 = formData3;
    // let jsonOutput = document.getElementById("jsonOutput");

    console.log(formData);
    // console.log(jsonData2);
    // console.log(jsonData3);

    $.ajax({
        url: "/tracki/employee/store",
        type: "POST",
        dataType: "json",
        data: formData1,
        contentType: false,
        processData: false,
        // headers: {
        //     "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"),
        // },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        async: false,
        success: function (response) {
            console.log(response);
            toastr.success(response["message"]);
            // $('#smartwizard').smartWizard("reset");

            // Reset form
            // document.getElementById("form-1").reset();
            // document.getElementById("form-2").reset();
            // document.getElementById("form-3").reset();
            // document.getElementById("form-4").reset();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });

    // jsonOutput.innerHTML = "<pre>" + jsonData + "</pre>";
}

$(document).ready(function () {
    // console.log("all tasksJS file");

    $(document).on("show.bs.modal", ".modal", function (event) {
        // alert('on show.bs.modal')
        var zIndex = 1040 + 10 * $(".modal:visible").length;
        $(this).css("z-index", zIndex);
        setTimeout(function () {
            $(".modal-backdrop")
                .not(".modal-stack")
                .css("z-index", zIndex - 1)
                .addClass("modal-stack");
        }, 0);
    });

    $(".js-example-basic-multiple").select2();

    // $(function () {
    //     console.log('tooltip')
    //     $('[data-bs-toggle="tooltip"]').tooltip()
    //   })

    $("body").on("click", "#store_employee", function () {
        console.log("inside #store_employee");
        $("#cover-spin").show();
        convertToJson();
        $("#cover-spin").hide();
    });

    $("body").on("click", "#add_employee", function () {
        console.log("inside #add_employee");
        $("#cover-spin").show();
        // reset all values
        // $("#add_employee_form")[0].reset();
        // $("#add_employee_form")[0].classList.remove("was-validated");
        // var table = $(this).data("table");
        // var action = $(this).data("action");

        // var form_action = "/tracki/task/" + action;
        // set the form action with the source var
        // $("#add_task_form").attr("action", form_action);
        // $("#add_employee_table_h").val(table);
        // $("#add_employee_modal_label").html("Add new employee");
        $("#add_employee_modal").modal("show");
        $("#cover-spin").hide();
    });

    $("body").on("click", "#edit_employee", function () {
        $("#cover-spin").show();
        console.log("inside #edit_employee");
        // console.log("source: " + x_source);
        // console.log($("#edit_employee").data("id"));
        // reset all values

        // $("#taskTabNotes").empty("").append(refreshEmpEdit(taskID));
        id = $(this).data("id");
        console.log("employee_id: " + id);

        $.ajax({
            url: "/tracki/employee/mv/edit/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                g_response = response.view;
                $("#employeeEditView").empty("").append(g_response);
                $("#edit_employee_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            },
        });
    });

    // ************************************************** task status
    $("body").on("click", "#editTaskStatus", function (event) {
        // console.log("inside sec click edit");
        // event.preventDefault();
        var id = $(this).data("id");
        var table = $(this).data("table");
        // var route = $(this).data("route");
        // console.log("id: " + id);
        // console.log("table: " + table);

        $.get("/tracki/task/status/" + id + "/edit", function (data) {
            //  console.log('event name: ' + data);
            $.each(data, function (index, value) {
                // console.log(value[0]);
                $("#editTaskId").val(value[0].id);
                $("#editTaskEventId").val(value[0].event_id);
                $("#editTaskStatusSelection").val(value[0].status_id);
                $("#taskStatusParentTable").val(table);
                $("#taskStatusModal").modal("show");
            });

            // $('#staticBackdropLabel').html("Edit category");
            // $('#submit').val("Edit category");
        });
    });

    $("#fileUploadForm").ajaxForm({
        beforeSend: function () {
            var percentage = "0";
            console.log(
                "File has uploaded: " +
                    "{{ route('tracki.task.list',$eventData->id) }}"
            );
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
            console.log(
                "File has uploaded: " +
                    "{{ route('tracki.task.list',$eventData->id) }}"
            );
            // window.location.href =
            //     "{{ route('tracki.task.list',$eventData->id) }}";
        },
    });

    $("#taskFileUploadForm").ajaxForm({
        beforeSend: function () {
            var percentage = "0";
            // console.log(
            //     "File has uploaded: " +
            //         "{{ route('tracki.task.list',$eventData->id) }}"
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
            //         "{{ route('tracki.task.list',$eventData->id) }}"
            // );
            // window.location.href =
            //     "{{ route('tracki.task.list',$eventData->id) }}";
        },
    });

    // delete task item
    $("body").on("click", "#deleteEmployee", function (e) {
        var id = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert("tableID: "+tableID);
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
                    url: "/tracki/employee/" + id + "/delete",
                    method: "GET",
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            // divToRemove.remove();
                            // $("#fileCount").html("File ("+result["count"]+")");
                            // console.log('before table refrest for #'+tableID);
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

    $("body").on("click", ".removeNoteDiv", function (e) {
        e.preventDefault();
        var taskNoteId = $(this).data("id");
        var tableID = $(this).data("table");
        var divToRemove = $(this)
            .parent("div")
            .parent("div")
            .parent("div")
            .parent("div");
        e.preventDefault();
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
                    url: "/tracki/task/note/" + taskNoteId + "/delete",
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            divToRemove.remove();
                            // $("#fileCount").html(
                            //     "File (" + result["count"] + ")"
                            // );
                            $("#" + tableID).bootstrapTable("refresh");
                            // for delete confirmation uncomment below
                            // Swal.fire(
                            //     "Deleted!",
                            //     "Your file has been deleted.",
                            //     "success"
                            // );
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
    // delete single file
    $("body").on("click", ".removeFileDiv", function (e) {
        e.preventDefault();
        var taskFileId = $(this).data("id");
        var tableID = $(this).data("table");
        var divToRemove = $(this)
            .parent("div")
            .parent("div")
            .parent("div")
            .parent("div");
        e.preventDefault();
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
                    url: "/tracki/task/file/" + taskFileId + "/delete",
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (result) {
                        if (!result["error"]) {
                            toastr.success(result["message"]);
                            divToRemove.remove();
                            // $("#fileCount").html(
                            //     "File (" + result["count"] + ")"
                            // );
                            // $("#" + tableID).bootstrapTable("refresh");
                            // Swal.fire(
                            //     "Deleted!",
                            //     "Your file has been deleted.",
                            //     "success"
                            // );
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

$("body").on("click", "#activity-tab", function (event) {
    // alert('in activity-tab')
    $("#task_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

$("body").on("click", "#task-note-tab", function (event) {
    // alert('in activity-tab')
    $(".spinner-border").show();
    // $("#task_table").bootstrapTable("refresh");
    tab_value = $("#task-note-tab").data("taskid");
    // $("#taskTabNotes").empty("").append(refreshTaskNotes(tab_value));

    $.ajax({
        url: "/tracki/task/notes/" + tab_value,
        method: "GET",
        async: true,
        success: function (response) {
            g_response = response.view;
            $("#taskTabNotes").empty("").append(g_response);
            $(".spinner-border").hide();
        },

        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
        // $('#firstModal').modal('toggle');
    });
});

$("body").on("click", "#task-subtask-tab", function (event) {
    // alert('in activity-tab')
    $(".spinner-border").show();
    // $("#task_table").bootstrapTable("refresh");
    tab_value = $("#task-note-tab").data("taskid");
    // $("#taskTabNotes").empty("").append(refreshTaskNotes(tab_value));

    $.ajax({
        url: "/tracki/task/subtask/" + tab_value,
        method: "GET",
        async: true,
        success: function (response) {
            g_response = response.view;
            $("#taskTabSub").empty("").append(g_response);
            $(".spinner-border").hide();
        },

        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },

        // $('#firstModal').modal('toggle');
    });
});

$("body").on("click", "#task-file-tab", function (event) {
    // alert('in activity-tab')
    $(".spinner-border").show();
    // $("#task_table").bootstrapTable("refresh");
    tab_value = $("#task-note-tab").data("taskid");
    // $("#taskTabNotes").empty("").append(refreshTaskNotes(tab_value));

    $.ajax({
        url: "/tracki/task/files/" + tab_value,
        method: "GET",
        async: true,
        success: function (response) {
            g_response = response.view;
            $("#taskTabFiles").empty("").append(g_response);
            $(".spinner-border").hide();
        },

        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },

        // $('#firstModal').modal('toggle');
    });
});

$("body").on("click", "#taskCardView", function (event) {
    // event.preventDefault();
    var taskId = $(this).data("id");
    console.log("click of taskCardView");
    // console.log("task id: " + taskId);

    $("#task-note-tab").data("taskid", taskId);
    $("#edit_task").data("id", taskId);
    $tab_value = $("#task-note-tab").data("taskid");
    $edit_task_id = $("#edit_task").data("id");

    // alert($edit_task_id)

    $.ajax({
        url: "/tracki/task/" + taskId + "/overview",
        method: "GET",
        success: function (response) {
            console.log(response);
            html = "";
            html1 = "";

            // get the task information
            $.each(response.data.data, function (index, value) {
                console.log("index: " + index);
                // if (index == "data") {
                // console.log("inside the data array");
                // console.log(value);
                // for (const project_task of value.data) {
                // console.log(`${value.name} : ${value.id}°C`);
                workspace_html =
                    '<span class="badge badge-phoenix badge-phoenix-warning me-2" id="overviewtaskWorkspace">' +
                    value.workspace +
                    "</span>";
                $("#overviewtaskTitle").html(value.name);

                $("#overviewProjectName").html(value.project_title);
                $("#overviewtaskStatus").html(
                    '<span class="badge badge-phoenix badge-phoenix-' +
                        value.status_color +
                        ' me-2" id="overviewtaskStatus">' +
                        value.status_name +
                        "</span>"
                );
                $("#overviewtaskWorkspace").html(
                    '<span class="badge badge-phoenix badge-phoenix-warning me-2" id="overviewtaskWorkspace">' +
                        value.workspace +
                        "</span>"
                );
                $("#overviewtaskProgress").html(value.progress * 100 + "%");
                $("#overviewtaskProgressStyle").css({
                    width: value.progress * 100 + "%",
                });
                console.log(value.start_date);
                $("#overviewtaskStartDate").html(value.start_date);
                $("#overviewtaskDueDate").html(value.due_date);
                // $("#overviewtaskDueDate").prop("value", value.due_date);
                $("#overviewtaskDescription").html(value.description);
                $("#overviewtaskAllocatedBudget").html(value.budget_allocation);
                $("#overviewtaskActualBudget").html(
                    value.actual_budget_allocated
                );
                $("#overviewtaskDepartment").html(value.department_name);
                // $("#overviewtaskAllocatedBudget").html(
                //     '<span class="me-2 fa-solid fa-dollar text-success"></span>' +
                //         value.budget_allocation
                // );
                // $("#overviewtaskActualBudget").html(
                //     '<span class="me-2 fa-solid fa-donate text-primary"></span>' +
                //         value.actual_budget_allocated
                // );
                // $("#overviewtaskDepartment").html(
                //     '<span class="me-2 fa-solid fa-building text-primary"></span>' +
                //         value.department_name
                // );
            });

            // lets get the assinged_to names
            $.each(response.data.data, function (index, value) {
                console.log("index: " + index);
                // if (index == "data") {
                // console.log("inside the assigned_to array");
                // console.log(value);
                // for (const project_task of value.data) {
                // console.log(`${value.name} : ${value.id}°C`);

                for (const asg of value.assigned_to) {
                    initname = getNameItials(asg.name);
                    console.log("init initname: " + initname);
                    console.log("name: " + asg.name);
                    console.log("id: " + asg.id);

                    html +=
                        '<a href="/tracki/users/' +
                        asg.id +
                        '/details" title="' +
                        asg.name +
                        '" role="button"> <div class="avatar avatar-m pull-up me-1">';
                    html +=
                        '<div class="avatar-name rounded-circle me-2" title="' +
                        asg.name +
                        '"><span>' +
                        initname +
                        "</span></div>";
                    html += "</div></a>";
                }
                $("#overviewtaskAssignees").empty("").append(html);

                //   }

                // }
            });

            $.ajax({
                url: "/tracki/task/notes/" + taskId,
                method: "GET",
                async: true,
                success: function (response) {
                    g_response = response.view;
                    $("#taskTabNotes").empty("").append(g_response);
                    $(".spinner-border").hide();
                },
            });

            $.ajax({
                url: "/tracki/task/subtask/" + taskId,
                method: "GET",
                async: true,
                success: function (response) {
                    g_response = response.view;
                    $("#taskTabSub").empty("").append(g_response);
                    $(".spinner-border").hide();
                },
            });

            $.ajax({
                url: "/tracki/task/files/" + taskId,
                method: "GET",
                async: true,
                success: function (response) {
                    g_response = response.view;
                    $("#taskTabFiles").empty("").append(g_response);
                    $(".spinner-border").hide();
                },
            });

            // $("#taskTabNotes").empty("").append(refreshTaskNotes(taskId));
            // $("#taskTabSub").empty("").append(refreshTaskSubtask(taskId));
            $("#collapse_task_subtask").addClass("collapsed");

            // lets get the subtasks
            $.each(response.data.data, function (index, value) {
                // console.log("subtasks index: " + index);
                // // if (index == "data") {
                // console.log("inside the subtasks array");
                // console.log(value.subtasks);
                // console.log(value.subtasks.length);
                html = "";
                html1 = "";

                $("#subTaskCount").html(
                    "Subtasks (" + value.subtasks.length + ")"
                );
            });

            // lets get the files
            $.each(response.data.data, function (index, value) {
                console.log("in files ....");
                console.log("files index: " + index);
                // // if (index == "data") {
                console.log("inside the files array");
                console.log(value.files);
                console.log(value.files.length);
                html = "";
                html1 = "";

                $("#fileCount").html("File (" + value.files.length + ")");

                for (const files of value.files) {
                    // console.log(`${notes.note_text} : ${notes.id}°C`);
                    html += '<div class="border-top py-3">';
                    html += '  <div class="me-n3">';
                    html += '    <div class="d-flex flex-between-center">';
                    html +=
                        '       <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>';
                    html +=
                        '         <p class="text-body-highlight mb-0 lh-1"><a href="../../../storage/upload/event_files/' +
                        files.file_name +
                        '" target="_blank">' +
                        files.original_file_name +
                        "</a></p>";
                    html += "</div>";
                    html +=
                        ' <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>';
                    html +=
                        ' <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item text-danger removeFileDiv" href="#!" data-table="task_table" data-id=' +
                        files.id +
                        ' id="deletexxs">Delete</a></div>';
                    html += " </div>";
                    html +=
                        ' <p class="fs-9 text-body-tertiary mb-1"><span>' +
                        files.file_size / 100 +
                        'kb </span><span class="text-body-quaternary mx-1">| </span><a href="#!">' +
                        files.user_name +
                        ' </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">' +
                        moment(files.created_at).format("DD-MM-YYYY") +
                        "</span></p>";

                    if (
                        files.file_extension.toLowerCase() == "jpg" ||
                        files.file_extension.toLowerCase() == "jpeg" ||
                        files.file_extension.toLowerCase() == "png"
                    ) {
                        // console.log('file path: '+ files.file_path)
                        // console.log('file path: '+ files.file_name)
                        html +=
                            '<a href="' +
                            files.file_path +
                            files.file_name +
                            '" target="_blank"><img class="rounded-2 img-thumbnail" src="' +
                            files.file_path +
                            files.file_name +
                            '" alt="" width="200" height="200" /></a>';
                    }
                    html += "                </div>";
                    html += "            </div>";
                }

                $.ajax({
                    url: "/tracki/task/files/" + taskId,
                    method: "GET",
                    async: true,
                    success: function (response) {
                        g_response = response.view;
                        $("#taskTabFiles").empty("").append(g_response);
                        $(".spinner-border").hide();
                    },
                });

                $("#taskTabFiles").empty("").append(html);
            });

            console.log("taskCardView taskId: " + taskId);
            $("#note_parent_task_id_overview").val(taskId);
            $("#subtask_parent_task_id_overview").val(taskId);
            $("#file_parent_task_id_overview").val(taskId);
            $("#taskCardViewModal").modal("show");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }, //tr += '<option value="'+value[0]+'">'+value[1]+'</option>';
    });
});

//*********************************************** */ this is for create subtask modal
$("body").on("click", "#addSubtask", function (event) {
    // event.preventDefault();
    var id = $(this).data("id");
    var table = $(this).data("table");
    // console.log("click of addSubtask");
    // console.log("id: " + id);
    // $('#staticBackdropLabel').html("Add");

    $("#subtask_parent_task_id").val(id);

    // $('#submit').val("Edit category");
    $("#createSubTaskModal").modal("show");
});

//*********************************************** */ this is for show file attachment block
$("body").on("click", "#add_subtask_btn", function (event) {
    $("#add_subtask_block").toggle("slow");
});

//*********************************************** */ this is for show file attachment block
$("body").on("click", "#add_file_btn", function (event) {
    $("#upload_file_block").toggle("slow");
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

//*********************************************** */ this is for task attachment modal
$("body").on("click", "#addTaskNote", function (event) {
    // event.preventDefault();
    var id = $(this).data("id");
    var table = $(this).data("table");

    // alert("click of addTaskAttch");
    // alert("id: " + id);
    // alert("table: " + table);
    // $('#staticBackdropLabel').html("Add");

    $("#taskNoteId").val(id);
    $("#taskNoteParentTable").val(table);
    $("#notes").val("");

    // $('#submit').val("Edit category");
    $("#addTaskNoteModal").modal("show");
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
        department_id: $("#tasks_department_filter").val(),
        show_page: $("#tasks_show_page_hidden").val(),
        show_page_id: $("#tasks_show_page_id_hidden").val(),
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

function actionsFormatter(value, row, index) {
    return [
        '<a href="javascript:void(0);" class="edit-tag" data-bs-toggle="modal" data-bs-target="#edit_tag_modal" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" class="btn delete" data-id=' +
            row.id +
            ' data-type="tags">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}

function TaskUserFormatter(value, row, index) {
    // console.log('inside TaskUserFormatter: '+ row.assigned_to)
    var assigned_to =
        Array.isArray(row.assigned_to) && row.assigned_to.length
            ? row.assigned_to
            : '<span class="badge bg-primary">' +
              label_not_assigned +
              "</span>";
    if (Array.isArray(assigned_to)) {
        assigned_to = assigned_to.map((user) => "<li>" + user + "</li>");
        return (
            '<ul class="list-unstyled assigned_to-list m-0 avatar-group d-flex align-items-center">' +
            assigned_to.join("") +
            "</ul>"
        );
    } else {
        return assigned_to;
    }
}

function attributeFormatter(value, row, index) {
    return [
        '<a href="javascript:void(0);" class="edit-tag" data-bs-toggle="modal" data-bs-target="#edit_tag_modal" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            "<button title=" +
            label_delete +
            ' type="button" class="btn delete" data-id=' +
            row.id +
            ' data-type="tags">' +
            '<i class="bx bx-trash text-danger mx-1"></i>' +
            "</button>",
    ];
}

function actions2Formatter(value, row, index) {
    console.log("employees.js inside actions2Formatter");
    html = "";
    html =
        html +
        '<div class="font-sans-serif btn-reveal-trigger position-static">' +
        '<a href="/tracki/employee/profile/'+row.id+'" class="btn btn-sm" id="employeeCardView" data-id="' +
        row.id +
        '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
        label_view +
        '">' +
        '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';

    if (can_edit) {
        // html =
        //     '<div class="font-sans-serif btn-reveal-trigger position-static">' +
        //     '<a href="/tracki/employee/' +
        //     row.id +
        //     '/edit" class="btn btn-sm" id="editX" data-route="category" data-id="">' +
        //     '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        html =
            html +
            // '<div class="font-sans-serif btn-reveal-trigger position-static">' +
            '<a href="javascript:void(0)" class="btn btn-sm" id="edit_employee" data-action="update" " data-type="edit" data-id="' +
            row.id +
            '" data-table="employee_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_update +
            '">' +
            '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        // html ='<a href="javascript:voice(0)" id="edit_employee" data-id ="'+ row.id +'"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="'+ label_update +'"><i class="bx bx-plus"></i></button></a>'
    }
    if (can_delete) {
        html =
            html +
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="employee_table" data-id="' +
            row.id +
            '" id="deleteEmployee" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_delete +
            '">' +
            '<i class="bx bx-trash text-danger"></i></a>';
    }
    html =
        html +
        '<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>' +
        '<div class="dropdown-menu dropdown-menu-end py-2">';
    if (can_edit) {
        html =
            html +
            '<a class="dropdown-item" href="employee/address/'+ row.id +'"  data-id="' +
            row.id +
            '" data-table="employee_table" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-plus text-primary me-1" ></i>Address</a>';
    }

    html =
        html +
        '<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#employeeStatusModal" id="editemployeeStatus" data-id="' +
        row.id +
        '" data-table="employee_table" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-percent text-primary me-1" ></i>Change Status</a>' +
        '<a href="#!" id="addemployeeNote" data-table="employee_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addemployeeNoteModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-note-sticky text-primary me-1"></i>Add a note</a>' +
        '<a href="#!" id="addemployeeAttch" data-table="employee_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addAttachementemployeeModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-file-circle-plus text-primary me-1"></i></i>Upload a file</a>';
    html = html + "</div></div>";

    return [html];
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

$(
    "#task_status_filter,#tasks_person_filter,#tasks_project_filter,#tasks_department_filter"
).on("change", function (e) {
    e.preventDefault();
    console.log("tasks.js on change");
    $("#employee_table").bootstrapTable("refresh");
});
