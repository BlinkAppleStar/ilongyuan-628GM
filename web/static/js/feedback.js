$(function(){
	var datas = "",_thisId = "",_html = "",_selHtml = "";
	function feedbackFn(){
		$("body").pageFn({
			_url:pageUrl+"/feed-back/list",
			_data:datas,
			_success:function(data){
				var _html= "<thead>"+
					"<tr>"+
						"<th>流水号</th>"+
						"<th>昵称</th>"+
						"<th>uid</th>"+
						"<th>渠道</th>"+
						"<th>渠道uid</th>"+
						"<th>设备型号</th>"+
						"<th>内容</th>"+
						"<th>提交时间</th>"+
						"<th>玩家累计反馈次数</th>"+
						"<th>回复人</th>"+
						"<th>操作</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data.list){
					_html += '<tr>';
					_html+="<td>"+data.data.list[i]._id.$id+"</td>";
					_html+="<td>"+data.data.list[i].user_name+"</td>";
					_html+="<td>"+data.data.list[i].uid+"</td>";
					_html+="<td>"+data.data.list[i].channel+"</td>";
					_html+="<td>"+data.data.list[i].channel_uid+"</td>";
					_html+="<td>"+data.data.list[i].device_type+"</td>";
					_html+="<td>"+data.data.list[i].question+"</td>";
					_html+="<td>"+data.data.list[i].created_time+"</td>";
					_html+="<td>"+data.data.list[i].feedback_count+"</td>";
					if(!data.data.list[i].manager){
						_html+="<td>未回复</td>";
					}else{
						_html+="<td>"+data.data.list[i].manager+"</td>";
					}
					_html+="<td><a class='homesetLink' target='_blank' href='userdata.html?id="+data.data.list[i].uid+"'>玩家详情</a>"+
						"<a href='javascript:;' class='js_reply homesetLink' data-id='"+data.data.list[i]._id.$id+"' data-umsg='"+data.data.list[i].question+"' data-smsg='"+data.data.list[i].answer+"'>回复</a>"+
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
	feedbackFn();
	$('select[name="channel"]').settiongFn({//渠道
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"channel"},
		_postStr: ""
	});
	$.ajax({//区服
		url:pageUrl+"/setting/game-server-list",
		data:{ajax:"1"},
		type:"get",
		dataType:"json",
		success:function(data){
			var _selHtml = "<option value=''></option>";;
			for(var i in data.data){
				_selHtml += "<option value='"+data.data[i].lid+"'>"+ data.data[i].name +"</option>";
			}
			$('select[name="server_lid"]').html(_selHtml);
		}
	});
	//回复玩家信息
	$('.js_reply').live('click',function(){
		var userReplyMsg = $(this).attr('data-umsg'),
			serverReplyMsg = $(this).attr('data-smsg');
		_thisId = $(this).attr('data-id');
		$('.popupBox.suggest').find('textarea[name="userReply"]').html(userReplyMsg);
		if(serverReplyMsg != ""){
			$('.popupBox.suggest .submitBtn').hide();
			$('textarea[name="serverReply"]').attr('disabled',true);
		}else{
			$('.popupBox.suggest .submitBtn').show();
			$('textarea[name="serverReply"]').attr('disabled',false);
		}
		$('.popupBox.suggest').find('textarea[name="serverReply"]').html(serverReplyMsg);
		$('.popupBox.suggest').show();
	})
	//关闭回复玩家信息窗口
	$('.popupBox.suggest .zzc').click(function(){
		$(this).parent().hide();
	})
	//提交回复玩家信息窗口
	$('.popupBox.suggest .submitBtn').click(function(){
		$('.alertBox').show();
		//确定提交
		$('.alertBox .confirmBtn').click(function(){
			_thisAnswer = $('textarea[name="serverReply"]').val();
			$.ajax({
				url: pageUrl + "/feed-back/answer",
				type: "post",
				dataType: "json",
				data:{ajax:1,answer:_thisAnswer,mongo_id:_thisId},
				success: function(data){
					alert(data.msg),$('.alertBox').hide(),$('.popupBox.suggest').hide(),window.location.reload();;
				},
				error: function(data){
					alert(data.msg);
				}
			})
		})
		//取消提交
		$('.alertBox .cancelBtn').click(function(){
			$(this).parents('.alertBox').hide();
		})
	})
	//条件搜索
	$("#feedbackSearch").bind('click',function(){
		datas = $("#feedbackSearchBox").serialize();
		feedbackFn();
	});
})