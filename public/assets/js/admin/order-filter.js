$(".input-daterange").datepicker({
    format: 'dd-mm-yyyy',
    language: "id"
});

$(".btn-filter").on("click", function () {
    var queryString = $.param({
        date_start: $("#dateStart").val(),
        date_end: $("#dateEnd").val(),
        referrer: $("#referralFilter").val(),
        therapist: $("#therapistFilter").val(),
    });

    orderDatatable.ajax.url(url + '?' + queryString).load()
});

function reset(e) {
    e.preventDefault();
    $("input").val("");
    $("#referralFilter").val(null).trigger('change');
    $("#therapistFilter").val(null).trigger('change');
    $('#dateStart').datepicker("clearDates");
    $('#dateEnd').datepicker("clearDates");
    orderDatatable.search('');
    orderDatatable.ajax.url(url).load();
}