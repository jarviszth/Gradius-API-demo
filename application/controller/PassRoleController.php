<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\PassRole as PassRole;
use application\service\PassRoleService as PassRoleService;
use application\validator\PassRoleValidator as PassRoleValidator;
use application\util\MessageUtils as MessageUtil;
class PassRoleController extends  BaseController
{
    private $passRoleService;
    private $PASS_ROLE_LIST_VIEW = 'passRoleList';
    private $PASS_ROLE_ADD_VIEW = 'passRole';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->passRoleService = new PassRoleService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->passRoleService);
    }
    public function crudList()
    {
        $this->pushDataToView['passRoleList'] = $this->passRoleService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->passRoleService->getPagingLink();
        $this->loadView($this->PASS_ROLE_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['passRole'] = new PassRole(array());
        $this->loadView($this->PASS_ROLE_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $passRole = new PassRole();
        $passRole->populatePostData();

        $validator = new PassRoleValidator($passRole);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['passRole'] = $passRole;
            $this->loadView($this->PASS_ROLE_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->passRoleService->createByObject($passRole);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('passrolelist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(PassRole::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $passRole = $this->passRoleService->findById($id);
        if(!$passRole){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['passRole'] = $passRole;
        $this->loadView($this->PASS_ROLE_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(PassRole::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $passRole = new PassRole();
        $passRole->populatePostData();
        $passRole->setId($id);

        $validator = new PassRoleValidator($passRole);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['passRole'] = $passRole;
            $this->loadView($this->PASS_ROLE_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $passRole->getId();
            $effectRow = $this->passRoleService->updateByObject($passRole, $data_where);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull').'<br> effect row = '.$effectRow);
            v_rediect('passroleedit?passrole=1');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(PassRole::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $passRole = $this->passRoleService->findById($id);
        if(!$passRole){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->passRoleService->deleteById($id);
        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        v_rediect('passrolelist');
    }

}