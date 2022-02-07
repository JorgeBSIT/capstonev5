$(document).ready(function() {
    $("#condemn-equipment").validate({
        rules: {
            condemn_date: {
                required: true
            },

            condemn_status: {
                required: true
            },

            condem_quantity: {
                required: true
            }
        },
        
        messages: {
            condemn_date: "Please enter date of condemn.",

            condemn_status: "Please condemn status.",

            condem_quantity: "Please enter how many equipment to condemn."
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});