<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!($_POST['fromId'] || $_POST['toId'] || $_POST['content'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
require('../common/common.php');
$sendinfo = getData("SELECT toId FROM addfriend WHERE fromId='{$_POST['fromId']}'");

$toId = array();
for($i=0;$i<count($sendinfo);$i++){
    array_push($toId,$sendinfo[$i][toId]);
}
if( in_array($_POST['toId'],$toId) ){
    $result['resultCode'] = 300;
    $result['resultMsg'] = '已发送过验证信息';
    callback($result);
}

$result = array();
$data = array();
$data['fromId'] = $_POST['fromId'];
$data['toId'] = $_POST['toId'];
$data['content'] = $_POST['content'] ? $_POST['content'] : '';
$data['state'] = 1;

$fieldname = insertData($data);
$fieldvalue = insertData($data,2);
mysql_query("INSERT INTO addfriend ($fieldname,sendtime) VALUES ($fieldvalue,NOW())");
if(mysql_affected_rows()){
    mysql_close();
    $result['resultCode'] = 200;
    $result['resultMsg'] = '发送成功';
    callback($result);
}
?>