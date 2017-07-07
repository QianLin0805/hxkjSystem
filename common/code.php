<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/6/27
 * Time: 13:26
 */
define('IN_TG',true);
header('Content-Type: image/png');
require(dirname(__FILE__) . '\common.php');

//创建验证码图片
session_start();
function code($width=145,$height=40,$size=6){
    $char = array_merge(range(0,9),range('a','z'),range('A','Z'));
    shuffle($char);
    for($i=0;$i<$size;$i++){
        if(!isset($str)){
            $str = $char[$i];
            continue;
        }
        $str .= $char[$i];
    }
    $_SESSION['code'] = $str;                    //储存session

    $code = imagecreatetruecolor($width,$height);
    $bg = imagecolorallocate($code,mt_rand(220,240),mt_rand(225,245),mt_rand(230,250));
    $font = URLPATH.'source/font/arial.ttf';
    imagefill($code,0,0,$bg);
    for($i=0;$i<$size;$i++){
        $line = imagecolorallocate($code,mt_rand(100,255),mt_rand(120,255),mt_rand(150,255));
        imageline($code,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$line);
    }
    for($i=0;$i<100;$i++){
        $snow = imagecolorallocate($code,mt_rand(180,245),mt_rand(190,250),mt_rand(200,255));
        imagestring($code,1,mt_rand(0,$width),mt_rand(0,$height),".",$snow);
    }
    for($i=0;$i<$size;$i++){
        $color = imagecolorallocate($code,mt_rand(50,180),mt_rand(75,200),mt_rand(100,220));
        imagettftext($code,mt_rand(12,16),mt_rand(-15,15),mt_rand(0,$width/$size-15)+$i*$width/$size,mt_rand(15,$height-5),$color,$font,$_SESSION['code'][$i]);
    }
    imagepng($code);
    imagedestroy($code);
}

code();

?>