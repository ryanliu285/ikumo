<?php
  session_start();
  echo $_SESSION["userID"];
  $id = $_SESSION["userID"];
  $dbhost = 'db759106289.hosting-data.io';
  $dbuser = 'dbo759106289';
  $dbpass = 'SPdidsway1st';
  $dbname = 'db759106289';
  $buyAMT = 100;
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if(! $conn ) {
     die('Could not connect: ' . mysql_error());
  }
  $sql = 'SELECT learned FROM iKOMODB WHERE idUsers = '.$id.'';
  if(mysqli_query($conn, $sql)->fetch_object()->learned == 0){
  $sql = 'SELECT KOMOcoins FROM iKOMODB WHERE idUsers = '.$id.'';
  $coins = 0;
  if(!(mysqli_query($conn, $sql))){
    echo "Failed, please send a screenshot of this error to ikomo.vei@gmail.com";
  }
  $result = mysqli_query($conn, $sql)->fetch_object()->KOMOcoins;
  $coins = $result+=$buyAMT;
  $sql = 'UPDATE iKOMODB SET KOMOcoins = '.$coins.' WHERE idUsers = '.$id.'';
  $result = mysqli_query($conn,$sql);
  $sql = 'UPDATE iKOMODB SET learned = 1 WHERE idUsers = '.$id.'';
  $result = mysqli_query($conn,$sql);
  mysqli_close($conn);
  echo "<script>window.location.href='../arcadeMain.php';</script>";
  exit();
}else{
  echo "<h1>You already claimed this reward</h1>";
}
?>
