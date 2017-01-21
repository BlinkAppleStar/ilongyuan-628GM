<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Black List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div class="body-content" >
        <table border="1">
            <tr>
                <th>类型</th>
                <th>IP</th>
                <th>UID</th>
                <th>昵称</th>
                <th>渠道</th>
                <th>起始时间</th>
                <th>结束时间</th>
                <th>创建时间</th>
                <th>操作人</th>
                <th>操作</th>
            </tr>
            <?php foreach ($data['list'] as $key => $val) { ?>
            <tr>
                <td><?php echo $val['type'] ?></td>
                <td><?php echo $val['ip'] ?></td>
                <td><?php echo $val['uid'] ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['channel'] ?></td>
                <td><?php echo $val['start_time'] ?></td>
                <td><?php echo $val['end_time'] ?></td>
                <td><?php echo $val['created_time'] ?></td>
                <td><?php echo $val['updater'] ?></td>
                <td>
                    <a href="<?php echo Url::to('/black-list/edit?mongo_id='.$key); ?>" target="_blank">编辑</a>|
                    <a href="<?php echo Url::to('/black-list/delete?id='.$key); ?>" target="_blank">删除</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?php echo Url::to('/black-list/edit'); ?>" target="_blank">添加黑/白名单</a><br />
        <a href="<?php echo Url::to('/black-list/ip-edit'); ?>" target="_blank">添加IP白名单</a>
    </div>
</div>
<script type="text/javascript">

</script>
