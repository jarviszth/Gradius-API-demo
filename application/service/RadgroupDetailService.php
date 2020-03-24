<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\RadgroupDetailServiceInterface as RadgroupDetailServiceInterface;
use application\model\RadgroupDetail as RadgroupDetail;
class RadgroupDetailService extends DatabaseSupport implements RadgroupDetailServiceInterface
{
    protected $tableName = 'radgroup_detail';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        
        $query = "SELECT radgroup_detail.id AS id ";
        $query .=",radgroup_detail.groupname AS groupname ";
        $query .=",radgroup_detail.group_detail AS group_detail ";
        $query .=",radgroup_detail.start_ip AS start_ip ";
        $query .=",radgroup_detail.end_id AS end_id ";
        $query .=",radgroup_detail.created_user AS created_user ";
        $query .=",radgroup_detail.created_date AS created_date ";
        $query .=",radgroup_detail.updated_user AS updated_user ";
        $query .=",radgroup_detail.updated_date AS updated_date ";

        $query .="FROM radgroup_detail AS radgroup_detail ";

        //where query
        $data_bind_where = null;
        $query .=" WHERE radgroup_detail.id IS NOT NULL ";
        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_groupname']) && $q_parameter['q_groupname']!=''){
            //for query concat
            $query .=" AND groupname LIKE :q_groupname  ";
            //for bind param
            $data_bind_where['q_groupname'] = "%".$q_parameter['q_groupname']."%";//bind param for like query
        }
        if(isset($q_parameter['q_group_detail']) && $q_parameter['q_group_detail']!=''){
            //for query concat
            $query .=" AND group_detail LIKE :q_group_detail  ";
            //for bind param
            $data_bind_where['q_group_detail'] = "%".$q_parameter['q_group_detail']."%";//bind param for like query
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER


        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){

            $query .=" ORDER BY ".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY id ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " ASC ";
        }
        // END SORT ORDER



        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query,$perpage,$data_bind_where);
        }
        //regular query
        $this->query($query);

        //START BIND VALUE FOR REGULAR QUERY
        if(isset($q_parameter['q_groupname']) && $q_parameter['q_groupname']!='') {
            $this->bind(":q_groupname", "%".$q_parameter['q_groupname']."%");//bind param for like query
        }
        if(isset($q_parameter['q_group_detail']) && $q_parameter['q_group_detail']!='') {
            $this->bind(":q_group_detail", "%".$q_parameter['q_group_detail']."%");//bind param for like query
        }
        //END BIND VALUE FOR REGULAR QUERY




        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new RadgroupDetail($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT radgroup_detail.id AS id ";
        $query .=",radgroup_detail.groupname AS groupname ";
        $query .=",radgroup_detail.group_detail AS group_detail ";
        $query .=",radgroup_detail.start_ip AS start_ip ";
        $query .=",radgroup_detail.end_id AS end_id ";
        $query .=",radgroup_detail.created_user AS created_user ";
        $query .=",radgroup_detail.created_date AS created_date ";
        $query .=",radgroup_detail.updated_user AS updated_user ";
        $query .=",radgroup_detail.updated_date AS updated_date ";

        $query .="FROM radgroup_detail AS radgroup_detail ";
        $query .="WHERE radgroup_detail.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $radgroupDetail = new RadgroupDetail($result);
            return $radgroupDetail;
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