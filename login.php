<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/4
 * Time: 9:56
 */
session_start();
define('IN_TG',true);
define("LINK",'login_register');
require('common/common.php');
if(isset($_COOKIE['username'])){
    poptip();
    exit('Faild To Access!');
}
if($_GET['code']) testcode($_GET['code']);
if($_GET['name']) testNameAjax($_GET['name']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <?php require(URLPATH.'inc/link.inc.php') ?>
    <link rel="stylesheet" href="source/css/pop.css" />
    <link rel="stylesheet" href="source/css/formtest.css" />
    <script type="text/javascript" src="source/js/ajaxtest.js"></script>
    <script type="text/javascript" src="source/plug/pop.js"></script>
</head>
<body>
<input type="hidden" id="port" value="<?php echo ROOTPORT; ?>">
<input type="password" style="display: none;">
<?php
require(URLPATH.'inc/header.inc.php');
?>
<div class="main login" id="form-test">
    <ul>
        <li class="form-item user"><span>昵称：</span><div><input type="text" name="username" maxlength="20" placeholder="例：张三" category="昵称" required /></div></li>
        <li class="form-item"><span>密码：</span><div><input type="password" name="password" maxlength="40" placeholder="请输入密码" category="密码"  required /></div></li>
        <li class="form-item code"><span>验证码：</span><div><input type="tel" name="code" maxlength="6" /><img src="common/code.php" alt="" class="changeCode" /><i class="codeTip"></i></div></li>
        <li class="sub"><button type="submit" name="sub" id="form-sub" value="登录">登录</button></li>
    </ul>
</div>
<?php
require(URLPATH.'inc/foot.inc.php');
?>
<script type="text/javascript" src="source/plug/formtest.js"></script>
<script type="text/javascript" src="source/js/login_register.js"></script>
</body>
</html>
