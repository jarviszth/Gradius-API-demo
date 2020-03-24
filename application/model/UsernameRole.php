<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class UsernameRole extends BaseModel
{
    public static $tableName = 'username_role';

    private $name_lenght;
    private $mix_no;
    private $special_char;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'name_lenght' => self::TYPE_STRING,
            'mix_no' => self::TYPE_STRING,
            'special_char' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'name_lenght' => self::TYPE_STRING,
            'mix_no' => self::TYPE_STRING,
            'special_char' => self::TYPE_STRING,

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
    public function getNameLenght()
    { 
        return $this->name_lenght;
    }

    /**
     * @param mixed $name_lenght
     */
    public function setNameLenght($name_lenght)
    {
        $this->name_lenght = $name_lenght;
    }

    /**
     * @return mixed
     */
    public function getMixNo()
    { 
        return $this->mix_no;
    }

    /**
     * @param mixed $mix_no
     */
    public function setMixNo($mix_no)
    {
        $this->mix_no = $mix_no;
    }

    /**
     * @return mixed
     */
    public function getSpecialChar()
    { 
        return $this->special_char;
    }

    /**
     * @param mixed $special_char
     */
    public function setSpecialChar($special_char)
    {
        $this->special_char = $special_char;
    }

}