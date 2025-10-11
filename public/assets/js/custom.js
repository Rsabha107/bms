function update_overview_attributes(id) {
    console.log("inside update_project_team_members");

    $.ajax({
        url: "/tracki/project/" + id + "/getprojov",
        type: "get",
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            // console.log(response)
            // $("#add_edit_project_assigned_to").empty();
            // var wsUsers = response.asg.map((users) => users.id);
            $("#project_team_members").html("");
            // $("#project_team_members_init").html("");

            $.each(response.project_user, function (index, user) {
                console.log(user.id);
                console.log(user.name);
                initname = getNameItials(user.name);
                console.log(initname);

                var option =
                    ' <div class="avatar avatar-m  me-1">' +
                    '<a class="dropdown-toggle dropdown-caret-none d-inline-block" href="/tracki/users/' +
                    user.id +
                    '/details" role="button" title="' +
                    user.name +
                    '">' +
                    '<div class="avatar avatar-m  rounded-circle pull-up">' +
                    '<div class="avatar-name rounded-circle me-2"><span>' +
                    initname +
                    "</span></div>" +
                    '<!-- <img class="rounded-circle " src="../../assets/img/team/34.webp" alt=""> -->' +
                    "</div>" +
                    "</a>" +
                    "</div>";

                $("#project_team_members").append(option);
            });
        },
    });
}

