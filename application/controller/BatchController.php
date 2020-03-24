<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\model\BatchUser;
use application\model\Radcheck;
use application\model\Radusergroup;
use application\service\AppUserLoginAttemptsService;
use application\service\AppUserLoginService;
use application\service\AppUserRoleRolesService;
use application\service\AppUserService;
use application\service\RadacctService;
use application\service\RadcheckService;
use application\service\RadgroupDetailService;
use application\service\RadgroupreplyService;
use application\service\RadpostauthService;
use application\service\RadusergroupService;
use application\util\DateUtils;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;
use application\util\MessageUtils as MessageUtil;
//use application\util\UploadUtil as UploadUtils;

use application\model\Batch as Batch;
use application\service\BatchService as BatchService;
use application\validator\BatchValidator as BatchValidator;
use application\service\BatchUserService as BatchUserService;
class BatchController extends  BaseController
{
    private $batchService;
    private $BATCH_LIST_VIEW = 'batchList';
    private $BATCH_ADD_VIEW = 'batch';


    //optional
    private $radgroupDetailService;
    private $appUserService;
    private $radcheckService;
    private $radusergroupService;
    private $appUserRoleRolesService;
    private $radpostauthService;
    public $radacctService;
    private $appUserLoginService;
    private $appUserLoginAttemptsService;
    private $batchUserService;
    private $radgroupreplyService;

    public static $PWD_TYPE_RANDOM="R";
    public static $PWD_TYPE_FIX="F";

    private static $RANDOM_PWD_NO="1";
    private static $RANDOM_PWD_CHAR="2";
    private static $RANDOM_PWD_NO_CHAR="3";

    private static $LENGHT_OF_PASSWORD=5;

    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->batchService = new BatchService($this->getDbConn());

