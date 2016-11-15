<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/24
 * Time: 23:20
 */
if(!defined('IN_TG') || !$_GET['friendId']){
    exit('Fail To Access');
}

$friendid = $_GET['friendId'];
$userid = $_COOKIE['userid'];
$state = fetchResult("SELECT state FROM message WHERE fromId=$friendid and toId=$userid and state=1")['state'];
if($state){
    mysql_query("UPDATE message SET state=2 WHERE fromId=$friendid and toId=$userid and state=1");
}

$friendname = fetchResult("SELECT name FROM users WHERE userid=$friendid")['name'];

?>
<div class="main chat">
    <h3>与 <?php echo $friendname; ?> 对话</h3>
    <div class="wrap">
        <p class="loadTip">数据加载中...</p>
    </div>
    <div class="send">
        <textarea name="" id=""></textarea>
        <p id="send">发送</p>
    </div>
</div>
