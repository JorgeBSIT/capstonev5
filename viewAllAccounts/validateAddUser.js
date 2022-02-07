$(document).ready(function() {
    $("#create-account-form").validate({
        rules: {
            accountType: {
                required: true
            },

            accountId: {
                required: true
            },

            my_image: {
                required: true
            },

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
                rangelength: [6, 12],
                required: true
            },

            password: {
                required: true,
                rangelength: [8, 16]
            },

            confirm_password: {
                required: true,
                equalTo: '#password'
            }
        },
        
        messages: {
            accountType: 'Please choose an account type.',

            accountId: 'Please generate a random number.',

            my_image: "Please upload an image of yours.",

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
                rangelength: "Username must be 6 to 12 characters long.",
                required: "Please enter your username."
            },

            password: {
                required: "Please enter a password.",
                rangelength: "Please enter 8 to 16 character lenght for your password."
            },

            confirm_password: {
                required: "Please confirm your password",
                equalTo: "The pasword you entered does not match, please try again."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});