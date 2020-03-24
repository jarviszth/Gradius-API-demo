<?php
use application\util\MessageUtils as MessageUtil;
use application\util\ControllerUtil as ControllerUtil;
$showMain = false;
$showMainSub1 = false;
?>
<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <script type="text/javascript">
        function configMenu(menuId, status){

//            alert('menuId='+menuId+' status='+status);
            if(status!=1){
                jQuery(function($) {
                    $('#'+menuId).hide();
                });
            }else{
                jQuery(function($) {
                    $('#'+menuId).show();
                });
            }
        }
    </script>
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu">
        <div class="row">
            <div class="col-xs-6 no-padding">
                <a href="#" class="p-l-40"><img src="<?=__RESOURCES.'/'?>assets/img/demo/social_app.svg" alt="socail">
                </a>
            </div>
            <div class="col-xs-6 no-padding">
                <a href="#" class="p-l-10"><img src="<?=__RESOURCES.'/'?>assets/img/demo/email_app.svg" alt="socail">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-40"><img src="<?=__RESOURCES.'/'?>assets/img/demo/calendar_app.svg" alt="socail">
                </a>
            </div>
            <div class="col-xs-6 m-t-20 no-padding">
                <a href="#" class="p-l-10"><img src="<?=__RESOURCES.'/'?>assets/img/demo/add_more.svg" alt="socail">
                </a>
            </div>
        </div>
    </div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->


    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="<?=__RESOURCES.'/'?>assets/img/logo.png" alt="logo" class="brand" data-src="<?=__RESOURCES.'/'?>assets/img/logo.png" data-src-retina="<?=__RESOURCES.'/'?>assets/img/logo.png"  height="17">
        <div class="sidebar-header-controls">
            <button type="button" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" data-pages-toggle="#appMenu"><i class="fa fa-angle-down fs-16"></i>
            </button>
            <button type="button" class="btn btn-link visible-lg-inline" data-toggle-pin="sidebar"><i class="fa fs-12"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->


    <!-- BEGIN SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!--        <a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i>Type anywhere to <span class="bold">search</span></a>-->
        <ul class="menu-items">

            <li class="m-t-30">
                <a href="<?=_BASEURL.'dashboard'?>" class="detailed">
                    <span class="title"><?=MessageUtil::getMessage('app_home')?></span>
                    <span class="details">Dashboard</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-home"></i></span>
            </li>

            <!-- Develop -->
            <li id="menu_main_develop">
                <a href="javascript:;">
                    <span class="title"><?=MessageUtil::getMessage('app_develop')?></span>
                    <span class=" arrow"></span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-wrench"></i></span>
                <ul class="sub-menu">

                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_table_list')){
                        $showMain = true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'apptablelist'?>"><?=MessageUtil::getMessage('model_app_table')?></a>
                            <span class="icon-thumbnail">ap</span>
                        </li>
                    <?php }?>
                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_permission_list')){
                        $showMain = true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'apppermissionlist'?>"><?=MessageUtil::getMessage('model_app_permission')?></a>
                            <span class="icon-thumbnail">pm</span>
                        </li>
                    <?php }?>
                </ul>
            </li>
            <script type="text/javascript">
                configMenu('menu_main_develop','<?=$showMain?>');
            </script>
            <?php $showMain=false;$showMainSub1=false;?>
            <!-- End Develop-->

            <!-- Admin -->
            <li id="menu_main_admin">
                <a href="javascript:;">
                    <span class="title"><?=MessageUtil::getMessage('app_admin')?></span>
                    <span class=" arrow"></span>
                </a>
                <span class="icon-thumbnail"><i class="pg-folder_alt"></i></span>
                <ul class="sub-menu">
                    <li id="menu_main_admin_sub_1_1">
                        <a href="javascript:;"><span class="title"><?=MessageUtil::getMessage('app_base_data')?></span>
                            <span class="arrow"></span></a>
                        <span class="icon-thumbnail">B</span>
                        <ul class="sub-menu">
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_geography_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'appgeographylist'?>"><?=MessageUtil::getMessage('model_app_geography')?></a>
                                    <span class="icon-thumbnail">G</span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_province_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'appprovincelist'?>"><?=MessageUtil::getMessage('model_app_province')?></a>
                                    <span class="icon-thumbnail">P</span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_amphur_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'appamphurlist'?>"><?=MessageUtil::getMessage('model_app_amphur')?></a>
                                    <span class="icon-thumbnail">A</span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_district_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'appdistrictlist'?>"><?=MessageUtil::getMessage('model_app_district')?></a>
                                    <span class="icon-thumbnail">D</span>
                                </li>
                            <?php }?>
                        </ul>
                    </li>
                    <!-- config sub menu 1 -->
                    <script type="text/javascript">
                        configMenu('menu_main_admin_sub_1_1','<?=$showMainSub1?>');
                    </script>
                    <?php $showMainSub1=false;?>



                    <li id="menu_main_admin_sub_1_2">
                        <a href="javascript:;"><span class="title"><?=MessageUtil::getMessage('app_base_user_data')?></span>
                            <span class="arrow"></span></a>
                        <span class="icon-thumbnail">U</span>
                        <ul class="sub-menu">
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_user_role_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'appuserrolelist'?>"><?=MessageUtil::getMessage('model_app_user_role')?></a>
                                    <span class="icon-thumbnail">r</span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_user_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'appuserlist'?>"><?=MessageUtil::getMessage('model_app_user')?></a>
                                    <span class="icon-thumbnail">u</span>
                                </li>
                            <?php }?>

                        </ul>
                    </li>
                    <!-- config sub menu 1 -->
                    <script type="text/javascript">
                        configMenu('menu_main_admin_sub_1_2','<?=$showMainSub1?>');
                    </script>
                    <?php $showMainSub1=false;?>



                    <!-- Setting -->
                    <li id="menu_main_admin_sub_1_3">
                        <a href="javascript:;"><span class="title"><?=MessageUtil::getMessage('app_setting')?></span>
                            <span class="arrow"></span></a>
                        <span class="icon-thumbnail"><i class="fa fa-cogs"></i></span>
                        <ul class="sub-menu">
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'config_radius_server')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'cnfradiusedit?cnfradius=1'?>"><?=MessageUtil::getMessage('app_setting_radius_server')?></a>
                                    <span class="icon-thumbnail"><i class="fa fa-cog"></i></span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'nas_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'naslist'?>"><?=MessageUtil::getMessage('app_setting_radius_client')?></a>
                                    <span class="icon-thumbnail"><i class="fa fa-cog"></i></span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'username_role_edit')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'usernameroleedit?usernamerole=1'?>"><?=MessageUtil::getMessage('model_username_role')?></a>
                                    <span class="icon-thumbnail"><i class="fa fa-cog"></i></span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'pass_role_edit')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'passroleedit?passrole=1'?>"><?=MessageUtil::getMessage('model_pass_role')?></a>
                                    <span class="icon-thumbnail"><i class="fa fa-cog"></i></span>
                                </li>
                            <?php }?>
                            <?php if(ControllerUtil::isPermission($this->getDbConn(),'attribute_all_list')){
                                $showMain = true;$showMainSub1=true;
                                ?>
                                <li>
                                    <a href="<?=_BASEURL.'attributealllist'?>"><?=MessageUtil::getMessage('model_attribute_all')?></a>
                                    <span class="icon-thumbnail"><i class="fa fa-cog"></i></span>
                                </li>
                            <?php }?>

                        </ul>
                    </li>
                    <!-- config sub menu 1 -->
                    <script type="text/javascript">
                        configMenu('menu_main_admin_sub_1_3','<?=$showMainSub1?>');
                    </script>
                    <?php $showMainSub1=false;?>

                    <!-- Logs-->
                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'maintenances')){
                        $showMain = true;$showMainSub1=true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'maintenances'?>"><?=MessageUtil::getMessage('model_maintenances')?></a>
                            <span class="icon-thumbnail">M</span>
                        </li>
                    <?php }?>
                    <!-- END Logs-->


                </ul>
            </li><!-- End Admin-->
            <script type="text/javascript">
                configMenu('menu_main_admin','<?=$showMain?>');
            </script>
            <?php $showMain=false;$showMainSub1=false;?>
            <!--################# App Menu ######################-->

            <!-- Price Plan-->
            <?php if(ControllerUtil::isPermission($this->getDbConn(),'radgroup_detail_list')){
                $showMain = true;$showMainSub1=true;
                ?>
                <li>
                    <a href="<?=_BASEURL.'radgroupdetaillist'?>" class="detailed">
                        <span class="title"><?=MessageUtil::getMessage('model_radgroup_detail')?></span>
                        <span class="details"><?=MessageUtil::getMessage('model_radgroup_detail_title')?></span>
                    </a>
                    <span class="icon-thumbnail "><i class="fa fa-file-text"></i></span>
                </li>
            <?php }?>
            <!-- END Price Plan-->

            <!-- START ACCOUNT -->
            <li id="menu_main_account">
                <a href="javascript:;">
                    <span class="title"><?=MessageUtil::getMessage('model_account')?></span>
                    <span class=" arrow"></span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-user-plus"></i></span>
                <ul class="sub-menu">

                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'account_list')){
                        $showMain = true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'accountlist'?>"><?=MessageUtil::getMessage('model_account_maunal')?></a>
                            <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
                        </li>
                    <?php }?>
                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'account_excel_import')){
                        $showMain = true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'accountexcelimport'?>"><?=MessageUtil::getMessage('model_account_excel')?></a>
                            <span class="icon-thumbnail"><i class="fa fa-file-excel-o"></i></span>
                        </li>
                    <?php }?>
                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_permission_list')){
                        $showMain = true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'batchlist'?>"><?=MessageUtil::getMessage('model_account_batch')?></a>
                            <span class="icon-thumbnail"><i class="fa fa-magic"></i></span>
                        </li>
                    <?php }?>
                </ul>
            </li>
            <script type="text/javascript">
                configMenu('menu_main_account','<?=$showMain?>');
            </script>
            <?php $showMain=false;$showMainSub1=false;?>
            <!-- End ACCOUNT-->
            
            <!-- START Report -->
            <li id="menu_main_report">
                <a href="javascript:;">
                    <span class="title"><?=MessageUtil::getMessage('app_report')?></span>
                    <span class=" arrow"></span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-print"></i></span>
                <ul class="sub-menu">
                    <!-- Logs-->
                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'logs_list')){
                        $showMain = true;$showMainSub1=true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'loglist'?>"><?=MessageUtil::getMessage('model_log_list')?></a>
                            <span class="icon-thumbnail">L</span>
                        </li>
                    <?php }?>
                    <!-- END Logs-->

                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'app_report_accout_status')){
                        $showMain = true;
                        ?>
                        <li class="">
                            <a href="<?=_BASEURL.'accountReportStatus'?>"><?=MessageUtil::getMessage('app_report_accout_status')?></a>
                            <span class="icon-thumbnail"><i class="fa fa-print"></i></span>
                        </li>
                    <?php }?>
                </ul>
            </li>
            <script type="text/javascript">
                configMenu('menu_main_report','<?=$showMain?>');
            </script>
            <?php $showMain=false;$showMainSub1=false;?>
            <!-- End Report-->
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->


</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->