<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\Nas as Nas;
use application\service\NasService as NasService;
use application\validator\NasValidator as NasValidator;
class NasController extends  BaseController
{
    private $nasService;
    private $NAS_LIST_VIEW = 'nasList';
    private $NAS_ADD_VIEW = 'nas';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->nasService = new NasService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->nasService);
    }
    public function crudList()
    {
        $q_parameter = $this->initSearchParam(new Nas());
        $this->pushDataToView['nasList'] = $this->nasService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView['appPaging'] = $this->nasService->getPagingLink();
        $this->loadView($this->NAS_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['nas'] = new Nas(array());
        $this->loadView($this->NAS_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $nas = new Nas();
        $nas->populatePostData();

        $validator = new NasValidator($nas);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['nas'] = $nas;
            $this->loadView($this->NAS_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->nasService->createByObject($nas);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('naslist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Nas::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $nas = $this->nasService->findById($id);
        if(!$nas){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['nas'] = $nas;
        $this->loadView($this->NAS_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Nas::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $nas = new Nas();
        $nas->populatePostData();
        $nas->setId($id);

        $validator = new NasValidator($nas);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['nas'] = $nas;
            $this->loadView($this->NAS_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $nas->getId();
            $effectRow = $this->nasService->updateByObject($nas, $data_where);
            ControllerUtils::setSuccessMessage('update state = '.$effectRow);
            v_rediect('naslist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Nas::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $nas = $this->nasService->findById($id);
        if(!$nas){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->nasService->deleteById($id);


//        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
//        v_rediect('naslist');
    }

}