<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class AppAmphur extends BaseModel
{
    public static $tableName = 'app_amphur';

    private $code;
    private $name;
    private $name_eng;
    private $app_province;

    /*optional field*/
    private $app_province_name;
    private $app_province_name_eng;

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'code' => self::TYPE_STRING,
            'name' => self::TYPE_STRING,
            'name_eng' => self::TYPE_STRING,
            'app_province' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'code' => self::TYPE_STRING,
            'name' => self::TYPE_STRING,
            'name_eng' => self::TYPE_STRING,
            'app_province' => self::TYPE_STRING,

            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        ));

        /* init optional field*/
        $this->setTableOptionalField(array(
            'app_province_name',
            'app_province_name_eng'
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
    public function getCode()
    { 
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getName()
    { 
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameEng()
    { 
        return $this->name_eng;
    }

    /**
     * @param mixed $name_eng
     */
    public function setNameEng($name_eng)
    {
        $this->name_eng = $name_eng;
    }

    /**
     * @return mixed
     */
    public function getAppProvince()
    { 
        return $this->app_province;
    }

    /**
     * @param mixed $app_province
     */
    public function setAppProvince($app_province)
    {
        $this->app_province = $app_province;
    }

    /**
     * @return mixed
     */
    public function getAppProvinceName()
    {
        return $this->app_province_name;
    }

    /**
     * @param mixed $app_province_name
     */
    public function setAppProvinceName($app_province_name)
    {
        $this->app_province_name = $app_province_name;
    }

    /**
     * @return mixed
     */
    public function getAppProvinceNameEng()
    {
        return $this->app_province_name_eng;
    }

    /**
     * @param mixed $app_province_name_eng
     */
    public function setAppProvinceNameEng($app_province_name_eng)
    {
        $this->app_province_name_eng = $app_province_name_eng;
    }

}