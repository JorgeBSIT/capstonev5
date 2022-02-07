$(document).ready(function (){
    $("#sign-in-form").validate({
        rules: {
            username: {
                required: true,
            },

            password: {
                required: true
            }
        },

        messages: {
            username: {
                required: "Please enter your username."
            },

            password: "Please enter your password."
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});