<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;
use application\util\MessageUtils as MessageUtil;
use application\util\DateUtils as DateUtils;
use application\util\UploadUtil as UploadUtils;

use application\model\RadgroupDetail as RadgroupDetail;
use application\service\RadgroupDetailService as RadgroupDetailService;
use application\validator\RadgroupDetailValidator as RadgroupDetailValidator;

use application\service\RadgroupcheckService as RadgroupcheckService;
use application\service\RadgroupreplyService as RadgroupreplyService;
use application\model\Radgroupcheck as Radgroupcheck;
use application\model\Radgroupreply as Radgroupreply;
use application\service\AttributeAllService as AttributeAllService;

use application\service\AccountService as AccountService;
use application\service\AppUserService as AppUserService;
use application\service\AppUserRoleRolesService as AppUserRoleRolesService;
use application\service\RadcheckService as RadcheckService;
use application\service\RadusergroupService as RadusergroupService;
use application\service\RadpostauthService as RadpostauthService;
use application\service\RadacctService as RadacctService;
use application\service\AppUserLoginService as AppUserLoginService;
use application\service\AppUserLoginAttemptsService as AppUserLoginAttemptsService;
class RadgroupDetailController extends  BaseController
{
    private $radgroupDetailService;
    private $RADGROUP_DETAIL_LIST_VIEW = 'radgroupDetailList';
    private $RADGROUP_DETAIL_ADD_VIEW = 'radgroupDetail';
    private $RADGROUP_DETAIL_ATTRIBUTE_LIST_VIEW = 'radgroupcheckList';
    private $RADGROUP_DETAIL_ATTRIBUTE_ADD_VIEW = 'radgroupcheck';
    private $RADGROUP_DETAIL_ATTRIBUTE_EDIT_VIEW = 'radgroupcheckedit';

    private $radgroupcheckService;
    private $radgroupreplyService;
    private $attributeAllService;
    private $appUserService;
    private $radcheckService;
    private $radusergroupService;
    private $appUserRoleRolesService;
    private $radpostauthService;
    private $radacctService;
    private $appUserLoginService;
    private $appUserLoginAttemptsService;
    private $accountService;

    private $TYPE_VALUE_TEXT = 'text';
    private $TYPE_VALUE_NUMBER = 'number';
    private $TYPE_VALUE_SECOND = 'second';
    private $TYPE_VALUE_DATE = 'date';
    private $TYPE_CHECK = 'check';
    private $TYPE_REPLY = 'reply';

    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->radgroupDetailService = new RadgroupDetailService($this->getDbConn());
        $this->radgroupcheckService = new RadgroupcheckService($this->getDbConn());
        $this->radgroupreplyService = new RadgroupreplyService($this->getDbConn());
        $this->attributeAllService = new AttributeAllService($this->getDbConn());

