<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'FeedBack ' . $action;
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
            <label>渠道: </label>
            <div class="infor_box">
                <input type="text" name="channel" value="<?php echo $model->attributes['channel'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>渠道UID: </label>
            <div class="infor_box">
                <input type="text" name="channel_uid" value="<?php echo $model->attributes['channel_uid'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>设备类型: </label>
            <div class="infor_box">
                <input type="text" name="device_type" value="<?php echo $model->attributes['device_type'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>反馈内容: </label>
            <div class="infor_box">
                <input type="text" name="question" value="<?php echo $model->attributes['question'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>区服LID: </label>
            <div class="infor_box">
                <input type="text" name="server_lid" value="<?php echo $model->attributes['server_lid'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>答复内容: </label>
            <div class="infor_box">
                <input type="text" name="answer" value="<?php echo $model->attributes['answer'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>答复人ID: </label>
            <div class="infor_box">
                <input type="text" name="answer_by" value="<?php echo $model->attributes['answer_by'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>答复时间: </label>
            <div class="infor_box">
                <input type="text" name="answer_time" class="input_cont wdate" value="<?php echo $model->attributes['answer_time'] ?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
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
