<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

$data = array();
$data['data'] = array();
if(!$_POST['userid']){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
if(!$_POST['size']){
    $size = 8;
}else{
    $size = $_POST['size'];
}

require('../common/common.php');

$userid = $_POST['userid'];
$allusers = getData("SELECT * FROM users WHERE userid!=1 and userid!=$userid");
$friendid = getData("SELECT friendid FROM friends WHERE userid=$userid");

$friendsid = array();
for($i=0;$i<count($friendid);$i++){
    array_push($friendsid,$friendid[$i]['friendid']);
}
for($i=0;$i<count($allusers);$i++){
    if(in_array($allusers[$i]['userid'],$friendsid)) continue;
    array_push($data['data'],$allusers[$i]);
}
if(count($data['data'])>8) $data['data'] = array_rand($data['data'],8);
shuffle($data['data']);
mysql_close();

$data['resultCode'] = 200;
$data['resultMsg'] = '发送成功';

callback($data);
?>