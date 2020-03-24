<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;
use application\util\MessageUtils as MessageUtil;
//use application\util\UploadUtil as UploadUtils;

use application\model\BatchUser as BatchUser;
use application\service\BatchUserService as BatchUserService;
use application\validator\BatchUserValidator as BatchUserValidator;

use application\service\BatchService as BatchService;
class BatchUserController extends  BaseController
{
    private $batchUserService;
    private $batchService;
    private $BATCH_USER_LIST_VIEW = 'batchUserList';
    private $BATCH_USER_ADD_VIEW = 'batchUser';

    private $batchId;
    private $batch = array();
    private $urlList = 'batchuserlist';
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->batchUserService = new BatchUserService($this->getDbConn());
        $this->batchService = new BatchService($this->getDbConn());

        $this->batchId  = FilterUtil::filterGetInt('batch');
        if(AppUtils::isEmpty($this->batchId)){
            $this->batchId=0;
        }else{
            if($this->batchId>0){
                $this->batch = $this->batchService->findById($this->batchId);
                $this->urlList .= "?batch=".$this->batch->getId();
            }
        }
    }
    public function __destruct()
    {
        unset($this->batchUserService);
        unset($this->batchService);
    }
    public function crudList()
    {

        $q_parameter = $this->initSearchParam(new BatchUser());
        //manual add q_parameter
        // $q_parameter['param'] = 'value';

        $this->pushDataToView['batchUserList'] = $this->batchUserService->findAllByBatch($this->getRowPerPage(), $q_parameter, $this->batchId);
        $this->pushDataToView['appPaging'] = $this->batchUserService->getPagingLink();
        $this->pushDataToView['batch'] = $this->batch;
        $this->loadView($this->BATCH_USER_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['batchUser'] = new BatchUser(array());
        $this->loadView($this->BATCH_USER_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $batchUser = new BatchUser();
        $batchUser->populatePostData();

        $validator = new BatchUserValidator($batchUser);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['batchUser'] = $batchUser;
            $this->loadView($this->BATCH_USER_ADD_VIEW, $this->pushDataToView);
        }else{
			//upload img
			/*
			if (is_uploaded_file($_FILES['img_upload']['tmp_name'])) {
				$imgName = UploadUtils::uploadImgFiles($_FILES['img_upload'],$batchUser->getCreatedDate());
				if($imgName){
					$batchUser->setImgName($imgName);
				}
			}
			*/
			//end upload file

            $lastInsertId = $this->batchUserService->createByObject($batchUser);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_insert_succesfull').'<br> save success last insert id = '.$lastInsertId);
            v_rediect('batchuserlist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(BatchUser::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $batchUser = $this->batchUserService->findById($id);
        if(!$batchUser){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['batchUser'] = $batchUser;
        $this->loadView($this->BATCH_USER_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(BatchUser::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
		$batchUserOld = $this->batchUserService->findById($id);
		if(!$batchUserOld){
			ControllerUtils::f404Static();
		}
		//$isDeleteImg = FilterUtil::validatePostInt('img_del');

        $batchUser = new BatchUser();
        $batchUser->populatePostData();
        $batchUser->setId($id);

        $validator = new BatchUserValidator($batchUser);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['batchUser'] = $batchUser;
            $this->loadView($this->BATCH_USER_ADD_VIEW, $this->pushDataToView);
        }else{
			//upload img
           /*
			if (is_uploaded_file($_FILES['img_upload']['tmp_name'])) {
				//delete imf file from server first
				if(!AppUtils::isEmpty($batchUserOld->getImgName())){
					UploadUtils::delImgfileFromYearMonthFolder($batchUserOld->getImgName(),$batchUserOld->getCreatedDate());
				}
				$imgName = UploadUtils::uploadImgFiles($_FILES['img_upload'],$batchUserOld->getCreatedDate());
				if($imgName){
					$batchUser->setImgName($imgName);
				}
			}elseif ($isDeleteImg){
				//delete imf file from server first
				if(!AppUtils::isEmpty($batchUserOld->getImgName())){
					UploadUtils::delImgfileFromYearMonthFolder($batchUserOld->getImgName(),$batchUserOld->getCreatedDate());
					$batchUser->setImgName('');
				}
			}
           */
			//end upload file

            $data_where['id'] = $batchUser->getId();
            $effectRow = $this->batchUserService->updateByObject($batchUser, $data_where);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull').'<br> effect row = '.$effectRow);
            v_rediect('batchuserlist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(BatchUser::$tableName));
        $isOk = true;
        if(AppUtils::isEmpty($id)) {
            $isOk = false;
        }
        $batchUser = $this->batchUserService->findById($id);
        if(!$batchUser){
            $isOk = false;
        }
        if($isOk){
		    //delete img
		    /*
		    if(!AppUtils::isEmpty($batchUser->getImgName())){
		    	UploadUtils::delImgfileFromYearMonthFolder($batchUser->getImgName(),$batchUser->getCreatedDate());
		    }
		    */
          $this->batchUserService->deleteById($id);
        }
    }

}