const submitButton = $("button:submit");
const buttonText = submitButton.html();

$(".main_form").on("submit", function (e) {
    e.preventDefault();
    submitButton.prop("disabled", true);
    submitButton.html(
        `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses`
    );
    $.ajax({
        url: this.action,
        type: this.method,
        data: new FormData($(this)[0]),
        contentType: false,
        processData: false,
    })
    .done(function (res) {
        setTimeout(function () {
            window.location = res.redirect;
        }, 1000);
    })
    .fail(function (res) {
        $(":input").removeClass("is-invalid");
        $(".invalid-feedback").html("");

        $.each(res.responseJSON?.errors, function (key, value) {
            if (key.includes('regency') || key.includes('district')) {
                $('.invalid-feedback-location').addClass("d-block");
                $('.invalid-feedback-location').html(value);
            }

            if (key === 'photo_path') {
                $('.invalid-feedback-photo').addClass("d-block");
                $('.invalid-feedback-photo').html(value);
            }

            $(`[name='${key}']`).addClass("is-invalid");
            $(`[name='${key}']`).siblings(".invalid-feedback").html(value);
        });

        submitButton.prop("disabled", false);
        submitButton.html(buttonText);

        if (res.responseJSON?.status === "session_expired") {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    });
});
