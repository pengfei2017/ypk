$(function(){
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }


	Array.prototype.unique = function()
	{
		var n = [];
		for(var i = 0; i < this.length; i++)
		{
			if (n.indexOf(this[i]) == -1) n.push(this[i]);
		}
		return n;
	}
	var keyword = decodeURIComponent(getQueryString('keyword'));
    if (keyword) {
    	$('#keyword').val(keyword);writeClear($('#keyword'));
    }
    $('#keyword').on('input',function(){
    	var value = $.trim($('#keyword').val());
    	if (value == '') {
    		$('#search_tip_list_container').hide();
    	} else {
            $.getJSON(ApiUrl + '/goods/auto_complete',{term:$('#keyword').val()}, function(result) {
            	if (!result.datas.error) {
                	var data = result.datas;
                	data.WapSiteUrl = WapSiteUrl;
                	if (data.list.length > 0) {
                		$('#search_tip_list_container').html(template.render('search_tip_list_script',data)).show();
                	} else {
                		$('#search_tip_list_container').hide();
                	}
            	}
            })
    	}
    });

    $('.input-del').click(function(){
        $(this).parent().removeClass('write').find('input').val('');
    });

    template.helper('$buildUrl',buildUrl);
    $.getJSON(ApiUrl + '/index/search_key_list', function(result) {
    	var data = result.datas;
    	data.WapSiteUrl = WapSiteUrl;
    	$('#hot_list_container').html(template.render('hot_list',data));
        $('#search_his_list_container').html(template.render('search_his_list',data));
    })

    $('#header-nav').click(function(){
    	if ($('#keyword').val() == '') {
    		window.location.href = buildUrl('keyword',getCookie('deft_key_value') ? getCookie('deft_key_value') : '');
    	} else {
            var search_type=$("#search_type").val();
            if(search_type=='商品'){
                window.location.href = buildUrl('keyword',$('#keyword').val());
			}
    		else {
                window.location.href =WapSiteUrl+'/shop2.html?keyword='+$('#keyword').val();
			}
    	}
    });
});