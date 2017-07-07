<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/24
 * Time: 23:20
 */
define('IN_TG',true);
define("LINK",'friends');
require(dirname(__FILE__).'/common/common.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>幻想空间</title>
    <?php require(URLPATH.'inc/link.inc.php') ?>
    <link rel="stylesheet" href="source/css/pop.css" />
    <script type="text/javascript" src="source/js/common.js"></script>
    <script type="text/javascript" src="source/plug/poptip.js"></script>
    <script type="text/javascript" src="source/js/friends.js"></script>
</head>
<body>
<input type="hidden" id="root" value="<?php echo ROOTPORT; ?>" />
<?php
    require(URLPATH.'inc/header.inc.php');
?>
<div class="main">
    <p class="tips">数据加载中...</p>
    <ul class="list"></ul>
    <p class="change">换一批</p>
</div>
<div class="mask">
    <div class="bg"></div>
    <img src="source/images/close.png" alt="" class="close" />
    <div class="maskBox">
        <h4>请填写验证信息</h4>
        <textarea name=""></textarea>
        <p id="send">发送</p>
    </div>
</div>
<?php
require(URLPATH.'inc/foot.inc.php');
?>
</body>
</html>
