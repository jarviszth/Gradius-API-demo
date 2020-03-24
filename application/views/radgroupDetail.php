<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$radgroupDetail = (isset($_V_DATA_TO_VIEW['radgroupDetail'])) ? $_V_DATA_TO_VIEW['radgroupDetail'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_radgroup_detail')?></title>
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
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_radgroup_detail')?></a></li>
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
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_radgroup_detail')?>
                </div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
            </div>
            <div class="panel-body">
                <form id="form_id"  class="form-horizontal" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">


                    <div class="form-group required
                    <?php if(array_key_exists('groupname', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_radgroup_detail_groupname')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$radgroupDetail->getGroupname();?>" type="text" name="groupname" id="groupname" required>
                    </div>
					</div><?php if(array_key_exists('groupname', $errorsFiled)){echo "<label for=\"groupname\" class=\"error\" id=\"groupname - error\">".$errorsFiled['groupname']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('group_detail', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_radgroup_detail_group_detail')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$radgroupDetail->getGroupDetail();?>" type="text" name="group_detail" id="group_detail" required>
                    </div>
					</div><?php if(array_key_exists('group_detail', $errorsFiled)){echo "<label for=\"group_detail\" class=\"error\" id=\"group_detail - error\">".$errorsFiled['group_detail']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('start_ip', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_radgroup_detail_start_ip')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$radgroupDetail->getStartIp();?>" type="text" name="start_ip" id="start_ip">
                    </div>
					</div><?php if(array_key_exists('start_ip', $errorsFiled)){echo "<label for=\"start_ip\" class=\"error\" id=\"start_ip - error\">".$errorsFiled['start_ip']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('end_id', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_radgroup_detail_end_id')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$radgroupDetail->getEndId();?>" type="text" name="end_id" id="end_id">
                    </div>
					</div><?php if(array_key_exists('end_id', $errorsFiled)){echo "<label for=\"end_id\" class=\"error\" id=\"end_id - error\">".$errorsFiled['end_id']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'radgroupdetaillist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

                </form>
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