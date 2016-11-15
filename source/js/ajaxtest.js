/**
 * Created by Jerry_Qiu on 2016/6/28.
 */
function testcode() {
    var codeValue = $("input[name='code']").val();
    if(codeValue == ''){
        $('.changeCode').next().text('请输入验证码');
        return false;
    }
    var result;
    $.ajax({
        type: 'get',
        async: false,
        url: '?code=' + codeValue,
        dataType: 'json',
        success: function(data) {
            if(data.resultCode == 200){
                $('.changeCode').next().text('');
                $('.code div').append('<i class="success"></i>');
                result = true;
            }else{
                $('.changeCode').next().text('验证码错误');
                $('.code').find('.success').remove();
                result = false;
            }
        }
    });
    return result;
}
function testname(filename) {
    var result;
    var value = $("input[name='username']").val();
    if(value == '') return result = false;
    $.ajax({
        type: 'get',
        async: false,
        url: '?name=' + value,
        dataType: 'json',
        success: function(data) {
            if(filename == 'login'){
                if(data.type == 0){
                    result = false;
                }else{
                    result = true;
                }
            }else if(filename == 'register'){
                if(data.type == 0){
                    result = true;
                }else{
                    result = false;
                }
            }else if(filename == 'userCenter'){
                if(data.type == 0 || data.type == 2){
                    result = true;
                }else{
                    result = false;
                }
            }
        },
        error: function () {
            result = false;
        }
    });
    return result;
}
