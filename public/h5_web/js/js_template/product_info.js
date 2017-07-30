$(function() {
    var goods_id = getQueryString("goods_id");
    $.ajax({
        url: ApiUrl + "/goods/goods_body",
        data: {goods_id: goods_id},
        type: "get",
        success: function(result) {
            $(".fixed-tab-pannel").html(result);
        }
    });

    $('#goodsDetail').click(function(){
        window.location.href = WapSiteUrl+'/js_template/product_detail.html?goods_id=' + goods_id;
    });
    $('#goodsBody').click(function(){
        window.location.href = WapSiteUrl+'/js_template/product_info.html?goods_id=' + goods_id;
    });
    $('#goodsEvaluation').click(function(){
        window.location.href = WapSiteUrl+'/js_template/product_eval_list.html?goods_id=' + goods_id;
    });
});