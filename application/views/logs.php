<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtils;
use application\util\ControllerUtil as ControllerUtil;
?>
<title><?=MessageUtils::getMessage('app_system_name')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtils::getMessage('app_home')?></a></li>
                    <li><a href="" class="active">Logs</a></li>
                </ul>
                <!-- END BREADCRUMB -->
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg ">

        <!-- START ROW-->
        <div class="row">


            <!-- START PANEL -->
            <div class="panel panel-default portlet-basic-v">
                <div class="panel-heading">
                    <div class="panel-title">Logs</div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="#" class="btn btn-danger app-delete-logs-confirm"><i class="fa fa-trash"></i> Clear Logs</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body" style="max-height: 400px;overflow: auto">
                    <?php include(__SITE_PATH."/resources/logs/loginLogs.php");?>
                </div>
            </div>
            <!-- END PANEL -->


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