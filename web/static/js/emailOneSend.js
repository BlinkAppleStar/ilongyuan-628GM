$(function(){
	var formName = "#sendEmail1",
	lists,
	addList,
	i,
	times,
	listText,
	d,
	attachs=[],
	addListFn = function(addList){
		lists = '<div class="sendCon_giftSet oth js_listBox">'+
			'<span class="sendCon_ins oth">礼包道具</span>'+
			'<select class="sendCon_field select gift" name="list">'+addList+'</select>'+
			'<span class="sendCon_ins">数量</span>'+
			'<input class="sendCon_field count" type="text" name="num">'+
			'<span class="sendCon_ins"><a href="javascript:" class="js_delete">删除</a></span>'+
		'</div>'
		$("#addListBox").append(lists);
	},
	realtimeFn = function(datas){//发送邮件请求
	    $.ajax({
	        url:pageUrl+"/email/send",
	        data:datas,
	        type:"post",
	        dataType:"json",
	        success:function(data){
	        	alert(data.msg);
	        },
	        error:function(msg){
	            alert("加载失败，请刷新重试！");
	        }
	    })
    }
	$('select[name="channel"]').settiongFn({//渠道
		_state:true,
		_url:pageUrl+"/setting/index",
		_data:{ajax:"1",table_name:"channel"},
		_postStr: ""
	});
	$('.server_id').settiongFn({//区服
		_value:true,
		_state:true,
		_url:pageUrl+"/setting/game-server-list",
		_data:{ajax:"1"},
		_postStr: ""
	});
	$("#menuBoxBtn li").each(function(i){//切换发送类型
		$(this).live('click',function(){
			$(this).addClass("checked").siblings().removeClass("checked");
			$("#menBox .sendCon:eq("+i+")").removeClass("none").siblings().addClass("none");
			formName = "#"+$("#menBox .sendCon:eq("+i+")").find("form").attr("id");
		})
	})

    $.ajax({//可添加的道具列表
        url:pageUrl+"/setting/get-item-list",
        data:'',
        type:"get",
        dataType:"json",
        success:function(data){
        	num = 0,addList='';
        	for(i in data.data){
        		addList += "<option value='"+i+"'>"+i+" "+data.data[i]+"</option>";
        	}
			$("#listAddBtn").bind('click',function(){//点击添加道具
				addListFn(addList);
			});
        },
        error:function(msg){
            alert("加载失败，请刷新重试！");
        }
    })
    $("#addListBox .js_delete").live('click',function(){
    	$(this).parents(".js_listBox").remove();
    });
	$("#emailSendBtn .js_send_time").bind('click',function(){//点击发送邮件
		/*if($("#sendEmailContent input[name='title']").val() == ""){
			return alert("邮件标题不能为空");
		}else if($("#sendEmailContent textarea[name='content']").val() == ""){
			return alert("邮件内容不能为空");
		}*/
		if($(formName).find("textarea[name='uids']").val() == ""){
			return alert("玩家uid,不能为空");
		}
		if($(formName).find("textarea[name='user_names']").val() == ""){
			return alert("玩家昵称,不能为空");
		}
		if($(this).attr("data-id") == "1"){
			times = "";
		}else{
			if($("#emailSendBtn input[name='send_time']").val()==""){
				return alert("定时发送，时间不能为空");
			}
			times = $("#emailSendBtn input[name='send_time']").val();
		}
		attachs=[];
		$("#addListBox .js_listBox").each(function(){
			if($(this).find("[name='num']").val() == ""){
				return true;
			}else{
				for(i=0;i<$(this).find("[name='num']").val().length;i++){
					if(isNaN($(this).find("[name='num']").val()[i])){
						return true;
					}
				}
			}
			listText={
				'item_id':$(this).find("[name='list']").attr("value"),
				'item_count':$(this).find("[name='num']").val()
			};
			attachs.push(listText)
		})
		datas={
			'channel':$(formName).find("[name='channel']").val(),
			'server_id':$(formName).find(".server_id").attr("value"),
			'uids':$(formName).find("[name='uids']").val(),
			'user_names':$(formName).find("[name='user_names']").val(),
			'title':$("#sendEmailContent").find("[name='title']").val(),
			'content':$("#sendEmailContent").find("[name='content']").val(),
			'send_time':times,
			'attachs':attachs
		};
		//datas=$(formName).serialize()+"&"+$("#sendEmailContent").serialize()+"&server_id="+$(formName).find(".server_id").attr("value")+times+"&attachs="+attachs;
		realtimeFn(datas);
	});
});