/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var port = $('#root').val();
    var userid = getCookie('userid');
    var pages = getPage('pages');
    var size = 5;

    function popback(str) {
        pop({
            type : "tip",
            content : str
        });
    }
    var delay = $.Deferred();
    $.ajax({
        type : 'post',
        url : port + 'userCenter/newfriend.php',
        dataType : 'json',
        data : {
            'toId' : userid,
            'pages' : pages,
            'size' : size
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
                    var agree;
                    if(data[i].state == 1){
                        agree = '<span class="agree">同意</span>';
                    }else if(data[i].state == 2){
                        agree = '<span class="agreed">已同意</span>';
                    }
                    var html = '<li fromId="'+ data[i].userid +'"><img src="../source/face/'+ data[i].face +'" alt="" class="face" />';
                        html += '<div class="wrap"><h4>'+ data[i].name +'<img src="../source/'+ sex +'" alt="" class="sex"></h4><p class="info">';
                    if(data[i].age) html += '<span class="age">'+ data[i].age +'岁</span>';
                    if(data[i].address) html += '<span class="address">'+ data[i].address +'</span>';
                    html += '</p><p class="content">'+ data[i].content +'</p>';
                    html += '<p class="state">'+ agree +'<span class="delete">删除</span></p></div></li>';
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
    delay.done(function () {
        $('.agree').on('click',function () {
            function agree(obj) {
                obj.unbind('click');
                var id = obj.parents('li').attr('fromId');

                $.ajax({
                    type : 'post',
                    url : port + 'userCenter/addfriendAction.php',
                    dataType : 'json',
                    data : {
                        'method' : 1,
                        'fromId' : id,
                        'toId' : userid
                    },
                    success: function (data) {
                        if(data.resultCode == 200){
                            pop({
                                type : "tip",
                                content : data.resultMsg,
                                callback : function(){
                                    obj.text('已同意').removeClass('agree').addClass('agreed');

                                    var count = $('.newfriend .count').text();
                                    if(count <= 1){
                                        $('.newfriend .count').text('0').remove();
                                    }else{
                                        $('.newfriend .count').text(count - 1);
                                    }
                                }
                            });
                        }else{
                            pop({
                                type : "tip",
                                content : data.resultMsg,
                                callback : function(){
                                    obj.on('click',function () {
                                        agree($(this));
                                    });
                                }
                            });
                        }
                    },
                    error : function () {
                        pop({
                            type : "tip",
                            content : '出错',
                            callback : function(){
                                obj.on('click',function () {
                                    agree($(this));
                                });
                            }
                        });
                    }
                });
            }
            agree($(this));
        });
        $('.delete').on('click',function () {
            function delEl(obj) {
                obj.unbind('click');
                var id = obj.parents('li').attr('fromId');

                $.ajax({
                    type : 'post',
                    url : port + 'userCenter/addfriendAction.php',
                    dataType : 'json',
                    data : {
                        'method' : 2,
                        'fromId' : id,
                        'toId' : userid
                    },
                    success: function (data) {
                        if(data.resultCode == 200){
                            pop({
                                type : "tip",
                                content : data.resultMsg,
                                callback : function(){
                                    obj.parents('li').fadeOut(300,function () {
                                        $(this).remove();
                                        if($('.list li').length <= 0){
                                            window.location.reload();
                                            return;
                                        }
                                        if(obj.prev().is('.agree')){
                                            var count = $('.newfriend .count').text();
                                            if(count <= 1){
                                                $('.newfriend .count').text('0').remove();
                                                return;
                                            }
                                            $('.newfriend .count').text(count - 1);
                                        }                                        
                                    });
                                }
                            });
                        }else{
                            pop({
                                type : "tip",
                                content : data.resultMsg,
                                callback : function(){
                                    obj.on('click',function () {
                                        delEl($(this));
                                    });
                                }
                            });
                        }
                    },
                    error : function () {
                        pop({
                            type : "tip",
                            content : '出错',
                            callback : function(){
                                obj.on('click',function () {
                                    delEl($(this));
                                });
                            }
                        });
                    }
                });
            }
            delEl($(this));
        });
    });
});