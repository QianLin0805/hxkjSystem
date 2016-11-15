<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!($_POST['fromId'] || $_POST['toId'] || $_POST['method'])){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '失败';
    callback($data);
}
require('../../common/common.php');
$fromId = $_POST['fromId'];
$toId = $_POST['toId'];

if($_POST['method'] == 1){
    $fromInfo = fetchResult("SELECT name,face FROM users WHERE userid=$fromId");
    $fromInfo['userid'] = $fromId;
    $fromInfo['friendid'] = $toId;
    $toInfo = fetchResult("SELECT name,face FROM users WHERE userid=$toId");
    $toInfo['userid'] = $toId;
    $toInfo['friendid'] = $fromId;
    $fromInfo['friendname'] = $toInfo['name'];
    $toInfo['friendname'] = $fromInfo['name'];
    unset($fromInfo['name']);
    unset($toInfo['name']);
    $fieldname1 = insertData($fromInfo);
    $fieldvalue1 = insertData($fromInfo,2);
    $fieldname2 = insertData($toInfo);
    $fieldvalue2 = insertData($toInfo,2);

    $before = @fetchResult("SELECT id FROM friends WHERE userid=$toId and friendid=$fromId");
    if($before){
        mysql_close();
        $result['resultCode'] = 200;
        $result['resultMsg'] = '你们已经是好友';
        callback($result);
    }

    mysql_query("INSERT INTO friends ($fieldname1) VALUES ($fieldvalue1)");
    $add1 = mysql_affected_rows();
    mysql_query("INSERT INTO friends ($fieldname2) VALUES ($fieldvalue2)");
    $add2 = mysql_affected_rows();
    mysql_query("UPDATE addfriend SET state=2 WHERE fromId=$fromId and toId=$toId");
    $modify = mysql_affected_rows();

    if($add1 && $add2 && $modify){
        mysql_close();
        $result['resultCode'] = 200;
        $result['resultMsg'] = '已添加为好友';
        callback($result);
    }
}else if($_POST['method'] == 2){
    mysql_query("DELETE from addfriend WHERE fromId=$fromId and toId=$toId");
    if(mysql_affected_rows()){
        mysql_close();
        $result['resultCode'] = 200;
        $result['resultMsg'] = '已删除';
        callback($result);
    }
}
?>