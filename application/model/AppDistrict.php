<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class AppDistrict extends BaseModel
{
    public static $tableName = 'app_district';

    private $code;
    private $name;
    private $app_amphur;
    private $zipcode;

    /*optional field*/
    private $app_amphur_name;
    private $app_amphur_name_eng;
    private $app_province;

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'code' => self::TYPE_STRING,
            'name' => self::TYPE_STRING,
            'app_amphur' => self::TYPE_STRING,
            'zipcode' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'code' => self::TYPE_STRING,
            'name' => self::TYPE_STRING,
            'app_amphur' => self::TYPE_STRING,
            'zipcode' => self::TYPE_STRING,

            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        ));

        /* init optional field*/
        $this->setTableOptionalField(array(
            'app_amphur_name',
            'app_amphur_name_eng',
            'app_province',
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
    public function getAppAmphur()
    { 
        return $this->app_amphur;
    }

    /**
     * @param mixed $app_amphur
     */
    public function setAppAmphur($app_amphur)
    {
        $this->app_amphur = $app_amphur;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    { 
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getAppAmphurName()
    {
        return $this->app_amphur_name;
    }

    /**
     * @param mixed $app_amphur_name
     */
    public function setAppAmphurName($app_amphur_name)
    {
        $this->app_amphur_name = $app_amphur_name;
    }

    /**
     * @return mixed
     */
    public function getAppAmphurNameEng()
    {
        return $this->app_amphur_name_eng;
    }

    /**
     * @param mixed $app_amphur_name_eng
     */
    public function setAppAmphurNameEng($app_amphur_name_eng)
    {
        $this->app_amphur_name_eng = $app_amphur_name_eng;
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

}