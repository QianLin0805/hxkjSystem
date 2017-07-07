/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var port = $('#root').val();
    var userid = getCookie('userid');
    var pages = getPage('pages');

    var delay = $.Deferred();
    $.ajax({
        type : 'post',
        url : port + 'userCenter/myfriend.php',
        dataType : 'json',
        data : {
            'userid' : userid,
            'pages' : pages,
            'size' : 5
        },
        success : function (response) {
            if(response.resultCode == 200){
                var data = response.data;
                if(data.length <= 0){
                    $('.load').hide().next().show();
                    return;
                }
                for(var i=0;i<data.length;i++){
                    var sex;
                    if(data[i].sex == 1){
                        sex = 'images/male.png';
                    }else if(data[i].sex == 2){
                        sex = 'images/female.png';
                    }
                    var html = '<li friendid="'+ data[i].userid +'">';
                    html += '<img src="../source/face/'+ data[i].face +'" alt="" class="face" /><div class="wrap">';
                    html += '<h4>'+ data[i].name +'<img src="../source/'+ sex +'" alt="" class="sex" /></h4>';
                    html += '<p class="info">';
                    if(typeof data[i].age == 'number') html += '<span class="age">'+ (data[i].age<=0 ? 1 : data[i].age) +'岁</span>';
                    if(data[i].address) html += '<span class="address">'+ data[i].address +'</span>';
                    html += '</p><p class="contact">';
                    if(data[i].mobile) html += '<span class="mobile">手机：'+ data[i].mobile +'</span>';
                    if(data[i].email) html += '<span class="email">邮箱：'+ data[i].email +'</span>';
                    html += '</p>'
                    if(data[i].destr) html += '<p class="destr">个人说明：'+ data[i].destr +'</p>';
                    html += '<p class="operate"><a href="?chat&toId='+ data[i].userid +'" class="sendMsg" title="发消息"></a>';
                    if(data[i].userid != 1) html += '<span class="delete">删除好友</span></p>';
                    html += '</div></li>';

                    $('.list').append(html);
                }
                $('.tips').hide();
                $('.list').show();
                delay.resolve();
                footStyle();
            }else{
                $('.load').text('数据加载失败');
            }
        },
        error : function () {
            $('.load').text('数据库连接失败');            
        }
    });

    delay.done(function(){
        function hideMask() {
            $('.mask').fadeOut(200,function () {
                $('.maskBox h4').text('');
                $('textarea').val('');
            });
        }

        //删除好友
        $('.delete').on('click',function(){
            function delFriend(obj){
                obj.unbind('click');
                var friendid = obj.parents('li').attr('friendid');
                pop({
                    type : 'confirm',
                    content : '是否确认要删除些好友',
                    callback : function () {
                        $.ajax({
                            type : 'post',
                            url : port + 'userCenter/deleteFriend.php',
                            dataType : 'json',
                            data : {
                                'userid' : userid,
                                'friendid' : friendid
                            },
                            success : function (data) {
                                if(data.resultCode == 200){
                                    pop({
                                        type : 'tip',
                                        content : data.resultMsg,
                                        callback : function(){
                                            obj.parents('li').remove();
                                            if($('.list li').length <= 0){
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }else{
                                    pop({
                                        type:"tip",
                                        content:'删除失败',
                                        callback : function(){
                                            obj.on('click',function () {
                                                delFriend($(this));
                                            });
                                        }
                                    });
                                }
                            },
                            error : function () {
                                obj.on('click',function () {
                                    delFriend($(this));
                                });
                                pop({
                                    type:"tip",
                                    content:'删除失败',
                                    callback : function(){
                                        obj.on('click',function () {
                                            delFriend($(this));
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            }
            delFriend($(this));
        });
    });
});