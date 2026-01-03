$(".main_form").on("submit", function (e) {
	const submitButton = $(this).find("button:submit");
	const buttonText = submitButton.html();
	const redirect = $(this).attr("data-redirect");

	e.preventDefault();

	showLoader();

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
			doneAjax(res, redirect);
		})
		.fail(function (res) {
			removeLoader();
			failAjax(res, submitButton, buttonText);
		});
});

$(".secondary_form").on("submit", function (e) {
	const submitButton = $(this).find("button:submit");
	const buttonText = submitButton.html();
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
			doneAjax(res, redirect);
		})
		.fail(function (res) {
			failAjax(res, submitButton, buttonText);
		});
});

function doneAjax(res, redirect) {
	var stack_topleft = {
		dir1: "down",
		dir2: "left",
		push: "bottom",
		spacing1: 50,
		spacing2: 100,
	};
	new PNotify({
		title: "Berhasil",
		text: res?.message,
		addclass: "notification-primary",
		icon: "tbr_icon_success",
		type: "success",
		stack: stack_topleft,
		width: "348px",
		buttons: {
			sticker: false,
		},
	});

	if (typeof redirect !== typeof undefined && redirect !== false) {
		setTimeout(function () {
			window.location = redirect;
		}, 1000);
	} else {
		setTimeout(function () {
			window.location.reload();
		}, 1000);
	}
}

function failAjax(res, submitButton, buttonText) {
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

	if (res.status === 422) {
		$(":input").removeClass("is-invalid");
		$(".invalid-feedback").html("");

		$.each(res.responseJSON?.errors, function (key, value) {
			$(`[name='${key}']`).addClass("is-invalid");
			$(`[name='${key}']`).siblings(".invalid-feedback").html(value);
		});
	}

	submitButton.prop("disabled", false);
	submitButton.html(buttonText);

	if (res.responseJSON?.status === "session_expired") {
		setTimeout(function () {
			window.location.reload();
		}, 1000);
	}
}

function showLoader() {
	$("#ajax-wrapper").find(".text-center").css({
		position: "relative",
		opacity: 0.4
	});
	$("#ajax-wrapper").prepend(`
		<div class="position-absolute" id="update-loader" style="right: 50%; top: 50%; z-index: 999">
			<div class="spinner-border text-success" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
	`);
}

function removeLoader() {
	$("#update-loader").remove();
}
