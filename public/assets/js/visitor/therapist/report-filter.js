var DateTime = luxon.DateTime;

$(".input-daterange").datepicker({
    format: 'dd-mm-yyyy',
    language: "id"
});

// Date range filter
minDateFilter = "";
maxDateFilter = "";

function filterDate() {
    $.fn.dataTableExt.afnFiltering.push(
        function (oSettings, aData, iDataIndex) {
            var DateTime = luxon.DateTime;
            if (typeof aData._date == 'undefined') {
                aData._date = DateTime.fromFormat(aData[1], "dd MMMM yyyy", { locale: "id" }).toMillis();
            }

            if (minDateFilter && !isNaN(minDateFilter)) {
                if (aData._date < minDateFilter) {
                    return false;
                }
            }

            if (maxDateFilter && !isNaN(maxDateFilter)) {
                if (aData._date > maxDateFilter) {
                    return false;
                }
            }

            if (!aData._date) {
                return false;
            }

            return true;
        }
    );
}

$(".btn-filter").on("click", function () {
    serachData();
});

function serachData() {
    minDateFilter = DateTime.fromFormat($("#dateStart").val(), "dd-MM-yyyy").toMillis();
    maxDateFilter = DateTime.fromFormat($("#dateEnd").val(), "dd-MM-yyyy").toMillis();

    filterDate();

    orderDatatable
        .column(5)
        .search($("#payment-method").val(), true, false)
        .draw();
}

function reset(e) {
    e.preventDefault();
    $("input").val("");
    $("#payment-method").val(null).trigger('change');
    $('#dateStart').datepicker("clearDates");
    $('#dateEnd').datepicker("clearDates");
    orderDatatable.search('');

    serachData();
}