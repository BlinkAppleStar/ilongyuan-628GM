var ajaxUrl;
$(function(){
	var warpTitl;
	$.ajax({
		url: pageUrl+"/site/check-login",
		type: "get",
		dataType: "json",
		data:{ajax:1},
		success: function(data){
			if(!data.ok){
				window.location.href = pageUrl + "/site/login";
			}else{
				//$('.loginBox .loginText').html("（" + data.data.real_name + "）");
				tokens = data.data.foreign_token;
				ajaxUrl = data.data.foreign_url;
                $('#menuBox').html(data.data.left_menu_html);
			}
		}
	})
	document.title = "新增活跃";
	$("#menuBox li a").live('click',function(){
		warpTitl = "";
		$("#menuBox li").removeClass("active");
		$(this).parents("li").addClass("active");
		warpTitl += $(this).parent("li").parents("li").find("a:first").text();
		if(warpTitl){
			warpTitl += ">";
		}
		warpTitl += $(this).text();
		$("#warpTopTitle").html(warpTitl);
		document.title = warpTitl;
	});
	$("#menuBtnTog").bind('click',function(){
		$(this).toggleClass("active");
		$("#warpMainBox").toggleClass("active");
	})
})