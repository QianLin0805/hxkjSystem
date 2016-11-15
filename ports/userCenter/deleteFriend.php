<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!($_POST['userid'] || $_POST['friendid'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
require('../../common/common.php');

$userid = $_POST['userid'];
$friendid = $_POST['friendid'];
mysql_query("DELETE from friends WHERE userid=$userid and friendid=$friendid");

if(mysql_affected_rows()){
    mysql_close();
    $result['resultCode'] = 200;
    $result['resultMsg'] = '删除成功';
    callback($result);
}
?>