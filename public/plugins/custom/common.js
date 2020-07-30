function saveProduct() {
    $('saveBtn').prop('disabled', true);
    $('.err_msg').html('');
    $.post("/products/store", $('#productForm').serialize(), function (responseJson) {
        $('saveBtn').prop('disabled', false);
        if (responseJson.success) {
            window.location = '/products';

        } else {
            if (responseJson.errors.name) {
                $('#err_name').html(responseJson.errors.name);
            }
            if (responseJson.errors.detail) {
                $('#err_detail').html(responseJson.errors.detail);
            }
            if (responseJson.errors.image) {
                $('#err_image').html(responseJson.errors.image);
            }
        }
    });
}

$(document).ready(function () {
    $("#uploadImageFile").on("change", function () {
        $("#uploadImageForm").submit();
    });
    (function () {
        $("#uploadImageForm").ajaxForm({
            complete: function (xhr) {
                var responseObject = JSON.parse(xhr.responseText);
                $("#image").val(responseObject.image);
                $('#imagePreview').attr('src', '/images/products/' + responseObject.image);

            }
        });
    })();
});

function loginPost() {
    $('.err_msg').html('');

    $.post("/loginPost", $('#loginForm').serialize(), function (responseJson) {

        if (responseJson.success) {
            window.location = '/';
        } else {
            if (responseJson.errors.message) {
                $('#err_message').html(responseJson.errors.message);
            }
            if (responseJson.errors.email) {
                $('#err_email').html(responseJson.errors.email);
            }
            if (responseJson.errors.password) {
                $('#err_password').html(responseJson.errors.password);
            }
        }
    });
}

function registerPost() {

    $('.err_msg').html('');
    $.post("/registerPost", $('#registerForm').serialize(), function (responseJson) {
        if (responseJson.success) {
            window.location = '/';
        } else {
            if (responseJson.errors.message) {
                $('#err_message').html(responseJson.errors.message);
            }
            if (responseJson.errors.email) {
                $('#err_email').html(responseJson.errors.email);
            }
            if (responseJson.errors.password) {
                $('#err_password').html(responseJson.errors.password);
            }
            if (responseJson.errors.name) {
                $('#err_name').html(responseJson.errors.name);
            }
            if (responseJson.errors.confirmPassword) {
                $('#err_confirmPassword').html(responseJson.errors.confirmPassword);
            }
        }
    });
}