        $this->appUserService = new AppUserService($this->getDbConn());
        $this->radcheckService = new RadcheckService($this->getDbConn());
        $this->radusergroupService = new RadusergroupService($this->getDbConn());
        $this->appUserRoleRolesService = new AppUserRoleRolesService($this->getDbConn());
        $this->radpostauthService = new RadpostauthService($this->getDbConn());
        $this->radacctService = new RadacctService($this->getDbConn());
        $this->appUserLoginService = new AppUserLoginService($this->getDbConn());
        $this->appUserLoginAttemptsService = new AppUserLoginAttemptsService($this->getDbConn());
        $this->accountService = new AccountService($this->getDbConn());
    }

    public function __destruct()
    {
        unset($this->radgroupDetailService);
        unset($this->radgroupcheckService);
        unset($this->radgroupreplyService);
        unset($this->attributeAllService);

        unset($this->appUserService);
        unset($this->radcheckService);
        unset($this->radusergroupService);
        unset($this->appUserRoleRolesService);
        unset($this->radpostauthService);
        unset($this->radacctService);
        unset($this->appUserLoginService);
        unset($this->appUserLoginAttemptsService);
        unset($this->accountService);
    }

    public function crudList()
    {
        $q_parameter = $this->initSearchParam(new RadgroupDetail());
        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll($this->getRowPerPage(),$q_parameter);
        $this->pushDataToView['appPaging'] = $this->radgroupDetailService->getPagingLink();
        $this->loadView($this->RADGROUP_DETAIL_LIST_VIEW, $this->pushDataToView);
    }

    public function crudAdd()
    {
        $this->pushDataToView['radgroupDetail'] = new RadgroupDetail(array());
        $this->loadView($this->RADGROUP_DETAIL_ADD_VIEW, $this->pushDataToView);
    }

    public function crudAddProcess()
    {
        $radgroupDetail = new RadgroupDetail();
        $radgroupDetail->populatePostData();

        $validator = new RadgroupDetailValidator($radgroupDetail);
        $errors = $validator->getValidationErrors();
        if ($errors) {
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
            $this->loadView($this->RADGROUP_DETAIL_ADD_VIEW, $this->pushDataToView);
        } else {
            $lastInsertId = $this->radgroupDetailService->createByObject($radgroupDetail);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_insert_succesfull') . '<br> save success last insert id = ' . $lastInsertId);
            v_rediect('radgroupdetaillist');
        }
    }

    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(RadgroupDetail::$tableName));
        if (AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $radgroupDetail = $this->radgroupDetailService->findById($id);
        if (!$radgroupDetail) {
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
        $this->loadView($this->RADGROUP_DETAIL_ADD_VIEW, $this->pushDataToView);
    }

    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(RadgroupDetail::$tableName));
        if (AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $radgroupDetail = new RadgroupDetail();
        $radgroupDetail->populatePostData();
        $radgroupDetail->setId($id);

        $validator = new RadgroupDetailValidator($radgroupDetail);
        $errors = $validator->getValidationErrors();
        if ($errors) {
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
            $this->loadView($this->RADGROUP_DETAIL_ADD_VIEW, $this->pushDataToView);
        } else {
            $data_where['id'] = $radgroupDetail->getId();
            $effectRow = $this->radgroupDetailService->updateByObject($radgroupDetail, $data_where);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull') . '<br> effect row = ' . $effectRow);
            v_rediect('radgroupdetaillist');
        }
    }

    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(RadgroupDetail::$tableName));
        if (AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $radgroupDetail = $this->radgroupDetailService->findById($id);
        if (!$radgroupDetail) {
            ControllerUtils::f404Static();
        }

        //delete from radgroupcheck
        $this->radgroupcheckService->deleteByGroupName($radgroupDetail->getGroupname());

        //delete from radgroupreply
        $this->radgroupreplyService->deleteByGroupName($radgroupDetail->getGroupname());

        //delete from account
        $q_parameter['q_radusergroup_detail'] = $radgroupDetail->getId();
        $accountList = $this->accountService->findAll(0, $q_parameter);
        if($accountList){
            foreach ($accountList as $account){
                //delete img
                if(!AppUtils::isEmpty($account['img_name'])){
                    UploadUtils::delImgfileFromYearMonthFolder($account['img_name'],$account['created_date']);
                }

                //delete from radusergroup
                $this->radusergroupService->deleteByUsernameAndGroup($account['user_name'], $radgroupDetail->getGroupname());
                //delete from radcheck
                $radCheck = $this->radcheckService->findByUsername($account['user_name']);
                if($radCheck){
                    $this->radcheckService->deleteById($radCheck->getId());
                }

                //delete from account
                $this->accountService->deleteById($account['id']);
                //delete from radacct
//                $this->radacctService->deleteByUsername(AppUtils::getUpperString($account['user_name']));
                //delete from radpostauth
//                $this->radpostauthService->deleteByUsername(AppUtils::getUpperString($account['user_name']));

                //delete from app_user
                $appUser = $this->appUserService->findByUsername($account['user_name']);
                if($appUser){
                    //delete from appUserLogin
                    $this->appUserLoginService->deleteByUserId($appUser->getId());
                    //delete from appUserLoginAttempts
                    $this->appUserLoginAttemptsService->deleteByUserId($appUser->getId());

                    //delete app_user_role_roles before delete app_user
                    $this->deleteAppUserRoleRoles($appUser->getId());
                    $this->appUserService->deleteById($appUser->getId());
                }
            }
        }


        //delete account app_user radcheck radusergroup ... before delete group


        $effectRow = $this->radgroupDetailService->deleteById($id);


        //ControllerUtils::setSuccessMessage('Delete state = ' . $effectRow);
        //v_rediect('radgroupdetaillist');
    }
    private function deleteAppUserRoleRoles($appUserId){
        $appUserRoleRolesList= null;
        $appUserRoleRolesList =  $this->appUserRoleRolesService->findAppUserRoleRolesByApUser($appUserId);
        if($appUserRoleRolesList){
            foreach($appUserRoleRolesList as $appUserRoleRoles){

                $roleRolesId = $appUserRoleRoles['id'];
                $this->appUserRoleRolesService->deleteById($roleRolesId);

            }
        }
    }
    private function getGroupDetail()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(RadgroupDetail::$tableName));
        if (AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $radgroupDetail = $this->radgroupDetailService->findById($id);
        if (!$radgroupDetail) {
            ControllerUtils::f404Static();
        }
        return $radgroupDetail;
    }

    public function radgroupDetailAttributeList()
    {
        $radgroupDetail = $this->getGroupDetail();
        //find radgroupcheck list
        $radgroupcheckList = $this->radgroupcheckService->findByGroupName($radgroupDetail->getGroupname());
        $radgroupreplyList = $this->radgroupreplyService->findByGroupName($radgroupDetail->getGroupname());

        $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
        $this->pushDataToView['radgroupcheckList'] = $radgroupcheckList;
        $this->pushDataToView['radgroupreplyList'] = $radgroupreplyList;


        $this->loadView($this->RADGROUP_DETAIL_ATTRIBUTE_LIST_VIEW, $this->pushDataToView);
    }

    public function radgroupDetailAttributeAdd()
    {
        $radgroupDetail = $this->getGroupDetail();
        $radgroupcheckReplyInArray = self::getRadcheckAndReplyByThisGroup($radgroupDetail->getGroupname());


        $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
        $this->pushDataToView['radgroupCheckAndReply'] = new Radgroupcheck(array());
        $this->pushDataToView['attributeAllList'] = $this->attributeAllService->findAll();
        $this->pushDataToView['radgroupcheckReplyInArray'] = $radgroupcheckReplyInArray;

        $this->loadView($this->RADGROUP_DETAIL_ATTRIBUTE_ADD_VIEW, $this->pushDataToView);
    }

    private function getRadcheckAndReplyByThisGroup($groupName){
        $radgroupcheckReplyInArray = array();
        //radcheck selected by this group
        $radgroupcheckListSelectedByGroup = $this->radgroupcheckService->findByGroupName($groupName);
        if ($radgroupcheckListSelectedByGroup) {
            foreach ($radgroupcheckListSelectedByGroup as $radgroupcheck) {
                $radgroupcheckReplyInArray[] = $radgroupcheck->getAttribute();
            }
        }

        //radreply selected by this group
        $radgroupreplyListSelectedByGroup = $this->radgroupreplyService->findByGroupName($groupName);
        if ($radgroupreplyListSelectedByGroup) {
            foreach ($radgroupreplyListSelectedByGroup as $radgroupreply) {
                $radgroupcheckReplyInArray[] = $radgroupreply->getAttribute();
            }
        }

        return $radgroupcheckReplyInArray;

    }
    public function radgroupDetailAttributeAddProcess()
    {

        $radgroupDetail = $this->getGroupDetail();
        $radgroupcheckReplyInArray = self::getRadcheckAndReplyByThisGroup($radgroupDetail->getGroupname());


        //get attribute option from submit
        $attributeId = FilterUtil::validatePostInt('attribute');
        $isOk = true;

        $attributeAll = null;
        $radgroupCheck = new Radgroupcheck(array());
        $radgroupReply = new Radgroupreply(array());

        if(!$attributeId){
            $isOk = false;
            ControllerUtils::setErrorMessage(MessageUtil::getMessage('model_help_type_null'));
        }else{
            $attributeAll = $this->attributeAllService->findById($attributeId);
            
            $radgroupCheck->setAttribute($attributeAll->getAttribute());
            $radgroupCheck->setGroupname($radgroupDetail->getGroupname());


            //validate value
            $valueBind = FilterUtil::unSafeFilterPost('value');
            $value = null;
            if(AppUtils::isEmpty($valueBind)){
                $isOk = false;
                ControllerUtils::setErrorMessage(MessageUtil::getMessage('model_help_type_null_value'));
            }

            //validate by attribute type
            if($attributeAll->getTypeValue()==$this->TYPE_VALUE_NUMBER){

                $value = str_replace(",","",$valueBind);
                if(!FilterUtil::isNumeric($value)){
                    $isOk = false;
                    ControllerUtils::setErrorMessage(MessageUtil::getMessage('model_help_type_number'));
                }

            }elseif($attributeAll->getTypeValue()==$this->TYPE_VALUE_DATE){

                $valueDateFormat = DateUtils::convertDateStrToDateFormat($valueBind);
                $value = DateUtils::convertDateToTimeStamp($valueDateFormat);

            }elseif($attributeAll->getTypeValue()==$this->TYPE_VALUE_SECOND){

                list($day, $hour, $minute) = explode(":",$valueBind);
                if(!FilterUtil::isNumeric($day)){
                    $day = 0;
                }
                if(!FilterUtil::isNumeric($hour)){
                    $hour = 0;
                }
                if(!FilterUtil::isNumeric($minute)){
                    $minute = 0;
                }

                $day=(($day*24)*60)*60;
                $hour=($hour*60)*60;
                $minute=$minute*60;

                $value = $day+$hour+$minute;
            }elseif($attributeAll->getTypeValue()==$this->TYPE_VALUE_TEXT){
                $value = FilterUtil::filterVarString($valueBind);
            }

            $radgroupCheck->setValue($value);
        }



        if(!$isOk){

            $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
            $this->pushDataToView['radgroupCheckAndReply'] = $radgroupCheck;
            $this->pushDataToView['attributeAllList'] = $this->attributeAllService->findAll();
            $this->pushDataToView['radgroupcheckReplyInArray'] = $radgroupcheckReplyInArray;
            $this->loadView($this->RADGROUP_DETAIL_ATTRIBUTE_ADD_VIEW, $this->pushDataToView);

        }else{

                $lastInsertId = null;
                if($attributeAll->getTypeCheckreply()==$this->TYPE_REPLY){

                    //if type reply save to radgroupreply


                    $radgroupReply->setAttribute($radgroupCheck->getAttribute());
                    $radgroupReply->setGroupname($radgroupCheck->getGroupname());
                    $radgroupReply->setValue($radgroupCheck->getValue());

                    $lastInsertId = $this->radgroupreplyService->createByObject($radgroupReply);


                }else{
                    //if type reply save to radgroupcheck
                    $lastInsertId = $this->radgroupcheckService->createByObject($radgroupCheck);
                }

            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_insert_succesfull') . '<br> save success last insert id = ' . $lastInsertId);
            v_rediect('radgroupchecklist?'.ControllerUtils::genParamId($radgroupDetail));
        }

    }
    public function jsonCheckGroupReplyType(){

        $attributeId = FilterUtil::filterGetInt('_attid');//when send via json must get value type by $_GET

        $attributeAll = $this->attributeAllService->findById($attributeId);
        $attributeName = null;
        $attTypeValue = null;
        $attTypeCheckReply = null;
        if($attributeAll){
            $attTypeValue = $attributeAll->getTypeValue();
            $attTypeCheckReply = $attributeAll->getTypeCheckreply();
            $attributeName = $attributeAll->getAttribute();
        }

        $return["att_name"] = $attributeName;
        $return["att_type_value"] = $attTypeValue;
        $return["att_type_checkreply"] = $attTypeCheckReply;
        echo json_encode($return);
    }
    public function radgroupDetailAttributeEdit()
    {
        $radgroupDetail = $this->getGroupDetail();
        $radGroupCheckReply = FilterUtil::filterGetString('_radcheckreply');
        $attributeId = FilterUtil::validateGetInt('_attribute');
        $radgroupCheckReplyObj = null;

        if (AppUtils::isEmpty($attributeId)) {
            ControllerUtils::f404Static();
        }


        if($radGroupCheckReply==$this->TYPE_CHECK){
            $radgroupCheckReplyObj = $this->radgroupcheckService->findById($attributeId);

        }elseif ($radGroupCheckReply==$this->TYPE_REPLY){
            $radgroupCheckReplyObj = $this->radgroupreplyService->findById($attributeId);
        }

        if(!$radgroupCheckReplyObj){
            ControllerUtils::f404Static();
        }
        $attributeAll = $this->attributeAllService->findByAttributeName($radgroupCheckReplyObj->getAttribute());
        

        
        $this->pushDataToView['attributeAll'] = $attributeAll;
        $this->pushDataToView['radgroupCheckReply'] = $radgroupCheckReplyObj;
        $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
        $this->loadView($this->RADGROUP_DETAIL_ATTRIBUTE_EDIT_VIEW, $this->pushDataToView);

    }
    public function radgroupDetailAttributeEditProcess()
    {
        $radgroupDetail = $this->getGroupDetail();
        $radGroupCheckReply = FilterUtil::filterGetString('_radcheckreply');
        $attributeId = FilterUtil::validateGetInt('_attribute');
        $radgroupCheckReplyObj = null;

        if (AppUtils::isEmpty($attributeId)) {
            ControllerUtils::f404Static();
        }
        if($radGroupCheckReply==$this->TYPE_CHECK){
            $radgroupCheckReplyObj = $this->radgroupcheckService->findById($attributeId);

        }elseif ($radGroupCheckReply==$this->TYPE_REPLY){
            $radgroupCheckReplyObj = $this->radgroupreplyService->findById($attributeId);
        }

        if(!$radgroupCheckReplyObj){
            ControllerUtils::f404Static();
        }
        $attributeAll = $this->attributeAllService->findByAttributeName($radgroupCheckReplyObj->getAttribute());


        //validate value
        $isOk = true;
        $valueBind = FilterUtil::unSafeFilterPost('value');
        $value = null;
        if(AppUtils::isEmpty($valueBind)){
            $isOk = false;
            ControllerUtils::setErrorMessage(MessageUtil::getMessage('model_help_type_null_value'));
        }

        //validate by attribute type
        if($attributeAll->getTypeValue()==$this->TYPE_VALUE_NUMBER){

            $value = str_replace(",","",$valueBind);
            if(!FilterUtil::isNumeric($value)){
                $isOk = false;
                ControllerUtils::setErrorMessage(MessageUtil::getMessage('model_help_type_number'));
            }

        }elseif($attributeAll->getTypeValue()==$this->TYPE_VALUE_DATE){

            $valueDateFormat = DateUtils::convertDateStrToDateFormat($valueBind);
            $value = DateUtils::convertDateToTimeStamp($valueDateFormat);

        }elseif($attributeAll->getTypeValue()==$this->TYPE_VALUE_SECOND){

            list($day, $hour, $minute) = explode(":",$valueBind);
            if(!FilterUtil::isNumeric($day)){
                $day = 0;
            }
            if(!FilterUtil::isNumeric($hour)){
                $hour = 0;
            }
            if(!FilterUtil::isNumeric($minute)){
                $minute = 0;
            }

            $day=(($day*24)*60)*60;
            $hour=($hour*60)*60;
            $minute=$minute*60;

            $value = $day+$hour+$minute;
        }elseif($attributeAll->getTypeValue()==$this->TYPE_VALUE_TEXT){
            $value = FilterUtil::filterVarString($valueBind);
        }

        $radgroupCheckReplyObj->setValue($value);




        if(!$isOk){
            $this->pushDataToView['attributeAll'] = $attributeAll;
            $this->pushDataToView['radgroupCheckReply'] = $radgroupCheckReplyObj;
            $this->pushDataToView['radgroupDetail'] = $radgroupDetail;
            $this->loadView($this->RADGROUP_DETAIL_ATTRIBUTE_EDIT_VIEW, $this->pushDataToView);
        }else{
            $effectRow = null;
            if($radGroupCheckReply==$this->TYPE_CHECK){
                $data_where['id'] = $radgroupCheckReplyObj->getId();
                $effectRow = $this->radgroupcheckService->updateByObject($radgroupCheckReplyObj,$data_where);


            }elseif ($radGroupCheckReply==$this->TYPE_REPLY){
                $data_where['id'] = $radgroupCheckReplyObj->getId();
                $effectRow = $this->radgroupreplyService->updateByObject($radgroupCheckReplyObj,$data_where);
            }

            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull') . '<br> effect row = ' . $effectRow);
            v_rediect('radgroupchecklist?'.ControllerUtils::genParamId($radgroupDetail));
        }
    }
    public function radgroupDetailAttributeDelete()
    {
        $radgroupDetail = $this->getGroupDetail();
        $radGroupCheckReply = FilterUtil::filterGetString('_radcheckreply');
        $attributeId = FilterUtil::validateGetInt('_attribute');
        $radgroupCheckReplyObj = null;

        if (AppUtils::isEmpty($attributeId)) {
            ControllerUtils::f404Static();
        }


        if($radGroupCheckReply==$this->TYPE_CHECK){
            $radgroupCheckReplyObj = $this->radgroupcheckService->findById($attributeId);
            if($radgroupCheckReplyObj){
                $this->radgroupcheckService->deleteById($radgroupCheckReplyObj->getId());
            }

        }elseif ($radGroupCheckReply==$this->TYPE_REPLY){
            $radgroupCheckReplyObj = $this->radgroupreplyService->findById($attributeId);
            $this->radgroupreplyService->deleteById($radgroupCheckReplyObj->getId());
        }

    }

}