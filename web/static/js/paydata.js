$(function(){
	var datas="token="+tokens;
	getInfoAjax(datas);
	function getInfoAjax(datas){
		$("body").pageFn({
			_url: ajaxUrl+"/portal/eol/getPayData.do",
			_type:"post",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>时间</th>"+
						"<th>新增账号</th>"+
						"<th>活跃用户</th>"+
						"<th>付费用户</th>"+
						"<th>新增付费用户</th>"+
						"<th>新增付费率</th>"+
						"<th>活跃付费用户</th>"+
						"<th>活跃付费率</th>"+
						"<th>首充用户</th>"+
						"<th>付费金额</th>"+
						"<th>新增付费金额</th>"+
						"<th>总ARPU</th>"+
						"<th>新增付费ARPU</th>"+
						"<th>活跃付费ARPU</th>"+
						"<th>总ARPPU</th>"+
						"<th>新增付费ARPPU</th>"+
						"<th>活跃付费ARPPU</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+formatDate(data.data[i].date)+"</td>";
					_html+="<td>"+data.data[i].addUserNum+"</td>";
					_html+="<td>"+data.data[i].activeUserNum+"</td>";
					_html+="<td>"+data.data[i].payUserNum+"</td>";
					_html+="<td>"+data.data[i].addPayUserNum+"</td>";
					_html+="<td>"+data.data[i].addPayRatio+"</td>";
					_html+="<td>"+data.data[i].activePayUserNum+"</td>";
					_html+="<td>"+data.data[i].activePayRatio+"</td>";
					_html+="<td>"+data.data[i].firstPayUserNum+"</td>";
					_html+="<td>"+data.data[i].payMoney+"</td>";
					_html+="<td>"+data.data[i].addPayMoney+"</td>";
					_html+="<td>"+data.data[i].totalArpu+"</td>";
					_html+="<td>"+data.data[i].addPayArpu+"</td>";
					_html+="<td>"+data.data[i].activePayArpu+"</td>";
					_html+="<td>"+data.data[i].totalArppu+"</td>";
					_html+="<td>"+data.data[i].addPayArppu+"</td>";
					_html+="<td>"+data.data[i].activePayArppu+"</td>";
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