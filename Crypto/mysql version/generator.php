<?php
session_start();
?>
<html>

   <head>
      <title>iKOMO</title>
   </head>

   <body>
     <?php
     //Traits of Ikomo: String, owner(userID), rarity, type, health
		 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //Characters used in generating stringID
		 $charactersLength = strlen($characters); //Check length of $characters
		 $randomString = ''; //initialize the stringID
		 for ($i = 0; $i < 64; $i++) { //loop through and add random characters from $characters to $randomString to turn $randomString into a randomly generated 64 character string
			 $randomString .= $characters[rand(0, $charactersLength - 1)];
		 }
     $UID = $_SESSION['userID']; //Set $UID to the id of the logged in user
     echo "<script>console.log( {$_SESSION['userID']} );</script>"; //Testing purposes
     $x = rand(1,100);//$x is used to find rarity out of 100
     echo "<script>console.log( $x );</script>";
     if($x<=32){
       $Rarity = 1;
     }else if ($x<=83){
       $Rarity = 2;
     }else if ($x<=98){
       $Rarity = 3;
     }else{
       $Rarity = 4;
     }
     $Animal = "";
     $Type = rand(1,4);
     if($Rarity == 1){
       $x = rand(1,8);
         if($x == 1){
           $Type = 1;
           $Animal = "Potted Cactus";
         } else if ($x == 2){
           $Type = 3;
           $Animal = "Ladybug";
         } else if ($x == 3){
           $Type = 4;
           $Animal = "Blue Slime";
         } else if ($x == 4){
           $Type = 3;
           $Animal = "Pink Snail";
         }
          else if($x == 5){
            $Type = 3;
            $Animal = "Golden Mantella";
          } else if ($x == 6){
            $Type = 3;
            $Animal = "Bat";
          } else if ($x == 7){
            $Type = 2;
            $Animal = "Puffin";
          } else{
            $Type = 1;
            $Animal = "Goat";
          }
        }
     else if ($Rarity == 2){
       $x = rand(1,14);
         if($x == 1){
           $Type = 3;
           $Animal = "Owl";
         } else if ($x == 2){
           $Type = 3;
           $Animal = "Bee";
         } else if ($x == 3){
           $Type = 2;
           $Animal = "Blobfish";
         } else if ($x == 4){
           $Type = 2;
           $Animal = "Beaver";
         }else if($x == 5){
           $Type = 2;
           $Animal = "Pufferfish";
         } else if ($x == 6){
           $Type = 3;
           $Animal = "Chinchilla";
         } else if ($x == 7){
           $Type = 4;
           $Animal = "Dodo Bird";
         } else if ($x == 8){
           $Type = 2;
           $Animal = "Dolphin";
         }
          else if($x == 9){
            $Type = 3;
            $Animal = "Dart Frog";
          } else if ($x == 10){
            $Type = 1;
            $Animal = "Saint Bernard";
          } else if ($x == 11){
            $Type = 3;
            $Animal = "Toucan";
          } else if ($x == 12){
            $Type = 2;
            $Animal = "Seal Pup";
          }else if($x == 13){
            $Type = 2;
            $Animal = "Alligator";
          } else{
            $Type = 3;
            $Animal = "Bobcat";
          }
      }else if ($Rarity == 3){
         $x = rand(1,5);
           if($x == 1){
             $Type = 3;
             $Animal = "Siberian Tiger";
           } else if ($x == 2){
             $Type = 4;
             $Animal = "Griffin";
           } else if($x == 3){
             $Type = 4;
             $Animal = "Mammoth";
           }
            else if($x == 4){
              $Type = 2;
              $Animal = "Hammerhead Shark";
            } else{
              $Type = 3;
              $Animal = "Bald Eagle";
            }
         }else{
           $x = rand(1,4);
           if($x == 1){
             $Type = 4;
            $Animal = "T-Rex";
          }else if($x == 2){
            $Type = 3;
            $Animal = "Red Panda";
          }else if ($x==3){
            $Type = 2;
            $Animal = "The Golden Dolphin";
          }else{
            $Type = 3;
            $Animal = "Large Chungy";
          }
           }


     //Connect to database
     $dbhost = 'db5000072625.hosting-data.io';
     $dbuser = 'dbu230478';
     $dbpass = 'SPdidsway1st';
     $dbname = 'dbs67209';
     $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
     if(! $conn ) {
        die('Could not connect: ' . mysql_error());
     }
     $sql = 'SELECT KOMOcoins FROM iKOMODB WHERE idUsers = '.$UID.'';
     $coins = 0;
     $result = mysqli_query($conn, $sql)->fetch_object()->KOMOcoins;
     $coins = $result-=100;
     $sql = 'UPDATE iKOMODB SET KOMOcoins = '.$coins.' WHERE idUsers = '.$UID.'';
     $result = mysqli_query($conn,$sql);

     $sql = "SELECT StringID FROM owners";
     $result = $conn->query($sql);

     if ($result->num_rows >= 0) {

       // output data of each row and check stringID
       while($row = $result->fetch_assoc()) {
         if($randomString===($row["StringID"])){
           echo "Error Generating StringID. Please try again";
           die();
         }
       }

       //Insert iKomo
       $sql = "INSERT INTO owners ".
                 "(StringID, UID, Rarity, Type, Animal) "."VALUES ".
                 "('$randomString',$UID,'$Rarity','$Type','$Animal')";
       if ($conn->query($sql) === TRUE) {
          //Announce iKomo traits
          if($Type = 1){
            $_SESSION["type"] = "domestic";
          }else if ($Type = 2){
            $_SESSION["type"] = "aquatic";
          }else if ($Type = 3){
            $_SESSION["type"] = "wild";
          }else{
            $_SESSION["type"] = "mythic";
          }
          $_SESSION["animal"] = $Animal;
          if($Rarity==1){
            $_SESSION["rarity"] = "common ";
          }else if ($Rarity == 2){
            $_SESSION["rarity"] = "rare";
          }else if ($Rarity == 3){
            $_SESSION["rarity"] =  "epic";
          }else {
            $_SESSION["rarity"] = "legendary";
          }
          $_SESSION["randomString"] =  $randomString;

       } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
       }

     } else {
       echo 'Error';
     }

     $conn->close();

     echo "<script> window.location.href = '../../result.php'</script>";
     exit();
     ?>
   </body>

</html>
