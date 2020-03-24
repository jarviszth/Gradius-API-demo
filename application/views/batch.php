<?php include __SITE_PATH.'/application/views/include/appHeader.php';
use application\util\MessageUtils as MessageUtil;
use application\util\FilterUtils as FilterUtil;
//use application\util\UploadUtil as UploadUtil;

$errorsFiled = (isset($_V_DATA_TO_VIEW['validateErrors'])) ? $_V_DATA_TO_VIEW['validateErrors'] : array();
$batch = (isset($_V_DATA_TO_VIEW['batch'])) ? $_V_DATA_TO_VIEW['batch'] : array();
//$img = UploadUtil::displayAvatarThumnailPubic($batch->getImgName(),$batch->getCreatedDate());
$radgroupDetailList = (isset($_V_DATA_TO_VIEW['radgroupDetailList'])) ? $_V_DATA_TO_VIEW['radgroupDetailList'] : array();
?>
<title><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_batch')?></title>
<!-- START PAGE CONTENT -->
<div class="content">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
            <div class="inner">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?=_BASEURL.'dashboard'?>"><?=MessageUtil::getMessage('app_home')?></a></li>
                    <li><a href="<?=_BASEURL.'batchlist'?>"><?=MessageUtil::getMessage('model_batch')?></a></li>
                    <li><a href="" class="active"><?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_batch')?></a></li>
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
        <div class="panel panel-default portlet-basic-v v-border-radius-4">
            <div class="panel-heading separator m-b-10">
                <div class="panel-title fs-16">
                    <i class="fa fa-pencil"></i> <?=MessageUtil::getMessage('app_form').' '.MessageUtil::getMessage('model_batch')?>
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
                <form id="form_id" class="" action="<?=FilterUtil::filterServerUrl('REQUEST_URI')?>" enctype="multipart/form-data" method="post" role="form">


                    <div class="row">

                        <!-- Left Column -->
                        <div class="col-md-6">

                            <div class="form-group required
                            <?php if(array_key_exists('radusergroup_detail', $errorsFiled)){echo "has-error";}?> ">

                                <label for="radusergroup_detail"  class=""><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_radusergroup_detail')?></label>

                                    <select name="radusergroup_detail" id="radusergroup_detail" class="full-width" data-init-plugin="select2">
                                        <?php
                                        if($radgroupDetailList){
                                            foreach($radgroupDetailList as $radgroupDetail){

                                                $selected = ($batch->getRadusergroupDetail() == $radgroupDetail->getId()) ? "selected" : "";
                                                echo "<option $selected value=\"".$radgroupDetail->getId()."\">".$radgroupDetail->getGroupname()."</option>";
                                            }
                                        }
                                        ?>
                                    </select>

                            </div><?php if(array_key_exists('radusergroup_detail', $errorsFiled)){echo "<label class=\"error\" id=\"radusergroup_detail-error\">".$errorsFiled['radusergroup_detail']." .</label>";}?>


                            <div class="form-group required
                            <?php if(array_key_exists('batch_name', $errorsFiled)){echo "has-error";}?> ">

                                <label for="batch_name"  class=""><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_batch_name')?></label>
                                <input class="form-control" value="<?=$batch->getBatchName();?>" type="text" name="batch_name" id="batch_name" required>
                            </div><?php if(array_key_exists('batch_name', $errorsFiled)){echo "<label class=\"error\" id=\"batch_name-error\">".$errorsFiled['batch_name']." .</label>";}?>


                            <div class="form-group required
                            <?php if(array_key_exists('descriptions', $errorsFiled)){echo "has-error";}?> ">

                                <label for="description"  class=""><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_description')?></label>

                                <textarea class="form-control" rows="2" id="descriptions" name="descriptions" required><?=$batch->getDescriptions();?></textarea>

                            </div><?php if(array_key_exists('descriptions', $errorsFiled)){echo "<label class=\"error\" id=\"descriptions-error\">".$errorsFiled['descriptions']." .</label>";}?>


                            <div class="form-group required
                            <?php if(array_key_exists('volume', $errorsFiled)){echo "has-error";}?> ">

                                <label for="volume"  class=""><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_volume')?></label>
                                <input class="form-control" value="<?=$batch->getVolume();?>" type="text" name="volume" id="volume" required>
                            </div><?php if(array_key_exists('volume', $errorsFiled)){echo "<label class=\"error\" id=\"volume-error\">".$errorsFiled['volume']." .</label>";}?>


                            <div class="form-group required
                            <?php if(array_key_exists('active', $errorsFiled)){echo "has-error";}?> ">

                                <label for="active"  class=""><span class="text-danger">*</span> <?=MessageUtil::getMessage('model_batch_active')?></label>

                                    <select name="active" id="active" class="full-width" data-init-plugin="select2">
                                        <option value="1" <?php if($batch->getActive()==1){echo 'selected';}?>><?=MessageUtil::getMessage('app_enable')?></option>
                                        <option value="0" <?php if($batch->getActive()==0){echo 'selected';}?>><?=MessageUtil::getMessage('app_disable')?></option>
                                    </select>
                            </div><?php if(array_key_exists('active', $errorsFiled)){echo "<label class=\"error\" id=\"active-error\">".$errorsFiled['active']." .</label>";}?>

                        </div>
                        <!-- /Left Column -->


                        <!-- Right Column -->
                        <div class="col-md-6 padding-15" style="border: 1px solid #edeff1;">

                            <div class="alert alert-info" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Username Configuration </strong>
                            </div>
                            <div class="form-group
                            <?php if(array_key_exists('username_lenght', $errorsFiled)){echo "has-error";}?> ">

                                <label for="username_lenght"  class="">ความยาวของชื่อผู้ใช้</label>

                                <select name="username_lenght" id="username_lenght" class="full-width" data-init-plugin="select2">
                                    <?php
                                    echo "<option value=\"0\">กำหนดเอง</option>";
                                        for ($unLenght = 5; $unLenght <= 20; $unLenght++) {
                                            $selected = ($batch->getUsernameLenght() == $unLenght) ? "selected" : "";
                                            echo "<option $selected value=\"".$unLenght."\">".$unLenght."</option>";
                                         }
                                    ?>
                                </select>

                            </div><?php if(array_key_exists('username_lenght', $errorsFiled)){echo "<label class=\"error\" id=\"username_lenght-error\">".$errorsFiled['username_lenght']." .</label>";}?>

                            <?php
                            $usernameConfCustomSeleted = (($batch->getUsernameLenght()==0) ? "style='display:inline;'": "style='display:none;'");
                            ?>

                            <div id="username_conf_custom" <?=$usernameConfCustomSeleted?>>
                                <div class="form-group
                                <?php if(array_key_exists('username_prefix', $errorsFiled)){echo "has-error";}?> ">

                                    <label for="username_prefix"  class=""><span class="text-danger">*</span> Prefix</label>
                                    <input class="form-control" value="<?=$batch->getUsernamePrefix();?>" type="text" name="username_prefix" id="username_prefix">
                                </div><?php if(array_key_exists('username_prefix', $errorsFiled)){echo "<label class=\"error\" id=\"username_prefix-error\">".$errorsFiled['username_prefix']." .</label>";}?>

                                <div class="form-group
                                <?php if(array_key_exists('username_subfix', $errorsFiled)){echo "has-error";}?> ">

                                    <label for="username_subfix"  class="">Subfix</label>
                                    <input class="form-control" value="<?=$batch->getUsernameSubfix();?>" type="text" name="username_subfix" id="username_subfix">
                                </div><?php if(array_key_exists('username_subfix', $errorsFiled)){echo "<label class=\"error\" id=\"username_subfix-error\">".$errorsFiled['username_subfix']." .</label>";}?>

                                <div class="form-group
                                <?php if(array_key_exists('username_domain', $errorsFiled)){echo "has-error";}?> ">

                                    <label for="username_domain"  class="">Domain</label>
                                    <input class="form-control" value="<?=$batch->getUsernameDomain();?>" type="text" name="username_domain" id="username_subfix">
                                </div><?php if(array_key_exists('username_domain', $errorsFiled)){echo "<label class=\"error\" id=\"username_domain-error\">".$errorsFiled['username_domain']." .</label>";}?>
                            </div>



                            <div class="alert alert-info" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                <strong>Password Configuration </strong>
                            </div>
                            <div class="form-group">
                                <?php
                                $typePwdSeleted = (!empty($batch->getPasswordType()) ? $batch->getPasswordType() : "R");
                                ?>
                                <div class="radio radio-success">
                                    <input class="radioTypePwd" type="radio" <?php if($typePwdSeleted=='R'){echo "checked=\"checked\"";}?> value="R" name="password_type" id="random_pwd">
                                    <label for="random_pwd">สุ่มรหัสผ่าน</label>

                                    <input class="radioTypePwd" type="radio" <?php if($typePwdSeleted=='F'){echo "checked=\"checked\"";}?> value="F" name="password_type" id="fix_pwd">
                                    <label for="fix_pwd">กำหนดรหัสผ่าน</label>
                                </div>
                            </div>

                            <?php
                            $pwdRandomDivCss = ($typePwdSeleted=='R') ? "style='display:inline;'": "style='display:none;'";
                            $pwdFixDivCss = ($typePwdSeleted=='F') ? "style='display:inline;'": "style='display:none;'";
                            ?>

                            <div class="form-group" id="pwd_random_div" <?=$pwdRandomDivCss?>>
                                <label for="random_password_radio"  class="">กำหนดวิธีการสุ่มรหัสผ่าน</label>
                                <div class="radio radio-danger">

                                    <?php
                                    $randomPwdSeleted = (!empty($batch->getRandomPasswordRadio()) ? $batch->getRandomPasswordRadio() : "1");
                                    ?>

                                    <input type="radio" <?php if($randomPwdSeleted=='1'){echo "checked=\"checked\"";}?>  value="1" name="random_password_radio" id="random_pwd_no">
                                    <label for="random_pwd_no">ตัวเลข</label>

                                    <input type="radio" <?php if($randomPwdSeleted=='2'){echo "checked=\"checked\"";}?>  value="2" name="random_password_radio" id="random_pwd_char">
                                    <label for="random_pwd_char">ตัวอักษร</label>

                                    <input type="radio" <?php if($randomPwdSeleted=='3'){echo "checked=\"checked\"";}?>  value="3" name="random_password_radio" id="random_pwd_char_no">
                                    <label for="random_pwd_char_no">ตัวเลข+ตัวอักษร</label>
                                </div>
                            </div>


                            <div  <?=$pwdFixDivCss?> class="form-group
                            <?php if(array_key_exists('fix_password_text', $errorsFiled)){echo "has-error";}?>"  id="pwd_fix_div">
                                <label for="fix_password_text"  class="">กำหนดรหัสผ่าน</label>
                                <input class="form-control" value="<?=$batch->getFixPasswordText();?>" type="text" name="fix_password_text" id="fix_password_text">
                            </div><?php if(array_key_exists('fix_password_text', $errorsFiled)){echo "<label class=\"error\" id=\"fix_password_text-error\">".$errorsFiled['fix_password_text']." .</label>";}?>

                            <br>
                            <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> <?=MessageUtil::getMessage('app_submit')?></button>
                            <a href="<?=_BASEURL.'batchlist'?>" class="btn btn-default"><i class="fa fa-reply"></i> <?=MessageUtil::getMessage('app_cancel')?></a>
                        </div>
                        <!-- /Right Column -->

                    </div>

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






<script type="text/javascript">
    $(window).load(function() {
        $("body").on("change", "#username_lenght", function(){
            var lenght = $("#username_lenght").val();

            if(lenght>0){
//                $("#username_conf_custom").css( "display", "none" );
                $("#username_conf_custom").fadeOut('fast');
            }else{
//                $("#username_conf_custom").css( "display", "inline" );
                $("#username_conf_custom").fadeIn('fast');
            }
        });


        $("body").on("click", ".radioTypePwd", function(){

            var valueType = $(this).attr('value');
            if(valueType=='R'){
                $("#pwd_random_div").fadeIn('fast');
                $("#pwd_fix_div").fadeOut('fast');
            }else{
                $("#pwd_fix_div").fadeIn('fast');
                $("#pwd_random_div").fadeOut('fast');
            }
            console.log('type===>'+valueType);

        });





    });
</script>

</body>
</html>