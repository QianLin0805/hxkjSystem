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

echo '<div class="main profile modify"><h3>修改资料</h3>';
echo '<ul id="form-test">
        <li class="portrait"><img src="'.ROOTFACE.'face_01.jpg" alt="" /><br /><span>点击修改头像</span></li>
        <li class="form-item user"><span><i style="letter-spacing: 2em">昵</i>称：</span><div><input type="text" name="username" value="'.$data['name'].'" maxlength="20" category="昵称" required /></div></li>
        <li class="form-item"><span><i style="letter-spacing: 2em">邮</i>箱：</span><div><input type="text" name="email" value="'.$data['email'].'" maxlength="40" /></div></li>
        <li class="form-item"><span>出生日期：</span><div><input type="text" name="birthday" id="birthday" value="'.$data['birthday'].'" readonly /></div></li>
        <li class="form-item"><span><i style="letter-spacing: 2em">地</i>址：</span><div><input type="text" name="address" value="'.$data['address'].'" maxlength="50" /></div></li>
        <li class="form-item" style="overflow: hidden;min-height: 112px;"><span>个人说明：</span><div><textarea  name="destruction" maxlength="100" >'.$data['destr'].'</textarea></div></li>
        <li style="padding-top: 20px;"><button id="form-sub">提交</button></li>
    </ul></div>';
?>