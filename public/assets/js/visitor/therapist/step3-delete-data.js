$(".tbr_wizard_next").on("click", function () {
	$(".tbr_main_form").trigger("submit");
});

$(document).on("click", ".tbr_btn_remove", function () {
	$.ajax({
		url: "/therapist/order/step-3/delete",
		type: "POST",
		data: {
			_token: $('meta[name="csrf-token"]').attr("content"),
			service_id: $(this).data("service"),
		},
	})
		.done(function (res) {
			window.location.reload();
		})
		.fail(function (res) {
			if (res.status === 500) {
                var stack_topleft = {"dir1": "down", "dir2": "left", "push": "bottom", "spacing1": 50, "spacing2": 100};
                new PNotify({
                    title: "Gagal!",
                    text: res.responseJSON?.message,
                    addclass: 'notification-error',
                    icon: "tbr_icon_error",
                    type: "error",
                    stack: stack_topleft,
                    width: "348px",
                    buttons: {
                        sticker: false
                    }
                });
            }

            if (res.responseJSON?.status === "session_expired") {
				setTimeout(function () {
					window.location.reload();
				}, 1000);
			}
        });
});
