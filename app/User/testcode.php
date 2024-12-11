<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Filing Progress</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom styles for the progress bar and steps */
        .progress {
            height: 30px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .progress-bar {
            font-weight: bold;
        }
        .step-label {
            text-align: center;
            margin-top: 10px;
        }
        .step {
            position: relative;
            display: inline-block;
            width: 12%;
            margin-right: -5px; /* Adjust spacing between steps */
        }
        .step.completed .step-label {
            color: #28a745; /* Green for completed steps */
        }
        .step.current .step-label {
            color: #ffc107; /* Yellow for the current step */
        }
        .step .circle {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #6c757d; /* Default color */
            margin: 0 auto;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        .step.completed .circle {
            background-color: #28a745; /* Green for completed steps */
        }
        .step.current .circle {
            background-color: #ffc107; /* Yellow for the current step */
        }
        .step.pending .circle {
            background-color: #6c757d; /* Gray for pending steps */
        }
        .completed .circle:before {
            content: "\f00c"; /* Check icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px; /* Adjust icon size */
        }
        .current .circle:before {
            content: "\f110"; /* Spinner icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px; /* Adjust icon size */
            animation: spin 1s infinite; /* Add a spin animation */
        }
        .pending .circle:before {
            content: attr(data-icon); /* Set the icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 12px; /* Adjust icon size */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            .step {
                width: 16%; /* Adjust step width on smaller screens */
            }
            .step .circle {
                width: 20px;
                height: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h4><i class="fas fa-tachometer-alt"></i> Your Tax Filing Progress</h4>
    <p>Tax Filing Progress: <strong>60%</strong></p>
    
    <!-- Progress Bar -->
    <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
    </div>

    <!-- Step Indicators -->
    <div class="steps">
        <div class="step completed">
            <div class="circle"></div>
            <div class="step-label">Personal Info</div>
        </div>
        <div class="step completed">
            <div class="circle"></div>
            <div class="step-label">Insurance</div>
        </div>
        <div class="step completed">
            <div class="circle"></div>
            <div class="step-label">Residential</div>
        </div>
        <div class="step current">
            <div class="circle"></div>
            <div class="step-label">Other Income</div>
        </div>
        <div class="step pending" data-icon="&#xf0d6;"> <!-- FontAwesome icon for pending step -->
            <div class="circle"></div>
            <div class="step-label">Deductions</div>
        </div>
        <div class="step pending" data-icon="&#xf0d6;">
            <div class="circle"></div>
            <div class="step-label">Adjustments</div>
        </div>
        <div class="step pending" data-icon="&#xf0d6;">
            <div class="circle"></div>
            <div class="step-label">Upload Docs</div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
