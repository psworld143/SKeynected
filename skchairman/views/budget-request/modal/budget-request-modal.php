<div class="modal fade" id="updateBudgetModal" tabindex="-1" aria-labelledby="updateBudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateBudgetModalLabel">Update Budget Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateBudgetForm" action="" method="POST">
                    <div class="form-group">
                        <label for="barangay_select">Select Barangay</label>
                        <select class="form-control" id="barangay_select" name="barangay_select" required>
                            <option value="Barangay 1">Barangay 1</option>
                            <option value="Barangay 2">Barangay 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="requested_amount">Requested Amount</label>
                        <input type="number" class="form-control" id="requested_amount" name="requested_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>

                        <div class="col-lg-6 mt-3">
                            <button type="submit" class="btn btn-success ">Update Request</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>