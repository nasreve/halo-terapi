const submitButton = $("button:submit");
const buttonText = submitButton.html();

$(".main_form").on("submit", function (e) {
	e.preventDefault();

    $('.summernote').each(function(){
        var summernote = $(this);
        if (summernote.summernote('isEmpty')) {
            summernote.val('');
        }else if(summernote.val()=='<p><br></p>'){
            summernote.val('');
        }
    });

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
			setTimeout(function () {
				window.location = res.redirect;
			}, 1000);
		})
		.fail(function (res) {
			$(`.invalid-feedback`).removeClass("d-block");
			$(`.invalid-feedback`).html("");

			$.each(res.responseJSON?.errors, function (key, value) {
				$(`.invalid-feedback-${key}`).addClass("d-block");
				$(`.invalid-feedback-${key}`).html(value);
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
