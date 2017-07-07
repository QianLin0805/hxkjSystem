<?php
/**
 * Created by PhpStorm.
 * User: qjl_0
 * Date: 2016/6/26
 * Time: 9:44
 */

//session_start();

date_default_timezone_set('PRC');
function getTime(){                                        //获取时间的微秒数
    $arr = explode(' ',microtime());
    $starttime = $arr[0] + $arr[1];
    return $starttime;
}

function savecookie($name,$value,$time = 7){             //保存cookie
    setcookie($name,$value,time()+$time*86400,'/php/system');
}
function unsetcookie($name){                             //删除cookie
    setcookie($name,'',time()-1,'/php/system');
}
function cuniq(){                                        //唯一标识符
    $uniq = md5(uniqid(rand(),true));
    return $uniq;
}

function callback($arr){                                 //ajax调用返回结果对象
    echo json_encode($arr);
    exit;
}
function testcode($code){                                //验证验证码
    $codestr = $_SESSION['code'];
    $ptn = "/^$codestr$/i";
    $arr = array();
    if(!preg_match($ptn,$code)){
        $arr['resultCode'] = 300;
        $arr['resultMsg'] = '失败';
    }else{
        $arr['resultCode'] = 200;
        $arr['resultMsg'] = '成功';
    }
    callback($arr);
}
function testNameAjax($name,$cookiename=''){                            //检测用户名是否存在
    if($name == $cookiename){
        $arr['type'] = 2;
        $arr['resultMsg'] = '';
        callback($arr);
    }
    $sentence = "SELECT name FROM users WHERE name='$name'";
    $arr = array();
    if(existName($sentence)){
        $arr['type'] = 1;
        $arr['resultMsg'] = 'exist';
    }else{
        $arr['type'] = 0;
        $arr['resultMsg'] = 'non-exist';
    }
    callback($arr);
}

function trans($str){                                    //转义字符
    if(!get_magic_quotes_gpc()){
        return mysql_real_escape_string($str);
    }else{
        return $str;
    }
}
function insertData($arr,$type = 1){                     //插入数据语句字段包装
    foreach($arr as $key => $value){
        $value = is_numeric($value) ? $value : '\''.$value.'\'';
        if($type == 1){
            if(!isset($str)){
                $str = $key;
            }else{
                $str .= ','.$key;
            }
        }elseif ($type == 2){
            if(!isset($str)){
                $str = $value;
            }else{
                $str .= ','.$value;
            }
        }
    }
    return $str;
}
function updateData($arr){                               //更新数据
    foreach ($arr as $key => $value){
        $value = is_numeric($value) ? $value : '\''.$value.'\'';
        if(!isset($str)){
            $str = $key.'='.$value;
        }else{
            $str .= ','.$key.'='.$value;
        }
    }
    return $str;
}

function getAge($str){                                   //获取年龄
    $time = time();
    $date = date('Y-m-d',$time);
    list($year1,$month1,$day1) = preg_split("/[\-\.]/",$str);
    list($year2,$month2,$day2) = preg_split("/[\-\.]/",$date);
    $age = $year2 - $year1;
    if( (int)($month2.$day2) < (int)($month1.$day1) ) return $age-1;
    return $age;
}
function getCurPage($str){                               //获取页码
    if(!isset($_GET[$str])) return 1;
    $num = floatval($_GET[$str]);
    if(!$num || $num <= 0) return 1;
    $curPage = round($num);
    return $curPage;
}
function getSex($type){                                  //获取性别
    switch ($type){
        case 2:
            $sex = '女';
            break;
        default:
            $sex = '男';
            break;
    }
    return $sex;
}

function skip($link,$str=''){                            //页面跳转
    if($str){
        echo "<script type='text/javascript'>window.location.href = '$link';alert('".$str."');</script>";
    }else{
        header('Location:'.$link);
    }
}
function poptip($str=''){                                //弹窗提示
    if($str){
        echo "<script type='text/javascript'>history.back();alert('".$str."');</script>";
    }else{
        echo "<script type='text/javascript'>history.back();</script>";
    }
}

?>