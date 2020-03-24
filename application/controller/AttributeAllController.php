<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\AttributeAll as AttributeAll;
use application\service\AttributeAllService as AttributeAllService;
use application\validator\AttributeAllValidator as AttributeAllValidator;
use application\util\MessageUtils as MessageUtil;
class AttributeAllController extends  BaseController
{
    private $attributeAllService;
    private $ATTRIBUTE_ALL_LIST_VIEW = 'attributeAllList';
    private $ATTRIBUTE_ALL_ADD_VIEW = 'attributeAll';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->attributeAllService = new AttributeAllService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->attributeAllService);
    }
    public function crudList()
    {
        $q_parameter = $this->initSearchParam(new AttributeAll());
        $this->pushDataToView['attributeAllList'] = $this->attributeAllService->findAll($this->getRowPerPage(),$q_parameter);
        $this->pushDataToView['appPaging'] = $this->attributeAllService->getPagingLink();
        $this->loadView($this->ATTRIBUTE_ALL_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['attributeAll'] = new AttributeAll(array());
        $this->loadView($this->ATTRIBUTE_ALL_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $attributeAll = new AttributeAll();
        $attributeAll->populatePostData();

        $validator = new AttributeAllValidator($attributeAll);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['attributeAll'] = $attributeAll;
            $this->loadView($this->ATTRIBUTE_ALL_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->attributeAllService->createByObject($attributeAll);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_insert_succesfull').'<br> save success last insert id = '.$lastInsertId);
            v_rediect('attributealllist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AttributeAll::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $attributeAll = $this->attributeAllService->findById($id);
        if(!$attributeAll){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['attributeAll'] = $attributeAll;
        $this->loadView($this->ATTRIBUTE_ALL_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AttributeAll::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $attributeAll = new AttributeAll();
        $attributeAll->populatePostData();
        $attributeAll->setId($id);

        $validator = new AttributeAllValidator($attributeAll);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['attributeAll'] = $attributeAll;
            $this->loadView($this->ATTRIBUTE_ALL_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $attributeAll->getId();
            $effectRow = $this->attributeAllService->updateByObject($attributeAll, $data_where);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull').'<br> effect row = '.$effectRow);
            v_rediect('attributealllist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AttributeAll::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $attributeAll = $this->attributeAllService->findById($id);
        if(!$attributeAll){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->attributeAllService->deleteById($id);


//        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
//        v_rediect('attributealllist');
    }

}