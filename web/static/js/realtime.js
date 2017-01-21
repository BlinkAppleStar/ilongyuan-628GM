$(function(){
	var nums = 5,//间隔时长，单位分
	tokens = "6998ccb31db2888a18be4838fee5ae44",
	datas ={token:tokens,unit:nums},//数据
	times = 120;//间隔刷新数据，时间单位秒
	$("#timeDataBtn").bind('click',function(){
		datas = $("#timeDataBox").serialize()+"&token="+tokens+"&unit="+nums;
		realtimeFn();
	});
    setInterval(realtimeFn,times*1000)
    realtimeFn();
    function realtimeFn(){
	    $.ajax({
	        url:ajaxUrl+"/portal/eol/getCurrentOnLineData.do",
	        data:datas,
	        type:"post",
	        dataType:"json",
	        success:function(data){
	            timeFn(data.data)
	        },
	        error:function(msg){
	            alert("加载失败，请刷新重试！");
	        }
	    })
    }
    function timeFn(data){
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var app = {},arryStr1=[],arryStr2=[],times=[];
        for(key in data){
            if(key!=='time'){
                var date=new Date(key).getFullYear()+"-"+(new Date(key).getMonth() + 1)+"-"+new Date(key).getDate();
                arryStr1.push(date);
                arryStr2.push(data[key]);
            }
        }
        for(k in data.time){
            times.push(data.time[k]);
        }
        option = null;
        option = {
            color:["#ff1e6d","#ffc000","#4f00e1"],
            title: {
                text: '数据列表',
                left:"15"
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:arryStr1,
                right:"12",
                y:"20"
            },
            grid: {
                top:"50",
                left: '20',
                right: '20',
                bottom: '50',
                containLabel: true
            },
            /*toolbox: {
                feature: {saveAsImage: {}}
            },*/
            dataZoom: [
                {
                    show: true,
                    realtime: true,
                    start: 0,
                    end:100
                },
                {
                    type: 'inside',
                    realtime: true,
                    start: 0,
                    end:100
                }
            ],
            xAxis: {
                type: 'category',
                data: times,
                boundaryGap: false
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:arryStr1[0],
                    type:'line',
                    data:arryStr2[0]
                },
                {
                    name:arryStr1[1],
                    type:'line',
                    data:arryStr2[1]
                },
                {
                    name:arryStr1[2],
                    type:'line',
                    data:arryStr2[2]
                }
            ]
        };
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
            window.onresize = myChart.resize;
        }
    }
})