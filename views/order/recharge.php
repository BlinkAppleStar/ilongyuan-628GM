<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Gamer Recharge';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
//$this->registerJsFile('@web/js/email.js');
//$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
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
            <label>UID: </label>
            <div class="infor_box">
                <input type="text" name="uid" id="uid" value="" /> 
            </div>
        </div>
        <div class="block">
            <label>充值金额: </label>
            <div class="infor_box">
                <input type="text" name="amount" id="amount" value="" />
            </div>
        </div>
        <div class="block">
            <label>商品: </label>
            <div class="infor_box">
                <select id="goods" name="goods">
                    
                </select>
            </div>
        </div>
        <div class="block submitBox">
            <div> </div>
            <div class="submit_btn">
                <input type="button" name="submit" value="提 交" onclick="ajax_recharge_gamer()" class="btn-primary btn btn_submit" />
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
window.onload=function(){
      ajax_get_item_list();
}
// 远程获取商品列表
var item_options_html = '';
function ajax_get_item_list()
{
    $.get('/setting/get-goods-list',
        {},
        function(ret){
            if (ret.ok) {
                for (var id in ret.data) {
                    item_options_html += '<option value="' + id + '">' + id + ' ' + ret.data[id] + '</option>';
                }
                $('#goods').html(item_options_html);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}


function ajax_recharge_gamer()
{
    $.post('/order/recharge-gamer',
        {
            uid:$('#uid').val(),
            goods_id:$('#goods').val(),
            amount:$('#amount').val()
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}

</script>
