<?php  
session_start();//session starts here  
function Cipher($ch, $key)
{
	if (!ctype_alpha($ch))
		return $ch;

	$offset = ord(ctype_upper($ch) ? 'A' : 'a');
	return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
}

function Encipher($input, $key)
{
	$output = "";

	$inputArr = str_split($input);
	foreach ($inputArr as $ch)
		$output .= Cipher($ch, $key);

	return $output;
}

function Decipher($input, $key)
{
    return Encipher($input, 26 - $key);
}

include("db_connection.php");  //call db_connection to connect to the database 
if(isset($_POST['login']))  //name of global form variable
{  
    $username=$_POST['username_input'];  
    $password=$_POST['password_input'];  
    $cipherusername = Decipher($username, 3);
    $cipherpassword = Decipher($password, 3);
    
    $check_user="select * from table_login_form WHERE username='$cipherusername' AND password='$cipherpassword'";  //Run the query
    $run=mysqli_query($dbcon,$check_user);  //check the database rows for username and password input
    $rowsph = mysqli_num_rows($run);
    if ($rowsph == 1){ //validate a rows if it exist
        echo "<script> window.open('welcome.php','_self')</script>"; //if there is a match, it open a welcome page
        $_SESSION['username_input']=$username; 
    }  
    elseif ($rowsph >= 1){ //check for duplicates
        echo "<script>alert('Too many account with the same credential')</script>";
    }
    else  
    {  
      echo "<script>alert('Email or password is incorrect!')</script>";  
    } 
}  
?>  
