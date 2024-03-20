<?php
session_start();
include('db_conn.php');


// a condition to get the token
if(isset($_GET['token'])) {
    $token = $_GET['token'];

    //select a table token
    $query = "SELECT verify_token, Status FROM user_profile WHERE verify_token = '$token' LIMIT 1";
    $query_run = mysqli_query($conn, $query);

    //to run condition
    if(mysqli_num_rows($query_run) > 0) 
    {
        //check row of the sql by passing $queryrun($conn, $query)
        $row = mysqli_fetch_array($query_run);

        //check the row status
        if($row['Status'] == 'Not Verified') 
        {
            //pass a value of verify_token from sql
            $click_token = $row['verify_token'];

            //update the status from not verified to verified
            $update_query = "UPDATE user_profile SET Status = 'Verified' WHERE verify_token = '$click_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            //condition if the email is registered or not
            if($update_query_run){

                $_SESSION['status'] = "Your Account has been Verified Successfully.!";
                header("Location: message.php");
                exit(0);  

            }else{

                $_SESSION['status'] = "Verification Failed!";
                header("Location: message.php");
                exit(0);  

            }
        }
        else 
        {
            $_SESSION['status'] = "This Email Already Verified. Please login.";
            header("Location: message.php");
            exit(0);    
        }
    } 
    // pass the error message to invalid_message.php
    else 
    {
        
        header("Location: invalid_message.php");
    }
}
// pass a session to the Loginform.php to display the error
else
{
    $_SESSION['status'] = "Not Allowed";
    header("Location: message.php");
}
?>