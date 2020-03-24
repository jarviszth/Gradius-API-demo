<?php
include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
$appTableList = (isset($_V_DATA_TO_VIEW['appTableList'])) ? $_V_DATA_TO_VIEW['appTableList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title>App Table</title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                        <li><p>Pages</p></li>
                        <li><a href="" class="active">Table</a></li>
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
                    <div class="panel-title fs-16"><i class="fa fa-list"></i> App Table
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
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'apptableadd'?>" class="btn btn-default">Add new</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings</a>
                            </li>
                            <li><a href="#">Help</a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="basicTable">
                            <thead>
                            <tr>
                                <!-- NOTE * : Inline Style Width For Table Cell is Required as it may differ from user to user
                                                Comman Practice Followed
                                                -->
                                <th style="width:1%">
                                    <button class="btn"><i class="pg-trash"></i>
                                    </button>
                                </th>
                                <th>Table</th>
                                <th>Description</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if($appTableList) {
                                foreach ($appTableList AS $appTable) {
                                    ?>
                                    <tr id="hide_tr_<?=$appTable->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$appTable->getId()?>" name="check" id="checkbox<?=$appTable->getId()?>">
                                                <label for="checkbox<?=$appTable->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$appTable->getAppTableName()?></p>
                                        </td>
                                        <td >
                                            <p><?=$appTable->getDescription()?></p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'apptableedit?'.ControllerUtil::genParamId($appTable)?>" class="btn btn-default tip" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'apptabledelete?'.ControllerUtil::genParamId($appTable)?>" data-id-hide="hide_tr_<?=$appTable->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip"  data-toggle="tooltip" data-original-title="Delete"  ><i class="fa fa-trash-o"></i></a>
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