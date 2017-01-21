$(function(){
	var userId = window.location.href,listType = "",_html,pageNums="300",ajaxUrl="/gamer/detail",ajaxData,htmlBox="";
	userId = userId.substr(userId.indexOf("id=")+3,userId.length);
	listType = $("#styleListBtn li.checked").attr("data-type");
	$("#styleListBtn li").bind('click',function(){
		$(this).addClass("checked").siblings().removeClass("checked");
		listType = $("#styleListBtn li.checked").attr("data-type");
		if(listType){
			ajaxUrl="/gamer/ajax-sub-list";
			pageNums = allPageNum;
			ajaxData="id="+userId+"&type="+listType;
			listFn(listType);
		}else{
			$("#pegeContentBox").html(htmlBox);
			$("#pageBox").addClass("none");
			dataAdd();
		}
	})
	ajaxData="id="+userId+"&ajax=1";
	listFn(listType);
	function listFn(listType){
		$("body").pageFn({
			_url:pageUrl+""+ajaxUrl,
			_data:ajaxData,
			_success:function(data){
				switch (listType)
				{
					case ""://资产信息
						$("#user_title_id").append(data.data.gamer.values[1])
						$("#user_title_money").append("暂无数据")
						$("#user_title_name").append(data.data.gamer.values[2])
						$("#user_title_num").append(data.data.gamer.values[24][3])
						$("#user_title_cd").append("暂无数据")
						$("#user_title_dj").append(data.data.gamer.values[3])
						$("#user_title_dq").append("暂无数据")
						if(data.data.gamer.values[21] == null){
							$("#user_title_lm").append("无")
							$("#user_title_jj").append("无")
						}else{
							$("#user_title_lm").append(data.data.gamer.values[21].values[1])
							$("#user_title_jj").append(data.data.gamer.values[21].values[2])
						}
                        $("#user_title_power").append(data.data.gamer.values[34])
						$("#user_title_yk").append("暂无数据")
						_html = "<thead>"+
						"<tr>"+
							"<th>物品/资源ID</th>"+
							"<th>名称</th>"+
							"<th>数量</th>"+
							"<th><input class='searchBtn' type='button' value='保存修改' id='zcSaveBtn'/></th>"+
						"</tr>"+
						"</thead>";
						for(i in data.data.gamer.values[24]){
							if (i != 0) {
								_html += '<tr>';
								_html+="<td>"+i+"</td>";
								_html+="<td>"+data.data.name_list[i]+"</td>";
								_html+="<td><input class='countBox' type='text' value='"+data.data.gamer.values[24][i]+"'></td>";
								_html+="<td></td>";
								_html += '</tr>';

							}
						}
						htmlBox = _html;
						break;

					case "build"://建筑信息
						_html= "<thead>"+
						"<tr class='itemBox'><td colspan='14'><span class='search_ins oth'>建筑等级<input class='search_field' type='number' id='buildNum'></span><span><input class='searchBtn BFirst'  type='button' value='重置' id='buildNumBtn' /></span></td><td></td></tr><tr>"+
							"<th>ID</th>"+
							"<th>LID</th>"+
							"<th>名称</th>"+
							"<th>等级</th>"+
							"<th>HP</th>"+
							"<th>STATE</th>"+
							"<th>升级完成时间<br />DONE_TIME</th>"+
							"<th>建造队列序号<br />BUILD_QUEUE_INDEX</th>"+
							//"<th>HARVEST_BEGIN_TIME</th>"+
							//"<th>HARVEST_BEGIN_BID</th>"+
							"<th>量产建筑序号<br />SUB_INDEX</th>"+
							"<th>被帮助次数<br />BEHELPED_TIMES</th>"+
							"<th>是否请求过帮助<br />HELP_ASKED</th>"+
						"</tr>"+
						"</thead>";
						for(i in data.data.list){
							_html += '<tr>';
							_html+="<td>"+data.data.list[i].values[1]+"</td>";
							_html+="<td>"+data.data.list[i].values[2]+"</td>";
							_html+="<td>"+data.data.name_list[data.data.list[i].values[1]]+"</td>";
							_html+="<td>"+data.data.list[i].values[3]+"</td>";
							_html+="<td>"+data.data.list[i].values[4]+"</td>";
							_html+="<td>"+data.data.list[i].values[5]+"</td>";
							_html+="<td>"+(data.data.list[i].values[6] ? getLocalTime(data.data.list[i].values[6]) : '已完成') +"</td>";
							_html+="<td>"+data.data.list[i].values[7]+"</td>";
							//_html+="<td>"+data.data.list[i].values[8]+"</td>";
							//_html+="<td>"+data.data.list[i].values[9]+"</td>";
							_html+="<td>"+data.data.list[i].values[10]+"</td>";
							_html+="<td>"+data.data.list[i].values[11]+"</td>";
							_html+="<td>"+data.data.list[i].values[12]+"</td>";
							_html += '</tr>';
						}
						break;

					case "soldier"://士兵信息
						_html= "<thead>"+
						"<tr>"+
							"<th>ID</th>"+
							"<th>名称</th>"+
							"<th>数量</th>"+
							"<th>正在训练数量</th>"+
							"<th>训练完成时间</th>"+
							"<th>正在治疗</th>"+
							"<th>治疗完成时间</th>"+
							"<th>可治疗数量</th>"+
							"<th>阵亡数量</th>"+
							"<th>外派数量</th>"+
							"<th>取自城市</th>"+
						"</tr>"+
						"</thead>";
						for(i in data.data.list){
							_html += '<tr>';
							_html+="<td>"+data.data.list[i].values[1]+"</td>";
							_html+="<td>"+data.data.name_list[data.data.list[i].values[1]]+"</td>";
							_html+="<td>"+data.data.list[i].values[3]+"</td>";
							_html+="<td>"+data.data.list[i].values[4]+"</td>";
							_html+="<td>"+(data.data.list[i].values[5] ? getLocalTime(data.data.list[i].values[5]) : '无') +"</td>";
							_html+="<td>"+data.data.list[i].values[6]+"</td>";
							_html+="<td>"+(data.data.list[i].values[7] ? getLocalTime(data.data.list[i].values[7]) : '无')+"</td>";
							_html+="<td>"+data.data.list[i].values[8]+"</td>";
							_html+="<td>"+data.data.list[i].values[9]+"</td>";
							_html+="<td>"+data.data.list[i].values[14]+"</td>";
							_html+="<td>暂无数据</td>";
							_html += '</tr>';
						}
						break;

					case "tech"://科技信息
						_html= "<thead>"+
						"<tr>"+
							"<th>ID</th>"+
							"<th>名称</th>"+
							"<th>等级</th>"+
							//"<th>是否正在升级</th>"+
							"<th>升级完成时间(LEVELUP_TIME)</th>"+
						"</tr>"+
						"</thead>";
						for(i in data.data.list){
							_html += '<tr>';
							_html+="<td>"+data.data.list[i].values[1]+"</td>";
							_html+="<td>"+data.data.name_list[data.data.list[i].values[1]]+"</td>";
							_html+="<td>" +String(data.data.list[i].values[1]).substr(-3,3)+ "</td>";
							//_html+="<td>"+data.data.list[i].values[3]+"</td>";
							_html+="<td>"+(data.data.list[i].values[2] ? getLocalTime(data.data.list[i].values[2]) : '已升级')+"</td>";
							_html += '</tr>';
						}
						break;

					case "item"://道具信息
						_html= "<thead>"+
						"<tr class='itemBox'><td colspan='3'><span class='search_ins oth'>新增道具ID<input class='search_field' type='text' id='item_id'></span><span class='search_ins'>数量<input class='search_field' type='text' id='item_count'></span><span><input class='searchBtn BFirst'  type='button' value='保存' id='dataAdd' /></span></td><td></td></tr><tr>"+
							"<th>ID</th>"+
							"<th>名称</th>"+
							"<th width='25%'>数量</th>"+
							"<th>操作</th>"+
						"</tr>"+
						"</thead>";
						for(i in data.data.list){
							_html += "<tr class='dj_saveBtn' data-id='"+data.data.list[i].values[1]+"'>";
							_html+="<td>"+data.data.list[i].values[1]+"</td>";
							_html+="<td>"+data.data.name_list[data.data.list[i].values[1]]+"</td>";
							_html+="<td><input class='countBox' type='text' name='' value='"+data.data.list[i].values[2]+"'></td>";
							_html+="<td><input type='button' value='删除' class='searchBtn item_delete'/><input type='button' value='保存' class='searchBtn item_save'/></td>";
							_html += '</tr>';
						}
						break;

					case "combat"://战斗信息
						_html= "<thead>"+
						"<tr>"+
							"<th>ID</th>"+
							"<th>队列士兵信息</th>"+
							"<th>战斗状态(STATE)</th>"+
							"<th>队列类型(BATTLE_TYPE)</th>"+
							"<th>队列目的地(END_POS)</th>"+
							//"<th>当前状态结束剩余时间(STATE_TIME)</th>"+
							//"<th>数量</th>"+
						"</tr>"+
						"</thead>";
						for(i in data.data.list){
							_html += '<tr>';
							_html+="<td>"+data.data.list[i].id+"</td>";
							_html+="<td>";
                            for (j in data.data.list[i].gamer_list) {
                                _html+= parseInt(j + 1);
                                _html+= '、';
                                _html+= data.data.list[i].gamer_list[j].name + '，' + data.data.list[i].gamer_list[j].uid + '；';
                                for (k in data.data.list[i].gamer_list[j].soldier_list) {
                                    _html+= data.data.list[i].gamer_list[j].soldier_list[k].level + '级' + data.data.list[i].gamer_list[j].soldier_list[k].name + '，' + data.data.list[i].gamer_list[j].soldier_list[k].rest_num + '；';
                                }
                                _html+= '<br />';
                            }
                            _html+="</td>";
							_html+="<td>"+data.data.list[i].state+"</td>";
							_html+="<td>"+data.data.list[i].type+"</td>";
							_html+="<td>"+data.data.list[i].end_pos+"</td>";
							//_html+="<td>"+data.data.list[i].state_time+"</td>";
							//_html+="<td>暂无数据</td>";
							_html += '</tr>';
						}
						break;
				}
				$(this._contentBox).html(_html);
				dataAdd();
			},
			_contentBox:"#pegeContentBox",
			_btnBox:"#pageBox",
			_pageNum:"5",
			_page:"1",
			_page_size:pageNums,
			_pageSt:"none"
		});
	}
	$("#buildNumBtn").live('click',function(){
		var _val = $("#buildNum").val();
        for (var i = 0; i < _val.length; i++) {
            if(isNaN(_val[i])){
    			alert("建筑信息必须是大于等于4的正整数")
            	return false;
            }
        };
        if(_val>3){
			$.ajax({
				url:pageUrl+"/gamer/set-building-level",
				data:{uid:userId,level:_val},
				type:"get",
				dataType:"json",
				success:function(data){
					alert(data.msg);
				},
				error:function(){
					alert("删除失败");
				}
			})
    	}else{
    		alert("建筑信息必须是大于等于4的正整数")
    	}
	})
	$("#pegeContentBox .item_delete").live('click',function(){//道具信息删除
		var _this = $(this);
		$.ajax({
			url:pageUrl+"/gamer/ajax-delete-item",
			data:{uid:userId,item_id:$(this).parents("tr").attr("data-id")},
			type:"post",
			dataType:"json",
			success:function(data){
				_this.parents("tr").remove();
			},
			error:function(){
				alert("删除失败");
			}
		})
	})
	$("#pegeContentBox .item_save").live('click',function(){//道具信息修改
		$.ajax({
			url:pageUrl+"/gamer/ajax-set-item",
			data:{uid:userId,item_id:$(this).parents("tr").attr("data-id"),count:$(this).parents("tr").find("input[type='text']").val()},
			type:"post",
			dataType:"json",
			success:function(data){
				alert(data.msg)
			},
			error:function(){
				alert("保存失败");
			}
		})
	})
	function dataAdd(){
		$("#zcSaveBtn").unbind().bind('click',function(){//资产信息批量修改
			var resource = [0];
			for(var i = 0 ; i<$("#pegeContentBox .countBox").length ; i++){
				resource.push($("#pegeContentBox .countBox").eq(i).val());
			}
			$.ajax({
				url:pageUrl+"/gamer/update-resource-list",
				data:{uid:userId,resource},
				type:"post",
				dataType:"json",
				success:function(data){
					alert(data.msg);
					location.reload()
				},
				error:function(){
					alert("保存失败");
				}
			})
		});
		$("#dataAdd").unbind().bind('click',function(){//添加道具
			$.ajax({
				url:pageUrl+"/gamer/ajax-set-item",
				data:{uid:userId,item_id:$("#item_id").val(),count:$("#item_count").val()},
				type:"post",
				dataType:"json",
				success:function(data){
					alert(data.msg)
				},
				error:function(){
					alert("新增道具失败");
				}
			})
		});
		$("#pegeContentBox .dj_saveBtn").each(function(i){//操作道具
			$(this).find("input.delete").bind("click",function(){//删除道具
				$.ajax({
					url:pageUrl+"/gamer/ajax-set-item",
					data:{uid:userId,item_id:$(this).parents(".dj_saveBtn").attr("data-id")},
					type:"post",
					dataType:"json",
					success:function(data){

					},
					error:function(){
						alert("新增道具失败");
					}
				})
			});
			$(this).find("input.save").bind("click",function(){//修改道具
				$.ajax({
					url:pageUrl+"/gamer/ajax-set-item",
					data:{uid:userId,item_id:$(this).parents(".dj_saveBtn").attr("data-id"),count:$(this).parents(".dj_saveBtn").find(".countBox").val()},
					type:"post",
					dataType:"json",
					success:function(data){

					},
					error:function(){
						alert("新增道具失败");
					}
				})
			});
		})
	}
});