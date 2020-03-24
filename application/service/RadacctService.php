<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\service;

use application\core\DatabaseSupport;
use application\serviceInterface\RadacctServiceInterface;
use application\model\Radacct;
class RadacctService extends DatabaseSupport implements RadacctServiceInterface
{
    protected $tableName = 'radacct';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        //if have param
        $data_bind_where = null;

        $query = "SELECT *  ";

        $query .="FROM radacct AS radacct ";

		//where query
        $query .=" WHERE radacct.`radacctid` IS NOT NULL ";
        //gen additional query and sort order
       $additionalParam = $this->genAdditionalParamAndWhereForListradacct($q_parameter, $this->tableName);
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
                $singleObj = new Radacct($obj);
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

        $query .="FROM radacct AS radacct ";
        $query .="WHERE radacct.`radacctid`=:id ";

        $this->query($query);
        $this->bind(":id", (int)$id);
        //Return as Object Class
        /*
        $result =  $this->single();
		if (is_array($result) || is_object($result)){
            $radacct = new Radacct($result);
            return $radacct;
        }
        */
        return  $this->single();
    }
    public function deleteById($id)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE radacctid=:id";
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