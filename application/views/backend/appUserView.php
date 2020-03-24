<?php
use application\util\MessageUtils as MessageUtil;
echoln('App User View');
$appUser = (isset($_V_DATA_TO_VIEW['appUser'])) ? $_V_DATA_TO_VIEW['appUser'] : array();
echoln("single role name=".$appUser->getUserName());
?>
<a href="<?=_BASEURL.'appUserList'?>"><?=MessageUtil::getMessage('app_back')?></a>
