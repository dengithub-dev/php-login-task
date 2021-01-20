<?php   
include("db_connection.php");//make connection here  

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
   
    $decipherTextusername = Encipher($useruser, 3);
    $decipherTextpassword = Encipher($user_pass, 3);
    
    //insert the user into the database.  
    //not yet done, having problem with the insertion of data
    $insert_user = "INSERT INTO login_form (user,pass) VALUE ('$decipherTextusername','$decipherTextpassword')"; 
    if(mysqli_query($dbcon, $insert_user)){
        echo "<center><h1>Records added successfully.</h1>";
    } else{
        echo "ERROR: Could not able to execute $insert_user. " . mysqli_error($dbcon);
    }
    }
}  
?> 
