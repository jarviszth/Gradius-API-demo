<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\BatchUserServiceInterface as BatchUserServiceInterface;
use application\model\BatchUser as BatchUser;
class BatchUserService extends DatabaseSupport implements BatchUserServiceInterface
{
    protected $tableName = 'batch_user';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAllByBatch($perpage=0, $q_parameter=array(), $batchId=0)
    {
        //if have param
        $data_bind_where = null;

        $query = "SELECT batch_user.id AS id ";
        $query .=",batch_user.batch AS batch ";
        $query .=",batch_user.account AS account ";
        $query .=",batch_user.user_name AS user_name ";
        $query .=",batch_user.password AS password ";
        $query .=",batch_user.start_date AS start_date ";
        $query .=",batch_user.expired_date AS expired_date ";
        $query .=",batch_user.status AS status ";
        $query .=",batch_user.rate_limit AS rate_limit ";
        $query .=",batch_user.created_user AS created_user ";
        $query .=",batch_user.created_date AS created_date ";
        $query .=",batch_user.updated_user AS updated_user ";
        $query .=",batch_user.updated_date AS updated_date ";

        $query .="FROM batch_user AS batch_user ";

        //where query
        $query .=" WHERE batch_user.id IS NOT NULL ";
        if($batchId>0){
            $query .="AND batch_user.`batch`=:batch_id ";
            $data_bind_where['batch_id'] = (int)$batchId;
        }



        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_id']) && $q_parameter['q_id']!=''){
            //for query concat
            $query .=" AND batch_user.id LIKE :q_id  ";
            //for bind param
            $data_bind_where['q_id'] = "%".$q_parameter['q_id']."%";//bind param for like query
        }
        if(isset($q_parameter['q_batch']) && $q_parameter['q_batch']!=''){
            //for query concat
            $query .=" AND batch_user.batch LIKE :q_batch  ";
            //for bind param
            $data_bind_where['q_batch'] = "%".$q_parameter['q_batch']."%";//bind param for like query
        }
        if(isset($q_parameter['q_account']) && $q_parameter['q_account']!=''){
            //for query concat
            $query .=" AND batch_user.account LIKE :q_account  ";
            //for bind param
            $data_bind_where['q_account'] = "%".$q_parameter['q_account']."%";//bind param for like query
        }
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!=''){
            //for query concat
            $query .=" AND batch_user.user_name LIKE :q_user_name  ";
            //for bind param
            $data_bind_where['q_user_name'] = "%".$q_parameter['q_user_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_password']) && $q_parameter['q_password']!=''){
            //for query concat
            $query .=" AND batch_user.password LIKE :q_password  ";
            //for bind param
            $data_bind_where['q_password'] = "%".$q_parameter['q_password']."%";//bind param for like query
        }
        if(isset($q_parameter['q_start_date']) && $q_parameter['q_start_date']!=''){
            //for query concat
            $query .=" AND batch_user.start_date LIKE :q_start_date  ";
            //for bind param
            $data_bind_where['q_start_date'] = "%".$q_parameter['q_start_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_expired_date']) && $q_parameter['q_expired_date']!=''){
            //for query concat
            $query .=" AND batch_user.expired_date LIKE :q_expired_date  ";
            //for bind param
            $data_bind_where['q_expired_date'] = "%".$q_parameter['q_expired_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_status']) && $q_parameter['q_status']!=''){
            //for query concat
            $query .=" AND batch_user.status LIKE :q_status  ";
            //for bind param
            $data_bind_where['q_status'] = "%".$q_parameter['q_status']."%";//bind param for like query
        }
        if(isset($q_parameter['q_rate_limit']) && $q_parameter['q_rate_limit']!=''){
            //for query concat
            $query .=" AND batch_user.rate_limit LIKE :q_rate_limit  ";
            //for bind param
            $data_bind_where['q_rate_limit'] = "%".$q_parameter['q_rate_limit']."%";//bind param for like query
        }
        if(isset($q_parameter['q_created_user']) && $q_parameter['q_created_user']!=''){
            //for query concat
            $query .=" AND batch_user.created_user LIKE :q_created_user  ";
            //for bind param
            $data_bind_where['q_created_user'] = "%".$q_parameter['q_created_user']."%";//bind param for like query
        }
        if(isset($q_parameter['q_created_date']) && $q_parameter['q_created_date']!=''){
            //for query concat
            $query .=" AND batch_user.created_date LIKE :q_created_date  ";
            //for bind param
            $data_bind_where['q_created_date'] = "%".$q_parameter['q_created_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_updated_user']) && $q_parameter['q_updated_user']!=''){
            //for query concat
            $query .=" AND batch_user.updated_user LIKE :q_updated_user  ";
            //for bind param
            $data_bind_where['q_updated_user'] = "%".$q_parameter['q_updated_user']."%";//bind param for like query
        }
        if(isset($q_parameter['q_updated_date']) && $q_parameter['q_updated_date']!=''){
            //for query concat
            $query .=" AND batch_user.updated_date LIKE :q_updated_date  ";
            //for bind param
            $data_bind_where['q_updated_date'] = "%".$q_parameter['q_updated_date']."%";//bind param for like query
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER

        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){
            $query .=" ORDER BY batch_user.".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY batch_user.id ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " ASC ";
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
        if(isset($q_parameter['q_batch']) && $q_parameter['q_batch']!=''){
            $this->bind(":q_batch", "%".$q_parameter['q_batch']."%");
        }
        if(isset($q_parameter['q_account']) && $q_parameter['q_account']!=''){
            $this->bind(":q_account", "%".$q_parameter['q_account']."%");
        }
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!=''){
            $this->bind(":q_user_name", "%".$q_parameter['q_user_name']."%");
        }
        if(isset($q_parameter['q_password']) && $q_parameter['q_password']!=''){
            $this->bind(":q_password", "%".$q_parameter['q_password']."%");
        }
        if(isset($q_parameter['q_start_date']) && $q_parameter['q_start_date']!=''){
            $this->bind(":q_start_date", "%".$q_parameter['q_start_date']."%");
        }
        if(isset($q_parameter['q_expired_date']) && $q_parameter['q_expired_date']!=''){
            $this->bind(":q_expired_date", "%".$q_parameter['q_expired_date']."%");
        }
        if(isset($q_parameter['q_status']) && $q_parameter['q_status']!=''){
            $this->bind(":q_status", "%".$q_parameter['q_status']."%");
        }
        if(isset($q_parameter['q_rate_limit']) && $q_parameter['q_rate_limit']!=''){
            $this->bind(":q_rate_limit", "%".$q_parameter['q_rate_limit']."%");
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

        if($batchId>0) {
            $this->bind(":batch_id", (int)$batchId);
        }


        //END BIND VALUE FOR REGULAR QUERY
        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new BatchUser($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        //if have param
        $data_bind_where = null;

        $query = "SELECT batch_user.id AS id ";
        $query .=",batch_user.batch AS batch ";
        $query .=",batch_user.account AS account ";
        $query .=",batch_user.user_name AS user_name ";
        $query .=",batch_user.password AS password ";
        $query .=",batch_user.start_date AS start_date ";
        $query .=",batch_user.expired_date AS expired_date ";
        $query .=",batch_user.status AS status ";
        $query .=",batch_user.rate_limit AS rate_limit ";
        $query .=",batch_user.created_user AS created_user ";
        $query .=",batch_user.created_date AS created_date ";
        $query .=",batch_user.updated_user AS updated_user ";
        $query .=",batch_user.updated_date AS updated_date ";

        $query .="FROM batch_user AS batch_user ";

		//where query
        $query .=" WHERE batch_user.id IS NOT NULL ";
        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_id']) && $q_parameter['q_id']!=''){
            //for query concat
            $query .=" AND batch_user.id LIKE :q_id  ";
            //for bind param
            $data_bind_where['q_id'] = "%".$q_parameter['q_id']."%";//bind param for like query
        }
        if(isset($q_parameter['q_batch']) && $q_parameter['q_batch']!=''){
            //for query concat
            $query .=" AND batch_user.batch LIKE :q_batch  ";
            //for bind param
            $data_bind_where['q_batch'] = "%".$q_parameter['q_batch']."%";//bind param for like query
        }
        if(isset($q_parameter['q_account']) && $q_parameter['q_account']!=''){
            //for query concat
            $query .=" AND batch_user.account LIKE :q_account  ";
            //for bind param
            $data_bind_where['q_account'] = "%".$q_parameter['q_account']."%";//bind param for like query
        }
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!=''){
            //for query concat
            $query .=" AND batch_user.user_name LIKE :q_user_name  ";
            //for bind param
            $data_bind_where['q_user_name'] = "%".$q_parameter['q_user_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_password']) && $q_parameter['q_password']!=''){
            //for query concat
            $query .=" AND batch_user.password LIKE :q_password  ";
            //for bind param
            $data_bind_where['q_password'] = "%".$q_parameter['q_password']."%";//bind param for like query
        }
        if(isset($q_parameter['q_start_date']) && $q_parameter['q_start_date']!=''){
            //for query concat
            $query .=" AND batch_user.start_date LIKE :q_start_date  ";
            //for bind param
            $data_bind_where['q_start_date'] = "%".$q_parameter['q_start_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_expired_date']) && $q_parameter['q_expired_date']!=''){
            //for query concat
            $query .=" AND batch_user.expired_date LIKE :q_expired_date  ";
            //for bind param
            $data_bind_where['q_expired_date'] = "%".$q_parameter['q_expired_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_status']) && $q_parameter['q_status']!=''){
            //for query concat
            $query .=" AND batch_user.status LIKE :q_status  ";
            //for bind param
            $data_bind_where['q_status'] = "%".$q_parameter['q_status']."%";//bind param for like query
        }
        if(isset($q_parameter['q_rate_limit']) && $q_parameter['q_rate_limit']!=''){
            //for query concat
            $query .=" AND batch_user.rate_limit LIKE :q_rate_limit  ";
            //for bind param
            $data_bind_where['q_rate_limit'] = "%".$q_parameter['q_rate_limit']."%";//bind param for like query
        }
        if(isset($q_parameter['q_created_user']) && $q_parameter['q_created_user']!=''){
            //for query concat
            $query .=" AND batch_user.created_user LIKE :q_created_user  ";
            //for bind param
            $data_bind_where['q_created_user'] = "%".$q_parameter['q_created_user']."%";//bind param for like query
        }
        if(isset($q_parameter['q_created_date']) && $q_parameter['q_created_date']!=''){
            //for query concat
            $query .=" AND batch_user.created_date LIKE :q_created_date  ";
            //for bind param
            $data_bind_where['q_created_date'] = "%".$q_parameter['q_created_date']."%";//bind param for like query
        }
        if(isset($q_parameter['q_updated_user']) && $q_parameter['q_updated_user']!=''){
            //for query concat
            $query .=" AND batch_user.updated_user LIKE :q_updated_user  ";
            //for bind param
            $data_bind_where['q_updated_user'] = "%".$q_parameter['q_updated_user']."%";//bind param for like query
        }
        if(isset($q_parameter['q_updated_date']) && $q_parameter['q_updated_date']!=''){
            //for query concat
            $query .=" AND batch_user.updated_date LIKE :q_updated_date  ";
            //for bind param
            $data_bind_where['q_updated_date'] = "%".$q_parameter['q_updated_date']."%";//bind param for like query
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER

        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){
                $query .=" ORDER BY batch_user.".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY batch_user.id ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " ASC ";
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
        if(isset($q_parameter['q_batch']) && $q_parameter['q_batch']!=''){
            $this->bind(":q_batch", "%".$q_parameter['q_batch']."%");
        }
        if(isset($q_parameter['q_account']) && $q_parameter['q_account']!=''){
            $this->bind(":q_account", "%".$q_parameter['q_account']."%");
        }
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!=''){
            $this->bind(":q_user_name", "%".$q_parameter['q_user_name']."%");
        }
        if(isset($q_parameter['q_password']) && $q_parameter['q_password']!=''){
            $this->bind(":q_password", "%".$q_parameter['q_password']."%");
        }
        if(isset($q_parameter['q_start_date']) && $q_parameter['q_start_date']!=''){
            $this->bind(":q_start_date", "%".$q_parameter['q_start_date']."%");
        }
        if(isset($q_parameter['q_expired_date']) && $q_parameter['q_expired_date']!=''){
            $this->bind(":q_expired_date", "%".$q_parameter['q_expired_date']."%");
        }
        if(isset($q_parameter['q_status']) && $q_parameter['q_status']!=''){
            $this->bind(":q_status", "%".$q_parameter['q_status']."%");
        }
        if(isset($q_parameter['q_rate_limit']) && $q_parameter['q_rate_limit']!=''){
            $this->bind(":q_rate_limit", "%".$q_parameter['q_rate_limit']."%");
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
                $singleObj = new BatchUser($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT batch_user.id AS id ";
        $query .=",batch_user.batch AS batch ";
        $query .=",batch_user.account AS account ";
        $query .=",batch_user.user_name AS user_name ";
        $query .=",batch_user.password AS password ";
        $query .=",batch_user.start_date AS start_date ";
        $query .=",batch_user.expired_date AS expired_date ";
        $query .=",batch_user.status AS status ";
        $query .=",batch_user.rate_limit AS rate_limit ";
        $query .=",batch_user.created_user AS created_user ";
        $query .=",batch_user.created_date AS created_date ";
        $query .=",batch_user.updated_user AS updated_user ";
        $query .=",batch_user.updated_date AS updated_date ";

        $query .="FROM batch_user AS batch_user ";
        $query .="WHERE batch_user.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $batchUser = new BatchUser($result);
            return $batchUser;
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