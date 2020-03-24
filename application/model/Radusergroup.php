<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class Radusergroup extends BaseModel
{
    public static $tableName = 'radusergroup';

    private $username;
    private $groupname;
    private $priority = 1;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'username' => self::TYPE_STRING,
            'groupname' => self::TYPE_STRING,
            'priority' => self::TYPE_STRING,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'username' => self::TYPE_STRING,
            'groupname' => self::TYPE_STRING,
            'priority' => self::TYPE_STRING,
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
    public function getUsername()
    { 
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getPriority()
    { 
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

}