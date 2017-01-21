
// 远程获取道具列表
var item_options_html = '';
function ajax_get_item_list()
{
    $.get('/setting/get-item-list',
        {},
        function(ret){
            if (ret.ok) {
                for (var id in ret.data) {
                    item_options_html += '<option value="' + id + '">' + id + ' ' + ret.data[id] + '</option>';
                }
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}

window.onload=function(){
      ajax_get_item_list();
}

var next_attach_id = 1;
// 页面增加附件DOM
function add_attach()
{
    var html = '<tr id="attach_tr_' + next_attach_id +'">';
    html += '<td><select >' + item_options_html + '</select></td>';
    html += '<td><input type="text" value="" size="10" /></td>';
    html += '<td><a href="javascript:;" onclick="delete_attach('+ next_attach_id +')">删除</a></td>';
    html += '</tr>';


    $('#attach_table').append(html);
    next_attach_id++;
}

// 提交保存
function ajax_send_email(is_area)
{
    var attachs = [];
    $("#attach_table tr").each(function(){
        current_attach = {
            'item_id' : $(this).find('select').val(),
            'item_count' : $(this).find("input").val()
        };
        attachs.push(current_attach);
    });
    //console.log(attachs);

    $.post('/email/send',
        {
            server_id: $('#server_id').val(),
            channel: $('#channel').val(),
            uids:$('#uids').val(),
            user_names: $('#user_names').val(),
            title: $('#title').val(),
            content: $('#content').val(),
            send_time:$('#send_time').val(),
            is_area:is_area,
            attachs:attachs
        },
        function(ret){
            if (ret.ok) {
                alert(ret.msg);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}

// 删除附件
function delete_attach(i)
{
    $('#attach_tr_'+i).remove();
}