$(document).ready(function () {
    // $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
    //     // alert('in data taggle');
    //     localStorage.setItem("activeTab", $(this).attr("href"));
    // });

    // var activeTab = localStorage.getItem("activeTab");
    // // alert('activeTab: '+activeTab);
    // if (activeTab) {
    //     $('[href="' + activeTab + '"]').tab("show");
    // }

    // alert('inside doc ready')
    $("#profile_image_name, #upload-avatar").change(function (e) {
        console.log('inside profile_image_name')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    $('#edit_profile_image_name').change(function(e) {
        console.log('inside edit profile_image_name')
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#edit_showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });

    $(".form-submit-event-tiny").submit(function (event) {
        console.log("on submit of .form-submit-event");

        event.preventDefault();

        console.log("after prevent");
        var formData = new FormData(this);
        var currentForm = $(this);
        var formID = $(this).closest("form").attr("id");
        var submit_btn = $(this).find("#submit_btn");
        var multiple_selection = $(this).find(".js-example-basic-multiplex");
        var btn_html = submit_btn.html();
        var btn_val = submit_btn.val();
        var button_text =
            btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;
        var tableInput = currentForm.find('input[name="table"]');
        // var redirectInput = currentForm.find('input[name="redirect"]');
        var idInput = currentForm.find('input[name="id"]');
        var tableID = tableInput.length ? tableInput.val() : "table";

        const name = document.getElementById(formID);

        // Display the key/value pairs
        for (var pair of formData.entries()) {
            console.log(pair[0] + ", " + pair[1]);
        }

        content = tinymce.activeEditor.getContent();
        console.log("content", content);
        formData.append("long_description", content);

        console.log("*****************************************");
        console.log("custom.js");
        console.log("currentForm: " + currentForm);
        console.log("formID: " + formID);
        console.log("tableInput: " + tableInput);
        console.log("tableID: " + tableID);
        console.log("submit_btn: " + submit_btn);
        console.log("btn_html: " + btn_html);
        console.log("btn_val: " + btn_val);
        console.log("button_text: " + button_text);
        console.log("tableID: " + tableID);
        console.log("multiple_selection: " + multiple_selection);
        console.log("formData: " + formData);
        console.log("form action: " + $(this).attr("action"));
        console.log("*****************************************");

        if (!name.checkValidity()) {
            console.log('validity check')
            event.preventDefault();
            event.stopPropagation();
        } else {
            console.log("inside else");
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
                    console.log(result);
                    if (!result["error"]) {
                        // alert('success ........')
                        // console.log(result);
                        //  events = result;
                        // var modalWithClass = $('.modal.fade.show');
                        submit_btn.html(button_text);
                        submit_btn.attr("disabled", false);
                        var modalID = $(".modal.fade.show").attr("id");
                        var ofcanvasID = $(".offcanvas.offcanvas-end.show").attr("id");
                        $("#" + modalID).modal("hide");
                        $("#" + ofcanvasID).offcanvas("hide");
                        // console.log("before form reset");
                        $("#" + formID)[0].reset();
                        $(".js-example-basic-multiple").val("");
                        $(".js-example-basic-multiple").trigger("change");
                        $("#" + formID)[0].classList.remove("was-validated");
                        toastr.success(result["message"]);
                        // if $('#')
                        // location.reload(true)
                        // console.log(redirectInput.val())
                        // console.log(idInput.val())
                        // if (redirectInput.val() == 'list'){
                        //     update_overview_attributes(idInput.val())
                        // }
                        // console.log('before table refrest for #'+tableID)
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
                    console.log(textStatus);
                    console.log(errorMessage);
                    var responseText = jQuery.parseJSON(jqXhr.responseText);
                    submit_btn.html(button_text);
                    submit_btn.attr("disabled", false);
                    console.log(responseText["message"]);
                    toastr.error(responseText["message"]);
                }, // /error function // /response
            }); // /ajax
        }
    });

    $(".form-submit-event").submit(function (event) {
        console.log("on submit of .form-submit-event");

        event.preventDefault();

        console.log("after prevent");
        var formData = new FormData(this);
        var currentForm = $(this);
        var formID = $(this).closest("form").attr("id");
        var submit_btn = $(this).find("#submit_btn");
        var multiple_selection = $(this).find(".js-example-basic-multiplex");
        var btn_html = submit_btn.html();
        var btn_val = submit_btn.val();
        var button_text =
            btn_html != "" || btn_html != "undefined" ? btn_html : btn_val;
        var tableInput = currentForm.find('input[name="table"]');
        // var redirectInput = currentForm.find('input[name="redirect"]');
        var idInput = currentForm.find('input[name="id"]');
        var tableID = tableInput.length ? tableInput.val() : "table";

        const name = document.getElementById(formID);

        // Display the key/value pairs
        for (var pair of formData.entries()) {
            console.log(pair[0] + ", " + pair[1]);
        }

        // content = tinymce.activeEditor.getContent();
        // console.log("content", content);
        // formData.append("long_description", content);

        console.log("*****************************************");
        console.log("custom.js");
        console.log("currentForm: " + currentForm);
        console.log("formID: " + formID);
        console.log("tableInput: " + tableInput);
        console.log("tableID: " + tableID);
        console.log("submit_btn: " + submit_btn);
        console.log("btn_html: " + btn_html);
        console.log("btn_val: " + btn_val);
        console.log("button_text: " + button_text);
        console.log("tableID: " + tableID);
        console.log("multiple_selection: " + multiple_selection);
        console.log("formData: " + formData);
        console.log("form action: " + $(this).attr("action"));
        console.log("*****************************************");

        if (!name.checkValidity()) {
            console.log('validity check')
            event.preventDefault();
            event.stopPropagation();
        } else {
            console.log("inside else");
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
                    console.log(result);
                    if (!result["error"]) {
                        // alert('success ........')
                        // console.log(result);
                        //  events = result;
                        // var modalWithClass = $('.modal.fade.show');
                        submit_btn.html(button_text);
                        submit_btn.attr("disabled", false);
                        var modalID = $(".modal.fade.show").attr("id");
                        var ofcanvasID = $(".offcanvas.offcanvas-end.show").attr("id");
                        $("#" + modalID).modal("hide");
                        $("#" + ofcanvasID).offcanvas("hide");
                        // console.log("before form reset");
                        $("#" + formID)[0].reset();
                        $(".js-example-basic-multiple").val("");
                        $(".js-example-basic-multiple").trigger("change");
                        $("#" + formID)[0].classList.remove("was-validated");
                        toastr.success(result["message"]);
                        // if $('#')
                        // location.reload(true)
                        // console.log(redirectInput.val())
                        // console.log(idInput.val())
                        // if (redirectInput.val() == 'list'){
                        //     update_overview_attributes(idInput.val())
                        // }
                        // console.log('before table refrest for #'+tableID)
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
                    console.log(textStatus);
                    console.log(errorMessage);
                    var responseText = jQuery.parseJSON(jqXhr.responseText);
                    submit_btn.html(button_text);
                    submit_btn.attr("disabled", false);
                    console.log(responseText["message"]);
                    toastr.error(responseText["message"]);
                }, // /error function // /response
            }); // /ajax
        }
    });
});

