<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/8/3
 * Time: 13:44
 */
if(!defined('IN_TG')){
    exit('Fail To Access');
}
$data = fetchResult("SELECT * FROM users WHERE userid=$userid");
$sex = getSex($data['sex']);

echo '<div class="main profile"><h3>个人资料</h3>';
echo '<ul>
        <li class="portrait"><img src="'.ROOTFACE.'face_01.jpg" alt="" /></li>
        <li><span><i style="letter-spacing: 2em">姓</i>名：</span><p>'.$data['name'].'</p></li>
        <li><span><i style="letter-spacing: 2em">性</i>别：</span><p>'.$sex.'</p></li>
        <li><span><i style="letter-spacing: 2em">邮</i>箱：</span><p>'.$data['email'].'</p></li>
        <li><span><i style="letter-spacing: 0.5em">手机</i>号：</span><p>'.$data['mobile'].'</p></li>
        <li><span>出生日期：</span><p>'.$data['birthday'].'</p></li>
        <li><span><i style="letter-spacing: 2em">地</i>址：</span><p>'.$data['address'].'</p></li>
        <li><span>个人说明：</span><p>'.$data['destr'].'</p></li>
    </ul></div>';
?>