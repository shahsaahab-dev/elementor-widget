// Controlling our Ajax functions here 
var ajax_url = control_form.ajaxurl;
var site_url = control_form.site_url;
jQuery(document).ready(function ($) {
    var uname = $("#uname").val();
    var fname = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var password = $("#password").val();

    $(".first-step-signup input[type='password'").on("focusout", function () {
        if ($(this).val().length < 8) {
            $(this).css({
                'border-bottom': '2px solid red',
            });
        } else {
            $(this).css({
                'border-bottom': '2px solid green',
            });
        }
    })
    $(".first-step-signup input[type='text'").on("focusout", function () {
        if ($(this).val().length < 3) {
            $(this).css({
                'border-bottom': '2px solid red',
            });
            $(".submit-first").prop("disabled", true);
        } else {
            $(this).css({
                'border-bottom': '2px solid green',
            });
            $(".submit-first").prop("disabled", false);
        }
    })
    // Ajax Function 
    $(".submit-first").on("click", function () {
        var uname = $("#uname").val();
        var fname = $("#name").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var password = $("#password").val();
        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                uname: uname,
                fname: fname,
                email: email,
                phone: phone,
                password: password,
                action: 'create_account',
                security: control_form.security,
            },
            success: function (response) {
                const fields = [uname, fname, email, phone, password];
                if (response.code == 1) {
                    $(".failure-message").remove();
                    $(".success-message").text(response.message);
                    $(".success-message").slideDown("slow");
                    $(".first-step-signup").slideDown("slow");
                    location.reload();

                } else if (response.code == 2) {
                    $(".failure-message").text(response.message);
                    $(".failure-message").slideDown("slow");

                } else if (response.code == 3) {
                    $(".failure-message").text(response.message);
                    $(".failure-message").slideDown("slow");
                    $("#email").css({
                        border: '2px solid red',
                    })
                } else {
                    $(".failure-message").text(response.message);
                    $(".failure-message").slideDown("slow");
                }

            },
        });
    });

    // Donor Information last Step
    $(".last-signup").on("click", function () {
        var iban = $("#iban").val();
        var revolut = $("#revolut").val();
        var bitcoin = $("#bitcoin").val();
        var desc = $("textarea#desc").val();
        var address = $("#address").val();
        var addBtn = $("#avatar-image");
        var url = $("#profile-picture").val();
        var proof = $("#proof-picture").val();
        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                iban: iban,
                revolut: revolut,
                bitcoin: bitcoin,
                desc: desc,
                address: address,
                pictureUrl: url,
                proofUrl: proof,
                action: 'donor_information',
                security: control_form.security,
            },
            success: function (response) {
                if (response.code == 1) {
                    $(".failure-message-f").remove();
                    $(".success-message-f").text(response.message);
                    $(".success-message-f").slideDown("slow");
                    $(".first-step-signup").slideDown("slow");

                } else if (response.code == 2) {
                    $(".failure-message-f").text(response.message);
                    $(".failure-message-f").slideDown("slow");

                } else {
                    $(".failure-message-f").text(response.message);
                    $(".failure-message-f").slideDown("slow");
                }

            },
        });
    });


    // Save Changes from Profile Page 
    $("#save-changes").on("click", function () {
        var name = $("#display-name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var address = $("#address").val();
        var description = $("#description").val();
        var iban = $("#iban").val();
        var revolut = $("#revolut").val();
        var bitcoin = $("#bitcoin").val();

        // Profile Picture 
        var prof = $("#save_form_picture").val();
        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                action: 'save_donor_information',
                name: name,
                email: email,
                password: password,
                address: address,
                description: description,
                iban: iban,
                revolut: revolut,
                prof_pic_save: prof,
                bitcoin: bitcoin,
                security: control_form.security,
            },
            success: function (response) {
                $(".message-success").html(response.message);
                $(".message-success").slideDown("slow");
            }

        })
    });


    // Login Function 
    $("#login-button").on("click", function () {
        var username = $("#username").val();
        var password = $("#password").val();
        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                username: username,
                password: password,
                security: control_form.security,
                action: 'login_donor',
            },
            success: function (response) {
                if (response.code == 1) {
                    $(".error-message").remove();
                    $(".success-message").text(response.message);
                    window.location.href = site_url + '/donor-profile';
                } else {
                    $(".error-message").html(response.message);
                }
            }

        })
    })
})