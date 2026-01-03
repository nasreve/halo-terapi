$(document).on("change", 'select[name="buyer_province"]', function () {
	let provinceName = $(this).val();
	$.ajax({
		url: "/regency/" + provinceName,
		type: "GET",
	})
		.done(function (res) {
			if (res) {
				$('select[name="buyer_regency"]').empty();
				$('select[name="buyer_district"]').empty();
				$('select[name="buyer_regency"]').append(
					'<option value="" selected disabled>Select</option>'
				);
				$('select[name="buyer_district"]').append(
					'<option value="" selected disabled>Select</option>'
				);
				$.each(res, function (key, value) {
					$('select[name="buyer_regency"]').append(
						'<option value="' + value["name"] + '">' + value["name"] + "</option>"
					);
				});
			} else {
				$('select[name="buyer_regency"]').empty();
			}

			saveToSession();
		})
		.fail(function (res) {
			let errorList = "";
			if (typeof res.responseJSON?.errors === "object") {
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

			var stack_topleft = {
				dir1: "down",
				dir2: "left",
				push: "bottom",
				spacing1: 50,
				spacing2: 100,
			};

			new PNotify({
				title: "Gagal!",
				text: errorList,
				addclass: "notification-error",
				icon: "tbr_icon_error",
				type: "error",
				stack: stack_topleft,
				width: "348px",
				buttons: {
					sticker: false,
				},
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
