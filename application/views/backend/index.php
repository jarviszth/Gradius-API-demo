<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtils;
use application\util\ControllerUtil as ControllerUtil;
?>
<title><?=MessageUtils::getMessage('app_system_name')?></title>
<!-- START PAGE CONTENT -->
<div class="content">

    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg ">

        <!-- BEGIN PlACE PAGE CONTENT HERE -->
        <div class="alert alert-info m-t-20" role="alert">
            <button class="close" data-dismiss="alert"></button>
            <strong>GRadius: </strong><?=MessageUtils::getMessage('model_msg_welcome')?>
        </div>



        <!-- START ROW-->
        <div class="row">

            <!-- START COL1-->
            <div class="col-md-6 col-xlg-5">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <div class="ar-3-2 widget-1-wrapper">
                            
                            <!-- START WIDGET widget_imageWidget-->
                            <div class="widget-1 panel no-border bg-complete no-margin widget-loader-circle-lg">
                                <div class="panel-heading top-right ">
                                    <div class="panel-controls">
                                        <ul>
                                            <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i
                                                        class="portlet-icon portlet-icon-refresh-lg-master"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="panel-body">
                                    <div class="pull-bottom bottom-left bottom-right ">
                                        <span class="label font-montserrat fs-11"><?=MessageUtils::getMessage('app_system_name')?></span>
                                        <br>
                                        <h2 class="text-white">Radius Management System</h2>
                                        <p class="text-white hint-text"><?=MessageUtils::getMessage('model_msg_systemname')?></p>
                                        <div class="row stock-rates m-t-15">
                                            <div class="company col-xs-4">
                                                <div>
                                                    <p class="font-montserrat text-warning no-margin fs-16">
                                                        <i class="fa fa-caret-up"></i> +0.95%
                                                    </p>
                                                    <p class="bold text-white no-margin fs-11 font-montserrat lh-normal">
                                                        <?=MessageUtils::getMessage('model_account_all')?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="company col-xs-4">
                                                <div>
                                                    <p class="font-montserrat text-success no-margin fs-16">
                                                        <i class="fa fa-caret-up"></i> -0.34%
                                                    </p>
                                                    <p class="bold text-white no-margin fs-11 font-montserrat lh-normal">
                                                        <?=MessageUtils::getMessage('model_account_online')?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="company col-xs-4">
                                                <div class="pull-right">
                                                    <p class="font-montserrat text-danger no-margin fs-16">
                                                        <i class="fa fa-caret-up"></i> +0.95%
                                                    </p>
                                                    <p class="bold text-white no-margin fs-11 font-montserrat lh-normal">
                                                        <?=MessageUtils::getMessage('model_account_offline')?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!-- END WIDGET -->
                        </div>
                    </div>
                </div>
            </div><!-- END COL1-->

            <!-- START COL2-->
            <div class="col-md-6 col-xlg-4">

                <!-- START ROW1-->
                <div class="row">


                    <div class="col-sm-6 m-b-10">
                        <div class="ar-1-1">
                            <!-- START WIDGET widget_imageWidgetBasic-->
                            <div class="panel no-border bg-primary widget widget-loader-circle-lg no-margin">
                                <div class="panel-heading">
                                    <div class="panel-controls">
                                        <ul>
                                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i
                                                        class="portlet-icon portlet-icon-refresh-lg-white"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'account_list')){
                                    ?>
                                    <div class="pull-bottom bottom-left bottom-right padding-25">
                                        <p><i class="fa fa-user" style="font-size: 100px;"></i></p>
                                        <h3 class="text-white"><?=MessageUtils::getMessage('model_account_maunal')?></h3>
                                        <a href="<?=_BASEURL.'accountlist'?>" class="text-white v-underline-hover">คลิกที่นี่เพื่อจัดการผู้ใช้</a>
                                    </div>
                                    <?php }?>

                                </div>
                            </div>
                            <!-- END WIDGET -->
                        </div>
                    </div>


                    <div class="col-sm-6 m-b-10">
                        <div class="ar-1-1">
                            <!-- START WIDGET widget_imageWidgetBasic-->
                            <div class="panel no-border bg-success widget widget-loader-circle-lg no-margin">
                                <div class="panel-heading">
                                    <div class="panel-controls">
                                        <ul>
                                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i
                                                        class="portlet-icon portlet-icon-refresh-lg-white"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if(ControllerUtil::isPermission($this->getDbConn(),'account_excel_import')){
                                    ?>
                                    <div class="pull-bottom bottom-left bottom-right padding-25">
                                        <p><i class="fa fa-file-excel-o" style="font-size: 100px;"></i></p>
                                        <h3 class="text-white"><?=MessageUtils::getMessage('model_account_excel')?></h3>
                                        <a href="<?=_BASEURL.'accountexcelimport'?>" class="text-white v-underline-hover">คลิกที่นี่เพื่อนำเข้าผู้ใช้ด้วย Excel File</a>
                                    </div>
                                    <?php }?>

                                </div>
                            </div>
                            <!-- END WIDGET -->
                        </div>
                    </div>
                </div><!-- END ROW1-->


                <!-- START ROW2-->
                <div class="row">

                    <div class="col-xs-6 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 panel no-border bg-info no-margin widget-loader-bar">
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="panel-heading top-left top-right">
                                            <div class="panel-title text-black hint-text">
                                                <span class="font-montserrat fs-11 all-caps text-white"><?=MessageUtils::getMessage('app_change_password')?>
                                                    </span>
                                            </div>
                                            <div class="panel-controls">
                                                <ul>
                                                    <li>
                                                        <a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i
                                                                class="portlet-icon portlet-icon-refresh"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white"><i class="fa fa-pencil" style="font-size: 50px;"></i></h3>
                                                    <p class="small hint-text m-t-5">
                                                        <a href="<?=_BASEURL.'appuserchangepwdsession'?>" class="text-white v-underline-hover">คลิกที่นี่เพื่อเปลี่ยนรหัสผ่าน</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>


                    <div class="col-xs-6 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 panel no-border bg-complete-dark no-margin widget-loader-bar">
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="panel-heading top-left top-right">
                                            <div class="panel-title text-black hint-text">
                                                <span class="font-montserrat fs-11 all-caps text-white"><?=MessageUtils::getMessage('app_setting')?>
                                                    </span>
                                            </div>
                                            <div class="panel-controls">
                                                <ul>
                                                    <li>
                                                        <a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i
                                                                class="portlet-icon portlet-icon-refresh"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-xs-height ">
                                    <div class="col-xs-height col-top relative">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="p-l-20">
                                                    <h3 class="no-margin p-b-5 text-white"><i class="fa fa-cogs" style="font-size: 50px;"></i></h3>
                                                    <p class="small hint-text m-t-5">
                                                        <?php if(ControllerUtil::isPermission($this->getDbConn(),'nas_list')){
                                                        ?>
                                                        <a  href="<?=_BASEURL.'naslist'?>" class="text-white v-underline-hover">Radius Client</a>
                                                        <?php }?>
                                                        <?php if(ControllerUtil::isPermission($this->getDbConn(),'config_radius_server')){
                                                        ?>
                                                        <span class="pull-right m-r-20 "><a  href="<?=_BASEURL.'cnfradiusedit?cnfradius=1'?>" class="text-white v-underline-hover">Radius Server</a></span>
                                                        <?php }?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>
                </div><!-- END ROW2-->

            </div><!-- END COL2-->


        </div><!-- END ROW-->








        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->





