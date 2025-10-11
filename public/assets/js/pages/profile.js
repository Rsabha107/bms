$("body").on("click", "#address-tab", function (event) {
    // alert('in activity-tab')
    $("#employee_address_table").bootstrapTable("refresh");
    // $('#firstModal').modal('toggle');
});

// $("body").on("click", "#projects-tab", function (event) {
//     var employeeId = $(this).data("employee-id");
//     console.log(employeeId)

//     $(".spinner-border").show();
//     $.ajax({
//         url: "/tracki/project/vw/cards/"+employeeId,
//         method: "GET",
//         async: true,
//         success: function (response) {
//             g_response = response.view;
//             $("#projectCards").empty("").append(g_response);
//             $(".spinner-border").hide();
//         },
//     });
// });
