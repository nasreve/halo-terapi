// Memilih terapis
$(document).on("change", ".tbr_therapist > input", function (e) {
    $.ajax({
        url: "/patient/order/step-2/choose",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            therapist_id: $(this).val(),
            service_id: $(this).data("service"),
        },
    })
        .done(function () {
            $(e.target).closest(".tbr_accordion_item").find(".main-form").val($(e.target).val());
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
