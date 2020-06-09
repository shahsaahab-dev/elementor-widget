// Controlling our Ajax functions here 
var ajax_url = control_form.ajaxurl;

jQuery(document).ready(function($){
    const name = $("#fname").val();
    $(".submit-first").on("click",function(){
        console.log(name);
    })
})