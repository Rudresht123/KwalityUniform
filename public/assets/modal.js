/**
 * ==========================================================
 * Global UI Unlocker
 * ==========================================================
 */
$(document).on('mousedown touchstart', function(e) {
    if (!$(e.target).closest('.modal').length) {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css('overflow', '');
    }
});

/**
 * ==========================================================
 * Reusable AJAX Modal Loader
 * ==========================================================
 */

function loadModal(url, modalId) {

    const modalEl = document.getElementById(modalId);

    if (!modalEl) {
        console.error(`Modal '${modalId}' not found.`);
        return;
    }

    // Force clear state
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open').css('overflow', '');

    // Completely dispose of any existing instance
    const existingModal = bootstrap.Modal.getInstance(modalEl);
    if (existingModal) {
        existingModal.dispose();
    }

    // Create and show a brand new instance
    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    const $body = $(modalEl).find('.modal-body');

    /*
    |--------------------------------------------------------------------------
    | Loading State
    |--------------------------------------------------------------------------
    */

    $body.html(`
        <div class="modal-loading text-center">

            <div class="spinner-border text-primary mb-3" role="status"></div>

            <h6 class="fw-semibold mb-1">
                Please Wait...
            </h6>

            <small class="text-muted">
                Loading data...
            </small>

        </div>
    `);

    /*
    |--------------------------------------------------------------------------
    | Load Content
    |--------------------------------------------------------------------------
    */

    $body.load(url, function (response, status, xhr) {

        if (status === "success") {
            return;
        }

        let title = "Something Went Wrong";
        let message = "Unable to load the requested content.";

        switch (xhr.status) {

            case 404:
                title = "Record Not Found";
                message = "The requested record could not be found.";
                break;

            case 403:
                title = "Access Denied";
                message = "You don't have permission to access this resource.";
                break;

            case 500:
                title = "Server Error";
                message = "An unexpected server error occurred.";
                break;

            case 419:
                title = "Session Expired";
                message = "Please refresh the page and try again.";
                break;
        }

        $body.html(`
            <div class="modal-error-state">

                <div class="error-icon">
                    <i class="ti ti-alert-circle"></i>
                </div>

                <h5 class="fw-bold mb-2">
                    ${title}
                </h5>

                <p class="text-muted mb-4">
                    ${message}
                </p>

                <button
                    type="button"
                    class="btn btn-outline-primary"
                    data-bs-dismiss="modal">

                    Close

                </button>

            </div>
        `);
    });

}

/*
|--------------------------------------------------------------------------
| Open Modal
|--------------------------------------------------------------------------
*/

$(document).on("click", ".editUrl", function (e) {

    e.preventDefault();
    e.stopPropagation();

    const url = $(this).data("url");
    const modalId = $(this).data("modalid");

    loadModal(url, modalId);

});