document.addEventListener('DOMContentLoaded', () => {
const toast = document.getElementById('toastNotification');
if(toast) {
    toast.classList.add('active');
    setTimeout(() => { toast.classList.remove('active'); }, 4000);
}
});

function triggerModerationAlert(poemId, poemTitle, actionType) {
document.getElementById('modalPoemId').value = poemId;
document.getElementById('modalActionState').value = actionType;
document.getElementById('deleteTargetTitle').textContent = `"${poemTitle}"`;

const header = document.getElementById('modalHeaderTitle');
const desc = document.getElementById('modalDescriptionText');
const submitBtn = document.getElementById('modalSubmitActionBtn');
const iconBox = document.getElementById('modalIconContainer');

if (actionType === 'approve') {
    header.textContent = "Approve Publication";
    desc.innerHTML = `Are you certain you want to approve and move <strong style="color: #10b981; background: #f0fdf4;">"${poemTitle}"</strong> live to the production pipeline?`;
    submitBtn.textContent = "Yes, Approve Work";
    submitBtn.style.background = "#10b981";
    iconBox.innerHTML = "<i class='bx bxs-check-shield' style='color: #10b981;'></i>";
} else {
    header.textContent = "Critical Action Required";
    desc.innerHTML = `Are you absolutely sure you want to permanently discard and shred the submission <strong style="color: #dc3545; background: #fef2f2;">"${poemTitle}"</strong>? This action is absolute.`;
    submitBtn.textContent = "Reject & Delete";
    submitBtn.style.background = "#dc3545";
    iconBox.innerHTML = "<i class='bx bxs-error-alt' style='color: #dc3545;'></i>";
}

document.getElementById('crimsonDeleteAlert').classList.add('active');
}

function dismissDeleteAlert() {
document.getElementById('crimsonDeleteAlert').classList.remove('active');
}

function searchPoems() {
const input = document.getElementById('userSearch').value.toLowerCase();
const rows = document.querySelectorAll('#userTableBody tr');
rows.forEach(row => {
    if(row.cells.length === 1) return;
    row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
});
}