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
require('../../common/common.php');

$result = array();
$data = array();
$fromId = $_POST['fromId'];
$toId = $_POST['toId'];
$data['users'] = $fromId < $toId ? $fromId.'-'.$toId : $toId.'-'.$fromId;
$data['fromId'] = $fromId;
$data['toId'] = $toId;
$data['content'] = $_POST['content'];
$data['state'] = 1;

$fieldname = insertData($data);
$fieldvalue = insertData($data,2);
mysql_query("INSERT INTO message ($fieldname,sendtime) VALUES ($fieldvalue,NOW())");

if(mysql_affected_rows()){
    mysql_close();
    $result['resultCode'] = 200;
    $result['resultMsg'] = '发送成功';
    callback($result);
}
?>