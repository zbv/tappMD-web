<?php
session_start();

$string = '';

for ($i = 0; $i < 5; $i++) {
	$string .= chr(rand(97, 122));
}

$_SESSION['random_number'] = $string;

$dir = 'fonts/';

$image = imagecreatetruecolor(135, 35);

// random number 1 or 2
$num = rand(1,2);
if($num==1)
{
	$font = "1.ttf"; // font style
}
else
{
	$font = "2.ttf"; // font style
}

// random number 1 or 2
$num2 = rand(1,2);
if($num2==1)
{
	$color = imagecolorallocate($image, 113, 193, 217);// color
}
else
{
	$color = imagecolorallocate($image, 163, 197, 82);// color
}

$white = imagecolorallocate($image, 255, 255, 255); // background color white
imagefilledrectangle($image,0,0,399,99,$white);

imagettftext ($image, 25, 0, 10, 25, $color, $dir.$font, $_SESSION['random_number']);

header("Content-type: image/png");
imagepng($image);

?>