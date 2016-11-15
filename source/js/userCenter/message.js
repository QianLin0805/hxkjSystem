/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var port = $('#root').val();
    var userid = getCookie('userid');

    $.ajax({
        type : 'post',
        url : port + 'userCenter/message.php',
        dataType : 'json',
        data : {
            'toId' : userid
        },
        success : function (response) {
            if(response.resultCode == 200){
                var data = response.data;
                if(data.length <= 0){
                    $('.load').hide().next().show();
                    return;
                }

                for(var i=0;i<data.length;i++){
                    var time = transTime(data[i].sendtime);
                    var html = '<li>';
                        html += '<a href="?chat&friendId='+ data[i].id +'"><img src="../source/face/'+ data[i].face +'" alt="" class="face" />';
                        html += '<div class="wrap"><p class="name">'+ data[i].username +'</p>';
                        html += '<p class="content">'+ data[i].content +'</p>';
                        html += '<p class="time">'+ time +'</p>';
                        if(data[i].unread) html += '<p class="unread">'+ data[i].unread +'</p>';
                        html += '</div></a></li>';
                    $('.list').append(html);
                }

                $('.tips').hide();
                $('.list').show();
                footStyle();
            }else{
                $('.load').text('数据加载失败');
            }
        },
        error : function () {
            $('.load').text('数据库连接失败');            
        }
    });
});