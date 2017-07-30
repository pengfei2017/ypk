/**
 * Created by Administrator on 2017/4/22 0022.
 */
var is_g_name = false;
$(function () {
    var key = getCookie('key');
    // $("input[name='key']").val(key); //设置表单的key
    $(".g_name").change(function(){
        $(".g_jingle").empty();
        $(".g_jingle").append("<option value='-1'>-请选择-</option>")
        if($(this).val()!=-1) {
            // var selected_name1 = $(this).find("option:selected").html();
            var selected_name1 = $(this).val();
            loadServiceList2(selected_name1, key);
        }
    });
    function loadServiceList2(g_lingle,key){
        if(is_g_name = false){
            $.post(ApiUrl+"/member_index/load_service_category3",{"g_lingle":g_lingle,"key":key},function (data) {
                if(data==""){
                    $(".g_jingle").append("<option selected = 'selected' value='"+g_lingle+"'>"+g_lingle+"</option>");
                }else{
                    $(".g_jingle").append(data);
                }
                // $(".g_name").append(data);
                initBaseData(key); //编辑时初始化基本数据
            },null);
            is_g_name=true;
        }

    };
})