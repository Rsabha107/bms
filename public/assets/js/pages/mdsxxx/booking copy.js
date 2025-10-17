function refreshNotes(val) {
    var g_response;
    // alert('booking.js refreshNotes')
    $.ajax({
        url: "/mds/admin/booking/mv/notes/" + val,
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

let calendar;

$(document).ready(function () {
    // calendar init
    // $('#calendar').fullCalendar({
    //     header: {
    //         left: 'prev,next today',
    //         center: 'title',
    //         right: 'month,agendaWeek,agendaDay'
    //     },
    //     defaultDate: '2016-09-12',
    //     navLinks: true, // can click day/week names to navigate views
    //     selectable: true,
    //     selectHelper: true,
    //     select: function(start, end) {
    //         // Display the modal.
    //         // You could fill in the start and end fields based on the parameters
    //         $('.modal').modal('show');

    //     },
    //     eventClick: function(event, element) {
    //         // Display the modal and set the values to the event values.
    //         $('.modal').modal('show');
    //         $('.modal').find('#title').val(event.title);
    //         $('.modal').find('#starts-at').val(event.start);
    //         $('.modal').find('#ends-at').val(event.end);

    //     },
    //     editable: true,
    //     eventLimit: true // allow "more" link when too many events

    // });

    // console.log("all booking file");

    // **************************************************

    $("body").on("click", "#booking_schedule_availability", function () {
        console.log("click get booking_schedule_availability");

        var venue_id = $("#add_delivery_area").val();
        if (!venue_id) {
            message = "you must choose a Delivery Areas to continue";
            toastr.error(message);
            return;
        }
        // document.addEventListener("DOMContentLoaded", function () {
        //     const calendarEl = document.getElementById("calendar");
        //     const calendar = new FullCalendar.Calendar(calendarEl, {
        //         initialView: "dayGridMonth",
        //     });
        //     calendar.render();
        // });
        // alert($("#add_delivery_area").val());
        $("#booking_calendar_modal").modal("show");
    });

    $('#booking_calendar_modal').on('hidden.bs.modal', function() {
        $("select#add_schedule_times_cal").val("");
        calendar.destroy();
      });

    $("#booking_calendar_modal").on("shown.bs.modal", function (e) {
        if (calendar) {
            console.log("calendar exists");
            calendar.destroy();
        }
        var venue_id = $("#add_delivery_area").val();
        var calendarEl = document.getElementById("calendar");
            calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            themeSystem: "bootstrap5",
            events: "/mds/admin/booking/schedule/" + venue_id,
            eventBackgroundColor: "green",
            eventDisplay: "block",
            // dateClick: function (info) {
            //     console.log("dateClick", info);
            //     alert('clicked on '+info.dateStr);
            //     // $("#add_booking_date").val(info.dateStr);
            //     // $("#booking_calendar_modal").modal("hide");
            // },
            dateClick: function (info) {
                console.log("dateClick", info);
                $.ajax({
                    url:
                        "/mds/admin/booking/times/cal/" +
                        info.dateStr +
                        "/" +
                        venue_id,
                    type: "get",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        console.log(
                            "response length: " + response.venue.length
                        );
                        // var len = response.length;

                        $("#add_schedule_times_cal")
                            .empty("")
                            .html(
                                '<option value="">-- Select time --</option>'
                            );
                        $.each(response.venue, function (key, value) {
                            var grey = null;
                            if (value.available_slots == 0) {
                                grey = "disabled";
                            } else {
                                grey = null;
                            }

                            $("#add_booking_date").val(info.dateStr);
                            
                            $("#add_schedule_times_cal").append(
                                '<option value="' +
                                    value.id +
                                    '" ' +
                                    grey +
                                    ">" +
                                    value.rsp_booking_slot +
                                    " (" +
                                    value.available_slots +
                                    ")</option>"
                            );
                        });
                    },
                }).done(function () {
                    // $("#delivery_schedule_times_modal").modal("show");
                });

                // $("#delivery_schedule_times_modal").modal("show");
            },
            eventClick: function (info) {
                console.log("eventClick", info);
                var eventObj = info.event;
                console.log("eventObj start", eventObj.start);
                console.log("venue_id id", venue_id);
                var convertedDate = moment(eventObj.start).format("YYYY-MM-DD");
                var convertedDateDMY = moment(eventObj.start).format(
                    "DD/MM/YYYY"
                );
                console.log("convertedDate", convertedDate);
                console.log("eventObj id", eventObj.id);
                $.ajax({
                    url:
                        "/mds/admin/booking/times/cal/" +
                        convertedDate +
                        "/" +
                        venue_id,
                    type: "get",
                    headers: {
                        "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        console.log(
                            "response length: " + response.venue.length
                        );
                        // var len = response.length;

                        $("#add_schedule_times_cal")
                            .empty("")
                            .html(
                                '<option value="">-- Select time --</option>'
                            );
                        $.each(response.venue, function (key, value) {
                            var grey = null;
                            if (value.available_slots == 0) {
                                grey = "disabled";
                            } else {
                                grey = null;
                            }

                            $("#add_booking_date").val(convertedDate);
                            $("#add_schedule_times_cal").append(
                                '<option value="' +
                                    value.id +
                                    '" ' +
                                    grey +
                                    ">" +
                                    value.rsp_booking_slot +
                                    " (" +
                                    value.available_slots +
                                    ")</option>"
                            );
                        });
                    },
                }).done(function () {
                    // $("#delivery_schedule_times_modal").modal("show");
                });

                // $("#delivery_schedule_times_modal").modal("show");
            },
        });
        calendar.setOption("locale", "en");
        calendar.render();

        const myModal = document.querySelector("#booking_calendar_modal");
        myModal.addEventListener("shown.bs.modal", () => {
            calendar.render();
        });
    });

    $("body").on("click", "#bookingDetails", function () {
        console.log("click get bookingDetails");

        var id = $(this).data("id");
        var table = $(this).data("table");

        console.log("id", id);
        console.log("table", table);

        $("#cover-spin").show();

        $.ajax({
            url: "/mds/admin/booking/mv/detail/" + id,
            method: "GET",
            async: true,
            success: function (response) {
                // console.log(response);
                g_response = response.view;
                $("#booking_details_modal_control")
                    .empty("")
                    .append(g_response);

                $("#booking_details_modal").modal("show");
                $("#cover-spin").hide();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            },
        });
    });

    $("body").on("click", "#show_shcedule_times_modal", function () {
        console.log("click get timesxxx");

        var booking_date = $("#add_booking_date").val();
        booking_date1 = booking_date.replaceAll("/", "");
        var venue_id = $("#add_delivery_area").val();

        if (!booking_date || !venue_id) {
            message = "you must choose Date and Delivery Areas to continue";
            toastr.error(message);
            return;
        }
        console.log("booking_date: " + booking_date);
        console.log("booking_date: " + booking_date1);
        console.log("venue_id: " + venue_id);

        $.ajax({
            url:
                "/mds/admin/booking/get_times/" +
                booking_date1 +
                "/" +
                venue_id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                console.log("response length: " + response.venue.length);
                // var len = response.length;

                $("#add_schedule_times").html(
                    '<option value="">-- Select time --</option>'
                );
                $.each(response.venue, function (key, value) {
                    var grey = null;
                    if (value.available_slots == 0) {
                        grey = "disabled";
                    } else {
                        grey = null;
                    }

                    $("#add_schedule_times").append(
                        '<option value="' +
                            value.id +
                            '" ' +
                            grey +
                            ">" +
                            value.period +
                            " (" +
                            value.available_slots +
                            ")</option>"
                    );
                });
            },
        }).done(function () {
            $("#delivery_schedule_times_modal").modal("show");
        });

        // $("#delivery_schedule_times_modal").modal("show");
    });

    // calendar based reservation
    $("body").on("click", "#select_time_cal_btn", function () {
        console.log(
            "click get time selected " + $("#add_schedule_times_cal").val()
        );
        var schedule_period_id_value = $("#add_schedule_times_cal").val();
        var schedule_period_id_text = $(
            "#add_schedule_times_cal option:selected"
        ).text();
        $("#add_schedule_period_id").val(schedule_period_id_value);
        $("select#add_schedule_times_cal").val("");
        $("#booking_calendar_modal").modal("hide");
        $("#time_alert").html(
            "Here are your times(click Get times again to change)<br>" +
                $("#add_booking_date").val() +
                " " +
                schedule_period_id_text
        );
        $("#time_alert").removeClass("alert-subtle-secondary");
        $("#time_alert").addClass("alert-subtle-success");
    });

    // $("body").on("click", "#select_time_btn", function () {
    //     console.log(
    //         "click get time selected " + $("#add_schedule_times").val()
    //     );
    //     var schedule_period_id_value = $("#add_schedule_times").val();
    //     var schedule_period_id_text = $(
    //         "#add_schedule_times option:selected"
    //     ).text();
    //     $("#add_schedule_period_id").val(schedule_period_id_value);
    //     $("#delivery_schedule_times_modal").modal("hide");
    //     $("#time_alert").html(
    //         "Here are your times(click Get times again to change)<br>" +
    //             schedule_period_id_text
    //     );
    //     $("#time_alert").removeClass("alert-subtle-secondary");
    //     $("#time_alert").addClass("alert-subtle-success");
    // });

    $("body").on("click", "#editSchedule", function () {
        console.log("inside editSchedule");
        var id = $(this).data("id");
        var table = $(this).data("table");
        // console.log('edit venues in venues.js');
        // console.log('id: '+id);
        // console.log('table: '+table);
        // var target = document.getElementById("edit_venues_modal");
        // var spinner = new Spinner().spin(target);
        // $("#edit_venues_modal").modal("show");
        $.ajax({
            url: "/mds/setting/schedule/get/" + id,
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                var formatted_regime_start_date = moment(
                    response.venue.regime_start_date
                ).format("DD/MM/YYYY");
                var formatted_regime_end_date = moment(
                    response.venue.regime_end_date
                ).format("DD/MM/YYYY");

                $("#edit_schedules_id").val(response.venue.id);
                $("#edit_regime_start_date").val(formatted_regime_start_date);
                $("#edit_regime_end_date").val(formatted_regime_end_date);
                $("#edit_schedule_venue_id").val(response.venue.venue_id);
                $("#edit_schedule_rsp_id").val(response.venue.rsp_id);
                $("#edit_time_slots").val(response.venue.time_slots);
                $("#edit_schedules_table").val(table);
                // $("#edit_vehicle_types_modal").modal("show");
            },
        }).done(function () {
            $("#edit_schedules_modal").modal("show");
        });
    });
});

