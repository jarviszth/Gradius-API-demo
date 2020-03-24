<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;

$cnfRadiusList = (isset($_V_DATA_TO_VIEW['cnfRadiusList'])) ? $_V_DATA_TO_VIEW['cnfRadiusList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title><?=MessageUtil::getMessage('model_cnf_radius')?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_cnf_radius')?></a></li>
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
                    <div class="panel-title"><?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_cnf_radius')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'cnfradiusadd'?>" class="btn btn-default"><?=MessageUtil::getMessage('app_add_new')?></a>
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
                        <table class="table table-hover" id="basicTable">
                            <thead>
                            <tr>
                                <th style="width:1%">
                                    <button class="btn"><i class="pg-trash"></i></button>
                                </th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_cnf_radius_ip_radius')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_cnf_radius_secrete_redius')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($cnfRadiusList) {
                                foreach ($cnfRadiusList AS $cnfRadius) {
                                    ?>
                                    <tr>
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$cnfRadius->getId()?>" name="check" id="checkbox<?=$cnfRadius->getId()?>">
                                                <label for="checkbox<?=$cnfRadius->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$cnfRadius->getIpRadius()?></p>
                                        </td>
                                        <td >
                                            <p><?=$cnfRadius->getSecreteRedius()?></p>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'cnfradiusedit?'.ControllerUtil::genParamId($cnfRadius)?>" class="btn btn-default tip tip m-b-5 m-r-5" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'cnfradiusdelete?'.ControllerUtil::genParamId($cnfRadius)?>" class="btn btn-danger tip tip m-b-5 m-r-5"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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