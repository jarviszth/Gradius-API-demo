<?php
include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\ControllerUtil as ControllerUtil;
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtils;

$attributeAllList = (isset($_V_DATA_TO_VIEW['attributeAllList'])) ? $_V_DATA_TO_VIEW['attributeAllList'] : array();
$appPagination = (isset($_V_DATA_TO_VIEW['appPaging'])) ? $_V_DATA_TO_VIEW['appPaging'] : '';
?>
    <title><?=MessageUtil::getMessage('model_attribute_all')?></title>
    <!-- START PAGE CONTENT -->
    <div class="content">
        <!-- START JUMBOTRON -->
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                <div class="inner">
                    <!-- START BREADCRUMB -->
                    <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                        <li><a href="" class="active"><?=MessageUtil::getMessage('model_attribute_all')?></a></li>
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
                <div class="panel-heading">
                    <div class="panel-title"><?=MessageUtil::getMessage('app_list').' '.MessageUtil::getMessage('model_attribute_all')?></div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right m-b-10">
                        <a href="<?=_BASEURL.'attributealladd'?>" class="btn btn-default"><i class="fa fa-plus"></i> <?=MessageUtil::getMessage('app_add_new')?></a>
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
                                            <label><?=MessageUtil::getMessage('model_attribute_all_attribute')?></label>
                                            <input id="q_attribute" name="q_attribute" value="<?=FilterUtils::filterGetString('q_attribute')?>" placeholder="<?=MessageUtil::getMessage('model_attribute_all_attribute')?>" type="text" class="form-control" >
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_attribute_all_attribute_name')?></label>
                                            <input id="q_attribute_name" name="q_attribute_name" value="<?=FilterUtils::filterGetString('q_attribute_name')?>" placeholder="<?=MessageUtil::getMessage('model_attribute_all_attribute_name')?>" type="text" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_attribute_all_type_value')?></label>
                                            <input id="q_type_value" name="q_type_value" value="<?=FilterUtils::filterGetString('q_type_value')?>" placeholder="<?=MessageUtil::getMessage('model_attribute_all_type_value')?>" type="text" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><?=MessageUtil::getMessage('model_attribute_all_type_checkreply')?></label>
                                            <input id="q_type_checkreply" name="q_type_checkreply" value="<?=FilterUtils::filterGetString('q_type_checkreply')?>" placeholder="<?=MessageUtil::getMessage('model_attribute_all_type_checkreply')?>" type="text" class="form-control" >
                                        </div>
                                        <br>
                                        <div class="form-group col-md-12">
                                            <a href="javascript:void(0)" onclick="go('<?=_BASEURL.'attributealllist'?>','get','form_search')" class="btn btn-complete tip  pull-right" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_search')?>"><i class="fa fa-search"></i> <?=MessageUtil::getMessage('app_search')?></a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- END PANEL -->
                        </div>
                    </div>
                    <!-- END SEARCH FORM -->



                    <div class="table-responsive">
                        <table class="table table-hover" id="basicTable">
                            <thead>
                            <tr>
                                <th style="width:1%">
                                    <div class="checkbox check-danger tip" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_select_all')?>">
                                        <input type="checkbox" name="checkBoxAll" id="checkBoxAll">
                                        <label for="checkBoxAll"></label>
                                    </div>
                                </th>
                                <th style="width:1%">
                                    <a href="<?=ControllerUtil::uriSortConcat('attributessssss','ASC')?>">
                                        <?=MessageUtil::getMessage('model_attribute_all_attribute')?>
                                    </a>
                                    <span id="displaySort_attributessssss"></i></span>
                                </th>
                                <th style="width:1%">
                                    <a href="<?=ControllerUtil::uriSortConcat('df_value','ASC')?>">
                                        <?=MessageUtil::getMessage('model_attribute_all_df_value')?>
                                    </a>
                                    <span id="displaySort_df_value"></i></span>
                                </th>
                                <th style="width:1%">
                                    <a href="<?=ControllerUtil::uriSortConcat('attribute_name','ASC')?>">
                                        <?=MessageUtil::getMessage('model_attribute_all_attribute_name')?>
                                    </a>
                                    <span id="displaySort_attribute_name"></i></span>
                                </th>
                                <th style="width:1%">
                                    <a href="<?=ControllerUtil::uriSortConcat('type_value','ASC')?>">
                                        <?=MessageUtil::getMessage('model_attribute_all_type_value')?>
                                    </a>
                                    <span id="displaySort_type_value"></i></span>
                                </th>
                                <th style="width:1%">
                                    <a href="<?=ControllerUtil::uriSortConcat('type_checkreply','ASC')?>">
                                        <?=MessageUtil::getMessage('model_attribute_all_type_checkreply')?>
                                    </a>
                                    <span id="displaySort_type_checkreply"></i></span>
                                </th>
                                <th style="width:1%"><?=MessageUtil::getMessage('app_tool')?></th>
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
                            if($attributeAllList) {
                                foreach ($attributeAllList AS $attributeAll) {
                                    ?>
                                    <tr id="hide_tr_<?=$attributeAll->getId()?>">
                                        <td >
                                            <div class="checkbox check-danger">
                                                <input type="checkbox" value="<?=$attributeAll->getId()?>" name="check" id="checkbox<?=$attributeAll->getId()?>">
                                                <label for="checkbox<?=$attributeAll->getId()?>"></label>
                                            </div>
                                        </td>
                                        <td >
                                            <p><?=$attributeAll->getAttribute()?></p>
                                        </td>
                                        <td >
                                            <p><?=$attributeAll->getDfValue()?></p>
                                        </td>
                                        <td >
                                            <p><?=$attributeAll->getAttributeName()?></p>
                                        </td>
                                        <td >
                                            <p><?=$attributeAll->getTypeValue()?></p>
                                        </td>
                                        <td >
                                            <p><?=$attributeAll->getTypeCheckreply()?></p>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?=_BASEURL.'attributealledit?'.ControllerUtil::genParamId($attributeAll)?>" class="btn btn-default tip tip m-b-5 m-r-5" data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_edit')?>"><i class="fa fa-pencil"></i></a>
                                                <a href="<?=_BASEURL.'attributealldelete?'.ControllerUtil::genParamId($attributeAll)?>" data-id-hide="hide_tr_<?=$attributeAll->getId()?>" class="app-delete-seleted-confirm btn btn-danger tip tip m-b-5 m-r-5"  data-toggle="tooltip" data-original-title="<?=MessageUtil::getMessage('app_delete')?>"  ><i class="fa fa-trash-o"></i></a>
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