$("body").on("click", "#deleteBooking", function (e) {
    var id = $(this).data("id");
    var tableID = $(this).data("table");
    e.preventDefault();
    // console.log('in deleteBooking '+id);
    // console.log('in deleteBooking '+tableID);
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
            // console.log('inside confirmed')
            $.ajax({
                url: "/mds/admin/booking/delete/" + id,
                type: "DELETE",
                headers: {
                    // "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"),
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (result) {
                    // alert(result)
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

$("body").on("click", "#editScheduleStatus", function (event) {
    // console.log("inside sec click edit");
    // event.preventDefault();
    var id = $(this).data("id");
    var table = $(this).data("table");
    // var route = $(this).data("route");
    // console.log("id: " + id);
    // console.log("table: " + table);

    $.get("/mds/schedule/status/edit/" + id, function (data) {
        //  console.log('event name: ' + data);
        $.each(data, function (index, value) {
            // console.log(value[0]);
            $("#editScheduleId").val(value[0].id);
            $("#editScheduleStatusSelection").val(value[0].status_id);
            $("#scheduleStatusTable").val(table);
            $("#scheduleStatusModal").modal("show");
        });

        // $('#staticBackdropLabel').html("Edit category");
        // $('#submit').val("Edit category");
    });
});

// *****************************************Botes Operations ************************************************************************
// $(".form-submit-booking-new-note").submit(function (event) {
//     // alert("inside add booking note comment");
//     var formData = new FormData(this);
//     var currentForm = $(this);
//     var submit_btn = $(this).find("#add_comment_btn");
//     var formID = $(this).closest("form").attr("id");
//     var btn_html = submit_btn.html();
//     var btn_val = submit_btn.val();
//     var tableInput = currentForm.find('input[name="table"]');
//     var tableID = tableInput.length ? tableInput.val() : "table";
//     var button_text =
//         btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;
//     var bookingID = $("#note_parent_booking_id_overview").val();

//     // alert(bookingID);

//     var name = document.getElementById(formID);

//     console.log(name);
//     console.log(name.checkValidity());

//     // alert(name.checkValidity());

//     event.stopPropagation();

//     if (!name.checkValidity()) {
//         event.preventDefault();
//         event.stopPropagation();
//     } else {
//         $.ajax({
//             url: $(this).attr("action"),
//             type: "POST",
//             data: formData,
//             headers: {
//                 "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
//             },
//             beforeSend: function () {
//                 submit_btn.html(label_please_wait);
//                 submit_btn.attr("disabled", true);
//             },
//             // data: formData, //form.serialize(),
//             dataType: "json",
//             cache: false,
//             contentType: false,
//             processData: false,
//             // async: false,
//             success: function (result) {
//                 if (!result["error"]) {
//                     console.log("inside success ajax");
//                     console.log(result);

//                     submit_btn.html(button_text);
//                     submit_btn.attr("disabled", false);

//                     // $("#upload_file_block").toggle("slow");

//                     $(".form-submit-booking-new-note")[0].reset();
//                     $(".form-submit-booking-new-note")[0].classList.remove(
//                         "was-validated"
//                     );
//                     toastr.success(result["message"]);
//                     $("#" + tableID).bootstrapTable("refresh");

//                     $("#bookingTabNotes")
//                         .empty("")
//                         .append(refreshNotes(bookingID));
//                 } else {
//                     submit_btn.html(button_text);
//                     submit_btn.attr("disabled", false);
//                     toastr.error(result["message"]);
//                 }
//             }, // /success function
//             error: function (jqXhr, textStatus, errorMessage) {
//                 // error callback
//                 // add spinner to button
//                 var responseText = jQuery.parseJSON(jqXhr.responseText);
//                 console.log(responseText["message"]);
//                 toastr.error(responseText["message"]);

//                 // console.log(
//                 //     "Error: " + jqXhr.responseText + " **** " + errorMessage
//                 // );
//                 // console.log(jqXhr.status);
//                 // console.log(errorMessage);
//             }, // /error function // /response
//         }); // /ajax
//     }
//     // alert('id: '+id);
//     event.preventDefault();
// });

// $("body").on("click", "#booking-note-tab", function (event) {
//     console.log("in booking-note-tab");
//     $(".spinner-border").show();
//     // $("#task_table").bootstrapTable("refresh");
//     tab_value = $("#booking-note-tab").data("id");
//     // $("#taskTabNotes").empty("").append(refreshTaskNotes(tab_value));

//     $.ajax({
//         url: "/mds/admin/booking/mv/notes/" + tab_value,
//         method: "GET",
//         async: true,
//         success: function (response) {
//             g_response = response.view;
//             $("#bookingTabNotes").empty("").append(g_response);
//             $(".spinner-border").hide();
//         },

//         error: function (xhr, ajaxOptions, thrownError) {
//             console.log(xhr.status);
//             console.log(thrownError);
//         },
//         // $('#firstModal').modal('toggle');
//     });
// });

// $("body").on("click", ".removeNoteDiv", function (e) {
//     e.preventDefault();
//     var id = $(this).data("id");
//     var tableID = $(this).data("table");
//     var divToRemove = $(this)
//         .parent("div")
//         .parent("div")
//         .parent("div")
//         .parent("div");
//     e.preventDefault();
//     var link = $(this).attr("href");
//     Swal.fire({
//         title: "Are you sure?",
//         text: "Delete This Data?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: "/mds/admin/booking/note/delete/" + id,
//                 type: "DELETE",
//                 headers: {
//                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                         "content"
//                     ),
//                 },
//                 success: function (result) {
//                     if (!result["error"]) {
//                         toastr.success(result["message"]);
//                         divToRemove.remove();
//                         // $("#fileCount").html(
//                         //     "File (" + result["count"] + ")"
//                         // );
//                         $("#" + tableID).bootstrapTable("refresh");
//                         // for delete confirmation uncomment below
//                         // Swal.fire(
//                         //     "Deleted!",
//                         //     "Your file has been deleted.",
//                         //     "success"
//                         // );
//                     }
//                 },
//                 error: function (xhr, ajaxOptions, thrownError) {
//                     console.log(xhr.status);
//                     console.log(thrownError);
//                 },
//             });
//         }
//     });
// });

// form-submit-task-new-subtask

// add new file to task overview modal
// $(".form-submit-task-new-file").submit(function (event) {
//     // alert("inside add note comment");
//     var formData = new FormData(this);
//     var currentForm = $(this);
//     var submit_btn = $(this).find("#add_file_btn");
//     var formID = $(this).closest("form").attr("id");
//     var btn_html = submit_btn.html();
//     var btn_val = submit_btn.val();
//     var tableInput = currentForm.find('input[name="table"]');
//     var tableID = tableInput.length ? tableInput.val() : "table";
//     var button_text =
//         btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;
//     var submit_btn = $(this).find("#add_subtask_btn");
//     var name = document.getElementById(formID);

//     for (var pair of formData.entries()) {
//         console.log(pair[0] + ", " + pair[1]);
//     }

//     if (!name.checkValidity()) {
//         event.preventDefault();
//         event.stopPropagation();
//     } else {
//         $.ajax({
//             url: $(this).attr("action"),
//             type: "POST",
//             data: formData,
//             headers: {
//                 "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
//             },
//             beforeSend: function () {
//                 submit_btn.html(label_please_wait);
//                 submit_btn.attr("disabled", true);
//             },
//             // data: formData, //form.serialize(),
//             dataType: "json",
//             cache: false,
//             contentType: false,
//             processData: false,
//             // async: false,
//             success: function (result) {
//                 if (!result["error"]) {
//                     // console.log("inside success ajax");
//                     // console.log(result);
//                     //  events = result;
//                     // var modalWithClass = $('.modal.fade.show');
//                     submit_btn.html(button_text);
//                     submit_btn.attr("disabled", false);

//                     html = "";

//                     html += '<div class="border-top py-3">';
//                     html += '  <div class="me-n3">';
//                     html += '    <div class="d-flex flex-between-center">';
//                     html +=
//                         '       <div class="d-flex mb-1"><span class="fa-solid fa-image me-2 text-body-tertiary fs-9"></span>';
//                     html +=
//                         '         <p class="text-body-highlight mb-0 lh-1"><a href="../../../storage/upload/event_files/' +
//                         result["file_name"] +
//                         '" target="_blank">' +
//                         result["original_file_name"] +
//                         "</a></p>";
//                     html += " </div>";
//                     html +=
//                         ' <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h"></span></button>';
//                     html +=
//                         ' <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item text-danger removeFileDiv" href="#!" id="deletexx"  data-table="task_table" data-id=' +
//                         result["task_file_id"] +
//                         ">Delete</a></div>";
//                     html += "                    </div>";
//                     html +=
//                         '                    <p class="fs-9 text-body-tertiary mb-1"><span>' +
//                         result["file_size"] / 100 +
//                         'kb </span><span class="text-body-quaternary mx-1">| </span><a href="#!">' +
//                         result["user_name"] +
//                         ' </a><span class="text-body-quaternary mx-1">| </span><span class="text-nowrap">' +
//                         result["created_at"] +
//                         "</span></p>";

//                     if (
//                         result["file_extension"].toLowerCase() == "jpg" ||
//                         result["file_extension"].toLowerCase() == "jpeg" ||
//                         result["file_extension"].toLowerCase() == "png"
//                     ) {
//                         // console.log('file path: '+ result["file_path"])
//                         // console.log('file name: '+ result["file_name"])
//                         html +=
//                             '<a href="' +
//                             result["file_path"] +
//                             result["file_name"] +
//                             '" target="_blank"><img class="rounded-2 img-thumbnail" src="' +
//                             result["file_path"] +
//                             result["file_name"] +
//                             '" alt="" width="200" height="200" /></a>';
//                     }

//                     html += "                </div>";
//                     html += "            </div>";

//                     $("#taskTabFiles").append(html);

//                     $(".form-submit-task-new-file")[0].reset();
//                     $(".form-submit-task-new-file")[0].classList.remove(
//                         "was-validated"
//                     );
//                     toastr.success(result["message"]);
//                     $("#" + tableID).bootstrapTable("refresh");
//                 } else {
//                     submit_btn.html(button_text);
//                     submit_btn.attr("disabled", false);
//                     toastr.error(result["message"]);
//                 }
//             }, // /success function
//             error: function (jqXhr, textStatus, errorMessage) {
//                 var responseText = jQuery.parseJSON(jqXhr.responseText);
//                 console.log(responseText["message"]);
//                 toastr.error(responseText["message"]);
//             }, // /error function // /response
//         }); // /ajax
//     }
//     // alert('id: '+id);
//     event.preventDefault();
// });

// ("use strict");
// function queryParams(p) {
//     return {
//         page: p.offset / p.limit + 1,
//         limit: p.limit,
//         sort: p.sort,
//         order: p.order,
//         offset: p.offset,
//         search: p.search,
//     };
// }

// window.icons = {
//     refresh: "bx-refresh",
//     toggleOn: "bx-toggle-right",
//     toggleOff: "bx-toggle-left",
//     fullscreen: "bx-fullscreen",
//     columns: "bx-list-ul",
//     export_data: "bx-list-ul",
// };

// function loadingTemplate(message) {
//     return '<i class="bx bx-loader-alt bx-spin bx-flip-vertical" ></i>';
// }

// function actions2Formatter(value, row, index) {
//     return [
//         '<a href="javascript:void(0);" class="edit-schedules" id="editSchedule" data-id=' +
//             row.id +
//             " title=" +
//             label_intervals +
//             ' data-table="schedules_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
//             '<a href="javascript:void(0);" class="edit-schedules" id="editSchedule" data-id=' +
//             row.id +
//             " title=" +
//             label_update +
//             ' data-table="schedules_table" class="card-link"><i class="bx bx-edit mx-1"></i></a>' +
//             "<button title=" +
//             label_delete +
//             ' type="button" data-table="schedules_table" class="btn delete" id="deleteSchedule" data-id=' +
//             row.id +
//             ' data-type="status">' +
//             '<i class="bx bx-trash text-danger mx-1"></i>' +
//             "</button>",
//     ];
// }

// function actionsFormatter(value, row, index) {
//     console.log("tasks.js inside actions2Formatter");
//     html = "";
//     html =
//         html +
//         '<div class="font-sans-serif btn-reveal-trigger position-static">';

//     // html =
//     //     '<div class="font-sans-serif btn-reveal-trigger position-static">' +
//     //     '<a href="/tracki/task/' +
//     //     row.id +
//     //     '/edit" class="btn btn-sm" id="editX" data-route="category" data-id="">' +
//     //     '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
//     html =
//         html +
//         '<a href="javascript:void(0)" class="btn btn-sm" id="generateBookingPass" data-id="' +
//         row.id +
//         '" data-table="bookings_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
//         label_generate_pass +
//         '">' +
//         '<i class="fas fa-passport text-success"></i></a>';

//     html =
//         html +
//         '<a href="javascript:void(0)" class="btn btn-sm" id="editBooking" data-id="' +
//         row.id +
//         '" data-table="bookings_table" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
//         label_update +
//         '">' +
//         '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';

//     html =
//         html +
//         '<a href="javascript:void(0)" class="btn btn-sm delete" data-table="bookings_table" data-id="' +
//         row.id +
//         '" id="deleteBooking" data-bs-toggle="tooltip" data-bs-placement="right" title="' +
//         label_delete +
//         '">' +
//         '<i class="bx bx-trash text-danger"></i></a>';

//     html = html + "</div></div>";

//     return [html];
// }
