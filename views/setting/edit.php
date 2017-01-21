<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = ucfirst($table_name) . ' ' . $action;
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
                <input type="text" name="id" value="<?php echo $model->mongo_id ? $model->mongo_id->__toString() : '' ?>" />
            </div>
        </div>
        <div class="block">
            <label>名字: </label>
            <div class="infor_box">
                <input type="text" name="name" value="<?php echo $model->attributes['name'] ?>" />
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
