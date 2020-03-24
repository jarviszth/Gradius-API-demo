<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtils;
use application\util\ControllerUtil as ControllerUtil;

$fileArray = (isset($_V_DATA_TO_VIEW['file_array'])) ? $_V_DATA_TO_VIEW['file_array'] : array();
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


        <div class="row padding-10" style="display: none;">
            <div class="col-sm-4 padding-10">
                <button class="btn btn-danger btn-block maintanace-freeradius-stop" type="submit"><i class="fa fa-stop-circle"></i> Stop Radius</button>
            </div>
            <div class="col-sm-4 padding-10">
                <button class="btn btn-success btn-block" type="submit"><i class="fa fa-play-circle"></i>Start Radius</button>
            </div>
            <div class="col-sm-4 padding-10">
                <button class="btn btn-success btn-block" type="submit"><i class="fa fa-repeat"></i> Restart Radius</button>
            </div>

        </div>



        <!-- START ROW-->
        <div class="row">


            <!-- START COL2-->
            <div class="col-md-12 col-xlg-6">



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
                                                <span class="font-montserrat fs-11 all-caps text-white"><?=MessageUtils::getMessage('app_backup_db_menu')?>
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
                                                    <h3 class="no-margin p-b-5 text-white"><i class="fa fa-download" style="font-size: 50px;"></i></h3>
                                                    <p class="small hint-text m-t-5">
                                                        <?php if(ControllerUtil::isPermission($this->getDbConn(),'maintenances')){
                                                        ?>
                                                        <a href="#" data-os="<?php echo MessageUtils::getConfig('production_os')?>" class="text-white v-underline-hover app-maintenances-backup"><?=MessageUtils::getMessage('app_backup_db_click')?></a>
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


                    <div class="col-xs-6 m-b-10">
                        <!-- START WIDGET D3 widget_graphTileFlat-->
                        <div class="widget-8 panel no-border bg-complete-dark no-margin widget-loader-bar">
                            <div class="container-xs-height full-height">
                                <div class="row-xs-height">
                                    <div class="col-xs-height col-top">
                                        <div class="panel-heading top-left top-right">
                                            <div class="panel-title text-black hint-text">
                                                <span class="font-montserrat fs-11 all-caps text-white"><?=MessageUtils::getMessage('app_restore_db_menu')?>
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
                                                    <h3 class="no-margin p-b-5 text-white"><i class="fa fa-upload" style="font-size: 50px;"></i></h3>
                                                    <p class="small hint-text m-t-5">
                                                        <?php if(ControllerUtil::isPermission($this->getDbConn(),'maintenances')){
                                                        ?>
                                                        <a  href="<?=_BASEURL.'maintenancesDbRestoreForm'?>" class="text-white v-underline-hover"><?=MessageUtils::getMessage('app_restore_db_click')?></a>
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

        <!-- START ROW2-->
        <div class="row">

            <!-- START PANEL -->
            <div class="panel panel-default portlet-basic-v">
                <div class="panel-heading separator">
                    <div class="panel-title fs-16"><i class="fa fa-list"></i> 
                        Database List
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="basicTable">
                            <thead>
                            <tr>
                                <th>
                                        Databases

                                </th>
                                <th class="text-right"><?=MessageUtils::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if(is_array($fileArray)){
                                foreach ($fileArray AS $fileName){
                                    ?>
                                    <tr>
                                        <td>
                                            <p><?=$fileName?></p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'maintenancesDbDownload?_db='.$fileName?>" class="btn btn-primary tip" data-toggle="tooltip" data-original-title="Download"><i class="fa fa-download"></i></a>
                                                <a href="#" data-file-name="<?=$fileName?>" class="app-maintenances-delete btn btn-danger tip"  data-toggle="tooltip" data-original-title="<?=MessageUtils::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
                                            </div>

                                        </td>
                                    </tr>
                            <?php
                                }

                            }
                            ?>




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PANEL -->
        </div>





        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->





</div>
<!-- END PAGE CONTENT -->
<div id="test"></div>

<?php require __SITE_PATH . '/application/views/include/appFooter.php';
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