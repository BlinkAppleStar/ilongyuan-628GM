<?php 

?>
<ul>
    <li class="active">
        <a target="htmlContentBox" href="add.html" title="新增活跃">
            <i class="icon icon_add"></i><span>新增活跃</span>
        </a>
    </li>
    <li>
        <a target="htmlContentBox" href="paydata.html" title="付费数据">
            <i class="icon icon_pay"></i><span>付费数据</span>
        </a>
    </li>
    <li>
        <a target="htmlContentBox" href="ltv.html" title="LTV统计">
            <i class="icon icon_ltv"></i><span>LTV统计</span>
        </a>
    </li>
    <li>
        <a target="htmlContentBox" href="realtime.html" title="实时在线">
            <i class="icon icon_sszx"></i><span>实时在线</span>
        </a>
    </li>
    <li>
        <a target="htmlContentBox" href="savedata.html" title="留存数据">
            <i class="icon icon_lcsj"></i><span>留存数据</span>
        </a>
    </li>
    <li>
        <a target="htmlContentBox" href="online.html" title="在线时长统计">
            <i class="icon icon_zxsc"></i><span>在线时长统计</span>
        </a>
    </li>
    <li>
        <a target="htmlContentBox" href="flowdata.html" title="流失数据">
            <i class="icon icon_lssj"></i><span>流失数据</span><i class="icon icon_btnState"></i>
        </a>
        <ul>
            <li>
                <a target="htmlContentBox" href="loss_generalize.html" title="流失概况"><span>流失概况</span></a>
            </li>
            <li>
                <a target="htmlContentBox" href="javascript:;" title="新手引导流失"><span>新手引导流失</span><i class="icon icon_btnState"></i></a>
                <ul>
                    <li>
                        <a target="htmlContentBox" href="addUserSame.html" title="新增玩家当天"><span>新增玩家当天</span></a>
                    </li>
                    <li>
                        <a target="htmlContentBox" href="addUserAfter.html" title="新增玩家后续"><span>新增玩家后续</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a target="htmlContentBox" href="javascript:;" title="长期流失与回流"><span>长期流失与回流</span><i class="icon icon_btnState"></i></a>
                <ul>
                    <li>
                        <a target="htmlContentBox" href="addUserData.html" title="新增玩家数据"><span>新增玩家数据</span></a>
                    </li>
                    <li>
                        <a target="htmlContentBox" href="addUserActive.html" title="活跃玩家数据"><span>活跃玩家数据</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li>
        <a target="htmlContentBox" href="javascript:;" title="GM工具">
            <i class="icon icon_gm"></i><span>GM工具</span><i class="icon icon_btnState"></i>
        </a>
        <ul>
            <li>
                <a target="htmlContentBox" href="gameuser.html" title="玩家信息查询"><span>玩家信息查询</span></a>
            </li>
            <?php if ($permission->checkAccess($manager_id, 'access_announce_module')) { ?>
            <li>
                <a target="htmlContentBox" href="homeset.html" title="首页公告设置"><span>首页公告设置</span></a>
            </li>
            <?php }?>
            <?php if ($permission->checkAccess($manager_id, 'access_cdk_module')) { ?>
            <li>
                <a target="htmlContentBox" href="cdkey.html" title="CDKey工具"><span>CDKey工具</span></a>
            </li>
            <?php } ?>
            <li>
                <a target="htmlContentBox" href="shield.html" title="封号工具"><span>封号工具</span></a>
            </li>
            <li>
                <a target="htmlContentBox" href="whitelist.html" title="白名单"><span>白名单</span></a>
            </li>
            <li>
                <a target="htmlContentBox" href="feedback.html" title="意见反馈"><span>意见反馈</span></a>
            </li>
            <?php if ($permission->checkAccess($manager_id, 'access_email_module')) { ?>
            <li>
                <a target="htmlContentBox" href="allemail.html" title="邮件列表"><span>邮件列表</span></a>
            </li>
            <?php } ?>
        </ul>
    </li>
    <?php if ($permission->checkAccess($manager_id, 'access_server_status')) { ?>
    <li>
        <a target="htmlContentBox" href="serverdata.html" title="服务器数据">
            <i class="icon icon_fwq"></i><span>服务器数据</span>
        </a>
    </li>
    <?php } ?>
    <li>
        <div class="loginBox">
            <span class="loginBtn"><a href="/site/logout">登出</a></span>
            <span class="loginText">（<?php echo $real_name ?>）</span>
        </div>
    </li>
</ul>