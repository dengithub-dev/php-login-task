<?php   
include("db_connection.php");//make connection here  
if(isset($_POST['register']))  
{  
    $useruser=$_POST['name0'];//here getting result from the post array after submitting the form.  
    $user_pass=$_POST['pass'];//same  

    if($useruser=='')  //check if input_username is blank
    {  
        //javascript use for input checking  
        echo"<script>alert('Please enter the name')</script>";  
        exit();//this use if first is not work then other will not show  
    }  
  
    if($user_pass=='')  //check if input_password is blank
    {  
        echo"<script>alert('Please enter the password')</script>";  
        exit();  
    }  
    //here query check weather if user already registered so can't register again.  
    $check_email_query = "select * from login_form WHERE user='$useruser'";  
    $run_query = mysqli_query($dbcon,$check_email_query);  
    $rowsrows = mysqli_num_rows($run_query);
    if($rowsrows >= 1)  //Check for duplicate
    {  
    echo "<script>alert('Email $useruser is already exist in our database, Please try another one!')</script>";  
    exit();  
    }  
    else
    {
    //use md5 encryption here
    $useruser = md5($useruser); //encrypt data using md5 hash
    $user_pass = md5($user_pass); //encrypt data using md5 hash
    //insert the user into the database.  
    //not yet done, having problem with the insertion of data
    $insert_user = "INSERT INTO login_form (user,pass) VALUE ('$useruser','$user_pass')"; 
    if(mysqli_query($dbcon, $insert_user)){
        echo "<center><h1>Records added successfully.</h1>";
    } else{
        echo "ERROR: Could not able to execute $insert_user. " . mysqli_error($dbcon);
    }
    }
}  
?> 
