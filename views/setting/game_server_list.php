<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Game Server List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div class="body-content" >
        <a href="<?php echo Url::to('/setting/redis-server-list'); ?>" target="_blank">管理Redis</a>
        <table border="1">
            <tr>
                <th>LID</th>
                <th>名字</th>
                <th>IP</th>
                <th>端口</th>
                <th>是否导量服</th>
                <th>是否激活</th>
                <th>有效期</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $key => $val) { ?>
            <tr>
                <td><?php echo $val['lid'] ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['ip'] ?></td>
                <td><?php echo $val['port'] ?></td>
                <td>
                    <input type="radio" name="import_server" <?php echo $val['input'] ? 'checked="checked"' : '' ?> onchange="ajax_set_import_server('<?php echo $val['lid'] ?>')" />
                </td>
                <td><?php echo $val['active'] ? '激活' : '无效' ?></td>
                <td><?php echo date('Y-m-d H:i:s', $val['start_time']) ?> 到 <?php echo date('Y-m-d H:i:s', $val['end_time']) ?> </td>
                <td>
                    <a href="<?php echo Url::to('/setting/edit-game-server?id='.$key); ?>" target="_blank">编辑</a>|
                    <a href="<?php echo Url::to('/setting/delete?table_name=game_server&id='.$key.'&to_url='.Url::to('/setting/game-server-list')); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?php echo Url::to('/setting/edit-game-server'); ?>" target="_blank">添加</a>
    </div>
</div>
<script type="text/javascript">
function ajax_set_import_server(lid)
{
    $.get('/setting/set-import-server',
        {
            lid:lid
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}
</script>
