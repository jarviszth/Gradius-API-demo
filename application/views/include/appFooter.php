<?php
use application\util\DateUtils as DateUtil;
use application\util\MessageUtils as MessageUtils;
?>
    <!-- START FOOTER -->
    <div class="container-fluid container-fixed-lg footer">
        <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
                <span class="hint-text">Copyright &copy; <?=DateUtil::getYearNow()?> </span>
                <span class="font-montserrat"><?=MessageUtils::getMessage('app_system_name')?></span>.
                <span class="hint-text">All rights reserved. </span>
                <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
                <span class="hint-text">Power By</span>
                <a href="#">Grand Ats ®</a>
            </p>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- END FOOTER -->


    </div>
    <!-- 1 END PAGE CONTENT WRAPPER -->
    </div>
    <!-- 0 END PAGE-CONTAINER  -->


<?php
include __SITE_PATH.'/application/views/include/baseFooter.php';
include __SITE_PATH.'/application/views/include/appModal.php';
?>