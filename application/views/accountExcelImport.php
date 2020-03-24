<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
$radgroupDetailList = (isset($_V_DATA_TO_VIEW['radgroupDetailList'])) ? $_V_DATA_TO_VIEW['radgroupDetailList'] : array();
?>
<title><?=MessageUtil::getMessage('model_account_excel')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_account_excel')?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class="container-fluid container-fixed-lg ">

        <!-- BEGIN PlACE PAGE CONTENT HERE -->




        <!-- START PANEL -->
        <div class="panel panel-default portlet-basic-v">
            <div class="panel-heading separator m-b-10">
                <div class="panel-title fs-16">
                   <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_account_excel')?>

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
                <form id="form_id" class="form-horizontal" enctype="multipart/form-data" method="post">

                    <div class="alert alert-info" role="alert">
                        <p class="pull-left"><strong><i class="fa fa-bullhorn"></i> <?=MessageUtil::getMessage('model_account_excel_advice')?></strong></p>
                        <button class="close" data-dismiss="alert"></button>
                        <div class="clearfix"></div>
                        <br>
                        <p class="bold no-margin">สามารถดาวน์โหลดไฟล์ Excel Template โดยคลิก <a class="fs-18" href="<?=_BASEURL.'accountexceltemplateload'?>">ที่นี่</a>
                        ท่านสามารถไปเพิ่มผู้ใช้ทีละคนได้ <a class="fs-18" href="<?=_BASEURL.'accountlist'?>">ที่นี่</a>
                            หรือ สามารถไปเพิ่มผู้ใช้แบบได้ <a class="fs-18" href="<?=_BASEURL.'accountlist'?>">ที่นี่</a>
                        </p>
                        <br>
                        <p>คอลัมน์ที่จำเป็นต้องกรอกคือ "ชื่อผู้ใช้" และ "รหัสผ่าน" เพราะจำเป็นสำหรับการเข้าสู่ระบบของ Radius</p>
                    </div>


                    <div id="upload_resualt"></div>

                    <div class="form-group m-b-10 m-t-40  form-files" >

                        <label class="col-sm-3 control-label"><i class="fa fa-file-excel-o"></i> <?=MessageUtil::getMessage('model_account_excel_choose')?></label>
                       <div class="col-sm-8"> <input type="file" class="form-control" id="file_excel_upload" name="file_excel_upload" value="<?=MessageUtil::getMessage('app_choose')?>" />
                    </div>
					</div>
                    <div class="form-group required">
                        <label class="col-sm-3 control-label"><?=MessageUtil::getMessage('model_account_radusergroup_detail')?></label>
                        <div class="col-sm-8">
						<select  name="radusergroup_detail" id="radusergroup_detail" class="full-width" data-init-plugin="select2">
                            <?php
                            if($radgroupDetailList){
                                foreach($radgroupDetailList as $radgroupDetail){
                                    echo "<option value=\"".$radgroupDetail->getId()."\">".$radgroupDetail->getGroupname()."</option>";
                                }
                            }
                            ?>
                        </select></div>
                    </div>

                    
					<br>
                    <button class="btn btn-success" type="submit"><i class="fa fa-cloud-upload"></i> <?=MessageUtil::getMessage('app_submit')?></button>
                    <a href="<?=_BASEURL.'accountexceltemplateload'?>" class="btn btn-danger"><i class="fa fa-download"></i> <?=MessageUtil::getMessage('model_account_excel_template')?></a>
                    <a href="<?=_BASEURL.'dashboard'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>



                    <!-- Modal -->
                    <div class="modal fade slide-up disable-scroll" id="ajaxLoading" tabindex="-1" role="dialog" aria-hidden="false">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content-wrapper">
                                <div class="modal-content">
                                    <div class="modal-body text-center m-t-20">
                                        <i  class="fa fa-spinner fa-spin fa-3x fa-fw text-danger" ></i> <br>กำลังทำการอัพโหลดกรุณารอจนกว่าจะเสร็จสิ้นการอัพโหลด
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                    <!-- /.modal-dialog -->


                </form>
            </div>
        </div>
        <!-- END PANEL -->
        
        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->





</div>
<!-- END PAGE CONTENT -->

<?php require __SITE_PATH.'/application/views/include/appFooter.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
        var url ='<?=_BASEURL.'accountexcelimport'?>';


        $('form#form_id').submit(function(){

            //$('#ajaxLoading').modal('show')
            $('#ajaxLoading').modal({//desable click outside
                backdrop: 'static',
                keyboard: false
            })

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    $("#upload_resualt").html(data);
                    $('#ajaxLoading').modal('hide')
                },
                cache: false,
                contentType: false,
                processData: false
            });

            return false;
        });

    });
</script>
</body>
</html>