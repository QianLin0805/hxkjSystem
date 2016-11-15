<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!($_POST['userid'] || $_POST['pages']  || $_POST['size'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '加载失败';
    callback($data);
}
require('../../common/common.php');

$result = array();
$result['data'] = array();
$id = $_POST['userid'];
$begin = ($_POST['pages'] - 1) * $_POST['size'];
$size = $_POST['size'];

$data = getData("SELECT * FROM friends WHERE userid=$id ORDER BY CONVERT(friendname USING gbk) COLLATE gbk_chinese_ci ASC");

for($i=$begin;$i<($begin+$size);$i++){
    $userid = $data[$i]['friendid'];
    if(!$userid) continue;
    $userinfo = fetchResult("SELECT sex,mobile,email,birthday,address,destr FROM users WHERE userid=$userid");
    $arr = array();
    $arr['userid'] = $userid;
    $arr['name'] = $data[$i]['friendname'];
    $arr['face'] = $data[$i]['face'];
    $arr['sex'] = $userinfo['sex'];
    $arr['mobile'] = $userinfo['mobile'];
    $arr['email'] = $userinfo['email'];
    $arr['age'] = $userinfo['birthday'] ? getAge($userinfo['birthday']) : '';
    $arr['address'] = $userinfo['address'];
    $arr['destr'] = $userinfo['destr'];
    array_push($result['data'],$arr);
}

mysql_close();
$result['resultCode'] = 200;
$result['resultMsg'] = '修改成功';
callback($result);

?>