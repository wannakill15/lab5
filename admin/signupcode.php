<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['signup_btn'])) {
    $full_name = $_POST['full_name'];   
    $email = $_POST['email'];   
    $phone_number = $_POST['phone_number'];   
    $address = $_POST['address'];   
    $password = $_POST['password'];

    // File upload handling
    $profile_image = $_FILES['profile_image'];
    $profile_image_name = $profile_image['name'];
    $profile_image_tmp = $profile_image['tmp_name'];
    $profile_image_size = $profile_image['size'];
    $profile_image_error = $profile_image['error'];

    // Check if a profile image is uploaded
    if($profile_image_error === UPLOAD_ERR_OK) {
        $profile_image_destination = 'uploads/' . $profile_image_name; // Change 'uploads/' to your desired upload directory
        move_uploaded_file($profile_image_tmp, $profile_image_destination);
    } else {
        // Handle image upload error
        $profile_image_destination = ''; // Set default image path or handle error accordingly
    }

    // Check if the email already exists in the database
    $check_email_query = "SELECT * FROM user_profile WHERE email='$email' LIMIT 1 ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email already exists";
        header('Location: signupform.php');
        exit();
    } else {
        // Insert user data into the database
        $insert_query = "INSERT INTO user_profile (full_name, email, phone_number, address, password) VALUES ('$full_name', '$email', '$phone_number', '$address', '$password')";
        $insert_query_run = mysqli_query($conn, $insert_query);

        if($insert_query_run) {
            $_SESSION['status'] = "Account created successfully. Please login.";
            header('Location: loginform.php');
            exit();
        } else {
            $_SESSION['status'] = "Failed to create account. Please try again.";
            header('Location: signupform.php?status=error');
            exit();
        }
    }
} else {
    $_SESSION['status'] = "Access Denied";
    header('Location: signupform.php');
    exit();
}
?>
