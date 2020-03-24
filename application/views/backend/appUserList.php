<?php
include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\UploadUtil as UploadUtil;
use application\util\FilterUtils as FilterUtils;

$appUserList = (isset($_V_DATA_TO_VIEW['appUserList'])) ? $_V_DATA_TO_VIEW['appUserList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
<title><?=MessageUtil::getMessage('model_app_user')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('model_app_user')?></a></li>
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
                <div class="panel-title fs-16"><i class="fa fa-list"></i> <?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_app_user')?></div>
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
                    <a href="<?=_BASEURL.'appuseradd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
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
                                        <label><?=MessageUtil::getMessage('model_appuser_username')?></label>
                                        <input id="q_username" name="q_username" value="<?=FilterUtils::filterGetString('q_username')?>" placeholder="<?=MessageUtil::getMessage('model_appuser_username')?>" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?=MessageUtil::getMessage('model_appuser_email')?></label>
                                        <input id="q_email" name="q_email" value="<?=FilterUtils::filterGetString('q_email')?>" placeholder="<?=MessageUtil::getMessage('model_appuser_email')?>" type="text" class="form-control" >
                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'appuserlist'?>','get','form_search')" class="btn btn-complete tip  pull-right" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
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
                            <!-- NOTE * : Inline Style Width For Table Cell is Required as it may differ from user to user
                                            Comman Practice Followed
                                            -->
                            <th style="width:1%">
                                <div class="checkbox check-danger tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_select_all')?>">
                                        <input type="checkbox" name="checkBoxAll" id="checkBoxAll">
                                        <label for="checkBoxAll"></label>
                                    </div>
                            </th>
                            <th>Img</th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('username','ASC')?>">
                                    <?=MessageUtil::getMessage('model_appuser_username')?>
                                </a>
                                <span id="displaySort_username"></i></span>
                            </th>
                            <th>
                                <a href="<?=ControllerUtil::uriSortConcat('email','ASC')?>">
                                    <?=MessageUtil::getMessage('model_appuser_email')?>
                                </a>
                                <span id="displaySort_email"></i></span>
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
                        if($appUserList) {
                            foreach ($appUserList AS $appUser) {
                                $avatar = UploadUtil::displayAvatarThumnailPubic($appUser->getImgName(),$appUser->getCreatedDate());
                                ?>
                                <tr id="hide_tr_<?=$appUser->getId()?>">
                                    <td >
                                        <div class="checkbox check-danger">
                                            <input type="checkbox" value="<?=$appUser->getId()?>" name="check" id="checkbox<?=$appUser->getId()?>">
                                            <label for="checkbox<?=$appUser->getId()?>"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="thumbnail-wrapper d48 circular bordered b-white">
                                            <img alt="Avatar" width="55" height="55" data-src-retina="<?=$avatar?>" data-src="<?=$avatar?>" src="<?=$avatar?>">
                                        </div>
                                    </td>
                                    <td >
                                        <p><?=$appUser->getUsername()?></p>
                                    </td>
                                    <td >
                                        <p><?=$appUser->getEmail()?></p>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="<?=_BASEURL.'appuserchangepwd?'.ControllerUtil::genParamId($appUser)?>" class="btn btn-primary tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('model_appuser_password_change')?>"><i class="fa fa-key"></i></a>
                                            <a href="<?=_BASEURL.'appuseredit?'.ControllerUtil::genParamId($appUser)?>" class="btn btn-default tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                            <a href="<?=_BASEURL.'appuserdelete?'.ControllerUtil::genParamId($appUser)?>" data-id-hide="hide_tr_<?=$appUser->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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