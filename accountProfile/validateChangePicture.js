$(document).ready(function (){
    $("#upload-image").validate({
        rules: {
            my_image: {
                required: true
            }
        },

        messages: {
            my_image: "Please upload a picture."
        },

        submitHandler: function (form) {
            form.submit();
        }
    });
});