<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Manager List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div class="body-content" >
        <table border="1">
            <tr>
                <th>ID</th>
                <th>账号</th>
                <th>密码</th>
                <th>邮箱</th>
                <th>真名</th>
                <th>创建时间</th>
                <th>最近登录时间</th>
                <th>是否激活</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $key => $val) { ?>
            <tr>
                <td><?php echo $key ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['password'] ?></td>
                <td><?php echo $val['email'] ?></td>
                <td><?php echo $val['real_name'] ?></td>
                <td><?php echo $val['created_time'] ?></td>
                <td><?php echo $val['last_login'] ?></td>
                <td><?php echo $val['status'] ? '激活' : '未激活' ?></td>
                <td>
                    <a href="<?php echo Url::to('/manager/edit?mongo_id='.$key); ?>" target="_blank">编辑</a>|
                </td>
            </tr>
            <?php } ?>
        </table>
        <a href="<?php echo Url::to('/manager/edit'); ?>" target="_blank">添加</a>
    </div>
</div>
<script type="text/javascript">

</script>
