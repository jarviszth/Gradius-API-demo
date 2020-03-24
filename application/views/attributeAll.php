<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$attributeAll = (isset($_V_DATA_TO_VIEW['attributeAll'])) ? $_V_DATA_TO_VIEW['attributeAll'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_attribute_all')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'attributealllist'?>"><?=MessageUtil::getMessage('model_attribute_all')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_attribute_all')?></a></li>
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
                <div class="panel-title">
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_attribute_all')?>
                </div>
                    <div class="panel-controls">
                        <ul>
                            <li><a href="#" class="portlet-collapse" data-toggle="collapse"><i class="portlet-icon portlet-icon-collapse"></i></a></li>
                            <li><a href="#" class="portlet-refresh" data-toggle="refresh"><i class="portlet-icon portlet-icon-refresh"></i></a></li>
                            <li><a href="#" class="portlet-maximize" data-toggle="maximize"><i class="portlet-icon portlet-icon-maximize"></i></a></li>
                            <li><a href="#" class="portlet-close" data-toggle="close"><i class="portlet-icon portlet-icon-close"></i></a></li>
                        </ul>
                    </div>
            </div>
            <div class="panel-body">
                <form id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">


                    <div class="form-group required
                    <?php if(array_key_exists('attribute', $errorsFiled)){echo "has-error";}?> ">

                        <label class="label-lg"><?=MessageUtil::getMessage('model_attribute_all_attribute')?></label>
                        <input class="form-control" value="<?=$attributeAll->getAttribute();?>" type="text" name="attribute" id="attribute" required>
                    </div><?php if(array_key_exists('attribute', $errorsFiled)){echo "<label for=\"attribute\" class=\"error\" id=\"attribute - error\">".$errorsFiled['attribute']." .</label>";}?>


                    <div class="form-group
                    <?php if(array_key_exists('df_value', $errorsFiled)){echo "has-error";}?> ">

                        <label  class="label-lg"><?=MessageUtil::getMessage('model_attribute_all_df_value')?></label>
                        <input class="form-control" value="<?=$attributeAll->getDfValue();?>" type="text" name="df_value" id="df_value">
                    </div><?php if(array_key_exists('df_value', $errorsFiled)){echo "<label for=\"df_value\" class=\"error\" id=\"df_value - error\">".$errorsFiled['df_value']." .</label>";}?>


                    <div class="form-group required
                    <?php if(array_key_exists('attribute_name', $errorsFiled)){echo "has-error";}?> ">

                        <label  class="label-lg"><?=MessageUtil::getMessage('model_attribute_all_attribute_name')?></label>
                        <input class="form-control" value="<?=$attributeAll->getAttributeName();?>" type="text" name="attribute_name" id="attribute_name" required>
                    </div><?php if(array_key_exists('attribute_name', $errorsFiled)){echo "<label for=\"attribute_name\" class=\"error\" id=\"attribute_name - error\">".$errorsFiled['attribute_name']." .</label>";}?>


                    <div class="form-group">
                        <label  class="label-lg"><?=MessageUtil::getMessage('model_attribute_all_type_value')?></label>
                        <select name="type_value" id="type_value" class="full-width" data-init-plugin="select2">
                            <option value="text" <?php if($attributeAll->getTypeValue()=="text"){echo 'selected';}?>>Text</option>
                            <option value="number" <?php if($attributeAll->getTypeValue()=="number"){echo 'selected';}?>>Number</option>
                            <option value="second" <?php if($attributeAll->getTypeValue()=="second"){echo 'selected';}?>>Second</option>
                            <option value="date" <?php if($attributeAll->getTypeValue()=="date"){echo 'selected';}?>>Date</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label  class="label-lg"><?=MessageUtil::getMessage('model_attribute_all_type_checkreply')?></label>
                        <select name="type_checkreply" id="type_checkreply" class="full-width" data-init-plugin="select2">
                            <option value="check" <?php if($attributeAll->getTypeCheckreply()=="check"){echo 'selected';}?>>Check</option>
                            <option value="reply" <?php if($attributeAll->getTypeCheckreply()=="reply"){echo 'selected';}?>>Reply</option>
                        </select>
                    </div>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'attributealllist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

                </form>
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