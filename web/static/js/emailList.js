$(function(){
	var datas = "",_html,times,emailListFn = function(){
		$("body").pageFn({
			_url:pageUrl+"/email/queue-list",
			_data:datas,
			_success:function(data){
				_html= "<thead>"+
					"<tr>"+
						"<th>流水号</th>"+
						"<th>渠道</th>"+
						"<th>区服</th>"+
						"<th>收件人</th>"+
						"<th>标题</th>"+
						"<th width='20%'>内容预览</th>"+
						"<th>类型</th>"+
						"<th width='160'>提交时间</th>"+
						"<th width='160'>发送时间</th>"+
						"<th>状态</th>"+
						"<th>是否有附件</th>"+
						"<th class='minWidthTh'>操作</th>"+
					"</tr>"+
				"</thead>";
				for(i in data.data.list){
					_html += '<tr>';
					_html+="<td>"+i+"</td>";
					_html+="<td>"+data.data.list[i].channel+"</td>";
					_html+="<td>"+data.data.list[i].server+"</td>";
					if((data.data.list[i].uid =="" && data.data.list[i].uname =="") || 
						(data.data.list[i].uid.legnth == 0 && data.data.list[i].uname.length == 0)){
						_html+="<td>/</td>";
					}else{
						_html+="<td><span class='recipients'>点击查看收件人</span></td>";
					}
					_html+="<td>"+data.data.list[i].title+"</td>";
					_html+="<td>"+data.data.list[i].content+"</td>";
					if(data.data.list[i].uid == '' && data.data.list[i].uname == ''){
						_html+="<td>区服邮件</td>";
					}else{
						_html+="<td>个人邮件</td>";
					}
					_html+="<td>"+data.data.list[i].created_time+"</td>";
					if(data.data.list[i].send_success == 0){//未发送邮件
						_html+="<td><input class='countBox Wdate' onclick='WdatePicker()' type='text' value='"+data.data.list[i].send_time+"'></td>";
						_html +="<td>未发送</td>"
					}else{//已发送邮件
						_html+="<td>"+data.data.list[i].send_time+"</td>";
						_html +="<td>已发送</td>"
					}
					if(data.data.list[i].attachs.length>=1){//有附件
						_html+="<td>是</td>";
					}else{//没有附件
						_html+="<td>否</td>";
					}
					if(data.data.list[i].send_success == 0){//未发送邮件
						_html += '<td>'+
							'<input id="previewBtn" class="searchBtn" type="button" name="" data-id="'+ data.data.list[i]._id.$id +'" value="预览">'+
							'<input id="saveBtn" class="searchBtn" type="button" name="" data-id="'+ data.data.list[i]._id.$id +'" value="保存">'+
							'<input id="deleteBtn" class="searchBtn" type="button" name="" data-id="'+ data.data.list[i]._id.$id +'" value="删除">'+
						'</td>';
					}else{//已发送邮件
						_html += '<td>'+
							'<input id="previewBtn" class="searchBtn" type="button" name="" data-id="'+ data.data.list[i]._id.$id +'" value="预览">'+
						'</td>';
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
	emailListFn();

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

	//条件搜索事件
	$('#emailListBtn').click(function(){
		datas = $("#emailListBox").serialize()+"&server_id="+$("#server_id").attr("value");
		emailListFn();
	})
	//查看收件人列表
	$('.searchTable .recipients').live('click',function(){
		var leftHtml = '',rightHtml = '';
		$('.popupBoxZZC').show();
		datas = "id="+$(this).parents('tr').find('#previewBtn').attr('data-id')+"&ajax=1";
		$.ajax({
	        url:pageUrl+"/email/queue-detail",
	        data:datas,
	        type:"get",
	        dataType:"json",
	        success:function(data){
	        	var html = '<div id="recipientsList">'+
	        				'<div class="leftList">'+
						   '<span class="title">uid:</span>';
				if(data.data.uid != ''){
					for(var i in data.data.uid){
		        		leftHtml += '<span>'+ data.data.uid[i] +'</span>';
		        	}
				}
	        	html += leftHtml + '</div><div class="rightList">'+
	        				'<span class="title">昵称:</span>';
	        	if(data.data.uname != ''){
	        		for(var i in data.data.uname){
		        		rightHtml += '<span>'+ data.data.uname[i] +'</span>';
		        	}
	        	}
	        	html += rightHtml + '</div></div>';
	        	$('.popupBox .titleBox .title').html('收件人列表');
	        	$('.popupBox .contentBox').html(html);
	        },
	        error:function(msg){
	            alert("加载失败，请刷新重试！");
	        }
	    })
	})
	//邮件保存
	$('#saveBtn').live('click',function(){
		times = "send_time="+$(this).parents('tr').find('.countBox').val();
		datas = times + "&id="+$(this).attr('data-id')+"&ajax=1";
		$.ajax({
			url:pageUrl+"/email/update-send-time",
			data:datas,
	        type:"get",
	        dataType:"json",
	        success:function(data){
	        	if(data.ok){
	        		alert(data.msg);
	        	}else{
	        		alert('保存失败');
	        	}
	        }
		})
	})
	//邮件删除
	$('#deleteBtn').live('click',function(){
		var _this = $(this);
		datas = "id="+$(this).attr('data-id')+"&ajax=1";
		$.ajax({
			url:pageUrl+"/email/delete",
			data:datas,
	        type:"get",
	        dataType:"json",
	        success:function(data){
	        	if(data.ok){
	        		alert(data.msg),_this.parents('tr').remove();
	        	}else{
	        		alert('删除失败');
	        	}
	        }
		})
	})
	//邮件预览
	$('#previewBtn').live('click',function(){
		$('.popupBoxZZC').show();
		datas = "id="+$(this).attr('data-id')+"&ajax=1";
		$.ajax({
	        url:pageUrl+"/email/queue-detail",
	        data:datas,
	        type:"get",
	        dataType:"json",
	        success:function(data){
	        	var html = '<textarea name="detail" id="gift_detail" disabled="disabled" placeholder="500字以内">'+ data.data.content +'</textarea>';
	        	var idx;
	        	for(var i in data.data.attachs){
	        		if(data.data.attachs[i].item_count == ''){
	        			data.data.attachs[i].item_count = 0;
	        		}
	        		idx = parseInt(i) + 1;
	        		html += '<div class="gift_list"><span>附件</span>'+
								'<span class="gift_idnex">'+ idx +'</span>'+
								'<span class="icon_attchment">：</span>'+
								'<span class="gift_cont gift_name">'+ data.data.attachs[i].item_id + " " + data.data.attachs[i].item_name +'</span>'+
								'<span class="ml10 mr10">数量</span>'+
								'<span class="gift_cont gift_num">'+ data.data.attachs[i].item_count +'</span>'+
							'</div>';
	        	}
	        	$('.popupBox .titleBox .title').html('内容详情');
	        	$('.popupBox .contentBox').html(html);
	        },
	        error:function(msg){
	            alert("加载失败，请刷新重试！");
	        }
	    })
	})
	//关闭邮件预览窗口
	$('.popupBoxZZC .closeBtn').click(function(){
		$(this).parents('.popupBoxZZC').hide();
		$(this).parent().next().html('');
	})
});