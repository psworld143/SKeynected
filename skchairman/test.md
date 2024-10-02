<div class="mb-3">
                    <h5>Budget Allocations</h5>
                    <div id="expense-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Expense Type" id="expense-type">
                            <input type="number" class="form-control" placeholder="Amount" id="expense-amount" min="0" step="0.01">
                            <button class="btn btn-outline-secondary" type="button" id="add-expense-btn">Add</button>
                        </div>
                    </div>
                    <h6>Current Budget Allocations:</h6>
                    <ul id="expense-list" class="list-group"></ul>
                </div>

                <div class="mb-3">
                    <label for="project-plans" class="form-label">Project Plans</label>
                    <div id="tags-container" class="mb-2"></div>
                    <div class="input-group">
                        <input type="text" id="project-plan-input" class="form-control" placeholder="Add project plan" aria-label="Add project plan">
                        <button class="btn btn-outline-secondary" type="button" id="add-plan-btn">Add</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option selected>Choose status</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="stopped">Stopped</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <div class="card-footer">
                    <button class="btn btn-outline-secondary" type="button" id="update-project-btn" data-project-id="<?= $projectId ?>">Update Project</button>
                </div>