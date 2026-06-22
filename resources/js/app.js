import Alpine from 'alpinejs';
import './echo';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

    console.log('🚀 App JS Loaded');

    if (!window.userId) {
        console.warn('❌ User ID not found');
        return;
    }

    if (!window.Echo) {
        console.warn('❌ Laravel Echo not loaded');
        return;
    }

    // Browser Notification Permission
    if ("Notification" in window && Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    // Notification Sound
    let audioEnabled = true;

    function playNotificationSound() {
        if (!audioEnabled) {
            return;
        }

        const audio = new Audio('/assets/mixkit-positive-notification-951.wav');

        audio.play().catch(error => {
            console.warn('🔇 Audio blocked:', error);
        });
    }

    const channelName = `App.Models.User.${window.userId}`;

    console.log('📡 Subscribing to:', channelName);

    const channel = Echo.private(channelName);

    console.log('✅ Channel Object:', channel);

    channel
        .notification((notification) => {

            console.log('====================================');
            console.log('📢 NOTIFICATION RECEIVED');
            console.log('====================================');

            console.log('Raw Payload:', notification);

            const data = notification.data || notification;

            const notificationData = {
                title: data.title || 'Notification',
                message: data.message || 'You have a new notification.',
                type: data.type || 'info',
                url: data.url || null,
            };

            console.log('Final Notification Data:', notificationData);

            // Browser Notification
            if (
                "Notification" in window &&
                Notification.permission === "granted"
            ) {
                new Notification(notificationData.title, {
                    body: notificationData.message,
                });
            }

            // Existing functions
            if (typeof updateNotificationBadge === 'function') {
                updateNotificationBadge();
            }

            if (typeof updateUnreadText === 'function') {
                updateUnreadText();
            }

            playNotificationSound();

            if (typeof showToast === 'function') {
                showToast(notificationData);
            }

            if (typeof animateBell === 'function') {
                animateBell();
            }

            if (typeof loadLatestNotifications === 'function') {
                loadLatestNotifications();
            }
        })
        .error((error) => {
            console.error('❌ Echo Channel Error:', error);
        });

    console.log('🎯 Notification Listener Registered');
});