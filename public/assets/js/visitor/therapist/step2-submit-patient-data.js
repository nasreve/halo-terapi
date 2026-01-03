$(".tbr_wizard_next").on("click", function (e) {
	e.preventDefault();

	$(".submit-button").trigger("click");
});

$(".step2form").on("submit", function (e) {
	e.preventDefault();
	$.ajax({
		url: this.action,
		type: this.method,
		data: $(".step2form").serialize(),
	})
		.done(function (res) {
			window.location.href = res.redirect;
		})
		.fail(function (res) {
			if (res.responseJSON?.status === "session_expired") {
				setTimeout(function () {
					window.location.reload();
				}, 1000);
			}

			$(":input").removeClass("is-invalid");
			$(".invalid-feedback").html("");

			$.each(res.responseJSON?.errors, function (key, value) {
				$(`[name='${key}']`).addClass("is-invalid");
				$(`[name='${key}']`).siblings(".invalid-feedback").html(value);
			});
		});
});
