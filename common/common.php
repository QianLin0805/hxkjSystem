<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/25
 * Time: 16:39
 */
if(!defined('IN_TG')){
    exit('Fail To Access');
}
if(PHP_VERSION < '4.1.0'){
    exit('Version is to Low!');
}
define('URLPATH',$_SERVER['DOCUMENT_ROOT'].'/php/system/');

require(URLPATH.'common/global.php');

require(URLPATH.'common/sqlConnect.php');

define('STARTTIME',getTime());

define('ROOT','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,12));
define('ROOTPORT','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,12).'ports/');
define('ROOTFACE','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,12).'source/face/');
define('ROOTIMG','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,12).'source/images/');
define('ROOTJS','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,12).'source/js/');

?>
