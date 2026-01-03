$(document).on("change", 'select[name="buyer_province"]', function () {
    let provinceId = $(this).val();
    $.ajax({
        url: "/regency/" + provinceId,
        type: "GET",
    }).done(function (res) {
        if (res) {
            $('select[name="buyer_regency"]').empty();
            $('select[name="buyer_district"]').empty();
            $('select[name="buyer_regency"]').append('<option value="" selected disabled>Select</option>');
            $('select[name="buyer_district"]').append('<option value="" selected disabled>Select</option>');
            $.each(res, function (key, value) {
                $('select[name="buyer_regency"]')
                    .append('<option value="' + value['name'] + '">' + value['name'] + '</option>');
            });
        } else {
            $('select[name="buyer_regency"]').empty();
        }
    }).fail(function () {
        window.location.reload();
    });
});
