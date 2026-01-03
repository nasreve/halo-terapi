$(document).on("change", 'select[name="buyer_regency"]', function () {
    let regencyId = $(this).val();
    $.ajax({
        url: "/district/" + regencyId,
        type: "GET",
    }).done(function (res) {
        if (res) {
            $('select[name="buyer_district"]').empty();
            $('select[name="buyer_district"]').append('<option value="" selected disabled>Select</option>');
            $.each(res, function (key, value) {
                $('select[name="buyer_district"]')
                    .append('<option value="' + value['name'] + '">' + value['name'] + '</option>');
            });
        } else {
            $('select[name="buyer_district"]').empty();
        }
    }).fail(function () {
        window.location.reload();
    });
});
