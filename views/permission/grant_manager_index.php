<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Grant Manager Permission ';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/announce.css');
?>
<div class="site-index">
    <div class="jumbotron discribe">
        <div class="block">
            <label>Manager ID: </label>
            <div class="infor_box">
                <input type="text" name="manager_id" id="manager_id" value="" />
            </div>
        </div>
        <div class="block">
            <label>权限: </label>
            <div class="infor_box">
                <select name="permissions" id="permissions">
                    <?php foreach ((array) $permission_list as $key => $val) {?>
                    <option value="<?php echo $key ?>" ><?php echo $val['value'] ?> <?php echo $val['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="block tcenter">
            <div> </div>
            <div>
                <input type="button" name="submit" value="提 交" onclick="ajax_grant()" class="btn-primary btn btn_submit" />
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
function ajax_grant()
{
    $.get('/permission/grant-manager',
        {
            manager_id:$('#manager_id').val(),
            permission_id:$('#permissions').val()
        },
        function(ret){
            alert(ret.msg);
        },
        'json'
    );
}

</script>
