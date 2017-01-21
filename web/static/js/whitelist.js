$(function(){
	var options = "";
	//ip白名单列表
	function ipListFn(){
		$.ajax({
			url: pageUrl + "/black-list/list",
			type:"get",
			data:{type:"ip_white"},
			dataType:"json",
			success: function(data){
				options = "";
				for(var i in data.data.list){
					options += "<option data-id='"+ data.data.list[i]._id.$id +"'>"+ data.data.list[i].ip +"</option>";
				}
				$('#whiteListSel').html(options);
			}
		})	
	}
	ipListFn();
	//添加IP
	$('#addIp').click(function(){
		$('.popupBox.box1').show();
		$('.ipAddress').val('');

		//添加弹窗关闭
		$('.box1 .cancelBtn').click(function(){
			$(this).parents('.popupBox').hide();
		})
		//添加弹窗确认
		$('.box1 .confirmBtn').click(function(){
			var pattern = /((?:(?:25[0-5]|2[0-4]\d|[01]?\d?\d)\.){3}(?:25[0-5]|2[0-4]\d|[01]?\d?\d))/,
				_thisVal = $('.ipAddress').val();
			if(!pattern.test(_thisVal)){
				alert('请输入格式正确的ip地址');
			}else{
				$.ajax({
					url: pageUrl + "/black-list/ip-edit",
					type:"post",
					data:{ajax:1,type:"ip_white",ip:_thisVal},
					dataType:"json",
					success: function(data){
						alert('ip地址添加成功'),$('.popupBox.box1').hide(),ipListFn();
					}
				})	
			}
		})
	})		
	//删除IP
	$('#deleteIp').click(function(){
		var _this = $('#whiteListSel option:selected'),
			_html = "确认删除当前ip（"+_this.val()+"）?",
			_id = _this.attr('data-id');

		if(_this.length == 1){
			$('.popupBox.box2').show();
			$('.popupBox.box2').find('.contentBox .title').html(_html);
		}
		//删除弹窗关闭
		$('.box2 .cancelBtn').click(function(){
			$(this).parents('.popupBox').hide();
		})
		//删除弹窗确认
		$('.box2 .confirmBtn').click(function(){
			$.ajax({
				url: pageUrl + "/black-list/delete",
				type:"get",
				data:{id:_id},
				dataType:"json",
				success: function(data){
					alert('成功删除ip地址'),_this.remove(),$('.popupBox.box2').hide();
				}
			})	
		})
	})	
})