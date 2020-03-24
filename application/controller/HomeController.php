<?php
/**
 * Created by PhpStorm.
 * User: Bekaku
 * Date: 29/12/2015
 * Time: 6:22 PM
 */

namespace application\controller;

use application\core\AppController as BaseController;
class HomeController extends BaseController
{
    public function __construct($databaseConnection){
        $this->setDbConn($databaseConnection);
        $this->isAuthRequired = false;
    }
    public function index(){
        echoln('Welcome to Home Controller');
    }
}