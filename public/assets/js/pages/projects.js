// import Choices from 'phoenix.js'

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

    // $("#projectCards").html("project cards projectCards");

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
            // $.ajax({
            //     url: "/tracki/project/getwsuser",
            //     type: "get",
            //     headers: {
            //         "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            //     },
            //     dataType: "json",
            //     success: function (response) {
            //         $("#add_edit_project_assigned_to").empty();

            //         $.each(response.wsusers, function (index, user) {
            //             var option = $("<option>", {
            //                 value: user.id,
            //                 text: user.name,
            //             });

            //             $("#add_edit_project_assigned_to").append(option);
            //         });
            //     },
            // }).done(function () {
            //     // $("#offcanvasAddEditProject").offcanvas("show");
            //     $("#add_edit_project_modal").modal("show");
            // });

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


    $("#switchClientOwner").submit(function (event) {

        event.preventDefault();
        selected_value = $("#project_client_owner_id").val();
        alert('in swtichClientOwner.  selected value '+selected_value+' '+$(this).find('option:selected').text())
    });
});


