<?php 

// // my DB details (GDYA's localhost)
// $db_server = "localhost";
// $db_username = "probioticsapp";
// $db_password = "probiotics8";
// $db_name = "probioticsapp_db_2021"; #updated 15/10/2021

// details for pharmacybernetics
// $db_server = "localhost";
// $db_username = "pharm514_adison";
// $db_password = "adisongoh88";
// $db_name = "pharm514_probioticsappdb";

// details for digitalhealthdojo
// $db_server = "localhost";
// $db_username = "u659662478_probioticdbadm";
// $db_password = "DHDadmin2021";
// $db_name = "u659662478_probioticdb"; 

// details for brigitta and christine
$db_server = "localhost";
$db_username = "brigittachristine2022";
$db_password = "probiotics2022";
$db_name = "probioticsapp_db_2022"; 

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

 ?>