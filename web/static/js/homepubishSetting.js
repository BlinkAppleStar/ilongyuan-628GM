$(function(){
	var setPage = window.location.href,_html,_title,
		_editHref = "homepublishEdit.html";
	if(setPage.indexOf("name=")<=0){
		setPage = '';
	}else{
		setPage = setPage.substr(setPage.indexOf("name=")+5,setPage.length);
	}
	switch(setPage){
		case "channel" : 
			_title = "渠道";
			break;
		case "version" :
			_title = "版本";
			break;
		default	:
			_title = "语言";
	}
	//更改页面title
	document.title = "发布公告"+_title+"管理";
	if(setPage == "server_id"){
		_html= "<thead>"+
				"<tr>"+
					"<th>LID</th>"+
					"<th>名字</th>"+
					"<th>IP</th>"+
					"<th>端口</th>"+
					"<th>是否激活</th>"+
					"<th>操作</th>"+
				"</tr>"+
			"</thead>";
		$.ajax({
			url: pageUrl + "/setting/game-server-list",
			type: "get",
			dataType: "json",
			data:{ajax:1},
			success: function(data){
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+data.data[i].lid+"</td>";
					_html+="<td>"+data.data[i].name+"</td>";
					_html+="<td>"+data.data[i].ip+"</td>";
					_html+="<td>"+data.data[i].port+"</td>";
					if(data.data[i].active == 1){
						data.data[i].active = "激活"
					}else{
						data.data[i].active = "未激活"
					}
					_html+="<td>"+data.data[i].active+"</td>";
					_html+='<td><a class="btn_href" target="_blank" href="javascript:;">'+
						   '<input class="js_edit searchBtn w50" data-id="'+data.data[i]._id.$id+'" type="button" name="" value="编辑"></a>'+
						   '<input class="js_delete searchBtn w50 ml20" data-id="'+data.data[i]._id.$id+'" type="button" name="" value="删除"></td>';
					_html += '</tr>';
				}			
				$('#pegeContentBox').html(_html);
			}
		})
	}else{
		_html= "<thead>"+
				"<tr>"+
					"<th>ID</th>"+
					"<th>名字</th>"+
					"<th>是否激活</th>"+
					"<th>操作</th>"+
				"</tr>"+
			"</thead>";
		$.ajax({
			url: pageUrl + "/setting/index",
			type: "get",
			dataType: "json",
			data:{ajax:1,table_name:setPage},
			success: function(data){
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+data.data[i]._id.$id+"</td>";
					_html+="<td>"+data.data[i].name+"</td>";
					if(data.data[i].active == 1){
						data.data[i].active = "是"
					}else{
						data.data[i].active = "否"
					}
					_html+="<td>"+data.data[i].active+"</td>";
					_html+='<td><a class="btn_href" target="_blank" href="javascript:;">'+
						   '<input class="js_edit searchBtn w50" data-id="'+data.data[i]._id.$id+'" type="button" name="" value="编辑"></a>'+
						   '<input class="js_delete searchBtn w50 ml20" data-id="'+data.data[i]._id.$id+'" type="button" name="" value="删除"></td>';
					_html += '</tr>';
				}
				$('#pegeContentBox').html(_html);
			}
		})
	}
	// 删除记录
	$('.js_delete').live('click',function(){
		var _thisId = $(this).attr('data-id');
		$.ajax({
			url: pageUrl + "/setting/delete",
			type: "get",
			dataType: "json",
			data:{ajax:1,table_name:setPage,id:_thisId},
			success: function(data){
				alert("成功删除！");
			},
			error: function(data){
				alert(data.msg);
			}
		})
		$(this).parents('tr').remove();
	})
	// 编辑记录
	$('.js_edit').live('click',function(){
		var _thisId = $(this).attr('data-id');
		if(setPage == "server_id"){ //当编辑区服时
			$(this).parent().attr('href',_editHref + "?setPage=game_server&id=" + _thisId);
		}else{//编辑其余信息时
			$(this).parent().attr('href',_editHref + "?setPage=" + setPage + "&id=" + _thisId);
		}
	})
	// 添加记录
	$('#addSetting').bind('click',function(){
		var _thisName = $(this).attr('data-name');
		if(setPage == "server_id"){ //当添加区服时
			$(this).parent().attr('href',_editHref + "?setPage=game_server");
		}else{//添加其余信息时
			$(this).parent().attr('href',_editHref + "?setPage=" + setPage);
		}
	})
})