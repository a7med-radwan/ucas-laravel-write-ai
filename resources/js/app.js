//

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

if (typeof USER_ID !== 'undefined' && USER_ID) {
    Echo.private(`App.Models.User.${USER_ID}`)
        .notification(function (data) {
            // Update desktop notification badge
            const desktopBadge = document.getElementById('desktop-notification-badge');
            if (desktopBadge) {
                const currentCount = parseInt(desktopBadge.textContent.trim()) || 0;
                desktopBadge.textContent = currentCount + 1;
                desktopBadge.classList.remove('hidden');
            }

            // Update mobile notification badge
            const mobileBadge = document.getElementById('mobile-notification-badge');
            if (mobileBadge) {
                mobileBadge.classList.remove('hidden');
            }
        });

    Echo.private(`posts.${USER_ID}`)
        .listen('.post-viewed', function () {
            console.log('Post viewed');
        });
}