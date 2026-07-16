/**
 * Global DataTable Initialization
 *
 * @param {string|object} selector
 * @param {object} options
 * @returns DataTable
 */
function initDataTable(selector, options = {}) {

    const defaults = {

        /* ==========================
           Layout
        ========================== */
        dom:
            "<'row align-items-center mb-3'<'col-md-6'l><'col-md-6 text-md-end text-start mt-2 mt-md-0'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row align-items-center mt-3'<'col-md-5 text-md-start text-center'i><'col-md-7 text-md-end text-center mt-2 mt-md-0'p>>",

        /* ==========================
           Pagination
        ========================== */
        pageLength: 15,

        lengthMenu: [
            [10,15,25,50,100,200,500],
            [10,15,25,50,100,200,500]
        ],

        /* ==========================
           Language
        ========================== */
        language: {

            lengthMenu: "Show _MENU_ Entries",

            search: "",

            searchPlaceholder: "Search here...",

            info: "Showing _START_ to _END_ of _TOTAL_ entries",

            infoEmpty: "No entries available",

            zeroRecords: "No matching records found",

            paginate: {

                previous: '<i class="ti ti-chevron-left"></i>',

                next: '<i class="ti ti-chevron-right"></i>'

            }

        },

        /* ==========================
           Features
        ========================== */

        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        autoWidth: false,

        processing: false,
        serverSide: false,

        order: [[0, 'desc']]

    };

    return $(selector).DataTable(
        $.extend(true, {}, defaults, options)
    );
}

function initializeDatatable(selector, options = {}) {
    return initDataTable(selector, options);
}


/* ===================================================
   Auto Initialization
=================================================== */

$(function () {

    /* Normal Datatable */

    $('.datatable').each(function () {

        if (!$.fn.DataTable.isDataTable(this)) {

            initDataTable(this);

        }

    });

    /* Ajax / Server Datatable */

    $('.serversideDatatable').each(function () {

        if (!$.fn.DataTable.isDataTable(this)) {

            const table = $(this);

            initDataTable(this, {

                processing: true,

                serverSide: table.data('server-side') ?? false,

                ajax: table.data('url'),

                columns: table.data('columns'),

                pageLength: table.data('page-length') ?? 10

            });

        }

    });

});