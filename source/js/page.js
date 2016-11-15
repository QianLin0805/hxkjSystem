/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var curpage = getPage('pages');
    if($('.pages')){
        var pagesize = $('.pageNum').length;
        for(var i=0;i<pagesize;i++){
            var text = parseInt($('.pages').find('.pageNum').eq(i).text());
            if(curpage == text){
                $('.pages').find('.pageNum').eq(i).addClass('current');
                $('.pages').find('.current').on('click',function (e) {
                    var e = e || window.event;
                    e.preventDefault();
                });
            }
        }
    }
});