<?php

session_start();
include('config/dbcon.php');

if(isset($_POST['logoutbtn'])){
    session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out successfully.";
    header("Location: loginform.php");
    exit();
}

if(isset($_POST['addUser'])) 
{

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $confirmpassword = $_POST['confirm_pass'];

    if($password == $confirmpassword)
    {
        $check_email_query = "SELECT email FROM user_profile WHERE email = '$email' LIMIT 1";
        $check_email_query_run = mysqli_query($conn, $check_email_query);
    

        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['status'] = "Email already taken!";
            header("Location: regisform.php");
        }
        else
        {
            $query = "INSERT INTO user_profile(full_name, phone_number, email, address, password) values ('$name','$phone','$email','$address','$password')";
            $run_query = mysqli_query($conn, $query);
    
            if ($run_query){
                $_SESSION['status'] = "User Added";
                header("Location: regisform.php");  
            }
            else{
                $_SESSION["status"] = "Failed User Add";
                header("Location: regisform.php");
            }
        }
        
        }else{
            $_SESSION["status"] = "Password doesn't match!";
            header("Location: regisform.php");
        }
    }


if(isset($_POST['updateUser'])){
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "UPDATE user_profile SET full_name = '$name', email = '$email', password = '$password', phone_number= '$phone', address = '$address' WHERE user_id = '$user_id' ";
    $run_query = mysqli_query($conn, $query);

    if ($run_query){
        $_SESSION["status"] = "User Updated";
        header("Location: regisform.php");
    }else{
        $_SESSION["status"] = "Failed User Update";
        header("Location: regisform.php");
    }
}

if(isset($_POST['deleteUserbtn'])){
    $user_id = $_POST['delete_id'];
    $query = "DELETE FROM user_profile WHERE user_id = '$user_id'";

    $run_query = mysqli_query($conn, $query);

    if ($run_query){
        $_SESSION["status"] = "User Deleted";
        header("Location: regisform.php");
    }else{
        $_SESSION["status"] = "Failed to Delete user";
        header("Location: regisform.php");
    }
}


