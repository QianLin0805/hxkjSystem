<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/24
 * Time: 23:20
 */
define('IN_TG',true);
define("LINK",'index');
require('common/common.php');
$hxxz = fetchResult("SELECT userid FROM users WHERE name='幻想小子'");
if(!$hxxz){
    $hxxz = array();
    $hxxz['name'] = '幻想小子';
    $hxxz['sex'] = 1;
    $hxxz['email'] = 'qjl_0805@126.com';
    $hxxz['face'] = 'face_01.jpg';

    $fieldname = insertData($hxxz);
    $fieldvalue = insertData($hxxz,2);

    mysql_query("INSERT INTO users ($fieldname) VALUES ($fieldvalue)");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>幻想空间</title>
    <?php require(URLPATH.'inc/link.inc.php') ?>
</head>
<body>
<?php
    require(URLPATH.'inc/header.inc.php');
?>
<div class="banner">
    <div class="slide">图片轮播</div>
</div>
<div class="main">
    <div class="con_wrap">
        <div class="list list1">菜单栏1</div>
        <div class="content">正文内容</div>
        <div class="list list2">菜单栏2</div>
    </div>
</div>
<?php
require(URLPATH.'inc/foot.inc.php');
?>
</body>
</html>
