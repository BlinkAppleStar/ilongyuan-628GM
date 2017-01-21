<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Redis Server ' . $action;
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
        <?php if ($model->mongo_id) { ?>
        <div class="block">
            <label>ID: </label>
            <div class="infor_box">
                <?php echo $model->mongo_id->__toString() ?>
                <input type="hidden" name="id" value="<?php echo $model->mongo_id->__toString() ?>" />
            </div>
        </div>
        <?php } ?>
        <div class="block">
            <label>区服LID: </label>
            <div class="infor_box">
                <input type="text" name="lid" value="<?php echo $model->attributes['lid'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>IP: </label>
            <div class="infor_box">
                <input type="text" name="ip" value="<?php echo $model->attributes['ip'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>端口: </label>
            <div class="infor_box">
                <input type="text" name="port" value="<?php echo $model->attributes['port'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>密码: </label>
            <div class="infor_box">
                <input type="text" name="password" value="<?php echo $model->attributes['password'] ?>" />
            </div>
        </div>
        <div class="block tcenter">
            <label>是否激活: </label>
            <div class="infor_box">
                <input type="radio" name="active" value="1" <?php echo $model->attributes['active'] ? 'checked' : '' ?> />是
                <input type="radio" name="active" value="0" <?php echo $model->attributes['active'] ? '' : 'checked' ?> />否
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
