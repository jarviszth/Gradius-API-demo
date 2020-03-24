<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\AppDistrictServiceInterface as AppDistrictServiceInterface;
use application\model\AppDistrict as AppDistrict;
class AppDistrictService extends DatabaseSupport implements AppDistrictServiceInterface
{
    protected $tableName = 'app_district';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT app_district.id AS id ";
        $query .=",app_district.code AS code ";
        $query .=",app_district.name AS name ";
        $query .=",app_district.app_amphur AS app_amphur ";
        $query .=",app_district.zipcode AS zipcode ";
        $query .=",app_district.created_user AS created_user ";
        $query .=",app_district.created_date AS created_date ";
        $query .=",app_district.updated_user AS updated_user ";
        $query .=",app_district.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_amphur.name AS app_amphur_name ";
        $query .=",app_amphur.name_eng AS app_amphur_name_eng ";
        $query .=",app_amphur.app_province AS app_province ";

        $query .="FROM app_district AS app_district ";
        $query .="LEFT JOIN app_amphur AS app_amphur ";
        $query .="ON app_district.app_amphur = app_amphur.id ";

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
                $singleObj = new AppDistrict($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT app_district.id AS id ";
        $query .=",app_district.code AS code ";
        $query .=",app_district.name AS name ";
        $query .=",app_district.app_amphur AS app_amphur ";
        $query .=",app_district.zipcode AS zipcode ";
        $query .=",app_district.created_user AS created_user ";
        $query .=",app_district.created_date AS created_date ";
        $query .=",app_district.updated_user AS updated_user ";
        $query .=",app_district.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_amphur.name AS app_amphur_name ";
        $query .=",app_amphur.name_eng AS app_amphur_name_eng ";
        $query .=",app_amphur.app_province AS app_province ";

        $query .="FROM app_district AS app_district ";
        $query .="LEFT JOIN app_amphur AS app_amphur ";
        $query .="ON app_district.app_amphur = app_amphur.id ";

        $query .="WHERE app_district.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $appDistrict = new AppDistrict($result);
            return $appDistrict;
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

    public function findDistrictListByAmphur($amphurId)
    {
        $query = "SELECT app_district.id AS id ";
        $query .=",app_district.code AS code ";
        $query .=",app_district.name AS name ";
        $query .=",app_district.app_amphur AS app_amphur ";
        $query .=",app_district.zipcode AS zipcode ";
        $query .=",app_district.created_user AS created_user ";
        $query .=",app_district.created_date AS created_date ";
        $query .=",app_district.updated_user AS updated_user ";
        $query .=",app_district.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_amphur.name AS app_amphur_name ";
        $query .=",app_amphur.name_eng AS app_amphur_name_eng ";
        $query .=",app_amphur.app_province AS app_province ";

        $query .="FROM app_district AS app_district ";
        $query .="LEFT JOIN app_amphur AS app_amphur ";
        $query .="ON app_district.app_amphur = app_amphur.id ";

        $query .="WHERE app_district.app_amphur=:amphurId ";

        $this->query($query);
        $this->bind(":amphurId", $amphurId);
        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new AppDistrict($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }
}