<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$cnfRadius = (isset($_V_DATA_TO_VIEW['cnfRadius'])) ? $_V_DATA_TO_VIEW['cnfRadius'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_cnf_radius')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_cnf_radius')?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- BEGIN PlACE PAGE CONTENT HERE -->

    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg">

        <!-- START PANEL -->
        <div class="panel panel-default portlet-basic-v">
            <div class="panel-heading">
                <div class="panel-title">
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_cnf_radius')?>
                </div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
            </div>
            <div class="panel-body">
                <form id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">


                    <div class="form-group required
                    <?php if(array_key_exists('ip_radius', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_cnf_radius_ip_radius')?></label>
                        <input class="form-control" value="<?=$cnfRadius->getIpRadius();?>" type="text" name="ip_radius" id="ip_radius" required>
                    </div><?php if(array_key_exists('ip_radius', $errorsFiled)){echo "<label for=\"ip_radius\" class=\"error\" id=\"ip_radius - error\">".$errorsFiled['ip_radius']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('secrete_redius', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_cnf_radius_secrete_redius')?></label>
                        <input class="form-control" value="<?=$cnfRadius->getSecreteRedius();?>" type="text" name="secrete_redius" id="secrete_redius" required>
                    </div><?php if(array_key_exists('secrete_redius', $errorsFiled)){echo "<label for=\"secrete_redius\" class=\"error\" id=\"secrete_redius - error\">".$errorsFiled['secrete_redius']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'dashboard'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

                </form>
            </div>
        </div>
        <!-- END PANEL -->

        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
</div>
<!-- END PAGE CONTENT -->
<?php include __SITE_PATH.'/application/views/include/appFooter.php'; ?>
</body>
</html>