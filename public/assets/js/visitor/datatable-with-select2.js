(function($) {

    'use strict';

    if ( $.isFunction( $.fn[ 'dataTable' ] ) ) {

        $.extend(true, $.fn.dataTable.defaults, {
            oLanguage: {
                sLengthMenu: '_MENU_',
                sProcessing: '<i class="fas fa-spinner fa-spin"></i> Loading',
                sSearch: ''
            },
            fnInitComplete: function( settings, json ) {
                // select 2
                if ( $.isFunction( $.fn[ 'select2' ] ) ) {
                    $('.dataTables_length select', settings.nTableWrapper).select2({
                        theme: 'bootstrap',
                        minimumResultsForSearch: -1
                    });
                }

                var options = $( 'table', settings.nTableWrapper ).data( 'plugin-options' ) || {};

                // search
                var $search = $('.dataTables_filter input', settings.nTableWrapper);

                $search
                    .attr({
                        placeholder: typeof options.searchPlaceholder !== 'undefined' ? options.searchPlaceholder : 'Search'
                    })
                    .removeClass('form-control-sm').addClass('form-control pull-right');

                if ( $.isFunction( $.fn.placeholder ) ) {
                    $search.placeholder();
                }
            }
        });

    }

    // $.extend(true, $.fn.dataTable.defaults, {
    //     oLanguage: {
    //         "sEmptyTable":     "No data available in table",
    //         "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
    //         "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
    //         "sInfoFiltered":   "(filtered from _MAX_ total entries)",
    //         "sInfoPostFix":    "",
    //         "sInfoThousands":  ",",
    //         "sLengthMenu":     "Show _MENU_ entries",
    //         "sLoadingRecords": "Loading...",
    //         "sProcessing":     "Processing...",
    //         "sSearch":         "Search:",
    //         "sZeroRecords":    "No matching records found",
    //         "oPaginate": {
    //             "sFirst":    "First",
    //             "sLast":     "Last",
    //             "sNext":     "Next",
    //             "sPrevious": "Previous"
    //         },
    //         "oAria": {
    //             "sSortAscending":  ": activate to sort column ascending",
    //             "sSortDescending": ": activate to sort column descending"
    //         }
    //     }
    // });
}).apply(this, [jQuery]);