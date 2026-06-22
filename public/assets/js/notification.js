
// Notification hide system
function hideNotification(notificationId)
{
    fetch('/notifications/hide', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        body: JSON.stringify({
            notification_id: notificationId
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {

            // Remove notification row
            const item = document.getElementById(
                `notification-${notificationId}`
            );

            if (item) {
                item.remove();
            }

            // Update Bell Count
            const badge = document.getElementById(
                'notification-icon-badge'
            );

            if (badge) {

                let count = parseInt(badge.innerText);

                count--;

                if (count <= 0) {

                    badge.classList.add('d-none');

                    const unreadText =
                        document.getElementById('notifiation-data');

                    if (unreadText) {
                        unreadText.innerText = '0 Unread';
                    }

                } else {

                    badge.innerText = count;

                    const unreadText =
                        document.getElementById('notifiation-data');

                    if (unreadText) {
                        unreadText.innerText = count + ' Unread';
                    }
                }
            }
        }
    })
    .catch(error => {
        console.error(error);
    });
}

function showToast({
    title = 'Notification',
    message = 'You have a new notification',
    type = 'info',
    url = null
}) {

    let container = document.getElementById('custom-toast-container');

    if (!container) {
        container = document.createElement('div');
        container.id = 'custom-toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `custom-toast custom-toast-${type}`;

    const toastId = Date.now();

    toast.innerHTML = `
        <div class="toast-progress"></div>

        <div class="toast-unread-dot"></div>

        <div class="toast-icon">
            ${getToastIcon(type)}
        </div>

        <div class="toast-content">

            <div class="toast-header">
                <div class="toast-title">
                    ${title}
                </div>

                <div class="toast-actions">
                    <span class="toast-time">
                        just now
                    </span>

                    <button class="toast-close">
                        ✕
                    </button>
                </div>
            </div>

            <div class="toast-message">
                ${message}
            </div>

            ${
                url
                    ? `
                    <div class="toast-footer">
                        <span class="toast-link">
                            View Details →
                        </span>
                    </div>
                `
                    : ''
            }

        </div>
    `;

    container.prepend(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 50);

    let removeTimer = setTimeout(() => {
        removeToast(toast);
    }, 7000);

    // Pause auto close on hover
    toast.addEventListener('mouseenter', () => {
        clearTimeout(removeTimer);
    });

    toast.addEventListener('mouseleave', () => {
        removeTimer = setTimeout(() => {
            removeToast(toast);
        }, 3000);
    });

    // Click anywhere to open
    if (url) {
        toast.style.cursor = 'pointer';

        toast.addEventListener('click', (e) => {

            if (
                e.target.classList.contains('toast-close')
            ) {
                return;
            }

            window.location.href = url;
        });
    }

    // Close Button
    toast.querySelector('.toast-close')
        ?.addEventListener('click', (e) => {
            e.stopPropagation();
            removeToast(toast);
        });
}

function removeToast(toast) {

    if (!toast) return;

    toast.classList.remove('show');
    toast.classList.add('hide');

    setTimeout(() => {
        toast.remove();
    }, 300);
}

function getToastIcon(type) {

    switch (type) {

        case 'success':
            return `
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
            `;

        case 'danger':
        case 'error':
            return `
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M15 9l-6 6M9 9l6 6"/>
                </svg>
            `;

        case 'warning':
            return `
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 9v4"/>
                    <path d="M12 17h.01"/>
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            `;

        default:
            return `
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                </svg>
            `;
    }
}

/**
 * Update Notification Badge
 */
function updateNotificationBadge()
{
    let badge = document.getElementById('notification-icon-badge');

    if (badge) {

        let count = parseInt(badge.innerText || 0);

        badge.innerText = count + 1;

    } else {

        const bell = document.querySelector('.header-link');

        if (bell) {

            bell.insertAdjacentHTML(
                'beforeend',
                `
                <span
                    id="notification-icon-badge"
                    class="badge bg-danger header-icon-badge">
                    1
                </span>
                `
            );
        }
    }
}


/**
 * Update Unread Text
 */
function updateUnreadText()
{
    const unreadText =
        document.getElementById('notifiation-data');

    if (!unreadText) return;

    const currentCount = parseInt(
        unreadText.innerText.replace(/\D/g, '') || 0
    );

    unreadText.innerText =
        `${currentCount + 1} Unread`;
}


/**
 * Play Notification Sound
 */
let audioUnlocked = false;

document.addEventListener('click', () => {

    const audio = new Audio(
        '/assets/mixkit-positive-notification-951.wav'
    );

    audio.volume = 0;

    audio.play()
        .then(() => {

            audio.pause();
            audio.currentTime = 0;

            audioUnlocked = true;

            console.log('Audio unlocked');

        })
        .catch(() => {});

}, { once: true });
function playNotificationSound()
{
    try {

        // Browser ne abhi tak audio permission nahi di
        if (!audioEnabled) {

            console.warn(
                'Notification sound blocked until user interacts with the page.'
            );

            return;
        }

        const audio = new Audio(
            '/assets/mixkit-positive-notification-951.wav'
        );

        audio.volume = 0.7;

        audio.play()
            .then(() => {

                console.log(
                    'Notification sound played.'
                );

            })
            .catch(error => {

                console.warn(
                    'Audio playback blocked:',
                    error.message
                );

            });

    } catch (error) {

        console.error(
            'Notification sound failed:',
            error
        );

    }
}





/**
 * Browser Notification
 */
function showBrowserNotification(notification)
{
    if (
        "Notification" in window &&
        Notification.permission === "granted"
    ) {

        const browserNotification =
            new Notification(
                'Quality Uniform ERP',
                {
                    body:
                        notification.message ??
                        'New notification received',
                    icon:
                        '/assets/images/favicon.png'
                }
            );

        browserNotification.onclick = () => {

            window.focus();

            if (notification.url) {
                window.location.href =
                    notification.url;
            }
        };
    }
}


/**
 * Bell Animation
 */
function animateBell()
{
    const bell = document.querySelector(
        '#notificationDropdown'
    );

    if (!bell) return;

    bell.classList.add('bell-shake');

    setTimeout(() => {

        bell.classList.remove('bell-shake');

    }, 1000);
}


/**
 * Reload Notification Dropdown
 */
function loadLatestNotifications() {

    fetch('/notifications/latest', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {

        if (!response.ok) {
            throw new Error(
                `HTTP ${response.status} ${response.statusText}`
            );
        }

        return response.text();
    })
    .then(html => {

        const container = document.querySelector(
            '#header-notification-scroll .simplebar-content'
        );

        if (!container) {
            console.warn(
                'Notification container not found.'
            );
            return;
        }

        // Detect Laravel error page
        if (
            html.includes('Ignition') ||
            html.includes('Exception') ||
            html.includes('<!DOCTYPE html>')
        ) {

            console.error(
                'Notification endpoint returned error page'
            );

            return;
        }

        container.innerHTML = html;

    })
    .catch(error => {

        console.error(
            'Notification reload failed:',
            error
        );

    });
}
function safeExecute(callback, name = 'Unknown Function')
{
    try {

        callback();

    } catch (error) {

        console.error(
            `${name} failed:`,
            error
        );

    }
}