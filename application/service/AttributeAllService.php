<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\AttributeAllServiceInterface as AttributeAllServiceInterface;
use application\model\AttributeAll as AttributeAll;
class AttributeAllService extends DatabaseSupport implements AttributeAllServiceInterface
{
    protected $tableName = 'attribute_all';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT attribute_all.id AS id ";
        $query .=",attribute_all.`attribute` AS `attribute` ";
        $query .=",attribute_all.df_value AS df_value ";
        $query .=",attribute_all.attribute_name AS attribute_name ";
        $query .=",attribute_all.type_value AS type_value ";
        $query .=",attribute_all.type_checkreply AS type_checkreply ";
        $query .=",attribute_all.created_user AS created_user ";
        $query .=",attribute_all.created_date AS created_date ";
        $query .=",attribute_all.updated_user AS updated_user ";
        $query .=",attribute_all.updated_date AS updated_date ";

        $query .="FROM attribute_all AS attribute_all ";

        $data_bind_where = null;
        //where query
        $query .=" WHERE attribute_all.id IS NOT NULL ";
        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_attribute']) && $q_parameter['q_attribute']!=''){
            //for query concat
            $query .=" AND attribute LIKE :q_attribute  ";
            //for bind param
            $data_bind_where['q_attribute'] = "%".$q_parameter['q_attribute']."%";//bind param for like query
        }
        if(isset($q_parameter['q_attribute_name']) && $q_parameter['q_attribute_name']!=''){
            //for query concat
            $query .=" AND attribute_name LIKE :q_attribute_name  ";
            //for bind param
            $data_bind_where['q_attribute_name'] = "%".$q_parameter['q_attribute_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_type_value']) && $q_parameter['q_type_value']!=''){
            //for query concat
            $query .=" AND type_value LIKE :q_type_value  ";
            //for bind param
            $data_bind_where['q_type_value'] = "%".$q_parameter['q_type_value']."%";//bind param for like query
        }
        if(isset($q_parameter['q_type_checkreply']) && $q_parameter['q_type_checkreply']!=''){
            //for query concat
            $query .=" AND type_checkreply LIKE :q_type_checkreply  ";
            //for bind param
            $data_bind_where['q_type_checkreply'] = "%".$q_parameter['q_type_checkreply']."%";//bind param for like query
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER

        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){

            if($q_parameter['sortField']=='attributessssss'){
                $query .=" ORDER BY `attribute` ";
            }else{
                $query .=" ORDER BY `".$q_parameter['sortField']."` ";
            }

//            $query .=" ORDER BY `".$q_parameter['sortField']."` ";
        }else{
            $query .= " ORDER BY  attribute_all.type_checkreply ";
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
        if(isset($q_parameter['q_attribute']) && $q_parameter['q_attribute']!='') {
            $this->bind(":q_attribute", "%".$q_parameter['q_attribute']."%");//bind param for like query
        }
        if(isset($q_parameter['q_attribute_name']) && $q_parameter['q_attribute_name']!='') {
            $this->bind(":q_attribute_name", "%".$q_parameter['q_attribute_name']."%");//bind param for like query
        }
        if(isset($q_parameter['q_type_value']) && $q_parameter['q_type_value']!='') {
            $this->bind(":q_type_value", "%".$q_parameter['q_type_value']."%");//bind param for like query
        }
        if(isset($q_parameter['q_type_checkreply']) && $q_parameter['q_type_checkreply']!='') {
            $this->bind(":q_type_checkreply", "%".$q_parameter['q_type_checkreply']."%");//bind param for like query
        }
        //END BIND VALUE FOR REGULAR QUERY



        $resaultList =  $this->resultset();
        if(count($resaultList)>0){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new AttributeAll($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT attribute_all.id AS id ";
        $query .=",attribute_all.attribute AS attribute ";
        $query .=",attribute_all.df_value AS df_value ";
        $query .=",attribute_all.attribute_name AS attribute_name ";
        $query .=",attribute_all.type_value AS type_value ";
        $query .=",attribute_all.type_checkreply AS type_checkreply ";
        $query .=",attribute_all.created_user AS created_user ";
        $query .=",attribute_all.created_date AS created_date ";
        $query .=",attribute_all.updated_user AS updated_user ";
        $query .=",attribute_all.updated_date AS updated_date ";

        $query .="FROM attribute_all AS attribute_all ";
        $query .="WHERE attribute_all.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $attributeAll = new AttributeAll($result);
            return $attributeAll;
        }
        return false;
    }
    public function findByAttributeName($attName)
    {
        $query = "SELECT attribute_all.id AS id ";
        $query .=",attribute_all.attribute AS attribute ";
        $query .=",attribute_all.df_value AS df_value ";
        $query .=",attribute_all.attribute_name AS attribute_name ";
        $query .=",attribute_all.type_value AS type_value ";
        $query .=",attribute_all.type_checkreply AS type_checkreply ";
        $query .=",attribute_all.created_user AS created_user ";
        $query .=",attribute_all.created_date AS created_date ";
        $query .=",attribute_all.updated_user AS updated_user ";
        $query .=",attribute_all.updated_date AS updated_date ";

        $query .="FROM attribute_all AS attribute_all ";
        $query .="WHERE attribute_all.attribute=:att ";

        $this->query($query);
        $this->bind(":att", $attName);
        $result =  $this->single();
        if($result){
            $attributeAll = new AttributeAll($result);
            return $attributeAll;
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