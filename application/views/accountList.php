<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\UploadUtil as UploadUtil;
use application\util\FilterUtils as FilterUtils;

$accountList = (isset($_V_DATA_TO_VIEW['accountList'])) ? $_V_DATA_TO_VIEW['accountList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
$radgroupDetailList = (isset($_V_DATA_TO_VIEW['radgroupDetailList'])) ? $_V_DATA_TO_VIEW['radgroupDetailList'] : array();
?>
<title><?=MessageUtil::getMessage('model_account')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('model_account')?></a></li>
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
                <div class="panel-controls">
                    <ul>
                        <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                        <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                        <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                        <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                    </ul>
                </div>
                <div class="btn-group pull-right m-b-10">
                    <a href="<?=_BASEURL.'accountadd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
                    <a href="#" class="btn btn-danger app-delete-seletedall-confirm"><i class="fa fa-trash"></i> <?=MessageUtil::getMessage('app_delete_seleted')?></a>
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
                                        <label><?=MessageUtil::getMessage('model_account_user_name')?></label>
                                        <input id="q_user_name" name="q_user_name" value="<?=FilterUtils::filterGetString('q_user_name')?>" placeholder="<?=MessageUtil::getMessage('model_account_user_name')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_account_name')?></label>
                                        <input id="q_name" name="q_name" value="<?=FilterUtils::filterGetString('q_name')?>" placeholder="<?=MessageUtil::getMessage('model_account_name')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_account_lastname')?></label>
                                        <input id="q_lastname" name="q_lastname" value="<?=FilterUtils::filterGetString('q_lastname')?>" placeholder="<?=MessageUtil::getMessage('model_account_lastname')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_account_radusergroup_detail')?></label>
                                        <select name="q_radusergroup_detail" id="q_radusergroup_detail" class="full-width" data-init-plugin="select2">
                                            <?php
                                            if($radgroupDetailList){
                                                echo "<option value=\"\">Select</option>";
                                                foreach($radgroupDetailList as $radgroupDetail){

                                                    $selected = (FilterUtils::filterGetString('q_radusergroup_detail') == $radgroupDetail->getId()) ? "selected" : "";
                                                    echo "<option $selected value=\"".$radgroupDetail->getId()."\">".$radgroupDetail->getGroupname()."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_batch_user_status')?></label>
                                        <select name="q_online_status" id="q_online_status" class="full-width" data-init-plugin="select2">
                                            <option value="1" <?php if(FilterUtils::filterGetInt('q_online_status')==1){echo 'selected';}?>>Online</option>
                                            <option value="0" <?php if(FilterUtils::filterGetInt('q_online_status')==0){echo 'selected';}?>>Offline</option>
                                            <option value="" <?php if(empty(FilterUtils::filterGetInt('q_online_status'))){echo 'selected';}?>>&nbsp;</option>
                                        </select>
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
                                <?=MessageUtil::getMessage('model_account_img_name')?>

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
                                <a href="<?=ControllerUtil::uriSortConcat('online_status','ASC')?>">
                                    <?=MessageUtil::getMessage('model_account_status')?>
                                </a>
                                <span id="displaySort_online_status"></i></span>
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
                                ?>
                                <tr id="hide_tr_<?=$account['id']?>">
                                    <td >
                                        <div class="checkbox check-danger">
                                            <input type="checkbox" value="<?=$account['id']?>" name="check" id="checkbox<?=$account['id']?>">
                                            <label for="checkbox<?=$account['id']?>"></label>
                                        </div>
                                    </td>
                                    <td >
                                        <div class="thumbnail-wrapper d48 circular bordered b-white">
                                            <img alt="Avatar" width="55" height="55" data-src-retina="<?=$avatar?>" data-src="<?=$avatar?>" src="<?=$avatar?>">
                                        </div>
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
                                            <?php
                                            if($account['online_status']>0){
                                                echo "<span  class='text-success'>Online</span>";
                                            }else{
                                                echo "<span  class='text-danger'>Offline</span>";
                                            }
                                            ?>
                                        </p>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">

                                            <span id="status_<?=$account['id']?>">
                                            <?php
                                            if($account['status']==1){
                                            ?>
                                                <a href="#" span-status-id="status_<?=$account['id']?>" data-username="<?=$account['id']?>" class="btn btn-success tip app-kick-offline" data-toggle="tooltip" data-original-title="บล็อกผู้ใช้นี้"><i class="fa fa-unlock"></i></a>
                                            <?php }else{?>
                                                <a href="#" span-status-id="status_<?=$account['id']?>" data-username="<?=$account['id']?>" class="btn btn-warning tip app-kick-offline" data-toggle="tooltip" data-original-title="ปลดบล็อกผู้ใช้นี้"><i class="fa fa-lock"></i></a>
                                                <?php
                                            }
                                            ?>
                                         </span>



                                            <a href="<?=_BASEURL.'accountchangepwd?account='.$account['id']?>" class="btn btn-primary tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_appuser_password_change')?>"><i class="fa fa-key"></i></a>
                                            <a href="<?=_BASEURL.'accountedit?account='.$account['id']?>" class="btn btn-info tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=_BASEURL.'accountdelete?account='.$account['id']?>" data-id-hide="hide_tr_<?=$account['id']?>" class="btn btn-danger tip app-delete-seleted-confirm"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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
        /* STart APP KICK USER */
        $("body").on("click", ".app-kick-offline", function(){
            var userId = $(this).attr('data-username');
            var spanStatusId = $(this).attr('span-status-id');
            $('#modal-app-ajax-loding').modal({
                backdrop: 'static',
                keyboard: false
            });
            $.ajax({
                type: "POST",
                url: $BASE_URL+'accountkicktooffline',//when send parameter from url in Controller get value of parameter with $_GET
                data: "_user_id="+userId+"&_spanStatusId="+spanStatusId,
                contentType: "application/x-www-form-urlencoded", //For encode to utf8
                cache: false,
                success: function(html){
                    $('#'+spanStatusId).html(html);
                    $('#modal-app-ajax-loding').modal('hide');
                }
            });

            return false;
        });
        /* END APP KICK USER */
    });
</script>
</body>
</html>