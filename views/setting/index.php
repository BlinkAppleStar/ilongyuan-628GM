<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = ucfirst($table_name) . ' List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div class="body-content" >
        <table border="1">
            <tr>
                <th>ID</th>
                <th>名字</th>
                <th>是否激活</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $key => $val) { ?>
            <tr>
                <td><?php echo $key ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['active'] ? '激活' : '无效' ?></td>
                <td>
                    <a href="<?php echo Url::to('/setting/edit?table_name='.$table_name.'&id='.$key); ?>" target="_blank">编辑</a>|
                    <a href="<?php echo Url::to('/setting/delete?table_name='.$table_name.'&id='.$key.'&to_url='. Url::to('/setting/index?table_name='.$table_name)); ?>" >删除</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?php echo Url::to('/setting/edit?table_name='.$table_name); ?>" target="_blank">添加</a>
    </div>
</div>
<script type="text/javascript">

</script>
