<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\RadusergroupServiceInterface as RadusergroupServiceInterface;
use application\model\Radusergroup as Radusergroup;
class RadusergroupService extends DatabaseSupport implements RadusergroupServiceInterface
{
    protected $tableName = 'radusergroup';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT radusergroup.username AS username ";
        $query .=",radusergroup.groupname AS groupname ";
        $query .=",radusergroup.priority AS priority ";

        $query .="FROM radusergroup AS radusergroup ";

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
                $singleObj = new Radusergroup($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }

    public function findById($id)
    {
        $query = "SELECT radusergroup.username AS username ";
        $query .=",radusergroup.groupname AS groupname ";
        $query .=",radusergroup.priority AS priority ";

        $query .="FROM radusergroup AS radusergroup ";
        $query .="WHERE radusergroup.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $radusergroup = new Radusergroup($result);
            return $radusergroup;
        }
        return false;
    }
    public function findByUsername($username)
    {
        $query = "SELECT radusergroup.username AS username ";
        $query .=",radusergroup.groupname AS groupname ";
        $query .=",radusergroup.priority AS priority ";

        $query .="FROM radusergroup AS radusergroup ";
        $query .="WHERE radusergroup.username=:username ";

        $this->query($query);
        $this->bind(":username", $username);
        $result =  $this->single();
        if($result){
            $radusergroup = new Radusergroup($result);
            return $radusergroup;
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
    public function deleteByUsernameAndGroup($username, $userGroup)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE username=:username AND groupname=:groupname ";
        $this->query($query);
        $this->bind(":username", $username);
        $this->bind(":groupname", $userGroup);
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