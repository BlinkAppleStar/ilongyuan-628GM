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
				switch (btnType) {
					case 'Profile' : //查看概况
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
						break;
					case 'Novice' : //新手引导流失数据
						_html= "<thead>"+
							"<tr>"+
								"<th>时间</th>"+
								"<th>新增激活设备</th>"+
								"<th>新增账号</th>"+
								"<th>step1</th>"+
								"<th>step2</th>"+
								"<th>step3</th>"+
								"<th>step3_1</th>"+
								"<th>step3_2</th>"+
								"<th>step3_3</th>"+
								"<th>step4</th>"+
								"<th>step4_1</th>"+
								"<th>step4_2</th>"+
								"<th>step4_9</th>"+
								"<th>step5</th>"+
								"<th>step5_1</th>"+
								"<th>step5_2</th>"+
								"<th>step5_10</th>"+
								"<th>step6</th>"+
								"<th>step6_4</th>"+
								"<th>step6_5</th>"+
								"<th>step6_6</th>"+
								"<th>step6_7</th>"+
								"<th>step7</th>"+
								"<th>step7_8</th>"+
								"<th>step8</th>"+
								"<th>step8_11</th>"+
								"<th>step9</th>"+
							"</tr>"+
						"</thead>";
						for(i in data.data){
							_html += '<tr>';
							_html+="<td>"+formatDate(data.data[i].dt)+"</td>";
							_html+="<td>"+data.data[i].deviceActiveAddUserNum+"</td>";
							_html+="<td>"+data.data[i].addUserNum+"</td>";
							_html+="<td>"+data.data[i].talkDesc1+"</td>";
							_html+="<td>"+data.data[i].talkDesc2+"</td>";
							_html+="<td>"+data.data[i].talkDesc3+"</td>";
							_html+="<td>"+data.data[i].talkDesc3_1+"</td>";
							_html+="<td>"+data.data[i].talkDesc3_2+"</td>";
							_html+="<td>"+data.data[i].talkDesc3_3+"</td>";
							_html+="<td>"+data.data[i].talkDesc4+"</td>";
							_html+="<td>"+data.data[i].talkDesc4_1+"</td>";
							_html+="<td>"+data.data[i].talkDesc4_2+"</td>";
							_html+="<td>"+data.data[i].talkDesc4_9+"</td>";
							_html+="<td>"+data.data[i].talkDesc5+"</td>";
							_html+="<td>"+data.data[i].talkDesc5_1+"</td>";
							_html+="<td>"+data.data[i].talkDesc5_2+"</td>";
							_html+="<td>"+data.data[i].talkDesc5_10+"</td>";
							_html+="<td>"+data.data[i].talkDesc6+"</td>";
							_html+="<td>"+data.data[i].talkDesc6_4+"</td>";
							_html+="<td>"+data.data[i].talkDesc6_5+"</td>";
							_html+="<td>"+data.data[i].talkDesc6_6+"</td>";
							_html+="<td>"+data.data[i].talkDesc6_7+"</td>";
							_html+="<td>"+data.data[i].talkDesc7+"</td>";
							_html+="<td>"+data.data[i].talkDesc7_8+"</td>";
							_html+="<td>"+data.data[i].talkDesc8+"</td>";
							_html+="<td>"+data.data[i].talkDesc8_11+"</td>";
							_html+="<td>"+data.data[i].talkDesc9+"</td>";
							_html += '</tr>';
						}
						break;
					case 'LoseData' : //查看长期流失与回流
						_html= "<thead>"+
							"<tr>"+
								"<th>时间</th>"+
								"<th>3留流失用户数量</th>"+
								"<th>3留流失用户回流数量</th>"+
								"<th>7留流失用户数量</th>"+
								"<th>7留流失用户回流数量</th>"+
								"<th>15留流失用户数量</th>"+
								"<th>15留流失用户回流数量</th>"+
								"<th>30留流失用户数量</th>"+
								"<th>30留流失用户回流数量</th>"+
							"</tr>"+
						"</thead>";
						//弹窗显示数据html表头
						_popListHtmlBac = "<tr>"+
									"<th>主城等级</th>"+
									"<th>1级</th>"+
									"<th>2级</th>"+
									"<th>3级</th>"+
									"<th>4级</th>"+
									"<th>5级</th>"+
									"<th>6级</th>"+
									"<th>7级</th>"+
									"<th>8级</th>"+
									"<th>9级</th>"+
									"<th>10级</th>"+
									"<th>11级~15级</th>"+
									"<th>16级~20级</th>"+
									"<th>21级~25级</th>"+
									"<th>26级~30级</th>"+
									"<th>31级~35级</th>"+
									"<th>35级+</th>"+
								"</tr>"+
							"</thead>";
						_popListHtml_0 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>3留流失用户数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_1 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>3留流失用户回流数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_2 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>7留流失用户数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_3 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>7留流失用户回流数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_4 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>15留流失用户数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_5 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>15留流失用户回流数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_6 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>30留流失用户数量</th>"+
								"</tr>" + _popListHtmlBac;
						_popListHtml_7 = "<thead>"+
								"<tr>"+
									"<th colspan='17'>30留流失用户回流数量</th>"+
								"</tr>" + _popListHtmlBac;
						
						for(i in data.data){
							//长期流失用户与回流表格数据
							_html += '<tr>';
							_html+="<td>"+formatDate(data.data[i].dt)+"</td>";
							_html+="<td><span class='lose_data st01'>"+data.data[i].threeDayLossUser+"</span></td>";
							_html+="<td><span class='lose_data st02'>"+data.data[i].threeDayRefluxUser+"</span></td>";
							_html+="<td><span class='lose_data st03'>"+data.data[i].sevenDayLossUser+"</span></td>";
							_html+="<td><span class='lose_data st04'>"+data.data[i].sevenDayRefluxUser+"</span></td>";
							_html+="<td><span class='lose_data st05'>"+data.data[i].fifteenDayLossUser+"</span></td>";
							_html+="<td><span class='lose_data st06'>"+data.data[i].fifteenDayRefluxUser+"</span></td>";
							_html+="<td><span class='lose_data st07'>"+data.data[i].thirtyDayLossUser+"</span></td>";
							_html+="<td><span class='lose_data st08'>"+data.data[i].thirtyDayRefluxUser+"</span></td>";
							_html += '</tr>';
							//3留流失用户数量html
							_popListHtml_0+= '<tr>';
							_popListHtml_0+="<td>数量</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel1+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel2+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel3+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel4+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel5+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel6+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel7+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel8+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel9+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel10+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel11+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel16+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel21+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel26+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevel31+"</td>";
							_popListHtml_0+="<td>"+data.data[i].threeDayLossUserLevelMoreThan35+"</td>";
							_popListHtml_0+= '</tr>';
							//3留流失用户回流数量html
							_popListHtml_1+= '<tr>';
							_popListHtml_1+="<td>数量</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel1+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel2+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel3+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel4+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel5+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel6+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel7+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel8+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel9+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel10+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel11+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel16+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel21+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel26+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevel31+"</td>";
							_popListHtml_1+="<td>"+data.data[i].threeDayRefluxUserLevelMoreThan35+"</td>";
							_popListHtml_1+= '</tr>';
							//7留流失用户数量html
							_popListHtml_2+= '<tr>';
							_popListHtml_2+="<td>数量</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel1+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel2+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel3+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel4+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel5+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel6+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel7+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel8+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel9+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel10+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel11+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel16+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel21+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel26+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevel31+"</td>";
							_popListHtml_2+="<td>"+data.data[i].sevenDayLossUserLevelMoreThan35+"</td>";
							_popListHtml_2+= '</tr>';
							//7留流失用户回流数量html
							_popListHtml_3+= '<tr>';
							_popListHtml_3+="<td>数量</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel1+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel2+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel3+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel4+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel5+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel6+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel7+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel8+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel9+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel10+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel11+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel16+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel21+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel26+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevel31+"</td>";
							_popListHtml_3+="<td>"+data.data[i].sevenDayRefluxUserLevelMoreThan35+"</td>";
							_popListHtml_3+= '</tr>';
							//15留流失用户数量html
							_popListHtml_4+= '<tr>';
							_popListHtml_4+="<td>数量</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel1+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel2+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel3+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel4+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel5+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel6+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel7+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel8+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel9+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel10+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel11+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel16+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel21+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel26+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevel31+"</td>";
							_popListHtml_4+="<td>"+data.data[i].fifteenDayLossUserLevelMoreThan35+"</td>";
							_popListHtml_4+= '</tr>';
							//15留流失用户回流数量html
							_popListHtml_5+= '<tr>';
							_popListHtml_5+="<td>数量</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel1+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel2+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel3+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel4+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel5+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel6+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel7+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel8+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel9+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel10+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel11+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel16+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel21+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel26+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevel31+"</td>";
							_popListHtml_5+="<td>"+data.data[i].fifteenDayRefluxUserLevelMoreThan35+"</td>";
							_popListHtml_5+= '</tr>';
							//30留流失用户数量html
							_popListHtml_6+= '<tr>';
							_popListHtml_6+="<td>数量</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel1+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel2+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel3+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel4+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel5+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel6+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel7+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel8+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel9+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel10+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel11+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel16+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel21+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel26+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevel31+"</td>";
							_popListHtml_6+="<td>"+data.data[i].thirtyDayLossUserLevelMoreThan35+"</td>";
							_popListHtml_6+= '</tr>';
							//30留流失用户回流数量html
							_popListHtml_7+= '<tr>';
							_popListHtml_7+="<td>数量</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel1+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel2+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel3+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel4+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel5+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel6+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel7+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel8+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel9+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel10+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel11+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel16+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel21+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel26+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevel31+"</td>";
							_popListHtml_7+="<td>"+data.data[i].thirtyDayRefluxUserLevelMoreThan35+"</td>";
							_popListHtml_7+= '</tr>';

						}
						//渲染表格数据
						//3留流失用户数量
						$('#popTableContent0').html(_popListHtml_0);
						$.sortTable.sort('popTableContent0',0);
						//3留流失用户回流数量
						$('#popTableContent1').html(_popListHtml_1);
						$.sortTable.sort('popTableContent1',0);
						//7留流失用户数量
						$('#popTableContent2').html(_popListHtml_2);
						$.sortTable.sort('popTableContent2',0);
						//7留流失用户回流数量
						$('#popTableContent3').html(_popListHtml_3);
						$.sortTable.sort('popTableContent3',0);
						//15留流失用户数量
						$('#popTableContent4').html(_popListHtml_4);
						$.sortTable.sort('popTableContent4',0);
						//15留流失用户回流数量
						$('#popTableContent5').html(_popListHtml_5);
						$.sortTable.sort('popTableContent5',0);
						//30留流失用户数量
						$('#popTableContent6').html(_popListHtml_6);
						$.sortTable.sort('popTableContent6',0);
						//30留流失用户回流数量
						$('#popTableContent7').html(_popListHtml_7);
						$.sortTable.sort('popTableContent7',0);
						
						//查看长期流失与回流详情事件
						$('#pegeContentBox .lose_data.st01').live('click',function(){ //3留流失用户数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent0 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent0').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st02').live('click',function(){ //3留流失用户回流数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent1 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent1').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st03').live('click',function(){ //7留流失用户数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent2 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent2').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st04').live('click',function(){ //7留流失用户回流数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent3 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent3').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st05').live('click',function(){ //15留流失用户数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent4 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent4').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st06').live('click',function(){ //15留流失用户回流数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent5 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent5').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st07').live('click',function(){ //30留流失用户数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent6 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent6').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						$('#pegeContentBox .lose_data.st08').live('click',function(){ //30留流失用户回流数量
							var par_idx = $(this).parent().parent().index(); //竖向表格行index值
							$('#popTableContent7 tbody tr').eq(par_idx).show().siblings().hide();
							$('#popTableContent7').show().siblings('table').hide();
							$('#popTableBox').show();
						})
						break;
					default : //查看概况
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
							_html += '<tr>';
							_html+="<td>"+formatDate(data.data[i].dt)+"</td>";
							_html+="<td>"+data.data[i].deviceActiveAddUserNum+"</td>";
							_html+="<td>"+data.data[i].addUserNum+"</td>";
							_html+="<td>"+data.data[i].tutorialBeginUserNum+"</td>";
							_html+="<td>"+data.data[i].tutorialEndUserNum+"</td>";
							_html+="<td><span class='combatStart1'>"+data.data[i].combatStart1+"</span></td>";
							_html+="<td>"+data.data[i].combatStart2+"</td>";
							_html+="<td>"+data.data[i].combatStart3+"</td>";
							_html += '</tr>';
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
						break;
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
	//
	$('#popTableBox .ZZC').click(function(){
		$(this).parent().hide();
	})
	//查看概况事件
	$('#viewProfile').click(function(){
		$('#popTableContent').html('');
		datas = $("#addSearchBox").serialize()+"&token="+tokens;
		urls = ajaxUrl+"/portal/eol/getLossOverViewData.do";
		btnType = $(this).attr('data-type');
		getInfoAjax(datas,urls);
	})
	//查看新手引导流失数据
	$('#viewNovice').click(function(){
		$('#popTableContent').html('');
		datas = $("#addSearchBox").serialize()+"&token="+tokens;
		urls = ajaxUrl+"/portal/eol/getLossGuideDistributeData.do";
		btnType = $(this).attr('data-type');
		getInfoAjax(datas,urls);
	})
	//查看长期流失与回流
	$('#viewLoseData').click(function(){
		$('#popTableContent').html('');
		datas = $("#addSearchBox").serialize()+"&token="+tokens;
		urls = ajaxUrl+"/portal/eol/getLossAndRelossData.do";
		btnType = $(this).attr('data-type');
		getInfoAjax(datas,urls);
	})
	//点击切换按钮颜色
	$('.searchBtn').click(function(){
		$(this).addClass('blue').siblings().removeClass('blue');
	})
})