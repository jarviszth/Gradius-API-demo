<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class RadgroupDetail extends BaseModel
{
    public static $tableName = 'radgroup_detail';

    private $groupname;
    private $group_detail;
    private $start_ip;
    private $end_id;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'groupname' => self::TYPE_STRING,
            'group_detail' => self::TYPE_STRING,
            'start_ip' => self::TYPE_STRING,
            'end_id' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'groupname' => self::TYPE_STRING,
            'group_detail' => self::TYPE_STRING,
            'start_ip' => self::TYPE_STRING,
            'end_id' => self::TYPE_STRING,

            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        ));

        /* init optional field*/
        $this->setTableOptionalField(array(
            //'field_name_option',
        ));

        $this->populate($data, $this);
        $this->populateBase($data);
    }

    public static function getTableName()
    {
        return self::$tableName;
    }

    /**
     * @return mixed
     */
    public function getGroupname()
    { 
        return $this->groupname;
    }

    /**
     * @param mixed $groupname
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;
    }

    /**
     * @return mixed
     */
    public function getGroupDetail()
    { 
        return $this->group_detail;
    }

    /**
     * @param mixed $group_detail
     */
    public function setGroupDetail($group_detail)
    {
        $this->group_detail = $group_detail;
    }

    /**
     * @return mixed
     */
    public function getStartIp()
    { 
        return $this->start_ip;
    }

    /**
     * @param mixed $start_ip
     */
    public function setStartIp($start_ip)
    {
        $this->start_ip = $start_ip;
    }

    /**
     * @return mixed
     */
    public function getEndId()
    { 
        return $this->end_id;
    }

    /**
     * @param mixed $end_id
     */
    public function setEndId($end_id)
    {
        $this->end_id = $end_id;
    }

}