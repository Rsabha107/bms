// import Choices from 'phoenix.js'

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

$(document).ready(function () {
    // console.log("all tasksJS file");

    // showing the offcanvas for the task creation

    // $("body").on("click", "#add_edit_project", function (event) {
    //     // console.log("inside add_project_task");
    //     // event.preventDefault();
    //     var id = $(this).data("id");
    //     var table = $(this).data("table");

    //     $("#offcanvasAddEditProject").offcanvas("show");

    //     // var modalID = $(".offcanvas.offcanvas-start.show").attr("id");
    //     // alert(modalID);
    // });

    $(".js-example-basic-multiple2").select2();
    $(".js-example-basic-multiple").select2();

    window.icons = {
        refresh: "bx-refresh",
        toggleOn: "bx-toggle-right",
        toggleOff: "bx-toggle-left",
        fullscreen: "bx-fullscreen",
        columns: "bx-list-ul",
        export_data: "bx-list-ul",
        paginationSwitch: "bx-list-ul",
    };

    $("body").on("click", "#test_change_choices_list", function () {
        console.log("inside #test_change_choices_list");
        console.log($(".test").val());
        selectEl = document.getElementsByClassName("test");
        console.log(selectEl);
        const selector = jQuery(selectEl).data("choiceobject");
        console.log(selector);
        // window.choiceObject.setValue(['xx', '3']);
        selector.removeActiveItems();
        // selector.change();
        selector.setChoiceByValue("2");
        selector.setChoiceByValue("3");
        selector.setChoiceByValue("1");
        // selector.setValue([{value: 5, label:'hello'}]);
    });

    //add_edit_project
    //update_project_team_members

    $("body").on("click", "#add_edit_project", function () {
        console.log("inside #add_edit_project");

        // reset all values
        // $("#add_edit_project_assigned_to").empty();
        $("#add_edit_project_form")[0].reset();
        $("#add_edit_project_tag").val([]).change();
        $("#add_edit_project_assigned_to").val([]).change();
        $("#add_edit_project_form")[0].classList.remove("was-validated");

        var id = $(this).data("id");
        var table = $(this).data("table");
        var action = $(this).data("action");
        var source = $(this).data("source");
        var type = $(this).data("type");
        var redirect = $(this).data("redirect");
        var workspace_id = $(this).data("workspace_id");
        var form_action = "/tracki/project/" + action;

        // if (!workspace_id) {
        //     alert("choose a workspace first");
        //     return;
        // }

        console.log("workspace_id: " + workspace_id);
        is_workspace_set = workspace_id ? true : false;
        console.log("workspace_id: " + is_workspace_set);

        // if (!workspace_id && type == 'add'){
        //     alert('please choose a workspace first');
        //     return
        // }

        console.log("id: " + id);
        console.log("table: " + table);
        console.log("action: " + action);
        console.log("type: " + type);
        console.log("form_action: " + form_action);

        // set the form action with the source var
        $("#add_edit_project_form").attr("action", form_action);
        $("#add_edit_project_redirect_h").val(redirect);
        $("#add_edit_project_table_h").val(table);

        console.log(id + " " + table);
        // $("#edit_workspace_modal").modal("show");
        if (type == "add") {

            // console.log('will show canvas offcanvasAddEditProject')
            $("#add_edit_project_modal_label").html("Add new project");
            $("#add_edit_project_modal").modal("show");

            // $("#offcanvasAddEditProject").offcanvas("show");
        } else if (type == "edit") {
            // $("#add_edit_project_modal_label").html("Edit project...");

            $.ajax({
                url: "/tracki/project/" + id + "/get",
                type: "get",
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                },
                dataType: "json",
                success: function (response) {
                    console.log("response");
                    console.log(response);

                    // $("#add_edit_project_assigned_to").empty();
                    // var wsUsers = response.asg.map((users) => users.id);
                    // $.each(response.wsusers, function (index, user) {
                    //     var option = $("<option>", {
                    //         value: user.id,
                    //         text: user.name,
                    //     });

                    //     $("#add_edit_project_assigned_to").append(option);
                    // });

                    var project_tags = response.tag.map((tags) => tags.id);
                    var project_users = response.assigned_to.map(
                        (users) => users.id
                    );
                    console.log("project_tags");
                    console.log(project_tags);
                    console.log("project_users");
                    console.log(project_users);

                    var formattedStartDate = moment(
                        response.project.start_date
                    ).format("DD/MM/YYYY");
                    var formattedEndDate = moment(
                        response.project.end_date
                    ).format("DD/MM/YYYY");

                    $("#add_edit_project_modal_label").html(
                        "Edit project (" + response.project.name + ")"
                    );
                    $("#add_edit_project_id_h").val(response.project.id);

                    $("#add_edit_project_name").val(response.project.name);
                    $("#add_edit_project_workspace_id").val(
                        response.project.workspace_id
                    );
                    $("#add_edit_project_project_type").val(
                        response.project.project_type_id
                    );
                    $("#add_edit_project_client").val(
                        response.project.client_id
                    );
                    $("#add_edit_project_category").val(
                        response.project.category_id
                    );
                    $("#add_edit_project_audience").val(
                        response.project.audience_id
                    );
                    $("#add_edit_project_venue").val(response.project.venue_id);
                    $("#add_edit_project_location").val(
                        response.project.location_id
                    );
                    $("#add_edit_project_fund").val(
                        response.project.fund_category_id
                    );
                    $("#add_edit_project_budget").val(
                        response.project.budget_name_id
                    );

                    $("#add_edit_project_start_date").val(formattedStartDate);
                    $("#add_edit_project_end_date").val(formattedEndDate);

                    $("#add_edit_project_budget_allocation").val(
                        response.project.budget_allocation
                    );
                    $("#add_edit_project_attendance").val(
                        response.project.attendance_forcast
                    );

                    $("#add_edit_project_tag").val(project_tags);
                    $("#add_edit_project_tag").trigger("change");

                    $("#add_edit_project_assigned_to").val(project_users);
                    $("#add_edit_project_assigned_to").trigger("change");
                    // $("#add_edit_project_description").val(response.project.description);
                    tinymce
                        .get("add_edit_project_description")
                        .setContent(response.project.description);
                },
            }).done(function () {
                // $("#offcanvasAddEditProject").offcanvas("show");
                $("#add_edit_project_modal").modal("show");
            });
        }
    });
});

