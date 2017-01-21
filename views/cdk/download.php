<table>
    <tr>
        <td>Code</td>
        <td>状态</td>
        <td>使用者UID</td>
        <td>使用者区服ID</td>
        <td>使用时间</td>
    </tr>
    <?php foreach ($list as $cdkey) { ?>
    <tr>
        <td><?php echo $cdkey['code'] ?></td>
        <td><?php echo $cdkey['status'] ? '未使用' : '已使用' ?></td>
        <td><?php echo $cdkey['used_by'] ?></td>
        <td><?php echo $cdkey['user_server_lid'] ?></td>
        <td><?php echo $cdkey['use_time'] ? date('Y-m-d H:i:s', $cdkey['use_time']) : '' ?></td>
    </tr>
    <?php } ?>
</table>