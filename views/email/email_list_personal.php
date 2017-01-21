<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Email List';
$this->params['breadcrumbs'][] = $this->title;
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
            <label>UID：</label><div class="controls"><input type="text" name="search_uid" id="search_uid" value=""></div>
            <label>Page：</label><div class="controls"><input type="text" name="page" id="page" value=""></div>
            <label>Page Size：</label><div class="controls"><input type="text" name="page_size" id="page_size" value=""></div>
            <input type="button" name="Search" value="搜索" class="sub_search" onclick="ajax_get_user_email()" />
        </form>
    </div>
    <div class="body-content">
        <table border="1" id="list_table">
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>内容</th>
                <th>发送时间</th>
                <th>是否有附件</th>
                <th>类型</th>
                <th>模板</th>
                <th>操作</th>
            </tr>
        </table>
        

    </div>
</div>
<script type="text/javascript">
function ajax_get_user_email()
{
    $.get('/email/list-personal',
        {
            uid:$('#search_uid').val(),
            page:$('#page').val(),
            page_size:$('#page_size').val()
        },
        function(ret){
            if (ret.ok) {
                html = '<tr>';
                html += '<th>ID</th>';
                html += '<th>标题</th>';
                html += '<th>内容</th>';
                html += '<th>发送时间</th>';
                html += '<th>是否有附件</th>';
                html += '<th>类型</th>';
                html += '<th>模板</th>';
                html += '<th>操作</th>';
                html += '</tr>';
                for (var id in ret.data) {
                    html += '<tr>';
                    html += '<td>'+id+'</td>';
                    html += '<td>'+ret.data[id].title+'</td>';
                    html += '<td>'+ret.data[id].content+'</td>';
                    html += '<td>'+ret.data[id].create_time+'</td>';
                    html += '<td>'+(ret.data[id].items.length > 0 ? '是' : '否')+'</td>';
                    html += '<td>'+ret.data[id].type+'</td>';
                    html += '<td>'+ret.data[id].template_id+'</td>';
                    html += '<td></td>';
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
</script>
