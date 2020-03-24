<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtils;
use application\util\AppUtil as AppUtils;
use application\util\DateUtils as DateUtils;

$batchUserList = (isset($_V_DATA_TO_VIEW['batchUserList'])) ? $_V_DATA_TO_VIEW['batchUserList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
$batch = (isset($_V_DATA_TO_VIEW['batch'])) ? $_V_DATA_TO_VIEW['batch'] : array();

$startDate="";$expireDate="";
if(!empty($batchUserList)){
    $batchUserTitle = $batchUserList[0];
    $startDate = $batchUserTitle->getStartDate();
    $expireDate = $batchUserTitle->getExpiredDate();
}


?>
    <title><?=MessageUtil::getMessage('model_batch_user').' "'.$batch->getBatchName().'"'?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                        <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="<?=_BASEURL.'batchlist'?>"><?=MessageUtil::getMessage('model_batch')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_batch_user')?></a></li>
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
                    <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_batch_user').' "'.$batch->getBatchName().'"'?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'batchuserprint?batch='.$batch->getId()?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</a>
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


                    <div class="row">
                        <div class="col-md-12">

                            <div class="alert alert-info m-t-10" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <div class="clearfix"></div>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_batch_batch_name')?> : </span>
                                    <span class="fs-30"><?=$batch->getBatchName();?></span>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_batch_description')?> : </span>
                                    <?=$batch->getDescriptions();?>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_batch_volume')?> : </span>
                                    <?=$batch->getVolume();?>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_batch_user_start_date')?> : </span>
                                    <?=DateUtils::getThaiDate($startDate, true);?>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_batch_user_expired_date')?> : </span>
                                    <?=DateUtils::getThaiDate($expireDate, true);?>
                                </p>
                            </div>
                            
                            
                        </div>
                    </div>


			<!-- START SEARCH FORM -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- START PANEL -->
                        <div class="panel panel-default bg-grey-light">
                            <div class="panel-body">
                                <form role="form" id="form_search" method="get">





                                    <?php
                                    if(!empty($batch)){
                                        echo "<input type=\"hidden\" name=\"batch\" value=\"".$batch->getId()."\">";
                                    }
                                    ?>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_batch_user_user_name')?></label>
                                      <input id="q_user_name" name="q_user_name" value="<?=FilterUtils::filterGetString('q_user_name')?>" placeholder="<?=MessageUtil::getMessage('model_batch_user_user_name')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_batch_user_status')?></label>
                                        <select name="q_status" id="q_status" class="full-width" data-init-plugin="select2">

                                            <?php
                                            $getQStatus = FilterUtils::filterGetInt('q_status');
                                            ?>
                                            <option value="1" <?php if($getQStatus==1){echo 'selected';}?>><?=MessageUtil::getMessage('app_enable')?></option>
                                            <option value="0" <?php if($getQStatus==0){echo 'selected';}?>><?=MessageUtil::getMessage('app_disable')?></option>
                                            <option value="" <?php if(AppUtils::isEmpty($getQStatus)){echo 'selected';}?>>&nbsp;</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                           <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'batchuserlist'?>','get','form_search')" class="btn btn-complete tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
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
                                    <a href="<?=ControllerUtil::uriSortConcat('user_name','ASC')?>">
                                       <?=MessageUtil::getMessage('model_batch_user_user_name')?>
                                    </a>
                                    <span id="displaySort_user_name"></i></span>
                                </th>
                                <th><?=MessageUtil::getMessage('app_status')?></th>
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

                            if($batchUserList) {
                                foreach ($batchUserList AS $batchUser) {
                                    ?>
                                    <tr id="hide_tr_<?=$batchUser->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$batchUser->getId()?>" name="check" id="checkbox<?=$batchUser->getId()?>">
                                                <label for="checkbox<?=$batchUser->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$batchUser->getUserName()?></p>
                                        </td>
                                        <td >
                                            <p><?php
                                                if($batchUser->isStatus() && (DateUtils::convertDateToTimeStamp(DateUtils::getDateNow()) > DateUtils::convertDateToTimeStamp($batchUser->getExpiredDate()))){
                                                    $batchUser->setStatus(false);
                                                }
                                                $stateHtml="";
                                                if($batchUser->isStatus()){
                                                    $stateHtml = "checked=\"checked\"";
                                                }else{
                                                    $stateHtml = "";
                                                }
                                                ?>
                                                <input type="checkbox" data-id="<?=$batchUser->getId()?>" class="radioStatusChange" data-init-plugin="switchery" <?=$stateHtml?> />
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'batchuserdelete?batchuser='.$batchUser->getId()?>" data-id-hide="hide_tr_<?=$batchUser->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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

<script type="text/javascript">
    $(window).load(function() {

        $("body").on("change", ".radioStatusChange", function(){

            var batchUserId = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: $BASE_URL+'batchuserinactive',//when send parameter from url in Controller get value of parameter with $_GET
                data: "_batch_user_id="+batchUserId,//when send parameter from url in Controller get value of parameter with $_POST
                contentType: "application/x-www-form-urlencoded", //For encode to utf8
                cache: false,
                success: function(html){
                    console.log(html);
                }
            });

        });





    });
</script>

</body>
</html>