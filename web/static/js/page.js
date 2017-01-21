(function($){
	$.fn.pageFn = function(ops){
		var _ops = $.extend({
			_url:"",
			_data:"",
			_type:"get",
			_dataType:"json",
			_success:function(data){},
			_error:function(msg){},
			_page:"",
			_page_size:"",
			_contentBox:"",
			_pageNum:"",
			_btnBox:"",
			_state:true,
			_pageSt:""
		},ops),i,c,pageHtml,pageNum,dataNum,pn,p,total,_url=_ops._url,_data=_ops._data,_type=_ops._type,_dataType=_ops._dataType,_page=_ops._page,_page_size=_ops._page_size,_contentBox=_ops._contentBox,_pageNum=_ops._pageNum,_pageSt=_ops._pageSt,_btnBox=$(_ops._btnBox),_state=_ops._state;
		var pageBoxFn = function(){
			if(!_state){
				c=_data;
			}else{
				if(!_data){
					c = "page="+_page+"&page_size="+_page_size;
				}else{
					c = _data+"&page="+_page+"&page_size="+_page_size;
				}
			}
			$.ajax({
				url:_url,
				data:c,
				type:_type,
				dataType:_dataType,
				success:function(data){
					pageHtml='';//清空分页代码
					_ops._success(data);
					total=data.data.total;//条数
					if(typeof(total) == "undefined"){
						total = 10;
					}
					pageNum = Math.ceil(total/_page_size);//页数
					if(pageNum<=1){//如果小于等于一页时，给分页框加类
						$(_btnBox).addClass(_pageSt);
					}else{
						$(_btnBox).removeClass(_pageSt);
					}
					if(_pageNum>pageNum){//如何设置的页数大于总页数
						_pageNum = pageNum;
					}
					pn = Math.ceil(_pageNum/2);
					if(_page-pn<=0){
						p = 1;
						pn=0;
					}else if(_page-pn>=pageNum-pn*2+1){
						if(Math.ceil(_pageNum/2)-_pageNum/2>0){
							pn--;
							p = pageNum-pn;
						}else{
							p = pageNum-pn;
							pn--;
						}
					}else{
						p = _page;
						pn--;
					}
					pageHtml += "<a href='javascript:' data-num='-1'>上一页</a>";
					for(i = p-pn;i<p*1-pn+_pageNum*1;i++){
						if(i == _page){
							pageHtml += "<a href='javascript:' class='active' data-num='"+i+"'>"+i+"</a>";
						}else{
							pageHtml += "<a href='javascript:' data-num='"+i+"'>"+i+"</a>";
						}
					}
					pageHtml += "<a href='javascript:' data-num='0'>下一页</a>";
					_btnBox.html(pageHtml);
					_btnBox.find("a").unbind().bind('click',function(){//上下页操作
						dataNum = $(this).attr("data-num");
						if(dataNum=="-1"){
							if(_page<=1){
								return;
							}
							_page = _page*1-1;
						}else if(dataNum=="0"){
							if(_page>=pageNum){
								return;
							}
							_page = _page*1+1;
						}else{
							_page = dataNum;
						}
						pageBoxFn();
					})
				},
				error:function(msg){
					_ops._error();
				}
			})
		}
		pageBoxFn();
	}
})(jQuery);