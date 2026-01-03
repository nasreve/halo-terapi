$(".input-daterange").datepicker({
    format: 'dd-mm-yyyy',
    language: "id"
});

$(".btn-filter").on("click", function () {
    var queryString = $.param({
        date_start: $("#dateStart").val(),
        date_end: $("#dateEnd").val(),
        all_payment: $("#all-payment").val(),
        all_therapist: $("#all-therapist").val(),
        all_referrer: $("#all-referrer").val(),
    });

    orderDatatable.ajax.url(url + '?' + queryString).load()
});

function reset(e) {
    e.preventDefault();
    $("input").val("");
    $("#all-therapist").val(null).trigger('change');
    $("#all-payment").val(null).trigger('change');
    $("#all-referrer").val(null).trigger('change');
    $('#dateStart').datepicker("clearDates");
    $('#dateEnd').datepicker("clearDates");
    orderDatatable.search('');
    orderDatatable.ajax.url(url).load();
}