<?php
use application\util\DateUtils as DateUtil;
use application\util\ControllerUtil as ControllerUtil;

echo "<!-- BEGIN VENDOR JS -->";
echo "<script src=\"".__RESOURCES."/assets/plugins/pace/pace.min.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/modernizr.custom.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-ui/jquery-ui.min.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/boostrapv3/js/bootstrap.min.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery/jquery-easy.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-unveil/jquery.unveil.min.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-bez/jquery.bez.min.js\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-ios-list/jquery.ioslist.min.js\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-actual/jquery.actual.min.js\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js\"></script>";
echo "<script type=\"text/javascript\" src=\"".__RESOURCES."/assets/plugins/bootstrap-select2/select2.min.js?".DateUtil::getTimeNow()."\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/classie/classie.js\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/switchery/js/switchery.min.js\"></script>";
echo "<script src=\"".__RESOURCES."/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js\"></script>";

echo "<script type=\"text/javascript\" src=\"".__RESOURCES_ASSETS."/js/forms.js?".DateUtil::getTimeNow()."\"></script>";
echo "<script type=\"text/javascript\" src=\"".__RESOURCES_ASSETS."/js/sha512.js?".DateUtil::getTimeNow()."\"></script>";
echo "<!-- END VENDOR JS -->";

echo "<!-- BEGIN CORE TEMPLATE JS -->";
echo "<script src=\"".__RESOURCES."/pages/js/pages.js?".DateUtil::getTimeNow()."\" type=\"text/javascript\"></script>";
echo "<script src=\"".__RESOURCES."/assets/js/utility.js?".DateUtil::getTimeNow()."\" type=\"text/javascript\"></script>";
echo "<!-- END CORE TEMPLATE JS -->";
echo "<!-- BEGIN PAGE LEVEL JS -->";
echo "<script src=\"".__RESOURCES."/assets/js/scripts.js?".DateUtil::getTimeNow()."\" type=\"text/javascript\"></script>";
echo "<!-- END PAGE LEVEL JS -->";

echo "<!--print system notification if have in session-->";
ControllerUtil::displayAppMsg();