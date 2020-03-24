<?php
namespace application\controller;

use application\core\AppController as BaseController;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
use application\util\AppUtil as AppUtils;

use application\model\AppAmphur as AppAmphur;
use application\service\AppAmphurService as AppAmphurService;
use application\validator\AppAmphurValidator as AppAmphurValidator;

use application\service\AppProvinceService as AppProvinceService;
use application\model\AppProvince as AppProvince;
class AppAmphurController extends  BaseController
{
    private $appAmphurService;
    private $APP_AMPHUR_LIST_VIEW = 'backend/appAmphurList';
    private $APP_AMPHUR_ADD_VIEW = 'backend/appAmphur';

    private $appProvinceService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->appAmphurService = new AppAmphurService($this->getDbConn());
        $this->appProvinceService = new AppProvinceService($this->getDbConn());
    }
    public function __destruct()
    {
        unset($this->appAmphurService);
        unset($this->appProvinceService);
    }
    public function crudList()
    {
        $this->pushDataToView['appAmphurList'] = $this->appAmphurService->findAll($this->getRowPerPage());
        $this->pushDataToView['appPaging'] = $this->appAmphurService->getPagingLink();
        $this->loadView($this->APP_AMPHUR_LIST_VIEW, $this->pushDataToView);
    }
    public function crudAdd()
    {
        $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
        $this->pushDataToView['appAmphur'] = new AppAmphur(array());
        $this->loadView($this->APP_AMPHUR_ADD_VIEW, $this->pushDataToView);
    }
    public function crudAddProcess()
    {
        $appAmphur = new AppAmphur();
        $appAmphur->populatePostData();

        $validator = new AppAmphurValidator($appAmphur);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appAmphur'] = $appAmphur;
            $this->loadView($this->APP_AMPHUR_ADD_VIEW, $this->pushDataToView);
        }else{
            $lastInsertId = $this->appAmphurService->createByObject($appAmphur);
            ControllerUtils::setSuccessMessage('save success last insert id = '.$lastInsertId);
            v_rediect('appamphurlist');
        }
    }
    public function crudEdit()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppAmphur::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appAmphur = $this->appAmphurService->findById($id);
        if(!$appAmphur){
            ControllerUtils::f404Static();
        }
        $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
        $this->pushDataToView['appAmphur'] = $appAmphur;
        $this->loadView($this->APP_AMPHUR_ADD_VIEW, $this->pushDataToView);
    }
    public function crudEditProcess()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppAmphur::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appAmphur = new AppAmphur();
        $appAmphur->populatePostData();
        $appAmphur->setId($id);

        $validator = new AppAmphurValidator($appAmphur);
        $errors = $validator->getValidationErrors();
        if($errors){
            $this->pushDataToView['appProvinceList'] = $this->appProvinceService->findAll();
            $this->pushDataToView['validateErrors'] = $errors;
            $this->pushDataToView['appAmphur'] = $appAmphur;
            $this->loadView($this->APP_AMPHUR_ADD_VIEW, $this->pushDataToView);
        }else{
            $data_where['id'] = $appAmphur->getId();
            $effectRow = $this->appAmphurService->updateByObject($appAmphur, $data_where);
            ControllerUtils::setSuccessMessage('update state = '.$effectRow);
            v_rediect('appamphurlist');
        }
    }
    public function crudDelete()
    {
        $id = FilterUtil::validateGetInt(ControllerUtils::encodeParamId(AppAmphur::$tableName));
        if(AppUtils::isEmpty($id)) {
            ControllerUtils::f404Static();
        }
        $appAmphur = $this->appAmphurService->findById($id);
        if(!$appAmphur){
            ControllerUtils::f404Static();
        }
        $effectRow = $this->appAmphurService->deleteById($id);
        //ControllerUtils::setSuccessMessage('Delete state = '.$effectRow);
        //v_rediect('appamphurlist');
    }

    /* Ajax */
    public function onChangeAmphurByProvince(){
        $provinceId = FilterUtil::validatePostInt(ControllerUtils::encodeParamId(AppProvince::getTableName()));
        if(AppUtils::isEmpty($provinceId)) {
            echoln('Error 404 ');
        }else{
            $appAmphurList = $this->appAmphurService->findAmphurByProvinceList($provinceId);
            if($appAmphurList){
//                echo "<option value=\"empty\">&nbsp;</option>\n";
                foreach($appAmphurList as $appAmphur){
                    echo " <option value=\"".$appAmphur->getId()."\">".$appAmphur->getName()."</option>";
                }
            }


//            echo "<script type=\"text/javascript\"> \n";
//            echo "    $(document).ready(function() {\n";
//            echo " $(\"#app_amphur_select option[value='empty']\").prop('selected', true); \n";
//            echo "    }); \n";
//            echo "</script> \n";

        }
    }

}