<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtils;

$nasList = (isset($_V_DATA_TO_VIEW['nasList'])) ? $_V_DATA_TO_VIEW['nasList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title><?=MessageUtil::getMessage('model_nas')?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_nas')?></a></li>
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
                    <div class="panel-title"><?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_nas')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'nasadd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
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



                    <!-- START SEARCH FORM -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- START PANEL -->
                            <div class="panel panel-default bg-grey-light">
                                <div class="panel-body">
                                    <form role="form" id="form_search" method="get">
                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_nas_nasname')?></label>
                                            <input id="q_nasname" name="q_nasname" value="<?=FilterUtils::filterGetString('q_nasname')?>" placeholder="<?=MessageUtil::getMessage('model_nas_nasname')?>" type="text" class="form-control" >
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_nas_shortname')?></label>
                                            <input id="q_shortname" name="q_shortname" value="<?=FilterUtils::filterGetString('q_shortname')?>" placeholder="<?=MessageUtil::getMessage('model_nas_shortname')?>" type="text" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_nas_type')?></label>
                                            <input id="q_type" name="q_type" value="<?=FilterUtils::filterGetString('q_type')?>" placeholder="<?=MessageUtil::getMessage('model_nas_type')?>" type="text" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_nas_ports')?></label>
                                            <input id="q_ports" name="q_ports" value="<?=FilterUtils::filterGetString('q_ports')?>" placeholder="<?=MessageUtil::getMessage('model_nas_ports')?>" type="text" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_nas_description')?></label>
                                            <input id="q_description" name="q_description" value="<?=FilterUtils::filterGetString('q_description')?>" placeholder="<?=MessageUtil::getMessage('model_nas_description')?>" type="text" class="form-control" >
                                        </div>

                                        <br>
                                        <div class="form-group col-md-12">
                                            <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'naslist'?>','get','form_search')" class="btn btn-complete tip  pull-right" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- END PANEL -->
                        </div>
                    </div>
                    <!-- END SEARCH FORM -->




                    <div class="table-responsive">
                        <table class="table table-hover" id="basicTable">
                            <thead>
                            <tr>
                                <th style="width:1%">
                                    <div class="checkbox check-danger tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_select_all')?>">
                                        <input type="checkbox" name="checkBoxAll" id="checkBoxAll">
                                        <label for="checkBoxAll"></label>
                                    </div>
                                </th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_nas_nasname')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_nas_shortname')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_nas_type')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_nas_ports')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_nas_description')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($nasList) {
                                foreach ($nasList AS $nas) {
                                    ?>
                                    <tr id="hide_tr_<?=$nas->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$nas->getId()?>" name="check" id="checkbox<?=$nas->getId()?>">
                                                <label for="checkbox<?=$nas->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$nas->getNasname()?></p>
                                        </td>
                                        <td >
                                            <p><?=$nas->getShortname()?></p>
                                        </td>
                                        <td >
                                            <p><?=$nas->getType()?></p>
                                        </td>
                                        <td >
                                            <p><?=$nas->getPorts()?></p>
                                        </td>
                                        <td >
                                            <p><?=$nas->getDescription()?></p>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'nasedit?'.ControllerUtil::genParamId($nas)?>" class="btn btn-default tip tip m-b-5 m-r-5" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'nasdelete?'.ControllerUtil::genParamId($nas)?>" data-id-hide="hide_tr_<?=$nas->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip tip m-b-5 m-r-5"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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
<?php include __SITE_PATH.'/application/views/include/appFooter.php'; ?>
</body>
</html>