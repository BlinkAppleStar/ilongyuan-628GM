<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Email Queue List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>
<!--
    <div>
        切换服务器：
        <select class="" name="server_id" id="server_id" onchange="ajax_set_server($(this), '<?php echo Url::to('/setting/redis-server'); ?>')">
            <?php  foreach ((array)$server_list as $val) { ?>
            <option value="<?php echo $val['_id'] ?>" >
                <?php echo $val['name'] ?>
            </option>
            <?php } ?>
        </select>
        当前Redis：<?php echo $redis_host ?>
        端口：<?php echo $redis_port ?>
    </div>
-->
    <div>
        <form action="" class="searchBox" method="post">
            <div class="inforBox">
                <span class="sign">
                    <label>区服：</label>
                    <div class="controls">
                        <select class="" name="server_id" id="server_id">
                            <option value="">全部</option>
                            <?php  foreach ($server_list as $val) { ?>
                            <option value="<?php echo $val['_id'] ?>" >
                                <?php echo $val['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </span>
                <span class="sign">
                    <label>渠道：</label>
                    <div class="controls">
                        <select class="" name="channel" id="channel">
                            <option value="">全部</option>
                            <?php foreach ((array)$channel_list as $val) { ?>
                            <option value="<?php echo $val['name'] ?>" >
                                <?php echo $val['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </span>
                <span class="sign">
                    <label>关键词：</label>
                    <div class="controls">
                        <input type="text" name="keyword" class="input_cont" id="keyword" value="">
                    </div>
                </span>
                <span class="sign">
                    <label>页号：</label>
                    <div class="controls">
                        <input type="text" name="page" class="input_cont" id="page" value="">
                    </div>
                </span>
                <span class="sign">
                    <label>页大小：</label>
                    <div class="controls">
                        <input type="text" name="page_size" class="input_cont" id="page_size" value="">
                    </div>
                </span>
                <span class="sign">
                    <label>发送时间：</label>
                    <div class="controls">
                        从
                        <input type="text" name="send_time_min"class="input_cont wdate" id="send_time_min" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="">
                        到
                        <input type="text" name="send_time_max"class="input_cont wdate" id="send_time_max" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="">
                    </div>
                </span>
            </div>

            <input type="button" name="Search" value="搜索" class="sub_search" onclick="ajax_get_queue()" />
            <a href="<?php echo Url::to('/email/view-send-index'); ?>" class="sub_search" target="_blank">发送单人邮件</a>
            <a href="<?php echo Url::to('/email/view-send-area-index'); ?>" class="sub_search" target="_blank">发送区服邮件</a>
            <a href="<?php echo Url::to('/email/view-personal'); ?>" class="sub_search" target="_blank">查看个人邮件</a>
        </form>
    </div>
    <div class="body-content">
        <table border="1" id="list_table">

        </table>
        

    </div>
</div>
<script type="text/javascript">
// 搜索列表
function ajax_get_queue()
{
    $.get('/email/queue-list',
        {
            server_id:$('#server_id').val(),
            channel:$('#channel').val(),
            send_time_min: $('#send_time_min').val(),
            send_time_max: $('#send_time_max').val(),
            keyword: $('#keyword').val(),
            page:$('#page').val(),
            page_size:$('#page_size').val()
        },
        function(ret){
            if (ret.ok) {
                html = '<tr>';
                html += '<th>ID</th>';
                html += '<th>标题</th>';
                html += '<th>内容</th>';
                html += '<th>渠道</th>';
                html += '<th>区服</th>';
                html += '<th>提交时间</th>';
                html += '<th>发送时间</th>';
                html += '<th>类型</th>';
                html += '<th>状态</th>';
                html += '<th>收件人ID</th>';
                html += '<th>收件人昵称</th>';
                html += '<th>附件</th>';
                html += '<th>操作</th>';
                html += '</tr>';
                for (var id in ret.data.list) {
                    html += '<tr>';
                    html += '<td>'+id+'</td>';
                    html += '<td>'+ret.data.list[id].title+'</td>';
                    html += '<td>'+ret.data.list[id].content+'</td>';
                    html += '<td>'+ret.data.list[id].channel+'</td>';
                    html += '<td>'+ret.data.list[id].server+'</td>';
                    html += '<td>'+ret.data.list[id].created_time+'</td>';
                    html += '<td><input type="" value="' + ret.data.list[id].send_time + '" id="send_time_' + id + '" onclick="WdatePicker({dateFmt:\'yyyy-MM-dd HH:mm:ss\'})" /></td>';
                    html += '<td>'+(ret.data.list[id].uid.length > 0 || ret.data.list[id].uname.length > 0 ? '个人邮件' : '区服邮件')+'</td>';
                    html += '<td>'+(ret.data.list[id].send_success > 0 ? '已发送' : '未发送') +'</td>';
                    html += '<td>';
                    for (var i in ret.data.list[id].uid) {
                        html += ret.data.list[id].uid[i] + '-';
                    }
                    html += '</td>';
                    html += '<td>';
                    for (var i in ret.data.list[id].uname) {
                        html += ret.data.list[id].uname[i] + '-';
                    }
                    html += '</td>';
                    html += '<td>';
                    for (var i in ret.data.list[id].attachs) {
                        html += ret.data.list[id].attachs[i].item_name + ' => ' + ret.data.list[id].attachs[i].item_count + '<br />';
                    }
                    html += '</td>';
                    html += '<td>';
                    if (ret.data.list[id].send_success <= 0) {
                        html += '<a href="javascript:;" onclick="ajax_update('+ "'" + id + "'" +')">修改</a>';
                        html += '<a href="/email/delete?id=' + id + '">删除</a>';
                    }
                    html += '</td>';
                    html += '</tr>';
                }
                $('#list_table').html(html);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}

function ajax_update(id)
{
    $.get('/email/update-send-time',
        {
            id:id,
            send_time:$('#send_time_' + id).val()
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}

</script>
