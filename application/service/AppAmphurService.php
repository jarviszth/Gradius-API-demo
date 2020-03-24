<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\AppAmphurServiceInterface as AppAmphurServiceInterface;
use application\model\AppAmphur as AppAmphur;
class AppAmphurService extends DatabaseSupport implements AppAmphurServiceInterface
{
    protected $tableName = 'app_amphur';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT app_amphur.id AS id ";
        $query .=",app_amphur.code AS code ";
        $query .=",app_amphur.name AS name ";
        $query .=",app_amphur.name_eng AS name_eng ";
        $query .=",app_amphur.app_province AS app_province ";
        $query .=",app_amphur.created_user AS created_user ";
        $query .=",app_amphur.created_date AS created_date ";
        $query .=",app_amphur.updated_user AS updated_user ";
        $query .=",app_amphur.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_province.name AS app_province_name ";
        $query .=",app_province.name_eng AS app_province_name_eng ";

        $query .="FROM app_amphur AS app_amphur ";
        $query .="LEFT JOIN app_province AS app_province ";
        $query .="ON app_amphur.app_province = app_province.id ";

        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query,$perpage);
        }
        //regular query
        $this->query($query);
        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new AppAmphur($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT app_amphur.id AS id ";
        $query .=",app_amphur.code AS code ";
        $query .=",app_amphur.name AS name ";
        $query .=",app_amphur.name_eng AS name_eng ";
        $query .=",app_amphur.app_province AS app_province ";
        $query .=",app_amphur.created_user AS created_user ";
        $query .=",app_amphur.created_date AS created_date ";
        $query .=",app_amphur.updated_user AS updated_user ";
        $query .=",app_amphur.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_province.name AS app_province_name ";
        $query .=",app_province.name_eng AS app_province_name_eng ";

        $query .="FROM app_amphur AS app_amphur ";
        $query .="LEFT JOIN app_province AS app_province ";
        $query .="ON app_amphur.app_province = app_province.id ";

        $query .="WHERE app_amphur.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $appAmphur = new AppAmphur($result);
            return $appAmphur;
        }
        return false;
    }
    public function deleteById($id)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE id=:id";
        $this->query($query);
        $this->bind(":id", $id);
        return $this->execute();
    }
    public function createByArray($data_array)
    {
        return $this->insertHelper($this->tableName, $data_array);
    }
    public function createByObject($oject)
    {
        return $this->insertObjectHelper($oject);
    }
    public function update($data_array, $where_array, $whereType = 'AND')
    {
        return $this->updateHelper($this->tableName, $data_array, $where_array, $whereType);
    }
    public function updateByObject($object, $where_array, $whereType = 'AND')
    {
        return $this->updateObjectHelper($object, $where_array, $whereType);
    }
    public function findAmphurByProvinceList($provinveId)
    {
        $query = "SELECT app_amphur.id AS id ";
        $query .=",app_amphur.code AS code ";
        $query .=",app_amphur.name AS name ";
        $query .=",app_amphur.name_eng AS name_eng ";
        $query .=",app_amphur.app_province AS app_province ";
        $query .=",app_amphur.created_user AS created_user ";
        $query .=",app_amphur.created_date AS created_date ";
        $query .=",app_amphur.updated_user AS updated_user ";
        $query .=",app_amphur.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_province.name AS app_province_name ";
        $query .=",app_province.name_eng AS app_province_name_eng ";

        $query .="FROM app_amphur AS app_amphur ";
        $query .="LEFT JOIN app_province AS app_province ";
        $query .="ON app_amphur.app_province = app_province.id ";

        $query .="WHERE app_amphur.app_province=:provinceId ";

        $this->query($query);
        $this->bind(":provinceId", $provinveId);
        $resaultList =  $this->resultset();
        if($resaultList){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new AppAmphur($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }
}