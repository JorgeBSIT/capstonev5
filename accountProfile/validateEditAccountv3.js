$(document).ready(function (){
    $("#edit-account").validate({
        rules: {
            fname: {
                required: true,
                rangelength: [2, 20]
            },

            lname: {
                required: true,
                rangelength: [2, 20]
            },

            contact: {
                required: true,
                rangelength: [11, 12]
            },

            birth_date: {
                required: true
            },

            username: {
                required: true,
                rangelength: [6, 12]
            },

            confirm_password: {
                equalTo: '#password'
            }
        },

        messages: {
            fname: {
                required: "Please enter your first name.",
                rangelength: "Please enter a valid name."
            },

            lname: {
                required: "Please enter your last name.",
                rangelength: "Please enter a valid name."
            },

            contact: {
                required: "Please enter your contact number.",
                rangelength: "Please enter 11 digit contact number."
            },

            birth_date: "Please enter your birth date.",

            username: {
                required: "Please enter your username address.",
                rangelength: "Username must be 6 to 12 characters long."
            },

            confirm_password: {
                equalTo: "The new pasword you entered does not match, please try again."
            },
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});