<?php

$con = mysqli_connect('localhost','root');

if($con)
{
 echo"connection successfull";   
}
else{
    echo"no connection";
}

mysqli_select_db($con,'websiteuserdata');
$user = $_POST['user'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];

$query = "insert into logininfo (user, email, mobile, city) values('$user','$email','$mobile','$city')";

mysqli_query($con, $query);

header('location:home.html');


?>