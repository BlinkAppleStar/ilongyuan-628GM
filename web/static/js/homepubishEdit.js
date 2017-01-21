$(function(){
	var location = window.location.href,
		setPage = getQueryString("setPage"),
		id = getQueryString("id"),
		lid = '',name = '',ip='',port = '',active = '',set_import = '';
	//判断当前页面更改内容
	switch(setPage){
		case "channel" : 
			_title = "渠道";
			break;
		case "version" :
			_title = "版本";
			break;
		case "language"	:
			_title = "语言";
			break;
		default :
			_title = "区服";
	}
	//更改页面title
	document.title = "发布公告"+_title+"编辑";
	//判断是添加还是编辑操作
	if(id != ''){ //编辑
		$.ajax({
			url: pageUrl + "/setting/detail",
			type: "get",
			dataType: "json",
			data:{ajax:1,table_name:setPage,id:id},
			success: function(data){
				lid = data.data.lid,
				name = data.data.name,
				ip = data.data.ip,
				port = data.data.port,
				active = data.data.active,
				set_import = data.data.set_import;
				if(setPage == "game_server"){
					$('#form_serverEdit').show().siblings('#form_otherEdit').remove();
					$('#form_serverEdit').find('input[name="id"]').val(id);
					$('#form_serverEdit').find('.other_id').html(id);
					$('#form_serverEdit').find('.gameServer_id').val(id);
					$('#form_serverEdit').find('input[name="lid"]').val(lid);
					$('#form_serverEdit').find('input[name="name"]').val(name);
					$('#form_serverEdit').find('input[name="ip"]').val(ip);
					$('#form_serverEdit').find('input[name="port"]').val(port);
					if(active == 1){
						$('#form_serverEdit').find('.sendCon_radio.yes').attr('checked',true);
					}else{
						$('#form_serverEdit').find('.sendCon_radio.no').attr('checked',true);
					}
				}else{
					$('#form_otherEdit').show().siblings('#form_serverEdit').remove();
					$('#form_otherEdit').find('input[name="id"]').val(id);
					$('#form_otherEdit').find('.other_id').html(id);
					$('#form_otherEdit').find('input[name="name"]').val(name);
					if(active == 1){
						$('#form_otherEdit').find('.sendCon_radio.yes').attr('checked',true);
					}else{
						$('#form_otherEdit').find('.sendCon_radio.no').attr('checked',true);
					}
				}
			}
		})	
	}else{ //添加
		if(setPage == "game_server"){
			$('#form_serverEdit').show().siblings('#form_otherEdit').remove();
		}else{
			$('#form_otherEdit').show().siblings('#form_serverEdit').remove();
		}
		$('#form_serverEdit,#form_otherEdit').find('input[name="id"]').parent().hide();
	}
	// 提交表单
	$('#postForm').bind('click',function(){
		var datas = '';
		if(setPage == "game_server"){		
			datas = $("#form_serverEdit").serialize();
			$.ajax({
				url: pageUrl + "/setting/edit-game-server",
				type: "post",
				dataType: "json",
				data:"ajax=1&" + datas,
				success: function(data){
					alert("操作成功"),window.close();
				}
			})
		}else{
			datas = $("#form_otherEdit").serialize();
			$.ajax({
				url: pageUrl + "/setting/edit",
				type: "post",
				dataType: "json",
				data:"ajax=1&" + "table_name=" + setPage +"&"+ datas,
				success: function(data){
					alert("操作成功"),window.close();
				}
			})
		}
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