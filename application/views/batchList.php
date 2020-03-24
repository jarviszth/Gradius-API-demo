<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtils;
use application\util\DateUtils as DateUtils;
use application\util\AppUtil as AppUtils;

$batchList = (isset($_V_DATA_TO_VIEW['batchList'])) ? $_V_DATA_TO_VIEW['batchList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title><?=MessageUtil::getMessage('model_batch')?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_batch')?></a></li>
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
            <div class="panel panel-default portlet-basic-v v-border-radius-4">
                <div class="panel-heading separator m-b-10">
                    <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_batch')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'batchadd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> <?=MessageUtil::getMessage('app_delete_seleted')?></a>
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
                                        <label><?=MessageUtil::getMessage('model_batch_batch_name')?></label>
                                      <input id="q_batch_name" name="q_batch_name" value="<?=FilterUtils::filterGetString('q_batch_name')?>" placeholder="<?=MessageUtil::getMessage('model_batch_batch_name')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_batch_description')?></label>
                                      <input id="q_descriptions" name="q_descriptions" value="<?=FilterUtils::filterGetString('q_descriptions')?>" placeholder="<?=MessageUtil::getMessage('model_batch_description')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_batch_user_status')?></label>
                                        <select name="q_active" id="q_active" class="full-width" data-init-plugin="select2">
                                            <option value="1" <?php if(FilterUtils::filterGetInt('q_active')==1){echo 'selected';}?>><?=MessageUtil::getMessage('app_enable')?></option>
                                            <option value="0" <?php if(FilterUtils::filterGetInt('q_active')==0){echo 'selected';}?>><?=MessageUtil::getMessage('app_disable')?></option>
                                            <option value="" <?php if(AppUtils::isEmpty(FilterUtils::filterGetInt('q_active'))){echo 'selected';}?>>&nbsp;</option>
                                        </select>
                                    </div>

                                    <br>
                                    <div class="form-group col-md-12">
                                           <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'batchlist'?>','get','form_search')" class="btn btn-complete tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END PANEL -->
                    </div>
                </div><!-- END SEARCH FORM -->
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
                                    <a href="<?=ControllerUtil::uriSortConcat('batch_name','ASC')?>">
                                       <?=MessageUtil::getMessage('model_batch_batch_name')?>
                                    </a>
                                    <span id="displaySort_batch_name"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('descriptions','ASC')?>">
                                       <?=MessageUtil::getMessage('model_batch_description')?>
                                    </a>
                                    <span id="displaySort_descriptions"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('volume','ASC')?>">
                                       <?=MessageUtil::getMessage('model_batch_volume')?>
                                    </a>
                                    <span id="displaySort_volume"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('created_date','ASC')?>">
                                       <?=MessageUtil::getMessage('model_batch_create_date')?>
                                    </a>
                                    <span id="displaySort_create_date"></i></span>
                                </th>
                                <th>
                                    <a href="<?=ControllerUtil::uriSortConcat('active','ASC')?>">
                                       <?=MessageUtil::getMessage('model_batch_active')?>
                                    </a>
                                    <span id="displaySort_active"></i></span>
                                </th>
                                <th class="text-right"><?=MessageUtil::getMessage('app_tool')?></th>
                            </tr>
                            </thead>
                            <?php
                            $curentSortMode = FilterUtils::filterGetString('sortMode');
                            $curentSortField = FilterUtils::filterGetString('sortField');
                            $iconSort = '';
                            if($curentSortMode == "DESC"){
                                $iconSort = "&nbsp;<i class=\"fa fa - sort - desc\"></i>";
                            }else if($curentSortMode == "ASC"){
                                $iconSort = "&nbsp;<i class=\"fa fa - sort - asc\"></i>";
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
                            if($batchList) {
                                foreach ($batchList AS $batch) {
                                    ?>
                                    <tr id="hide_tr_<?=$batch->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$batch->getId()?>" name="check" id="checkbox<?=$batch->getId()?>">
                                                <label for="checkbox<?=$batch->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$batch->getBatchName()?></p>
                                        </td>
                                        <td >
                                            <p><?=$batch->getDescriptions()?></p>
                                        </td>
                                        <td >
                                            <p><?=$batch->getVolume()?></p>
                                        </td>
                                        <td >
                                            <p><?=DateUtils::getThaiDate($batch->getCreatedDate(),true) ?></p>
                                        </td>
                                        <td >
                                            <p><?php
                                                if($batch->getActive()==1){
                                                    echo '<i class="fa fa-check text-success"></i>';
                                                }else{
                                                    echo '<i class="fa fa-times text-danger"></i>';
                                                }
                                                ?></p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'batchuserlist?batch='.$batch->getId();?>" class="btn btn-info tip" data-toggle="tooltip" data-original-title="User In Group"><i class="fa fa-users"></i></a>
                                                <a href="<?=_BASEURL.'batchdelete?'.ControllerUtil::genParamId($batch)?>" data-id-hide="hide_tr_<?=$batch->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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