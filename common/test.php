<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/8/3
 * Time: 17:48
 */
function setArr($num,$msg){
    $arr = array();
    $arr['resultCode'] = $num;
    $arr['resultMsg'] = $msg;
    return $arr;
}
function testname($name){                                //验证姓名
    $ptn = "/^[一-龥·a-zA-Z0-9]+$/";
    if(!preg_match($ptn,$name)){
        $arr = setArr(300,'用户名格式不正确');
        callback($arr);
    }
    if(mb_strlen($name,'utf-8')<2 || mb_strlen($name,'utf-8')>20){
        $arr = setArr(300,'用户名必须为2-20个字符');
        callback($arr);
    }
}
function testpwd($pwd){                      //验证密码
    if(mb_strlen($pwd,'utf-8')<6 || mb_strlen($pwd,'utf-8')>20){
        $arr = setArr(300,'密码长度必须为6-20个字符');
        callback($arr);
    }
}
function testmobile($mobile){                            //验证手机号
    $ptn = "/^[1][34578][0-9]{9}$/";
    if(!preg_match($ptn,$mobile)){
        $arr = setArr(300,'手机号不存在');
        callback($arr);
    }
}
function testemail($email=''){                              //验证邮箱
    $ptn = "/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i";
    if(!preg_match($ptn,$email)){
        $arr = setArr(300,'邮箱格式不正确');
        callback($arr);
    }
}
function testdate($date){
    $ptn = "/^[12][\d]{3}[\-\.][01][\d][\-\.][0-3][\d]$/";
    if(!preg_match($ptn,$date)){
        $arr = setArr(300,'不是有效的日期');
        callback($arr);
    }
}
?>