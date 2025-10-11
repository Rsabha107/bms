$(document).ready(function () {
    // Show ADD offcanvas
    $("body").on("click", "#offcanvas-add-parking-variation", function () {
        console.log("inside #offcanvas-add-project");

        var event_id = $(this).data("id");
        $("#add_event_id").val(event_id);
        // $("#add_edit_form").get(0).reset()
        // console.log(window.choices.removeActiveItems())
        $("#cover-spin").show();
        $("#offcanvas-add-parking-variation-modal").offcanvas("show");
        $("#cover-spin").hide();
    });
    // Show EDIT offcanvas
        $("body").on("click", "#showNavbarNav", function () {
        console.log("inside #offcanvas-add-project");

        var event_id = $(this).data("id");
        $("#add_event_id").val(event_id);
        // $("#add_edit_form").get(0).reset()
        // console.log(window.choices.removeActiveItems())
        $("#cover-spin").show();
        $("#navbarNav").offcanvas("show");
        $("#cover-spin").hide();
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