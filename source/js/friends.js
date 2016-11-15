/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var pg = $(window).height();
    $('.main').css('height',pg - 310 + 'px');
    var port = $('#root').val();
    var userid = getCookie('userid');
    var myname = getCookie('username');
    var friendid;

    function hideMask() {
        $('.mask').fadeOut(200,function () {
            $('textarea').val('');
        });
    }
    //加载会员列表信息
    function loadData(arr){
        for(var i=0;i<arr.length;i++){
            var sex;
            if(arr[i].sex == 1){
                sex = 'source/images/male.png';
            }else if(arr[i].sex == 2){
                sex = 'source/images/female.png';
            }
            var item = '<li friendid="'+arr[i].userid+'"><img src="source/face/'+arr[i].face+'" alt="" class="face" /><p><span class="name" title="'+arr[i].name+'">'+arr[i].name+'</span><img src="'+sex+'" alt="" class="sex" /><span class="add">加好友</span></p></li>';
            $('.list').append(item);
            var username = $('.list').find('.name').eq(i).text();
            if(username.length>4){
                username = username.substr(0,4) + '...';
            }
            $('.list').find('.name').eq(i).text(username);
        }
    }
    //加好友
    function add(){
        $('.add').on('click',function(){
            var el = $(this).parents('li');
            if(!userid){
                window.location.href='login.php';
                return;
            }
            friendid = el.attr('friendid');
            $('textarea').val('你好，我是'+myname);
            $('.mask').fadeIn(100);
        });
    }

    $.ajax({
        type : 'post',
        url : port + 'friends.php',
        dataType : 'json',
        data : {
            'userid' : userid
        },
        success : function (response) {
            if(response.resultCode == 200){
                $('.tips').hide().next().show();
                var data = response.data;
                loadData(data);
                add();
            }else{
                $('.tips').text(response.resultMsg);
            }
        },
        error : function () {
            $('.tips').text('数据请求失败！');
        }
    });

    //换一批
    var flag = false;
    $('.change').on('click',function(){
        if(flag) return;
        flag = true;
        $.ajax({
            type : 'post',
            url : port + 'friends.php',
            dataType : 'json',
            data : {
                'userid' : userid
            },
            success : function (response) {
                if(response.resultCode == 200){
                    $('.tips').hide().next().show();
                    var data = response.data;
                    $('.list').children().remove();
                    loadData(data);
                    add();
                }else{
                    pop({
                        type:"tip",
                        content:response.resultMsg
                    });
                }
                flag = false;
            },
            error : function () {
                flag = false;
                pop({
                    type:"tip",
                    content:"数据请求失败！"
                });
            }
        });
    });


    $('.close').on('click',function () {
        hideMask();
    });
    $(document).on('keyup',function (e) {
        var e = e || window.event;
        if(e.keyCode == 27){
            hideMask();
        }
    });
    //发送
    var send = false;
    $('#send').on('click',function(){
        if(send) return;
        send = true;
        var content = $('textarea').val();

        $.ajax({
            type : 'post',
            url : port + 'addfriend.php',
            dataType : 'json',
            data : {
                'fromId' : userid,
                'toId' : friendid,
                'content' : content
            },
            success : function (data) {
                if(data.resultCode == 200){
                    hideMask();
                    setTimeout(function(){
                        pop({
                            type:"tip",
                            content:data.resultMsg
                        });
                    },200);
                }else{
                    hideMask();
                    setTimeout(function(){
                        pop({
                            type:"tip",
                            content:data.resultMsg
                        });
                    },200);
                }
                send = false;
            },
            error : function () {
                pop({
                    type:"tip",
                    content:'发送失败'
                });
                send = false;
            }
        });
    });
});