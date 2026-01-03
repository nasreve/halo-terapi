const submitButton = $("button:submit");
const buttonText = submitButton.html();

$(".main_form").on("submit", function (e) {
	const redirect = $(this).attr("data-redirect");
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
			submitButton.prop("disabled", false);
			submitButton.html(buttonText);

			if (res.status === 422) {
				$(":input").removeClass("is-invalid");
				$(".invalid-feedback").html("");

				$.each(res.responseJSON?.errors, function (key, value) {
					$(`[name='${key}']`).addClass("is-invalid");
					$(`[name='${key}']`).siblings(".invalid-feedback").html(value);
				});
			}

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
