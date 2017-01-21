
/*
    生成分页按钮
*/
// page 当前页
// total 总页数
// page_size 分页条数
// type 1 建筑，2 科技, 3士兵
function page_html(page, total, page_size, type)
{
    var total_page = parseInt((total - 1) / page_size) + 1;
    var from = parseInt(page - 1) * page_size + 1;
    var to = 0;
    if (page == total_page) {
        to = total;
    } else {
        to = from + page_size - 1;
    }
    var html = '';
    if (total_page > 1) {
        if (page > 1) {
            html += ' <a href="javascript:;" onclick="ajax_list' + "('1', '" + type + "')" + '">[首页]</a> ';
            html += ' <a href="javascript:;" onclick="ajax_list' + "('" + parseInt(page - 1) + "', '" + type + "')" + '">[上一页]</a> ';
        }
        html += ' 第<input type="text" size="5" value="' + page + '" onkeydown="jump_to($(this),' + "'" + type + "'" + ', event)" />页 共' + total_page + '页 ';
        if (page < total_page) {
            html += ' <a href="javascript:;" onclick="ajax_list' + "('" + (parseInt(page) + 1) + "', '" + type + "')" + '">[下一页]</a> ';
            html += ' <a href="javascript:;" onclick="ajax_list' + "('" + total_page + "', '" + type + "')" + '">[末页]</a> ';
        }
        html += ' <div> 显示'+ from +'到'+ to +'，共'+ total +'条记录 </div>';
    }

    return html;
}


function show_hide(btn, do_ajax)
{
    var type = btn.attr('data-type');
    if (btn.html() == '展开') {
        if (do_ajax) {
            ajax_list(1, type);
        }
        btn.html('收起');
        $('#'+ type +'_list').show();
    } else {
        btn.html('展开');
        $('#'+ type +'_list').hide();
    }
}


