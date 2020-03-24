<?php
/**
 * Created by PhpStorm.
 * User: Bekaku
 * Date: 29/12/2015
 * Time: 10:30 AM
 */

namespace application\controller;

use application\core\AppController;
use application\util\i18next;

class IndexController extends AppController
{
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->isAuthRequired = false;
    }

    public function index()
    {
        $this->pushDataToView = $this->setResponseStatus(array(), true, i18next::getTranslation('app.system_name'));
        $this->jsonResponse($this->pushDataToView);

    }
}