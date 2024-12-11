<!-- final-documents.html -->
<div class="container">
    <h2>Generate Final Documents</h2>
    
    <form>
        <h3>Taxpayer Information</h3>
        <div class="form-group">
            <label for="taxpayerSsn">SSN</label>
            <input type="text" class="form-control" id="taxpayerSsn">
        </div>
        <div class="form-group">
            <label for="taxpayerFirstName">First Name</label>
            <input type="text" class="form-control" id="taxpayerFirstName">
        </div>
        <div class="form-group">
            <label for="taxpayerLastName">Last Name</label>
            <input type="text" class="form-control" id="taxpayerLastName">
        </div>

        <h3>Spouse Information</h3>
        <div class="form-group">
            <label for="spouseSsn">SSN</label>
            <input type="text" class="form-control" id="spouseSsn">
        </div>
        <div class="form-group">
            <label for="spouseFirstName">First Name</label>
            <input type="text" class="form-control" id="spouseFirstName">
        </div>
        <div class="form-group">
            <label for="spouseLastName">Last Name</label>
            <input type="text" class="form-control" id="spouseLastName">
        </div>

        <h3>Dependents</h3>
        <button type="button" class="btn btn-primary">+ Add Dependents</button>

        <h3>Bank Account Details</h3>
        <div class="form-group">
            <label for="accountNumber">Account Number</label>
            <input type="text" class="form-control" id="accountNumber">
        </div>
        <div class="form-group">
            <label for="routingNumber">Routing Number</label>
            <input type="text" class="form-control" id="routingNumber">
        </div>
        <div class="form-group">
            <label for="accountType">Type of Account</label>
            <select class="form-control" id="accountType">
                <option>Checking</option>
                <option>Savings</option>
            </select>
        </div>
    </form>
</div>
