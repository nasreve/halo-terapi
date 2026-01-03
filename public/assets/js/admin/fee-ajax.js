const feeSubmitButton = $("#apply-button");
const feeButtonText = feeSubmitButton.html();

$(document).on("click", ".modal-dismiss", function (e) {
    e.preventDefault();
    $.magnificPopup.close();
});

$("#showWarning").on("click", function (e) {
    e.preventDefault();
    $.magnificPopup.open({
        modal: true,
        items: {
            src: $("#fee-warning-modal"),
            type: "inline",
        },
        callbacks: {
            open: function () {
                const applyButton = $("#apply-button");
                applyButton.off().on("click", function () {
                    $(".fee-form").trigger("submit");
                });
            },
        },
    });
})

$(".fee-form").on("submit", function (e) {
    const redirect = $(this).attr('data-redirect');
    e.preventDefault();
    feeSubmitButton.prop("disabled", true);
    feeSubmitButton.html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses`
    );
    $.ajax({
        url: this.action,
        type: this.method,
        data: $(this).serialize(),
    })
        .done(function (res) {
            new PNotify({
                title: "Berhasil!",
                text: res?.message,
                addclass: "icon-nb",
                width: "340px",
                icon: false,
                type: "success",
                animate_speed: "fast",
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
        })
        .fail(function (res) {
            let errorList = "";
            if (typeof (res.responseJSON?.errors) === 'object') {
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
            new PNotify({
                title: "Gagal!",
                text: errorList,
                icon: false,
                width: "340px",
                type: "error",
                animate_speed: "fast",
            });
            feeSubmitButton.prop("disabled", false);
            feeSubmitButton.html(feeButtonText);
            if (res.responseJSON?.status === "session_expired") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        });
});
