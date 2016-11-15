<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!$_POST['name']){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
require('../../common/common.php');
require('../../common/test.php');
testname($_POST['name']);
if($_POST['email']) testemail($_POST['email']);
if($_POST['birthday']) testdate($_POST['birthday']);

$result = array();
$data = array();
if($_POST['name']) $data['name'] = $_POST['name'];
if($_POST['email']) $data['email'] = $_POST['email'];
if($_POST['birthday']) $data['birthday'] = date("Y.m.d",strtotime($_POST['birthday']));
if($_POST['address']) $data['address'] = trans($_POST['address']);
if($_POST['destr']) $data['destr'] = trans($_POST['destr']);
$fieldname = insertData($data);

$userid = $_POST['userid'];
$userinfo = fetchResult("SELECT $fieldname FROM users WHERE userid=$userid");

if($data == $userinfo){
    $result['resultCode'] = 301;
    $result['resultMsg'] = '未做任何更改';
    callback($result);
}
$updata = array();
foreach($data as $key => $value){
    if($data[$key] != $userinfo[$key]) $updata[$key] = $data[$key];
}
$content = updateData($updata);

mysql_query("UPDATE users SET $content WHERE userid=$userid");
if(mysql_affected_rows()) {
    mysql_close();
    $result['resultCode'] = 200;
    $result['resultMsg'] = '修改成功';
    callback($result);
}

?>