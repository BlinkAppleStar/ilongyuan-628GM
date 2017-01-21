$(function(){
	var location = window.location.href,
		id = getQueryString("id"),
		mongo_id = '',uid = '',type = '',start_time='',end_time = '';
	if(id != ''){ //编辑
		_title = "编辑";
		$.ajax({
			url: pageUrl + "/black-list/detail",
			type: "get",
			dataType: "json",
			data:{ajax:1,id:id},
			success: function(data){
				uid = data.data.uid,
				type = data.data.type,
				start_time = data.data.start_time,
				end_time = data.data.end_time;
				$('#form_shieldEdit').find('input[name="mongo_id"]').val(id);
				$('#form_shieldEdit').find('.mongo_id').html(id);
				$('#form_shieldEdit').find('input[name="uid"]').val(uid);
				$('#form_shieldEdit').find('select[name="type"]').val(type);
				$('#form_shieldEdit').find('input[name="start_time"]').val(start_time);
				$('#form_shieldEdit').find('input[name="end_time"]').val(end_time);
			}
		})
	}else{
		_title = "新增";
		$('#form_shieldEdit').find('input[name="mongo_id"]').parent().hide();
	}
	//更改页面title
	document.title = "封号工具"+_title+"记录";
	// 提交表单
	$('#postForm').bind('click',function(){
		var datas = '';
		datas = $("#form_shieldEdit").serialize();
		$.ajax({
			url: pageUrl + "/black-list/edit",
			type: "post",
			dataType: "json",
			data:"ajax=1&" + datas,
			success: function(data){
				alert("操作成功"),window.close();
			}
		})
	})	
	/*获取url中的参数值*/
	function getQueryString(name){
	    // 如果链接没有参数，或者链接中不存在我们要获取的参数，直接返回空
	    if(location.indexOf("?")==-1 || location.indexOf(name+'=')==-1){
	        return '';
	    }
	    // 获取链接中参数部分
	    var queryString = location.substring(location.indexOf("?")+1);
	    // 分离参数对 ?key=value&key2=value2
	    var parameters = queryString.split("&");
	    var pos, paraName, paraValue;
	    for(var i=0; i<parameters.length; i++){
	        // 获取等号位置
	        pos = parameters[i].indexOf('=');
	        if(pos == -1) { continue; }
	        // 获取name 和 value
	        paraName = parameters[i].substring(0, pos);
	        paraValue = parameters[i].substring(pos + 1);
	        // 如果查询的name等于当前name，就返回当前值，同时，将链接中的+号还原成空格
	        if(paraName == name){
	            return paraValue;
	        }
	    }
	    return '';
	};
})