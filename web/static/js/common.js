pageUrl="";//gm地址
ajaxUrl="http://dataportal.ilongyuan.com.cn";//其它地址
tokens = '6998ccb31db2888a18be4838fee5ae44';//登录临时TOKEN
allPageNum = '15';//每页显示条数

//获取渠道，区服数据
if($('#channel_select').length != 0 || $('#gameArea_select').length != 0){
	$.ajax({
		url: ajaxUrl+"/portal/eol/getChannelGameArea.do",
		type: "get",
		dataType: "json",
		data:{
			token: tokens
		},
		success: function(data){
			var html_channel = '<option></option>',html_gameArea = '<option></option>',
				data_channel = data.data.channel.split(","),data_gameArea = data.data.gameArea.split(",");
			for(var i in data_channel){
				html_channel += "<option>"+ data_channel[i] +"</option>";
			}
			for(var i in data_gameArea){
				html_gameArea += "<option>"+ data_gameArea[i] +"</option>";
			}
			$('#channel_select').html(html_channel),
			$('#gameArea_select').html(html_gameArea);
		}
	})
}
//时间戳转日期
function formatDate(d) {
    if(!(d == null|| d == 0)){
        d = parseFloat(d);
        var  now = new Date(d);    
        var  year = now.getFullYear();     
        var  month = now.getMonth() + 1 >= 10 ? now.getMonth() + 1 : "0"+(now.getMonth() + 1);     
        var  date = now.getDate() >= 10 ? now.getDate() : "0" + now.getDate();       
        return  year+"-"+month+"-"+date;
    }else{
        return  "";
    }     
}
//时间戳转时间 2010-10-20 10:00:00
function getLocalTime(nS) {
    return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
}
(function(){
	$.fn.settiongFn = function(ops){
		var _ops = $.extend({
			_value:false,
			_state:false, //是否需要去除空选项
			_url:"",
			_data:"",
			_type:"get",
			_dataType:"json",
			_postStr: "" //传入匹配字段
		},ops),_html,_this = $(this);
		$.ajax({
			url:_ops._url,
			data:_ops._data,
			type:_ops._type,
			dataType:_ops._dataType,
			success:function(data){
				if(_ops._state){
					_html = "";
				}else{

					if(_ops._value){
						_html = "<option value=''></option>";
					}else{
						_html = "<option></option>";
					}
				}
				for(var i in data.data){
					if(_ops._value){
						if(data.data[i].name == _ops._postStr){
							_html += "<option selected>"+ data.data[i].name +"</option>";
						}else{
							_html += "<option value='"+i+"'>"+ data.data[i].name +"</option>";
						}

					}else{
						if(data.data[i].name == _ops._postStr){
							_html += "<option selected>"+ data.data[i].name +"</option>";
						}else{
							_html += "<option>"+ data.data[i].name +"</option>";
						}
					}
				}
				_this.html(_html);
			}
		})
	}
})(jQuery);
(function($){  
    //表格排序插件  
    $.extend($,{  
        //命名空间  
        sortTable:{  
            sort:function(tableId,Idx){ //Idx为选择排序的列号，从0开始 
                var table = document.getElementById(tableId);  
                var tbody = table.tBodies[0];  
                var tr = tbody.rows;   
          
                var trValue = new Array();  
                for (var i=0; i<tr.length; i++ ) {  
                    trValue[i] = tr[i];  //将表格中各行的信息存储在新建的数组中  
                }  
          
                if (tbody.sortCol == Idx) {  
                    trValue.reverse(); //如果该列已经进行排序过了，则直接对其反序排列  
                } else {  
                    //trValue.sort(compareTrs(Idx));  //进行排序  
                    trValue.sort(function(tr1, tr2){  
                        var value1 = tr1.cells[Idx].innerHTML;  
                        var value2 = tr2.cells[Idx].innerHTML;  
                        return value2.localeCompare(value1);  
                    });  
                }  
          
                var fragment = document.createDocumentFragment();  //新建一个代码片段，用于保存排序后的结果  
                for (var i=0; i<trValue.length; i++ ) {  
                    fragment.appendChild(trValue[i]);  
                }  
          
                tbody.appendChild(fragment); //将排序的结果替换掉之前的值  
                tbody.sortCol = Idx;  
            }  
        }  
    });         
})(jQuery);
