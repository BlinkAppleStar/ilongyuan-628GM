$(function(){
	var cdkData = "";
	cdkfd();
	function cdkfd(){
		$("body").pageFn({
			_url:pageUrl+"/cdk/gift-list",
			_data:cdkData,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>礼包流水号</th>"+
						"<th>礼包名</th>"+
						"<th>礼包描述</th>"+
						"<th>礼包内容</th>"+
						"<th>礼包有效时间</th>"+
						"<th>礼包渠道</th>"+
						"<th>礼包使用情况（已用/所有）</th>"+
						"<th>导出表格</th>"+
						"<th>删除礼包</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data.list){
					_html += '<tr>';
					_html+="<td>"+data.data.list[i].id+"</td>";
					_html+="<td>"+data.data.list[i].name+"</td>";
					_html+="<td>"+data.data.list[i].desc+"</td>";
					_html+="<td>"
					for(m in data.data.list[i].attachs){ //输出礼包内容
						if(m == data.data.list[i].attachs.length - 1){
							_html+="道具名：" + data.data.list[i].attachs[m].item_name + " 数量：";
							_html+=data.data.list[i].attachs[m].item_count;
						}else{
							_html+="道具名：" + data.data.list[i].attachs[m].item_name + " 数量：";
							_html+=data.data.list[i].attachs[m].item_count + "<br>";
						}
					}
					_html+="</td>";
					_html+="<td>"+data.data.list[i].start_time+" —— "+data.data.list[i].end_time+"</td>";
					_html+="<td>"
					if(!data.data.list[i].channels){
						_html += "全部";
					}else{
						for(k in data.data.list[i].channels){ //输出礼包渠道
							if(data.data.list[i].channels[k].name == ""){
								_html+= "全部";
							}
							if(k == data.data.list[i].channels.length - 1){
								_html+= data.data.list[i].channels[k].name;
							}else{
								_html+= data.data.list[i].channels[k].name+",";
							}
						}	
					}
					_html+="</td>";
					_html+="<td>"+data.data.list[i].cdkey_used+"/"+data.data.list[i].cdkey_count+"</td>";
					_html+='<td><a class="btn_href" target="_blank" href="'+pageUrl+'/cdk/download?id='+data.data.list[i]._id.$id+'"><input id="js_export" class="searchBtn" type="button" name="" value="导出"></a></td>';
					if(data.data.list[i].status == 1){
						_html+='<td><input id="js_delete" class="searchBtn" data-id="'+data.data.list[i]._id.$id+'" type="button" name="" value="删除"></td>';
					}
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
	/*获取渠道信息*/ 
	$('select[name="channel"]').settiongFn({//渠道
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"channel"},
		_postStr: ""
	});
	/*条件搜索*/
	$('#cdkSearch').bind('click',function(){
		cdkData = $("#cdkSearchBox").serialize();
		cdkfd();
	});
	/*删除礼包*/
	$('#js_delete').live('click',function(){
		datasDelete = $(this);
		$.ajax({
			url: pageUrl+"/cdk/gift-delete",
			type: "get",
			dataType: "json",
			data:{id:datasDelete.attr("data-id")},
			success: function(data){
				datasDelete.parents("tr").remove(),alert("删除成功！");
			}
		})
	})
})