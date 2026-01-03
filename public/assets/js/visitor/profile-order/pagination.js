$(document).on("click", ".page-item", function (e) {
	if ($(this).hasClass("tbr_disabled")) {
		return false;
	}

	e.preventDefault();

	$.ajax({
		url: $(this).find(".page-link").attr("href"),
	})
		.done(function (res) {
			$("#service").replaceWith($(res).find("#service"));
		})
		.fail(function (res) {
			window.location.reload();
		});
});
