/**
 * Created by Jerry_Qiu on 2016/8/3.
 */
$(function () {
    var url = window.location.href;
    var category = url.match(/\?/g) ? url.split('?')[1] : 'profile';
    if(category.match(/&/g)) category = category.split('&')[0];
    var arr = ['modify','mobile','password','newfriend','myfriend','message','chat','note'];
    var flag = inarr(arr,category);
    if(flag){
        if(category == 'chat'){
            $('a.message').addClass('current');
            return;
        }
        $('a.'+category).addClass('current');
    }else{
        $('a.profile').addClass('current');
        footStyle();
    }
});
