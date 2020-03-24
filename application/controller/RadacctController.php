<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
/**
 * Created by Bekaku Php Back End System.
 * Date: 2020-03-24 02:40:17
 */

namespace application\controller;

use application\core\AppController;
use application\util\FilterUtils;
use application\util\i18next;
use application\util\SystemConstant;
use application\util\SecurityUtil;

use application\model\Radacct;
use application\service\RadacctService ;
class RadacctController extends  AppController
{
    /**
    * @var RadacctService
    */
    private $radacctService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->radacctService = new RadacctService($this->getDbConn());
        $this->isAuthRequired = false;

    }
    public function __destruct()
    {
        $this->setDbConn(null);
        unset($this->radacctService);
    }
    public function crudList()
    {
        $perPage = FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) > 0 ? FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) : 0;
        $this->setRowPerPage($perPage);
        $q_parameter = $this->initSearchParam(new Radacct());

        $this->pushDataToView = $this->getDefaultResponse();
        $this->pushDataToView[SystemConstant::DATA_LIST_ATT] = $this->radacctService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView[SystemConstant::APP_PAGINATION_ATT] = $this->radacctService->getTotalPaging();
        $this->jsonResponse($this->pushDataToView);
    }
    public function crudAdd()
    {
        // $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $uid = 1;      
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);

        if(!empty($jsonData) && !empty($uid)) {
           $entity = new Radacct();
           $entity->populatePostDataRestApi($jsonData, $uid, false);
           $lastInsertId = $this->radacctService->createByObject($entity);
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
            $item = $this->radacctService->findById($id);
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
            $entity = new Radacct();
            $entity->populatePostDataRestApi($jsonData, $uid, true);
           if ($entity->getId() > 0) {
               $effectRow = $this->radacctService->updateByObject($entity, array('id' => $entity->getId()));
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
                $entity = $this->radacctService->findById($id);
                if ($entity) {
                    $effectRow = $this->radacctService->deleteById($id);
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