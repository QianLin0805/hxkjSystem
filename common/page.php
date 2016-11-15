<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/7/28
 * Time: 17:02
 */
if(!defined('IN_TG')){
    exit('Fail To Access');
}

function setpage($curpage,$size=4,$dataCount,$url){
    $pageCount = ceil($dataCount/$size);

    echo '<div class="pages">';
    if($curpage > 1) echo '<a href="'.$url.'" class="first">首页</a><a href="'.$url.'&pages='.($curpage-1).'" class="prev">上一页</a>';
    if($curpage <= 3 || $pageCount <= 5){
        for($i=1;$i<=$pageCount;$i++) {
            if($i > 5) continue;
            echo '<a href="'.$url.'&pages='.$i.'" class="pageNum">'.$i.'</a>';
        }
    }else{
        if($curpage <= $pageCount - 2) {
            for ($i = $curpage - 2; $i <= $curpage + 2; $i++) {
                echo '<a href="'.$url.'&pages='.$i.'" class="pageNum">'.$i.'</a>';
            }
        }else{
            for ($i = $pageCount - 4; $i <= $pageCount; $i++) {
                echo '<a href="'.$url.'&pages='.$i.'" class="pageNum">'.$i.'</a>';
            }
        }
    }
    if($curpage < $pageCount)echo '<a href="'.$url.'&pages='.($curpage + 1).'" class="next">下一页</a><a href="'.$url.'&pages='.$pageCount.'" class="last">尾页</a>';
    echo '</div>';
}

setpage($curPage,$size,$dataCount,$url);

?>