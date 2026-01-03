$(".main_form_file").on("submit", function (e) {
    const submitButton = $(this).find("button:submit");
    const buttonText = submitButton.html();
    const redirect = $(this).attr('data-redirect');

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
        var stack_topleft = {"dir1": "down", "dir2": "left", "push": "bottom", "spacing1": 50, "spacing2": 100};
        new PNotify({
			title: 'Berhasil',
			text: res?.message,
			addclass: 'notification-primary',
			icon: "tbr_icon_success",
            type: "success",
			stack: stack_topleft,
            width: "348px",
            buttons: {
				sticker: false
			}
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
        $(":input").removeClass("is-invalid");
        $(".invalid-feedback").html("");

        $.each(res.responseJSON?.errors, function (key, value) {
            if (key.includes('regency') || key.includes('district')) {
                $('.invalid-feedback-location').addClass("d-block");
                $('.invalid-feedback-location').html(value);
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
