<form id="personal-info-form" method="POST" action="process_tax_information.php">
    <h2>Personal Information</h2>
    <div class="form-group">
        <label for="visa">Visa Type:</label>
        <input type="text" id="visa" name="visa" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="marital_status">Marital Status:</label>
        <select id="marital_status" name="marital_status" class="form-control" required>
            <option value="">Select</option>
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="divorced">Divorced</option>
            <option value="widowed">Widowed</option>
        </select>
    </div>
    <div class="form-group">
        <label for="date_of_marriage">Date of Marriage:</label>
        <input type="date" id="date_of_marriage" name="date_of_marriage" class="form-control">
    </div>
    <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ssn">SSN/ITIN:</label>
        <input type="text" id="ssn" name="ssn" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="state_residence">State of Residence:</label>
        <input type="text" id="state_residence" name="state_residence" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="current_address">Current Address:</label>
        <textarea id="current_address" name="current_address" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="dependents">Dependents:</label>
        <input type="text" id="dependents" name="dependents" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
