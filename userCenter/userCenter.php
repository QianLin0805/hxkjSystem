<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/18
 * Time: 10:02
 */
if(!isset($_COOKIE['username'])){
    header('Location: ../login.php');
    exit('Faild To Access!');
}
define('IN_TG',true);
define("LINK",'userCenter');
require('../common/common.php');
if(isset($_GET['name'])) testNameAjax($_GET['name'],$_COOKIE['username']);

$userid = $_COOKIE['userid'];
$arr = array('profile','modify','mobile','password','newfriend','myfriend','message','chat','note');
$fileName = explode('&',$_SERVER['QUERY_STRING'])[0];
$modele = in_array($fileName,$arr) ? $fileName : 'profile';
$newfriend = getDataCount("SELECT * FROM addfriend WHERE toId=$userid and state=1");
$message = getDataCount("SELECT * FROM message WHERE toId=$userid and state=1");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <?php require(URLPATH.'inc/userCenter.link.inc.php') ?>
    <?php
        if($modele == 'modify'){
            echo '<link rel="stylesheet" href="../source/css/pop.css" />
                  <link rel="stylesheet" href="../source/css/formtest.css" />
                  <script type="text/javascript" src="../source/js/ajaxtest.js"></script>
                  <script type="text/javascript" src="../source/plug/poptip.js"></script>
                  <script type="text/javascript" src="../source/plug/laydate.js"></script>';
        }else if($modele == 'myfriend' || $modele == 'newfriend' || $modele == 'chat'){
            echo '<link rel="stylesheet" href="../source/css/pop.css" />
                  <script type="text/javascript" src="../source/plug/poptip.js"></script>';
        }
    ?>
</head>
<body>
<input type="hidden" id="root" value="<?php echo ROOTPORT; ?>" />
<?php
require(URLPATH.'inc/header.inc.php');
?>
<div class="member">
    <div class="menu">
        <h2>用户总览</h2>
        <ul>
            <li><a href="userCenter.php" class="profile">个人资料</a></li>
        </ul>
        <h2>个人设置</h2>
        <ul>
            <li><a href="userCenter.php?modify" class="modify">修改资料</a></li>
            <li><a href="userCenter.php?mobile" class="mobile">修改手机</a></li>
            <li><a href="userCenter.php?password" class="password">修改密码</a></li>
        </ul>
        <h2>好友动态</h2>
        <ul>
            <li><a href="userCenter.php?newfriend" class="newfriend">新的朋友<?php if($newfriend>0)echo '<span class="count">'.$newfriend.'</span>'; ?></a></li>
            <li><a href="userCenter.php?myfriend" class="myfriend">我的好友</a></li>
            <li><a href="userCenter.php?message" class="message">我的私信<?php if($message>0)echo '<span class="count">'.$message.'</span>'; ?></a></li>
            <li><a href="userCenter.php?note" class="note">发表帖子</a></li>
        </ul>
    </div>
    <?php include $modele.'.php'; ?>
</div>
<?php
require(URLPATH.'inc/foot.inc.php');
?>
<?php
    if($modele == 'modify'){
        echo '<script type="text/javascript" src="../source/plug/formtest.js"></script>
              <script type="text/javascript" src="../source/js/userCenter/modify.js"></script>';
    }else if($modele == 'newfriend'){
        echo '<script type="text/javascript" src="../source/js/page.js"></script>
              <script type="text/javascript" src="../source/js/userCenter/newfriend.js"></script>';
    }else if($modele == 'myfriend'){
        echo '<script type="text/javascript" src="../source/js/page.js"></script>
              <script type="text/javascript" src="../source/js/userCenter/myfriend.js"></script>';
    }else if($modele == 'message'){
        echo '<script type="text/javascript" src="../source/js/userCenter/message.js"></script>';
    }else if($modele == 'chat'){
        echo '<script type="text/javascript" src="../source/js/userCenter/chat.js"></script>';
    }else if($modele == 'note'){
        echo '<script type="text/javascript" src="../source/js/userCenter/note.js"></script>';
    }
?>
</body>
</html>
