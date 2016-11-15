/**
 * Created by Jerry_Qiu on 2016/6/27.
 */
function setCookie(name,value,days) {
    var days = days ? days : 7;
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = name + '=' + value + (days == 0 ? '' : ';expires='+date.toGMTString()) + ';path=' + '/php/system';
}
function getCookie(name) {
    if (document.cookie.length>0){
        var start=document.cookie.indexOf(name + "=");
        if (start!=-1){
            start = start + name.length+1;
            var end=document.cookie.indexOf(";",start);
            if (end==-1) end=document.cookie.length;
            return unescape(document.cookie.substring(start,end))
        }
    }
    return ""
}
function getString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURIComponent(r[2]); return null;
}
function inarr(arr,str){                     //判断数组中是否存在str，ie8以下不支持indexOf方法
    for(var i=0;i<arr.length;i++){
        if( str === arr[i] ) return true;
    }
    return false;
}
function setSex() {
    var sexVal = $('.sex:checked').val();
    if(sexVal == '女') return 2;
    return 1;
}
function getPage(str) {
    var page = getString(str);
    if(!page) return 1;
    page = Number(page);
    if(isNaN(page)) return 1;
    return Math.floor(page);
}
function transTime(str,param) {
    var now = new Date();
    var date = new Date(str);
    var time = str.split(' ')[1];

    var timediff = (now.getTime() - date.getTime())/(24*60*60*1000);
    var week1 = now.getDay();
    var week2 = date.getDay();
    var weekdiff = (function () {
        if( week1 < week2 ) return week1 - week2 + 7;
        return week1 - week2;
    })();

    function settime() {
        var week = (function () {
            var arr = ['日','一','二','三','四','五','六'];
            return '星期' + arr[week2];
        })();
        if( timediff < 2 ){
            if( weekdiff < 1 ) return  time;
            if( weekdiff < 2 ){
                if(param) return '昨天 ' + time;
                return '昨天';
            }
            if(param) return week + ' ' + time;
            return week + ' ' + time;
        }
        if(timediff >= 2 && timediff< 7){
            if( weekdiff <= 0 ){
                if(param) return str.substr(5,5) + ' ' + time;
                return str.substr(5,5);
            }
            if(param) return week + ' ' + time;
            return week;
        }
        var year1 = now.getFullYear();
        var year2 = date.getFullYear();
        if(year1 > year2){
            if(param) return str;
            return str.split(' ')[0];
        }
        if(param) return str.substr(5,5) + ' ' + time;
        return str.substr(5,5);
    }

    var t = settime();
    return t;
}

function footStyle() {
    var pg = $(window).height();
    var foottop = $('.foot').offset().top;
    var footheight = $('.foot').innerHeight();
    if(foottop + footheight < pg){
        $('.foot').addClass('fixed');
    }else{
        $('.foot').removeClass('fixed');
    }
}
$(function () {
    var url = window.location.href;
    var filename = url.replace(/(.*\/)*([^.]+).*/ig,"$2");
    var arr = ['about','friends','trends','userCenter'];
    var flag = inarr(arr,filename);
    if(flag > 0){
        $('.'+filename).addClass('current');
    }else{
        $('.index').addClass('current');
    }

    window.onresize = function () {
        footStyle();
    }
});
