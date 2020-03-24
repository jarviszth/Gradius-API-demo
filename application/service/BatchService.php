<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\BatchServiceInterface as BatchServiceInterface;
use application\model\Batch as Batch;
class BatchService extends DatabaseSupport implements BatchServiceInterface
{
    protected $tableName = 'batch';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        //if have param
        $data_bind_where = null;

        $query = "SELECT batch.id AS id ";
        $query .=",batch.batch_name AS batch_name ";
        $query .=",batch.descriptions AS descriptions ";
        $query .=",batch.volume AS volume ";
        $query .=",batch.create_date AS create_date ";
        $query .=",batch.active AS active ";
        $query .=",batch.radusergroup_detail AS radusergroup_detail ";
        $query .=",batch.created_user AS created_user ";
        $query .=",batch.created_date AS created_date ";
        $query .=",batch.updated_user AS updated_user ";
        $query .=",batch.updated_date AS updated_date ";

        $query .="FROM batch AS batch ";

		//where query
        $query .=" WHERE batch.id IS NOT NULL ";
        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_id']) && $q_parameter['q_id']!=''){
            //for query concat
            $query .=" AND batch.id LIKE :q_id  ";
            //for bind param
            $data_bind_where['q_id'] = "%".$q_parameter['q_id']."%";//bind param for like query
        }
        if(isset($q_parameter['q_batch_name']) && $q_parameter['q_batch_name']!=''){
            //for query concat
            $query .=" AND batch.batch_name LIKE :q_batch_name  ";
            //for bind param
            $data_bind_where['q_batch_name'] = "%".$q_parameter['q_batch_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_descriptions']) && $q_parameter['q_descriptions']!=''){
            //for query concat
            $query .=" AND batch.descriptions LIKE :q_descriptions  ";
            //for bind param
            $data_bind_where['q_descriptions'] = "%".$q_parameter['q_descriptions']."%";//bind param for like query
        }
        if(isset($q_parameter['q_volume']) && $q_parameter['q_volume']!=''){
            //for query concat
            $query .=" AND batch.volume LIKE :q_volume  ";
            //for bind param
            $data_bind_where['q_volume'] = "%".$q_parameter['q_volume']."%";//bind param for like query
        }
        if(isset($q_parameter['q_create_date']) && $q_parameter['q_create_date']!=''){
            //for query concat
            $query .=" AND batch.create_date LIKE :q_create_date  ";
            //for bind param
            $data_bind_where['q_create_date'] = "%".$q_parameter['q_create_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_active']) && $q_parameter['q_active']!=''){
            //for query concat
            $query .=" AND batch.active LIKE :q_active  ";
            //for bind param
            $data_bind_where['q_active'] = "%".$q_parameter['q_active']."%";//bind param for like query
        }
        if(isset($q_parameter['q_radusergroup_detail']) && $q_parameter['q_radusergroup_detail']!=''){
            //for query concat
            $query .=" AND batch.radusergroup_detail LIKE :q_radusergroup_detail  ";
            //for bind param
            $data_bind_where['q_radusergroup_detail'] = "%".$q_parameter['q_radusergroup_detail']."%";//bind param for like query
        }
        if(isset($q_parameter['q_created_user']) && $q_parameter['q_created_user']!=''){
            //for query concat
            $query .=" AND batch.created_user LIKE :q_created_user  ";
            //for bind param
            $data_bind_where['q_created_user'] = "%".$q_parameter['q_created_user']."%";//bind param for like query
        }
        if(isset($q_parameter['q_created_date']) && $q_parameter['q_created_date']!=''){
            //for query concat
            $query .=" AND batch.created_date LIKE :q_created_date  ";
            //for bind param
            $data_bind_where['q_created_date'] = "%".$q_parameter['q_created_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_updated_user']) && $q_parameter['q_updated_user']!=''){
            //for query concat
            $query .=" AND batch.updated_user LIKE :q_updated_user  ";
            //for bind param
            $data_bind_where['q_updated_user'] = "%".$q_parameter['q_updated_user']."%";//bind param for like query
        }
        if(isset($q_parameter['q_updated_date']) && $q_parameter['q_updated_date']!=''){
            //for query concat
            $query .=" AND batch.updated_date LIKE :q_updated_date  ";
            //for bind param
            $data_bind_where['q_updated_date'] = "%".$q_parameter['q_updated_date']."%";//bind param for like query
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER

        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){
                $query .=" ORDER BY batch.".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY batch.id ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " DESC ";
        }
        // END SORT ORDER

        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query, $perpage, $data_bind_where);
        }
        //regular query
        $this->query($query);
        //START BIND VALUE FOR REGULAR QUERY
        //$this->bind(":q_name", "%".$q_parameter['q_name']."%");//bind param for 'LIKE'
	     //$this->bind(":q_name", $q_parameter['q_name']);//bind param for '='
        if(isset($q_parameter['q_id']) && $q_parameter['q_id']!=''){
            $this->bind(":q_id", "%".$q_parameter['q_id']."%");
        }
        if(isset($q_parameter['q_batch_name']) && $q_parameter['q_batch_name']!=''){
            $this->bind(":q_batch_name", "%".$q_parameter['q_batch_name']."%");
        }
        if(isset($q_parameter['q_descriptions']) && $q_parameter['q_descriptions']!=''){
            $this->bind(":q_descriptions", "%".$q_parameter['q_descriptions']."%");
        }
        if(isset($q_parameter['q_volume']) && $q_parameter['q_volume']!=''){
            $this->bind(":q_volume", "%".$q_parameter['q_volume']."%");
        }
        if(isset($q_parameter['q_create_date']) && $q_parameter['q_create_date']!=''){
            $this->bind(":q_create_date", "%".$q_parameter['q_create_date']."%");
        }
        if(isset($q_parameter['q_active']) && $q_parameter['q_active']!=''){
            $this->bind(":q_active", "%".$q_parameter['q_active']."%");
        }
        if(isset($q_parameter['q_radusergroup_detail']) && $q_parameter['q_radusergroup_detail']!=''){
            $this->bind(":q_radusergroup_detail", "%".$q_parameter['q_radusergroup_detail']."%");
        }
        if(isset($q_parameter['q_created_user']) && $q_parameter['q_created_user']!=''){
            $this->bind(":q_created_user", "%".$q_parameter['q_created_user']."%");
        }
        if(isset($q_parameter['q_created_date']) && $q_parameter['q_created_date']!=''){
            $this->bind(":q_created_date", "%".$q_parameter['q_created_date']."%");
        }
        if(isset($q_parameter['q_updated_user']) && $q_parameter['q_updated_user']!=''){
            $this->bind(":q_updated_user", "%".$q_parameter['q_updated_user']."%");
        }
        if(isset($q_parameter['q_updated_date']) && $q_parameter['q_updated_date']!=''){
            $this->bind(":q_updated_date", "%".$q_parameter['q_updated_date']."%");
        }
        //END BIND VALUE FOR REGULAR QUERY
        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new Batch($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT batch.id AS id ";
        $query .=",batch.batch_name AS batch_name ";
        $query .=",batch.descriptions AS descriptions ";
        $query .=",batch.volume AS volume ";
        $query .=",batch.create_date AS create_date ";
        $query .=",batch.active AS active ";
        $query .=",batch.radusergroup_detail AS radusergroup_detail ";
        $query .=",batch.created_user AS created_user ";
        $query .=",batch.created_date AS created_date ";
        $query .=",batch.updated_user AS updated_user ";
        $query .=",batch.updated_date AS updated_date ";

        $query .="FROM batch AS batch ";
        $query .="WHERE batch.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $batch = new Batch($result);
            return $batch;
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