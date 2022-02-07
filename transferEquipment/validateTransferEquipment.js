$(document).ready(function (){
    $("#transfer-equipment").validate({
        rules: {
            transfer_date: {
                required: true
            },

            new_person_in_charge: {
                required: true
            }
        },

        messages: {
            transfer_date: "Please enter date.",

            new_person_in_charge: "Please enter a name of new person in charge."
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});