<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;
use application\util\AppUtil as AppUtil;
use application\util\UploadUtil as UploadUtil;
use application\util\ControllerUtil as ControllerUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appUser = (isset($_V_DATA_TO_VIEW['appUser'])) ? $_V_DATA_TO_VIEW['appUser'] : array();
$appUserRoleList = (isset($_V_DATA_TO_VIEW['appUserRoleList'])) ? $_V_DATA_TO_VIEW['appUserRoleList'] : array();
$appUserRolesArray = (isset($_V_DATA_TO_VIEW['appUserRolesArray'])) ? $_V_DATA_TO_VIEW['appUserRolesArray'] : array();

$avatar = UploadUtil::displayAvatarThumnailPubic($appUser->getImgName(),$appUser->getCreatedDate());
?>
    <title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_user')?></title>

    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                        <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="<?=_BASEURL.'appuserlist'?>"><?=MessageUtil::getMessage('model_app_user')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_user')?></a></li>
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
                        <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_user')?>
                    </div>
					                <div class="panel-controls">
                    <ul>
                        <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a>
                        </li>
                        <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a>
                        </li>
                        <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a>
                        </li>
                        <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a>
                        </li>
                    </ul>
                </div>
                </div>
                <div class="panel-body">
                    <form id="form_id" class="form-horizontal" name="registration_form" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" enctype="multipart/form-data" method="post" role="form">

                        <!-- Start Img  -->
                        <div class="form-group text-center">
                            <img  width="120" src="<?=$avatar?>" data-src="<?=$avatar?>" data-src-retina="<?=$avatar?>" alt="">
                            <?php
                            if($appUser->getImgName()){
                                ?>
                                <div class="checkbox check-danger">
                                    <input type="checkbox" value="1" id="img_del" name="img_del">
                                    <label for="img_del"><?=MessageUtil::getMessage('app_img_delete')?></label>
                                </div>
                                <input type="hidden" name="img_name" id="img_name" value="<?=$appUser->getImgName();?>" />
                            <?php
                            }
                            ?>
                        </div>

                        <div class="form-group m-b-10">

                            <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('app_img')?></label>
							<div class="col-sm-8">
                            <input type="file" id="img_upload" name="img_upload" value="<?=MessageUtil::getMessage('app_img_choose')?>" />
							</div>
                        </div>
                        <!-- End Img  -->


                        <div class="form-group required
                    <?php if(array_key_exists('username', $errorsFiled)){echo "has-error";}?> ">

                            <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_appuser_username')?></label>
                            <div class="col-sm-8"><input class="form-control" value="<?=$appUser->getUsername();?>" type="text" name="username" id="username" required>
                        </div>
						</div><?php if(array_key_exists('username', $errorsFiled)){echo "<label for=\"username\" class=\"error\" id=\"username-error\">".$errorsFiled['username']." .</label>";}?>

                        <div class="form-group required
                    <?php if(array_key_exists('email', $errorsFiled)){echo "has-error";}?> ">

                            <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_appuser_email')?></label>
                            <div class="col-sm-8"><input class="form-control" value="<?=$appUser->getEmail();?>" type="text" name="email" id="email" required>
							</div>
                        </div><?php if(array_key_exists('email', $errorsFiled)){echo "<label for=\"email\" class=\"error\" id=\"email-error\">".$errorsFiled['email']." .</label>";}?>

                        <div class="form-group form-group-default-select2 required">
                            <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_user_role')?></label>
                            <div class="col-sm-8"><select id="app_user_role" name="app_user_role_select[]" class="full-width" data-init-plugin="select2" multiple required>


                                <?php
                                if($appUserRoleList){

                                    foreach($appUserRoleList as $appUserRole){
                                        $isSelected = "";
                                        if(in_array($appUserRole->getId(), $appUserRolesArray)) {
                                            $isSelected = "selected";
                                        }
                                        $isCanShow = true;
                                        if($appUserRole->getId()==ControllerUtil::$DEVELOP_ROLE_ID){
                                            if(!ControllerUtil::isPermission($this->getDbConn(),'app_table_list')){
                                                $isCanShow = false;
                                            }
                                        }
                                        if($isCanShow) {
                                            echo "<option " . $isSelected . " value=\"" . $appUserRole->getId() . "\">" . AppUtil::getUpperFirstString($appUserRole->getName()) . "</option>";
                                        }
                                    }

                                }
                                ?>

                            </select></div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('app_status')?></label>
							<div class="col-sm-8">
                            <select name="status" id="status" class="full-width" data-init-plugin="select2">
                                <option value="1" <?php if($appUser->isStatus()){echo 'selected';}?>>Yes</option>
                                <option value="0" <?php if(!$appUser->isStatus()){echo 'selected';}?>>No</option>
                            </select>
							</div>
                        </div>

                        <br>
                        <input class="btn btn-success" type="submit" value="<?=MessageUtil::getMessage('app_submit')?>"/>

                        <a href="<?=_BASEURL.'appuserlist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>


                    </form>
                </div>
            </div>
            <!-- END PANEL -->

            <!-- END PLACE PAGE CONTENT HERE -->
        </div>
        <!-- END CONTAINER FLUID -->
    </div>
    <!-- END PAGE CONTENT -->

<?php include __SITE_PATH . '/application/views/include/appFooter.php'; ?>

</body>
</html>