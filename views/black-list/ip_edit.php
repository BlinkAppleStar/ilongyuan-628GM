<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'IP List ' . $action;
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
            <label>IP: </label>
            <div class="infor_box">
                <input type="text" name="ip" value="<?php echo $model->attributes['ip'] ?>" />
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
