$("input[name='email']").on("blur", function () {
	$.ajax({
		url: emailUrl,
		type: "POST",
		data: {
			_token: $("meta[name=csrf-token]").attr("content"),
			email: $(this).val(),
		},
	})
		.done(function (res) {
			if (res.status === "Found") {
				$("#confirm-email").modal("show");
			}
		})
		.fail(function (res) {
			window.location.reload();
		});
});

$("#use-email-data").on("click", function () {
	$.ajax({
		url: applyEmailUrl,
		type: "POST",
		data: {
			_token: $("meta[name=csrf-token]").attr("content"),
			email: $("input[name='email']").val(),
			symptoms: $("textarea[name='symptoms']").val(),
			unique_reff: $("input[name='unique_reff']").val(),
			payment_method: $("input[name='payment_method']").val(),
			apply: true,
		},
	})
		.done(function (res) {
			$("#confirm-email").modal("hide");
			window.location.reload();
		})
		.fail(function (res) {
			window.location.reload();
		});
});

// $("#dismiss-button").on("click", function() {
//     $.ajax({
//         url: applyEmailUrl,
//         type: 'POST',
//         data: {
//             _token: $("meta[name=csrf-token]").attr("content"),
//             email: $("input[name='email']").val(),
//         }
//     }).done(function(res) {
//         $("#confirm-email").modal("hide");
//         window.location.reload();
//     }).fail(function(res) {
//         window.location.reload();
//     });
// });
