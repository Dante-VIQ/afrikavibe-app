// resources/js/content-tracking.js
export function initContentTracking() {
    if (!window.contentData) return;

    const { id, type } = window.contentData;
    let startTime = new Date();
    let sentInitialPing = false;

    // Initial view ping (only if not scrolled yet)
    const sendInitialPing = () => {
        if (sentInitialPing || window.scrollY > 0) return;
        sendTrackingData();
        sentInitialPing = true;
    };

    // Time spent tracking
    const sendTimeSpent = () => {
        const timeSpent = Math.round((new Date() - startTime) / 1000);
        if (timeSpent >= 5) sendTrackingData(timeSpent);
    };

    const sendTrackingData = (timeSpent = null) => {
        navigator.sendBeacon('/track/view', new URLSearchParams({
            _token: document.querySelector('meta[name="csrf-token"]').content,
            content_type: type,
            content_id: id,
            time_spent: timeSpent || 0
        }));
    };

    // Events
    window.addEventListener('scroll', sendInitialPing, { once: true });
    window.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'hidden') sendTimeSpent();
    });
    window.addEventListener('pagehide', sendTimeSpent);
}

// Auto-initialize if window.contentData exists
if (window.contentData) initContentTracking();