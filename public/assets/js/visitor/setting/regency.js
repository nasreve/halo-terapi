$(document).on("change", 'select[name="regency_id"]', function () {
	let regencyId = $(this).val();
	$.ajax({
		url: "/district/" + regencyId,
		type: "GET",
	})
		.done(function (res) {
			if (res) {
				$('select[name="district_id"]').empty();
				$('select[name="district_id"]').append(
					'<option value="" selected disabled>Select</option>'
				);
				$.each(res, function (key, value) {
					$('select[name="district_id"]').append(
						'<option value="' + value["id"] + '">' + value["name"] + "</option>"
					);
				});
			} else {
				$('select[name="district_id"]').empty();
			}
		})
		.fail(function (res) {
			setTimeout(function () {
				window.location.reload();
			}, 1000);
		});
});
