<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\AppDistrict as AppDistrict;
use application\service\AppDistrictService as AppDistrictService;
use application\validator\AppDistrictValidator as AppDistrictValidator;

use application\service\AppProvinceService as AppProvinceService;
use application\service\AppAmphurService as AppAmphurService;
use application\model\AppAmphur as AppAmphur;
class AppDistrictController extends  BaseController
{
    private $appDistrictService;
    private $APP_DISTRICT_LIST_VIEW = 'backend/appDistrictList';
    private $APP_DISTRICT_ADD_VIEW = 'backend/appDistrict';

    private $appProvinceService;
    private $appAmphurService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->appDistrictService = new AppDistrictService($this->getDbConn());
        $this->appAmphurService = new AppAmphurService($this->getDbConn());
        $this->appProvinceService = new AppProvinceService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->appDistrictService);
        unset($this->appAmphurService);
        unset($this->appProvinceService);
    }
    public function crudList()
    {
        $this->pushDataToView['appDistrictList'] = $this->appDistrictService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->appDistrictService->getPagingLink();
        $this->loadView($this->APP_DISTRICT_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
        $this->pushDataToView['appAmphurList'] = $this->appAmphurService->findAll();
        $this->pushDataToView['appDistrict'] = new AppDistrict(array());
        $this->loadView($this->APP_DISTRICT_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $appDistrict = new AppDistrict();
        $appDistrict->populatePostData();

        $validator = new AppDistrictValidator($appDistrict);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
            $this->pushDataToView['appAmphurList'] = $this->appAmphurService->findAll();
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appDistrict'] = $appDistrict;
            $this->loadView($this->APP_DISTRICT_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->appDistrictService->createByObject($appDistrict);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('appdistrictlist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppDistrict::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appDistrict = $this->appDistrictService->findById($id);
        if(!$appDistrict){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
        $this->pushDataToView['appAmphurList'] = $this->appAmphurService->findAll();
        $this->pushDataToView['appDistrict'] = $appDistrict;
        $this->loadView($this->APP_DISTRICT_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppDistrict::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appDistrict = new AppDistrict();
        $appDistrict->populatePostData();
        $appDistrict->setId($id);

        $validator = new AppDistrictValidator($appDistrict);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
            $this->pushDataToView['appAmphurList'] = $this->appAmphurService->findAll();
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appDistrict'] = $appDistrict;
            $this->loadView($this->APP_DISTRICT_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $appDistrict->getId();
            $effectRow = $this->appDistrictService->updateByObject($appDistrict, $data_where);
            ControllerUtils::setSuccessMessage('update state = '.$effectRow);
            v_rediect('appdistrictlist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppDistrict::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appDistrict = $this->appDistrictService->findById($id);
        if(!$appDistrict){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->appDistrictService->deleteById($id);
        //ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        //v_rediect('appdistrictlist');
    }
    /* Ajax */
    public function onChangeDistrictByAmphur(){
        $amphurId = FilterUtil::validatePostInt(ControllerUtils::encodeParamId(AppAmphur::getTableName()));
        if(AppUtils::isEmpty($amphurId)) {
            echoln('Error 404 ');
        }else{
            $appDistrictList = $this->appDistrictService->findDistrictListByAmphur($amphurId);
            if($appDistrictList){
                foreach($appDistrictList as $appDistrict){
                    echo " <option value=\"".$appDistrict->getId()."\">".$appDistrict->getName()."</option>";
                }
            }
        }
    }

}