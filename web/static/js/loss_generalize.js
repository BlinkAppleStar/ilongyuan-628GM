$(function(){
	var datas="token="+tokens;
	var urls = ajaxUrl+"/portal/eol/getLossOverViewData.do";
	var btnType = '';
	getInfoAjax(datas,urls);
	function getInfoAjax(datas,urls){
		$("body").pageFn({
			_url: urls,
			_type:"post",
			_data:datas,
			_success:function(data){
				var _html= '',_popHtml = '',_popListHtmlBac = '',_popListHtml_0 = '',
					_popListHtml_1 = '',_popListHtml_2 = '',_popListHtml_3 = '',
					_popListHtml_4 = '',_popListHtml_5 = '',_popListHtml_5 = '',
					_popListHtml_7 = '';
					_html= "<thead>"+
						"<tr>"+
							"<th>时间</th>"+
							"<th>新增激活设备</th>"+
							"<th>新增账号</th>"+
							"<th>新手引导开始</th>"+
							"<th>新手引导结束</th>"+
							"<th>开始第一场战斗</th>"+
							"<th>开始第二场战斗</th>"+
							"<th>开始第三场战斗</th>"+
						"</tr>"+
					"</thead>";
					//弹窗显示数据html
					_popHtml= "<thead>"+
						"<tr>"+
							"<th>时间</th>"+
							"<th>1min以下</th>"+
							"<th>1min~3min</th>"+
							"<th>3min~5min</th>"+
							"<th>5min~10min</th>"+
							"<th>10min~20min</th>"+
							"<th>20min~1hour</th>"+
							"<th>1hour~4hour</th>"+
							"<th>4hour~10hour</th>"+
							"<th>10hour~24hour</th>"+
							"<th>24hour+</th>"+
						"</tr>"+
					"</thead>";
					for(i in data.data){
						_html+= '<tr>';
						_html+="<td>"+formatDate(data.data[i].dt)+"</td>";
						_html+="<td>"+data.data[i].deviceActiveAddUserNum+"</td>";
						_html+="<td>"+data.data[i].addUserNum+"</td>";
						_html+="<td>"+data.data[i].tutorialBeginUserNum+"</td>";
						_html+="<td>"+data.data[i].tutorialEndUserNum+"</td>";
						_html+="<td><span class='combatStart1'>"+data.data[i].combatStart1+"</span></td>";
						_html+="<td>"+data.data[i].combatStart2+"</td>";
						_html+="<td>"+data.data[i].combatStart3+"</td>";
						_html+= '</tr>';
						//弹窗显示数据html
						_popHtml+= '<tr>';
						_popHtml+="<td>"+formatDate(data.data[i].dt)+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval1+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval3+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval5+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval10+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval20+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval1hour+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval4hour+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval10hour+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatInterval24hour+"</td>";
						_popHtml+="<td>"+data.data[i].tutorialToCombatIntervalMoreThan24hour+"</td>";
						_popHtml+= '</tr>';
					}
					
				$(this._contentBox).html(_html);
				$.sortTable.sort('pegeContentBox',0);
				if(btnType == "Profile" || btnType == ""){
					$('#popTableCont').html(_popHtml);
					$.sortTable.sort('popTableCont',0);
				}
				//查看概况详情点击事件
				$('#pegeContentBox .combatStart1').live('click',function(){
					var idx = $(this).parents('tr').index();
					$('#popTableCont').show().siblings('table').hide();
					$('#popTableCont tbody tr').eq(idx).show().siblings().hide();
					$('#popTableBox').show();
				})
			},
			_contentBox:"#pegeContentBox",
			_btnBox:"#pageBox",
			_pageNum:"5",
			_page:"0",
			_page_size:allPageNum,
			_pageSt:"none"
		});
	}
	//查看概况事件
	$('#viewProfile').click(function(){
		$('#popTableContent').html('');
		datas = $("#addSearchBox").serialize()+"&token="+tokens;
		urls = ajaxUrl+"/portal/eol/getLossOverViewData.do";
		btnType = $(this).attr('data-type');
		getInfoAjax(datas,urls);
	})
})