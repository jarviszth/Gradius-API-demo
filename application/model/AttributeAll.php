<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class AttributeAll extends BaseModel
{
    public static $tableName = 'attribute_all';

    private $attribute;
    private $df_value;
    private $attribute_name;
    private $type_value;
    private $type_checkreply;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'attribute' => self::TYPE_STRING,
            'df_value' => self::TYPE_STRING,
            'attribute_name' => self::TYPE_STRING,
            'type_value' => self::TYPE_STRING,
            'type_checkreply' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'attribute' => self::TYPE_STRING,
            'df_value' => self::TYPE_STRING,
            'attribute_name' => self::TYPE_STRING,
            'type_value' => self::TYPE_STRING,
            'type_checkreply' => self::TYPE_STRING,

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
    public function getAttribute()
    { 
        return $this->attribute;
    }

    /**
     * @param mixed $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return mixed
     */
    public function getDfValue()
    { 
        return $this->df_value;
    }

    /**
     * @param mixed $df_value
     */
    public function setDfValue($df_value)
    {
        $this->df_value = $df_value;
    }

    /**
     * @return mixed
     */
    public function getAttributeName()
    { 
        return $this->attribute_name;
    }

    /**
     * @param mixed $attribute_name
     */
    public function setAttributeName($attribute_name)
    {
        $this->attribute_name = $attribute_name;
    }

    /**
     * @return mixed
     */
    public function getTypeValue()
    { 
        return $this->type_value;
    }

    /**
     * @param mixed $type_value
     */
    public function setTypeValue($type_value)
    {
        $this->type_value = $type_value;
    }

    /**
     * @return mixed
     */
    public function getTypeCheckreply()
    { 
        return $this->type_checkreply;
    }

    /**
     * @param mixed $type_checkreply
     */
    public function setTypeCheckreply($type_checkreply)
    {
        $this->type_checkreply = $type_checkreply;
    }

}