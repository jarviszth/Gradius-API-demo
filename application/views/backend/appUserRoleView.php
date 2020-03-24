<?php
use application\util\MessageUtils as MessageUtil;
echoln('App User Role View');
$appUserRole = (isset($_V_DATA_TO_VIEW['appUserRole'])) ? $_V_DATA_TO_VIEW['appUserRole'] : array();
echoln("single role name=".$appUserRole->getName());
?>
<a href="<?=_BASEURL.'app-user-role-list'?>"><?=MessageUtil::getMessage('app_back')?></a>
