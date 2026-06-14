/**
 * Toast Notification System
 * Displays beautiful toast notifications in the top-right corner
 */

class ToastNotification {
    constructor() {
        this.container = null;
        this.init();
    }

    init() {
        // Create container if it doesn't exist
        if (!document.querySelector('.toast-container-custom')) {
            this.container = document.createElement('div');
            this.container.className = 'toast-container-custom';
            document.body.appendChild(this.container);
        } else {
            this.container = document.querySelector('.toast-container-custom');
        }
    }

    /**
     * Show a toast notification
     * @param {string} message - The message to display
     * @param {string} type - Type of notification (success, error, warning, info)
     * @param {number} duration - Duration in milliseconds (0 for no auto-hide)
     */
    show(message, type = 'info', duration = 5000) {
        const toast = this.createToast(message, type);
        this.container.appendChild(toast);

        // Trigger animation
        setTimeout(() => {
            toast.style.display = 'block';
        }, 10);

        // Auto-hide after duration
        if (duration > 0) {
            setTimeout(() => {
                this.hide(toast);
            }, duration);
        }

        return toast;
    }

    /**
     * Create toast element
     * @private
     */
    createToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast-custom ${type}`;

        // Determine icon based on type
        const icons = {
            success: '<i class="ti ti-circle-check"></i>',
            error: '<i class="ti ti-alert-circle"></i>',
            warning: '<i class="ti ti-alert-triangle"></i>',
            info: '<i class="ti ti-info-circle"></i>',
        };

        // Determine title based on type
        const titles = {
            success: 'Success',
            error: 'Error',
            warning: 'Warning',
            info: 'Information',
        };

        const icon = icons[type] || icons.info;
        const title = titles[type] || 'Notification';

        toast.innerHTML = `
            <div class="toast-header-custom">
                <div class="toast-icon">${icon}</div>
                <h6 class="toast-title">${title}</h6>
                <button type="button" class="toast-close ms-auto">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="toast-body-custom">${message}</div>
            <div class="progress-bar-custom"></div>
        `;

        // Close button handler
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => this.hide(toast));

        return toast;
    }

    /**
     * Hide and remove toast
     * @private
     */
    hide(toast) {
        toast.classList.add('removing');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }

    /**
     * Convenience methods
     */
    success(message, duration = 5000) {
        return this.show(message, 'success', duration);
    }

    error(message, duration = 5000) {
        return this.show(message, 'error', duration);
    }

    warning(message, duration = 5000) {
        return this.show(message, 'warning', duration);
    }

    info(message, duration = 5000) {
        return this.show(message, 'info', duration);
    }
}

// Initialize globally
const toast = new ToastNotification();

/**
 * Auto-show toasts from Laravel session flash messages
 */
document.addEventListener('DOMContentLoaded', function () {
    // Check for Laravel session data in page attributes or global data
    const body = document.body;
    const successMessage = body.getAttribute('data-toast-success');
    const errorMessage = body.getAttribute('data-toast-error');
    const warningMessage = body.getAttribute('data-toast-warning');
    const infoMessage = body.getAttribute('data-toast-info');

    if (successMessage) {
        toast.success(successMessage);
    }
    if (errorMessage) {
        toast.error(errorMessage);
    }
    if (warningMessage) {
        toast.warning(warningMessage);
    }
    if (infoMessage) {
        toast.info(infoMessage);
    }

    // Alternative: Look for hidden div elements (if using template-based approach)
    const successDiv = document.getElementById('toast-success-message');
    if (successDiv && successDiv.textContent) {
        toast.success(successDiv.textContent);
    }

    const errorDiv = document.getElementById('toast-error-message');
    if (errorDiv && errorDiv.textContent) {
        toast.error(errorDiv.textContent);
    }
});

// Example usage:
// toast.success('Vendor created successfully!');
// toast.error('Something went wrong');
// toast.warning('Please review this');
// toast.info('This is informational');
