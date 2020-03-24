<?php
/**
 * Created by PhpStorm.
 * User: Bekaku
 * Date: 5/8/2016
 * Time: 9:15 AM
 */
use application\util\MessageUtils as MessageUtil;

/*
 *
 *
 *modal class => fill-in, slide-up disable-scroll, stick-up, slide-right
 *modal size => '' if default , 'modal-sm' if small size, 'modal-lg' if large size
 */

echo "<!-- START APP AJAX LODING -->";
echo "<div class=\"modal fade slide-up disable-scroll\" id=\"modal-app-ajax-loding\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"false\">";
echo "    <div class=\"modal-dialog modal-sm\">";
echo "        <div class=\"modal-content-wrapper\">";
echo "            <div class=\"modal-content\">";
echo "                <div class=\"modal-body text-center m-t-20\">";
echo "                    <i  class=\"fa fa-spinner fa-spin fa-3x fa-fw text-danger\" ></i> <br>";
echo                        MessageUtil::getMessage('app_please_wait_while_loading');
echo "                </div>";
echo "            </div>";
echo "        </div>";
echo "        <!-- /.modal-content -->";
echo "    </div>";
echo "</div>";
echo "<!-- /.END  APP AJAX LODING -->";

echo "<!-- START CONFIRM DELETE  -->";
echo "<div class=\"modal fade stick-up\" id=\"modal-app-delete-seleted-confirm\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">";
echo "    <div class=\"modal-dialog\">";
echo "        <div class=\"modal-content-wrapper\">";
echo "            <div class=\"modal-content\">";
echo "                <div class=\"modal-header clearfix text-left\">";
echo "                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"><i class=\"pg-close fs-14\"></i></button>";
echo "                    <h5><i class=\"fa fa-bullhorn text-danger\"></i> <span class=\"semi-bold\">".MessageUtil::getMessage('app_system_name')."</span></h5>";
echo "                    <p class=\"p-b-10\">".MessageUtil::getMessage('app_delete_confirm')."</p>";
echo "                </div>";
echo "                <div class=\"modal-body\">";
echo "                    <div class=\"row\">";
echo "                        <div class=\"col-sm-12 text-center\">";
echo "                            <div id=\"modal-app-delete-seleted-confirm-err\" class=\"text-danger\"></div>";
echo "                            <div style=\"display: none\" id=\"modal-app-delete-seleted-confirm-loading\">";
echo "                                <i  class=\"fa fa-spinner fa-spin fa-3x fa-fw text-danger\" ></i> <br>";
echo                                    MessageUtil::getMessage('app_please_wait_while_loading');
echo "                            </div>";
echo "                        </div>";
echo "                    </div>";
echo "                    <div class=\"row\">";
echo "                        <div class=\"m-t-10 sm-m-t-10\"></div>";
echo "                        <div class=\"pull-right col-sm-6\">";
echo "                            <button type=\"button\" class=\"btn btn-default btn-block m-t-5\" data-dismiss=\"modal\">".MessageUtil::getMessage('app_cancel')."</button>";
echo "                        </div>";
echo "                        <div class=\"pull-right col-sm-6\">";
echo "                            <button type=\"button\" class=\"btn btn-danger btn-block m-t-5 app-delete-seleted-confirm-yes\">".MessageUtil::getMessage('app_submit')."</button>";
echo "                        </div>";
echo "                    </div>";
echo "                </div>";
echo "            </div>";
echo "        </div>";
echo "        <!-- /.modal-content -->";
echo "    </div>";
echo "</div>";
echo "<!-- /END CONFIRM DELETE -->";

