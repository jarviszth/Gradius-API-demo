<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\RadpostauthServiceInterface as RadpostauthServiceInterface;
use application\model\Radpostauth as Radpostauth;
class RadpostauthService extends DatabaseSupport implements RadpostauthServiceInterface
{
    protected $tableName = 'radpostauth';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        $query = "SELECT radpostauth.id AS id ";
        $query .=",radpostauth.username AS username ";
        $query .=",radpostauth.pass AS pass ";
        $query .=",radpostauth.reply AS reply ";
        $query .=",radpostauth.authdate AS authdate ";

        $query .="FROM radpostauth AS radpostauth ";

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
                $singleObj = new Radpostauth($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        return false;
    }
    public function findAllPostAuthenByUserName($perpage=0, $q_parameter=array(), $userName)
    {
        $query = "SELECT radpostauth.id AS id ";
        $query .=",radpostauth.username AS username ";
        $query .=",radpostauth.pass AS pass ";
        $query .=",radpostauth.reply AS reply ";
        $query .=",radpostauth.authdate AS authdate ";

        $query .="FROM radpostauth AS radpostauth ";
        $query .="WHERE radpostauth.username=:username_s ";

//        $query .= " GROUP BY authdate ";

        $data_bind_where['username_s'] = strtoupper($userName);

        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){

            $query .=" ORDER BY ".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY radpostauth.authdate ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " DESC ";
        }
        // END SORT ORDER


        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query,$perpage,$data_bind_where);
        }
        //regular query
        $this->query($query);
        $this->bind(":username_s", strtoupper($userName));
        return $this->resultset();
    }
    public function findById($id)
    {
        $query = "SELECT radpostauth.id AS id ";
        $query .=",radpostauth.username AS username ";
        $query .=",radpostauth.pass AS pass ";
        $query .=",radpostauth.reply AS reply ";
        $query .=",radpostauth.authdate AS authdate ";

        $query .="FROM radpostauth AS radpostauth ";
        $query .="WHERE radpostauth.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $radpostauth = new Radpostauth($result);
            return $radpostauth;
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
    public function deleteByUsername($username)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE username=:username";
        $this->query($query);
        $this->bind(":username", $username);
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