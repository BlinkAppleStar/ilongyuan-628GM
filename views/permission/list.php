<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Permission List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div class="body-content" >
        <table border="1">
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>描述</th>
                <th>类型</th>
                <th>值</th>
                <th>创建时间</th>
                <th>操作人</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $key => $val) { ?>
            <tr>
                <td><?php echo $key ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['desc'] ?></td>
                <td><?php echo $val['type'] ?></td>
                <td><?php echo $val['value'] ?></td>
                <td><?php echo $val['created_time'] ?></td>
                <td><?php echo $val['updater'] ?></td>
                <td>
                    <a href="<?php echo Url::to('/permission/edit?mongo_id='.$key); ?>" target="_blank">编辑</a>|
                    <a href="<?php echo Url::to('/permission/delete?mongo_id='.$key); ?>" target="_blank">删除</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?php echo Url::to('/permission/edit'); ?>" target="_blank">添加</a>
    </div>
</div>
<script type="text/javascript">

</script>