function ajax_list(page, type) {
    if (type=='build') {
        page_size = 30;
    } else {
        page_size = 10;
    }

    $.get(ajax_url,
        {
            id:uid,
            type:type,
            page:page,
            page_size:page_size
        },
        function(ret){
            if (ret.ok) {
                var html = '';
                switch (type) {
                    case 'build':
                        html += 
                        '<table border="1">'
                        + '<tr>'
                        +   '<th>ID</th>'
                        +   '<th>LID</th>'
                        +   '<th>名称</th>'
                        +   '<th>等级</th>'
                        +   '<th>HP</th>'
                        +   '<th>STATE</th>'
                        +   '<th>是否正在升级</th>'
                        +   '<th>升级剩余时间(DONE_TIME)</th>'
                        +   '<th>BUILD_QUEUE_INDEX</th>'
                        +   '<th>HARVEST_BEGIN_TIME</th>'
                        +   '<th>HARVEST_BEGIN_BID</th>'
                        +   '<th>SUB_INDEX</th>'
                        +   '<th>BEHELPED_TIMES</th>'
                        +   '<th>HELP_ASKED</th>'
                        //+   '<th>SUB_INDEX</th>'
                        + '</tr>';
                        for (var id in ret.data.list) {
                            html += '<tr>'
                            +   '<td>' + ret.data.list[id].values[1] + '</td>'
                            +   '<td>' + ret.data.list[id].values[2] + '</td>'
                            +   '<td>' + ret.data.name_list[ret.data.list[id].values[1]] + '</td>'
                            +   '<td>' + ret.data.list[id].values[3] + '</td>'
                            +   '<td>' + ret.data.list[id].values[4] + '</td>'
                            +   '<td>' + ret.data.list[id].values[5] + '</td>'
                            +   '<td>' + (ret.data.list[id].values[6] > 0 ? '是' : '否') + '</td>'
                            +   '<td>' + ret.data.list[id].values[6] + '</td>'
                            +   '<td>' + ret.data.list[id].values[7] + '</td>' 
                            +   '<td>' + ret.data.list[id].values[8] + '</td>' 
                            +   '<td>' + ret.data.list[id].values[9] + '</td>' 
                            +   '<td>' + ret.data.list[id].values[10] + '</td>' 
                            +   '<td>' + ret.data.list[id].values[11] + '</td>' 
                            +   '<td>' + ret.data.list[id].values[12] + '</td>' 
                        //    +   '<td>' + ret.data.list[id].values[10] + '</td>'
                            + '</tr>';
                        }
                        html += '</table>';
                        break;
                    case 'tech':
                        html += 
                        '<table border="1">'
                        + '<tr>'
                        +   '<th>ID</th>'
                        +   '<th>名称</th>'
                        +   '<th>等级</th>'
                        +   '<th>是否正在升级</th>'
                        +   '<th>升级剩余时间(LEVELUP_TIME)</th>'
                        + '</tr>';
                        for (var id in ret.data.list) {
                            html += '<tr>'
                            +   '<td>' + ret.data.list[id].values[1] + '</td>'
                            +   '<td>' + ret.data.name_list[ret.data.list[id].values[1]] + '</td>'
                            +   '<td>' + ret.data.list[id].values[1].toString().substr(-3) + '</td>'
                            +   '<td>' + (ret.data.list[id].values[2] > 0 ? '是' : '否') + '</td>'
                            +   '<td>' + ret.data.list[id].values[2] + '</td>'
                            + '</tr>';
                        }
                        html += '</table>';
                        break;
                    case 'soldier':
                        html += 
                        '<table border="1">'
                        + '<tr>'
                        +   '<th>ID</th>'
                        +   '<th>名称</th>'
                        +   '<th>数量(NUM)</th>'
                        +   '<th>生产数量(PRODUCE_NUM)</th>'
                        +   '<th>生产时间(PRODUCE_TIME)</th>'
                        +   '<th>重生数量(RELIVE_NUM)</th>'
                        +   '<th>重生时间(RELIVE_TIME)</th>'
                        +   '<th>受伤数量(INJURED_NUM)</th>'
                        +   '<th>阵亡数量(DIED_NUM)</th>'
                        +   '<th>外派数量(COMBAT_NUM)</th>'
                        +   '<th>取自城市(TAKE_OUT_FROM_CITY)</th>'
                        + '</tr>';
                        for (var id in ret.data.list) {
                            html += '<tr>'
                            +   '<td>' + ret.data.list[id].values[1] + '</td>'
                            +   '<td>' + ret.data.name_list[ret.data.list[id].values[1]] + '</td>'
                            +   '<td>' + ret.data.list[id].values[3] + '</td>'
                            +   '<td>' + ret.data.list[id].values[4] + '</td>'
                            +   '<td>' + ret.data.list[id].values[5] + '</td>'
                            +   '<td>' + ret.data.list[id].values[6] + '</td>'
                            +   '<td>' + ret.data.list[id].values[7] + '</td>'
                            +   '<td>' + ret.data.list[id].values[8] + '</td>'
                            +   '<td>' + ret.data.list[id].values[9] + '</td>'
                            +   '<td>' + ret.data.list[id].values[14] + '</td>'
                            +   '<td>' + ret.data.list[id].values[11] + '</td>'
                            + '</tr>';
                        }
                        html += '</table>';
                        break;
                    case 'item':
                        html += 
                        '<table border="1">'
                        + '<tr>'
                        +   '<th>ID(TYPE)</th>'
                        +   '<th>名称</th>'
                        +   '<th>数量(COUNT)</th>'
                        +   '<th>操作</th>'
                        + '</tr>';
                        for (var id in ret.data.list) {
                            html += '<tr id="tr_item_' + ret.data.list[id].values[1] + '">'
                            +   '<td>' + ret.data.list[id].values[1] + '</td>'
                            +   '<td>' + ret.data.name_list[ret.data.list[id].values[1]] + '</td>'
                            +   '<td><input type="text" size="1" id="item_'+ ret.data.list[id].values[1] +'" value="'+ ret.data.list[id].values[2] +'" /></td>'
                            +   '<td><a href="javascript:;" onclick="ajax_edit_item('+ ret.data.list[id].values[1] +')">保存</a> | <a href="javascript:;" onclick="ajax_delete_item('+ret.data.list[id].values[1]+')">删除</a></td>'
                            + '</tr>';
                        }
                        html += '</table>';
                        break;
                    case 'combat':
                        html += 
                        '<table border="1">'
                        + '<tr>'
                        +   '<th>ID(KEY)</th>'
                        +   '<th>队列士兵信息</th>'
                        +   '<th>战斗状态(STATE)</th>'
                        +   '<th>队列类型(BATTLE_TYPE)</th>'
                        +   '<th>队列目的地(END_POS)</th>'
                        +   '<th>当前状态结束剩余时间(STATE_TIME)</th>'
                        + '</tr>';
                        for (var key in ret.data.list) {
                            html += '<tr>'
                            +   '<td>' + key + '</td>'
                            +   '<td>待定</td>'
                            +   '<td>' + ret.data.list[key].state + '</td>'
                            +   '<td>' + ret.data.list[key].type + '</td>'
                            +   '<td>' + ret.data.list[key].end_pos + '</td>'
                            +   '<td>' + ret.data.list[key].state_time + '</td>'
                            + '</tr>';
                        }
                        html += '</table>';
                        break;
                    default:
                        break;
                }
                html += page_html(ret.data.page, ret.data.total, page_size, type);
                $('#' + type + '_list').html(html);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}


// 输入框回车跳转到指定页
function jump_to(obj, type, e)
{
    var e = e || window.event;
    if (e.keyCode == 13) {
        ajax_list(obj.val(), type);
    }
}

// 更新资产
function ajax_set_resource(url, uid)
{
    var resource = [];
    for (var i=1; i<=19; i++)
    {
        resource[i] = $('#resource_' + i).val();
    }

    $.post(url,
        {
            uid:uid,
            resource:resource,
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}

// 编辑道具
function ajax_edit_item(item_id)
{
    $.post(edit_item_url,
        {
            uid:uid,
            item_id:item_id,
            count:$('#item_'+item_id).val()
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}

// 新增道具
function ajax_create_item()
{
    $.post(edit_item_url,
        {
            uid:uid,
            item_id:$('#new_item_id').val(),
            count:$('#new_item_value').val()
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}

// 删除道具
function ajax_delete_item(item_id)
{
    $.post(delete_item_url,
        {
            uid:uid,
            item_id:item_id
        },
        function(ret){
            alert(ret.msg);
            if (ret.ok) {
                $('#tr_item_'+item_id).hide();
            }
        },
        'json'
    );
}

// 更新建筑等级
function ajax_set_building_level(url, uid)
{
    var level = $('#build_level').val();
    if (level < 4) {
        alert('3级以下请手动升级');
    } else {
        $.get(url,
            {
                uid:uid,
                level:level,
            },
            function(ret){
                alert(ret.msg);
                if (ret.ok) {
                    ajax_list(1, 'build');
                }
            },
            'json'
        );
    }
    
}