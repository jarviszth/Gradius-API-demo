<?php
use application\util\ControllerUtil as ControllerUtil;
use application\util\UploadUtil as UploadUtil;
use application\util\MessageUtils as MessageUtil;

$appUserTopbar = ControllerUtil::getAppUserLoged($this->getDbConn());
$avatarTopbar = UploadUtil::displayAvatarThumnailPubic($appUserTopbar->getImgName(),$appUserTopbar->getCreatedDate());
?>
<!-- START PAGE HEADER WRAPPER -->
<!-- START HEADER -->
<div class="header ">



    <!-- START MOBILE CONTROLS -->
    <div class="container-fluid relative">
        <!-- LEFT SIDE -->
        <div class="pull-left full-height visible-sm visible-xs">
            <!-- START ACTION BAR -->
            <div class="header-inner">
                <a href="#" class="btn-link toggle-sidebar visible-sm-inline-block visible-xs-inline-block padding-5" data-toggle="sidebar">
                    <span class="icon-set menu-hambuger"></span>
                </a>
            </div>
            <!-- END ACTION BAR -->
        </div>
        <div class="pull-center hidden-md hidden-lg">
            <div class="header-inner">
                <div class="brand inline">
                    <img src="<?=__RESOURCES.'/'?>assets/img/logo.png" alt="logo" data-src="<?=__RESOURCES.'/'?>assets/img/logo.png" data-src-retina="<?=__RESOURCES.'/'?>assets/img/logo.png" height="20">
                </div>
            </div>
        </div>
        <!-- RIGHT SIDE -->
        <div class="pull-right full-height visible-sm visible-xs">
            <!-- START ACTION BAR -->
            <div class="header-inner">
                <div class="dropdown pull-right">
                    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="<?=$avatarTopbar?>" alt="" data-src="<?=$avatarTopbar?>" data-src-retina="<?=$avatarTopbar?>" height="32">
                </span>
                    </button>
                    <ul class="dropdown-menu profile-dropdown" role="menu">
                        <li><a href="#"><i class="pg-settings_small"></i> Settings</a></li>
                        <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_user_change_pass_session')){?>
                            <li><a href="<?=_BASEURL.'appuserchangepwdsession'?>"><i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_change_password')?></a></li>
                        <?php }
                        ?>
                        <li class="bg-master-lighter">
                            <a href="<?=_BASEURL.'logout'?>" class="clearfix">
                                <span class="pull-left"><?=MessageUtil::getMessage('app_logout')?></span>
                                <span class="pull-right"><i class="pg-power"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END ACTION BAR -->
        </div>
    </div>
    <!-- END MOBILE CONTROLS -->



    <div class=" pull-left sm-table hidden-xs hidden-sm">
        <div class="header-inner">
            <div class="brand inline">
                <img src="<?=__RESOURCES.'/'?>assets/img/logo.png" alt="logo" data-src="<?=__RESOURCES.'/'?>assets/img/logo.png" data-src-retina="<?=__RESOURCES.'/'?>assets/img/logo.png" height="20">
            </div>
        </div>
    </div>

    <div class=" pull-right">
        <!-- START User Info-->
        <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
                <span class="text-master"><?=ControllerUtil::getUserNameSession()?></span>
            </div>
            <div class="dropdown pull-right">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="thumbnail-wrapper d32 circular inline m-t-5">
                <img src="<?=$avatarTopbar?>" alt="" data-src="<?=$avatarTopbar?>" data-src-retina="<?=$avatarTopbar?>" height="32">
                </span>
                </button>
                <ul class="dropdown-menu profile-dropdown" role="menu">
                    <li><a href="#"><i class="pg-settings_small"></i> Settings</a></li>
                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_user_change_pass_session')){?>
                        <li><a href="<?=_BASEURL.'appuserchangepwdsession'?>"><i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_change_password')?></a></li>
                    <?php }
                    ?>
                    <li class="bg-master-lighter">
                        <a href="<?=_BASEURL.'logout'?>" class="clearfix">
                            <span class="pull-left"><?=MessageUtil::getMessage('app_logout')?></span>
                            <span class="pull-right"><i class="pg-power"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END User Info-->
    </div>


</div>
<!-- END HEADER -->
<!-- END PAGE HEADER WRAPPER -->