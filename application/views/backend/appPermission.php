<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\ControllerUtil as ControllerUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appPermission = (isset($_V_DATA_TO_VIEW['appPermission'])) ? $_V_DATA_TO_VIEW['appPermission'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_permission')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'apppermissionlist'?>"><?=MessageUtil::getMessage('model_app_permission')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_permission')?></a></li>
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
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_permission')?>
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
                <form id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">


                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                        <label><?=MessageUtil::getMessage('model_app_permission_name')?></label>
                        <input class="form-control" value="<?=$appPermission->getName();?>" type="text" name="name" id="name" required>
                    </div><?php if(array_key_exists('name', $errorsFiled)){echo "<label for=\"name\" class=\"error\" id=\"name - error\">".$errorsFiled['name']." .</label>";}?>


                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('description', $errorsFiled)){echo "has-error";}?> ">

                        <label><?=MessageUtil::getMessage('model_app_permission_description')?></label>
                        <input class="form-control" value="<?=$appPermission->getDescription();?>" type="text" name="description" id="description" required>
                    </div><?php if(array_key_exists('description', $errorsFiled)){echo "<label for=\"description\" class=\"error\" id=\"description - error\">".$errorsFiled['description']." .</label>";}?>

                    <div class="form-group">
                        <label>Crud Permission</label>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="list" id="list">
                            <label for="list">List</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="add" id="add">
                            <label for="add">Add</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="edit" id="edit" >
                            <label for="edit">Edit</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="delete" id="delete">
                            <label for="delete">Delete</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="view" id="view">
                            <label for="view">View</label>
                        </div>


                    <div class="form-group form-group-default">
                        <label><?=MessageUtil::getMessage('app_status')?></label>
                        <select name="status" id="status" class="full-width" data-init-plugin="select2">
                                <option value="1" <?php if($appPermission->isStatus()){echo 'selected';}?>>Yes</option>
                                <option value="0" <?php if(!$appPermission->isStatus()){echo 'selected';}?>>No</option>
                        </select>
                    </div>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'apppermissionlist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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