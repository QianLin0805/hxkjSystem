<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/24
 * Time: 23:20
 */
if(!defined('IN_TG')){
    exit('Fail To Access');
}
?>
<div class="top">
    <div class="top_wrap">
        <span>欢迎 <?php if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?></span>
        <p>
            <?php
                if(isset($_COOKIE['username'])){
                    echo '<a href="'.ROOT.'common/logout.php">退出</a>'."\n";
                }else{
                    echo '<a href="login.php">登录</a>'."\n\t".'<a href="register.php">注册</a>'."\n";
                }
            ?>
            <a href="<?php echo ROOT; ?>help.php">帮助</a>
        </p>
    </div>
</div>
<div class="nav">
    <div class="nav_wrap">
        <img src="<?php echo ROOTIMG; ?>logo.png" alt="" class="logo" />
        <p><a href="<?php echo ROOT; ?>index.php" class="index">首页</a><a href="<?php echo ROOT; ?>about.php" class="about">关于我们</a><a href="<?php echo ROOT; ?>friends.php" class="friends">幻想热友</a><a href="<?php echo isset($_COOKIE['username'])?ROOT.'trends.php':'login.php'; ?>" class="trends">好友动态</a><a href="<?php echo isset($_COOKIE['username'])?ROOT.'userCenter/userCenter.php':'login.php'; ?>" class="userCenter">个人中心</a></p>
    </div>
</div>