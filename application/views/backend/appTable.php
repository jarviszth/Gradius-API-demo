<?php include __SITE_PATH . '/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$appTable = (isset($_V_DATA_TO_VIEW['appTable'])) ? $_V_DATA_TO_VIEW['appTable'] : array();
?>
<title>Table Add</title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><p>Pages</p></li>
                    <li><a href="<?=_BASEURL.'apptablelist'?>">App Table</a></li>
                    <li><a href="" class="active">Table Add</a></li>
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
                    App Table Form
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
                <form id="form_id" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" method="post" role="form">

                    <div class="form-group form-group-default required
                    <?php if(array_key_exists('name', $errorsFiled)){echo "has-error";}?> ">

                        <label>Table Name</label>
                        <input class="form-control" value="<?=$appTable->getAppTableName();?>" type="text" name="app_table_name" id="app_table_name" required>
                    </div><?php if(array_key_exists('app_table_name', $errorsFiled)){echo "<label for=\"app_table_name\" class=\"error\" id=\"app_table_name-error\">".$errorsFiled['app_table_name']." .</label>";}?>



                    <div class="form-group form-group-default required
                      <?php if(array_key_exists('description', $errorsFiled)){echo "has-error";}?> ">

                        <label>Description</label>
                        <textarea id="description" name="description" style="min-height: 100px" class="form-control" id="name"><?=$appTable->getDescription();?></textarea>
                    </div> <?php if(array_key_exists('description', $errorsFiled)){echo "<label for=\"description\" class=\"error\" id=\"description-error\">".$errorsFiled['description']." .</label>";}?>
                    <div class="form-group">
                        <label>File You Want Create</label>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="model" id="model">
                            <label for="model">Model</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="service" id="service">
                            <label for="service">Service</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="controller" id="controller" >
                            <label for="controller">Controller</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="validator" id="validator">
                            <label for="validator">Validator</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="vlist" id="vlist">
                            <label for="vlist">List View</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="vview" id="vview">
                            <label for="vview">Form View</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="vmsg" id="vmsg">
                            <label for="vmsg">Model Message</label>
                        </div>
                        <div class="checkbox check-danger">
                            <input type="checkbox" checked="checked" value="1" name="vroute" id="vroute">
                            <label for="vroute">Route List</label>
                        </div>



                    </div>
                    <br>
                    <button class="btn btn-success" type="submit"><?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'apptablelist'?>" class="btn btn-default"><i class="pg-close"></i> <?=MessageUtil::getMessage('app_cancel')?></a>


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