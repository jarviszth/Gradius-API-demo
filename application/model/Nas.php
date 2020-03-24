<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class Nas extends BaseModel
{
    public static $tableName = 'nas';

    private $nasname;
    private $shortname;
    private $type = "other";
    private $ports = "1812";
    private $secret;
    private $server;
    private $community;
    private $description;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'nasname' => self::TYPE_STRING,
            'shortname' => self::TYPE_STRING,
            'type' => self::TYPE_STRING,
            'ports' => self::TYPE_STRING,
            'secret' => self::TYPE_STRING,
            'server' => self::TYPE_STRING,
            'community' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'nasname' => self::TYPE_STRING,
            'shortname' => self::TYPE_STRING,
            'type' => self::TYPE_STRING,
            'ports' => self::TYPE_STRING,
            'secret' => self::TYPE_STRING,
            'server' => self::TYPE_STRING,
            'community' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,

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
    public function getNasname()
    { 
        return $this->nasname;
    }

    /**
     * @param mixed $nasname
     */
    public function setNasname($nasname)
    {
        $this->nasname = $nasname;
    }

    /**
     * @return mixed
     */
    public function getShortname()
    { 
        return $this->shortname;
    }

    /**
     * @param mixed $shortname
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;
    }

    /**
     * @return mixed
     */
    public function getType()
    { 
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPorts()
    { 
        return $this->ports;
    }

    /**
     * @param mixed $ports
     */
    public function setPorts($ports)
    {
        $this->ports = $ports;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    { 
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getServer()
    { 
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server)
    {
        $this->server = $server;
    }

    /**
     * @return mixed
     */
    public function getCommunity()
    { 
        return $this->community;
    }

    /**
     * @param mixed $community
     */
    public function setCommunity($community)
    {
        $this->community = $community;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    { 
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}