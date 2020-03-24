<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
/**
 * Created by Bekaku Php Back End System.
 * Date: 2020-03-23 07:22:21
 */

namespace application\controller;

use application\core\AppController;
use application\util\FilterUtils;
use application\util\i18next;
use application\util\SystemConstant;
use application\util\SecurityUtil;

use application\model\Radgroupcheck;
use application\service\RadgroupcheckService ;
class RadgroupcheckController extends  AppController
{
    /**
    * @var RadgroupcheckService
    */
    private $radgroupcheckService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->radgroupcheckService = new RadgroupcheckService($this->getDbConn());
        $this->isAuthRequired = false;

    }
    public function __destruct()
    {
        $this->setDbConn(null);
        unset($this->radgroupcheckService);
    }
    public function crudList()
    {
        $perPage = FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) > 0 ? FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) : 0;
        $this->setRowPerPage($perPage);
        $q_parameter = $this->initSearchParam(new Radgroupcheck());

        $this->pushDataToView = $this->getDefaultResponse();
        $this->pushDataToView[SystemConstant::DATA_LIST_ATT] = $this->radgroupcheckService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView[SystemConstant::APP_PAGINATION_ATT] = $this->radgroupcheckService->getTotalPaging();
        $this->jsonResponse($this->pushDataToView);
    }
    public function crudAdd()
    {
        // $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $uid = 1;
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);

        if(!empty($jsonData) && !empty($uid)) {
           $entity = new Radgroupcheck();
           $entity->populatePostDataRestApi($jsonData, $uid, false);
           $lastInsertId = $this->radgroupcheckService->createByObject($entity);
           if ($lastInsertId) {
               $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, true, i18next::getTranslation(('success.insert_succesfull')));
           }
         }
        $this->jsonResponse($this->pushDataToView);

    }
    public function crudReadSingle()
    {
        $id = FilterUtils::filterGetInt(SystemConstant::ID_PARAM);
        $this->pushDataToView = $this->getDefaultResponse(false);
        $item = null;
        if ($id > 0) {
            $item = $this->radgroupcheckService->findById($id);
            if ($item) {
                $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, true, "");
            }
        }
        $this->pushDataToView[SystemConstant::ENTITY_ATT] = $item;
        $this->jsonResponse($this->pushDataToView);
    }
    public function crudEdit()
    {
        // $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $uid = 1;
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);
		
        if(!empty($jsonData) && !empty($uid)) {
            $entity = new Radgroupcheck();
            $entity->populatePostDataRestApi($jsonData, $uid, true);
           if ($entity->getId() > 0) {
               $effectRow = $this->radgroupcheckService->updateByObject($entity, array('id' => $entity->getId()));
               if ($effectRow) {
                   $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, true, i18next::getTranslation(('success.update_succesfull')));
               }
           }
       }
        $this->jsonResponse($this->pushDataToView);
    }
    public function crudDelete()
    {
        $this->pushDataToView = $this->getDefaultResponse(true);
        $idParams = FilterUtils::filterGetString(SystemConstant::ID_PARAMS);//paramiter format : idOfNo1_idOfNo2_idOfNo3_idOfNo4 ...
        $idArray = explode(SystemConstant::UNDER_SCORE, $idParams);
        if (count($idArray) > 0) {
            foreach ($idArray AS $id) {
                $entity = $this->radgroupcheckService->findById($id);
                if ($entity) {
                    $effectRow = $this->radgroupcheckService->deleteById($id);
                    if (!$effectRow) {
                        $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, false, i18next::getTranslation('error.error_something_wrong'));
                        break;
                    }
                }
            }
        }
        $this->jsonResponse($this->pushDataToView);
    }

}