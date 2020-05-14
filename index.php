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

    function generateCaptchaImage($text = 'abc')
    {
        header("Content-Type: image/png");

        $width = 200;
        $height = 30;
        // create the image
        $im = imagecreatetruecolor($width, $height);

        // create some color
        $white = imagecolorallocate($im, 255, 255, 255);
        $grey = imagecolorallocate($im, 128, 128, 128);
        $black = imagecolorallocate($im, 0, 65, 123);
        imagefilledrectangle($im, 0, 0, 399, 29, $white);

        // ADD NOISE, Draw background squares
        $square_count = 6;
        for ($i=0; $i < $square_count; $i++) { 
            $cx = rand(0, $width);
            $cy = (int)rand(0, $height/2);
            $h = $cy + (int)rand(0, $height/5);
            $w = $cx + (int)rand($width/3, $width);
            imagefilledrectangle($im, $cx, $cy, $w, $h, $white);
        }

        // ADD NOISE, Draw ellipse
        $ellipse_count = 10;
        for ($i=0; $i < $ellipse_count; $i++) { 
            # code...
            $cx = (int)rand(-1*($width/2), $width+($width/2));
            $cy = (int)rand(-1*($height/2), $height+($height/2));
            $h = (int)rand($height/2, 2*$height);
            $w = (int)rand($width/2, 2*$width);
            imageellipse($im, $cx, $cy, $w, $h, $grey);
        }

        $font = dirname(__FILE__). '/fonts/ThisisKeSha.ttf';
        imagettftext($im, 20, 0, 11, 21, $grey, $font, $text); //add some shadow to text
        imagettftext($im, 20, 0, 10, 20, $black, $font, $text); //add the text

        imagepng($im);
        imagedestroy($im);
    }

    $_SESSION['captcha'] = generateRandomString();
    generateCaptchaImage($_SESSION['captcha']);
?>