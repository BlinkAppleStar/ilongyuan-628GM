<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Permission ' . $action;
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
            <label>权限名称: </label>
            <div class="infor_box">
                <input type="text" name="name" value="<?php echo $model->attributes['name'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>权限描述: </label>
            <div class="infor_box">
                <input type="text" name="desc" value="<?php echo $model->attributes['desc'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>权限类型: </label>
            <div class="infor_box">
                <input type="radio" name="type" value="manager" checked /> 管理员访问权限
            </div>
        </div>
        <div class="block">
            <label>权限值: </label>
            <div class="infor_box">
                <input type="radio" name="value" value="allow" <?php echo $model->attributes['value'] != 'denial' ? 'checked' : '' ?> />允许
                <input type="radio" name="value" value="denial" <?php echo $model->attributes['value'] != 'denial' ? '' : 'checked' ?> />不允许
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
