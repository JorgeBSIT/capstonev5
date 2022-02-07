$(document).ready(function (){
    $("#edit-distribute").validate({
        rules: {
            equipment_id_edit: {
                required: true
            },

            equipment_name_edit: {
                required: true
            },

            equipment_brand_edit: {
                required: true
            },

            equipment_receivers_name_edit: {
                required: true
            },

            equipment_quantity_edit: {
                required: true
            },

            equipment_date_arrived_edit: {
                required: true
            }
        },

        messages: {
            equipment_id_edit: "Please generate an Id number.",

            equipment_name_edit: "Please enter the equipment name.",

            equipment_brand_edit: "Please enter equipment brand.",

            equipment_receivers_name_edit: "Please enter the receiver's name.",

            equipment_quantity_edit: "Please enter the quantity of the equipment.",

            equipment_date_arrived_edit: "Please enter the date the equipment arrived."
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});