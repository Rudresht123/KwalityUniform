import Alpine from 'alpinejs';
import './echo';

window.Alpine = Alpine;

Alpine.start();



document.addEventListener('DOMContentLoaded', () => {

    if (!window.userId) {
        console.warn('User ID not found');
        return;
    }

    if (!window.Echo) {
        console.warn('Laravel Echo not loaded');
        return;
    }

    // Ask Browser Permission
    if ("Notification" in window &&
        Notification.permission !== "granted") {

        Notification.requestPermission();
    }

    // Listen User Notifications
if (window.userId) {

    Echo.private(`App.Models.User.${window.userId}`)
        .notification((notification) => {
alert(JSON.stringify(notification, null, 2));
            console.group('📢 Notification Received');
            console.log(notification);
            console.groupEnd();
             console.log('RAW Notification:', notification);
        console.log('Title:', notification?.title);
        console.log('Message:', notification?.message);
        console.log('Data:', notification?.data);

            // Laravel notification payload normalize
            const data = notification.data || notification;

            const notificationData = {
                title: data.title || 'Notification',
                message: data.message || 'You have a new notification.',
                type: data.type || 'info',
                url: data.url || null,
            };

            safeExecute(
                () => updateNotificationBadge(),
                'updateNotificationBadge'
            );

            safeExecute(
                () => updateUnreadText(),
                'updateUnreadText'
            );

            safeExecute(
                () => playNotificationSound(),
                'playNotificationSound'
            );

            safeExecute(
                () => showBrowserNotification(notificationData),
                'showBrowserNotification'
            );

            safeExecute(
                () => showToast(notificationData),
                'showToast'
            );

            safeExecute(
                () => animateBell(),
                'animateBell'
            );

            safeExecute(
                () => loadLatestNotifications(),
                'loadLatestNotifications'
            );
        })

        .error((error) => {
            console.error('❌ Echo Channel Error:', error);
        });
}
});

