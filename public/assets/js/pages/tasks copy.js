function getProjectUsers(val) {
    // event_id = $(this).val();
    console.log("inside getProjectUsers");
    console.log(val);
    event_id = val;
    $.ajax({
        url: "/tracki/task/" + event_id + "/getprojectuser",
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            $("#add_task_assigned_to").empty();
            // var wsUsers = response.asg.map((users) => users.id);
            $.each(response.projectusers, function (index, user) {
                var option = $("<option>", {
                    value: user.id,
                    text: user.name,
                });

                $("#add_task_assigned_to").append(option);
            });
        },
    });
}

$(document).ready(function () {
    // console.log("all tasksJS file");

    $(".js-example-basic-multiple").select2();

    // $(function () {
    //     console.log('tooltip')
    //     $('[data-bs-toggle="tooltip"]').tooltip()
    //   })

    $("body").on("click", "#add_task", function () {
        console.log("inside #add_task");
        console.log("source: " + x_source);
        // reset all values
        $("#add_task_form")[0].reset();
        $("#add_task_assigned_to").val([]).change();
        $("#add_task_form")[0].classList.remove("was-validated");
        var id = $(this).data("id");
        var event_id = $(this).data("projectid");
        var table = $(this).data("table");
        var action = $(this).data("action");
        var type = $(this).data("type");

        var form_action = "/tracki/task/" + action;
        // set the form action with the source var
        $("#add_task_form").attr("action", form_action);

        console.log(id + " " + table);
        $("#add_task_table_h").val(table);
        $("#add_task_event_id").val(event_id);

        // $("#workspace_modal").modal("show");
        console.log("Add");
        $("#add_task_modal_label").html("Add new task");
        $("#add_task_modal").modal("show");
    });

    $("body").on("click", "#edit_task", function () {
        console.log("inside #edit_task");
        console.log("source: " + x_source);
        // reset all values
        $("#edit_task_form")[0].reset();
        $("#edit_task_assigned_to").val([]).change();
        $("#edit_task_form")[0].classList.remove("was-validated");
        var id = $(this).data("id");
        var event_id = $(this).data("projectid");
        var table = $(this).data("table");
        var action = $(this).data("action");
        var type = $(this).data("type");

        var form_action = "/tracki/task/" + action;
        // set the form action with the source var
        // $("#edit_task_form").attr("action", form_action);

        console.log(id + " " + table);
        $("#edit_task_table_h").val(table);
        $("#edit_task_event_id").val(event_id);

        console.log("Edit");

        $.ajax({
            url: "/tracki/task/" + id + "/get",
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                console.log(response.asg);
                console.log(response.project.users);
                $("#edit_task_assigned_to").empty();
                // var wsUsers = response.asg.map((users) => users.id);
                $.each(response.project.users, function (index, user) {
                    var option = $("<option>", {
                        value: user.id,
                        text: user.name,
                    });

                    $("#edit_task_assigned_to").append(option);
                });

                var wsUsers = response.task.users.map((users) => users.id);
                console.log(wsUsers);

                console.log("Name: " + response.task.description);
                $("#edit_task_modal_label").html(
                    "Edit task (" +
                        response.task.name +
                        ") Project: " +
                        response.project.name
                );

                // usersSelect.val(taskUsers);
                var formattedStartDate = moment(
                    response.task.start_date
                ).format("DD/MM/YYYY");
                var formattedDueDate = moment(response.task.due_date).format(
                    "DD/MM/YYYY"
                );

                if (x_source == "list") {
                    var project_id = $(this).data("projectId");
                    $("#edit_task_event_id").val(event_id);
                } else if (x_source == "manage") {
                    $("#edit_task_event_id").val(response.task.event_id);
                }

                $("#edit_task_id_h").val(response.task.id);

                $("#edit_task_name").val(response.task.name);
                $("#edit_task_start_date").val(formattedStartDate);
                $("#edit_task_due_date").val(formattedDueDate);
                $("#edit_task_status").val(response.task.status_id);
                $("#edit_task_department_id").val(
                    response.task.department_assignment_id
                );

                console.log("populating edit_task_assigned_to");
                console.log(wsUsers);
                $("#edit_task_assigned_to").val([]).change();
                $("#edit_task_assigned_to").val(wsUsers);
                $("#edit_task_assigned_to").trigger("change");

                $("#edit_task_budget").val(response.task.budget_allocation);
                $("#edit_task_budget_utilization").val(
                    response.task.actual_budget_allocated
                );
                // $("#edit_task_description").val(response.task.description);
                tinymce
                    .get("edit_task_description")
                    .setContent(response.task.description);
            },
        }).done(function () {
            $("#edit_task_modal").modal("show");
        });
    });

    $(document).on("click", "#create_taskx", function () {
        var id = $(this).data("id");
        $("#edit_task_modal").modal("show");
        $.ajax({
            url: "/tasks/get/" + id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"),
            },
            dataType: "json",
            success: function (response) {
                var formattedStartDate = moment(
                    response.task.start_date
                ).format(js_date_format);
                var formattedEndDate = moment(response.task.end_date).format(
                    js_date_format
                );
                $("#task_update_users_associated_with_project").html(
                    "(" +
                        label_users_associated_with_project +
                        " <strong>" +
                        response.project.title +
                        "</strong>)"
                );
                $("#id").val(response.task.id);
                $("#title").val(response.task.title);
                $("#status_id").val(response.task.status_id);
                $("#priority_id").val(
                    response.task.priority_id ? response.task.priority_id : 0
                );
                $("#update_start_date").val(formattedStartDate);
                $("#update_end_date").val(formattedEndDate);
                initializeDateRangePicker(
                    "#update_start_date, #update_end_date"
                );
                $("#update_project_title").val(response.project.title);
                $("#task_description").val(response.task.description);

                // Populate project users in the multi-select dropdown
                var usersSelect = $(
                    '.js-example-basic-multiple[name="user_id[]"]'
                );
                usersSelect.empty(); // Clear existing options
                $.each(response.project.users, function (index, user) {
                    var option = $("<option>", {
                        value: user.id,
                        text: user.first_name + " " + user.last_name,
                    });

                    usersSelect.append(option);
                });

                // Preselect task users if they exist
                var taskUsers = response.task.users.map((user) => user.id);
                usersSelect.val(taskUsers);
                usersSelect.trigger("change"); // Trigger change event to update select2
            },
            error: function (xhr, status, error) {
                console.error(error);
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

    // add new note to task overview modal
    $(".form-submit-task-new-subtask").submit(function (event) {
        // alert("inside add subtask comment");
        var formData = new FormData(this);
        var currentForm = $(this);
        var formID = $(this).closest("form").attr("id");
        var submit_btn = $(this).find("#add_subtask_btn");
        var btn_html = submit_btn.html();
        var btn_val = submit_btn.val();
        var tableInput = currentForm.find('input[name="table"]');
        var tableID = tableInput.length ? tableInput.val() : "table";
        var button_text =
            btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;
        var name = document.getElementById(formID);

        if (!name.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
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

                        html +=
                            '<div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">';
                        html += '    <div class="col-12">';
                        html +=
                            '        <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-1">';
                        html +=
                            '            <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">';
                        html +=
                            '                <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" onclick="update_subtask_status(this)" name="subtask-' +
                            result["id"] +
                            '" type="checkbox" id="' +
                            result["id"] +
                            '" />';
                        html +=
                            '                <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-0">' +
                            result["subtask_title"] +
                            '</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-' +
                            result["subtask_color"] +
                            '">' +
                            result["subtask_priority_title"] +
                            "</span>";
                        html += "            </div>";
                        html += "        </div>";
                        html += "    </div>";
                        html += '    <div class="col-12">';
                        html +=
                            '        <div class="d-flex ms-4 lh-1 align-items-center">';
                        html +=
                            '            <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>2</button>';
                        html +=
                            '            <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">' +
                            moment(result["create_at"]).format("DD-MM-YYYY") +
                            "</p>";
                        html +=
                            '            <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">' +
                            moment(result["create_at"]).format("h:mm:ss a") +
                            "</p>";
                        html += "        </div>";
                        html += "    </div>";
                        html += "</div>";

                        $("#taskTabSubtasks").append(html);

                        // $("#add_subtask_block").toggle("slow");

                        $(".form-submit-task-new-subtask")[0].reset();
                        $(".form-submit-task-new-subtask")[0].classList.remove(
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
                    alert("in error");
                    var responseText = jQuery.parseJSON(jqXhr.responseText);
                    console.log(responseText["message"]);
                    toastr.error(responseText["message"]);

                    // console.log(
                    //     "Error: " + jqXhr.responseText + " **** " + errorMessage
                    // );
                    // console.log(jqXhr.status);
                    // console.log(errorMessage);
                }, // /error function // /response
            }); // /ajax
        }
        // alert('id: '+id);
        event.preventDefault();
    });

    // add new note to task overview modal
    $(".form-submit-task-new-note").submit(function (event) {
        // alert("inside add note comment");
        var formData = new FormData(this);
        var currentForm = $(this);
        var submit_btn = $(this).find("#add_comment_btn");
        var formID = $(this).closest("form").attr("id");
        var btn_html = submit_btn.html();
        var btn_val = submit_btn.val();
        var tableInput = currentForm.find('input[name="table"]');
        var tableID = tableInput.length ? tableInput.val() : "table";
        var button_text =
            btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;

        var name = document.getElementById(formID);

        if (!name.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
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

                        html1 +=
                            '<div class="row justify-contnet-between border-bottom border-translucent g-0 gy-1 py-3 align-items-center">';
                        html1 += '    <div class="col col-auto">';
                        html1 +=
                            '        <div class="avatar avatar-m status-online ">';
                        html1 +=
                            '            <img class="rounded-circle " src="../../../assets/img/team/30.webp" alt="" />';
                        html1 += "        </div>";
                        html1 += "    </div>";
                        html1 += '    <div class="col col-auto flex-1">';
                        html1 +=
                            '        <p class="fs-9 text-body-secondary mb-0"><a class="fw-semibold" href="#!">' +
                            result["user_name"] +
                            "</a></p>";
                        html1 += "    </div>";
                        html1 +=
                            '    <div class="col-12 col-sm-auto order-1 order-sm-0">';
                        html1 +=
                            '        <p class="text-body-secondary fw-semibold fs-10 mb-0">' +
                            result["note_date"] +
                            "</p>";
                        html1 += "    </div>";
                        html1 += '<div class="col-12 col-sm-11 ms-6">';
                        html1 +=
                            '<p class="text-body fs-9 mb-0">' +
                            result["note_text"] +
                            "</p>";
                        html1 += "</div>";
                        html1 += "</div>";

                        html +=
                            '<div class="border-bottom border-translucent mb-3">' +
                            '<div class="d-flex align-items-center mb-3">' +
                            '<a href="../../apps/social/profile.html">' +
                            '<div class="avatar avatar-xl me-2">' +
                            '<img class="rounded-circle" src="{{asset(\'assets/tracki/img//team/30.webp\')}}" alt="" />' +
                            "</div>" +
                            "</a>" +
                            '<div class="flex-1">' +
                            '<a class="fw-bold mb-0 text-body-emphasis" href="../../apps/social/profile.html">Zingko Kudobum</a>' +
                            '<p class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">' +
                            "35 mins ago" +
                            "</p>" +
                            "</div>" +
                            '<div class="btn-reveal-trigger">' +
                            '<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none d-flex btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">' +
                            '<span class="fas fa-ellipsis-h"></span>' +
                            "</button>" +
                            '<div class="dropdown-menu dropdown-menu-end py-2">' +
                            '<a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a>' +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            '<p class="text-body-secondary">' +
                            result["note_text"] +
                            "</p>" +
                            "</div>";

                        $("#taskTabNotes").append(html);

                        $("#upload_file_block").toggle("slow");

                        $(".form-submit-task-new-note")[0].reset();
                        $(".form-submit-task-new-note")[0].classList.remove(
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
                    console.log(responseText["message"]);
                    toastr.error(responseText["message"]);

                    // console.log(
                    //     "Error: " + jqXhr.responseText + " **** " + errorMessage
                    // );
                    // console.log(jqXhr.status);
                    // console.log(errorMessage);
                }, // /error function // /response
            }); // /ajax
        }
        // alert('id: '+id);
        event.preventDefault();
    });

    // form-submit-task-new-subtask

    // add new file to task overview modal
    $(".form-submit-task-new-file").submit(function (event) {
        // alert("inside add note comment");
        var formData = new FormData(this);
        var currentForm = $(this);
        var submit_btn = $(this).find("#add_file_btn");
        var formID = $(this).closest("form").attr("id");
        var btn_html = submit_btn.html();
        var btn_val = submit_btn.val();
        var tableInput = currentForm.find('input[name="table"]');
        var tableID = tableInput.length ? tableInput.val() : "table";
        var button_text =
            btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;
        var submit_btn = $(this).find("#add_subtask_btn");
        var name = document.getElementById(formID);

        if (!name.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
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
                    var responseText = jQuery.parseJSON(jqXhr.responseText);
                    console.log(responseText["message"]);
                    toastr.error(responseText["message"]);
                }, // /error function // /response
            }); // /ajax
        }
        // alert('id: '+id);
        event.preventDefault();
    });

    // delete task item
    $("body").on("click", "#deleteTaskItem", function (e) {
        var taskId = $(this).data("id");
        var tableID = $(this).data("table");
        e.preventDefault();
        // alert("when does this file??");
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
                    url: "/tracki/task/" + taskId + "/delete",
                    method: "GET",
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
                            $("#" + tableID).bootstrapTable("refresh");
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
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

// $("body").on("click", "#project-tab", function (event) {
//     // alert('in activity-tab')
//     location.reload();
//     // $('#firstModal').modal('toggle');
// });

// start of showing the task modal overview **************************************************************************

$("body").on("click", "#taskCardView", function (event) {
    // event.preventDefault();
    var taskId = $(this).data("id");
    console.log("click of taskCardView");
    // console.log("task id: " + taskId);
    $.ajax({
        url: "/tracki/task/notes",
        method: "GET",
        success: function (response) {
            console.log(response.view);
            $("#taskTabNotes").empty("").append(response.view);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });

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
                $("#overviewtaskTitle").html(value.name);

                $("#overviewProjectName").html(value.project_title);
                $("#overviewtaskStatus").html(
                    '<span class="badge badge-phoenix badge-phoenix-' +
                        value.status_color +
                        ' me-2" id="overviewtaskStatus">' +
                        value.status_name +
                        "</span>"
                );
                $("#overviewtaskProgress").html(value.progress * 100 + "%");
                $("#overviewtaskProgressStyle").css({
                    width: value.progress * 100 + "%",
                });
                $("#overviewtaskStartDate").html(
                    '<span class="me-2 fa-solid fas fa-calendar-day text-success"></span>' +
                        moment(value.start_date).format("DD-MM-YYYY")
                );
                $("#overviewtaskDueDate").html(
                    '<span class="me-2 fa-solid fa-calendar-week text-danger"></span>' +
                        moment(value.due_date).format("DD-MM-YYYY")
                );
                // $("#overviewtaskDueDate").prop("value", value.due_date);
                $("#overviewtaskDescription").html(value.description);
                $("#overviewtaskAllocatedBudget").html(
                    '<span class="me-2 fa-solid fa-dollar text-success"></span>' +
                        value.budget_allocation
                );
                $("#overviewtaskActualBudget").html(
                    '<span class="me-2 fa-solid fa-donate text-primary"></span>' +
                        value.actual_budget_allocated
                );
                $("#overviewtaskDepartment").html(
                    '<span class="me-2 fa-solid fa-building text-primary"></span>' +
                        value.department_name
                );
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

                    // html += '<div class="dropdown"';
                    // html +=
                    // '   <a class="dropdown-toggle dropdown-caret-none d-inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">';
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

                    // html +=
                    //     '<div class="dropdown-menu avatar-dropdown-menu p-0 overflow-hidden" style="width: 320px;">';
                    // html += '<div class="position-relative">';
                    // html +=
                    //     '    <div class="bg-holder z-n1" style="background-image:url(../../../../assets/img/bg/bg-32.png);background-size: auto;">';
                    // html += "    </div>";
                    // html += "    <!--/.bg-holder-->";
                    // html += '    <div class="p-3">';
                    // html += '        <div class="text-end">';
                    // html += "        </div>";
                    // html += '        <div class="text-center">';
                    // html +=
                    //     '            <div class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2 mb-2"><img class="rounded-circle border border-light-subtle" alt="" /></div>';
                    // html +=
                    //     '            <h6 class="text-white">' +
                    //     asg.name +
                    //     "</h6>";
                    // html +=
                    //     '            <p class="text-light text-opacity-50 fw-semibold fs-10 mb-2">' +
                    //     asg.email_address +
                    //     "</p>";
                    // html += '            <div class="d-flex flex-center mb-3">';
                    // html +=
                    //     '                <h6 class="text-white mb-0">0 <span class="fw-normal text-light text-opacity-75">tasks</span></h6><span class="fa-solid fa-circle text-body-tertiary mx-1" data-fa-transform="shrink-10 up-2"></span>';
                    // html +=
                    //     '                <h6 class="text-white mb-0">23 <span class="fw-normal text-light text-opacity-75">projects</span></h6>';
                    // html += "            </div>";
                    // html += "        </div>";
                    // html += "    </div>";
                    // html += "</div>";
                    // html +=
                    //     '<div class="p-3 d-flex justify-content-between"><a class="btn btn-link p-0 text-decoration-none" href="/tracki/users/'+asg.id+'/details">Details </a><a class="btn btn-link p-0 text-decoration-none text-danger" href="#!">Unassign </a></div>';
                    // html += "</div>";
                    // html += "       </div>";
                    // html += "   </a>";
                    // html += "</div>";
                }
                $("#overviewtaskAssignees").empty("").append(html);

                //   }

                // }
            });

            // lets get the notes
            $.each(response.data.data, function (index, value) {
                // console.log("notes index: " + index);
                // // if (index == "data") {
                // console.log("inside the notes array");
                // console.log(value.notes);
                // console.log(value.notes.length);
                html = "";
                html1 = "";
                html2 = "";

                $("#noteCount").html(
                    "Comments/Notes (" + value.notes.length + ")"
                );

                for (const notes of value.notes) {
                    // console.log(`${notes.note_text} : ${notes.id}°C`);
                    html2 +=
                        '<div class="row justify-contnet-between border-top border-translucent g-0 gy-1 py-3 align-items-center">';
                    html2 += '    <div class="col col-auto">';
                    html2 +=
                        '        <div class="avatar avatar-m status-online ">';
                    html2 +=
                        '            <img class="rounded-circle " src="../../../assets/img/team/30.webp" alt="" />';
                    html2 += "        </div>";
                    html2 += "    </div>";
                    html2 += '    <div class="col col-auto flex-1">';
                    html2 +=
                        '        <p class="fs-9 text-body-secondary mb-0"><a class="fw-semibold" href="#!">' +
                        notes.user_name +
                        "</a></p>";
                    html2 += "    </div>";
                    html2 +=
                        '    <div class="col-12 col-sm-auto order-1 order-sm-0">';
                    html2 +=
                        '        <p class="text-body-secondary fw-semibold fs-10 mb-0">' +
                        moment(notes.created_at).format(
                            "MMMM Do YYYY, h:mm:ss a"
                        ) +
                        "</p>";
                    html2 += "    </div>";
                    html1 +=
                        '     <div class="col-12 col-sm-auto order-1 order-sm-0">';
                    html1 +=
                        '<button class="btn btn-sm btn-subtle-secondary rounded-3 mb-2 d-flex align-items-center w-100"><span class="me-2 fa-solid fa-trash"></span></button>';
                    html1 += "</div>";
                    html += '<div class="col-12 col-sm-11 ms-6">';
                    html +=
                        '<p class="text-body fs-9 mb-0">' +
                        notes.note_text +
                        "</p>";
                    html += "</div>";
                    html += "</div>";
                    html +=
                        '<div class="border-bottom border-translucent mb-3">' +
                        '<div class="d-flex align-items-center mb-3">' +
                        '<a href="../../apps/social/profile.html">' +
                        '<div class="avatar avatar-xl me-2">' +
                        '<img class="rounded-circle" src="../../../assets/tracki/img/team/30.webp" alt="" />' +
                        "</div>" +
                        "</a>" +
                        '<div class="flex-1">' +
                        '<a class="fw-bold mb-0 text-body-emphasis" href="../../apps/social/profile.html">Zingko Kudobum</a>' +
                        '<p class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">' +
                        "35 mins ago" +
                        "</p>" +
                        "</div>" +
                        '<div class="btn-reveal-trigger">' +
                        '<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none d-flex btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">' +
                        '<span class="fas fa-ellipsis-h"></span>' +
                        "</button>" +
                        '<div class="dropdown-menu dropdown-menu-end py-2">' +
                        '<a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a><a class="dropdown-item" href="#!">Download</a><a class="dropdown-item" href="#!">Report abuse</a>' +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        '<p class="text-body-secondary">' +
                        notes.note_text +
                        "</p>" +
                        "</div>";
                }
                // console.log(html)
                // $("#taskTabNotes").empty("").append(html);
            });

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

                for (const subtasks of value.subtasks) {
                    // console.log(`${subtasks.note_text} : ${subtasks.id}°C`);
                    is_completed_flag = "";
                    is_completed_flag = subtasks.is_completed ? "checked" : "";

                    // console.log('is completed flag: '+is_completed_flag);
                    html +=
                        '<div class="row justify-content-between align-items-md-center hover-actions-trigger btn-reveal-trigger border-translucent py-3 gx-0 border-top">';
                    html += '    <div class="col-12">';
                    html +=
                        '        <div data-todo-offcanvas-toogle="data-todo-offcanvas-toogle" data-todo-offcanvas-target="todoOffcanvas-1">';
                    html +=
                        '            <div class="form-check mb-1 mb-md-0 d-flex align-items-center lh-1">';
                    html +=
                        '                <input class="form-check-input flex-shrink-0 form-check-line-through mt-0 me-2 form-check-input-undefined" onclick="update_subtask_status(this)" name="subtask-' +
                        subtasks.id +
                        '" type="checkbox" id="' +
                        subtasks.id +
                        '" ' +
                        is_completed_flag +
                        "  />";
                    html +=
                        '                <label class="form-check-label mb-0 fs-8 me-2 line-clamp-1" for="checkbox-todo-0">' +
                        subtasks.title +
                        '</label><span class="badge badge-phoenix fs-10 ms-auto badge-phoenix-' +
                        subtasks.priority.color +
                        '">' +
                        subtasks.priority_info +
                        "</span>";
                    html += "            </div>";
                    html += "        </div>";
                    html += "    </div>";
                    html += '    <div class="col-12">';
                    html +=
                        '        <div class="d-flex ms-4 lh-1 align-items-center">';
                    html +=
                        '            <button class="btn p-0 text-body-tertiary fs-10 me-2"><span class="fas fa-paperclip me-1"></span>2</button>';
                    html +=
                        '            <p class="text-body-tertiary fs-10 mb-md-0 me-2 mb-0">' +
                        moment(subtasks.subtask_created_at).format(
                            "DD-MM-YYYY"
                        ) +
                        "</p>";
                    html +=
                        '            <p class="text-body-tertiary fs-10 fw-bold mb-md-0 mb-0">' +
                        moment(subtasks.subtask_created_at).format(
                            "h:mm:ss a"
                        ) +
                        "</p>";
                    html += "        </div>";
                    html += "    </div>";
                    html += "</div>";
                }
                $("#taskTabSubtasks").empty("").append(html);
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
                $("#taskTabFiles").empty("").append(html);
            });

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
    console.log("tasks.js inside actions2Formatter");
    html = "";
    html =
        html +
        '<div class="font-sans-serif btn-reveal-trigger position-static">' +
        '<a href="javascript:void(0)" class="btn btn-sm" id="taskCardView" data-id="' +
        row.id +
        '" data-table="task_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
        label_view +
        '">' +
        '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';

    if (can_edit) {
        // html =
        //     '<div class="font-sans-serif btn-reveal-trigger position-static">' +
        //     '<a href="/tracki/task/' +
        //     row.id +
        //     '/edit" class="btn btn-sm" id="editX" data-route="category" data-id="">' +
        //     '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        html =
            html +
            // '<div class="font-sans-serif btn-reveal-trigger position-static">' +
            '<a href="javascript:void(0)" class="btn btn-sm" id="edit_task" data-action="update" data-source="' +
            x_source +
            '" data-type="edit" data-id="' +
            row.id +
            '" data-table="task_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
            label_update +
            '">' +
            '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
        // html ='<a href="javascript:voice(0)" id="edit_task" data-id ="'+ row.id +'"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="'+ label_update +'"><i class="bx bx-plus"></i></button></a>'
    }
    if (can_delete) {
        html =
            html +
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="task_table" data-id="' +
            row.id +
            '" id="deleteTaskItem" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
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
            '<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#createSubTaskModal" id="addSubtask" data-id="' +
            row.id +
            '" data-table="task_table" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-plus text-primary me-1" ></i>Add Subtask</a>';
    }
    if (show_task_progress) {
        html =
            html +
            '<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#progressMovoicedal" id="editTaskProgress" data-id="' +
            row.id +
            '" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-bars-progress text-primary me-1"></i>Progress</a>';
    }
    html =
        html +
        '<a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#taskStatusModal" id="editTaskStatus" data-id="' +
        row.id +
        '" data-table="task_table" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-percent text-primary me-1" ></i>Change Status</a>' +
        '<a href="#!" id="addTaskNote" data-table="task_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addTaskNoteModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-note-sticky text-primary me-1"></i>Add a note</a>' +
        '<a href="#!" id="addTaskAttch" data-table="task_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addAttachementTaskModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-file-circle-plus text-primary me-1"></i></i>Upload a file</a>';
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
    $("#task_table").bootstrapTable("refresh");
});
