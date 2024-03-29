<?php
use application\util\MessageUtils as MessageUtil;
?>
<?php include __SITE_PATH.'/application/views/include/baseHeader.php'; ?>


<title><?=MessageUtil::getMessage('app_system_name')?> - Error 404</title>
<body class="fixed-header error-page"><!-- menu-pin -->
    <div class="container-xs-height full-height">
        <div class="row-xs-height">
            <div class="col-xs-height col-middle">
                <div class="error-container text-center">
                    <h1 class="error-number">404</h1>
                    <h2 class="semi-bold">Sorry but we couldnt find this page</h2>
                    <p>This page you are looking for does not exsist <a href="#">Report this?</a>
                    </p>
                    <div class="error-container-innner text-center">
                        <form>
                            <div class="form-group form-group-default input-group transparent text-left">
                                <label>Search</label>
                                <input class="form-control" placeholder="Try searching the missing page" type="email"> <span class="input-group-addon pg-search"></span>
                            </div>
                            <button class="btn btn-block btn-success" type="button" onclick="golink('<?=_BASEURL?>');">
                                     <span class="pull-left"><i class="fa fa-home"></i></span>
                                <span class="bold"><?=MessageUtil::getMessage('app_back').' '.MessageUtil::getMessage('app_home')?></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-bottom sm-pull-bottom full-width">
        <div class="error-container">
            <div class="error-container-innner">
                <div class="m-b-30 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-3 no-padding">
                        <img alt="" class="m-t-5" data-src="<?=__RESOURCES.'/'?>assets/img/demo/pages_icon.png" data-src-retina="<?=__RESOURCES.'/'?>assets/img/demo/pages_icon_2x.png" height="60" src="<?=__RESOURCES.'/'?>assets/img/demo/pages_icon.png" width="60">
                    </div>
                    <div class="col-sm-9 no-padding">
                        <p><small>Create a pages account. If you have a facebook account, log into it for this process.
                                Sign in with <a href="#">Facebook</a> or <a href="#">Google</a></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN VENDOR JS -->
<?php include __SITE_PATH.'/application/views/include/baseFooter.php';?>

<!-- END PAGE LEVEL JS -->
</body>
</html>