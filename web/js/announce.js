
function ajax_list(ajax_url) {

    $.get(ajax_url,
        {
            id:$('#id').val(),
            type:$('#type').val(),
            channel:$('#channel').val(),
            server_id:$('#server_id').val(),
            lang:$('#lang').val(),
            title_like:$('#title').val(),
            version:$('#version').val(),
            start_time_min:$('#start_time_min').val(),
            start_time_max:$('#start_time_max').val(),
            end_time_min:$('#end_time_min').val(),
            end_time_max:$('#end_time_max').val(),
            page:$('#page').val(),
            page_size:$('#page_size').val()
        },
        function(ret){
            if (ret.ok) {
                var html = '';
                html += 
                '<table border="1">'
                + '<tr>'
                +   '<th>ID</th>'
                +   '<th>类型</th>'
                +   '<th>渠道</th>'
                +   '<th>版本</th>'
                +   '<th>语言</th>'
                +   '<th>标题</th>'
                +   '<th>内容</th>'
                +   '<th>落款</th>'
                +   '<th>URL</th>'
                +   '<th>开始时间</th>'
                +   '<th>结束时间</th>'
                +   '<th>操作</th>'
                + '</tr>';

                for (var i in ret.data.list) {
                    html += '<tr>'
                    +   '<td>' + i + '</td>'
                    +   '<td>' + ret.data.list[i].type + '</td>'
                    +   '<td>' + ret.data.list[i].channel + '</td>'
                    +   '<td>' + ret.data.list[i].version + '</td>'
                    +   '<td>' + ret.data.list[i].lang + '</td>'
                    +   '<td>' + ret.data.list[i].title + '</td>'
                    +   '<td>' + ret.data.list[i].content + '</td>'
                    +   '<td>' + ret.data.list[i].inscribe + '</td>'
                    +   '<td>' + ret.data.list[i].url + '</td>'
                    +   '<td>' + ret.data.list[i].start_time +'</td>'
                    +   '<td>' + ret.data.list[i].end_time+'</td>'
                    +   '<td><a href="/announce/edit?id=' + i + '" target="_blank">编辑</a>|<a href="/announce/delete?id=' + i + '" target="_blank">删除</a></td>'
                    + '</tr>';
                }
                html += '</table>';
                $('#announce_list').html(html);
            }
        },
        'json'
    );
}

