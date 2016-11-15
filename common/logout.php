<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/5
 * Time: 14:00
 */
define('IN_TG',true);
require('common.php');
if(!isset($_COOKIE['username'])){
    exit('Faild To Access!');
}
unsetcookie('username');
unsetcookie('uniqid');

header("Location: ../index.php");
?>