<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\UsernameRole as UsernameRole;
use application\service\UsernameRoleService as UsernameRoleService;
use application\validator\UsernameRoleValidator as UsernameRoleValidator;
use application\util\MessageUtils as MessageUtil;
class UsernameRoleController extends  BaseController
{
    private $usernameRoleService;
    private $USERNAME_ROLE_LIST_VIEW = 'usernameRoleList';
    private $USERNAME_ROLE_ADD_VIEW = 'usernameRole';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->usernameRoleService = new UsernameRoleService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->usernameRoleService);
    }
    public function crudList()
    {
        $this->pushDataToView['usernameRoleList'] = $this->usernameRoleService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->usernameRoleService->getPagingLink();
        $this->loadView($this->USERNAME_ROLE_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['usernameRole'] = new UsernameRole(array());
        $this->loadView($this->USERNAME_ROLE_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $usernameRole = new UsernameRole();
        $usernameRole->populatePostData();

        $validator = new UsernameRoleValidator($usernameRole);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['usernameRole'] = $usernameRole;
            $this->loadView($this->USERNAME_ROLE_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->usernameRoleService->createByObject($usernameRole);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('usernamerolelist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(UsernameRole::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $usernameRole = $this->usernameRoleService->findById($id);
        if(!$usernameRole){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['usernameRole'] = $usernameRole;
        $this->loadView($this->USERNAME_ROLE_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(UsernameRole::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $usernameRole = new UsernameRole();
        $usernameRole->populatePostData();
        $usernameRole->setId($id);

        $validator = new UsernameRoleValidator($usernameRole);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['usernameRole'] = $usernameRole;
            $this->loadView($this->USERNAME_ROLE_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $usernameRole->getId();
            $effectRow = $this->usernameRoleService->updateByObject($usernameRole, $data_where);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull').'<br> effect row = '.$effectRow);
            v_rediect('usernameroleedit?usernamerole=1');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(UsernameRole::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $usernameRole = $this->usernameRoleService->findById($id);
        if(!$usernameRole){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->usernameRoleService->deleteById($id);
        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        v_rediect('usernamerolelist');
    }

}