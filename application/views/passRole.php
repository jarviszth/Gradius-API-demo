<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$passRole = (isset($_V_DATA_TO_VIEW['passRole'])) ? $_V_DATA_TO_VIEW['passRole'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_pass_role')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_pass_role')?></a></li>
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
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_pass_role')?>
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
                    <?php if(array_key_exists('pass_lenght', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_pass_role_pass_lenght')?></label>
                        <input class="form-control" value="<?=$passRole->getPassLenght();?>" type="text" name="pass_lenght" id="pass_lenght" required>
                    </div><?php if(array_key_exists('pass_lenght', $errorsFiled)){echo "<label for=\"pass_lenght\" class=\"error\" id=\"pass_lenght - error\">".$errorsFiled['pass_lenght']." .</label>";}?>


                    <div class="form-group">
                        <label class="label-lg"><?=MessageUtil::getMessage('model_pass_role_mix_no')?></label>
                        <select name="mix_no" id="mix_no" class="full-width" data-init-plugin="select2">
                            <option value="1" <?php if($passRole->getMixNo()==1){echo 'selected';}?>><?=MessageUtil::getMessage('app_enable')?></option>
                            <option value="0" <?php if($passRole->getMixNo()==0){echo 'selected';}?>><?=MessageUtil::getMessage('app_disable')?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label-lg"><?=MessageUtil::getMessage('model_pass_role_special_char')?></label>
                        <select name="special_char" id="special_char" class="full-width" data-init-plugin="select2">
                            <option value="1" <?php if($passRole->getSpecialChar()==1){echo 'selected';}?>><?=MessageUtil::getMessage('app_enable')?></option>
                            <option value="0" <?php if($passRole->getSpecialChar()==0){echo 'selected';}?>><?=MessageUtil::getMessage('app_disable')?></option>
                        </select>
                    </div>


                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'passrolelist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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