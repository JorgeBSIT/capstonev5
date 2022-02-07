$(document).ready(function (){
    $("#equipment-distribute").validate({
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

            in_charge_to: {
                required: true,
                rangelength: [2, 20]
            }
        },

        messages: {
            distribution_date: "Please enter the equipment date distributed",

            location: "Please choose where the supply will be delivered.",

            distribution_quantity: "Please enter how many equipment to distribute.",

            in_charge_to: {
                required: "Please enter the receiver's name.",
                rangelength: "Please enter a valid name."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});