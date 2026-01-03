const accountSubmitButton = $("#btn-update-service");
const accountButtonText = accountSubmitButton.html();

accountSubmitButton.on("click", function() {
    $(".service-form").trigger('submit');
});

$(".service-form").on("submit", function (e) {
    const redirect = $(this).attr('data-redirect');
    e.preventDefault();
    accountSubmitButton.prop("disabled", true);
    accountSubmitButton.html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses`
    );
    $.ajax({
        url: this.action,
        type: this.method,
        data: $(this).serialize(),
    })
    .done(function (res) {
        new PNotify({
            title: "Berhasil!",
            text: res?.message,
            addclass: "icon-nb",
            width: "340px",
            icon: false,
            type: "success",
            animate_speed: "fast",
        });
        if (typeof redirect !== typeof undefined && redirect !== false) {
            setTimeout(function () {
                window.location = redirect;
            }, 1000);
        } else {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    })
    .fail(function (res) {
        let errorList = "";
        if (typeof(res.responseJSON?.errors) === 'object') {
            $.each(res.responseJSON?.errors, function (key, value) {
                if (value.length > 1) {
                    $.each(value, function (key, value) {
                        errorList += value + "<br/>";
                    });
                } else {
                    errorList += value + "<br/>";
                }
            });
        } else {
            errorList += res.responseJSON?.message;
        }
        new PNotify({
            title: "Gagal!",
            text: errorList,
            icon: false,
            width: "340px",
            type: "error",
            animate_speed: "fast",
        });
        accountSubmitButton.prop("disabled", false);
        accountSubmitButton.html(accountButtonText);
        if (res.responseJSON?.status === "session_expired") {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    });
});
