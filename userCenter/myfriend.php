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

$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'?myfriend';
$curPage = getCurPage('pages');
$size = 5;
$dataCount = getDataCount("SELECT userid FROM friends WHERE userid=$userid");
if($curPage > ceil($dataCount/$size) && $curPage > 1){
    skip($url.'&pages='.($curPage-1));
}
?>
<div class="main friend myfriend">
    <h3>我的好友</h3>
    <p class="tips load">数据加载中...</p>
    <p class="tips nodata">暂无数据</p>
    <ul class="list">
    </ul>
    <?php
        if($dataCount > $size) include(URLPATH.'common/page.php');
    ?>
</div>
