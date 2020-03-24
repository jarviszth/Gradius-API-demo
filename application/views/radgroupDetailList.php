<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtils;
$radgroupDetailList = (isset($_V_DATA_TO_VIEW['radgroupDetailList'])) ? $_V_DATA_TO_VIEW['radgroupDetailList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title><?=MessageUtil::getMessage('model_radgroup_detail')?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_radgroup_detail')?></a></li>
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
                    <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_radgroup_detail')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'radgroupdetailadd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
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
                                            <label><?=MessageUtil::getMessage('model_radgroup_detail_groupname')?></label>
                                            <input id="q_groupname" name="q_groupname" value="<?=FilterUtils::filterGetString('q_groupname')?>" placeholder="<?=MessageUtil::getMessage('model_radgroup_detail_groupname')?>" type="text" class="form-control" >
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_radgroup_detail_group_detail')?></label>
                                            <input id="q_group_detail" name="q_group_detail" value="<?=FilterUtils::filterGetString('q_group_detail')?>" placeholder="<?=MessageUtil::getMessage('model_radgroup_detail_group_detail')?>" type="text" class="form-control" >
                                        </div>

                                        <br>
                                        <div class="form-group col-md-12">
                                            <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'radgroupdetaillist'?>','get','form_search')" class="btn btn-complete tip  pull-right" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- END PANEL -->
                        </div>
                    </div>
                    <!-- END SEARCH FORM -->


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
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('groupname','ASC')?>">
                                        <?=MessageUtil::getMessage('model_radgroup_detail_groupname')?>
                                    </a>
                                    <span id="displaySort_groupname"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('group_detail','ASC')?>">
                                        <?=MessageUtil::getMessage('model_radgroup_detail_group_detail')?>
                                    </a>
                                    <span id="displaySort_groupname"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('start_ip','ASC')?>">
                                        <?=MessageUtil::getMessage('model_radgroup_detail_start_ip')?>
                                    </a>
                                    <span id="displaySort_start_ip"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('end_id','ASC')?>">
                                        <?=MessageUtil::getMessage('model_radgroup_detail_end_id')?>
                                    </a>
                                    <span id="displaySort_end_id"></i></span>
                                </th>
                                <th class="text-right"><?=MessageUtil::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <?php
                            $curentSortMode = FilterUtils::filterGetString('sortMode');
                            $curentSortField = FilterUtils::filterGetString('sortField');
                            $iconSort = '';
                            if($curentSortMode == "DESC"){
                                $iconSort = "&nbsp;<i class=\"fa fa-sort-desc\"></i>";
                            }else if($curentSortMode == "ASC"){
                                $iconSort = "&nbsp;<i class=\"fa fa-sort-asc\"></i>";
                            }
                            ?>
                            <script>
                                $(document).ready(function(){
                                    var displayField = '#displaySort_<?=$curentSortField?>';
                                    $(displayField).html('<?=$iconSort?>');
                                });
                            </script>
                            <tbody>
                            <?php
                            if($radgroupDetailList) {
                                foreach ($radgroupDetailList AS $radgroupDetail) {
                                    ?>
                                    <tr id="hide_tr_<?=$radgroupDetail->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$radgroupDetail->getId()?>" name="check" id="checkbox<?=$radgroupDetail->getId()?>">
                                                <label for="checkbox<?=$radgroupDetail->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$radgroupDetail->getGroupname()?></p>
                                        </td>
                                        <td >
                                            <p><?=$radgroupDetail->getGroupDetail()?></p>
                                        </td>
                                        <td >
                                            <p><?=$radgroupDetail->getStartIp()?></p>
                                        </td>
                                        <td >
                                            <p><?=$radgroupDetail->getEndId()?></p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'accountlist?q_radusergroup_detail='.$radgroupDetail->getId()?>" class="btn btn-success tip tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_account_group_user')?>"><i class="fa fa-user"></i></a>
                                                <a href="<?=_BASEURL.'radgroupchecklist?'.ControllerUtil::genParamId($radgroupDetail)?>" class="btn btn-primary tip tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_radgroup_detail_attribute_manage')?>"><i class="fa fa-cog"></i></a>
                                                <a href="<?=_BASEURL.'radgroupdetailedit?'.ControllerUtil::genParamId($radgroupDetail)?>" class="btn btn-default tip tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'radgroupdetaildelete?'.ControllerUtil::genParamId($radgroupDetail)?>" data-id-hide="hide_tr_<?=$radgroupDetail->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip tip"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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