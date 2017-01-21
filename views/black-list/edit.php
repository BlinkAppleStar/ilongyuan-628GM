<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Black List ' . $action;
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
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
            <label>UID: </label>
            <div class="infor_box">
                <input type="text" name="uid" value="<?php echo $model->attributes['uid'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>类型: </label>
            <div class="infor_box">
                <input type="radio" name="type" value="black" <?php echo $model->attributes['type'] == 'black' ? 'checked' : '' ?> />黑名单
                <input type="radio" name="type" value="white" <?php echo $model->attributes['type'] == 'white' ? '' : 'checked' ?> />白名单
            </div>
        </div>
        <div class="block tcenter">
            <label>有效时间: </label>
            <div class="infor_box">
                <input type="text" name="start_time" class="input_cont wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date('Y-m-d H:i:s', $model->attributes['start_time']) ?>">
                <span>到</span>
                <input type="text" name="end_time" class="input_cont wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="<?php echo date('Y-m-d H:i:s', $model->attributes['end_time']) ?>">
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
