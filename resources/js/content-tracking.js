// Simple content tracking functions
class ContentTracker {
    static trackView(contentId, contentType) {
        if (navigator.doNotTrack === '1') return;
        
        fetch('/track/view', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                content_id: contentId,
                content_type: contentType
            })
        }).catch(error => console.log('Tracking error:', error));
    }

    static trackTimeSpent(contentId, contentType, seconds) {
        if (navigator.doNotTrack === '1' || seconds < 5) return;
        
        fetch('/track/time', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                content_id: contentId,
                content_type: contentType,
                time_spent: seconds
            })
        }).catch(error => console.log('Time tracking error:', error));
    }
}

// Make it globally available
window.ContentTracker = ContentTracker;