/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    footStyle();
    var modified = false;
    laydate({                                                         //日历
        elem: '#birthday',
        choose: function () {
            modified = true;
        }
    });
    $(window).on('resize',function () {
        var left = $('#birthday').offset().left - 9;
        if($('#laydate_box').length>0){
            $('#laydate_box').css('left',left);
        }
    });

    var port = $('#root').val();
    var filename = window.location.href.replace(/(.*\/)*([^.]+).*/ig,"$2");
    var userid = getCookie('userid');
    $('input,textarea').on('change',function () {
        modified = true;
    });

    new formtest({
        enterLimit: true,
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
            if(!modified){
                pop({
                    type:"tip",
                    content:"未做任何更改！"
                });
                return;
            }
            /*var portrait = $('.portrait').children('img').attr('src').split('/');
                portrait = portrait[portrait.length - 1];*/
            var name = $('input[name="username"]').val();
            var email = $('input[name="email"]').val();
            var birthday = $('input[name="birthday"]').val();
            var address = $('input[name="address"]').val();
            var destr = $('textarea').val();

            $.ajax({
                type: 'post',
                url: port + 'userCenter/modify.php',
                dataType: 'json',
                data: {
                    "userid": userid,
                    "name": name,
                    "email": email,
                    "birthday": birthday,
                    "address": address,
                    "destr": destr
                    //"portrait": portrait
                },
                success : function (data) {
                    if(data.resultCode == 200){
                        pop({
                            type:"tip",
                            content:"修改成功！"
                        });
                        setTimeout(function () {
                            window.location.reload();
                        },1350);
                    }else{
                        pop({
                            type:"tip",
                            content:data.resultMsg
                        });
                    }
                },
                error : function () {
                    pop({
                        type:"tip",
                        content:"错误"
                    });
                }
            });
        }
    });
});