function MemberFormatter(value, row, index) {
    // console.log('inside MemberFormatter: '+ row.members)
    var members =
        Array.isArray(row.members) && row.members.length
            ? row.members
            : '<span class="badge bg-primary">' +
              label_not_assigned +
              "</span>";
    if (Array.isArray(members)) {
        // console.log(members)
        members = members.map((emp) => "<li>" + emp + "</li>");
        return (
            '<ul class="list-unstyled members-list m-0 avatar-group d-flex align-items-center">' +
            members.join("") +
            "</ul>"
        );
    } else {
        return members;
    }
}

function actionsPerProjectFormatter(value, row, index) {
    console.log('projects_per.js inside actionsPerProjectFormatter')
    html = "";
    // html =
    //     html +
    //     '<div class="font-sans-serif btn-reveal-trigger position-static">' +
    //     '<a href="javascript:void(0)" class="btn btn-sm" id="taskCardView" data-id="' +
    //     row.id +
    //     '" data-table="project_table" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="' +
    //     label_update +
    //     '">' +
    //     '<i class="fa-solid far fa-lightbulb text-warning"></i></a>';

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
            '<a href="javascript:void(0)" class="btn btn-sm" id="add_edit_project" data-action="update" data-source="' +
            x_source +
            '" data-type="edit" data-id="' +
            row.id +
            '" data-table="project_table" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="' +
            label_update +
            '">' +
            '<i class="fa-solid fa-pen-to-square text-body"></i></a>';
        // html ='<a href="javascript:voice(0)" id="edit_task" data-id ="'+ row.id +'"><button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="'+ label_update +'"><i class="bx bx-plus"></i></button></a>'
    }
    if (can_delete) {
        html =
            html +
            '<a href="javascript:void(0)" class="btn btn-sm" data-table="project_list_per_table" data-id="' +
            row.id +
            '" id="deleteTaskItem">' +
            '<i class="bx bx-trash text-body"></i></a>';
    }
    html =
        html +
        '<button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs--2"></span></button>' +
        '<div class="dropdown-menu dropdown-menu-end py-2">';

    html =
        html +
        '<a href="#!" id="addTaskNote" data-table="task_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addTaskNoteModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-note-sticky text-primary me-1"></i>Add a note</a>' +
        '<a href="#!" id="addTaskAttch" data-table="task_table" data-id="' +
        row.id +
        '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addAttachementTaskModal" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><i class="fa-solid fa-file-circle-plus text-primary me-1"></i></i>Upload a file</a>';
    html = html + "</div></div>";

    return [html];
}
