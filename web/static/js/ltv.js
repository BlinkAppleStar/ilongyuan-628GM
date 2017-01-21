$(function(){
	var datas="token="+tokens;
	getInfoAjax(datas);
	function getInfoAjax(datas){
		$("body").pageFn({
			_url: ajaxUrl+"/portal/eol/getLtvStatData.do",
			_type:"post",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>时间</th>"+
						"<th>1日LTV</th>"+
						"<th>2日LTV</th>"+
						"<th>3日LTV</th>"+
						"<th>4日LTV</th>"+
						"<th>5日LTV</th>"+
						"<th>6日LTV</th>"+
						"<th>7日LTV</th>"+
						"<th>14日LTV</th>"+
						"<th>30日LTV</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data){
					_html += '<tr>';
					_html+="<td>"+formatDate(data.data[i].date)+"</td>";
					_html+="<td>"+data.data[i].day1Ltv+"</td>";
					_html+="<td>"+data.data[i].day2Ltv+"</td>";
					_html+="<td>"+data.data[i].day3Ltv+"</td>";
					_html+="<td>"+data.data[i].day4Ltv+"</td>";
					_html+="<td>"+data.data[i].day5Ltv+"</td>";
					_html+="<td>"+data.data[i].day6Ltv+"</td>";
					_html+="<td>"+data.data[i].day7Ltv+"</td>";
					_html+="<td>"+data.data[i].day14Ltv+"</td>";
					_html+="<td>"+data.data[i].day30Ltv+"</td>";
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
	$('#search').click(function(){
		var resetDevice = $('#resetDevice').prop('checked');
		if(resetDevice){resetDevice = 1}else{resetDevice = 0}
		datas = $("#addSearchBox").serialize()+"&isDistinctDevice="+resetDevice+"&token="+tokens;
		getInfoAjax(datas);
	})
})