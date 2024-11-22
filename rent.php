<?php



$con = mysqli_connect('localhost','root');

if($con)
{
 echo"connection successfull";   
}
else{
    echo"no connection";
}

mysqli_select_db($con,'rentuser');
$user = $_POST['user'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];
$vehicle = $_POST['vehicle'];
$borrow = $_POST['borrow'];
$returns = $_POST['returns'];

$borrowDateTime = new DateTime($borrow);
$returnDateTime = new DateTime($returns);
$interval = $returnDateTime->diff($borrowDateTime);
$numberofdays = $interval->days;

$costPerDay = 0; // Default cost per day
    switch ($vehicle) {
        case 'Model X':
            $costPerDay = 50; // Cost per day for Model X
            break;
        case 'Model Y':
            $costPerDay = 40; // Cost per day for Model Y
            break;
        case 'Model Z':
            $costPerDay = 60; // Cost per day for Model Z
            break;
        }
            
$totalcost = $numberofdays * $costPerDay;

$query = "insert into rentaluser (user, email, mobile, city, vehicle, borrow, returns, numberofdays, totalcost) values('$user','$email','$mobile','$city','$vehicle','$borrow','$returns','$numberofdays','$totalcost')";

mysqli_query($con, $query);

header('location: payment.html');


?>