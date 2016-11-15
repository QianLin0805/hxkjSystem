<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/24
 * Time: 23:20
 */
if(!defined('IN_TG') || !$_GET['toId']){
    exit('Fail To Access');
}

$friendid = $_GET['toId'];
$friendname = fetchResult("SELECT name FROM users WHERE userid=$friendid")['name'];

?>
<div class="main chat">
    <h3>与 <?php echo $friendname; ?> 对话</h3>
    <ul class="wrap">
        <li class="myself">
            <img src="" alt="" class="face" />
            <div class="content">
                <p class="arrow"></p>
                <span class="content"></span>
            </div>
        </li>
    </ul>
</div>
