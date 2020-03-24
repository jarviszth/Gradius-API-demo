<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\CnfRadius as CnfRadius;
use application\service\CnfRadiusService as CnfRadiusService;
use application\validator\CnfRadiusValidator as CnfRadiusValidator;
class CnfRadiusController extends  BaseController
{
    private $cnfRadiusService;
    private $CNF_RADIUS_LIST_VIEW = 'cnfRadiusList';
    private $CNF_RADIUS_ADD_VIEW = 'cnfRadius';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->cnfRadiusService = new CnfRadiusService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->cnfRadiusService);
    }
    public function crudList()
    {
        $this->pushDataToView['cnfRadiusList'] = $this->cnfRadiusService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->cnfRadiusService->getPagingLink();
        $this->loadView($this->CNF_RADIUS_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['cnfRadius'] = new CnfRadius(array());
        $this->loadView($this->CNF_RADIUS_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $cnfRadius = new CnfRadius();
        $cnfRadius->populatePostData();

        $validator = new CnfRadiusValidator($cnfRadius);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['cnfRadius'] = $cnfRadius;
            $this->loadView($this->CNF_RADIUS_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->cnfRadiusService->createByObject($cnfRadius);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('cnfradiuslist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(CnfRadius::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $cnfRadius = $this->cnfRadiusService->findById($id);
        if(!$cnfRadius){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['cnfRadius'] = $cnfRadius;
        $this->loadView($this->CNF_RADIUS_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(CnfRadius::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $cnfRadius = new CnfRadius();
        $cnfRadius->populatePostData();
        $cnfRadius->setId($id);

        $validator = new CnfRadiusValidator($cnfRadius);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['cnfRadius'] = $cnfRadius;
            $this->loadView($this->CNF_RADIUS_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $cnfRadius->getId();
            $effectRow = $this->cnfRadiusService->updateByObject($cnfRadius, $data_where);
            ControllerUtils::setSuccessMessage('update state = '.$effectRow);
            v_rediect('cnfradiusedit?cnfradius='.$id);
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(CnfRadius::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $cnfRadius = $this->cnfRadiusService->findById($id);
        if(!$cnfRadius){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->cnfRadiusService->deleteById($id);
        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        v_rediect('cnfradiuslist');
    }

}