$(document).ready(function () {
    // Populate the country dropdown on page load
    fetchCountries();

    // Handle changes in the country dropdown
    $("#country").change(function () {
        var countryId = $(this).val();
        fetchStates(countryId);
        $("#city").html('<option disabled="disabled" selected="selected">Select City</option>');
    });

    // Handle changes in the state dropdown
    $("#state").change(function () {
        var stateId = $(this).val();
        fetchCities(stateId);
    });

    // Function to fetch countries and populate the country dropdown
    function fetchCountries() {
        $.ajax({
            url: "actions/fetch_region.php",
            type: "POST",
            data: { action: "fetch_countries" },
            success: function (response) {
                $("#country").html(response);
            },
        });
    }

    // Function to fetch states and populate the state dropdown
    function fetchStates(countryId) {
        $.ajax({
            url: "actions/fetch_region.php",
            type: "POST",
            data: { action: "fetch_states", country_id: countryId },
            success: function (response) {
                $("#state").html(response);
            },
        });
    }

    // Function to fetch cities and populate the city dropdown
    function fetchCities(stateId) {
        $.ajax({
            url: "actions/fetch_region.php",
            type: "POST",
            data: { action: "fetch_cities", state_id: stateId },
            success: function (response) {
                $("#city").html(response);
            },
        });
    }
});
