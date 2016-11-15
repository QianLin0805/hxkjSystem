<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!($_POST['toId'] || $_POST['pages']  || $_POST['size'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '加载失败';
    callback($data);
}
require('../../common/common.php');

$result = array();
$result['data'] = array();
$id = $_POST['toId'];
$begin = ($_POST['pages'] - 1) * $_POST['size'];
$size = $_POST['size'];


$dataAll = array();
$newData = getData("SELECT * FROM addfriend WHERE toId=$id and state=1");
$oldData = getData("SELECT * FROM addfriend WHERE toId=$id and state=2");
for($i=0;$i<count($newData);$i++){
    array_push($dataAll,$newData[$i]);
}
for($i=0;$i<count($oldData);$i++){
    array_push($dataAll,$oldData[$i]);
}
$data = array_slice($dataAll,$begin,$size);

for($i=0;$i<count($data);$i++){
    $userid = $data[$i]['fromId'];
    $userinfo = fetchResult("SELECT name,sex,face,birthday,address FROM users WHERE userid=$userid");
    $arr = array();
    $arr['userid'] = $userid;
    $arr['name'] = $userinfo['name'];
    $arr['sex'] = $userinfo['sex'];
    $arr['face'] = $userinfo['face'];
    $arr['age'] = $userinfo['birthday'] ? $userinfo['birthday'] : '';
    $arr['address'] = $userinfo['address'] ? $userinfo['address'] : '';
    $arr['content'] = $data[$i]['content'];
    $arr['sendtime'] = $data[$i]['sendtime'];
    $arr['state'] = $data[$i]['state'];
    array_push($result['data'],$arr);
}

mysql_close();
$result['resultCode'] = 200;
$result['resultMsg'] = '修改成功';
callback($result);

?>