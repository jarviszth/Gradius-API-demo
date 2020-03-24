<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\DateUtils as DateUtils;

$radgroupDetail = (isset($_V_DATA_TO_VIEW['radgroupDetail'])) ? $_V_DATA_TO_VIEW['radgroupDetail'] : array();
$radgroupcheckList = (isset($_V_DATA_TO_VIEW['radgroupcheckList'])) ? $_V_DATA_TO_VIEW['radgroupcheckList'] : array();
$radgroupreplyList = (isset($_V_DATA_TO_VIEW['radgroupreplyList'])) ? $_V_DATA_TO_VIEW['radgroupreplyList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
<title><?=MessageUtil::getMessage('model_radgroupcheckreply_attribute').' '.$radgroupDetail->getGroupname()?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                        <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="<?=_BASEURL.'radgroupdetaillist'?>"><?=MessageUtil::getMessage('model_radgroup_detail')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_radgroupcheckreply_attribute').' '.$radgroupDetail->getGroupname()?></a></li>
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
                <div class="panel-heading separator">
                    <div class="panel-title">
                        <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_radgroup_detail')?>
                    </div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">



                    <!-- START GROUP DETAIL -->
                    <div class="row">
                        <div class="col-md-3">
                            &nbsp;
                        </div>
                        <div class="col-md-6">




                            <div class="alert alert-info m-t-10" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <div class="clearfix"></div>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroup_detail_groupname')?> : </span>
                                    <span class="fs-30"><?=$radgroupDetail->getGroupname();?></span>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroup_detail_group_detail')?> : </span>
                                    <?=$radgroupDetail->getGroupDetail();?>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroup_detail_start_ip')?> : </span>
                                    <?=$radgroupDetail->getStartIp();?>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroup_detail_end_id')?> : </span>
                                    <?=$radgroupDetail->getEndId();?>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroup_detail_created_date')?> : </span>
                                    <?=DateUtils::time_ago($radgroupDetail->getCreatedDate());?>
                                </p>
                            </div>


                        </div>
                        <div class="col-md-3">
                            &nbsp;
                        </div>
                    </div><!-- END GROUP DETAIL -->


                    <h4>Attribute List</h4>
                    <p>
                        <a href="<?=_BASEURL.'radgroupcheckadd?'.ControllerUtil::genParamId($radgroupDetail)?>" class="btn btn-success"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
                        <a href="<?=_BASEURL.'radgroupdetaillist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_back')?></a>

                    </p>

                    <!-- START Attribute List -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="basicTable">
                            <thead>
                            <tr>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_radgroupcheckreply_attribute')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('model_radgroupcheckreply_value')?></th>
                                <th style="width:1%"><?=MessageUtil::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //radgroup check list selected by this group
                            if($radgroupcheckList) {
                                foreach ($radgroupcheckList AS $radgroupcheck) {
                                    ?>
                                    <tr id="hide_tr_check<?=$radgroupcheck->getId()?>">
                                        <td >
                                            <p><?=$radgroupcheck->getAttribute()?></p>
                                        </td>
                                        <td >
                                            <p><?=$radgroupcheck->getValue()?></p>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'radgroupcheckedit?'.ControllerUtil::genParamId($radgroupDetail)?>&_radcheckreply=check&_attribute=<?=$radgroupcheck->getId()?>" class="btn btn-default tip tip m-b-5 m-r-5" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'radgroupcheckdelete?'.ControllerUtil::genParamId($radgroupDetail)?>&_radcheckreply=check&_attribute=<?=$radgroupcheck->getId()?>" data-id-hide="hide_tr_check<?=$radgroupcheck->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip tip m-b-5 m-r-5"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                                    ?>

                            <?php
                            //radgroup reply list selected by this group
                            if($radgroupreplyList) {
                                foreach ($radgroupreplyList AS $radgroupreply) {
                                    ?>
                                    <tr id="hide_tr_<?=$radgroupreply->getId()?>">
                                        <td >
                                            <p><?=$radgroupreply->getAttribute()?></p>
                                        </td>
                                        <td >
                                            <p><?=$radgroupreply->getValue()?></p>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'radgroupcheckedit?'.ControllerUtil::genParamId($radgroupDetail)?>&_radcheckreply=reply&_attribute=<?=$radgroupreply->getId()?>" class="btn btn-default tip tip m-b-5 m-r-5" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'radgroupcheckdelete?'.ControllerUtil::genParamId($radgroupDetail)?>&_radcheckreply=reply&_attribute=<?=$radgroupreply->getId()?>" data-id-hide="hide_tr_<?=$radgroupreply->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip tip m-b-5 m-r-5"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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
                    <!-- END Attribute List -->




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