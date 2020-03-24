<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\ControllerUtil as ControllerUtil;
use application\util\FilterUtils as FilterUtil;
use application\util\AppUtil as AppUtils;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appPermissionList = (isset($_V_DATA_TO_VIEW['appPermissionList'])) ? $_V_DATA_TO_VIEW['appPermissionList'] : array();
$permissionSelectByRoleArray = (isset($_V_DATA_TO_VIEW['permissionSelectByRoleArray'])) ? $_V_DATA_TO_VIEW['permissionSelectByRoleArray'] : array();
$appUserRole = (isset($_V_DATA_TO_VIEW['appUserRole'])) ? $_V_DATA_TO_VIEW['appUserRole'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').'Role Permission'?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'appuserrolelist'?>"><?=MessageUtil::getMessage('model_app_user_role')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' Role Permission '?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- BEGIN PlACE PAGE CONTENT HERE -->
    <?php ControllerUtil::displayAppMsg();?>

    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg">

        <!-- START PANEL -->
        <div class="panel panel-default portlet-basic-v">
            <div class="panel-heading">
                <div class="panel-title">
                    <?=MessageUtil::getMessage('app_form').' Role Permission'?>
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

                <!-- START GROUP DETAIL -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info m-t-10" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            <div class="clearfix"></div>
                            <p>
                                <span class="bold"><?=MessageUtil::getMessage('model_app_user_role')?> : </span>
                                <span class="fs-30"><?=$appUserRole->getName();?></span>
                            </p>
                        </div>
                    </div>
                </div><!-- END GROUP DETAIL -->

                <form name="form_name" id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">

                    <div class="col-md-3">
                        <div class="checkbox check-success checkbox-circle">
                            <input type="checkbox" name="permissionAll" id="permissionAll">
                            <label for="permissionAll">Select All</label>
                        </div>
                    </div>
                    <br>

                    <?php
                    if($appPermissionList) {
                        $curentCrud = null;
                        $crudTable = null;
                        $no=0;
                        foreach ($appPermissionList AS $appPermission) {

                            if (ControllerUtil::isPermission($this->getDbConn(), $appPermission->getName())) {


                                $no++;
                                $crudTable = $appPermission->getCrudTable();
                                $isCheck = "";
                                if (in_array($appPermission->getId(), $permissionSelectByRoleArray)) {
                                    $isCheck = "checked=\"checked\"";
                                }

                                if ($no == 1) {
                                    $curentCrud = $crudTable;
                                    ?>
                                    <div class="col-md-2">
                                        <div class="checkbox check-danger">
                                            <input <?= $isCheck ?> type="checkbox"
                                                                   value="<?= $appPermission->getId() ?>"
                                                                   name="permission[]"
                                                                   id="permission<?= $appPermission->getId() ?>">
                                            <label
                                                for="permission<?= $appPermission->getId() ?>"><?= $appPermission->getDescription() ?></label>
                                        </div>
                                    </div>
                                    <?php
                                } else if ($curentCrud == $crudTable) {
                                    ?>
                                    <div class="col-md-2">
                                        <div class="checkbox check-danger">
                                            <input <?= $isCheck ?> type="checkbox"
                                                                   value="<?= $appPermission->getId() ?>"
                                                                   name="permission[]"
                                                                   id="permission<?= $appPermission->getId() ?>">
                                            <label
                                                for="permission<?= $appPermission->getId() ?>"><?= $appPermission->getDescription() ?></label>
                                        </div>
                                    </div>
                                    <?php
                                } else if ($curentCrud != $crudTable) {
                                    $curentCrud = $crudTable;
                                    ?>
                                    <br>
                                    <div class="col-md-2">
                                        <div class="checkbox check-danger">
                                            <input <?= $isCheck ?> type="checkbox"
                                                                   value="<?= $appPermission->getId() ?>"
                                                                   name="permission[]"
                                                                   id="permission<?= $appPermission->getId() ?>">
                                            <label
                                                for="permission<?= $appPermission->getId() ?>"><?= $appPermission->getDescription() ?></label>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>


                            <?php }
                        }
                    }
                    ?>
                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'appuserrolelist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>


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
<script type="text/javascript">
    $(document).ready(function(){
        $("#permissionAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>
</body>
</html>