<?php
include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;

$appProvinceList = (isset($_V_DATA_TO_VIEW['appProvinceList'])) ? $_V_DATA_TO_VIEW['appProvinceList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title><?=MessageUtil::getMessage('model_app_province')?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_app_province')?></a></li>
                    </ul>
                    <!-- END BREADCRUMB -->
                </div>
            </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- BEGIN PlACE PAGE CONTENT HERE -->

        <!-- START CONTAINER FLUID -->
        <div class="container-fluid container-fixed-lg ">

            <!-- START PANEL -->
            <div class="panel panel-default portlet-basic-v">
                <div class="panel-heading separator m-b-10">
                    <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_app_province')?></div>
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
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'appprovinceadd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
                        <a href="#testurl" class="btn btn-danger"><i class="fa fa-trash"></i> <?=MessageUtil::getMessage('app_delete_seleted')?></a>
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="basicTable">
                            <thead>
                            <tr>
                                <th style="width:1%">
                                    <div class="checkbox check-danger tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_select_all')?>">
                                        <input type="checkbox" name="checkBoxAll" id="checkBoxAll">
                                        <label for="checkBoxAll"></label>
                                    </div>
                                </th>
                                <th ><?=MessageUtil::getMessage('model_app_province_code')?></th>
                                <th ><?=MessageUtil::getMessage('model_app_province_name')?></th>
                                <th><?=MessageUtil::getMessage('model_app_province_name_eng')?></th>
                                <th ><?=MessageUtil::getMessage('model_app_province_app_geography')?></th>
                                <th class="text-right"><?=MessageUtil::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($appProvinceList) {
                                foreach ($appProvinceList AS $appProvince) {
                                    ?>
                                    <tr id="hide_tr_<?=$appProvince->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$appProvince->getId()?>" name="check" id="checkbox<?=$appProvince->getId()?>">
                                                <label for="checkbox<?=$appProvince->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$appProvince->getCode()?></p>
                                        </td>
                                        <td >
                                            <p><?=$appProvince->getName()?></p>
                                        </td>
                                        <td >
                                            <p><?=$appProvince->getNameEng()?></p>
                                        </td>
                                        <td >
                                            <p><?=$appProvince->getAppGeographyName()?></p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'appprovinceedit?'.ControllerUtil::genParamId($appProvince)?>" class="btn btn-default tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'appprovincedelete?'.ControllerUtil::genParamId($appProvince)?>" data-id-hide="hide_tr_<?=$appProvince->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                                    ?>
                            </tbody>
                        </table>
                        <?php echo $appPagination;?>
                    </div>
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