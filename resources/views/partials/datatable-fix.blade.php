<style>
    /* Fix for dropdown menus being clipped in responsive tables */
    .table-responsive {
        overflow: visible !important;
    }
    
    /* Ensure the table itself doesn't clip the dropdown */
    .card .table-responsive {
        overflow-x: visible !important;
        overflow-y: visible !important;
    }

    /* Force higher z-index on the dropdown menu */
    .dropdown-menu {
        z-index: 9999 !important;
    }
</style>
