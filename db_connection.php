<?php  
/** 
This is a separate dynamic file for connection which I can call it anytime from another page. 
*/  
$dbcon=mysqli_connect("yourhost","servername","password");  
mysqli_select_db($dbcon,"dbname");  
?>
