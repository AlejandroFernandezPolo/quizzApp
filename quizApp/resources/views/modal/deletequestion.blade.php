<div class="modal" id="deleteQuestionModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>By deleting this question you will also delete all of its answers.</p>
        <p>Are you sure that you want to delete the question <span id="questionQuestion"></span>?</p>
      </div>
      <form id="formDelete" action="{{ url('/') }}" method="post">
          @csrf
          @method('delete')
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Delete question</button>
          </div>
      </form>
    </div>
  </div>
</div>
