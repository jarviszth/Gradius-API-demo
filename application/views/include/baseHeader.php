<?php use application\util\DateUtils as DateUtil;
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "   <meta http-equiv=\"content-type\" content=\"text/html;charset=UTF-8\" />";
echo "   <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
echo "    <meta charset=\"utf-8\" />";
echo "    <!--    <title>Bekaku</title>-->";
echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no\" />";
echo "    <link rel=\"apple-touch-icon\" href=\"".__RESOURCES."/pages/ico/icon_60.png\">";
echo "    <link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"".__RESOURCES."/pages/ico/ico_76.png\">";
echo "    <link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"".__RESOURCES."/pages/ico/ico_120.png\">";
echo "    <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"".__RESOURCES."/pages/ico/ico_152.png\">";
echo "    <link rel=\"icon\" type=\"image/x-icon\" href=\"".__RESOURCES."/pages/ico/ico_60.png\" /><!-- favicon.ico -->";
//echo "    <link rel=\"icon\" type=\"image/x-icon\" href=\"favicon.ico\" />";
echo "    <meta name=\"apple-mobile-web-app-capable\" content=\"yes\">";
echo "    <meta name=\"apple-touch-fullscreen\" content=\"yes\">";
echo "    <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"default\">";
echo "    <meta content=\"\" name=\"description\" />";
echo "    <meta content=\"\" name=\"author\" />";

echo "    <!-- BEGIN Vendor CSS-->";
echo "    <link href=\"".__RESOURCES."/assets/plugins/pace/pace-theme-flash.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "    <link href=\"".__RESOURCES."/assets/plugins/boostrapv3/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "    <link href=\"".__RESOURCES."/assets/plugins/font-awesome/css/font-awesome.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "    <link href=\"".__RESOURCES."/assets/plugins/jquery-scrollbar/jquery.scrollbar.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
echo "    <link href=\"".__RESOURCES."/assets/plugins/bootstrap-select2/select2.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
echo "    <link href=\"".__RESOURCES."/assets/plugins/switchery/css/switchery.min.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
echo "    <!-- BEGIN Pages CSS-->";

echo "    <link href=\"".__RESOURCES."/pages/css/pages-icons.css\" rel=\"stylesheet\" type=\"text/css\">";

//echo "    <link class=\"main-stylesheet\" href=\"".__RESOURCES."/pages/css/pages.css?".DateUtil::getTimeNow()."\" rel=\"stylesheet\" type=\"text/css\" />";
echo "    <link class=\"main-stylesheet\" href=\"".__RESOURCES."/pages/css/themes/unlax.css?".DateUtil::getTimeNow()."\" rel=\"stylesheet\" type=\"text/css\" />";
//echo "    <link href=\"".__RESOURCES."/pages/css/themes/doithai.css?".DateUtil::getTimeNow()."\" rel=\"stylesheet\" type=\"text/css\">";
//echo "    <link href=\"".__RESOURCES."/pages/css/themes.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<script src=\"".__RESOURCES."/assets/plugins/jquery/jquery-1.11.1.min.js\" type=\"text/javascript\"></script>";
echo "    <!--[if lte IE 9]>";
echo "    <link href=\"".__RESOURCES."/assets/plugins/codrops-dialogFx/dialog.ie.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "    <![endif]-->";
echo "    <script type=\"text/javascript\"> \n";
echo "       var $"."BASE_URL = \""._BASEURL."\"; \n";
echo "    </script> \n";
echo "</head>";