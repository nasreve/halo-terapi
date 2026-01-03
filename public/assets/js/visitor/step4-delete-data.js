$(".tbr_wizard_next").on("click", function () {
	$(".tbr_main_form").trigger("submit");
});

$(document).on("click", ".tbr_btn_remove", function () {
	$.ajax({
		url: "/patient/order/step-4",
		data: {
			service_id: $(this).data("service"),
			therapist_id: $(this).data("therapist"),
		},
	})
		.done(function (res) {
			window.location.reload();
		})
		.fail(function (res) {
            if (res.responseJSON?.status === "session_expired") {
				setTimeout(function () {
					window.location.reload();
				}, 1000);
			}
        });
});
