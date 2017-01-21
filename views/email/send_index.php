<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Send Email';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/email.js');
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
            <label>区服: </label>
            <div class="infor_box">
                <select class="" name="server_id" id="server_id">
                    <?php  foreach ($server_list as $val) { ?>
                    <option value="<?php echo $val['_id'] ?>" >
                        <?php echo $val['name'] ?>
                    </option>
                    <?php } ?>
                </select>
                <a href="<?php echo Url::to('/setting/game-server-list'); ?>" target="_blank">管理</a>
            </div>
        </div>
        <div class="block">
            <label>渠道: </label>
            <div class="infor_box">
                <select class="" name="channel" id="channel">
                    <?php foreach ((array)$channel_list as $val) { ?>
                    <option value="<?php echo $val['name'] ?>" >
                        <?php echo $val['name'] ?>
                    </option>
                    <?php } ?>
                </select>
                <a href="<?php echo Url::to('/setting/index?table_name=channel'); ?>" target="_blank">管理</a>
            </div>
        </div>
        <div class="block">
            <label>UID: </label>
            <div class="infor_box">
                <input type="text" name="uids" id="uids" value="" size="100" /> （英文逗号隔开多个）
            </div>
        </div>
        <div class="block">
            <label>玩家昵称: </label>
            <div class="infor_box">
                <input type="text" name="user_names" id="user_names" value="" size="100" />（英文逗号隔开多个）
            </div>
        </div>
        <div class="block">
            <label>发送时间: </label>
            <div class="infor_box">
                <input type="text" name="send_time" id="send_time" value="" class="wdate" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
            </div>
        </div>
        <div class="block">
            <label>标题: </label>
            <div class="infor_box">
                <input type="text" name="title" id="title" value="" />
            </div>
        </div>
        <div class="block">
            <label>内容: </label><br>
            <div class="infor_box" style="margin-left: 200px;">
                <textarea name="content" id="content" rows="10" cols="50" ></textarea>
            </div>
        </div>


        <div class="block">
            <label>附件: </label>
            <div class="infor_box">
                <a href="javascript:;" onclick="add_attach()">新增</a>

                <table id="attach_table">
                </table>
                
            </div>
        </div>
        <div class="block submitBox">
            <div> </div>
            <div class="submit_btn">
                <input type="button" name="submit" value="提 交" onclick="ajax_send_email(0)" class="btn-primary btn btn_submit" />
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">


</script>
