// FOR ADMIN LOGIN FORM SCRIPTS
// FOR ADMIN LOGIN MODAL
function closeModal() {
  const modalOverlay = document.getElementById('modalOverlay');
  if (modalOverlay) modalOverlay.classList.remove('show');
}

document.addEventListener('DOMContentLoaded', function () {
  setTimeout(closeModal, 3000);
});