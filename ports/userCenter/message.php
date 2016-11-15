<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 10:44
 */
define('IN_TG',true);

if(!$_POST['toId']){
    $data['resultCode'] = 300;
    $data['resultMsg'] = '加载失败';
    callback($data);
}
require('../../common/common.php');

$id = $_POST['toId'];
$data = getData("SELECT * FROM message WHERE id in ( SELECT MAX(id) FROM message WHERE toId=$id or fromId=$id GROUP BY users) ORDER BY sendtime DESC");

$result = array();
$result['data'] = array();
$friendids = array();
for($i=0;$i<count($data);$i++){
    if($id == $data[$i]['toId']){
        $friendid = $data[$i]['fromId'];
        $unread = getDataCount("SELECT state FROM message WHERE toId=$id and fromId=$friendid and state=1");
    }elseif($id == $data[$i]['fromId']){
        $friendid = $data[$i]['toId'];
        $unread = 0;
    }

    $userinfo = fetchResult("SELECT name,face FROM users WHERE userid=$friendid");

    $arr = array();
    $arr['id'] = $friendid;
    $arr['face'] = $userinfo['face'];
    $arr['username'] = $userinfo['name'];
    $arr['content'] = trans($data[$i]['content']);
    $arr['sendtime'] = $data[$i]['sendtime'];
    $arr['unread'] = $unread;

    array_push($result['data'],$arr);
}

mysql_close();
$result['resultCode'] = 200;
$result['resultMsg'] = '成功';
callback($result);

?>