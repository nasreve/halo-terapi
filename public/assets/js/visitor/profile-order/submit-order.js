const submitButton = $(".tbr_wizard_next");
const buttonText = submitButton.html();

$(".tbr_main_form").on("submit", function (e) {
    const redirect = $(this).attr('data-redirect');
    e.preventDefault();
    submitButton.prop("disabled", true);
    submitButton.html(
        `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses`
    );
    $.ajax({
        url: this.action,
        type: this.method,
        data: $(this).serialize(),
    })
    .done(function (res) {
        window.location.href = res.redirect;
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

        var stack_topleft = {"dir1": "down", "dir2": "left", "push": "bottom", "spacing1": 50, "spacing2": 100};
        new PNotify({
			title: "Gagal!",
            text: errorList,
			addclass: 'notification-error',
			icon: "tbr_icon_error",
            type: "error",
			stack: stack_topleft,
            width: "348px",
            buttons: {
				sticker: false
			}
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
