    function updateInboxUI() {
    const streakNum = document.getElementById('streak-num');
    const completeMsg = document.getElementById('completion-msg');
    const pendingMsg = document.getElementById('pending-msg');
    
    const today = new Date().toDateString();
    const lastDate = localStorage.getItem('sr_lastDate');
    let count = parseInt(localStorage.getItem('sr_streak')) || 0;

    if (lastDate) {
        const last = new Date(lastDate);
        const curr = new Date(today);
        const dayDiff = Math.floor((curr - last) / (1000 * 60 * 60 * 24));
        
        // If they missed more than 1 day since their last read, reset to 0
        if (dayDiff > 1) {
            count = 0;
            localStorage.setItem('sr_streak', 0);
        }
    }

    // Update the number on screen
    if (streakNum) streakNum.innerText = count;

    // Toggle Messages based on today's activity
    if (lastDate === today) {
        if (completeMsg) completeMsg.style.display = 'block';
        if (pendingMsg) pendingMsg.style.display = 'none';
    } else {
        if (completeMsg) completeMsg.style.display = 'none';
        if (pendingMsg) pendingMsg.style.display = 'block';
    }
}

window.onload = updateInboxUI;

document.getElementById('reset-streak-btn').addEventListener('click', () => {
    if (confirm("Are you sure you want to reset your reading streak?")) {
        localStorage.removeItem('sr_streak');
        localStorage.removeItem('sr_lastDate');
        updateInboxUI(); // Refresh the numbers on the screen
    }
});