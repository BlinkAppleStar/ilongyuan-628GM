$(function(){
	var datas="token="+tokens;
	getInfoAjax(datas);
	function getInfoAjax(datas){
		$("body").pageFn({
			_state:false,
			_url: ajaxUrl+"/portal/eol/getRetentionData.do",
			_type:"post",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>时间</th>"+
						"<th>活跃用户</th>"+
						"<th>新增账号</th>"+
						"<th>新活比</th>"+
						"<th>次留</th>"+
						"<th>2留</th>"+
						"<th>3留</th>"+
						"<th>4留</th>"+
						"<th>5留</th>"+
						"<th>6留</th>"+
						"<th>7留</th>"+
						"<th>15留</th>"+
						"<th>30留</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+formatDate(data.data[i].date)+"</td>";
					_html+="<td>"+data.data[i].activeUserNum+"</td>";
					_html+="<td>"+data.data[i].addUserNum+"</td>";
					_html+="<td>"+data.data[i].addDivActiveRatio+"</td>";
					_html+="<td>"+data.data[i].userDay1Retention+"</td>";
					_html+="<td>"+data.data[i].userDay2Retention+"</td>";
					_html+="<td>"+data.data[i].userDay3Retention+"</td>";
					_html+="<td>"+data.data[i].userDay4Retention+"</td>";
					_html+="<td>"+data.data[i].userDay5Retention+"</td>";
					_html+="<td>"+data.data[i].userDay6Retention+"</td>";
					_html+="<td>"+data.data[i].userDay7Retention+"</td>";
					_html+="<td>"+data.data[i].userDay15Retention+"</td>";
					_html+="<td>"+data.data[i].userDay30Retention+"</td>";
					_html += '</tr>';
				}
				$(this._contentBox).html(_html);
				//表格排序
				$.sortTable.sort('pegeContentBox',0);
			},
			_contentBox:"#pegeContentBox",
			_btnBox:"#pageBox",
			_pageNum:"5",
			_page:"1",
			_page_size:allPageNum,
			_pageSt:"none"
		});
	}
	$('#search').click(function(){
		var resetDevice = $('#resetDevice').prop('checked');
		if(resetDevice){resetDevice = 1}else{resetDevice = 0}
		datas = $("#addSearchBox").serialize()+"&isDistinctDevice="+resetDevice+"&token="+tokens;
		getInfoAjax(datas);
	})
})