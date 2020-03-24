<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class Radpostauth extends BaseModel
{
    public static $tableName = 'radpostauth';

    private $username;
    private $pass;
    private $reply;
    private $authdate;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'username' => self::TYPE_STRING,
            'pass' => self::TYPE_STRING,
            'reply' => self::TYPE_STRING,
            'authdate' => self::TYPE_STRING,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'username' => self::TYPE_STRING,
            'pass' => self::TYPE_STRING,
            'reply' => self::TYPE_STRING,
            'authdate' => self::TYPE_STRING,

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
    public function getPass()
    { 
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getReply()
    { 
        return $this->reply;
    }

    /**
     * @param mixed $reply
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    /**
     * @return mixed
     */
    public function getAuthdate()
    { 
        return $this->authdate;
    }

    /**
     * @param mixed $authdate
     */
    public function setAuthdate($authdate)
    {
        $this->authdate = $authdate;
    }

}