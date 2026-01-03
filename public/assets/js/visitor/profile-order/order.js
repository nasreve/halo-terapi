// url di definisikan di blade file

var canOrder = true;

$(document).on("click", ".tbr_service_card input[type='checkbox']", function (e) {
	const service_id = $(this).val();

	if (!canOrder) {
		return false;
	}

	canOrder = false;

	$.ajax({
		url: url,
		method: "POST",
		data: {
			_token: $('meta[name="csrf-token"]').attr("content"),
			service_id: service_id,
			username: username,
		},
	})
		.done(function (res) {
			window.location.reload();
		})
		.fail(function name(params) {
			responsFail(res);
		});
});

$(document).on("click", ".tbr_btn-order-modal, .tbr_btn-cancel-modal", function (e) {

	if (!canOrder) {
		return false;
	}

	canOrder = false;

	const service_id = $(this)
		.parents(".tbr_modal")
		.siblings(".tbr_service_card")
		.find("input[type='checkbox']")
		.val();

	$.ajax({
		url: url,
		method: "POST",
		data: {
			_token: $('meta[name="csrf-token"]').attr("content"),
			service_id: service_id,
			username: username,
		},
	})
		.done(function (res) {
			window.location.reload();
		})
		.fail(function (res) {
			responsFail(res);
		});
});

$(".tbr_modal_login").on("hidden.bs.modal", function () {
	$("input[name='username']").attr("disabled", "");
});

function openLoginModal($value) {
	$(".tbr_modal_login").modal("show");
	$("input[name='username']").removeAttr("disabled");
	$("input[name='username']").val(username);
}

function responsFail(res) {
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
}