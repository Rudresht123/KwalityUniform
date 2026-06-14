/**
 * Global DataTable Initialization Function
 * 
 * @param {string} selector - CSS selector for the table
 * @param {object} options - Custom options for DataTable
 * @returns {object} - DataTable instance
 */
function initDataTable(selector, options = {}) {
    const defaultOptions = {
        /* =================================
           Layout
        ================================= */
        dom:
            "<'row align-items-center mb-3'<'col-md-6'l><'col-md-6 text-md-end text-start mt-2 mt-md-0'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row align-items-center mt-3'<'col-md-5 text-md-start text-center'i><'col-md-7 text-md-end text-center mt-2 mt-md-0'p>>",

        /* =================================
           Page Length
        ================================= */
        pageLength: 15,
        lengthMenu: [
            [10, 15, 25, 50, 100, 200, 500],
            [10, 15, 25, 50, 100, 200, 500]
        ],

        /* =================================
           Language
        ================================= */
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

        /* =================================
           Features
        ================================= */
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        autoWidth: false,
        processing: false,
        serverSide: false,

        /* =================================
           Defaults
        ================================= */
        order: [[0, 'desc']],
    };

    // Merge default options with user-provided options
    const finalOptions = $.extend(true, {}, defaultOptions, options);

    // Initialize and return the DataTable
    return $(selector).DataTable(finalOptions);
}

// Auto-initialize tables with '.datatable' class (Legacy support)
$(document).ready(function() {
    if ($('.datatable').length > 0 && !$.fn.DataTable.isDataTable('.datatable')) {
        initDataTable('.datatable');
    }
});
