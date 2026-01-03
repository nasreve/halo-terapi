$(".tbr_wizard_next").on("click", function () {
	const submitButton = $(this);
	const buttonText = submitButton.html();

	submitButton.prop("disabled", true);
    submitButton.html(
        `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses`
    );

	$.ajax({
		url: "/therapist/order/step-3/submit",
		type: "POST",
		data: {
			_token: $('meta[name="csrf-token"]').attr("content"),
		},
	})
		.done(function (res) {
			window.location.href = res.redirect;
		})
		.fail(function (res) {
			submitButton.prop("disabled", false);
        	submitButton.html(buttonText);

			if (res.status === 500) {
				var stack_topleft = {
					dir1: "down",
					dir2: "left",
					push: "bottom",
					spacing1: 50,
					spacing2: 100,
				};

				new PNotify({
					title: "Gagal!",
					text: res.responseJSON?.message,
					addclass: "notification-error",
					icon: "tbr_icon_error",
					type: "error",
					stack: stack_topleft,
					width: "348px",
					buttons: {
						sticker: false,
					},
				});
			}

			if (res.responseJSON?.status === "session_expired") {
				setTimeout(function () {
					window.location.reload();
				}, 1000);
			}
		});
});
