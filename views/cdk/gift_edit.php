<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = $action . ' Gift Pack';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
?>
<div class="site-index">

    <div class="jumbotron discribe">
        <form action="" method="post">
        <?php if ($model->mongo_id) { ?>
        <div class="block">
            <label>ID: </label>
            <div class="infor_box">
                <?php echo $model->mongo_id->__toString() ?>
                <input type="hidden" name="mongo_id" id="mongo_id" value="<?php echo $model->mongo_id->__toString() ?>" />
            </div>
        </div>
        <div class="block">
            <label>礼包流水号: </label>
            <div class="infor_box">
                <?php echo $model->attributes['id'] ?>
            </div>
        </div>
        <?php } else { ?>
        <div class="block">
            <label>礼包数量: </label>
            <div class="infor_box">
                <input type="text" name="cdkey_count" id="cdkey_count" value="" size="100" />
            </div>
        </div>
        <?php } ?>
        <div class="block">
            <label>礼包名: </label>
            <div class="infor_box">
                <input type="text" name="name" id="name" value="" size="100" />
            </div>
        </div>
        <div class="block">
            <label>礼包描述: </label><br>
            <div class="infor_box" style="margin-left: 200px;">
                <textarea name="desc" id="desc" rows="10" cols="50" ></textarea>
            </div>
        </div>
        <div class="block">
            <label>礼包生效时间: </label><br>
            <div class="infor_box" style="margin-left: 200px;">
                从 <input type="text" name="start_time"class="input_cont wdate" id="start_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="">
                到 <input type="text" name="end_time"class="input_cont wdate" id="end_time" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="">
            </div>
        </div>
        <div class="block">
            <label>礼包生效渠道: </label>
            <div class="infor_box">

                <table id="channel_table">
                </table>
                
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
                <input type="button" name="submit" value="提 交" onclick="ajax_save()" class="btn-primary btn btn_submit" />
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
// 远程获取渠道列表
var channel_options_html = ''
function ajax_get_channel_list()
{
    $.get('/setting/index',
        {
            table_name:'channel',
            ajax:true
        },
        function(ret){
            if (ret.ok) {
                channel_options_html += '<tr><td>';
                channel_options_html += '<input type="checkbox" value="" checked="checked">全部';
                channel_options_html += '</td>';
                for (var id in ret.data) {
                    channel_options_html += '<td>';
                    channel_options_html += '<input type="checkbox" value="' + ret.data[id].name + '">' + ret.data[id].name + '';
                    channel_options_html += '</td>';
                }
                channel_options_html += '</tr>';

                $('#channel_table').html(channel_options_html);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}



// 远程获取道具列表
var item_options_html = '';
function ajax_get_item_list()
{
    $.get('/setting/get-item-list',
        {},
        function(ret){
            if (ret.ok) {
                for (var id in ret.data) {
                    item_options_html += '<option value="' + id + '">' + id + ' ' + ret.data[id] + '</option>';
                }
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}

window.onload=function(){
      ajax_get_item_list();
      ajax_get_channel_list();
}

var next_attach_id = 1;
// 页面增加附件DOM
function add_attach()
{
    var html = '<tr id="attach_tr_' + next_attach_id +'">';
    html += '<td><select >' + item_options_html + '</select></td>';
    html += '<td><input type="text" value="" size="10" /></td>';
    html += '<td><a href="javascript:;" onclick="delete_attach('+ next_attach_id +')">删除</a></td>';
    html += '</tr>';


    $('#attach_table').append(html);
    next_attach_id++;
}

// 删除附件
function delete_attach(i)
{
    $('#attach_tr_'+i).remove();
}

// 保存礼包
function ajax_save()
{
    var attachs = [];
    $("#attach_table tr").each(function(){
        current_attach = {
            'item_id' : $(this).find('select').val(),
            'item_count' : $(this).find("input").val()
        };
        attachs.push(current_attach);
    });

    var channels = [];
    $("#channel_table input:checked").each(function(){
        current_channel = {
            'name' : $(this).val()
        };
        channels.push(current_channel);
    });

    $.post('/cdk/gift-edit',
        {
            mongo_id: $('#mongo_id').val(),
            start_time : $('#start_time').val(),
            end_time : $('#end_time').val(),
            name : $('#name').val(),
            desc : $('#desc').val(),
            cdkey_count : $('#cdkey_count').val(),
            channels : channels,
            attachs : attachs
        },
        function(ret){
            if (ret.ok) {
                window.location.href='/cdk/download?id=' + ret.data;
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}
</script>
