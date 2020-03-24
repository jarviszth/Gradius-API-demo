<?php namespace application\controller;

use application\core\AppController as BaseController;
use application\service\LoginService as LoginService;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtil;

use application\service\AppUserService as AppUserService;


//option only for radius project
use application\service\RadcheckService as RadcheckService;
use application\model\AppUser as AppUser;
use application\model\AppUserRoleRoles as AppUserRoleRoles;
use application\service\AppUserRoleRolesService as AppUserRoleRolesService;
use application\util\MessageUtils;

class LoginController extends BaseController{

    private $loginService;

    private $loinPage = 'backend/login';
    //test variable call from php views page
    private $testVariable = 'login page';
    private $appUSerService;

    //option only for radius project
    private $radcheckService;
    private $appUserRoleRolesService;

    public function __construct($databaseConnection){
        $this->setDbConn($databaseConnection);
        $this->isAuthRequired = false;
        $this->loginService = new LoginService($this->getDbConn());
        $this->appUSerService = new AppUserService($this->getDbConn());

        //option only for radius project
        $this->radcheckService = new RadcheckService($this->getDbConn());
        $this->appUserRoleRolesService = new AppUserRoleRolesService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->loginService);
        unset($this->appUSerService);

        //option only for radius project
        unset($this->radcheckService);
        unset($this->appUserRoleRolesService);
    }
    public function getTestVariable(){
        return $this->testVariable;
    }

    public function index(){
        //unset all session and cookie
        $this->loginService->logout();

        //for radius client
        $msg = '';
        $cameFrom = FilterUtil::filterGetInt('cameFromChangePassSession');
        if($cameFrom==1){
            $radiusUrl= MessageUtils::getConfig('url_radius_client');
            $msg .= '<span style="text-align: center;">เปลี่ยนรหัสผ่านสำเร็จ <br><br>';
            $msg .='<a style="padding:20px;" href="'.$radiusUrl.'login.cgi">คลิกที่นี่</a>';
            $msg .='<br><br>';
            $msg .='เพื่อเข้าระบบเพื่อใช้อินเตอร์เน็ต ด้วยรหัสผ่านใหม่</span>';
        }

        $this->pushDataToView['testSendData'] = $msg;
        $this->loadView($this->loinPage, $this->pushDataToView);

    }

    public function loginAction(){
        $email = FilterUtil::unSafeFilterPost('email');
        $password = FilterUtil::unSafeFilterPost('p');
//        echoln('email='.$email);
//        echoln('pass='.$password);

        if($this->loginService->login($email,$password)){
            log_message("info", "logined success ......by ".$email."<br>", false, "loginLogs");
            ControllerUtil::setSuccessMessage('Logined success By => '.FilterUtil::filterSession('username'));

            //$appUser = $this->appUSerService->findByEmail($email);


            //go to dashboard
            $userSessionid = ControllerUtil::getUserIdSession();
            $isRadiusUser = false;
            if(!empty($userSessionid)){

                $appUserRoleRolesService = new AppUserRoleRolesService($this->getDbConn());
                $appUserRoleRolesList = $appUserRoleRolesService->findAppUserRoleRolesByApUser($userSessionid);
                if (is_array($appUserRoleRolesList) || is_object($appUserRoleRolesList)){
                    foreach ($appUserRoleRolesList as $appUserRoleRoles) {
                        $roleId = $appUserRoleRoles['app_user_role'];

                        if($roleId==3){
                            $isRadiusUser = true;
                            break;
                        }
                    }
                }
            }
            if(!$isRadiusUser){
                v_goto(_BASEURL.'dashboard');
            }else{
                v_goto(_BASEURL.'appuserchangepwdsession');
            }
//            v_goto(_BASEURL.'dashboard');
//            v_goto(_BASEURL.$appUser->getUsername());
        }else{


            //option only for radius project if can't find in app_user find from radcheck and create to app_user again
            $clearPwd = FilterUtil::filterPostString('pr');
            $radcheck = $this->radcheckService->findByUsernameAndPassword($email,$clearPwd);
            $appUser = $this->appUSerService->findByUsername($email);
            if($radcheck && !$appUser){

                $appUser = new AppUser();
                $appUser->setCreatedUser(1);
                $appUser->setUpdatedUser(1);
                $appUser->setUserFromRadius(1);
                $randomSalt = ControllerUtil::getRadomSault();
                $appUser->setUsername($email);
                $appUser->setLoginPassword(ControllerUtil::genHashPassword(FilterUtil::filterPostString('p'),$randomSalt));
                $appUser->setSalt($randomSalt);
                $lastAppUserId = $this->appUSerService->createByObject($appUser);
                if($lastAppUserId){

                    $appUserRoleRoles = new AppUserRoleRoles();
                    $appUserRoleRoles->setAppUser($lastAppUserId);
                    $appUserRoleRoles->setAppUserRole(3);
                    $appUserRoleRoles->setCreatedUser(1);
                    $appUserRoleRoles->setUpdatedUser(1);
                    $this->appUserRoleRolesService->createByObject($appUserRoleRoles);
                }
                ControllerUtil::setSuccessMessage('Please try again with curent Username And Password');

            }else{
                log_message("info", "logined fail......by ".$email."<br>", false, "loginLogs");
                ControllerUtil::setErrorMessage("<br> Login Fail");
            }
            //END OPTION ONLY RADIUS PROJECT

           // log_message("info", "logined fail......by ".$email, false, "loginLogs");
            //ControllerUtil::setErrorMessage("<br> Login Fail");
        }
        $this->loadView($this->loinPage, null);
    }
    public  function logoutAction(){
        log_message("info", "logouted ......by ".ControllerUtil::getUserNameSession()."<br>", false, "loginLogs");
        $this->loginService->logout();
        v_goto(_BASEURL.'login');
        exit;
    }
}