$(document).ready(function () {
    // console.log("all tasksJS file");

    // ************************************************** task status

    $(".js-asg-basic-multiple").select2();
    $(".js-client-basic-multiple").select2();

    $("body").on("click", "#editWorkspace", function () {
        var id = $(this).data("id");
        var table = $(this).data("table");
        console.log(id + ' '+ table)
        $("#edit_workspace_modal").modal("show");
        $.ajax({
            url: "/tracki/setup/workspace/" + id + "/get",
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response)
                console.log(response.asg)
                var wsUsers = response.asg.map(user => user.id);
                console.log(wsUsers)
                var wsClient = response.client.map(client => client.id);
                console.log(wsClient)

                // usersSelect.val(taskUsers);
                $("#id").val(response.workspace.id);
                $("#edit_ws_title").val(response.workspace.title);
                $("#table").val(table);
                $("#edit_ws_asg_id").val(wsUsers);
                $("#edit_ws_asg_id").trigger('change');
                $("#edit_ws_client_id").val(wsClient);
                $("#edit_ws_client_id").trigger('change');

            },
        }).done(function(){
            $("#edit_workspace_modal").modal("show");
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
        '<a href="javascript:void(0);" class="edit-status" id="editWorkspace" data-id=' +
            row.id +
            " title=" +
            label_update +
            ' data-table="workspace_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
            '<a href="workspace/'+ row.id +'/delete" title="'+ label_delete +'" class="btn btn-sm  delete" id="delete">' +
                                                                '<i class="fa-solid fa-trash" style="color: #f33061;"></i>' +
                                                            '</a>',
    ];
}

function userFormatter(value, row, index) {
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

function clientFormatter(value, row, index) {
    // console.log('inside clientFormatter: '+ row.client_id)
    var client_id =
        Array.isArray(row.client_id) && row.client_id.length
            ? row.client_id
            : '<span class="badge bg-primary">' +
              label_not_assigned +
              "</span>";
    if (Array.isArray(client_id)) {
        client_id = client_id.map((client) => "<li>" + client + "</li>");
        return (
            '<ul class="list-unstyled client_id-list m-0 avatar-group d-flex align-items-center">' +
            client_id.join("") +
            "</ul>"
        );
    } else {
        return client_id;
    }
}
