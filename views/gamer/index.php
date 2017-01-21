<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Gamer List';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/gamer_index.js?22332');
?>
<div class="site-index">

    <div class="msg"><?php echo $error ?></div>

    <div>
        切换服务器：
        <select class="" name="server_id" id="server_id" onblur="ajax_set_server($(this), '<?php echo Url::to('/setting/redis-server'); ?>')">
            <?php  foreach ($server_list as $val) { ?>
            <option value="<?php echo $val['_id'] ?>" >
                <?php echo $val['name'] ?>
            </option>
            <?php } ?>
        </select>
        <a href="<?php echo Url::to('/setting/game-server-list'); ?>" target="_blank">管理</a>
        当前Redis：<?php echo $redis_host ?>
        端口：<?php echo $redis_port ?>
    </div>

    <div>
        <form action="" class="searchBox" method="post">
            <label>昵称：</label><div class="controls"><input type="text" name="name" id="name" value="<?php echo $args['name'] ?>"></div>
            <label>UID：</label><div class="controls"><input type="text" name="id" id="uid" value="<?php echo $args['id'] ?>"></div>
            <input type="submit" name="Search" value="搜索" class="sub_search" />
            <input type="button" name="search_one" value="跨服搜索" class="sub_search" onclick="ajax_serach_user()" />
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>
    <div class="body-content">
        <table border="1" id="list_table">
            <tr>
                <th>UID</th>
                <th>渠道</th>
                <th>渠道uid</th>
                <th>昵称</th>
                <th>区服</th>
                <th>所属联盟</th>
                <th>当前版本</th>
                <th>累计充值金额</th>
                <th>注册日期</th>
                <th>最后登录日期</th>
                <th>设备码</th>
                <th>游戏信息</th>
                <th>订单信息</th>
            </tr>
            <?php if ($list) { ?>
            <?php   foreach ($list as $name => $id) {
                        if (($args['id'] && $id != $args['id']) || ($args['name'] && $name != $args['name'])) {
                            continue;
                        }
            ?>
            <tr>
                <td>
                    <?php echo $id ?>
                </td>
                <td></td>
                <td></td>
                <td><?php echo $name ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="<?php echo Url::to(['gamer/detail', 'id' => $id]); ?>" target="_blank" class="detail">查看</a></td>
                <td></td>
            </tr>
            <?php
                    }
                }
            ?>
        </table>
        
        

    </div>
</div>
<script type="text/javascript">
function ajax_serach_user()
{
    $.get('/gamer/search',
        {
            name:$('#name').val(),
            uid:$('#uid').val()
        },
        function(ret){
            if (ret.ok) {
                html = '<tr>';
                html += '<th>UID</th>';
                html += '<th>渠道</th>';
                html += '<th>渠道uid</th>';
                html += '<th>昵称</th>';
                html += '<th>区服</th>';
                html += '<th>所属联盟</th>';
                html += '<th>当前版本</th>';
                html += '<th>累计充值金额</th>';
                html += '<th>注册日期</th>';
                html += '<th>最后登录日期</th>';
                html += '<th>设备码</th>';
                html += '<th>游戏信息</th>';
                html += '<th>订单信息</th>';
                html += '</tr>';
                for (var i in ret.data) {
                    html += '<tr>';
                    html += '<td>'+ret.data[i].id+'</td>';
                    html += '<td>'+ret.data[i].channel+'</td>';
                    html += '<td>'+''+'</td>';
                    html += '<td>'+ret.data[i].name+'</td>';
                    html += '<td>'+ret.data[i].lid + ' ' + ret.data[i].server +'</td>';
                    html += '<td>'+ret.data[i].league_id + ' ' + ret.data[i].league_name +'</td>';
                    html += '<td>'+''+'</td>';
                    html += '<td>'+ret.data[i].total_charged+'</td>';
                    html += '<td>'+ret.data[i].regist_time+'</td>';
                    html += '<td>'+ret.data[i].last_login+'</td>';
                    html += '<td>'+''+'</td>';
                    html += '<td>'+'<a href="/gamer/detail?id=' + ret.data[i].id + '" target="_blank" class="detail">查看</a>'+'</td>';
                    html += '<td>'+''+'</td>';
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
</script>
