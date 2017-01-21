$(function(){
	var setPage = "game_server",
		_editHref = "gameuserEdit.html";
	//导量服切换
	function ajax_input_server(lid){
	    $.get( pageUrl + '/setting/set-import-server',{
	            lid:lid
	        },
	        function(ret){
	            alert(ret.msg);
	        },
	        'json'
	    );
	}
	$.ajax({
		url: pageUrl + "/setting/game-server-list",
		type: "get",
		dataType: "json",
		data:{ajax:1},
		success: function(data){
			var _html= "<thead>"+
						"<tr>"+
							"<th>LID</th>"+
							"<th>名字</th>"+
							"<th>IP</th>"+
							"<th>端口</th>"+
							"<th>是否导量服</th>"+
							"<th>是否激活</th>"+
							"<th>操作</th>"+
						"</tr>"+
					"</thead>";
			for(i in data.data){
				_html += '<tr>';
				_html+="<td>"+data.data[i].lid+"</td>";
				_html+="<td>"+data.data[i].name+"</td>";
				_html+="<td>"+data.data[i].ip+"</td>";
				_html+="<td>"+data.data[i].port+"</td>";
				if(data.data[i].input == 1){
					data.data[i].input = '<input type="radio" checked="checked" name="import_server" data-lid="'+ data.data[i].lid +'">';
				}else{
					data.data[i].input = '<input type="radio" name="import_server" data-lid="'+ data.data[i].lid +'">';
				}
				_html+="<td>"+data.data[i].input+"</td>";
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
			$('input[name="import_server"]').on('change',function(){
				var lid = $(this).attr('data-lid');
				 $.get( pageUrl + '/setting/set-import-server',{
			            lid:lid
			        },
			        function(ret){
			            alert(ret.msg);
			        },
			        'json'
			    );
			})
		}
	})

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
		$(this).parent().attr('href',_editHref  + "?setPage=" + setPage + "&id=" + _thisId);
	})
	// 添加记录
	$('#addSetting').bind('click',function(){
		$(this).parent().attr('href',_editHref  + "?setPage=" + setPage);
	})
})