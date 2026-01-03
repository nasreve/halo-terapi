$(document).on("change", 'select[name="province_id"]', function () {
	let provinceId = $(this).val();
	$.ajax({
		url: "/regency/" + provinceId,
		type: "GET",
	})
		.done(function (res) {
			if (res) {
				$('select[name="regency_id"]').empty();
				$('select[name="district_id"]').empty();
				$('select[name="regency_id"]').append(
					'<option value="" selected disabled>Select</option>'
				);
				$('select[name="district_id"]').append(
					'<option value="" selected disabled>Select</option>'
				);
				$.each(res, function (key, value) {
					$('select[name="regency_id"]').append(
						'<option value="' + value["id"] + '">' + value["name"] + "</option>"
					);
				});
			} else {
				$('select[name="regency_id"]').empty();
			}
		})
		.fail(function (res) {
			setTimeout(function () {
				window.location.reload();
			}, 1000);
		});
});
