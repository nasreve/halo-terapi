const submitButton = $(".tbr_btn_login");
const buttonText = submitButton.html();

var stack_topleft = {"dir1": "down", "dir2": "left", "push": "bottom", "spacing1": 50, "spacing2": 100};
var iconSuccess = 'tbr_icon_success';
var iconError = 'tbr_icon_error';

$(".tbr_login_form").on("submit", function (e) {
    e.preventDefault();
    submitButton.prop("disabled", true);
    submitButton.html(
        `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Memproses`
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
        if (res.responseJSON.status === "EmailNotVerified") {
            window.location.href = res.responseJSON.redirect;
            return false;
        }

        if (res.responseJSON.status === "blocked") {
            window.location.reload();
            return false;
        }

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
			title: 'Gagal!',
			text: errorList,
			addclass: 'notification-error',
			icon: iconError,
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
