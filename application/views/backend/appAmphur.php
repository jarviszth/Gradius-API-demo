<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appAmphur = (isset($_V_DATA_TO_VIEW['appAmphur'])) ? $_V_DATA_TO_VIEW['appAmphur'] : array();
$appProvinceList = (isset($_V_DATA_TO_VIEW['appProvinceList'])) ? $_V_DATA_TO_VIEW['appProvinceList'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_amphur')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'appamphurlist'?>"><?=MessageUtil::getMessage('model_app_amphur')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_amphur')?></a></li>
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
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_app_amphur')?>
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


                    <div class="form-group required
                    <?php if(array_key_exists('code', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_amphur_code')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appAmphur->getCode();?>" type="text" name="code" id="code" required>
                    </div>
					</div><?php if(array_key_exists('code', $errorsFiled)){echo "<label for=\"code\" class=\"error\" id=\"code - error\">".$errorsFiled['code']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_amphur_name')?></label>
                        <div class="col-sm-8"><input class="form-control" value="<?=$appAmphur->getName();?>" type="text" name="name" id="name" required>
                    </div>
					</div><?php if(array_key_exists('name', $errorsFiled)){echo "<label for=\"name\" class=\"error\" id=\"name - error\">".$errorsFiled['name']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('name_eng', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_amphur_name_eng')?></label>
                       <div class="col-sm-8"> <input class="form-control" value="<?=$appAmphur->getNameEng();?>" type="text" name="name_eng" id="name_eng" required>
                   </div>
				   </div><?php if(array_key_exists('name_eng', $errorsFiled)){echo "<label for=\"name_eng\" class=\"error\" id=\"name_eng - error\">".$errorsFiled['name_eng']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('app_province', $errorsFiled)){echo "has-error";}?> ">

                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_app_amphur_app_province')?></label>
                        <div class="col-sm-8"><select name="app_province" id="app_province" class="full-width" data-init-plugin="select2">

                            <?php
                            if($appProvinceList){
                                foreach($appProvinceList as $appProvince){
                                    $isSelected = ($appAmphur->getAppProvince()==$appProvince->getId()) ? "selected" : "";
                                    echo " <option ".$isSelected." value=\"".$appProvince->getId()."\">".$appProvince->getName()."</option>";
                                }
                            }
                            ?>
                        </select></div>


                    </div><?php if(array_key_exists('app_province', $errorsFiled)){echo "<label for=\"app_province\" class=\"error\" id=\"app_province - error\">".$errorsFiled['app_province']." .</label>";}?>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'appamphurlist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

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