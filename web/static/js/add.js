$(function(){ 
	var datas="token="+tokens;
	getInfoAjax(datas);
	function getInfoAjax(datas){
		$("body").pageFn({
			_url: ajaxUrl+"/portal/eol/getAddActiveData.do",
			_type:"post",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>时间</th>"+
						"<th>新增注册设备</th>"+
						"<th>新增账号</th>"+
						"<th>新增设备转化率</th>"+
						"<th>活跃用户</th>"+
						"<th>周活跃用户</th>"+
						"<th>月活跃用户</th>"+
						"<th>ARPU</th>"+
						"<th>ARPPU</th>"+
						"<th>ACU</th>"+
						"<th>PCU</th>"+
						"<th>DAU/MAU</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+formatDate(data.data[i].date)+"</td>";
					_html+="<td>"+data.data[i].addDeviceNum+"</td>";
					_html+="<td>"+data.data[i].addUserNum+"</td>";
					_html+="<td>"+data.data[i].addDeviceRate+"</td>";
					_html+="<td>"+data.data[i].activeUserNum+"</td>";
					_html+="<td>"+data.data[i].weekActiveUserNum+"</td>";
					_html+="<td>"+data.data[i].monthActiveUserNum+"</td>";
					_html+="<td>"+data.data[i].arpu+"</td>";
					_html+="<td>"+data.data[i].arppu+"</td>";
					_html+="<td>"+data.data[i].acu+"</td>";
					_html+="<td>"+data.data[i].pcu+"</td>";
					_html+="<td>"+data.data[i].dauDivMauRate+"</td>";
					_html += '</tr>';
				}
				$(this._contentBox).html(_html);
				//表格排序
				$.sortTable.sort('pegeContentBox',0);
			},
			_contentBox:"#pegeContentBox",
			_btnBox:"#pageBox",
			_pageNum:"5",
			_page:"0",
			_page_size:allPageNum,
			_pageSt:"none"
		});
	}
	//条件搜索事件
	$('#search').click(function(){
		datas = $("#addSearchBox").serialize()+"&token="+tokens;
		getInfoAjax(datas);
	})
})