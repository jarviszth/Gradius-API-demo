<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$nas = (isset($_V_DATA_TO_VIEW['nas'])) ? $_V_DATA_TO_VIEW['nas'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_nas')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'naslist'?>"><?=MessageUtil::getMessage('model_nas')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_nas')?></a></li>
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
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_nas')?>
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
                    <?php if(array_key_exists('nasname', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_nas_nasname')?></label>
                        <input class="form-control tip tip " data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_nas_nasname_hint')?>" value="<?=$nas->getNasname();?>" type="text" name="nasname" id="nasname" required>
                    </div><?php if(array_key_exists('nasname', $errorsFiled)){echo "<label for=\"nasname\" class=\"error\" id=\"nasname - error\">".$errorsFiled['nasname']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('shortname', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_nas_shortname')?></label>
                        <input class="form-control tip tip " data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_nas_shortname_hint')?>" value="<?=$nas->getShortname();?>" type="text" name="shortname" id="shortname" required>
                    </div><?php if(array_key_exists('shortname', $errorsFiled)){echo "<label for=\"shortname\" class=\"error\" id=\"shortname - error\">".$errorsFiled['shortname']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('type', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_nas_type')?></label>
                        <input class="form-control tip tip " data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_nas_type_hint')?>" value="<?=$nas->getType();?>" type="text" name="type" id="type" required>
                    </div><?php if(array_key_exists('type', $errorsFiled)){echo "<label for=\"type\" class=\"error\" id=\"type - error\">".$errorsFiled['type']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('ports', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_nas_ports')?></label>
                        <input class="form-control tip tip " data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_nas_ports_hint')?>" value="<?=$nas->getPorts();?>" type="text" name="ports" id="ports" required>
                    </div><?php if(array_key_exists('ports', $errorsFiled)){echo "<label for=\"ports\" class=\"error\" id=\"ports - error\">".$errorsFiled['ports']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('secret', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_nas_secret')?></label>
                        <input class="form-control tip tip " data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_nas_secret_hint')?>" value="<?=$nas->getSecret();?>" type="password" name="secret" id="secret" required>
                    </div><?php if(array_key_exists('secret', $errorsFiled)){echo "<label for=\"secret\" class=\"error\" id=\"secret - error\">".$errorsFiled['secret']." .</label>";}?>

                    <div class="form-group
                    <?php if(array_key_exists('description', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_nas_description')?></label>
                        <textarea name="description" id="description" class="form-control tip tip " data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_nas_description_hint')?>"><?=$nas->getDescription();?></textarea>

                    </div><?php if(array_key_exists('description', $errorsFiled)){echo "<label for=\"description\" class=\"error\" id=\"description - error\">".$errorsFiled['description']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'naslist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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