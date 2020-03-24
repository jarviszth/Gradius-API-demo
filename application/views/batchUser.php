<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;
//use application\util\UploadUtil as UploadUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$batchUser = (isset($_V_DATA_TO_VIEW['batchUser'])) ? $_V_DATA_TO_VIEW['batchUser'] : array();
//$img = UploadUtil::displayAvatarThumnailPubic($batchUser->getImgName(),$batchUser->getCreatedDate());
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_batch_user')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'batchuserlist'?>"><?=MessageUtil::getMessage('model_batch_user')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_batch_user')?></a></li>
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
        <div class="panel panel-default portlet-basic-v v-border-radius-4">
            <div class="panel-heading separator m-b-10">
                <div class="panel-title fs-16">
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_batch_user')?>
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
                <form id="form_id" class="form-horizontal" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" enctype="multipart/form-data" method="post" role="form">


                    <div class="form-group required
                    <?php if(array_key_exists('batch', $errorsFiled)){echo "has-error";}?> ">

                        <label for="batch"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_batch')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getBatch();?>" type="text" name="batch" id="batch" required>
                        </div>
                    </div><?php if(array_key_exists('batch', $errorsFiled)){echo "<label class=\"error\" id=\"batch-error\">".$errorsFiled['batch']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('account', $errorsFiled)){echo "has-error";}?> ">

                        <label for="account"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_account')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getAccount();?>" type="text" name="account" id="account" required>
                        </div>
                    </div><?php if(array_key_exists('account', $errorsFiled)){echo "<label class=\"error\" id=\"account-error\">".$errorsFiled['account']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('user_name', $errorsFiled)){echo "has-error";}?> ">

                        <label for="user_name"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_user_name')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getUserName();?>" type="text" name="user_name" id="user_name" required>
                        </div>
                    </div><?php if(array_key_exists('user_name', $errorsFiled)){echo "<label class=\"error\" id=\"user_name-error\">".$errorsFiled['user_name']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('password', $errorsFiled)){echo "has-error";}?> ">

                        <label for="password"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_password')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getPassword();?>" type="text" name="password" id="password" required>
                        </div>
                    </div><?php if(array_key_exists('password', $errorsFiled)){echo "<label class=\"error\" id=\"password-error\">".$errorsFiled['password']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('start_date', $errorsFiled)){echo "has-error";}?> ">

                        <label for="start_date"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_start_date')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getStartDate();?>" type="text" name="start_date" id="start_date" required>
                        </div>
                    </div><?php if(array_key_exists('start_date', $errorsFiled)){echo "<label class=\"error\" id=\"start_date-error\">".$errorsFiled['start_date']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('expired_date', $errorsFiled)){echo "has-error";}?> ">

                        <label for="expired_date"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_expired_date')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getExpiredDate();?>" type="text" name="expired_date" id="expired_date" required>
                        </div>
                    </div><?php if(array_key_exists('expired_date', $errorsFiled)){echo "<label class=\"error\" id=\"expired_date-error\">".$errorsFiled['expired_date']." .</label>";}?>

                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label text-right"><?=MessageUtil::getMessage('app_status')?></label>
                        <div  class="col-sm-8">
                        <select name="status" id="status" class="full-width" data-init-plugin="select2">
                                <option value="1" <?php if($batchUser->isStatus()){echo 'selected';}?>>Yes</option>
                                <option value="0" <?php if(!$batchUser->isStatus()){echo 'selected';}?>>No</option>
                        </select>
                        </div>
                    </div>


                    <div class="form-group required
                    <?php if(array_key_exists('rate_limit', $errorsFiled)){echo "has-error";}?> ">

                        <label for="rate_limit"  class="col-sm-3 control-label text-right"><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_user_rate_limit')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$batchUser->getRateLimit();?>" type="text" name="rate_limit" id="rate_limit" required>
                        </div>
                    </div><?php if(array_key_exists('rate_limit', $errorsFiled)){echo "<label class=\"error\" id=\"rate_limit-error\">".$errorsFiled['rate_limit']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> <?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'batchuserlist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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