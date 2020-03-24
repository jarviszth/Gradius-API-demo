<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class BatchUser extends BaseModel
{
    public static $tableName = 'batch_user';

    private $batch;
    private $account;
    private $user_name;
    private $password;
    private $start_date;
    private $expired_date;
    private $status = true;
    private $rate_limit;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'batch' => self::TYPE_STRING,
            'account' => self::TYPE_STRING,
            'user_name' => self::TYPE_STRING,
            'password' => self::TYPE_STRING,
            'start_date' => self::TYPE_STRING,
            'expired_date' => self::TYPE_STRING,
            'status' => self::TYPE_BOOLEAN,
            'rate_limit' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'batch' => self::TYPE_STRING,
            'account' => self::TYPE_STRING,
            'user_name' => self::TYPE_STRING,
            'password' => self::TYPE_STRING,
            'start_date' => self::TYPE_STRING,
            'expired_date' => self::TYPE_STRING,
            'status' => self::TYPE_BOOLEAN,
            'rate_limit' => self::TYPE_STRING,

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
    public function getBatch()
    { 
        return $this->batch;
    }

    /**
     * @param mixed $batch
     */
    public function setBatch($batch)
    {
        $this->batch = $batch;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    { 
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    { 
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    { 
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    { 
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getExpiredDate()
    { 
        return $this->expired_date;
    }

    /**
     * @param mixed $expired_date
     */
    public function setExpiredDate($expired_date)
    {
        $this->expired_date = $expired_date;
    }

    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getRateLimit()
    { 
        return $this->rate_limit;
    }

    /**
     * @param mixed $rate_limit
     */
    public function setRateLimit($rate_limit)
    {
        $this->rate_limit = $rate_limit;
    }

}