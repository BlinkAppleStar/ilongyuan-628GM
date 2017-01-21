<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Gift Pack List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
$this->registerJsFile('@web/js/My97DatePicker/WdatePicker.js');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>
    <div>
        <form action="" class="searchBox" method="post">
            <div class="inforBox">
                <span class="sign">
                    <label>流水号：</label>
                    <div class="controls">
                        <input type="text" name="gift_id" class="input_cont" id="gift_id" value="">
                    </div>
                </span>
                <span class="sign">
                    <label>礼包名：</label>
                    <div class="controls">
                        <input type="text" name="gift_name" class="input_cont" id="gift_name" value="">
                    </div>
                </span>
                <span class="sign">
                    <label>页号：</label>
                    <div class="controls">
                        <input type="text" name="page" class="input_cont" id="page" value="">
                    </div>
                </span>
                <span class="sign">
                    <label>页大小：</label>
                    <div class="controls">
                        <input type="text" name="page_size" class="input_cont" id="page_size" value="">
                    </div>
                </span>
            </div>

            <input type="button" name="Search" value="搜索" class="sub_search" onclick="ajax_get_gift_list()" />
            <a href="<?php echo Url::to('/cdk/gift-edit'); ?>" class="sub_search" target="_blank">生成礼包</a>
        </form>
    </div>
    <div class="body-content">
        <table border="1" id="list_table" class="searchBox">

        </table>
        

    </div>
</div>
<script type="text/javascript">
// 搜索列表
function ajax_get_gift_list()
{
    $.get('/cdk/gift-list',
        {
            channel:$('#channel').val(),
            gift_id:$('#gift_id').val(),
            gift_name: $('#gift_name').val(),
            page:$('#page').val(),
            page_size:$('#page_size').val()
        },
        function(ret){
            if (ret.ok) {
                html = '<tr>';
                html += '<th>礼包流水号</th>';
                html += '<th>礼包名</th>';
                html += '<th>礼包描述</th>';
                html += '<th>礼包道具</th>';
                html += '<th>有效期</th>';
                html += '<th>礼包渠道</th>';
                html += '<th>使用情况</th>';
                html += '<th>操作</th>';
                html += '</tr>';
                for (var id in ret.data.list) {
                    html += '<tr>';
                    html += '<td>'+ret.data.list[id].id+'</td>';
                    html += '<td>'+ret.data.list[id].name+'</td>';
                    html += '<td>'+ret.data.list[id].desc+'</td>';
                    html += '<td>';
                    for (var i in ret.data.list[id].attachs) {
                        html += ret.data.list[id].attachs[i].item_name + ' => ' + ret.data.list[id].attachs[i].item_count + '<br />';
                    }
                    html += '</td>';
                    html += '<td>'+ret.data.list[id].start_time + '到' + ret.data.list[id].end_time +'</td>';
                    html += '<td>';
                    for (var i in ret.data.list[id].channels) {
                        html += (ret.data.list[id].channels[i].name ? ret.data.list[id].channels[i].name : '全部') + '<br />';
                    }
                    html += '</td>';
                    html += '<td>'+ret.data.list[id].cdkey_used +'/' + ret.data.list[id].cdkey_count +'</td>';
                    html += '<td>';
                    html += ' <a href="/cdk/download?id=' + id + '" class="sub_search">导出</a> ';
                    if (ret.data.list[id].status == '1') {
                        html += ' <a href="javascript:;" onclick="delete_gift(' + "'" + id + "'" +')" class="sub_search">删除</a> ';
                    }
                    html += ' <a style="display:none;" href="/cdk/gift-restore?id=' + id + '" class="sub_search">恢复</a> ';
                    html += '</td>';
                    html += '</tr>';
                }
                $('#list_table').html(html);
            } else {
                alert(ret.msg);
            }
        },
        'json'
    );
}

function delete_gift(id) {
    $.get('/cdk/gift-delete',
        {
            id:id
        },
        function(ret){
            alert(ret.msg);
            if (ret.ok) {
                window.location.reload();
            }
        },
        'json'
    );
}

</script>
