$(document).ready(function (){
    $("#edit-supply").validate({
        rules: {
            supply_name_edit: {
                required: true,
                rangelength: [2, 50]
            },

            supply_brand_edit: {
                required: true,
                rangelength: [2, 50]
            },

            supply_receivers_name_edit: {
                required: true,
                rangelength: [2, 50],
            },

            supply_unit_edit: {
                required: true
            },

            supply_quantity_edit: {
                required: true
            },

            supply_date_arrived_edit: {
                required: true
            }
        },

        messages: {
            supply_name_edit: {
                required: "Please enter the supply name.",
                rangelength: "Please enter atleast 2 or more characters."
            },

            supply_brand_edit: {
                required: "Please enter the supply brand.",
                rangelength: "Please enter atleast 2 or more characters."
            },

            supply_receivers_name_edit: {
                required: "Please enter who received the supply.",
                rangelength: "Please enter atleast 2 or more characters."
            },

            supply_unit_edit: {
                required: "Please choose a supply unit."
            },

            supply_quantity_edit: {
                required: "Please enter the quantity."
            },

            supply_date_arrived_edit: {
                required: "Please enter the supply date arrived."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});