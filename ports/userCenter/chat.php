<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!($_POST['userId'] || $_POST['friendId'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}

$result = array();
$face = array();
$userId = $_POST['userId'];
$friendId = $_POST['friendId'];
require('../../common/common.php');
$users = $userId < $friendId ? $userId.'-'.$friendId : $friendId.'-'.$userId;
$data = getData("SELECT fromId,toId,content,sendtime FROM message WHERE users='$users'");
$face['user'] = fetchResult("SELECT face FROM users WHERE userid=$userId")['face'];
$face['friend'] = fetchResult("SELECT face FROM users WHERE userid=$userId")['face'];
$result['data'] = $data;
$result['face'] = $face;

mysql_close();
$result['resultCode'] = 200;
$result['resultMsg'] = '发送成功';
callback($result);
?>