<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/25
 * Time: 16:34
 */
if(!defined('IN_TG')){
    exit('Fail To Access');
}

define('ENDTIME',getTime());
define('RUNTIME',round((ENDTIME - STARTTIME),4));
?>
<div class="foot">底部<br /><span>网站加载耗时：<?php echo RUNTIME; ?>秒</span></div>
