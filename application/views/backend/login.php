<?php
use application\util\MessageUtils as MessageUtil;
use application\util\ControllerUtil as ControllerUtil;
use application\util\DateUtils as DateUtil;

$testSendData = (isset($_V_DATA_TO_VIEW['testSendData'])) ? $_V_DATA_TO_VIEW['testSendData'] : "";
?>
<?php include __SITE_PATH.'/application/views/include/baseHeader.php'; ?>

<title><?=MessageUtil::getMessage('app_system_name')?> - Login</title>

<script type="text/javascript">
    var timerStart = Date.now();
</script>
<body class="fixed-header color-red"><!-- menu-pin -->


<!-- START PAGE-CONTAINER -->
<div class="login-wrapper">
    <!-- START Login Background Pic Wrapper-->
    <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="<?=__RESOURCES.'/'?>assets/img/main_bg.jpg" data-src="<?=__RESOURCES.'/'?>assets/img/main_bg.jpg" data-src-retina="<?=__RESOURCES.'/'?>assets/img/main_bg.png" alt="" class="lazy">
        <!-- END Background Pic-->
        <!-- START Background Caption-->
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
<!--            <h2 class="semi-bold text-white">Pages make it easy to enjoy what matters the most in the life</h2>-->
            <p class="small">
<!--                images Displayed are solely for representation purposes only, All work copyright of respective owner, otherwise © 2013-2014 REVOX.-->
            </p>
        </div>
        <!-- END Background Caption-->
    </div>
    <!-- END Login Background Pic Wrapper-->
    <!-- START Login Right Container-->
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="<?=__RESOURCES.'/'?>assets/img/logo.png" alt="logo" height="50" data-src="<?=__RESOURCES.'/'?>assets/img/logo.png" data-src-retina="<?=__RESOURCES.'/'?>assets/img/logo.png">
            <p class="p-t-35">Sign into your <?=MessageUtil::getMessage('app_system_name')?> account</p>
            <!-- START Login Form -->
            <?php
            ControllerUtil::displayAppMsgBlock();

            if(!empty($testSendData)){
                $errStr = "<div class=\"alert alert-success\" role=\"alert\">";
                $errStr .="<button class=\"close\" data-dismiss=\"alert\"></button>";
                $errStr .="<strong>สำเร็จ: </strong>$testSendData";
                $errStr .="</div>";
                echo $errStr;
            }


            ?>
            <form id="form-login" name="login_form" class="p-t-15" role="form"  method="post">
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    <label><?=MessageUtil::getMessage('model_app_user')?></label>
                    <div class="controls">
                        <input value="" type="text" name="email" id="email" placeholder="<?=MessageUtil::getMessage('model_app_user')?>" class="form-control" required>
                    </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                    <label><?=MessageUtil::getMessage('app_login_password')?></label>
                    <div class="controls">
                        <input value="" name="password" id="password" type="password" class="form-control " <?=MessageUtil::getMessage('app_login_password')?> placeholder="<?=MessageUtil::getMessage('app_login_password')?>">
                    </div>
                </div>
                <!-- START Form Control-->
<!--                <div class="row">-->
<!--                    <div class="col-md-6 no-padding">-->
<!--                        <div class="checkbox ">-->
<!--                            <input type="checkbox" value="1" id="checkbox1">-->
<!--                            <label for="checkbox1">Keep Me Signed in</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-6 text-right">-->
<!--                        <a href="#" class="text-info small">Help? Contact Support</a>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- END Form Control-->
                <input class="btn btn-primary btn-cons m-t-10" type="submit" onclick="radiusFormhash(this.form, this.form.password);" value="<?=MessageUtil::getMessage('app_login')?>"/>
            </form>
            <!--END Login Form-->
            <div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-30 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-3 col-md-2 no-padding m-r-5 appLogo">
<!--                        <img alt="" class="m-t-5" data-src="--><?//=__RESOURCES.'/'?><!--assets/img/logo.png" data-src-retina="--><?//=__RESOURCES.'/'?><!--assets/img/logo_2x.png" height="42" src="--><?//=__RESOURCES.'/'?><!--assets/img/logo.png">-->
                    </div>
                    <div class="col-sm-12 no-padding">
                        <p class="hint-text small">
                            &copy; <?=DateUtil::getYearNow()?> <?=MessageUtil::getMessage('app_system_name')?> <a target="_blank" href="http://www.grandats.com">บริษัท แกรนด์ เอทีเอส จำกัด</a><br>


                            <!--
                            <a href="#">About</a>&nbsp;&nbsp;
                            <a href="#">Help</a>&nbsp;&nbsp;
                            <a href="#">Terms</a>&nbsp;&nbsp;
                            <a href="#">Privacy</a>&nbsp;&nbsp;
                            <a href="#">Cookies</a>&nbsp;&nbsp;
                            <a href="#">Ads info</a>
                            -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Login Right Container-->
</div>
<!-- END PAGE CONTAINER -->

<!--<div id="test"></div>-->


<!-- BEGIN VENDOR JS -->
<?php include __SITE_PATH.'/application/views/include/baseFooter.php';?>
<!-- END PAGE LEVEL JS -->
<script>
    $(function()
    {
        $('#form-login').validate()
    })
</script>
<script type="text/javascript">
    $(window).load(function() {
//        var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;
//        $('#test').html('Page load time is '+ loadTime);
    });
</script>
</body>
</html>