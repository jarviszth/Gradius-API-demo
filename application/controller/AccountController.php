<?php
namespace application\controller;

require __SITE_PATH . "/application/util/phpexcelreader/excel_reader2.php";
require __SITE_PATH . "/application/util/phpexcelreader/SpreadsheetReader.php";
//require __SITE_PATH . "/application/util/phpexcelreader/SpreadsheetReader_CSV.php";
//require __SITE_PATH . "/application/util/phpexcelreader/SpreadsheetReader_ODS.php";
//require __SITE_PATH . "/application/util/phpexcelreader/SpreadsheetReader_XLS.php";
//require __SITE_PATH . "/application/util/phpexcelreader/SpreadsheetReader_XLSX.php";


use application\core\AppController as BaseController;
use application\model\Radacct;
use application\util\DateUtils;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;
use application\util\MessageUtils as MessageUtil;
use application\util\UploadUtil as UploadUtils;

use application\model\Account as Account;
use application\service\AccountService as AccountService;
use application\validator\AccountValidator as AccountValidator;

use application\model\AppUser as AppUser;
use application\service\AppUserService as AppUserService;
use application\model\AppUserRoleRoles as AppUserRoleRoles;
use application\service\AppUserRoleRolesService as AppUserRoleRolesService;

use application\service\RadgroupDetailService as RadgroupDetailService;

use application\model\Radcheck as Radcheck;
use application\service\RadcheckService as RadcheckService;

use application\model\Radusergroup as Radusergroup;
use application\service\RadusergroupService as RadusergroupService;
use application\util\phpexcelreader\SpreadsheetReader as SpreadsheetReader;
use application\service\RadpostauthService as RadpostauthService;
use application\service\RadacctService as RadacctService;
use application\service\AppUserLoginService as AppUserLoginService;
use application\service\AppUserLoginAttemptsService as AppUserLoginAttemptsService;
class AccountController extends  BaseController
{
    private $accountService;
    private $ACCOUNT_LIST_VIEW = 'accountList';
    private $ACCOUNT_ADD_VIEW = 'account';
    private $ACCOUNT_CHANGE_PWD_VIEW = 'accountChangePass';
    private $ACCOUNT_EXCEL_IMPORT_VIEW = 'accountExcelImport';

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
    public static $APP_USER_ROLE_FOR_RADIUS_USER = 3;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->accountService = new AccountService($this->getDbConn());

