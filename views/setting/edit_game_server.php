<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Game Server ' . $action;
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
        <!--
        <div class="block">
            <label>唯一ID: </label>
            <div class="infor_box">
                <input type="text" name="fid" value="<?php echo $model->attributes['id'] ?>" />
            </div>
        </div>
        -->
        <div class="block">
            <label>名字: </label>
            <div class="infor_box">
                <input type="text" name="name" value="<?php echo $model->attributes['name'] ?>" />
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
            <label>有效期: </label>
            <div class="infor_box">
                <input type="text" name="start_time" class="input_cont wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date('Y-m-d H:i:s', $model->attributes['start_time']) ?>">
                <span>到</span>
                <input type="text" name="end_time" class="input_cont wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="<?php echo date('Y-m-d H:i:s', $model->attributes['end_time']) ?>">
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
                <input type="hidden" name="set_import" value="<?php echo $model->attributes['input'] ?>" />
                <input type="submit" name="submit" value="提 交" class="btn-primary btn btn_submit" />
            </div>
        </div>
        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>

</div>
<script type="text/javascript">


</script>