echo "<!-- START CONFIRM DELETE ALL  -->";
echo "<div class=\"modal fade stick-up\" id=\"modal-app-delete-seleted-all-confirm\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">";
echo "    <div class=\"modal-dialog\">";
echo "        <div class=\"modal-content-wrapper\">";
echo "            <div class=\"modal-content\">";
echo "                <div class=\"modal-header clearfix text-left\">";
echo "                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"><i class=\"pg-close fs-14\"></i></button>";
echo "                    <h5><i class=\"fa fa-bullhorn text-danger\"></i> <span class=\"semi-bold\">".MessageUtil::getMessage('app_system_name')."</span></h5>";
echo "                    <p class=\"p-b-10\">".MessageUtil::getMessage('app_delete_confirm')."</p>";
echo "                </div>";
echo "                <div class=\"modal-body\">";
echo "                    <div class=\"row\">";
echo "                        <div class=\"col-sm-12 text-center\">";
echo "                            <div id=\"modal-app-delete-seleted-all-confirm-err\" class=\"text-danger\"></div>";
echo "                            <div style=\"display: none\" id=\"modal-app-delete-seleted-all-confirm-loading\">";
echo "                                <i  class=\"fa fa-spinner fa-spin fa-3x fa-fw text-danger\" ></i> <br>";
echo                                    MessageUtil::getMessage('app_please_wait_while_loading');
echo "                            </div>";
echo "                        </div>";
echo "                    </div>";
echo "                    <div class=\"row\">";
echo "                        <div class=\"m-t-10 sm-m-t-10\"></div>";
echo "                        <div class=\"pull-right col-sm-6\">";
echo "                            <button type=\"button\" class=\"btn btn-default btn-block m-t-5\" data-dismiss=\"modal\">".MessageUtil::getMessage('app_cancel')."</button>";
echo "                        </div>";
echo "                        <div class=\"pull-right col-sm-6\">";
echo "                            <button type=\"button\" class=\"btn btn-danger btn-block m-t-5 app-delete-seleted-all-confirm-yes\">".MessageUtil::getMessage('app_submit')."</button>";
echo "                        </div>";
echo "                    </div>";
echo "                </div>";
echo "            </div>";
echo "        </div>";
echo "        <!-- /.modal-content -->";
echo "    </div>";
echo "</div>";
echo "<!-- /END CONFIRM DELETE ALL -->";

echo "<!-- START CONFIRM DELETE LOGS  -->";
echo "<div class=\"modal fade stick-up\" id=\"modal-app-delete-logs-confirm\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">";
echo "    <div class=\"modal-dialog\">";
echo "        <div class=\"modal-content-wrapper\">";
echo "            <div class=\"modal-content\">";
echo "                <div class=\"modal-header clearfix text-left\">";
echo "                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"><i class=\"pg-close fs-14\"></i></button>";
echo "                    <h5><i class=\"fa fa-bullhorn text-danger\"></i> <span class=\"semi-bold\">".MessageUtil::getMessage('app_system_name')."</span></h5>";
echo "                    <p class=\"p-b-10\">".MessageUtil::getMessage('app_delete_confirm')."</p>";
echo "                </div>";
echo "                <div class=\"modal-body\">";
echo "                    <div class=\"row\">";
echo "                        <div class=\"col-sm-12 text-center\">";
echo "                            <div id=\"modal-app-delete-logs-confirm-err\" class=\"text-danger\"></div>";
echo "                            <div style=\"display: none\" id=\"modal-app-delete-logs-confirm-loading\">";
echo "                                <i  class=\"fa fa-spinner fa-spin fa-3x fa-fw text-danger\" ></i> <br>";
echo                                    MessageUtil::getMessage('app_please_wait_while_loading');
echo "                            </div>";
echo "                        </div>";
echo "                    </div>";
echo "                    <div class=\"row\">";
echo "                        <div class=\"m-t-10 sm-m-t-10\"></div>";
echo "                        <div class=\"pull-right col-sm-6\">";
echo "                            <button type=\"button\" class=\"btn btn-default btn-block m-t-5\" data-dismiss=\"modal\">".MessageUtil::getMessage('app_cancel')."</button>";
echo "                        </div>";
echo "                        <div class=\"pull-right col-sm-6\">";
echo "                            <button type=\"button\" class=\"btn btn-danger btn-block m-t-5 app-delete-logs-confirm-yes\">".MessageUtil::getMessage('app_submit')."</button>";
echo "                        </div>";
echo "                    </div>";
echo "                </div>";
echo "            </div>";
echo "        </div>";
echo "        <!-- /.modal-content -->";
echo "    </div>";
echo "</div>";
echo "<!-- /END CONFIRM DELETE LOGS -->";