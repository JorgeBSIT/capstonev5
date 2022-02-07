$(document).ready(function (){
    $("#distribute-supply").validate({
        rules: {
            distribution_date: {
                required: true
            },

            location: {
                required: true
            },

            distribution_quantity: {
                required: true
            },

            received_by: {
                required: true
            }
        },

        messages: {
            distribution_date: "Please enter distribution date",

            location: "Please enter a location",

            distribution_quantity: "Please enter quantity",

            received_by: "Please enter a receivers name"
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});