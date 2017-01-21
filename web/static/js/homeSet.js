$(function(){
	var datas="";
	var homeSetFn = function(){
		$("body").pageFn({
			_url: pageUrl+"/announce/list",
			_type:"get",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>ID</th>"+
						"<th>渠道</th>"+
						"<th>版本</th>"+
						"<th>语言</th>"+
						"<th>标题</th>"+
						"<th width='25%'>内容</th>"+
						"<th>落款</th>"+
						"<th>URL</th>"+
						"<th>开始时间</th>"+
						"<th>结束时间</th>"+
						"<th width='100'>操作</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data.list){
					_html += '<tr>';
					_html+="<td>"+data.data.list[i]._id.$id+"</td>";
					_html+="<td>"+data.data.list[i].channel+"</td>";
					_html+="<td>"+data.data.list[i].version+"</td>";
					_html+="<td>"+data.data.list[i].lang+"</td>";
					_html+="<td>"+data.data.list[i].title+"</td>";
					_html+="<td>"+data.data.list[i].content+"</td>";
					_html+="<td>"+data.data.list[i].inscribe+"</td>";
					_html+="<td>"+data.data.list[i].url+"</td>";
					_html+="<td>"+data.data.list[i].start_time+"</td>";
					_html+="<td>"+data.data.list[i].end_time+"</td>";
					_html+="<td><a class='homeSetEdit homesetLink' target='_blank' href='homepublish.html?id="+data.data.list[i]._id.$id+"'>编辑</a>"+
						"<a href='javascript:;' class='homeSetDelete homesetLink' data-id='"+data.data.list[i]._id.$id+"'>删除</a>"+
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
	homeSetFn();
	$('#addBtn').attr('href','homepublish.html');
	$("#homeSetBtn").bind('click',function(){
		datas = $("#homeSetBox").serialize()+"&server_id="+$("#homeSetBox").find("#server_id").attr("value");
		homeSetFn();
	})
	$("#pegeContentBox .homeSetDelete").live('click',function(){
		var datasDelete=$(this);
		$.ajax({
			url: pageUrl+"/announce/delete",
			type: "get",
			dataType: "json",
			data:{id:datasDelete.attr("data-id")},
			success: function(data){
				datasDelete.parents("tr").remove(),alert("删除成功！");
			}
		})
	})

	$('select[name="channel"]').settiongFn({//渠道
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"channel"},
		_postStr: ""
	});

	$('#server_id').settiongFn({//区服
		_value:true,
		_url:pageUrl+"/setting/game-server-list",
		_data:{ajax:"1"},
		_postStr: ""
	});

	$('select[name="lang"]').settiongFn({//语言
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"language"},
		_postStr: ""
	});

	$('select[name="version"]').settiongFn({//版本
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"version"},
		_postStr: ""
	});
})