        $this->radgroupDetailService = new RadgroupDetailService($this->getDbConn());
        $this->appUserService = new AppUserService($this->getDbConn());
        $this->radcheckService = new RadcheckService($this->getDbConn());
        $this->radusergroupService = new RadusergroupService($this->getDbConn());
        $this->appUserRoleRolesService = new AppUserRoleRolesService($this->getDbConn());
        $this->radpostauthService = new RadpostauthService($this->getDbConn());
        $this->radacctService = new RadacctService($this->getDbConn());
        $this->appUserLoginService = new AppUserLoginService($this->getDbConn());
        $this->appUserLoginAttemptsService = new AppUserLoginAttemptsService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->accountService);
        unset($this->radgroupDetailService);
        unset($this->appUserService);
        unset($this->radcheckService);
        unset($this->radusergroupService);
        unset($this->appUserRoleRolesService);
        unset($this->radpostauthService);
        unset($this->radacctService);
        unset($this->appUserLoginService);
        unset($this->appUserLoginAttemptsService);
    }
    public function crudList()
    {

//
//        $q_parameter = array();
//        if(FilterUtil::filterGetString('q_user_name')){
//            $q_parameter['q_user_name'] = FilterUtil::filterGetString('q_user_name');
//        }
//        if(FilterUtil::filterGetString('q_name')){
//            $q_parameter['q_name'] = FilterUtil::filterGetString('q_name');
//        }
//        if(FilterUtil::filterGetString('q_lastname')){
//            $q_parameter['q_lastname'] = FilterUtil::filterGetString('q_lastname');
//        }
//        if(FilterUtil::filterGetString('q_radusergroup_detail')){
//            $q_parameter['q_radusergroup_detail'] = FilterUtil::filterGetString('q_radusergroup_detail');
//        }
        $q_parameter = $this->initSearchParam(new Account());
        //manual add q_parameter
         $q_parameter['q_online_status'] = FilterUtil::filterGetInt('q_online_status');


        $this->pushDataToView['accountList'] = $this->accountService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
        $this->pushDataToView['appPaging'] = $this->accountService->getPagingLink();
        $this->loadView($this->ACCOUNT_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['account'] = new Account(array());
        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
        $this->pushDataToView['fromAction'] = 'add';
        $this->loadView($this->ACCOUNT_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $account = new Account();
        $account->populatePostData();

        $validator = new AccountValidator($account);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['account'] = $account;
            $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
            $this->loadView($this->ACCOUNT_ADD_VIEW, $this->pushDataToView);
        }else{
			//upload img
			if (is_uploaded_file($_FILES['img_upload']['tmp_name'])) {
				$imgName = UploadUtils::uploadImgFiles($_FILES['img_upload'],$account->getCreatedDate());
				if($imgName){
					$account->setImgName($imgName);
				}
			}
            $account->setStatus(true);
			//end upload file
            $clearPwd = FilterUtil::filterPostString('pr');
            $account->setPassword($clearPwd);
            //find group RadgroupDetail
            $radgroupDetail = $this->radgroupDetailService->findById($account->getRadusergroupDetail());


            ControllerUtils::setSuccessMessage('it will save to table => "account", "radcheck", "radusergroup", "app_user", "app_user_role_roles" ');
            //save to account table
            $lastAccountId = $this->accountService->createByObject($account);
            if($lastAccountId){
                ControllerUtils::setSuccessMessage('save to "account" success last insert id =>'.$lastAccountId);
            }

            //save to radcheck
            $radcheck = new Radcheck();
            $radcheck->setUsername($account->getUserName());
            $radcheck->setValue($clearPwd);
            $lastRadcheckId = $this->radcheckService->createByObject($radcheck);
            if($lastRadcheckId){
                ControllerUtils::setSuccessMessage('save to "radcheck" success last insert id =>'.$lastRadcheckId);
            }

            //save to radusergroup
            $radusergroup = new Radusergroup();
            $radusergroup->setUsername($account->getUserName());
            $radusergroup->setGroupname($radgroupDetail->getGroupname());
            $lastRadusergroupId = $this->radusergroupService->createByObject($radusergroup);
            if($lastRadusergroupId){
                ControllerUtils::setSuccessMessage('save to "radusergroup" success last insert id =>'.$lastRadusergroupId);
            }

            //save to app_user
            $appUser = new AppUser($this->initBaseCreateData());
            $randomSalt = ControllerUtils::getRadomSault();
            $appUser->setUserFromRadius(1);
            $appUser->setUsername($account->getUserName());
            $appUser->setLoginPassword(ControllerUtils::genHashPassword(FilterUtil::filterPostString('p'),$randomSalt));
            $appUser->setSalt($randomSalt);
            $appUser->setEmail($account->getEmail());
            $appUser->setImgName($account->getImgName());
            $lastAppUserId = $this->appUserService->createByObject($appUser);
            if($lastAppUserId){
                ControllerUtils::setSuccessMessage('save to "app_user" success last insert id =>'.$lastAppUserId);

                $appUserRoleRoles = new AppUserRoleRoles();
                $appUserRoleRoles->setAppUser($lastAppUserId);
                $appUserRoleRoles->setAppUserRole( self::$APP_USER_ROLE_FOR_RADIUS_USER);

                $lastAppUserRoleRolesId = $this->appUserRoleRolesService->createByObject($appUserRoleRoles);
                if($lastAppUserRoleRolesId){
                    ControllerUtils::setSuccessMessage('save to "app_user_role_roles" success last insert id =>'.$lastAppUserRoleRolesId);
                }
            }

            v_rediect('accountlist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Account::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $account = $this->accountService->findById($id);
        if(!$account){
            ControllerUtils::f404Static();
        }

        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
        $this->pushDataToView['account'] = $account;
        $this->pushDataToView['fromAction'] = 'edit';
        $this->loadView($this->ACCOUNT_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Account::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
		$accountOld = $this->accountService->findById($id);
		if(!$accountOld){
			ControllerUtils::f404Static();
		}
		$isDeleteImg = FilterUtil::validatePostInt('img_del');

        $account = new Account();
        $account->populatePostData();
        $account->setId($id);

        $validator = new AccountValidator($account);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
            $this->pushDataToView['fromAction'] = 'edit';
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['account'] = $account;
            $this->loadView($this->ACCOUNT_ADD_VIEW, $this->pushDataToView);
        }else{

            //get old data
            $radusergroupDetailOld = $this->radgroupDetailService->findById($accountOld->getRadusergroupDetail());
            $radcheck = $this->radcheckService->findByUsername($accountOld->getUserName());
            $appUser = $this->appUserService->findByUsername($accountOld->getUserName());
            $radusergroup = $this->radusergroupService->findByUsername($accountOld->getUserName());


			//upload img
			if (is_uploaded_file($_FILES['img_upload']['tmp_name'])) {
				//delete imf file from server first
				if(!AppUtils::isEmpty($accountOld->getImgName())){
					UploadUtils::delImgfileFromYearMonthFolder($accountOld->getImgName(),$accountOld->getCreatedDate());
				}
				$imgName = UploadUtils::uploadImgFiles($_FILES['img_upload'],$accountOld->getCreatedDate());
				if($imgName){
					$account->setImgName($imgName);
                    if($appUser){
                        $appUser->setImgName($imgName);
                    }

				}
			}elseif ($isDeleteImg){
				//delete imf file from server first
				if(!AppUtils::isEmpty($accountOld->getImgName())){
					UploadUtils::delImgfileFromYearMonthFolder($accountOld->getImgName(),$accountOld->getCreatedDate());
                    $account->setImgName('');
                    if($appUser) {
                        $appUser->setImgName('');
                    }
				}
			}
			//end upload file

            $radusergroupUsernameOld = $radusergroup->getUsername();
            $radusergroupGroupnameOld = $radusergroup->getGroupname();

            //update to radcheck table if change username
            if($accountOld->getUserName()!=$account->getUserName()){

                $radcheck->setUsername($account->getUserName());

                //set new username to radusergroup
                $radusergroup->setUsername($account->getUserName());

                if($appUser) {
                    //set new username to app_user
                    $appUser->setUsername($account->getUserName());
                }
            }
            if($accountOld->getEmail()!=$account->getEmail()){
                if($appUser) {
                    //set new email to app_user
                    $appUser->setEmail($account->getEmail());
                }
            }

            if($radusergroupDetailOld->getId()!=$account->getRadusergroupDetail()){
                $radusergroupDetailNew = $this->radgroupDetailService->findById($account->getRadusergroupDetail());
                $radusergroup->setGroupname($radusergroupDetailNew->getGroupname());
            }


            //update to account table
            $data_where['id'] = $account->getId();
            $this->accountService->updateByObject($account, $data_where);

            //update to radcheck
            $data_where_radcheck['id'] = $radcheck->getId();
            $this->radcheckService->updateByObject($radcheck,$data_where_radcheck);


            //update to radusergroup table
            $this->radusergroupService->deleteByUsernameAndGroup($radusergroupUsernameOld,$radusergroupGroupnameOld);
            $this->radusergroupService->createByObject($radusergroup);


            if($appUser) {
                //delete from appUserLogin
                $this->appUserLoginService->deleteByUserId($appUser->getUsername());
                //delete from appUserLogin
                $this->appUserLoginService->deleteByUserId($appUser->getUsername());
                //delete from appUserLoginAttempts
                $this->appUserLoginAttemptsService->deleteByUserId($appUser->getUsername());
                //delete from appUserLoginAttempts
                $this->appUserLoginAttemptsService->deleteByUserId($appUser->getUsername());
                //save to app_user table
                $data_where_appuser['id'] = $appUser->getId();
                $this->appUserService->updateByObject($appUser, $data_where_appuser);
            }

            ControllerUtils::setSuccessMessage(MessageUtil::getMessage('app_update_succesfull'));
            v_rediect('accountlist');
        }
    }
    private function deleteBase($id){
        //delete by ajax
        $isOk = true;
        if(AppUtils::isEmpty($id)) {
            $isOk = false;
        }
        $account = $this->accountService->findById($id);
        if(!$account){
            $isOk = false;
        }
        if($isOk){

            //delete img
            if(!AppUtils::isEmpty($account->getImgName())){
                UploadUtils::delImgfileFromYearMonthFolder($account->getImgName(),$account->getCreatedDate());
            }

            /**/

            $radgroupDetail = $this->radgroupDetailService->findById($account->getRadusergroupDetail());

            //delete from radusergroup
            $this->radusergroupService->deleteByUsernameAndGroup($account->getUserName(), $radgroupDetail->getGroupname());

            //delete from radcheck
            $radCheck = $this->radcheckService->findByUsername($account->getUserName());
            if($radCheck){
                $this->radcheckService->deleteById($radCheck->getId());
            }

            //delete from account
            $this->accountService->deleteById($id);

            //delete from radacct
//            $this->radacctService->deleteByUsername(AppUtils::getUpperString($account->getUserName()));
            //delete from radpostauth
//            $this->radpostauthService->deleteByUsername(AppUtils::getUpperString($account->getUserName()));


            //delete from app_user
            $appUser = $this->appUserService->findByUsername($account->getUserName());
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
    public function crudDelete()
    {

        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Account::$tableName));
        //delete by narmal post
        /*if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $account = $this->accountService->findById($id);
        if(!$account){
            ControllerUtils::f404Static();
        }
		//delete img
		if(!AppUtils::isEmpty($account->getImgName())){
			UploadUtils::delImgfileFromYearMonthFolder($account->getImgName(),$account->getCreatedDate());
		}

        $effectRow = $this->accountService->deleteById($id);
        ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        v_rediect('accountlist');
        */

        $this->deleteBase($id);


        //echoln('Fuckkkk off');
    }
    public function accountdeleteAll(){
        $seledId = FilterUtil::filterPostString('_id_selected');

        if(!AppUtils::isEmpty($seledId)){
            $arraId = explode("_",$seledId);
            if(is_array($arraId)){
                foreach ($arraId as $id){
                    $this->deleteBase($id);
                }
            }
        }
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
    public function accountChangePwd()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Account::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $account = $this->accountService->findById($id);
        if(!$account){
            ControllerUtils::f404Static();
        }

        $this->pushDataToView['account'] = $account;
        $this->loadView($this->ACCOUNT_CHANGE_PWD_VIEW, $this->pushDataToView);
    }
    public function accountChangePwdProcess()
    {

        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(Account::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $account = $this->accountService->findById($id);
        if(!$account){
            ControllerUtils::f404Static();
        }
        $clearPwd = FilterUtil::filterPostString('pr');


        //update in account
        $data_ac['password'] = $clearPwd;
        $data_ac_where['id'] = $account->getId();
        $this->accountService->update($data_ac, $data_ac_where);


        $radcheck = $this->radcheckService->findByUsername($account->getUserName());
        $appUser = $this->appUserService->findByUsername($account->getUserName());

        //update in app_user
        if(!empty($appUser)){
            $randomSalt = ControllerUtils::getRadomSault();
            $data['login_password']= ControllerUtils::genHashPassword(FilterUtil::filterPostString('p'),$randomSalt);
            $data['salt'] = $randomSalt;
            $data_where['id'] = $appUser->getId();
            $this->appUserService->update($data, $data_where, 'AND');
        }


        //update in radcheck
        $data_radcheck['value'] = $clearPwd;
        $data_where_radcheck['id'] = $radcheck->getId();
        $this->radcheckService->update($data_radcheck, $data_where_radcheck, 'AND');

        v_rediect('accountlist');
    }
    public function accountExcelImport()
    {
        $this->pushDataToView['radgroupDetailList'] = $this->radgroupDetailService->findAll();
        $this->loadView($this->ACCOUNT_EXCEL_IMPORT_VIEW, $this->pushDataToView);
    }
    public function accountExcelImportProcess()
    {
        $Reader=null;
        $Sheets=null;
        $returnMsg = "";
        $resualtMsg = "";
        $rowNo = 0;
        $addSuccess = 0;
        $isOk =true;

        if (is_uploaded_file($_FILES['file_excel_upload']['tmp_name'])) {

            //check file extension
            $fileExtension = UploadUtils::getFileExtension($_FILES['file_excel_upload']);
            if ($fileExtension != UploadUtils::$XLSX && $fileExtension != strtoupper(UploadUtils::$XLSX)) {
                $isOk = false;
                $returnMsg .= "<p class='text-danger'> <i class='fa fa-frown-o'></i> " . MessageUtil::getMessage('model_account_excel_choose_wrong') . "</p>";
            }


        if($isOk){

            //get radgroupDetail from db
            $radgroupDetailId = FilterUtil::validatePostInt('radusergroup_detail');
            $radgroupDetail = $this->radgroupDetailService->findById($radgroupDetailId);


            $fileName = UploadUtils::uploadFiles($_FILES['file_excel_upload']);
            $xecelFilePatch = UploadUtils::displayFilePathUpload($fileName);
            $Reader = new SpreadsheetReader($xecelFilePatch);
            $Sheets = $Reader->Sheets();
            //loop for sheet

            foreach ($Sheets as $Index => $Name) {
                //loob for Row
                $Reader->ChangeSheet($Index);
//                echoln('Sheet #'.$Index.': '.$Name) ;
//                foreach($Reader as $row)
//                {
//                    //loop
//                    foreach ($row as $column){
//                        echoln('colum row #'.$column) ;
//                    }
//
//                }

                foreach ($Reader as $row) {
                    $rowNo++;
                    if ($rowNo > 1) {
                        $userName = FilterUtil::filterVarString($row[0]);
                        $password = FilterUtil::filterVarString($row[1]);
                        $name = FilterUtil::filterVarString($row[2]);
                        $lastname = FilterUtil::filterVarString($row[3]);
                        $idCard = FilterUtil::filterVarString($row[4]);
                        $phone = FilterUtil::filterVarString($row[5]);
                        $mail = FilterUtil::filterVarString($row[6]);

//                        echoln(
//                            'userName='.$userName
//                            .', password='.$password
//                            .', name='.$name
//                            .', lastname='.$lastname
//                            .', idCard='.$idCard
//                            .', phone='.$phone
//                            .', mail='.$mail
//                        );

                        //check duplicate from radcheck
                        $radcheck = $this->radcheckService->findByUsername($userName);
                        if(!AppUtils::isEmpty($userName) && !AppUtils::isEmpty($password) && !$radcheck){

                            //save to account table
                            $account = new Account($this->initBaseCreateData());
                            $account->setUserName($userName);
                            $account->setPassword($password);
                            $account->setName($name);
                            $account->setLastname($lastname);
                            $account->setIdCard($idCard);
                            $account->setPhonenumber($phone);
                            $account->setEmail($mail);
                            $account->setRadusergroupDetail($radgroupDetail->getId());
                            $this->accountService->createByObject($account);

                            //save to radcheck
                            $radcheck = new Radcheck();
                            $radcheck->setUsername($userName);
                            $radcheck->setValue($password);
                            $this->radcheckService->createByObject($radcheck);


                            //save to radusergroup
                            $radusergroup = new Radusergroup();
                            $radusergroup->setUsername($userName);
                            $radusergroup->setGroupname($radgroupDetail->getGroupname());
                            $this->radusergroupService->createByObject($radusergroup);

                            $addSuccess++;
                            $returnMsg .= "<p class='text-success'>" . $userName . " <i class='fa fa-check'></i></p>";
                        }else{

                            //if have duplicate change password it
                            if($radcheck){
                                //update to radcheck
                                $radcheck->setValue($password);
                                $data_where_radcheck['id'] = $radcheck->getId();
                                $this->radcheckService->updateByObject($radcheck,$data_where_radcheck);

                                //delete from app_user
                                $appUser = $this->appUserService->findByUsername($radcheck->getUsername());
                                if(!empty($appUser)){
                                    //delete from appUserLogin
                                    $this->appUserLoginService->deleteByUserId($appUser->getId());
                                    //delete from appUserLoginAttempts
                                    $this->appUserLoginAttemptsService->deleteByUserId($appUser->getId());
                                    //delete app_user_role_roles before delete app_user
                                    $this->deleteAppUserRoleRoles($appUser->getId());
                                    $this->appUserService->deleteById($appUser->getId());
                                }

                            }


                            $returnMsg .= "<p class='text-danger'>" . $userName . " <i class='fa fa-times'></i></p>";
                        }





                    }
                }
            }

            $allRecord = ($rowNo - 1);
            $resualtMsg .="<p>".MessageUtil::getMessage('model_account_excel_allrec')." ".($rowNo - 1);
            $resualtMsg .=" ".MessageUtil::getMessage('model_account_excel_allrec_add')." <span class='fs-18 bold text-success'>".$addSuccess."</span>";
            $resualtMsg .=" ".MessageUtil::getMessage('model_account_excel_allrec_fail')." <span class='fs-18 bold text-danger'>".($allRecord - $addSuccess)."</span> ท่านสามารถไป
            ตรวจสอบรายชื่อที่เพิ่มได้ <a class=\"fs-18\" href=\""._BASEURL."accountlist\">ที่นี่</a></p><br>";

            //delete when everything ok
            UploadUtils::delfileFromYearMonthFolder($fileName);

        }
            

        }else{
            $returnMsg .= "<p class='text-danger'> <i class='fa fa-frown-o'></i> ".MessageUtil::getMessage('model_account_excel_choose_null')."</p>";
        }

        //manage msg return to view
        $return = "<div class=\"alert alert-warning\" role=\"alert\">";
        $return .= "<button class=\"close\" data-dismiss=\"alert\"></button>";
        $return .= "<strong><i class='fa fa-television'></i> ผลการนำเข้าข้อมูล: </strong><br><br>";
        $return .= $resualtMsg;
        if($returnMsg){
            $return .= $returnMsg;
        }else{
            $return .= "<p class='text-danger'> <i class='fa fa-frown-o'></i> ไม่พบข้อมูล</p>";
        }
        $return .= "</div>";
        echo $return;
    }
    public function accountExcelTemplateLoad()
    {

        $fileName = "loader_template.xlsx";
        $path = UploadUtils::displayFilePathUpload($fileName); // change the path to fit your websites document structure

        UploadUtils::downloadFileFromPath($path);

    }
    public function accountKickToOffLine(){
        $userId= FilterUtil::filterPostString('_user_id');
        $spanStatusId = FilterUtil::filterPostString('_spanStatusId');
        if(!AppUtils::isEmpty($userId)) {

            $account = $this->accountService->findById($userId);
            if(!empty($account)){



                if($account->isStatus()){
                    $stateUp=false;
                }else{
                    $stateUp=true;
                }
                $data_update['status']=$stateUp;
                $data_update_where['id']=(int)$userId;
                $state=$this->accountService->update($data_update,$data_update_where);

                if($state){
                    //block this user
                    $radgroupDetail = $this->radgroupDetailService->findById($account->getRadusergroupDetail());
                    if($account->isStatus()) {

                        //delete from radusergroup
                        $this->radusergroupService->deleteByUsernameAndGroup($account->getUserName(), $radgroupDetail->getGroupname());
                        //delete from radcheck
                        $radCheck = $this->radcheckService->findByUsername($account->getUserName());
                        if($radCheck){
                            $this->radcheckService->deleteById($radCheck->getId());
                        }

                        echo "<a href=\"#\" span-status-id=\"status_".$userId."\" data-username=\"".$userId."\" class=\"btn btn-warning tip app-kick-offline\" data-toggle=\"tooltip\" data-original-title=\"ปลดบล็อกผู้ใช้นี้\" title=\"ปลดบล็อกผู้ใช้นี้\"><i class=\"fa fa-lock\"></i></a>";
                    }else{
                        //unblock this user

                        //save to radcheck
                        $radcheck = new Radcheck();
                        $radcheck->setUsername($account->getUserName());
                        $radcheck->setValue($account->getPassword());
                        $this->radcheckService->createByObject($radcheck);

                        //save to radusergroup
                        $radusergroup = new Radusergroup();
                        $radusergroup->setUsername($account->getUserName());
                        $radusergroup->setGroupname($radgroupDetail->getGroupname());
                        $this->radusergroupService->createByObject($radusergroup);


                        echo "<a href=\"#\" span-status-id=\"status_".$userId."\" data-username=\"".$userId."\" class=\"btn btn-success tip app-kick-offline\" data-toggle=\"tooltip\" data-original-title=\"บล็อกผู้ใช้นี้\" title=\"บล็อกผู้ใช้นี้\"><i class=\"fa fa-unlock\"></i></a>";
                    }
                }

            }


        }
    }

    //report
    public function accountReportStatus()
    {
        $q_parameter = $this->initSearchParam(new Account());
        $this->pushDataToView['accountList'] = $this->accountService->findAllReportStatus($this->getRowPerPage(), $q_parameter);
        $this->loadView("accountReportStatus", $this->pushDataToView);
    }
    public function accountReportAuthen()
    {
        $userName = FilterUtil::filterGetString('_user_name');
        $account = $this->accountService->findDetailByUsername($userName);
        if(empty($account)){
            ControllerUtils::f404Static();
        }
        $q_parameter = $this->initSearchParam(new Radacct());
        $reportList = $this->radpostauthService->findAllPostAuthenByUserName(20, $q_parameter, $userName);


        $this->pushDataToView['appPaging'] = $this->radpostauthService->getPagingLink();
        $this->pushDataToView['totalRows'] = $this->radpostauthService->rowCount();
        $this->pushDataToView['account'] = $account;
        $this->pushDataToView['reportList'] = $reportList;
        $this->loadView("accountReportAuthen", $this->pushDataToView);
    }
    public function accountReportUsageTime()
    {
        $userName = FilterUtil::filterGetString('_user_name');
        $account = $this->accountService->findDetailByUsername($userName);
        if(empty($account)){
            ControllerUtils::f404Static();
        }
        $q_parameter = $this->initSearchParam(new Radacct());
        $reportList = $this->radacctService->findAllByUserName(20,$q_parameter,$userName);


        $this->pushDataToView['appPaging'] = $this->radacctService->getPagingLink();
        $this->pushDataToView['totalRows'] = $this->radacctService->rowCount();
        $this->pushDataToView['account'] = $account;
        $this->pushDataToView['reportList'] = $reportList;
        $this->loadView("accountReportUsageTime", $this->pushDataToView);
    }
}