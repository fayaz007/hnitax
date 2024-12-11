<!-- Tax Estimates Section -->
<div id="tax_estimates_section" class="card curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-calculator"></i> Tax Estimates</h3>
    </div>
    <div class="card-body">
        <!-- Add Tax Estimate Button -->
        <div class="mb-3">
            <button type="button" class="btn btn-success add-clear-form" data-toggle="modal" data-target="#addTaxEstimateModal">
                + CLICK HERE TO ADD TAX ESTIMATE
            </button>
        </div>
        <div class="table-responsive">
             <input type="hidden" name="user_id" id="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="tax_year" id="tax_year" value="<?= $_GET['tax_year']; ?>">
            <table id="EstimateTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Estimate ID</th>
                        <th>User ID</th>
                        <th>Tax Year</th>
                        <th>Federal Refund</th>
                        <th>State Refund</th>
                        <th>City Refund</th>
                          <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Tax Estimate Modal -->
<div class="modal fade" id="addTaxEstimateModal" tabindex="-1" role="dialog" aria-labelledby="addTaxEstimateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content curve-card card-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaxEstimateModalLabel">Add Tax Estimate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card curve-card">
                    <div class="card-body">
                        <form id="taxEstimateForm" method="POST" action="save_tax_estimate.php">
                            <!-- Hidden Fields for Estimate ID, User ID, and Tax Year -->
                            <input type="hidden" name="estimate_id" id="estimate_id">
                            <input type="hidden" name="user_id" id="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="tax_year" id="tax_year" value="<?= $_GET['tax_year']; ?>">

                            <div class="row">
                                <!-- Federal Refund Input with Currency Symbol -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="federal_refund">Federal Refund</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="federal_refund" class="form-control" id="federal_refund" placeholder="Enter Federal Refund" step="0.01" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- State Refund Input with Currency Symbol -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state_refund">State Refund</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="state_refund" class="form-control" id="state_refund" placeholder="Enter State Refund" step="0.01" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- City Refund Input with Currency Symbol -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city_refund">City Refund</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="city_refund" class="form-control" id="city_refund" placeholder="Enter City Refund" step="0.01" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Refund Field with Currency Symbol (Read-Only) -->
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <label for="total_refund">Total</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="total" class="form-control" id="total_refund" placeholder="Total" step="0.01" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            // Function to calculate total and update the Total field
                            function calculateTotal() {
                                const federalRefund = parseFloat(document.getElementById('federal_refund').value) || 0;
                                const stateRefund = parseFloat(document.getElementById('state_refund').value) || 0;
                                const cityRefund = parseFloat(document.getElementById('city_refund').value) || 0;

                                // Calculate total
                                const total = federalRefund + stateRefund + cityRefund;

                                // Update the Total field
                                document.getElementById('total_refund').value = total.toFixed(2);
                            }

                            // Attach event listeners to input fields
                            document.getElementById('federal_refund').addEventListener('input', calculateTotal);
                            document.getElementById('state_refund').addEventListener('input', calculateTotal);
                            document.getElementById('city_refund').addEventListener('input', calculateTotal);
                        </script>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default curve-card" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary curve-card my-btn-primary-color" id="saveTaxEstimate">Save Tax Estimate</button>
            </div>
        </div>
    </div>
</div>