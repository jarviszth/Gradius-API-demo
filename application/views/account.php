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
                <div class="panel-title fs-16">
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_account')?>
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
                <form id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" class="form-horizontal" enctype="multipart/form-data" method="post" role="form">
                    <div class="form-group text-center">
                        <img  width="120" src="<?=$img?>" data-src="<?=$img?>" data-src-retina="<?=$img?>" alt="">
                        <?php
                        if($account->getImgName()){
                            ?>
                            <div class="checkbox check-danger">
                                <input type="checkbox" value="1" id="img_del" name="img_del">
                                <label for="img_del"><?=MessageUtil::getMessage('app_img_delete')?></label>
                            </div>
                            <input type="hidden" name="img_name" id="img_name" value="<?=$account->getImgName();?>" />
                            <?php
                        }
                        ?>
                    </div>

                    <div class="form-group m-b-10 form-files">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('app_img')?></label>
                        <div class="col-sm-8">
                            <input type="file" id="img_upload" name="img_upload" value="<?=MessageUtil::getMessage('app_img_choose')?>" />
                        </div>
                    </div>

                    <div class="form-group required
                    <?php if(array_key_exists('user_name', $errorsFiled)){echo "has-error";}?> ">

                        <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_user_name')?></label>
                        <div class="col-sm-8">
                            <input class="form-control" value="<?=$account->getUserName();?>" type="text" name="user_name" id="user_name" required>
                        </div>
                    </div><?php if(array_key_exists('user_name', $errorsFiled)){echo "<label for=\"user_name\" class=\"error\" id=\"user_name - error\">".$errorsFiled['user_name']." .</label>";}?>




                    <?php
                    if($fromAction=='add'){?>
                    <div class="form-group required
                    <?php if(array_key_exists('pr', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_appuser_password')?></label>
                        <div class="col-sm-8">
                            <input class="form-control" value="" type="password" name="password" id="password" >
                        </div>

                    </div><?php if(array_key_exists('pr', $errorsFiled)){echo "<label for=\"password\" class=\"error\" id=\"password - error\">".$errorsFiled['pr']." .</label>";}?>

                    <div class="form-group required
                    <?php if(array_key_exists('confirmpwd', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_appuser_confirmpwd')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="" type="password" name="confirmpwd" id="confirmpwd" >
                        </div>
                    </div><?php if(array_key_exists('confirmpwd', $errorsFiled)){echo "<label for=\"confirmpwd\" class=\"error\" id=\"confirmpwd-error\">".$errorsFiled['confirmpwd']." .</label>";}?>

                    <?php }elseif($fromAction=='edit'){ ?>
                        <input type="hidden" name="pr" id="pr" value="dummy" />
                   <?php } ?>



                    <div class="form-group required
                    <?php if(array_key_exists('radusergroup_detail', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_radusergroup_detail')?></label>
                        <div class="col-sm-8">
                            <select name="radusergroup_detail" id="radusergroup_detail" class="full-width" data-init-plugin="select2">
                                <?php
                                if($radgroupDetailList){
                                    foreach($radgroupDetailList as $radgroupDetail){

                                        $selected = ($account->getRadusergroupDetail() == $radgroupDetail->getId()) ? "selected" : "";
                                        echo "<option $selected value=\"".$radgroupDetail->getId()."\">".$radgroupDetail->getGroupname()."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                    </div><?php if(array_key_exists('radusergroup_detail', $errorsFiled)){echo "<label for=\"radusergroup_detail\" class=\"error\" id=\"radusergroup_detail - error\">".$errorsFiled['radusergroup_detail']." .</label>";}?>

                    <div class="form-group
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_name')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$account->getName();?>" type="text" name="name" id="name">
                        </div>

                    </div><?php if(array_key_exists('name', $errorsFiled)){echo "<label for=\"name\" class=\"error\" id=\"name - error\">".$errorsFiled['name']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('lastname', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_lastname')?></label>
                        <div class="col-sm-8">
                            <input class="form-control" value="<?=$account->getLastname();?>" type="text" name="lastname" id="lastname">
                        </div>
                    </div><?php if(array_key_exists('lastname', $errorsFiled)){echo "<label for=\"lastname\" class=\"error\" id=\"lastname - error\">".$errorsFiled['lastname']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('id_card', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_id_card')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$account->getIdCard();?>" type="text" name="id_card" id="id_card">
                        </div>
                    </div><?php if(array_key_exists('id_card', $errorsFiled)){echo "<label for=\"id_card\" class=\"error\" id=\"id_card - error\">".$errorsFiled['id_card']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('phonenumber', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_phonenumber')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$account->getPhonenumber();?>" type="text" name="phonenumber" id="phonenumber">
                        </div>
                    </div><?php if(array_key_exists('phonenumber', $errorsFiled)){echo "<label for=\"phonenumber\" class=\"error\" id=\"phonenumber - error\">".$errorsFiled['phonenumber']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('email', $errorsFiled)){echo "has-error";}?> ">

                         <label  class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_email')?></label>
                        <div class="col-sm-8">
                        <input class="form-control" value="<?=$account->getEmail();?>" type="email" name="email" id="email">
                        </div>
                    </div><?php if(array_key_exists('email', $errorsFiled)){echo "<label for=\"email\" class=\"error\" id=\"email - error\">".$errorsFiled['email']." .</label>";}?>



                    <br>
                    <?php
                    if($fromAction=='add'){?>


                    <input class="btn btn-success" type="submit"
                           onclick="return radiusRegformhash(this.form,
						this.form.user_name,
						this.form.password,
						this.form.confirmpwd);" value="<?=MessageUtil::getMessage('app_submit')?>"/>

                    <?php
                    }else{
                        ?>
                        <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <?php
                    }
                    ?>

                    <a href="<?=_BASEURL.'accountlist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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