<?php
require 'header.php';
?>
<!DOCTYPE html>
 <html>
  <head>
    <link rel = "stylesheet" type = "text/css" href = "main.css"/>
    <link rel = "stylesheet" type = "text/css" href = "animate.css"/>
    <link rel = "stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <style>
      #overlay {
        width: 100%;
        height: 200%;
        background-color: #F9F4D2;
        position: fixed;
        z-index: 101;
      }
      .percent-count {
        width: 450px;
        height: 50px;
        margin: 10px auto;
        font-size: 40px;
        text-align: center;
        color: #71DDE2;
      }
      .progress-bar {
        width: 506px;
        height: 26px;
        background-color: #71DDE2;
        border-radius: 13px;
        margin: 10px auto;
      }
      .progress {
        width: 25px;
        height: 20px;
        border-radius: 10px;
        background-color: #34ABB7;
      }
      #loading {
        height: 200px;
        width: 100%;
      }
      #loadimage {
        display: block;
        margin: 10px auto;
      }
      /*.loadingimage {
        width: 100%;
        height: 100%;
        position: fixed;
      }
      #loadimage {
        height: 500px;
        width: 500px;
        margin: 50px auto;
      } */
    </style>
    <title>VEI iKOMO</title>
  </head>
  <body class = "bg">
    <div id = "overlay">
        <div id = "loading">
          <img id = "loadimage" height = "200px" width = "auto" src = "img/loading.png">
        </div>
        <div class = "progress-bar">
          <div class = "progress" id = "progress"></div>
        </div>
        <div id = "percentCount" class = "percent-count">
        </div>
    </div>
    <div class = "container-fluid">
      <div class = "row">
        <div class = "col-md-1">

        </div>
        <div class = "col-md-10">
          <div id = "mainWelcomeText">
              <img id = "mainScreenLogo" src = "./img/ikologo.png" height ="176px" width = "402px">
          </div>
        </div>
        <div class = "col-md-1">

        </div>
      </div>
      <br>
      <br>
      <br>
      <div class = "row">
        <div class = 'col-md-4'>
        </div>
        <div class = 'col-md-8'>
            <button onclick = "window.location.href = './mainInterface.php'">iKOMO Shop</button>
        </div>
        <script>

          // function toggleVisible() {
          //   var x = document.getElementById("pleaseLogIn");
          //   if (x.style.display === "none") {
          //     x.style.display = "block";
          //   } else {
          //     x.style.display = "none";
          //   }
          // }
        </script>
      </div>
    </div>
  </body>
<script>
  function progress (){
    var ol = document.getElementById('overlay');
    var hol = document.getElementById('hoverlay');
    var prg = document.getElementById('progress');
    var percent = document.getElementById('percentCount');
    var counter = 0;
    var progress = 0;
    var id = setInterval(frame,50);
    hol.style.display = "block";

    function frame(){
      if(progress >= 500 && counter >= 100){
        clearInterval(id);
        ol.style.display = "none";
        hol.style.display = "none";
        var str = '<div id = "mainWelcomeText" class = "animated slideInUp"><img id = "mainScreenLogo" src = "./img/ikologo.png" height ="146px" width = "402px"></div>';
        var Obj = document.getElementById('mainWelcomeText');
        Obj.outerHTML=str;
      }
      else{
        progress += 10;
        counter +=2;
        prg.style.width = progress + 'px';
        percent.innerHTML = counter + '%';
      }
    }
  }
  progress();
</script>

 </html>