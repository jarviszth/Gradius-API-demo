<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\CnfRadiusServiceInterface as CnfRadiusServiceInterface;
use application\model\CnfRadius as CnfRadius;
class CnfRadiusService extends DatabaseSupport implements CnfRadiusServiceInterface
{
    protected $tableName = 'cnf_radius';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT cnf_radius.id AS id ";
        $query .=",cnf_radius.ip_radius AS ip_radius ";
        $query .=",cnf_radius.secrete_redius AS secrete_redius ";

        $query .="FROM cnf_radius AS cnf_radius ";

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
                $singleObj = new CnfRadius($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT cnf_radius.id AS id ";
        $query .=",cnf_radius.ip_radius AS ip_radius ";
        $query .=",cnf_radius.secrete_redius AS secrete_redius ";

        $query .="FROM cnf_radius AS cnf_radius ";
        $query .="WHERE cnf_radius.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $cnfRadius = new CnfRadius($result);
            return $cnfRadius;
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