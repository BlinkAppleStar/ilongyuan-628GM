<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Manager Permission List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div>
        <form action="" class="searchBox" method="get">
            <div class="inforBox">
                <span class="sign"><label>ID：</label><div class="controls"><input type="text" name="id" id="id" value=""></div></span>
                <span class="sign"><label>权限描述：</label><div class="controls"><input type="text" name="desc" id="desc" value=""></div></span>
                <span class="sign"><label>权限名称：</label><div class="controls"><input type="text" name="name" id="name" value=""></div></span>
                <span class="sign"><label>管理员ID：</label><div class="controls"><input type="text" name="manager_id" id="manager_id" value=""></div></span>
                <span class="sign"><label>页号：</label><div class="controls"><input type="text" name="page" id="page" value="1"></div></span>
                <span class="sign"><label>每页条数：</label><div class="controls"><input type="text" name="page_size" id="page_size" value="10"></div></span>
                <span class="sign flr"><a href="<?php echo Url::to('/permission/list'); ?>" class="sub_search" target="_blank">管理权限</a></span><br>
                <span class="sign flr"><a href="<?php echo Url::to('/permission/grant-manager-index'); ?>" class="sub_search" target="_blank">新增</a></span><br>
                <span class="sign flr"><input type="button" name="Search" value="搜索" class="sub_search" onclick="ajax_list()" /></span>

                
            </div>
        </form>
    </div>
    <div class="body-content" id="content_list">
        <table border="1">
            
        </table>
    </div>
</div>
<script type="text/javascript">
function ajax_list()
{
    $.get('/permission/manager-list',
        {
            id:$('#id').val(),
            name:$('#name').val(),
            desc:$('#desc').val(),
            manager_id:$('#manager_id').val(),
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
                +   '<th>权限</th>'
                +   '<th>描述说明</th>'
                +   '<th>授权给</th>'
                +   '<th>授权时间</th>'
                +   '<th>操作人</th>'
                +   '<th>操作</th>'
                + '</tr>';

                for (var i in ret.data.list) {
                    html += '<tr>'
                    +   '<td>' + i + '</td>'
                    +   '<td>' + ret.data.list[i].type + '</td>'
                    +   '<td>' + ret.data.list[i].value + ' '+ ret.data.list[i].name + '</td>'
                    +   '<td>' + ret.data.list[i].desc + '</td>'
                    +   '<td>' + ret.data.list[i].manager + '</td>'
                    +   '<td>' + ret.data.list[i].created_time + '</td>'
                    +   '<td>' + ret.data.list[i].updater + '</td>'
                    +   '<td><a href="javascript:;" onclick="ajax_delete(' + i + ')" target="_blank">删除</a></td>'
                    + '</tr>';
                }
                html += '</table>';
                $('#content_list').html(html);
            }
        },
        'json'
    );
}

function ajax_delete(id)
{
    $.get('/permission/remove-manager',
        {
            id:id
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}
</script>
