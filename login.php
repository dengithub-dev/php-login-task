<?php  
session_start();//session starts here  
include("db_connection.php");  //call db_connection to connect to the database 
if(isset($_POST['phpfilename']))  
{  
    $username0=$_POST['username_input'];  
    $password0=$_POST['password_input'];  
    $check_user="select * from table_login_form WHERE user='$username0' AND pass='$password0'";  //Run the query
    $run=mysqli_query($dbcon,$check_user);  //check the database rows for username and password input
    $rowsph = mysqli_num_rows($run);
    if ($rowsph == 1){ //validate a rows if it exist
        echo "<script> window.open('welcome.php','_self')</script>"; //if there is a existing 1 row, open a welcome page
        $_SESSION['username_input']=$username0; 
    }  
    elseif ($rowsph > 1){ //check for duplicates
        echo "<script>alert('Too many account with the same credential')</script>";
    }
    else  
    {  
      echo "<script>alert('Email or password is incorrect!')</script>";  
    } 
}  
?>  