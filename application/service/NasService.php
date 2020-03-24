<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\NasServiceInterface as NasServiceInterface;
use application\model\Nas as Nas;
class NasService extends DatabaseSupport implements NasServiceInterface
{
    protected $tableName = 'nas';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT nas.id AS id ";
        $query .=",nas.nasname AS nasname ";
        $query .=",nas.shortname AS shortname ";
        $query .=",nas.type AS type ";
        $query .=",nas.ports AS ports ";
        $query .=",nas.secret AS secret ";
        $query .=",nas.server AS server ";
        $query .=",nas.community AS community ";
        $query .=",nas.description AS description ";
        $query .=",nas.created_user AS created_user ";
        $query .=",nas.created_date AS created_date ";
        $query .=",nas.updated_user AS updated_user ";
        $query .=",nas.updated_date AS updated_date ";

        $query .="FROM nas AS nas ";

        $data_bind_where = null;
        //where query
        $query .=" WHERE nas.id IS NOT NULL ";
        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_nasname']) && $q_parameter['q_nasname']!=''){
            //for query concat
            $query .=" AND nas.nasname LIKE :q_nasname  ";
            //for bind param
            $data_bind_where['q_nasname'] = "%".$q_parameter['q_nasname']."%";//bind param for like query
        }
        if(isset($q_parameter['q_shortname']) && $q_parameter['q_shortname']!=''){
            //for query concat
            $query .=" AND nas.shortname LIKE :q_shortname  ";
            //for bind param
            $data_bind_where['q_shortname'] = "%".$q_parameter['q_shortname']."%";//bind param for like query
        }
        if(isset($q_parameter['q_type']) && $q_parameter['q_type']!=''){
            //for query concat
            $query .=" AND nas.type LIKE :q_type  ";
            //for bind param
            $data_bind_where['q_type'] = "%".$q_parameter['q_type']."%";//bind param for like query
        }
        if(isset($q_parameter['q_ports']) && $q_parameter['q_ports']!=''){
            //for query concat
            $query .=" AND nas.ports LIKE :q_ports  ";
            //for bind param
            $data_bind_where['q_ports'] = "%".$q_parameter['q_ports']."%";//bind param for like query
        }
        if(isset($q_parameter['q_description']) && $q_parameter['q_description']!=''){
            //for query concat
            $query .=" AND nas.description LIKE :q_description  ";
            //for bind param
            $data_bind_where['q_description'] = "%".$q_parameter['q_description']."%";//bind param for like query
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER




        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query,$perpage,$data_bind_where);
        }
        //regular query
        $this->query($query);

        //START BIND VALUE FOR REGULAR QUERY
        if(isset($q_parameter['q_nasname']) && $q_parameter['q_nasname']!='') {
            $this->bind(":q_nasname", "%".$q_parameter['q_nasname']."%");//bind param for like query
        }
        if(isset($q_parameter['q_shortname']) && $q_parameter['q_shortname']!='') {
            $this->bind(":q_shortname", "%".$q_parameter['q_shortname']."%");//bind param for like query
        }
        if(isset($q_parameter['q_type']) && $q_parameter['q_type']!='') {
            $this->bind(":q_type", "%".$q_parameter['q_type']."%");//bind param for like query
        }
        if(isset($q_parameter['q_ports']) && $q_parameter['q_ports']!='') {
            $this->bind(":q_ports", "%".$q_parameter['q_ports']."%");//bind param for like query
        }
        if(isset($q_parameter['q_description']) && $q_parameter['q_description']!='') {
            $this->bind(":q_description", "%".$q_parameter['q_description']."%");//bind param for like query
        }
        //END BIND VALUE FOR REGULAR QUERY


        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new Nas($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT nas.id AS id ";
        $query .=",nas.nasname AS nasname ";
        $query .=",nas.shortname AS shortname ";
        $query .=",nas.type AS type ";
        $query .=",nas.ports AS ports ";
        $query .=",nas.secret AS secret ";
        $query .=",nas.server AS server ";
        $query .=",nas.community AS community ";
        $query .=",nas.description AS description ";
        $query .=",nas.created_user AS created_user ";
        $query .=",nas.created_date AS created_date ";
        $query .=",nas.updated_user AS updated_user ";
        $query .=",nas.updated_date AS updated_date ";

        $query .="FROM nas AS nas ";
        $query .="WHERE nas.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $nas = new Nas($result);
            return $nas;
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