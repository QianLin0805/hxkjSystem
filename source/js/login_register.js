/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function(){
    var port = $('#port').val();
    $('input[name="code"]').val('');
    $('.changeCode').on('click',function(){
        var number = Math.random(0,1);
        $('.changeCode').attr('src','common/code.php?num='+number);
    });

    var filename = window.location.href.replace(/(.*\/)*([^.]+).*/ig,"$2");
    var flagCode = false;
    $('input[name="code"]').on('keyup',function () {
        if($(this).val().length >= 6){
            if(flagCode) return;
            flagCode = testcode();
        }else{
            flagCode = false;
            $('.code').find('.success').remove();
        }
    });

    var flag = false;
    $('.sub button').on('click',function(){
        flag = true;
    });
    if(filename == 'login'){
        new formtest({
            enterLimit: true,
            beforeSub: function(){
                if(flag) return;
            },
            ajaxtest: {
                state : 'on',
                testItem : $('input[name="username"]'),
                callback : function(){
                    return testname(filename);
                },
                success : function(){
                    $('.user div').append('<i class="success"></i>');
                },
                defeate : function(){
                    $('.user').find('.success').remove();
                },
                errorTip : '昵称不存在'
            },
            callback: function(){
                if(!flagCode) return;
                var name = $("input[name='username']").val();
                var password = $("input[name='password']").val();
                
                $.ajax({
                    type: 'post',
                    url: port + 'login.php',
                    dataType: 'json',
                    data: {
                        "name": name,
                        "password": password
                    },
                    success: function (data) {
                        if(data.resultCode == 200){
                            setCookie('uniqid',data.uniqid);
                            setCookie('username',name);
                            setCookie('userid',data.userid);
                            window.location.href = 'userCenter/userCenter.php';
                        }else{
                            pop({
                                type:"tip",
                                content:"用户不存在或密码错误，请重新输入！"
                            });
                        }
                        flag = false;
                    },
                    error: function () {
                        flag = false;
                        pop({
                            type:"tip",
                            content:"错误"
                        });
                    }
                });
            }
        });
    }else if(filename == 'register'){
        new formtest({
            enterLimit: true,
            beforeSub: function(){
                if(flag) return;
            },
            ajaxtest: {
                state : 'on',
                testItem : $('input[name="username"]'),
                callback : function(){
                    return testname(filename);
                },
                success : function(){
                    $('.user div').append('<i class="success"></i>');
                },
                defeate : function(){
                    $('.user').find('.success').remove();
                },
                errorTip : '昵称已被使用',
                showTip : 'on'
            },
            callback: function(){
                if(!flagCode) return;
                var name = $('input[name="username"]').val();
                var sex = setSex();
                var password = $("input[name='password']").val();
                var mobile = $("input[name='mobile']").val();
                var email = $("input[name='email']").val();

                $.ajax({
                    type: 'post',
                    url: port + 'register.php',
                    dataType: 'json',
                    data: {
                        "name": name,
                        "sex": sex,
                        "password": password,
                        "mobile": mobile,
                        "email": email
                    },
                    success: function (data) {
                        if(data.resultCode == 200){
                            pop({
                                type:"tip",
                                content:"恭喜，注册成功！"
                            });
                            setTimeout(function () {
                                window.location.href = 'activeCode.php?activeCode=' + data.code;
                            },1350);
                        }else{
                            pop({
                                type:"tip",
                                content:data.resultMsg
                            });
                        }
                        flag = false;
                    },
                    error: function () {
                        flag = false;
                        pop({
                            type:"tip",
                            content:"错误"
                        });
                    }
                });
            }
        });
    }
});
