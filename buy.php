<?php

$con = mysqli_connect('localhost','root');

if($con)
{
 echo"connection successfull";   
}
else{
    echo"no connection";
}

mysqli_select_db($con,'buyersdetail');
$user = $_POST['user'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];
$vehicle = $_POST['vehicle'];

$vehicleprices = array(
    'Model X' => 500,
    'Model Y' => 400,
    'Model Z' => 600
);

$price = $vehicleprices[$vehicle];

$query = "insert into buyers (user, email, mobile, city, vehicle, price) values('$user','$email','$mobile','$city','$vehicle','$price')";

mysqli_query($con, $query);

header('location:payment.html');


?>