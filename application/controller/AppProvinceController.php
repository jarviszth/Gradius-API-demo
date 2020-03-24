<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\AppProvince as AppProvince;
use application\service\AppProvinceService as AppProvinceService;
use application\validator\AppProvinceValidator as AppProvinceValidator;
use application\service\AppGeographyService as AppGeographyService;
class AppProvinceController extends  BaseController
{
    private $appProvinceService;
    private $APP_PROVINCE_LIST_VIEW = 'backend/appProvinceList';
    private $APP_PROVINCE_ADD_VIEW = 'backend/appProvince';

    private $appGeographyService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->appProvinceService = new AppProvinceService($this->getDbConn());
        $this->appGeographyService = new AppGeographyService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->appProvinceService);
        unset($this->appGeographyService);
    }
    public function crudList()
    {
        $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->appProvinceService->getPagingLink();
        $this->loadView($this->APP_PROVINCE_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['appProvince'] = new AppProvince(array());
        $this->pushDataToView['appGeographyList'] = $this->appGeographyService->findAll();
        $this->loadView($this->APP_PROVINCE_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $appProvince = new AppProvince();
        $appProvince->populatePostData();

        $validator = new AppProvinceValidator($appProvince);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appProvince'] = $appProvince;
            $this->pushDataToView['appGeographyList'] = $this->appGeographyService->findAll();
            $this->loadView($this->APP_PROVINCE_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->appProvinceService->createByObject($appProvince);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('appprovincelist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppProvince::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appProvince = $this->appProvinceService->findById($id);
        if(!$appProvince){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['appProvince'] = $appProvince;
        $this->pushDataToView['appGeographyList'] = $this->appGeographyService->findAll();
        $this->loadView($this->APP_PROVINCE_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppProvince::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appProvince = new AppProvince();
        $appProvince->populatePostData();
        $appProvince->setId($id);

        $validator = new AppProvinceValidator($appProvince);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appProvince'] = $appProvince;
            $this->pushDataToView['appGeographyList'] = $this->appGeographyService->findAll();
            $this->loadView($this->APP_PROVINCE_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $appProvince->getId();
            $effectRow = $this->appProvinceService->updateByObject($appProvince, $data_where);
            ControllerUtils::setSuccessMessage('update state = '.$effectRow);
            v_rediect('appprovincelist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppProvince::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appProvince = $this->appProvinceService->findById($id);
        if(!$appProvince){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->appProvinceService->deleteById($id);
//        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
//        v_rediect('appprovincelist');
    }

}