$(function(){
	var userData = "";
	function userfd(){
		$("body").pageFn({
			_state:false,
			_url:pageUrl+"/gamer/search",
			_data:userData,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>玩家ID</th>"+
						"<th>昵称</th>"+
						"<th>渠道</th>"+
						"<th>区服LID</th>"+
						"<th>区服名称</th>"+
						"<th>所属联盟ID</th>"+
						"<th>所属联盟名字</th>"+
						"<th>累计充值金额</th>"+
						"<th>注册时间</th>"+
						"<th>最后登录时间</th>"+
						"<th>游戏信息</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+data.data[i].id+"</td>";
					_html+="<td>"+data.data[i].name+"</td>";
					_html+="<td>"+data.data[i].channel+"</td>";
					_html+="<td>"+data.data[i].lid+"</td>";
					_html+="<td>"+data.data[i].server+"</td>";
					_html+="<td>"+data.data[i].league_id+"</td>";
					_html+="<td>"+data.data[i].league_name+"</td>";
					_html+="<td>"+data.data[i].total_charged+"</td>";
					_html+="<td>"+data.data[i].regist_time_sec+"</td>";
					_html+="<td>"+data.data[i].last_login_sec+"</td>";
					_html+="<td><a class='gameInfo' href='userdata.html?id="+data.data[i].id+"' target='_blank'>查看</a></td>";
					_html += '</tr>';
				}
				$(this._contentBox).html(_html);
			},
			_contentBox:"#pegeContentBox",
			_btnBox:"#pageBox",
			_pageNum:"5",
			_page:"1",
			_page_size:allPageNum,
			_pageSt:"none"
		});
	}
	/*获取区服信息*/ 
	$.ajax({
		url: pageUrl+"/setting/game-server-list",
		data: {ajax:"1",table_name:"channel"},
		dataType: "json",
		type: "get",
		success:function(data){
			var html = "<option></option>";
			for(var i in data.data){
				html += "<option value='"+i+"'>"+ data.data[i].name +"</option>";
			}
			$('select[name="server_id"]').append(html);
		}
	})
	// 条件搜索
	$("#userSearch").bind('click',function(){
		userData = $("#userSearchBox").serialize();
		userfd();
	});
	// 区服切换
	$('select[name="server_id"]').bind('change',function(){
		var areaVal = $(this).val();
		$.ajax({
			url: pageUrl+"/setting/redis-server",
			data: {ajax:"1",server_id:areaVal},
			dataType: "json",
			type: "get",
			success:function(data){
				location.reload(true);
			},
			error: function(data){
				alert(data.msg);
			}
		})
	});
});