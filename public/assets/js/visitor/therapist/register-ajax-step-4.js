const submitButton = $("button:submit");
const buttonText = submitButton.html();

$(".main_form").on("submit", function (e) {
	e.preventDefault();
	submitButton.prop("disabled", true);
	submitButton.html(
		`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses`
	);

	$('.summernote').each(function(){
        var summernote = $(this);
        if (summernote.summernote('isEmpty')) {
            summernote.val('');
        }else if(summernote.val()=='<p><br></p>'){
            summernote.val('');
        }
    });

	$.ajax({
		url: this.action,
		type: this.method,
		data: $(this).serialize(),
	})
		.done(function (res) {
			setTimeout(function () {
				window.location = res.redirect;
			}, 1000);
		})
		.fail(function (res) {
			submitButton.prop("disabled", false);
			submitButton.html(buttonText);

			$(":input").removeClass("is-invalid");
			$(".invalid-feedback").html("");

			$(".invalid-feedback-location").removeClass("d-block");
			$(".invalid-feedback-location").html("");

			$(".invalid-feedback-rate").removeClass("d-block");
			$(".invalid-feedback-rate").html("");

			$.each(res.responseJSON?.errors, function (key, value) {
				if (key.includes("regency") || key.includes("district")) {
					$(".invalid-feedback-location").addClass("d-block");
					$(".invalid-feedback-location").html(value);
				}

				if (key.includes("rate")) {
					$(".invalid-feedback-rate").addClass("d-block");
					$(".invalid-feedback-rate").html(value);
				}

				$(`[name='${key}']`).addClass("is-invalid");
				$(`[name='${key}']`).siblings(".invalid-feedback").html(value);
			});

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

			if (res.responseJSON?.status === "session_expired") {
				setTimeout(function () {
					window.location.reload();
				}, 1000);
			}
		});
});
