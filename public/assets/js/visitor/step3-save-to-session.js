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
        url: sessionDataUrl, // Didefinisikan di blade
        type: "POST",
        data: $(".step3form").serialize(),
    })
        .done(function (res) {})
        .fail(function () {
            if (res.responseJSON?.status === "session_expired") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        });
}
