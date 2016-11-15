/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var pg = $(window).height();
    $('.main').css('height',pg - 270 +'px');

    var port = $('#root').val();
    var userid = getCookie('userid');
    var friendid = getString('friendId');
    var myface,friendface;

    var delay = $.Deferred();
    $.ajax({
        type : 'post',
        url : port + 'userCenter/chat.php',
        dataType : 'json',
        data : {
            'userId' : userid,
            'friendId' : friendid
        },
        success : function (response) {
            if(response.resultCode == 200){
                var datas = response.data;
                myface = response.face.user;
                friendface = response.face.friend;
                var content;
                for(var i=0;i<datas.length;i++){
                    var classname = datas[i].fromId == userid ? 'myself' : '';
                    var face = datas[i].fromId == userid ? myface : friendface;
                    var item = '<div class="dialog '+ classname +'">';
                        item += '<img src="../source/face/'+ face +'" alt="" class="face" />';
                        item += '<div class="content"><p class="arrow"></p>';
                        item += '<span>'+ datas[i].content +'</span>';
                        item += '</div></div>';
                    if(content){
                        content += item;
                    }else{
                        content = item;
                    }
                }
                $('.loadTip').hide();
                $('.wrap').append(content);
                $('.wrap').append('<div class="edge"><p class="line"></p><span>以上历史消息</span></div>');
                delay.resolve();
            }else{

            }
        },
        error : function () {

        }
    });

    delay.done(function () {
        $('#send').on('click',function(){
            var text = $('textarea').val();
            if(!text) return;
            var item = '<div class="dialog myself">';
            item += '<img src="../source/face/'+ face +'" alt="" class="face" />';
            item += '<div class="content"><p class="arrow"></p>';
            item += '<span>'+ text +'</span>';
            item += '</div></div>';
            $('.wrap').append(item);
            $('textarea').val('');

            $.ajax({
                type : 'post',
                url : port + 'userCenter/sendMsg.php',
                dataType : 'json',
                data : {
                    'fromId' : userid,
                    'toId' : friendid,
                    'content' : text
                },
                success : function (response) {
                    if(response.resultCode == 200){

                    }else{

                    }
                },
                error : function () {

                }
            });
        });
    })

});