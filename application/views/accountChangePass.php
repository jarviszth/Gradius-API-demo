<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;
use application\util\UploadUtil as UploadUtils;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$account = (isset($_V_DATA_TO_VIEW['account'])) ? $_V_DATA_TO_VIEW['account'] : array();
$radgroupDetailList = (isset($_V_DATA_TO_VIEW['radgroupDetailList'])) ? $_V_DATA_TO_VIEW['radgroupDetailList'] : array();
$fromAction = (isset($_V_DATA_TO_VIEW['fromAction'])) ? $_V_DATA_TO_VIEW['fromAction'] : '';


$img = UploadUtils::displayAvatarThumnailPubic($account->getImgName(),$account->getCreatedDate());
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_account')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'accountlist'?>"><?=MessageUtil::getMessage('model_account')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_account')?></a></li>
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
            <div class="panel-heading separator m-b-10">
                <div class="panel-title">
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_account')?>
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
                <form id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" enctype="multipart/form-data" method="post" role="form">
                    <div class="form-group text-center">
                        <img width="120" src="<?=$img?>" data-src="<?=$img?>" data-src-retina="<?=$img?>" alt="">
                    </div>
                    <div class="form-group required
                    <?php if(array_key_exists('user_name', $errorsFiled)){echo "has-error";}?>  m-t-20 ">

                        <label  class="label-lg"><?=MessageUtil::getMessage('model_account_user_name')?></label>
                        <input readonly class="form-control" value="<?=$account->getUserName();?>" type="text" name="user_name" id="user_name" required>
                    </div><?php if(array_key_exists('user_name', $errorsFiled)){echo "<label for=\"user_name\" class=\"error\" id=\"user_name - error\">".$errorsFiled['user_name']." .</label>";}?>

                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('pr', $errorsFiled)){echo "has-error";}?> ">

                        <label  class="label-lg"><?=MessageUtil::getMessage('model_appuser_password')?></label>
                        <input class="form-control" value="" type="password" name="password" id="password" >
                    </div><?php if(array_key_exists('pr', $errorsFiled)){echo "<label for=\"password\" class=\"error\" id=\"password - error\">".$errorsFiled['pr']." .</label>";}?>

                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('confirmpwd', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_appuser_confirmpwd')?></label>
                        <input class="form-control" value="" type="password" name="confirmpwd" id="confirmpwd" >
                    </div><?php if(array_key_exists('confirmpwd', $errorsFiled)){echo "<label for=\"confirmpwd\" class=\"error\" id=\"confirmpwd-error\">".$errorsFiled['confirmpwd']." .</label>";}?>


                    <br>
                    <input class="btn btn-success" type="button"
                           onclick="radiusRegformChangePassHash(this.form,this.form.password,this.form.confirmpwd);"
                           value="<?=MessageUtil::getMessage('app_submit')?>"/>


                    <a href="<?=_BASEURL.'accountlist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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