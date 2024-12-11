<form id="review-confirm-form" method="POST" action="process_review_confirm.php">
    <h2>Review & Confirm Documents</h2>
    <div class="form-group">
        <label for="e_signature">E-Signature:</label>
        <input type="text" id="e_signature" name="e_signature" class="form-control" required placeholder="Type your name as signature">
    </div>
    <div class="form-group">
        <label for="confirmation">Confirm Documents:</label>
        <input type="checkbox" id="confirmation" name="confirmation" required>
        <label for="confirmation">I confirm that the above information is correct.</label>
    </div>
    <button type="submit" class="btn btn-primary">Confirm & Submit</button>
</form>
