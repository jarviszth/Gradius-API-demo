<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\UploadUtil as UploadUtil;
use application\util\FilterUtils as FilterUtils;
use application\util\DateUtils as DateUtils;


$account = (isset($_V_DATA_TO_VIEW['account'])) ? $_V_DATA_TO_VIEW['account'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
$totalRows = (isset($_V_DATA_TO_VIEW['totalRows'])) ? $_V_DATA_TO_VIEW['totalRows'] : '';
$reportList = (isset($_V_DATA_TO_VIEW['reportList'])) ? $_V_DATA_TO_VIEW['reportList'] : array();
?>
<title><?=MessageUtil::getMessage('app_report_accout_authen')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'accountReportStatus'?>"><?=MessageUtil::getMessage('app_report_accout_status')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_report_accout_authen')?></a></li>
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
                <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('app_report_accout_authen')?></div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">

                <div class="alert alert-info m-t-10 text-center" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    <div class="clearfix"></div>
                    <p>
                        <span class="bold"><?=MessageUtil::getMessage('model_account_user_name')?> : </span>
                        <span class="fs-30"><?=$account->getUserName();?></span>
                    </p>
                    <p>
                        <span class="bold">Usage Time : </span>
                        <?php
                        $radaccSumUsageTime = $account->getSumUsageTimeSec();
                        $usageTime = "Unused";
                        if(!empty($radaccSumUsageTime)){
                            $usageInHors = DateUtils::secToHour($radaccSumUsageTime);
                            $usageTime= $usageInHors;
                        }
                        echo $usageTime;

                        ?>
                    </p>
                    <p>
                        <span class="bold"><?=MessageUtil::getMessage('model_account_status')?> : </span>
                        <?php

                        if($account->getOnlineStatus()>0){
                            $onlineDes = "<span class='text-success'>Online</span>";
                        }else{
                            $onlineDes = "<span class='text-danger'>Offline</span>";
                        }
                        echo $onlineDes;

                        ?>
                    </p>

                    <p>
                        <span class="bold">Total : </span>
                        <span class="fs-30"><?=$totalRows;?> session</span>
                    </p>
                </div>

                <!-- START SEARCH FORM -->
                <div class="row" style="display: none;">
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
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('username','ASC')?>">
                                    Username
                                </a>
                                <span id="displaySort_username"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('acctstarttime','ASC')?>">
                                    Start time
                                </a>
                                <span id="displaySort_acctstarttime"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('acctstarttime','ASC')?>">
                                    Status
                                </a>
                                <span id="displaySort_acctstarttime"></i></span>
                            </th>

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
                        if($reportList) {
                            foreach ($reportList AS $report) {
                                ?>
                                <tr>
                                    <td>
                                        <p><?=strtoupper($report['username'])?></p>
                                    </td>
                                    <td>
                                        <p><?=$report['authdate']?></p>
                                    </td>
                                    <td>
                                        <p>
                                            <?php

                                            if($report['reply'] =='Access-Accept'){
                                                echo '<i class="fa fa-check text-success"></i>';
                                            }else{
                                                echo '<i class="fa fa-times text-danger"></i>';
                                            }


                                            ?>
                                        </p>
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