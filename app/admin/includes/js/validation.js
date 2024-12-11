$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert("Form successfully submitted!");
    },
  });

  // Custom validation method for mobile numbers
  $.validator.addMethod(
    "mobile",
    function (value, element) {
      return this.optional(element) || /^[0-9]{10}$/.test(value);
    },
    "Please provide a valid 10-digit mobile number"
  );

  // Add a custom validation method for mobile and landline numbers
  $.validator.addMethod(
    "phone",
    function (value, element) {
      return this.optional(element) || /^[0-9]{10}$|^[0-9]{11}$/.test(value);
    },
    "Please provide a valid 10-digit mobile number or 11-digit landline number"
  );

  // Add a custom validation method for Aadhar number
  $.validator.addMethod(
    "aadhar",
    function (value, element) {
      return this.optional(element) || /^[0-9]{12}$/.test(value);
    },
    "Please provide a valid 12-digit Aadhar number"
  );

  // Add a custom validation method for Indian PAN card
  $.validator.addMethod(
    "pan",
    function (value, element) {
      return this.optional(element) || /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(value);
    },
    "Please provide a valid Indian PAN card number"
  );

  $(".quickForm").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5,
      },
      mobile: {
        required: true,
        mobile: true, // Use the custom phone validation method
      },
      hospital_contact: {
        required: true,
        phone: true, // Use the custom phone validation method
      },
      physician_contact: {
        required: true,
        phone: true, // Use the custom phone validation method
      },
      adhar_no: {
        required: true,
        aadhar: true, // Use the custom Aadhar validation method
      },
      pan_no: {
        required: true,
        pan: true, // Use the custom PAN validation method
      },
    },
    messages: {
      email: {
        required: "Please enter an email address",
        email: "Please enter a valid email address",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
      },
      mobile: {
        required: "Please provide a valid mobile",
      },
      hospital_contact: {
        required: "Please provide a valid mobile or landline number",
      },
      physician_contact: {
        required: "Please provide a valid mobile or landline number",
      },
      adhar_no: {
        required: "Please provide a valid Aadhar number",
      },
      pan_no: {
        required: "Please provide a valid PAN card number",
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
  });
});
