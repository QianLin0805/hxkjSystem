<?php
/**
 * Created by PhpStorm.
 * User: Jerry_Qiu
 * Date: 2016/6/30
 * Time: 9:24
 */
define('SQL_HOST','localhost');
define('SQL_USER','root');
define('SQL_PWD','gh252363');
define('DARA_NAME','hxkj');

if(!$sql = @mysql_connect(SQL_HOST,SQL_USER,SQL_PWD)){
    exit('数据库连接错误：'.mysql_error());
}else{
    if(!@mysql_select_db(DARA_NAME)){
        exit('连接指定数据库失败：'.mysql_error());
    }else{
        if(!@mysql_query('SET NAMES UTF8')){
            exit('设置字符编码失败：'.mysql_error());
        }
    }
}
//返回执行sql语句的结果集
function fetchResult($sentence){
    $source = mysql_query($sentence);
    return mysql_fetch_array($source,MYSQL_ASSOC);
}
//检测用户名是否被注册
function existName($sentence){
    $result = fetchResult($sentence);
    if($result['name']){
        return true;
    }else{
        return false;
    }
}
//获取数据总数
function getDataCount($sentence){
    $source = mysql_query($sentence);
    return $count = mysql_num_rows($source);
}
//获取数据
function getData($sentence){
    $source = mysql_query($sentence);
    $arr = array();
    while ($row = mysql_fetch_array($source,MYSQL_ASSOC)){
        array_push($arr,$row);
    }
    return $arr;
}
?>