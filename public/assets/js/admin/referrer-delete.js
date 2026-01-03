$(".modal-basic").magnificPopup({
    type: "inline",
    preloader: false,
    modal: true,
});

$(document).on("click", ".modal-dismiss", function (e) {
    e.preventDefault();
    $.magnificPopup.close();
});

function deleteData(event, id, url) {
    event.preventDefault();
    $.magnificPopup.open({
        modal: true,
        items: {
            src: $("#delete"),
            type: "inline",
        },
        callbacks: {
            open: function () {
                const delete_button = $(".delete");
                delete_button.off().on("click", function () {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: $("meta[name=csrf-token]").attr("content"),
                        },
                        beforeSend: function () {
                            delete_button.prop("disabled", true);
                            delete_button.html(
                                `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses`
                            );
                        },
                    })
                    .done(function (res) {
                        new PNotify({
                            title: "Berhasil!",
                            text: res.message,
                            type: "success",
                            addclass: "icon-nb",
                            width: "340px",
                            animate_speed: "fast",
                            icon: false,
                        });
                        setTimeout(() => {
                            window.location = "/admin/referrer"
                        }, 1000);
                    })
                    .fail(function (res) {
                        let errorList = "";
                        if (typeof(res.responseJSON?.errors) === 'object') {
                            $.each(
                                res.responseJSON?.errors,
                                function (key, value) {
                                    if (value.length > 1) {
                                        $.each(value, function (key, value) {
                                            errorList += value + "<br/>";
                                        });
                                    } else {
                                        errorList += value + "<br/>";
                                    }
                                }
                            );
                        } else {
                            errorList += res.responseJSON?.message;
                        }
                        new PNotify({
                            title: "<strong>Gagal!</strong>",
                            text: errorList,
                            icon: false,
                            width: "340px",
                            type: "error",
                            animate_speed: "fast",
                        });
                        delete_button.prop("disabled", false);
                        delete_button.html('Ya, Hapus');
                        if (
                            res.responseJSON?.status === "session_expired"
                        ) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    });
                });
            },
        },
    });
}
