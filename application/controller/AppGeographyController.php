<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\AppGeography as AppGeography;
use application\service\AppGeographyService as AppGeographyService;
use application\validator\AppGeographyValidator as AppGeographyValidator;
class AppGeographyController extends  BaseController
{
    private $appGeographyService;
    private $APP_GEOGRAPHY_LIST_VIEW = 'backend/appGeographyList';
    private $APP_GEOGRAPHY_ADD_VIEW = 'backend/appGeography';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->appGeographyService = new AppGeographyService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->appGeographyService);
    }
    public function crudList()
    {
        $this->pushDataToView['appGeographyList'] = $this->appGeographyService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->appGeographyService->getPagingLink();
        $this->loadView($this->APP_GEOGRAPHY_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['appGeography'] = new AppGeography(array());
        $this->loadView($this->APP_GEOGRAPHY_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $appGeography = new AppGeography();
        $appGeography->populatePostData();

        $validator = new AppGeographyValidator($appGeography);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appGeography'] = $appGeography;
            $this->loadView($this->APP_GEOGRAPHY_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->appGeographyService->createByObject($appGeography);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('appgeographylist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppGeography::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appGeography = $this->appGeographyService->findById($id);
        if(!$appGeography){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['appGeography'] = $appGeography;
        $this->loadView($this->APP_GEOGRAPHY_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppGeography::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appGeography = new AppGeography();
        $appGeography->populatePostData();
        $appGeography->setId($id);

        $validator = new AppGeographyValidator($appGeography);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appGeography'] = $appGeography;
            $this->loadView($this->APP_GEOGRAPHY_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $appGeography->getId();
            $effectRow = $this->appGeographyService->updateByObject($appGeography, $data_where);
            ControllerUtils::setSuccessMessage('update state = '.$effectRow);
            v_rediect('appgeographylist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppGeography::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appGeography = $this->appGeographyService->findById($id);
        if(!$appGeography){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->appGeographyService->deleteById($id);
        //ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        //v_rediect('appgeographylist');
    }

}