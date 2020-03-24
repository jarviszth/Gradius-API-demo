<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appUserRole = (isset($_V_DATA_TO_VIEW['appUserRole'])) ? $_V_DATA_TO_VIEW['appUserRole'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_user_role')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'app-user-role-list'?>"><?=MessageUtil::getMessage('model_app_user_role')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_user_role')?></a></li>
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
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_user_role')?>
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
                <form id="form_id" class="form-horizontal" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">

                    <div class="form-group required
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_user_role_name')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appUserRole->getName();?>" type="text" name="name" id="name" required>
                    </div>
					</div><?php if(array_key_exists('name', $errorsFiled)){echo "<label for=\"name\" class=\"error\" id=\"name-error\">".$errorsFiled['name']." .</label>";}?>



                    <div class="form-group required
                      <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">
                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_user_role_description')?></label>
                       <div class="col-sm-8"> <textarea id="description" name="description" style="min-height: 100px" class="form-control"><?=$appUserRole->getDescription();?></textarea>
                    </div>
					</div> <?php if(array_key_exists('description', $errorsFiled)){echo "<label for=\"description\" class=\"error\" id=\"description-error\">".$errorsFiled['description']." .</label>";}?>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('app_status')?></label>
                        <div class="col-sm-8"><select name="status" id="status" class="full-width" data-init-plugin="select2">
                                <option value="1" <?php if($appUserRole->isStatus()){echo 'selected';}?>>Yes</option>
                                <option value="0" <?php if(!$appUserRole->isStatus()){echo 'selected';}?>>No</option>
                        </select></div>
                    </div>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'appuserrolelist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>


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