// Controlling our Ajax functions here 
var ajax_url = control_form.ajaxurl;

jQuery(document).ready(function ($) {

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
                action: 'create_account'
            },
            success: function (response) {
                console.log(response);
            },
        });
    })
})