var valid = false;

$("#login-form").submit(function (e) {
    var $form = $(this);

    if (! $form.valid()) {
        return false;
    }

    as.btn.loading($("#btn-login"), "Logging in...");

    return true;
});

$("#login-container").submit(function (e) {
    var $form = $(this);

    if (! $form.valid()) {
        return false;
    }

    as.btn.loading($("#btn-login"), "Logging in...");

    return true;
});