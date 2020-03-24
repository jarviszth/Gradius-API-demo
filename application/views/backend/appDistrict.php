<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appDistrict = (isset($_V_DATA_TO_VIEW['appDistrict'])) ? $_V_DATA_TO_VIEW['appDistrict'] : array();
$appProvinceList = (isset($_V_DATA_TO_VIEW['appProvinceList'])) ? $_V_DATA_TO_VIEW['appProvinceList'] : array();
$appAmphurList = (isset($_V_DATA_TO_VIEW['appAmphurList'])) ? $_V_DATA_TO_VIEW['appAmphurList'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_district')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'appdistrictlist'?>"><?=MessageUtil::getMessage('model_app_district')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_district')?></a></li>
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
        <div  class="panel panel-default portlet-basic-v">
            <div class="panel-heading separator m-b-10">
                <div class="panel-title fs-16">
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_district')?>
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


                    <div class="form-group  required
                    <?php if(array_key_exists('code', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_district_code')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appDistrict->getCode();?>" type="text" name="code" id="code" required>
                    </div>
					</div><?php if(array_key_exists('code', $errorsFiled)){echo "<label for=\"code\" class=\"error\" id=\"code - error\">".$errorsFiled['code']." .</label>";}?>

                    <div class="form-group  required">
                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_amphur_app_province')?></label>
                        <div class="col-sm-8"><select name="app_province" id="app_province_select" class="full-width onChangeAmphurByProvince" data-init-plugin="select2" required>
                            <?php
                            if($appProvinceList){
                                echo "<option value=\"\">&nbsp;</option>\n";
                                foreach($appProvinceList as $appProvince){
                                    $isProvinceSelected = ($appProvince->getId()==$appDistrict->getAppProvince()) ? "selected" : "";
                                    echo " <option ".$isProvinceSelected." value=\"".$appProvince->getId()."\">".$appProvince->getName()."</option>";
                                }
                            }
                            ?>
                        </select></div>
                    </div>

                    <div class="form-group required
                    <?php if(array_key_exists('app_amphur', $errorsFiled)){echo "has-error";}?> ">
                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_district_app_amphur')?></label>
                        <div class="col-sm-8"><select name="app_amphur" id="app_amphur_select" class="full-width" data-init-plugin="select2" required>
                            <?php
                            if($appAmphurList){
                                echo "<option value=\"\">&nbsp;</option>\n";
                                foreach($appAmphurList as $appAmphur){
                                    $isAmphurSelected = ($appAmphur->getId()==$appDistrict->getAppAmphur()) ? "selected" : "";
                                    echo " <option ".$isAmphurSelected." value=\"".$appAmphur->getId()."\">".$appAmphur->getName()."</option>";
                                }
                            }
                            ?>
                        </select>
</div>
                    </div><?php if(array_key_exists('app_amphur', $errorsFiled)){echo "<label for=\"app_amphur\" class=\"error\" id=\"app_amphur - error\">".$errorsFiled['app_amphur']." .</label>";}?>

                    <div class="form-group  required
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_district_name')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appDistrict->getName();?>" type="text" name="name" id="name" required>
                    </div>
					</div><?php if(array_key_exists('name', $errorsFiled)){echo "<label for=\"name\" class=\"error\" id=\"name - error\">".$errorsFiled['name']." .</label>";}?>

                    <div class="form-group  required
                    <?php if(array_key_exists('zipcode', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_district_zipcode')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appDistrict->getZipcode();?>" type="text" name="zipcode" id="zipcode" required>
                    </div>
					</div><?php if(array_key_exists('zipcode', $errorsFiled)){echo "<label for=\"zipcode\" class=\"error\" id=\"zipcode - error\">".$errorsFiled['zipcode']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'appdistrictlist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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