<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\service;

use application\core\DatabaseSupport;
use application\serviceInterface\RadgroupreplyServiceInterface;
use application\model\Radgroupreply;
class RadgroupreplyService extends DatabaseSupport implements RadgroupreplyServiceInterface
{
    protected $tableName = 'radgroupreply';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        //if have param
        $data_bind_where = null;

        $query = "SELECT *  ";

        $query .="FROM radgroupreply AS radgroupreply ";

		//where query
        $query .=" WHERE radgroupreply.`id` IS NOT NULL ";

        //gen additional query and sort order
       $additionalParam = $this->genAdditionalParamAndWhereForListPage($q_parameter, $this->tableName);
       if(!empty($additionalParam)){
           if(!empty($additionalParam['additional_query'])){
               $query .= $additionalParam['additional_query'];
           }
           if(!empty($additionalParam['where_bind'])){
               $data_bind_where = $additionalParam['where_bind'];
           }
       }

        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query, $perpage, $data_bind_where);
        }
        //regular query
        $this->query($query);

        //START BIND VALUE FOR REGULAR QUERY
        //$this->bind(":q_name", "%".$q_parameter['q_name']."%");//bind param for 'LIKE'
	     //$this->bind(":q_name", $q_parameter['q_name']);//bind param for '='
        //END BIND VALUE FOR REGULAR QUERY

        //bind param for search param
        $this->genBindParamAndWhereForListPage($data_bind_where);

        //Return as Object Class
        /*
        $resaultList =  $this->resultset();
		if (is_array($resaultList) || is_object($resaultList)){
            $findList = array();
            foreach($resaultList as $obj){
                $singleObj = null;
                $singleObj = new Radgroupreply($obj);
                array_push($findList, $singleObj);
            }
            return $findList;
        }
        */
        return  $this->resultset();
    }

    public function findById($id)
    {
        $query = "SELECT *  ";

        $query .="FROM radgroupreply AS radgroupreply ";
        $query .="WHERE radgroupreply.`id`=:id ";

        $this->query($query);
        $this->bind(":id", (int)$id);
        //Return as Object Class
        /*
        $result =  $this->single();
		if (is_array($result) || is_object($result)){
            $radgroupreply = new Radgroupreply($result);
            return $radgroupreply;
        }
        */
        return  $this->single();
    }
    public function deleteById($id)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE id=:id";
        $this->query($query);
        $this->bind(":id", (int)$id);
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