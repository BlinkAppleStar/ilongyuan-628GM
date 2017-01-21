$(function(){
	var _id = window.location.href,
		_manageHref = "homepubishSetting.html", //其余管理跳转的设置页面url
		_GMmanageHref = "gameuserSetting.html", //区服管理跳转的设置页面url
		channel,server_id,version,lang,title,content,url,start_time,end_time,before_html,after_html;
	if(_id.indexOf("id=")<=0){
		_id = '';
	}else{
		_id = _id.substr(_id.indexOf("id=")+3,_id.length);
	}
	$('#postForm').click(function(){
		var datas = $("#postHomepiblish").serialize() + "&id=" + _id+"&ajax=1"+"&server_id="+$("#postHomepiblish").find("#server_id").attr("value");
		$.ajax({
			url: pageUrl + "/announce/edit",
			type: "post",
			dataType: "json",
			data:datas,
			success: function(data){
				alert("保存成功，即将关闭当前页面");
				window.close();
			}
		})
	})
	$('select[name="channel"]').settiongFn({//渠道
		_value:true,
		_state:false,
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"channel"},
		_postStr: channel
	});


	$('select[name="lang"]').settiongFn({//语言
		_state:false,
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"language"},
		_postStr: lang
	});

	$('select[name="version"]').settiongFn({//版本
		_state:false,
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"version"},
		_postStr: version
	});
	$('select[name="server_id"]').settiongFn({//区服
		_state:false,
		_url:pageUrl+"/setting/game-server-list",
		_data:{ajax:"1"},
		_postStr: server_id
	});
	$.ajax({
		url: pageUrl+"/announce/detail",
		type: "get",
		dataType: "json",
		data:{id:_id},
		success: function(data){
			before_html = '<option value="after_login">登录后</option>'+
						  '<option value="before_login" selected>登录前</option>';
			after_html = '<option value="after_login" selected>登录后</option>'+
						 '<option value="before_login">登录前</option>';
			if(data.ok){
				type = data.data.type;
				channel = data.data.channel;
				server_id = data.data.server_id;
				version = data.data.version;
				lang = data.data.lang;
				title = data.data.title;
				content = data.data.content;
				inscribe = data.data.inscribe;
				url = data.data.url;
				start_time = data.data.start_time;
				end_time = data.data.end_time;
				if(type == '' || type == null || type == 'after_login'){
					$("#postHomepiblish").find("select[name='type']").append(after_html);
				}else{
					$("#postHomepiblish").find("select[name='type']").append(before_html);
				}
				$('select[name="channel"]').val(channel);
				$('select[name="server_id"]').val(server_id);
				$('select[name="language"]').val(lang);
				$('select[name="version"]').val(version);
				$("#postHomepiblish").find("input[name='title']").val(title);
				$("#postHomepiblish").find("textarea[name='content']").val(content);
				$("#postHomepiblish").find("input[name='inscribe']").val(inscribe);
				$("#postHomepiblish").find("input[name='url']").val(url);
				$("#postHomepiblish").find("input[name='start_time']").val(start_time);
				$("#postHomepiblish").find("input[name='end_time']").val(end_time);
			}else{
				$("#postHomepiblish").find("select[name='type']").append(after_html);
			}
		}
	})
	/*跳转到管理页面*/
	$('.settingBtn').bind('click',function(){
		var _thisName = $(this).attr('data-name');
		if(_thisName == "server_id"){
			$(this).parent().attr('href',_GMmanageHref +"?name="+ _thisName);
		}else{
			$(this).parent().attr('href',_manageHref +"?name="+ _thisName);
		}
	})
})