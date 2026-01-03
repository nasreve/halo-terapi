$("select").on("change", function () {
    setTimeout(() => {
        saveToSession();
    }, 250);
});

$("input, textarea").not("input:radio").on("blur", function () {
    saveToSession();
});

$("input:radio").on("change", function () {
    saveToSession();
});

function saveToSession() {
    $.ajax({
        url: sessionDataUrl, // di definisikan di 'resources/views/visitor/therapist/order/step-2.blade.php'
        type: $(".step2form").attr("method"),
        data: $(".step2form").serialize(),
    })
        .done(function (res) {})
        .fail(function (res) {
            if (res.responseJSON?.status === "session_expired") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        });
}
