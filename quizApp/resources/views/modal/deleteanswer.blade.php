<!-- Modal for Answer Deletion -->
<div class="modal fade" id="deleteAnswerModal" tabindex="-1" aria-labelledby="deleteAnswerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAnswerModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the answer "<span id="answerName"></span>"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Form for Answer Deletion -->
                <form id="formDeleteAnswer" method="post" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Answer</button>
                </form>
            </div>
        </div>
    </div>
</div>
