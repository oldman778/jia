<?php
$img=imagecreate(181,50);
$bcolor=imagecolorallocate($img,255,255,255);
$content='0123456789abcdefghijklmnopqrstuvwxyz';
$num=strlen($content);
$font='D:\Software\phpstudy_pro\font\ZCOOLXiaoWei-Regular.ttf';
$code='';
for ($i=0;$i<4;$i++) { 
    $ang=mt_rand(-30,30);
    $font_color=imagecolorallocate($img,mt_rand(250,400),mt_rand(250,400),mt_rand(250,400));
    $font_size=35;
    $font_content=$content[mt_rand(0,$num-1)];
    $code.=$font_content;
    session_start();
    $_SESSION['code']=$code;
    imagettftext($img,$font_size,$ang,30+($i*30),35,$font_color,$font,$font_content);
}
header('Content-type:image/jpeg');
imagejpeg($img);