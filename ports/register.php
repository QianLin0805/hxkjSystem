<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/8/3
 * Time: 17:17
 */
define('IN_TG',true);
if(!($_POST['name'] && $_POST['password'] && $_POST['mobile'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
require('../common/common.php');
include('../common/test.php');

testname($_POST['name']);
$sentence = "SELECT name FROM users WHERE name='{$_POST['name']}'";
if(existName($sentence)){
    $arr = setArr(300,'用户名已存在');
    callback($arr);
}
testpwd($_POST['password']);
testmobile($_POST['mobile']);
if($_POST['email']) testemail($_POST['email']);

$data = array();
$data['activecode'] = cuniq();
$data['name'] = $_POST['name'];
$data['sex'] = $_POST['sex'];
$data['password'] = md5($_POST['password']);
$data['mobile'] = $_POST['mobile'];
if($_POST['email']) $data['email'] = $_POST['email'];
$data['face'] = 'face_01.jpg';

$fieldname = insertData($data);
$fieldvalue = insertData($data,2);

mysql_query("INSERT INTO users ($fieldname,regist_time) VALUES ($fieldvalue,NOW())");
if(mysql_affected_rows()){
    mysql_close();
    session_destroy();
    $result['resultCode'] = 200;
    $result['resultMsg'] = '注册成功';
    $result['code'] = $data['activecode'];
    callback($result);
}
?>