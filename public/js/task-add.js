$(document).ready(function() {
    $("#preview").click(function() {
        $("#usernamePreview").html($("#username").val());
        $("#emailPreview").html($("#email").val());
        $("#commentsPreview").html($("#comments").val());
    });

    $("#image").change(function() {
    	getImage(this);
    });

    function getImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
});