function update_subtask_status(e) {
    var id = e["id"];
    var name = e["name"];
    var status;
    var is_checked = $("input[name=" + name + "]:checked");

    // alert('update_subtask_status')
    // alert('id: '+id)
    // alert('name: '+name)
    // alert('is_checked: '+is_checked.length)

    // console.log('is checked length: '+is_checked.length);
    if (is_checked.length >= 1) {
        status = 1;
    } else {
        status = 0;
    }
    $.ajax({
        url: "/tracki/task/subtask/update_status",
        type: "POST", // Use POST method
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
        },
        data: {
            _method: "PUT", // Specify the desired method
            id: id,
            status: status,
        },
        success: function (response) {
            if (response.error == false) {
                toastr.success(response.message); // show a success message
                $("#" + id + "_title").toggleClass("striked");
            } else {
                toastr.error(response.message);
            }
        },
    });
}

function update_todo_status(e) {
    var id = e["id"];
    var name = e["name"];
    var status;
    var is_checked = $("input[name=" + name + "]:checked");

    // console.log('is checked length: '+is_checked.length);
    if (is_checked.length >= 1) {
        status = 1;
    } else {
        status = 0;
    }
    $.ajax({
        url: "/tracki/todo/update_status",
        type: "POST", // Use POST method
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').attr("value"), // Replace with your method of getting the CSRF token
        },
        data: {
            _method: "PUT", // Specify the desired method
            id: id,
            status: status,
        },
        success: function (response) {
            if (response.error == false) {
                toastr.success(response.message); // show a success message
                $("#" + id + "_title").toggleClass("striked");
            } else {
                toastr.error(response.message);
            }
        },
    });
}

function getNameItials(value) {
    //
    var initName = "";
    var names = value.split(/\s+/);
    for (n in names) {
        initName += names[n][0];
    }

    return initName;
    // names[0] = names[0].substr(0, 1);
    // names[1] = names[1].substr(0, 1) + "";
}

(function (factory) {
    typeof define === "function" && define.amd ? define(factory) : factory();
})

(function () {
    "use strict";

    // import * as echarts from 'echarts';
    const { merge } = window._;

    // form config.js
    const echartSetOption = (
        chart,
        userOptions,
        getDefaultOptions,
        responsiveOptions
    ) => {
        const { breakpoints, resize } = window.phoenix.utils;
        const handleResize = (options) => {
            Object.keys(options).forEach((item) => {
                if (window.innerWidth > breakpoints[item]) {
                    chart.setOption(options[item]);
                }
            });
        };

        const themeController = document.body;
        // Merge user options with lodash
        chart.setOption(merge(getDefaultOptions(), userOptions));

        const navbarVerticalToggle = document.querySelector(
            ".navbar-vertical-toggle"
        );
        if (navbarVerticalToggle) {
            navbarVerticalToggle.addEventListener(
                "navbar.vertical.toggle",
                () => {
                    chart.resize();
                    if (responsiveOptions) {
                        handleResize(responsiveOptions);
                    }
                }
            );
        }

        resize(() => {
            chart.resize();
            if (responsiveOptions) {
                handleResize(responsiveOptions);
            }
        });
        if (responsiveOptions) {
            handleResize(responsiveOptions);
        }

        themeController.addEventListener(
            "clickControl",
            ({ detail: { control } }) => {
                if (control === "phoenixTheme") {
                    chart.setOption(
                        window._.merge(getDefaultOptions(), userOptions)
                    );
                }
            }
        );
    };
    // -------------------end config.js--------------------
});
