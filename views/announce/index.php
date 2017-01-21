<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Announcement List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/announce.js?jifjefj');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div>
        <form action="" class="searchBox" method="get">
            <div class="inforBox">
                <span class="sign"><label>ID：</label><div class="controls"><input type="text" name="id" id="id" value=""></div></span>
                <span class="sign"><label>渠道：</label><div class="controls"><input type="text" name="channel" id="channel" value=""></div></span>
                <span class="sign">
                    <label>区服：</label>
                    <div class="controls">
                        <select class="" name="server_id" id="server_id">
                            <option value="">全部</option>
                            <?php  foreach ($server_list as $val) { ?>
                            <option value="<?php echo $val['_id'] ?>" >
                                <?php echo $val['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </span>
                <span class="sign"><label>版本：</label><div class="controls"><input type="text" name="version" id="version" value=""></div></span>
                <span class="sign"><label>语言：</label><div class="controls"><input type="text" name="lang" id="lang" value=""></div></span>
                <span class="sign"><label>标题：</label><div class="controls"><input type="text" name="title" id="title" value=""></div></span>
                <span class="sign">
                    <label>类型：</label>
                    <div class="controls">
                        <select name="type" id="type">
                            <option value="" >全部</option>
                            <option value="after_login" >登录后</option>
                            <option value="before_login" >登录前</option>
                        </select>
                    </div>
                </span>
                <span class="sign"><label>页号：</label><div class="controls"><input type="text" name="page" id="page" value="1"></div></span>
                <span class="sign"><label>每页条数：</label><div class="controls"><input type="text" name="page_size" id="page_size" value="10"></div></span>
                <span class="sign"><label>开始时间：</label><div class="controls"><input type="text" name="start_time_min" class="input_cont wdate" id="start_time_min" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value=""><span>到</span><input type="text" name="start_time_max" class="input_cont wdate" id="start_time_max" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value=""></div></span>
                <span class="sign"><label>结束时间：</label><div class="controls"><input type="text" name="end_time_min"class="input_cont wdate" id="end_time_min" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value=""><span>到</span><input type="text" name="end_time_max" class="input_cont wdate" id="end_time_max" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value=""></div></span>
                <span class="sign flr"><a href="<?php echo Url::to('/announce/edit'); ?>" class="sub_search" target="_blank">新增</a></span><br>
                <span class="sign flr"><input type="button" name="Search" value="搜索" class="sub_search" onclick="ajax_list('<?php echo Url::to('/announce/list'); ?>')" /></span>
            </div>
        </form>
    </div>
    <div>
        查询API接口：http://120.92.21.214:8080/api/current-valid-announce-list?channel=your_channel&version=your_version&lang=your_language&type=before_login 查找当前时间范围的公告
    </div>
    <div class="body-content" id="announce_list">
        <table border="1">
            
        </table>
    </div>
</div>
<script type="text/javascript">

</script>
