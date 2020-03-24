<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\UploadUtil as UploadUtil;
use application\util\FilterUtils as FilterUtils;
use application\util\DateUtils as DateUtils;


$accountList = (isset($_V_DATA_TO_VIEW['accountList'])) ? $_V_DATA_TO_VIEW['accountList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
$radgroupDetailList = (isset($_V_DATA_TO_VIEW['radgroupDetailList'])) ? $_V_DATA_TO_VIEW['radgroupDetailList'] : array();
?>
<title><?=MessageUtil::getMessage('app_report_accout_status')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_report_accout_status')?></a></li>
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
                <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('model_account')?></div>
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
                                        <label><?=MessageUtil::getMessage('model_account_user_name')?></label>
                                        <input id="q_user_name" name="q_user_name" value="<?=FilterUtils::filterGetString('q_user_name')?>" placeholder="<?=MessageUtil::getMessage('model_account_user_name')?>" type="text" class="form-control" >
                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'accountlist'?>','get','form_search')" class="btn btn-complete tip  pull-right" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
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
                                <a href="<?=ControllerUtil::uriSortConcat('online_status','ASC')?>">
                                    <?=MessageUtil::getMessage('model_account_status')?>
                                </a>
                                <span id="displaySort_online_status"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('user_name','ASC')?>">
                                    <?=MessageUtil::getMessage('model_account_user_name')?>
                                </a>
                                <span id="displaySort_user_name"></i></span>

                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('name','ASC')?>">
                                    <?=MessageUtil::getMessage('model_account_name')?>
                                </a>
                                <span id="displaySort_name"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('lastname','ASC')?>">
                                    <?=MessageUtil::getMessage('model_account_lastname')?>
                                </a>
                                <span id="displaySort_lastname"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('price_plan_name','ASC')?>">
                                    <?=MessageUtil::getMessage('model_account_radusergroup_detail')?>
                                </a>
                                <span id="displaySort_price_plan_name"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('sum_usage_time_sec','ASC')?>">
                                    Usage Time
                                </a>
                                <span id="displaySort_sum_usage_time_sec"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('last_post_authen','ASC')?>">
                                    Last authen time
                                </a>
                                <span id="displaySort_last_post_authen"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('created_date','ASC')?>">
                                    Created Date
                                </a>
                                <span id="displaySort_created_date"></i></span>
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

                        <div id="test_43"></div>
                        <?php
                        if($accountList) {
                            foreach ($accountList AS $account) {

                                $avatar = UploadUtil::displayAvatarThumnailPubic($account['img_name'],$account['created_date']);
                                $radaccSumUsageTime = $account['sum_usage_time_sec'];
                                $usageTime = "Unused";
                                if(!empty($radaccSumUsageTime)){
                                    $usageInHors = DateUtils::secToHour($radaccSumUsageTime);
                                    $usageTime= $usageInHors;
                                }


                                ?>
                                <tr id="hide_tr_<?=$account['id']?>">
                                    <td >
                                        <div class="checkbox check-danger">
                                            <input type="checkbox" value="<?=$account['id']?>" name="check" id="checkbox<?=$account['id']?>">
                                            <label for="checkbox<?=$account['id']?>"></label>
                                        </div>
                                    </td>
                                    <td>

                                        <?php
                                        $onlineDes = "";
                                        $onlineDesCss = "style=\"background-color: #119c18;text-align: center;padding: 3px;color: #ffffff;\"";

                                        if(empty($radaccSumUsageTime)){
                                            $onlineDes = $usageTime;
                                            $onlineDesCss = "style=\"background-color: #d52309;text-align: center;padding: 3px;color: #ffffff;\"";
                                        }else{
                                            if($account['online_status']>0){
                                                $onlineDes = "<span id='status_".$account['id']."'>Online</span>";
                                                $onlineDesCss = "style=\"background-color: #119c18;text-align: center;padding: 3px;color: #ffffff;\"";
                                            }else{
                                                $onlineDesCss = "style=\"background-color: #4c81a4;text-align: center;padding: 3px;color: #ffffff;\"";
                                                $onlineDes = "<span id='status_".$account['id']."'>Offline</span>";
                                            }
                                        }
                                        ?>

                                        <p <?=$onlineDesCss?>>
                                            <?=$onlineDes?>
                                        </p>
                                    </td>
                                    <td >
                                        <p><?=$account['user_name']?></p>
                                    </td>
                                    <td >
                                        <p><?=$account['name']?></p>
                                    </td>
                                    <td >
                                        <p><?=$account['lastname']?></p>
                                    </td>
                                    <td>
                                        <p><?=$account['price_plan_name']?></p>
                                    </td>
                                    <td>
                                        <p>
                                            <?=$usageTime ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p><?=(!empty($account['last_post_authen']) ? DateUtils::getThaiDate($account['last_post_authen'], true, true): "" ) ?></p>
                                    </td>
                                    <td>
                                        <p><?=DateUtils::getThaiDate($account['created_date'], true, true)?></p>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                       <a href="#" span-status-id="status_--><?//=$account['id']?><!--" data-username="--><?//=$account['user_name']?><!--" class="btn btn-warning tip app-kick-offline" data-toggle="tooltip" data-original-title="เตะออกจากระบบ"><i class="fa fa-sign-out"></i></a>
                                            <a href="<?=_BASEURL.'accountReportUsageTime?_user_name='.$account['user_name']?>" class="btn btn-primary tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_report_accout_usage_detail')?>"><i class="fa fa-eye"></i></a>
                                            <a href="<?=_BASEURL.'accountReportAuthen?_user_name='.$account['user_name']?>" class="btn btn-warning tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_report_accout_authen')?>"><i class="fa fa-sign-in"></i></a>
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
    $(document).ready(function(){

    });
</script>
</body>
</html>