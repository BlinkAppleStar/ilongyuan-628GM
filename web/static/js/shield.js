$(function(){
	var datas = "type=black",setPage = window.location.href,
	_editHref = ajaxUrl + "/static/shieldEdit.html";
	if(setPage.indexOf("name=")<=0){
		setPage = '';
	}else{
		setPage = setPage.substr(setPage.indexOf("name=")+5,setPage.length);
	}
	function shieldFn(){
		$("body").pageFn({
			_url:pageUrl+"/black-list/list",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>类型</th>"+
						"<th>UID</th>"+
						"<th>昵称</th>"+
						"<th>渠道</th>"+
						"<th>起始时间</th>"+
						"<th>结束时间</th>"+
						"<th>创建时间</th>"+
						"<th>操作人</th>"+
						"<th>操作</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data.list){
					_html += '<tr>';
					if(data.data.list[i].type == "black"){
						_html+="<td>黑名单</td>";
					}else if(data.data.list[i].type == "white"){
						_html+="<td>白名单</td>";
					}
					_html+="<td>"+data.data.list[i].uid+"</td>";
					_html+="<td>"+data.data.list[i].name+"</td>";
					_html+="<td>"+data.data.list[i].channel+"</td>";
					_html+="<td>"+data.data.list[i].start_time+"</td>";
					_html+="<td>"+data.data.list[i].end_time+"</td>";
					_html+="<td>"+data.data.list[i].created_time+"</td>";
					_html+="<td>"+data.data.list[i].updater+"</td>";
					_html+="<td><a class='js_edit homesetLink' target='_blank' href='shieldEdit.html?id="+data.data.list[i]._id.$id+"'>编辑</a>"+
						"<a href='javascript:;' class='js_delete homesetLink' data-id='"+data.data.list[i]._id.$id+"'>删除</a>"+
					"</td>";
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
	shieldFn();
	$('select[name="channel"]').settiongFn({//渠道
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"channel"},
		_postStr: ""
	});
	// 添加记录
	$('#addBtn').attr('href','shieldEdit.html');
	// 删除记录
	$('.js_delete').live('click',function(){
		var _thisId = $(this).attr('data-id');
		$.ajax({
			url: pageUrl + "/black-list/delete",
			type: "get",
			dataType: "json",
			data:{ajax:1,table_name:setPage,id:_thisId},
			success: function(data){
				alert("成功删除！");
			},
			error: function(data){
				alert(data.msg);
			}
		})
		$(this).parents('tr').remove();
	})
	// 编辑记录
	$('.js_edit').live('click',function(){
		var _thisId = $(this).attr('data-id');
		$(this).parent().attr('href',_editHref + "?&id=" + _thisId);
	})
	// 条件搜索
	$("#shieldSearch").bind('click',function(){
		datas = $("#shieldSearchBox").serialize();
		shieldFn();
	});
})