<!DOCTYPE html>
<head>
  <link rel = "stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
</head>
<html>
  <div class = "row">
    <div class = "col-md-2">
    </div>
    <div class = "col-md-8">
    <canvas id = "gameCanvas" width = "800" height = "450"></canvas>
    <img style = "display:none;" src = '../img/tenniscourt.png' id = "image">
    <script>
        var canvas;
        var canvasContext;
        var ballX = 400;
        var ballSpeedX = 10;
        var ballY = 300;
        var ballSpeedY = 7;
        var paddle1Y = 250;
        var paddle2Y = 250;
        const PADDLE_HEIGHT = 125;

        function calculateMousePos(evt){
            var rect = canvas.getBoundingClientRect();
            var root = document.documentElement;
            var mouseX = evt.clientX - rect.left - root.scrollLeft;
            var mouseY = evt.clientY - rect.top - root.scrollTop;
            return{
                x:mouseX,
                y:mouseY
            };
        }

        window.onload = function(){
            canvas = document.getElementById('gameCanvas');
            canvasContext = canvas.getContext('2d');

            var framesPerSecond = 30;
            setInterval(function(){
                moveEverything();
                drawEverything();
            }, 1000/framesPerSecond);

            canvas.addEventListener('mousemove', function(evt){
                var mousePos = calculateMousePos(evt);
                paddle1Y = mousePos.y - (PADDLE_HEIGHT/2);
            })
        }
        function ballReset(){
            ballSpeedX = 4;
            ballSpeedX = -ballSpeedX;
            ballX = canvas.width/2;
            ballY = canvas.height/2;
        }
        function computerMovement()  {
            if(paddle2Y < ballY){
                paddle2Y= paddle2Y + 7.2;
            } else
                {
                    paddle2Y= paddle2Y - 7.2;
                }

        }
        function moveEverything(){
            computerMovement();
            ballX = ballX + ballSpeedX;
            ballY = ballY + ballSpeedY;
            if(ballX < 0){
                if(ballY > paddle1Y && ballY < paddle1Y+PADDLE_HEIGHT){
                    ballSpeedX-=3;
                    ballSpeedX = -ballSpeedX;
                } else {
                    ballReset();
                }
            }
            if(ballX>canvas.width)
                {

                if(ballY > paddle2Y && ballY < paddle2Y+PADDLE_HEIGHT){
                    ballSpeedX+=3;
                    ballSpeedX = -ballSpeedX;
                } else {
                    ballReset();
                }

                }
            if(ballY < 0){
                ballSpeedY = -ballSpeedY;
            }
            if(ballY > canvas.height){
                ballSpeedY = -ballSpeedY;
            }
        }
        function drawEverything(){
            var c = document.getElementById("gameCanvas");
            var ctx = c.getContext("2d");
            var img = document.getElementById("image")
            ctx.drawImage(img,0,0);
            colorCircle(ballX, ballY, 10, 'LightGreen');
            colorRect(0, paddle1Y, 10, PADDLE_HEIGHT, 'white');
            colorRect(790, paddle2Y,10,PADDLE_HEIGHT, 'white');
        }
        function colorRect(leftX, topY, width, height, drawColor){
            canvasContext.fillStyle = drawColor;
            canvasContext.fillRect(leftX, topY, width, height);
        }

        function colorCircle(centerX, centerY, radius, drawColor){
            canvasContext.fillStyle = drawColor;
            canvasContext.beginPath();
            canvasContext.arc(centerX, centerY, radius, 0, Math.PI * 2, true);
            canvasContext.fill();
        }
    </script>
  </div>
  <div class = "col-md-2">
  </div>
  </div>
</html>
