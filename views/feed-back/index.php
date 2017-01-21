<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'FeedBack List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div>
        <form action="" class="searchBox" method="get">
            <div class="inforBox">
                <span class="sign"><label>UID：</label><div class="controls"><input type="text" name="uid" id="uid" value=""></div></span>
                <span class="sign"><label>昵称：</label><div class="controls"><input type="text" name="user_name" id="user_name" value=""></div></span>
                <span class="sign"><label>渠道：</label><div class="controls"><input type="text" name="channel" id="channel" value=""></div></span>
                <span class="sign"><label>渠道UID：</label><div class="controls"><input type="text" name="channel_uid" id="channel_uid" value=""></div></span>
                <span class="sign">
                    <label>区服：</label>
                    <div class="controls">
                        <select class="" name="server_id" id="server_id">
                            <option value="">全部</option>
                            <?php foreach ($server_list as $val) { ?>
                            <option value="<?php echo $val['lid'] ?>" >
                                <?php echo $val['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </span>
                <span class="sign"><label>页号：</label><div class="controls"><input type="text" name="page" id="page" value="1"></div></span>
                <span class="sign"><label>每页条数：</label><div class="controls"><input type="text" name="page_size" id="page_size" value="10"></div></span>
                <span class="sign"><label>提交时间：</label><div class="controls"><input type="text" name="created_time_min" class="input_cont wdate" id="created_time_min" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value=""><span>到</span><input type="text" name="created_time_max" class="input_cont wdate" id="created_time_max" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value=""></div></span>
                <span class="sign flr"><a href="<?php echo Url::to('/feed-back/edit'); ?>" class="sub_search" target="_blank">新增</a></span><br>
                <span class="sign flr"><input type="button" name="Search" value="搜索" class="sub_search" onclick="ajax_list()" /></span>
            </div>
        </form>
    </div>

    <div class="body-content" >
        <table border="1" id="content_list">

        </table>
    </div>
</div>
<script type="text/javascript">
// 搜索列表
function ajax_list()
{
    $.get('/feed-back/list',
        {
            channel_uid:$('#channel_uid').val(),
            server_lid:$('#server_lid').val(),
            channel: $('#channel').val(),
            uid: $('#uid').val(),
            user_name: $('#user_name').val(),
            created_time_min: $('#created_time_min').val(),
            created_time_max: $('#created_time_max').val(),
            page:$('#page').val(),
            page_size:$('#page_size').val()
        },
        function(ret){
            if (ret.ok) {
                html = '<tr>';
                html += '<th>ID</th>';
                html += '<th>昵称</th>';
                html += '<th>UID</th>';
                html += '<th>渠道</th>';
                html += '<th>渠道UID</th>';
                html += '<th>设备型号</th>';
                html += '<th>反馈内容</th>';
                html += '<th>提交时间</th>';
                html += '<th>玩家累计反馈次数</th>';
                html += '<th>回复人</th>';
                html += '<th>回复内容</th>';
                html += '<th>回复时间</th>';
                html += '<th>操作</th>';
                html += '</tr>';
                for (var id in ret.data.list) {
                    html += '<tr>';
                    html += '<td>'+id+'</td>';
                    html += '<td>'+ret.data.list[id].user_name+'</td>';
                    html += '<td>'+ret.data.list[id].uid+'</td>';
                    html += '<td>'+ret.data.list[id].channel+'</td>';
                    html += '<td>'+ret.data.list[id].channel_uid+'</td>';
                    html += '<td>'+ret.data.list[id].device_type+'</td>';
                    html += '<td>'+ret.data.list[id].question+'</td>';
                    html += '<td>'+ret.data.list[id].created_time+'</td>';
                    html += '<td>'+ret.data.list[id].feedback_count+'</td>';
                    html += '<td>'+(ret.data.list[id].manager ? ret.data.list[id].manager : '未回复')+'</td>';
                    html += '<td>';
                    html += '<textarea id="answer_' + id + '">' + ret.data.list[id].answer + '</textarea>';
                    html += '</td>';
                    html += '<td>'+ret.data.list[id].answer_time+'</td>';
                    html += '<td>';
                    html += '<a href="/static/userdata.html?id=' + ret.data.list[id].uid + '" target="_blank">玩家详情</a>|';
                    html += '<a href="javascript:;" onclick="ajax_answer(' + "'" + id + "'" + ')">回复</a>|';
                    html += '</td>';
                    html += '</tr>';
                }
                $('#content_list').html(html);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}

function ajax_answer(id)
{
    $.post('/feed-back/answer',
        {
            mongo_id:id,
            answer:$('#answer_'+id).val()
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}
</script>
