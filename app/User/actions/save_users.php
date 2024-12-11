<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Define your upload directory
    $uploadDirectory = "../../assets/uploads/";

    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $DOB = $_POST['DOB'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $AadharNo = $_POST['AadharNo'];
    $PanNo = $_POST['PanNo'];

    // Initialize default image file paths
    $avatarFileName = "no-img.png";
    $AadharPhotoFileName = "id-placeholder.png";
    $PanPhotoFileName = "id-placeholder.png";

    // Check if an avatar file was uploaded
    if ($_FILES['avatar']['error'] === 0) {
        $avatarFileName = $uploadDirectory . basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarFileName);
    }

    // Check if an Aadhar Photo file was uploaded
    if ($_FILES['AadharPhoto']['error'] === 0) {
        $AadharPhotoFileName = $uploadDirectory . basename($_FILES['AadharPhoto']['name']);
        move_uploaded_file($_FILES['AadharPhoto']['tmp_name'], $AadharPhotoFileName);
    }

    // Check if a Pan Photo file was uploaded
    if ($_FILES['PanPhoto']['error'] === 0) {
        $PanPhotoFileName = $uploadDirectory . basename($_FILES['PanPhoto']['name']);
        move_uploaded_file($_FILES['PanPhoto']['tmp_name'], $PanPhotoFileName);
    }

    // Insert the data into your database (modify this part based on your database structure)
    $query = "INSERT INTO users (username, email, DOB, phone, password, user_type, AadharNo, PanNo, avatar, Adhar_img, PAN_img) 
              VALUES ('$username', '$email', '$DOB', '$phone', '$password', '$role', '$AadharNo', '$PanNo', '$avatarFileName', '$AadharPhotoFileName', '$PanPhotoFileName')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Success, you can redirect or display a success message
        header("Location: ../users.php"); // Replace with the URL you want to redirect to
    } else {
        // Error occurred, handle it accordingly
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect or display an error message for invalid request
    header("Location: error.php");
}
?>
