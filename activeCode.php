<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/1
 * Time: 17:17
 */
if(!$_GET['activeCode']){
    exit('Fail To Access');
}
define('IN_TG',true);
define("LINK",'login_register');
require('common/common.php');

$arr = fetchResult("SELECT userid FROM users WHERE activecode='{$_GET['activeCode']}'");
if(!$arr) exit('页面已过期');
if(isset($_GET['action']) && $_GET['action'] == 'ok'){
    $data = array();
    $data['userid'] = $arr['userid'];
    $data['friendid'] = 1;
    $data['friendname'] = '幻想小子';
    $data['face'] = 'face_01.jpg';

    $fieldname = insertData($data);
    $fieldvalue = insertData($data,2);

    mysql_query("INSERT INTO friends ($fieldname) VALUES ($fieldvalue)");
    mysql_query("UPDATE users SET activecode='' WHERE activecode='{$_GET['activeCode']}'");
    header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>激活注册</title>
    <?php require(URLPATH.'inc/link.inc.php') ?>
</head>
<body>
<?php
require(URLPATH.'inc/header.inc.php');
?>
<div class="activate">
    <p>请点击下面链接，以激活注册！</p>
    <a href="" class="link"></a>
</div>
<?php
require(URLPATH.'inc/foot.inc.php');
?>
<script type="text/javascript">
$(function () {
    $('.link').attr('href',window.location.href + '&action=ok').text(window.location.href + '&action=ok');
});
</script>
</body>
</html>
