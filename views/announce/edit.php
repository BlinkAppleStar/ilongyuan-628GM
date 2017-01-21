<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Announcement ' . $action;
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
            <label>渠道: </label>
            <div class="infor_box">
                <select class="" name="channel">
                    <option value="">全部</option>
                    <?php foreach ($channel_list as $val) { ?>
                    <option value="<?php echo $val['name'] ?>" <?php echo $val['name'] == $model->attributes['channel'] ? 'checked' : '' ?> >
                        <?php echo $val['name'] ?>
                    </option>
                    <?php } ?>
                </select>
                <a href="<?php echo Url::to('/setting/index?table_name=channel'); ?>" target="_blank">管理</a>
            </div>
        </div>
        <div class="block">
            <label>区服: </label>
            <div class="infor_box">
                <select class="" name="server_id">
                    <option value="">全部</option>
                    <?php  foreach ($server_list as $val) { ?>
                    <option value="<?php echo $val['_id'] ?>" <?php echo strval($val['_id']) == strval($model->attributes['server_id']) ? 'selected' : '' ?> >
                        <?php echo $val['name'] ?>
                    </option>
                    <?php } ?>
                </select>
                <a href="<?php echo Url::to('/setting/game-server-list'); ?>" target="_blank">管理</a>
            </div>
        </div>
        <div class="block">
            <label>类型: </label>
            <div class="infor_box">
                <select class="" name="type">
                    <option value="after_login" <?php echo $model->attributes['type'] == 'after_login' ? 'selected' : '' ?>>登录后</option>
                    <option value="before_login" <?php echo $model->attributes['type'] == 'before_login' ? 'selected' : '' ?>>登录前</option>
                </select>
            </div>
        </div>
        <div class="block">
            <label>语言: </label>
            <div class="infor_box">
                <select class="" name="lang">
                    <option value="">全部</option>
                    <?php foreach ($language_list as $val) { ?>
                    <option value="<?php echo $val['name'] ?>" <?php echo $val['name'] == $model->attributes['lang'] ? 'checked' : '' ?> >
                        <?php echo $val['name'] ?>
                    </option>
                    <?php } ?>
                </select>
                <a href="<?php echo Url::to('/setting/index?table_name=language'); ?>" target="_blank">管理</a>
            </div>
        </div>
        <div class="block">
            <label>版本: </label>
            <div class="infor_box">
                <select class="" name="version">
                    <option value="">全部</option>
                    <?php foreach ($version_list as $val) { ?>
                    <option value="<?php echo $val['name'] ?>" <?php echo $val['name'] == $model->attributes['version'] ? 'checked' : '' ?> >
                        <?php echo $val['name'] ?>
                    </option>
                    <?php } ?>
                </select>
                <a href="<?php echo Url::to('/setting/index?table_name=version'); ?>" target="_blank">管理</a>
            </div>
        </div>
        <div class="block">
            <label>标题: </label>
            <div class="infor_box">
                <input type="text" name="title" value="<?php echo $model->attributes['title'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>内容: </label><br>
            <div class="infor_box" style="margin-left: 200px;">
                <textarea name="content" rows="10" cols="50" ><?php echo $model->attributes['content'] ?></textarea>
            </div>
        </div>
        <div class="block">
            <label>落款: </label>
            <div class="infor_box">
                <input type="text" name="inscribe" value="<?php echo $model->attributes['inscribe'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>超链接: </label>
            <div class="infor_box">
                <input type="text" name="url" value="<?php echo $model->attributes['url'] ?>" />
            </div>
        </div>
        <div class="block">
            <label>时间: </label>
            <div class="infor_box">
                    <input type="text" name="start_time" class="input_cont wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date('Y-m-d H:i:s', $model->attributes['start']) ?>">
                    <span>到</span>
                    <input type="text" name="end_time" class="input_cont wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="<?php echo date('Y-m-d H:i:s', $model->attributes['end']) ?>">

                <!-- <label>从</label><input type="text" name="start_time" class="Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date('Y-m-d H:i:s', $model->attributes['start_time']->sec) ?>" />
                <label>到</label><input type="text" name="end_time" class="Wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date('Y-m-d H:i:s', $model->attributes['end_time']->sec) ?>" />
             -->
            </div>
        </div>
        <div class="block submitBox">
            <div> </div>
            <div class="submit_btn">
                <input type="submit" name="submit" value="提 交" class="btn-primary btn btn_submit" />
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $model->mongo_id ? $model->mongo_id->__toString() : '' ?>" />
        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>
</div>
<script type="text/javascript">


</script>
