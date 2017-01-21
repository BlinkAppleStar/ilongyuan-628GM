<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Gamer Detail';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/gamer.css?22332');
$this->registerJsFile('@web/js/gamer.js?22332');
?>
<div class="site-index">
    <?php if ($ret_msg['ok']) {
        $gamer = $ret_msg['data']['gamer'];
        $name_list = $ret_msg['data']['name_list'];
        ?>
        <span>概况</span>
        <div class="jumbotron discribe">
            <div>UID: <?php echo $gamer->getId() ?></div>
            <div>昵称: <?php echo $gamer->getName() ?></div>
            <div>区服: 待定</div>
            <div>主城等级: <?php echo $gamer->getLevel() ?></div>
            <div>隶属联盟:
                <?php
                $league = $gamer->getLeague();
                if ($league) { ?>
                <?php echo $league->getLid() ?>
                <?php } else { ?>
                无
                <?php } ?>
            </div><br>
            <div>联盟等级:
                <?php
                if ($league) { ?>
                <?php echo $league->getLevel() ?>
                <?php } else { ?>
                无
                <?php } ?>
            </div>
            <div>累计充值: <?php echo number_format($gamer->getAllrmb(), 2, '.', ',') ?></div>
            <div>拥有钻晶数量: <?php echo $gamer->getResourceAt(3); ?></div><br>
            <div>月卡到期时间: 待定</div>
            <div>预购月卡数量: 待定</div>
        </div><br />
        <div class="msg">资产信息 (<a href="javascript:;" onclick="show_hide($(this), false)" data-type="resource">展开</a>)</div>
        <div class="body-content" id="resource_list" style="display:none;">
            <?php $resource_list = $gamer->getResource(); ?>
            <table border="1">
                <tr>
                    <th>物品/资源ID</th>
                    <th>名称</th>
                    <th>数量</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><?php echo $name_list['1'] ?></td>
                    <td><input type="text" name="resource_1" id="resource_1" value="<?php echo $resource_list['1'] ?>" /></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><?php echo $name_list['2'] ?></td>
                    <td><input type="text" name="resource_2" id="resource_2" value="<?php echo $resource_list['2'] ?>" /></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><?php echo $name_list['3'] ?></td>
                    <td><input type="text" name="resource_3" id="resource_3" value="<?php echo $resource_list['3'] ?>" /></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><?php echo $name_list['7'] ?></td>
                    <td><input type="text" name="resource_7" id="resource_7" value="<?php echo $resource_list['7'] ?>" /></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><?php echo $name_list['8'] ?></td>
                    <td><input type="text" name="resource_8" id="resource_8" value="<?php echo $resource_list['8'] ?>" /></td>
                </tr>
                <?php foreach ((array) $resource_list as $key => $val) {
                        if (!in_array($key, array(0,1,2,3,7,8))) {
                ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $name_list[$key] ?></td>
                    <td><input type="text" name="resource_<?php echo $key ?>" id="resource_<?php echo $key ?>" value="<?php echo $resource_list[$key] ?>" /></td>
                </tr>
                <?php   }
                    }
                ?>
            </table>
            <div><a href="javascript:;" onclick="ajax_set_resource('<?php echo Url::to('/gamer/update-resource-list'); ?>', '<?php echo $gamer->getId() ?>')">更新资产</a></div>
        </div><br />
    <?php } else { ?>
    <div class="jumbotron">
        <?php echo $ret_msg['msg'] ?>
    </div>
    <?php } ?>

    <div class="liner"></div><br />
    <div class="msg">建筑信息 (<a href="javascript:;" onclick="show_hide($(this), true)" data-type="build">展开</a>)</div>
    <div class="body-content" id="build_list">
        <table border="1">
            
        </table>
    </div><br />
    <div>
        建筑等级：
        <input type="text" size="1" id="build_level" />
        <a href="javascript:;" onclick="ajax_set_building_level('<?php echo Url::to('/gamer/set-building-level'); ?>', '<?php echo $id ?>')">重置</a>
    </div>
    <div class="liner"></div><br />
    <div class="msg">科技信息 (<a href="javascript:;" onclick="show_hide($(this), true)" data-type="tech">展开</a>)</div>
    <div class="body-content" id="tech_list">
        <table border="1">
            
        </table>
    </div><br />
    <div class="liner"></div><br />
    <div class="msg">士兵信息 (<a href="javascript:;" onclick="show_hide($(this), true)" data-type="soldier">展开</a>)</div>
    <div class="body-content" id="soldier_list">
        <table border="1">
            
        </table>
    </div><br />
    <div class="liner"></div><br />
    <div class="msg">道具信息 (<a href="javascript:;" onclick="show_hide($(this), true)" data-type="item">展开</a>)</div>
    <div class="body-content" id="item_list">
        <table border="1">
            
        </table>
    </div><br />
    <div>
        新增道具ID：
        <input type="text" size="5" id="new_item_id" value="" />
        数量：
        <input type="text" size="5" id="new_item_value" value="" />
        <a href="javascript:;" onclick="ajax_create_item()">保存</a>
    </div>
    <div class="liner"></div><br />
    <div class="msg">战斗信息 (<a href="javascript:;" onclick="show_hide($(this), true)" data-type="combat">展开</a>)</div>
    <div class="body-content" id="combat_list">
        <table border="1">
            
        </table>
    </div><br />
    <div class="liner"></div><br />
</div>
<script type="text/javascript">

var uid = '<?php echo $gamer ? $gamer->getId() : 0 ?>';
var ajax_url = "<?php echo Url::to('/gamer/ajax-sub-list'); ?>";
var edit_item_url = "<?php echo Url::to('/gamer/ajax-set-item'); ?>";
var delete_item_url = "<?php echo Url::to('/gamer/ajax-delete-item'); ?>";
</script>
