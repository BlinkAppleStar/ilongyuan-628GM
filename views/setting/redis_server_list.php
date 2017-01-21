<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Redis Server List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div class="body-content" >
        <table border="1">
            <tr>
                <th>LID</th>
                <th>IP</th>
                <th>端口</th>
                <th>密码</th>
                <th>是否激活</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $key => $val) { ?>
            <tr>
                <td><?php echo $val['lid'] ?></td>
                <td><?php echo $val['ip'] ?></td>
                <td><?php echo $val['port'] ?></td>
                <td><?php echo $val['password'] ?></td>
                <td><?php echo $val['active'] ? '激活' : '无效' ?></td>
                <td>
                    <a href="<?php echo Url::to('/setting/edit-redis-server?id='.$key); ?>" target="_blank">编辑</a>|
                    <a href="<?php echo Url::to('/setting/delete?table_name=redis_server&id='.$key.'&to_url='.Url::to('/setting/redis-server-list')); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?php echo Url::to('/setting/edit-redis-server'); ?>" target="_blank">添加</a>
    </div>
</div>
<script type="text/javascript">

</script>
