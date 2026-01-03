// submit data & validate
$(".tbr_wizard_next").on("click", function () {
	$.ajax({
		url: "/patient/order/step-2/submits",
		type: "POST",
		data: $(".step2form").serialize(),
	})
		.done(function (res) {
			window.location.href = res.redirect;
		})
		.fail(function (res) {
			$(":input").removeClass("is-invalid");
			$(".invalid-feedback").html("");
			$.each(res.responseJSON?.errors, function (key, value) {
				$(`[name='${key}']`).addClass("is-invalid");
				$(`[name='${key}']`).siblings(".invalid-feedback").html(value);
			});

            if (res.responseJSON?.status === "session_expired") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
		});
});
