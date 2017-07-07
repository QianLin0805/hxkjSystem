<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/8/3
 * Time: 17:17
 */
define('IN_TG',true);
if(!($_POST['name'] && $_POST['password'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
require('../common/common.php');

$result = array();
$data = array();
$data['uniqid'] = cuniq();
$data['name'] = $_POST['name'];
$data['password'] = md5($_POST['password']);

$sentence = "SELECT userid,activecode,password FROM users WHERE name='{$_POST['name']}'";
$userinfo = fetchResult($sentence);
if(!$userinfo){
    $result['resultCode'] = 300;
    $result['resultMsg'] = '用户名不存在';
    callback($result);
}
if($userinfo['activecode']){
    $result['resultCode'] = 300;
    $result['resultMsg'] = '账户未被激活';
    callback($result);
}
if($data['password'] != $userinfo['password']){
    $result['resultCode'] = 300;
    $result['resultMsg'] = '密码不正确';
    callback($result);
}

mysql_query("UPDATE users SET login_time=NOW(),uniqid='{$data['uniqid']}' WHERE name='{$_POST['name']}'");
if(mysql_affected_rows()) {
    mysql_close();

    $result['resultCode'] = 200;
    $result['resultMsg'] = '登录成功';
    $result['uniqid'] = $data['uniqid'];
    $result['userid'] = $userinfo['userid'];
    callback($result);
}
?>