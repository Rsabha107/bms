// $(document).ready(function () {
//     // Show ADD offcanvas
//     $("body").on("click", "#offcanvas-add-parking-variation", function () {
//         console.log("inside #offcanvas-add-project");

//         var event_id = $(this).data("id");
//         $("#add_event_id").val(event_id);
//         // $("#add_edit_form").get(0).reset()
//         // console.log(window.choices.removeActiveItems())
//         $("#cover-spin").show();
//         $("#offcanvas-add-parking-variation-modal").offcanvas("show");
//         $("#cover-spin").hide();
//     });
//     // Show EDIT offcanvas
//         $("body").on("click", "#showNavbarNav", function () {
//         console.log("inside #offcanvas-add-project");

//         var event_id = $(this).data("id");
//         $("#add_event_id").val(event_id);
//         // $("#add_edit_form").get(0).reset()
//         // console.log(window.choices.removeActiveItems())
//         $("#cover-spin").show();
//         $("#navbarNav").offcanvas("show");
//         $("#cover-spin").hide();
//     });
// });

// $("body").on("change", "#select_match_id", function (e) {
//     console.log("inside select_match_id");
//     var match_id = $(this).val();
//     var venue_id = $("#select_venue_id").val();
//     var service_id = $("#service_id").val();
//     console.log("match_id", match_id);
//     console.log("venue_id", venue_id);
//     console.log("service_id", service_id);
//     $.ajax({
//         url: "/get-service-variation",
//         type: "GET",
//         data: {
//             match_id: match_id,
//             venue_id: venue_id,
//             service_id: service_id,
//         },
//         dataType: "json",
//         success: function (response) {
//             console.log("response", response);
//         },
//         error: function (xhr, ajaxOptions, thrownError) {
//             console.log(xhr.status);
//             console.log(thrownError);
//         },
//     });

// });

$("body").on("change", "#select_venue_id", function (e) {
    console.log("inside select_venue_id");
    var venue_id = $(this).val();
    var card = $(this).closest(".service-card");
    var match_select = card.find('select[name="match_id"]');
    match_select.empty(); // Clear previous options
    match_select.append('<option value="">Select Match</option>'); // Add default option
    console.log("venue_id", venue_id);
    $.ajax({
        url: "/get-matches-by-venue",
        type: "GET",
        data: {
            venue_id: venue_id,
        },
        dataType: "json",
        success: function (response) {
            console.log("response", response);
            if (response.matches && response.matches.length > 0) {
                response.matches.forEach(function (match) {
                    match_select.append(
                        '<option value="' +
                            match.id +
                            '">' +
                            match.match_code +
                            " ( " +
                            match.match_date +
                            " )</option>"
                    );
                });
            } else {
                match_select.append(
                    '<option value="">No matches available</option>'
                );
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });
});

$("body").on("change", "#select_match_id", function (e) {
    console.log("inside select_match_id");
    var match_id = $(this).val();

    const card = $(this).closest(".service-card");

    var venue_id = card.find('select[name="venue_id"]').val();
    var service_id = card.find('input[name="service_id"]').val();
    var available_slots_div = card.find("#available_slots");
    var quantity_input = card.find('input[name="quantity"]');
    quantity_input.val(1); // reset quantity to 1 on match change
    available_slots_div.html(""); // clear available slots on match change
    // var match_id = $("#select_match_id").val();

    // var venue_id = $("#select_venue_id").val();
    // var service_id = $("#service_id").val();
    console.log("match_id", match_id);
    console.log("venue_id", venue_id);
    console.log("service_id", service_id);
    $.ajax({
        url: "/get-service-details",
        type: "GET",
        data: {
            match_id: match_id,
            venue_id: venue_id,
            service_id: service_id,
        },
        dataType: "json",
        success: function (response) {
            console.log("response", response);
            let badge_bg_color =
                response.service[0].available_slots > 0 ? "success" : "danger";
            let available_slots =
                '<span class="badge bg-' +
                badge_bg_color +
                ' rounded-pill px-3 py-2 bounce-badge">' +
                response.service[0].available_slots +
                " available" +
                "</span>";
            quantity_input.attr(
                "max",
                response.service[0].available_slots
            );
            available_slots_div.html(available_slots);
            const badge = available_slots_div.find(".bounce-badge");
            console.log(badge);
            if (badge.length === 0) {
                console.log("Badge element not found.");
                return; // Exit if badge element is not found
            }
            badge.removeClass("bounce"); // reset previous animation
            void badge[0].offsetWidth; // force reflow (important!)
            badge.addClass("bounce"); // trigger animation again
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        },
    });
});

$("body").on("click", "#deleteBooking", function (e) {
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
                url: "/bbs/customer/booking/delete/" + id,
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
