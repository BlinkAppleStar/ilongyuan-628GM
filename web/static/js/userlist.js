$(function(){
	var userData = "";
	userfd();
	function userfd(){
		$("body").pageFn({
			_url:pageUrl+"/gamer/list",
			_data:userData,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>uid</th>"+
						"<th>渠道</th>"+
						"<th>渠道uid</th>"+
						"<th>昵称</th>"+
						"<th>区服</th>"+
						"<th>所属联盟</th>"+
						"<th>当前版本</th>"+
						"<th>累计充值金额</th>"+
						"<th>注册日期</th>"+
						"<th>最后登录日期</th>"+
						"<th>设备码</th>"+
						"<th>游戏信息</th>"+
						//"<th>订单信息</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+data.data[i]+"</td>";
					_html+="<td>渠道</td>";
					_html+="<td>渠道id</td>";
					_html+="<td>"+i+"</td>";
					_html+="<td>区服</td>";
					_html+="<td>所属联盟</td>";
					_html+="<td>当前版本</td>";
					_html+="<td>累计充值金额</td>";
					_html+="<td>注册日期</td>";
					_html+="<td>最后登录日期</td>";
					_html+="<td>设备码</td>";
					_html+="<td><a class='gameInfo' href='userdata.html?uid="+data.data[i]+"' target='_blank'>查看</a></td>";
					//_html+="<td><a class='gameInfo' href='#' target='_blank'>查看</a></td>";
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
	// 显示当前服务器状态
	$.ajax({
		url:pageUrl+"/setting/get-current-redis",
		data:"",
		dataType: "json",
		type:"get",
		success:function(data){
			$('#ip_addr').html(data.data.host);
			$('#port_id').html(data.data.port);
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