<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Manager ' . $action;
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">
    <?php if ($msg) { ?>
    <div class="jumbotron">
        <?php echo $msg ?>
    </div>
    <?php } ?>
    
    <div class="jumbotron discribe">
        <form action="" method="post">
        <div class="block">
            <label>ID: </label>
            <div class="infor_box">
                <input type="text" name="mongo_id" value="<?php echo $model->mongo_id ? $model->mongo_id->__toString() : '' ?>" />
            </div>
        </div>
        <div class="block">
            <label>登录昵称: </label>
            <div class="infor_box">
                <input type="text" name="name" value="<?php echo $model->attributes['name'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>登录密码: </label>
            <div class="infor_box">
                <input type="text" name="password" value="<?php echo $model->attributes['password'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>Email: </label>
            <div class="infor_box">
                <input type="text" name="email" value="<?php echo $model->attributes['email'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>真实姓名: </label>
            <div class="infor_box">
                <input type="text" name="real_name" value="<?php echo $model->attributes['real_name'] ?>" />
            </div>
        </div>
        <div class="block tcenter">
            <label>是否激活: </label>
            <div class="infor_box">
                <input type="radio" name="status" value="1" <?php echo $model->attributes['status'] ? 'checked' : '' ?> />是
                <input type="radio" name="status" value="0" <?php echo $model->attributes['status'] ? '' : 'checked' ?> />否
            </div>
        </div>
        <div class="block tcenter">
            <div> </div>
            <div>
                <input type="submit" name="submit" value="提 交" class="btn-primary btn btn_submit" />
            </div>
        </div>
        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>

</div>
<script type="text/javascript">


</script>
