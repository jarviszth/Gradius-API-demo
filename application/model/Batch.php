<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class Batch extends BaseModel
{
    public static $tableName = 'batch';

    private $batch_name;
    private $descriptions;
    private $volume = 1;
    private $create_date;
    private $active = 1;
    private $radusergroup_detail;

    /*optional field*/
    private $username_lenght=5;
    private $username_prefix;
    private $username_subfix;
    private $username_domain;

    private $password_type;
    private $random_password_radio;
    private $fix_password_text;

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'batch_name' => self::TYPE_STRING,
            'descriptions' => self::TYPE_STRING,
            'volume' => self::TYPE_STRING,
            'create_date' => self::TYPE_STRING,
            'active' => self::TYPE_STRING,
            'radusergroup_detail' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'batch_name' => self::TYPE_STRING,
            'descriptions' => self::TYPE_STRING,
            'volume' => self::TYPE_STRING,
            'create_date' => self::TYPE_STRING,
            'active' => self::TYPE_STRING,
            'radusergroup_detail' => self::TYPE_STRING,

            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        ));

        /* init optional field*/
        $this->setTableOptionalField(array(
            //'field_name_option',
            'username_lenght' => self::TYPE_INTEGER,
            'username_prefix' => self::TYPE_STRING,
            'username_subfix' => self::TYPE_STRING,
            'username_domain' => self::TYPE_STRING,

            'password_type' => self::TYPE_STRING,
            'random_password_radio' => self::TYPE_STRING,
            'fix_password_text' => self::TYPE_STRING,
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
    public function getBatchName()
    { 
        return $this->batch_name;
    }

    /**
     * @param mixed $batch_name
     */
    public function setBatchName($batch_name)
    {
        $this->batch_name = $batch_name;
    }

    /**
     * @return mixed
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param mixed $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }




    /**
     * @return mixed
     */
    public function getVolume()
    { 
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    { 
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return mixed
     */
    public function getActive()
    { 
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getRadusergroupDetail()
    { 
        return $this->radusergroup_detail;
    }

    /**
     * @param mixed $radusergroup_detail
     */
    public function setRadusergroupDetail($radusergroup_detail)
    {
        $this->radusergroup_detail = $radusergroup_detail;
    }

    /**
     * @return int
     */
    public function getUsernameLenght()
    {
        return $this->username_lenght;
    }

    /**
     * @param int $username_lenght
     */
    public function setUsernameLenght($username_lenght)
    {
        $this->username_lenght = $username_lenght;
    }

    /**
     * @return mixed
     */
    public function getUsernamePrefix()
    {
        return $this->username_prefix;
    }

    /**
     * @param mixed $username_prefix
     */
    public function setUsernamePrefix($username_prefix)
    {
        $this->username_prefix = $username_prefix;
    }

    /**
     * @return mixed
     */
    public function getUsernameSubfix()
    {
        return $this->username_subfix;
    }

    /**
     * @param mixed $username_subfix
     */
    public function setUsernameSubfix($username_subfix)
    {
        $this->username_subfix = $username_subfix;
    }

    /**
     * @return mixed
     */
    public function getUsernameDomain()
    {
        return $this->username_domain;
    }

    /**
     * @param mixed $username_domain
     */
    public function setUsernameDomain($username_domain)
    {
        $this->username_domain = $username_domain;
    }

    /**
     * @return mixed
     */
    public function getPasswordType()
    {
        return $this->password_type;
    }

    /**
     * @param mixed $password_type
     */
    public function setPasswordType($password_type)
    {
        $this->password_type = $password_type;
    }

    /**
     * @return mixed
     */
    public function getRandomPasswordRadio()
    {
        return $this->random_password_radio;
    }

    /**
     * @param mixed $random_password_radio
     */
    public function setRandomPasswordRadio($random_password_radio)
    {
        $this->random_password_radio = $random_password_radio;
    }

    /**
     * @return mixed
     */
    public function getFixPasswordText()
    {
        return $this->fix_password_text;
    }

    /**
     * @param mixed $fix_password_text
     */
    public function setFixPasswordText($fix_password_text)
    {
        $this->fix_password_text = $fix_password_text;
    }





}