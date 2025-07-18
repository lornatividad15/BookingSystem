<!-- FOR MODAL SNIPPET (SHARED MODAL) -->
<link rel="stylesheet" href="CSS/modal_global.css" />
<div id="modalOverlay" class="modal-overlay show">
  <div class="modal-box <?php echo isset($modalType) ? $modalType : ''; ?>">
    <?php if (!isset($modalRedirect) || !$modalRedirect): ?>
      <button class="close-btn" onclick="closeModal()">&times;</button>
    <?php endif; ?>
    <span id="modalMessage"><?php echo isset($modalMessage) ? htmlspecialchars($modalMessage) : ''; ?></span>
  </div>
</div>
<script>
//FOR MODAL SNIPPET SCRIPTS
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('show');
}
document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('modalOverlay').classList.add('show');
});
</script>