        $this->radgroupDetailService = new RadgroupDetailService($this->getDbConn());
        $this->appUserService = new AppUserService($this->getDbConn());
        $this->radcheckService = new RadcheckService($this->getDbConn());
        $this->radusergroupService = new RadusergroupService($this->getDbConn());
        $this->appUserRoleRolesService = new AppUserRoleRolesService($this->getDbConn());
        $this->radpostauthService = new RadpostauthService($this->getDbConn());
        $this->radacctService = new RadacctService($this->getDbConn());
        $this->appUserLoginService = new AppUserLoginService($this->getDbConn());
        $this->appUserLoginAttemptsService = new AppUserLoginAttemptsService($this->getDbConn());
        $this->batchUserService = new BatchUserService($this->getDbConn());
        $this->radgroupreplyService = new RadgroupreplyService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->batchService);

        unset($this->radgroupDetailService);
        unset($this->appUserService);
        unset($this->radcheckService);
        unset($this->radusergroupService);
        unset($this->appUserRoleRolesService);
        unset($this->radpostauthService);
        unset($this->radacctService);
        unset($this->appUserLoginService);
        unset($this->appUserLoginAttemptsService);
        unset($this->batchUserService);
        unset($this->radgroupreplyService);
    }
    public function crudList()
    {
        $q_parameter = $this->initSearchParam(new Batch());
        //manual add q_parameter
        // $q_parameter['param'] = 'value';

        $this->pushDataToView['batchList'] = $this->batchService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView['appPaging'] = $this->batchService->getPagingLink();
        $this->loadView($this->BATCH_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['batch'] = new Batch(array());
        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
        $this->loadView($this->BATCH_ADD_VIEW, $this->pushDataToView);
    }

    public function crudAddProcess()
    {
        $batch = new Batch();
        $batch->populatePostData();

        $postULenght = FilterUtil::filterPostInt('username_lenght');
        $postUPre = FilterUtil::filterPostString('username_prefix');
        $postUSub = FilterUtil::filterPostString('username_subfix');
        $postUDomain = FilterUtil::filterPostString('username_domain');

        $postPwdType = FilterUtil::filterPostString('password_type');
        $postPwdRanRadio = FilterUtil::filterPostInt('random_password_radio');
        $postPwdFixTxt = FilterUtil::filterPostString('fix_password_text');


        $batch->setUsernameLenght($postULenght);
        $batch->setUsernamePrefix($postUPre);
        $batch->setUsernameSubfix($postUSub);
        $batch->setUsernameDomain($postUDomain);

        $batch->setPasswordType($postPwdType);
        $batch->setRandomPasswordRadio($postPwdRanRadio);
        $batch->setFixPasswordText($postPwdFixTxt);


        $validator = new BatchValidator($batch);
        $errors = $validator->getValidationErrors();

        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();


        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['batch'] = $batch;
            $this->loadView($this->BATCH_ADD_VIEW, $this->pushDataToView);
        }else{

            //save to batch table frist
            $lastbatchInsertId = $this->batchService->createByObject($batch);
            $radgroupDetail = $this->radgroupDetailService->findById($batch->getRadusergroupDetail());

            $userNameFormat = "";
            $lengtOfVolume = strlen($batch->getVolume());
            $userNameRealLenght = $batch->getUsernameLenght()-$lengtOfVolume;
            //random user name
            if($batch->getUsernameLenght()>0){
                $userNameFormat = strtoupper(AppUtils::generateRandomOnlyString($userNameRealLenght));
            }


            //add user to db
            for ($volLenght = 1; $volLenght <= $batch->getVolume(); $volLenght++) {
                
                $genarateUname = $this->generateUnameFormat($batch,$volLenght,$userNameFormat);
                $generatePwd = $this->generatePwd($batch);


                //check duplicate from radcheck
                $radcheck = $this->radcheckService->findByUsername($genarateUname);
                if(!empty($radcheck)){
                    $genarateUname .="_2";
                }
                //save to radcheck

                $radcheck = new Radcheck();
                $radcheck->setUsername($genarateUname);
                $radcheck->setValue($generatePwd);
                $this->radcheckService->createByObject($radcheck);

                //save to radusergroup
                $radusergroup = new Radusergroup();
                $radusergroup->setUsername($genarateUname);
                $radusergroup->setGroupname($radgroupDetail->getGroupname());
                $this->radusergroupService->createByObject($radusergroup);

                //save to batch_user
                $batchUser = new BatchUser($this->initBaseCreateData());
                $batchUser->setBatch($lastbatchInsertId);
                $batchUser->setUserName($genarateUname);
                $batchUser->setPassword($generatePwd);
                $batchUser->setStartDate(DateUtils::getDateNow());
                $batchUser->setExpiredDate(DateUtils::getPlusDateFromNow(1));
                $batchUser->setStatus(1);
                $this->batchUserService->createByObject($batchUser);

                echoln("u=>".$genarateUname.", p=>".$generatePwd);
            }

            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_insert_succesfull').'<br> save success last insert id = '.$lastbatchInsertId);
            v_rediect('batchlist');
        }
    }
    private function generateUnameFormat(Batch $batch, $position=0, $nameFormat){

        if($batch->getUsernameLenght()>0){
            $genarateUname = $this->genarateZeroFormat($batch->getUsernameLenght(), $nameFormat, $position);
        }else{

            $genarateUname = $batch->getUsernamePrefix().$position;
            if(!empty($batch->getUsernameSubfix())){
                $genarateUname .=$batch->getUsernameSubfix();
            }
            if(!empty($batch->getUsernameDomain())){
                $genarateUname .="@".$batch->getUsernameDomain();
            }
        }

        return $genarateUname;
    }
    private function genarateZeroFormat($lenght, $nameFormat, $position){

        $nameLen = strlen($nameFormat);
        $poLen  = strlen($position);

        $reLenght = $lenght-($nameLen+$poLen);
        if($reLenght>0){
            $zeroPre = "";
            for ($i = 1; $i <= $reLenght; $i++) {
                $zeroPre .="0";
            }

            $position =$zeroPre.$position;

        }

    return $nameFormat.$position;

    }
    private function generatePwd(Batch $batch){



        $returnPwd="";

        //random pwd
        if($batch->getPasswordType()== self::$PWD_TYPE_RANDOM){
            
            if($batch->getRandomPasswordRadio()==self::$RANDOM_PWD_NO){
                
                $returnPwd = AppUtils::generateRandomOnlyNumeric(self::$LENGHT_OF_PASSWORD);
                
            }elseif ($batch->getRandomPasswordRadio() == self::$RANDOM_PWD_CHAR){

                $returnPwd = AppUtils::generateRandomOnlyString(self::$LENGHT_OF_PASSWORD);

            }else{
                $returnPwd = AppUtils::generateRandomStringAndNumeric(self::$LENGHT_OF_PASSWORD);
            }
            
        }elseif($batch->getPasswordType()== self::$PWD_TYPE_FIX){
            $returnPwd = $batch->getFixPasswordText();
        }
        


        return $returnPwd;

    }

    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Batch::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $batch = $this->batchService->findById($id);
        if(!$batch){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['batch'] = $batch;
        $this->loadView($this->BATCH_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Batch::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
		$batchOld = $this->batchService->findById($id);
		if(!$batchOld){
			ControllerUtils::f404Static();
		}
		//$isDeleteImg = FilterUtil::validatePostInt('img_del');

        $batch = new Batch();
        $batch->populatePostData();
        $batch->setId($id);

        $validator = new BatchValidator($batch);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['batch'] = $batch;
            $this->loadView($this->BATCH_ADD_VIEW, $this->pushDataToView);
        }else{
			//upload img
           /*
			if (is_uploaded_file($_FILES['img_upload']['tmp_name'])) {
				//delete imf file from server first
				if(!AppUtils::isEmpty($batchOld->getImgName())){
					UploadUtils::delImgfileFromYearMonthFolder($batchOld->getImgName(),$batchOld->getCreatedDate());
				}
				$imgName = UploadUtils::uploadImgFiles($_FILES['img_upload'],$batchOld->getCreatedDate());
				if($imgName){
					$batch->setImgName($imgName);
				}
			}elseif ($isDeleteImg){
				//delete imf file from server first
				if(!AppUtils::isEmpty($batchOld->getImgName())){
					UploadUtils::delImgfileFromYearMonthFolder($batchOld->getImgName(),$batchOld->getCreatedDate());
					$batch->setImgName('');
				}
			}
           */
			//end upload file

            $data_where['id'] = $batch->getId();
            $effectRow = $this->batchService->updateByObject($batch, $data_where);
            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull').'<br> effect row = '.$effectRow);
            v_rediect('batchlist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Batch::$tableName));
        $isOk = true;
        if(AppUtils::isEmpty($id)) {
            $isOk = false;
        }
        $batch = $this->batchService->findById($id);
        if(!$batch){
            $isOk = false;
        }
        if($isOk){
		    //delete batch user before
           $batchUserList = $this->batchUserService->findAllByBatch(0, array(), $batch->getId());
            if(is_array($batchUserList)){
                foreach ($batchUserList as $batchUser){
                    $this->deleteBaseAccount($batchUser->getId());
                }
            }
            $this->batchService->deleteById($id);
        }
    }
    public function batchuserinactive()
    {
        $id = FilterUtil::validatePostInt('_batch_user_id');
        if(!AppUtils::isEmpty($id)) {

            $data['status']=0;
            $data_where['id']=(int)$id;
            $state = $this->batchUserService->update($data, $data_where);
            echo "inactive status".$state;
        }
    }

    public function batchuserdelete()
    {
        $id = FilterUtil::validateGetInt('batchuser');
        $this->deleteBaseAccount($id);
    }
    private function deleteBaseAccount($id){
        $isOk = true;
        if(AppUtils::isEmpty($id)) {
            $isOk = false;
        }
        $batchUser = $this->batchUserService->findById($id);
        if(!$batchUser){
            $isOk = false;
        }
        if($isOk){

            $batch = $this->batchService->findById($batchUser->getBatch());
            if(!empty($batch)){

                $radgroupDetail = $this->radgroupDetailService->findById($batch->getRadusergroupDetail());
                //delete from radusergroup
                if(!empty($radgroupDetail)){
                    $this->radusergroupService->deleteByUsernameAndGroup($batchUser->getUserName(), $radgroupDetail->getGroupname());
                }

                //delete from radcheck
                $radCheck = $this->radcheckService->findByUsername($batchUser->getUserName());
                if($radCheck){
                    $this->radcheckService->deleteById($radCheck->getId());
                }
                //delete from radacct
//                $this->radacctService->deleteByUsername(AppUtils::getUpperString($batchUser->getUserName()));
                //delete from radpostauth
//                $this->radpostauthService->deleteByUsername(AppUtils::getUpperString($batchUser->getUserName()));
                

                //delete from app_user
                $appUser = $this->appUserService->findByUsername($batchUser->getUserName());
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
            $this->batchUserService->deleteById($id);
        }
    }
    private function deleteAppUserRoleRoles($appUserId){
        $appUserRoleRolesList= null;
        $appUserRoleRolesList =  $this->appUserRoleRolesService->findAppUserRoleRolesByApUser($appUserId);
        if(is_array($appUserRoleRolesList)){
            foreach($appUserRoleRolesList as $appUserRoleRoles){
                $roleRolesId = $appUserRoleRoles['id'];
                $this->appUserRoleRolesService->deleteById($roleRolesId);

            }
        }
    }

    public function batchUserPrint()
    {
        $batchId = FilterUtil::validateGetInt('batch');

        if(AppUtils::isEmpty($batchId)) {
            ControllerUtils::f404Static();
        }
        $batch = $this->batchService->findById($batchId);
        if(!$batch){
            ControllerUtils::f404Static();
        }
        $radGroupDetail = $this->radgroupDetailService->findById($batch->getRadusergroupDetail());
        $radGroupReply = $this->radgroupreplyService->findByGroupNameAndAttribute($radGroupDetail->getGroupname(),'Session-Timeout');
        $groupValueTime="";
        if(!empty($radGroupReply)){
            $groupValueTime = $radGroupReply->getValue();
        }

        $this->pushDataToView['batch_user_list'] = $this->batchUserService->findAllByBatch(0, array(), $batchId);
        $this->pushDataToView['batch'] = $batch;
        $this->pushDataToView['group_value_time'] = $groupValueTime;
        $this->loadView("batchUserPrint", $this->pushDataToView);
    }



}