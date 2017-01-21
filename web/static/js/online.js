$(function(){
	var datas="token="+tokens;
	getInfoAjax(datas);
	function getInfoAjax(datas){
		$("body").pageFn({
			_state:false,
			_url: ajaxUrl+"/portal/eol/getOnlineTimeData.do",
			_type:"post",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>时间</th>"+
						"<th>DAU</th>"+
						"<th>平均在线时长</th>"+
						"<th>0s~30s</th>"+
						"<th>1min~3min</th>"+
						"<th>3min~10min</th>"+
						"<th>10min~30min</th>"+
						"<th>30min~60min</th>"+
						"<th>60min~120min</th>"+
						"<th>120min~240min</th>"+
						"<th>240min+</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+formatDate(data.data[i].date)+"</td>";
					_html+="<td>"+data.data[i].dau+"</td>";
					_html+="<td>"+data.data[i].avgOnlineTime+"</td>";
					_html+="<td>"+data.data[i].online0sTo30s+"</td>";
					_html+="<td>"+data.data[i].online60sTo3min+"</td>";
					_html+="<td>"+data.data[i].online3minTo10min+"</td>";
					_html+="<td>"+data.data[i].online10minTo30min+"</td>";
					_html+="<td>"+data.data[i].online30minTo60min+"</td>";
					_html+="<td>"+data.data[i].online1hTo2h+"</td>";
					_html+="<td>"+data.data[i].online2hTo4h+"</td>";
					_html+="<td>"+data.data[i].onlineMore4h+"</td>";
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