</div>
<!-- END PAGE CONTENT -->
<div id="test"></div>

<?php require __SITE_PATH.'/application/views/include/appFooter.php';
//echo "<script src=\"".__RESOURCES."/assets/plugins/skycons/skycons.js\"></script>";
?>





<script type="text/javascript">

    jQuery(function($) {

        /**
         * style ->bar
         * position->top,bottom
         */

//        $('body').pgNotification({
//            style: 'circle',//bar,flip,circle,simple
//            title: 'Chanavee Bekaku',
//            message: 'Welcome to Bekaku',
//            position: 'bottom-right',//top-left,top-right,bottom-left,bottom-right
//            timeout: 0,//1000 = 1sec, 0 is alway on
//            type: 'default',//info,warning,danger,success,default
//            thumbnail: '<img width="40" height="40" style="display: inline-block;" src="<?//=__RESOURCES.'/'?>//assets/img/profiles/avatar2x.jpg" data-src="<?//=__RESOURCES.'/'?>//assets/img/profiles/avatar.jpg" data-src-retina="<?//=__RESOURCES.'/'?>//assets/img/profiles/avatar2x.jpg" alt="">'
//        }).show();

        /* ============================================================
         * NVD3 Charts
         * ============================================================ */

        // Load chart data
    });
</script>

<script type="text/javascript">
    $(window).load(function() {
        //var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;
        //$('#test').html('Page load time is '+ loadTime);
    });
</script>
</body>
</html>