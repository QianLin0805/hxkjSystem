<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/6/27
 * Time: 9:11
 */
session_start();
define('IN_TG',true);
define("LINK",'login_register');
require('common/common.php');
if(isset($_COOKIE['username'])){
    poptip();
    exit('Faild To Access!');
}
if(isset($_GET['code'])) testcode($_GET['code']);
if(isset($_GET['name'])) testNameAjax($_GET['name']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户注册</title>
    <?php require(URLPATH.'inc/link.inc.php') ?>
    <link rel="stylesheet" href="source/css/pop.css" />
    <link rel="stylesheet" href="source/css/formtest.css" />
    <script type="text/javascript" src="source/js/ajaxtest.js"></script>
    <script type="text/javascript" src="source/plug/poptip.js"></script>
</head>
<body>
<input type="hidden" id="port" value="<?php echo ROOTPORT; ?>">
<input type="password" style="display: none;">
<?php
require(URLPATH.'inc/header.inc.php');
?>
<div class="main register" id="form-test">
    <ul>
        <li class="form-item user"><span>昵称：</span><div><input type="text" name="username" maxlength="20" placeholder="例：张三" category="昵称" required /><p></p></div></li>
        <li class="form-item"><span>性别：</span><div><input type="radio" name="sex" id="men" class="sex" value="男" checked /><label for="men">男</label><input type="radio" name="sex" id="women" class="sex" value="男" /><label for="women">女</label></div></li>
        <li class="form-item"><span>密码：</span><div><input type="password" name="password" maxlength="40" placeholder="请输入密码" category="密码" required /><p></p></div></li>
        <li class="form-item"><span>确认密码：</span><div><input type="password" name="repassword" maxlength="40" placeholder="再次输入密码" category="密码" required /><p></p></div></li>
        <li class="form-item"><span>手机号：</span><div><input type="tel" name="mobile" maxlength="11" placeholder="请输入手机号" category="手机号" required /><p></p></div></li>
        <li class="form-item"><span>邮箱：</span><div><input type="email" name="email" maxlength="40" placeholder="zs123@163.com" /><p></p></div></li>
        <li class="form-item code"><span>验证码：</span><div><input type="tel" name="code" maxlength="6" /><img src="common/code.php" alt="" class="changeCode" /><i class="codeTip"></i></div></li>
        <li class="sub"><button type="submit" name="sub" id="form-sub" value="提交">提交</button></li>
    </ul>
</div>
<?php
require(URLPATH.'inc/foot.inc.php');
?>
<script type="text/javascript" src="source/plug/formtest.js"></script>
<script type="text/javascript" src="source/js/login_register.js"></script>
</body>
</html>
