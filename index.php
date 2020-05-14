<?php
    session_start(); 
    function generateRandomString($length = 8)
    {
        $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString= "" ;

        for ($i=0; $i < $length; $i++) { 
            $randomString .= $character[rand(0,strlen($character) - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>captcha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .answerFace{
            width: 13em;
            height: 13em;
        }

        .answer{
            display: grid;
            grid-gap: 10px;
            grid-template: auto auto;
            grid-auto-flow: row; 
            justify-items: center;
        }
    </style>
</head>
<body>  
    <div class="container mt-4">
        <?php 
            if (!isset($_POST['captcha'])) {
                $_SESSION['captcha'] = generateRandomString();
            } else {
                if ($_SESSION['captcha'] === $_POST['captcha']) {?>
                    <div class="row answer">
                        <img src="https://www.askideas.com/media/07/Cute-Happy-Baby-Picture.jpg" class="answerFace thumbnail">
                        <p class="font-weight-bold text-center d-block">You are a human! Welcome.....</p>
                    </div>
                <?php
                    unset($_POST['captcha']);
                    $_SESSION['captcha'] = generateRandomString();
                } else {?>
                    <div class="row answer">
                        <img src="https://image.shutterstock.com/image-photo/head-shoot-cute-baby-blue-260nw-88582219.jpg" class="answerFace thumbnail">
                        <p class="font-weight-bold text-center">Uh You are a bot!!!!!!</p>
                    </div>
                <?php
                    $_SESSION['captcha'] = generateRandomString();
                }
                
            }
            
        ?>
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="panel">
                    <hr>
                    <div class="panel-heading">
                        <h1 class="text-center">
                            Am you a Human?
                        </h1>
                    </div>
                    <hr>
                    <center>
                        <img src="https://captchahost.herokuapp.com/captcha.php" alt="">
                    </center>
                    <form action="" method="post" class="mt-5">
                    <div class="input-group mb-3">
                        <input name="captcha" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="enter the text you see.....">
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit" id="button-addon2">Button</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>