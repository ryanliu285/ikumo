<?php

$servername = "db759106289.hosting-data.io";
$dBUsername = "dbo759106289";
$dBPassword = "SPdidsway1st";
$dbName = "db759106289";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);

if(!$conn){
  die("Connection failed: ".mysqli_connect_error());
}
