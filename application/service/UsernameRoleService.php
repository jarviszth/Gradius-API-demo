<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\UsernameRoleServiceInterface as UsernameRoleServiceInterface;
use application\model\UsernameRole as UsernameRole;
class UsernameRoleService extends DatabaseSupport implements UsernameRoleServiceInterface
{
    protected $tableName = 'username_role';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT username_role.id AS id ";
        $query .=",username_role.name_lenght AS name_lenght ";
        $query .=",username_role.mix_no AS mix_no ";
        $query .=",username_role.special_char AS special_char ";
        $query .=",username_role.created_user AS created_user ";
        $query .=",username_role.created_date AS created_date ";
        $query .=",username_role.updated_user AS updated_user ";
        $query .=",username_role.updated_date AS updated_date ";

        $query .="FROM username_role AS username_role ";

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
                $singleObj = new UsernameRole($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT username_role.id AS id ";
        $query .=",username_role.name_lenght AS name_lenght ";
        $query .=",username_role.mix_no AS mix_no ";
        $query .=",username_role.special_char AS special_char ";
        $query .=",username_role.created_user AS created_user ";
        $query .=",username_role.created_date AS created_date ";
        $query .=",username_role.updated_user AS updated_user ";
        $query .=",username_role.updated_date AS updated_date ";

        $query .="FROM username_role AS username_role ";
        $query .="WHERE username_role.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $usernameRole = new UsernameRole($result);
            return $usernameRole;
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