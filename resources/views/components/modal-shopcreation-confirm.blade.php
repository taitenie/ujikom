<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to <span id="actionType"></span> this shop request?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="confirmForm" method="POST">
          @csrf
          @method('PATCH')
          <input type="hidden" name="status" value="">
          <button type="submit" class="btn btn-primary">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  const confirmModal = document.getElementById('confirmModal');
  confirmModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const status = button.getAttribute('data-status');
    const id = button.getAttribute('data-id');

    // Set action URL dynamically
    const confirmForm = document.getElementById('confirmForm');
    confirmForm.action = "{{ route('shops.update', ':id') }}".replace(':id', id);

    // Set status value in hidden input
    confirmForm.querySelector('input[name="status"]').value = status;

    // Update modal text
    const actionType = document.getElementById('actionType');
    actionType.textContent = status === 'approved' ? 'approve' : 'reject';
  });
</script>