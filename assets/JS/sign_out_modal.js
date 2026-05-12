function toggleLogoutModal() {
    const modal = document.getElementById('logoutModal');
    modal.style.display = (modal.style.display === 'none' || modal.style.display === '') ? 'flex' : 'none';
}

// Close modal if user clicks outside of the content box
// Use addEventListener to allow other modals to work too
window.addEventListener('click', function(event) {
    const logoutModal = document.getElementById('logoutModal');
    if (event.target === logoutModal) {
        toggleLogoutModal();
    }
});