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
