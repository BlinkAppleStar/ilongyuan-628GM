$(function(){
	var lists,num,addList,channelLists='',addListFn = function(addList){
		lists = '<div class="sendCon_giftSet oth js_listBox">'+
			'<span class="sendCon_ins">礼包道具：</span>'+
			'<select class="sendCon_field select gift" name="list">'+addList+'</select>'+
			'<span class="sendCon_ins">数量：</span>'+
			'<input class="sendCon_field count" type="text" name="num">'+
			'<input class="searchBtn blue js_delete" type="button" name="" value="删除">'+
		'</div>'
		$("#addListBox").append(lists);
	};
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
			addListFn(addList);
        },
        error:function(msg){
            alert("加载失败，请刷新重试！");
        }
    })
	$.ajax({//获取渠道列表多选项
		url:pageUrl+"/setting/index",
		data:{ajax:"1",table_name:"channel"},
        type:"get",
        dataType:"json",
        success:function(data){
        	for(i in data.data){
        		channelLists += '<input class="searchBtn checkbox" type="checkbox" value="'+ data.data[i].name +'">'+
					 '<span>'+ data.data[i].name +'</span>';
        	}
			$(".js_channelList").append(channelLists);
        },
        error:function(msg){
            alert("加载失败，请刷新重试！");
        }
    })
    //删除礼包
    $("#addListBox .js_delete").live('click',function(){
    	$(this).parents(".js_listBox").remove();
    });
 	//删除渠道
    $("#addChannelBox .js_delete").live('click',function(){
    	$(this).parents(".js_listBox").remove();
    });
    //保存礼包
    $('#downloadBtn').click(function(){
    	var formName = ".generategifts";
    	if($(formName).find("input[name='cdkey_count']").val() == ""){
			return alert("礼包数量,不能为空");
		}
    	if($(formName).find("input[name='name']").val() == ""){
			return alert("礼包名,不能为空");
		}
    	if($(formName).find("textarea[name='desc']").val() == ""){
			return alert("礼包描述,不能为空");
		}
    	if($(formName).find("#addListBox input[name='num']").val() == ""){
			return alert("礼包道具数量,不能为空");
		}
    	if($(formName).find("input[name='start_time']").val() == ""){
			return alert("礼包生效时间,不能为空");
		}
    	if($(formName).find("input[name='end_time']").val() == ""){
			return alert("礼包失效时间,不能为空");
		}
    	ajax_save();
    })
    // 保存礼包
	function ajax_save(){
	    var attachs = [];
	    $("#addListBox .js_listBox").each(function(){
	        current_attach = {
	            'item_id' : $(this).find('select').val(),
	            'item_count' : $(this).find('input[name="num"]').val()
	        };
	        attachs.push(current_attach);
	    });
	    var channels = [];
	    $("#channel_table input:checked").each(function(){
	        current_channel = {
	            'name' : $(this).val()
	        };
	        channels.push(current_channel);
	    });
	    $.post(pageUrl+'/cdk/gift-edit',
	        {
	            // mongo_id: $('#mongo_id').val(),
	            start_time : $('input[name="start_time"]').val(),
	            end_time : $('input[name="end_time"]').val(),
	            name : $('input[name="name"]').val(),
	            desc : $('textarea[name="desc"]').val(),
	            cdkey_count : $('input[name="cdkey_count"]').val(),
	            channels : channels,
	            attachs : attachs,
	            ajax : 1
	        },
	        function(ret){
	            if (ret.ok) {
	                window.location.href=pageUrl+'/cdk/download?id=' + ret.data;
	            } else {
	                alert(ret.msg);
	            }
	        },
	        'json'
	    );
	}

})