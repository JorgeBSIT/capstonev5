$(document).ready(function (){
    $("#add-supply").validate({
        rules: {
            supplyName: {
                required: true,
                rangelength: [2, 50]
            },

            supplyBrand: {
                required: true,
                rangelength: [2, 50]
            },

            supplyReceiversName: {
                required: true,
                rangelength: [2, 50],
            },

            supplyUnit: {
                required: true
            },

            supplyQuantity: {
                required: true
            },

            supplyDateArrived: {
                required: true
            }
        },

        messages: {
            supplyName: {
                required: "Please enter the supply name.",
                rangelength: "Please enter atleast 2 or more characters."
            },

            supplyBrand: {
                required: "Please enter the supply brand.",
                rangelength: "Please enter atleast 2 or more characters."
            },

            supplyReceiversName: {
                required: "Please enter who received the supply.",
                rangelength: "Please enter atleast 2 or more characters."
            },

            supplyUnit: {
                required: "Please choose a supply unit."
            },

            supplyQuantity: {
                required: "Please enter the quantity."
            },

            supplyDateArrived: {
                required: "Please enter the supply date arrived."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});