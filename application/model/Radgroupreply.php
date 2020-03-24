<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/

namespace application\model;

use application\core\AppModel;
use application\util\UploadUtil;
use application\util\DateUtils;
class Radgroupreply extends AppModel
{
    public static $tableName = 'radgroupreply';

    private $groupname;
    private $attribute;
    private $op;
    private $value;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'groupname' => self::TYPE_STRING,
            'attribute' => self::TYPE_STRING,
            'op' => self::TYPE_STRING,
            'value' => self::TYPE_STRING,
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'groupname' => self::TYPE_STRING,
            'attribute' => self::TYPE_STRING,
            'op' => self::TYPE_STRING,
            'value' => self::TYPE_STRING,
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
     * @return string
     */
    public function getGroupname()
    { 
        return $this->groupname;
    }

    /**
     * @param string $groupname
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;
    }

    /**
     * @return string
     */
    public function getAttribute()
    { 
        return $this->attribute;
    }

    /**
     * @param string $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return mixed
     */
    public function getOp()
    { 
        return $this->op;
    }

    /**
     * @param mixed $op
     */
    public function setOp($op)
    {
        $this->op = $op;
    }

    /**
     * @return string
     */
    public function getValue()
    { 
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}