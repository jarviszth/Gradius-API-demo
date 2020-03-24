<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\AppProvinceServiceInterface as AppProvinceServiceInterface;
use application\model\AppProvince as AppProvince;
class AppProvinceService extends DatabaseSupport implements AppProvinceServiceInterface
{
    protected $tableName = 'app_province';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
//        $query = "SELECT * FROM ".$this->tableName;
        $query = "SELECT app_province.id AS id ";
        $query .=",app_province.code AS code ";
        $query .=",app_province.name AS name ";
        $query .=",app_province.name_eng AS name_eng ";
        $query .=",app_province.app_geography AS app_geography ";
        $query .=",app_province.created_user AS created_user ";
        $query .=",app_province.created_date AS created_date ";
        $query .=",app_province.updated_user AS updated_user ";
        $query .=",app_province.updated_date AS updated_date ";
        /*optional field*/
        $query .=",app_geography.name AS app_geography_name ";
        $query .=",app_geography.name_eng AS app_geography_name_eng ";

        $query .="FROM app_province AS app_province ";

        $query .="LEFT JOIN app_geography AS app_geography ";
        $query .="ON app_province.app_geography = app_geography.id ";
        $query .="ORDER BY app_province.name ASC ";


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
                $singleObj = new AppProvince($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
       // $query = "SELECT * FROM ".$this->tableName." WHERE id=:id";
        $query = "SELECT app_province.id AS id ";
        $query .=",app_province.code AS code ";
        $query .=",app_province.name AS name ";
        $query .=",app_province.name_eng AS name_eng ";
        $query .=",app_province.app_geography AS app_geography ";
        $query .=",app_province.created_user AS created_user ";
        $query .=",app_province.created_date AS created_date ";
        $query .=",app_province.updated_user AS updated_user ";
        $query .=",app_province.updated_date AS updated_date ";

        /*optional field*/
        $query .=",app_geography.name AS app_geography_name ";
        $query .=",app_geography.name_eng AS app_geography_name_eng ";

        $query .="FROM app_province AS app_province ";

        $query .="LEFT JOIN app_geography AS app_geography ";
        $query .="ON app_province.app_geography = app_geography.id ";

        $query .="WHERE app_province.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $appProvince = new AppProvince($result);
            return $appProvince;
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

}