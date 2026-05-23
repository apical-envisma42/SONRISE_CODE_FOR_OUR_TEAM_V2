let activeDeleteFormId = null;

function triggerDeleteAlert(userId, targetEmail) {
    activeDeleteFormId = `delete-form-${userId}`;
    
    document.getElementById('deleteTargetEmail').textContent = targetEmail;
    
    const alertOverlay = document.getElementById('crimsonDeleteAlert');
    alertOverlay.style.display = 'flex';
    
    setTimeout(() => {
        alertOverlay.classList.add('active');
    }, 10);
}

function dismissDeleteAlert() {
    const alertOverlay = document.getElementById('crimsonDeleteAlert');
    alertOverlay.classList.remove('active');
    
    setTimeout(() => {
        alertOverlay.style.display = 'none';
        activeDeleteFormId = null; // Flush tracked pointer addresses safely
    }, 250);
}

document.getElementById('confirmDeleteSubmitBtn').addEventListener('click', function() {
    if (activeDeleteFormId) {
        document.getElementById(activeDeleteFormId).submit();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === "Escape" && document.getElementById('crimsonDeleteAlert').classList.contains('active')) {
        dismissDeleteAlert();
    }
});
