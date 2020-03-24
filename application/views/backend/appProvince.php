<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appProvince = (isset($_V_DATA_TO_VIEW['appProvince'])) ? $_V_DATA_TO_VIEW['appProvince'] : array();
$appGeographyList = (isset($_V_DATA_TO_VIEW['appGeographyList'])) ? $_V_DATA_TO_VIEW['appGeographyList'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_province')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'appprovincelist'?>"><?=MessageUtil::getMessage('model_app_province')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_province')?></a></li>
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
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_province')?>
                </div>
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
            </div>
            <div class="panel-body">
                <form id="form_id" class="form-horizontal" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">


                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('code', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_province_code')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appProvince->getCode();?>" type="text" name="code" id="code" required>
                    </div>
					</div><?php if(array_key_exists('code', $errorsFiled)){echo "<label for=\"code\" class=\"error\" id=\"code - error\">".$errorsFiled['code']." .</label>";}?>


                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_province_name')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appProvince->getName();?>" type="text" name="name" id="name" required>
                    </div>
					</div><?php if(array_key_exists('name', $errorsFiled)){echo "<label for=\"name\" class=\"error\" id=\"name - error\">".$errorsFiled['name']." .</label>";}?>


                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('name_eng', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_province_name_eng')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appProvince->getNameEng();?>" type="text" name="name_eng" id="name_eng" required>
                    </div>
					</div><?php if(array_key_exists('name_eng', $errorsFiled)){echo "<label for=\"name_eng\" class=\"error\" id=\"name_eng - error\">".$errorsFiled['name_eng']." .</label>";}?>


                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('app_geography', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_province_app_geography')?></label>
                        <div class="col-sm-8"><select name="app_geography" id="app_geography" class="full-width" data-init-plugin="select2">

                            <?php
                            if($appGeographyList){
                                foreach($appGeographyList as $appGeography){
                                    $isSelected = ($appProvince->getAppGeography()==$appGeography->getId()) ? "selected" : "";
                                    echo " <option ".$isSelected." value=\"".$appGeography->getId()."\">".$appGeography->getName()."</option>";
                                }
                            }
                            ?>
                        </select></div>

                    </div><?php if(array_key_exists('app_geography', $errorsFiled)){echo "<label for=\"app_geography\" class=\"error\" id=\"app_geography - error\">".$errorsFiled['app_geography']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'appprovincelist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

                </form>
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