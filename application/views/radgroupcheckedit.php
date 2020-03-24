<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtil;
$radgroupDetail = (isset($_V_DATA_TO_VIEW['radgroupDetail'])) ? $_V_DATA_TO_VIEW['radgroupDetail'] : array();
$radgroupCheckReply = (isset($_V_DATA_TO_VIEW['radgroupCheckReply'])) ? $_V_DATA_TO_VIEW['radgroupCheckReply'] : array();
$attributeAll = (isset($_V_DATA_TO_VIEW['attributeAll'])) ? $_V_DATA_TO_VIEW['attributeAll'] : array();

echo "    <link href=\"".__RESOURCES."/assets/plugins/bootstrap-datepicker/css/datepicker3.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
?>
<title><?=MessageUtil::getMessage('app_edit').' '.$radgroupDetail->getGroupname().' : '.$radgroupCheckReply->getAttribute()?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'radgroupchecklist?'.ControllerUtil::genParamId($radgroupDetail)?>"><?=MessageUtil::getMessage('model_radgroupcheckreply_attribute').' '.$radgroupDetail->getGroupname()?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_edit').' '.$radgroupCheckReply->getAttribute()?></a></li>
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
                <div class="panel-title">
                    <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_radgroupcheckreply_attribute')?>
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


                    <!-- START GROUP DETAIL -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info m-t-10" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <div class="clearfix"></div>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroup_detail_groupname')?> : </span>
                                    <span class="fs-18"><?=$radgroupDetail->getGroupname();?></span>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_radgroupcheckreply_attribute')?> : </span>
                                    <span class="fs-18 text-danger"><?=$radgroupCheckReply->getAttribute();?></span>
                                </p>
                                <p>
                                    <span class="bold"><?=MessageUtil::getMessage('model_attribute_all_type_value')?> : </span>
                                    <span class="fs-18 text-danger"><?=$attributeAll->getTypeValue()?></span>
                                </p>
                            </div>
                        </div>
                    </div><!-- END GROUP DETAIL -->


                    <div class="form-group required">

                        <label  class="label-lg"><?=MessageUtil::getMessage('model_radgroupcheckreply_value')?>

                            <i style="display: none;" class="fa fa-spinner fa-spin fa-3x fa-fw text-danger" id="ajaxLoading"></i>

                        </label>
                        <span id="textByAttributeValue"></span>
                    </div>

                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'radgroupchecklist?'.ControllerUtil::genParamId($radgroupDetail)?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>

                </form>
            </div>
        </div>
        <!-- END PANEL -->

        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
</div>
<!-- END PAGE CONTENT -->
<?php include __SITE_PATH.'/application/views/include/appFooter.php';
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-autonumeric/autoNumeric.js\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-inputmask/jquery.inputmask.min.js\"></script>";

?>


<script type="text/javascript">
    $(document).ready(function(){

        var valueType = '<?=$attributeAll->getTypeValue()?>';
        var helpText = '<?php echo MessageUtil::getMessage('model_help_type_text')?>';
        var helpNumber = '<?php echo MessageUtil::getMessage('model_help_type_number')?>';
        var helpSecond = '<?php echo MessageUtil::getMessage('model_help_type_second')?>';
        var helpDate = '<?php echo MessageUtil::getMessage('model_help_type_date')?>';
        var helpNull = '<?php echo MessageUtil::getMessage('model_help_type_null')?>';

        if(valueType=='text'){

            $("#textByAttributeValue").html("" +
                "<span class=\"help text-danger\">"+helpText+"</span>" +
                "<div class=\"input-group col-sm-2\">" +
                "<input class=\"form-control\" type=\"text\" name=\"value\" id=\"value\" required>" +
                "</div>");

        }else if(valueType=='number'){

            $("#textByAttributeValue").html("" +
                "<span class=\"help text-danger\">"+helpNumber+"</span>" +
                "<div class=\"input-group col-sm-2\">" +
                "<input type=\"text\" data-v-min=\"0\" data-v-max=\"9999\" class=\"autonumeric form-control\" name=\"value\" id=\"value\" required>" +
                "</div>");
            //Autonumeric plug-in - automatic addition of dollar signs,etc controlled by tag attributes
            $('.autonumeric').autoNumeric('init');

        }else if(valueType=='second'){

            $("#textByAttributeValue").html("" +
                "<span class=\"help text-danger\">"+helpSecond+"</span>" +
                "<div class=\"input-group col-sm-2\">" +
                "<input type=\"text\" class=\"form-control value-type-second\" name=\"value\" id=\"value\" required>" +
                "</div>");

            //Input mask - Input helper
            $(function($) {
                $(".value-type-second").mask("99:99:99");
            });

        }else if(valueType=='date'){

            $("#textByAttributeValue").html("" +
                "<span class=\"help text-danger\">"+helpDate+"</span>" +
                "<div id=\"datepicker-component\" data-date-format=\"dd/mm/yyyy\" class=\"input-group date col-sm-2\">" +
                "<!-- Save To Database with timestamp format -->" +

                "<input type=\"text\" class=\"form-control\" name=\"value\" id=\"value\" required><span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>" +
                "</div>");

            //Date Pickers
            $('#datepicker-component').datepicker();

        }else{
            $("#textByAttributeValue").html("<span class=\"help text-danger\">"+helpNull+"</span>");
        }
        $("#ajaxLoading").fadeOut();

    });
</script>


</body>
</html>