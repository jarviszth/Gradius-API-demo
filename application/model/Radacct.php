<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/

namespace application\model;

use application\core\AppModel;
use application\util\UploadUtil;
use application\util\DateUtils;
class Radacct extends AppModel
{
    public static $tableName = 'radacct';

    private $radacctid;
    private $acctsessionid;
    private $acctuniqueid;
    private $username;
    private $realm;
    private $nasipaddress;
    private $nasportid;
    private $nasporttype;
    private $acctstarttime;
    private $acctupdatetime;
    private $acctstoptime;
    private $acctinterval;
    private $acctsessiontime;
    private $acctauthentic;
    private $connectinfo_start;
    private $connectinfo_stop;
    private $acctinputoctets;
    private $acctoutputoctets;
    private $calledstationid;
    private $callingstationid;
    private $acctterminatecause;
    private $servicetype;
    private $framedprotocol;
    private $framedipaddress;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'radacctid' => self::TYPE_STRING,
            'acctsessionid' => self::TYPE_STRING,
            'acctuniqueid' => self::TYPE_STRING,
            'username' => self::TYPE_STRING,
            'realm' => self::TYPE_STRING,
            'nasipaddress' => self::TYPE_STRING,
            'nasportid' => self::TYPE_STRING,
            'nasporttype' => self::TYPE_STRING,
            'acctstarttime' => self::TYPE_DATE_TIME,
            'acctupdatetime' => self::TYPE_DATE_TIME,
            'acctstoptime' => self::TYPE_DATE_TIME,
            'acctinterval' => self::TYPE_INTEGER,
            'acctsessiontime' => self::TYPE_INTEGER,
            'acctauthentic' => self::TYPE_STRING,
            'connectinfo_start' => self::TYPE_STRING,
            'connectinfo_stop' => self::TYPE_STRING,
            'acctinputoctets' => self::TYPE_STRING,
            'acctoutputoctets' => self::TYPE_STRING,
            'calledstationid' => self::TYPE_STRING,
            'callingstationid' => self::TYPE_STRING,
            'acctterminatecause' => self::TYPE_STRING,
            'servicetype' => self::TYPE_STRING,
            'framedprotocol' => self::TYPE_STRING,
            'framedipaddress' => self::TYPE_STRING,
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'radacctid' => self::TYPE_STRING,
            'acctsessionid' => self::TYPE_STRING,
            'acctuniqueid' => self::TYPE_STRING,
            'username' => self::TYPE_STRING,
            'realm' => self::TYPE_STRING,
            'nasipaddress' => self::TYPE_STRING,
            'nasportid' => self::TYPE_STRING,
            'nasporttype' => self::TYPE_STRING,
            'acctstarttime' => self::TYPE_DATE_TIME,
            'acctupdatetime' => self::TYPE_DATE_TIME,
            'acctstoptime' => self::TYPE_DATE_TIME,
            'acctinterval' => self::TYPE_INTEGER,
            'acctsessiontime' => self::TYPE_INTEGER,
            'acctauthentic' => self::TYPE_STRING,
            'connectinfo_start' => self::TYPE_STRING,
            'connectinfo_stop' => self::TYPE_STRING,
            'acctinputoctets' => self::TYPE_STRING,
            'acctoutputoctets' => self::TYPE_STRING,
            'calledstationid' => self::TYPE_STRING,
            'callingstationid' => self::TYPE_STRING,
            'acctterminatecause' => self::TYPE_STRING,
            'servicetype' => self::TYPE_STRING,
            'framedprotocol' => self::TYPE_STRING,
            'framedipaddress' => self::TYPE_STRING,
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
    public function getRadacctid()
    { 
        return $this->radacctid;
    }

    /**
     * @param mixed $radacctid
     */
    public function setRadacctid($radacctid)
    {
        $this->radacctid = $radacctid;
    }

    /**
     * @return string
     */
    public function getAcctsessionid()
    { 
        return $this->acctsessionid;
    }

    /**
     * @param string $acctsessionid
     */
    public function setAcctsessionid($acctsessionid)
    {
        $this->acctsessionid = $acctsessionid;
    }

    /**
     * @return string
     */
    public function getAcctuniqueid()
    { 
        return $this->acctuniqueid;
    }

    /**
     * @param string $acctuniqueid
     */
    public function setAcctuniqueid($acctuniqueid)
    {
        $this->acctuniqueid = $acctuniqueid;
    }

    /**
     * @return string
     */
    public function getUsername()
    { 
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getRealm()
    { 
        return $this->realm;
    }

    /**
     * @param string $realm
     */
    public function setRealm($realm)
    {
        $this->realm = $realm;
    }

    /**
     * @return string
     */
    public function getNasipaddress()
    { 
        return $this->nasipaddress;
    }

    /**
     * @param string $nasipaddress
     */
    public function setNasipaddress($nasipaddress)
    {
        $this->nasipaddress = $nasipaddress;
    }

    /**
     * @return string
     */
    public function getNasportid()
    { 
        return $this->nasportid;
    }

    /**
     * @param string $nasportid
     */
    public function setNasportid($nasportid)
    {
        $this->nasportid = $nasportid;
    }

    /**
     * @return string
     */
    public function getNasporttype()
    { 
        return $this->nasporttype;
    }

    /**
     * @param string $nasporttype
     */
    public function setNasporttype($nasporttype)
    {
        $this->nasporttype = $nasporttype;
    }

    /**
     * @return mixed
     */
    public function getAcctstarttime()
    { 
        if(!empty($this->acctstarttime)){
            return $this->acctstarttime;
        }
        return DateUtils::getDateNow(true);
    }

    /**
     * @param mixed $acctstarttime
     */
    public function setAcctstarttime($acctstarttime)
    {
        $this->acctstarttime = $acctstarttime;
    }

    /**
     * @return mixed
     */
    public function getAcctupdatetime()
    { 
        if(!empty($this->acctupdatetime)){
            return $this->acctupdatetime;
        }
        return DateUtils::getDateNow(true);
    }

    /**
     * @param mixed $acctupdatetime
     */
    public function setAcctupdatetime($acctupdatetime)
    {
        $this->acctupdatetime = $acctupdatetime;
    }

    /**
     * @return mixed
     */
    public function getAcctstoptime()
    { 
        if(!empty($this->acctstoptime)){
            return $this->acctstoptime;
        }
        return DateUtils::getDateNow(true);
    }

    /**
     * @param mixed $acctstoptime
     */
    public function setAcctstoptime($acctstoptime)
    {
        $this->acctstoptime = $acctstoptime;
    }

    /**
     * @return int
     */
    public function getAcctinterval()
    { 
        return $this->acctinterval;
    }

    /**
     * @param int $acctinterval
     */
    public function setAcctinterval($acctinterval)
    {
        $this->acctinterval = $acctinterval;
    }

    /**
     * @return int
     */
    public function getAcctsessiontime()
    { 
        return $this->acctsessiontime;
    }

    /**
     * @param int $acctsessiontime
     */
    public function setAcctsessiontime($acctsessiontime)
    {
        $this->acctsessiontime = $acctsessiontime;
    }

    /**
     * @return string
     */
    public function getAcctauthentic()
    { 
        return $this->acctauthentic;
    }

    /**
     * @param string $acctauthentic
     */
    public function setAcctauthentic($acctauthentic)
    {
        $this->acctauthentic = $acctauthentic;
    }

    /**
     * @return string
     */
    public function getConnectinfoStart()
    { 
        return $this->connectinfo_start;
    }

    /**
     * @param string $connectinfo_start
     */
    public function setConnectinfoStart($connectinfo_start)
    {
        $this->connectinfo_start = $connectinfo_start;
    }

    /**
     * @return string
     */
    public function getConnectinfoStop()
    { 
        return $this->connectinfo_stop;
    }

    /**
     * @param string $connectinfo_stop
     */
    public function setConnectinfoStop($connectinfo_stop)
    {
        $this->connectinfo_stop = $connectinfo_stop;
    }

    /**
     * @return mixed
     */
    public function getAcctinputoctets()
    { 
        return $this->acctinputoctets;
    }

    /**
     * @param mixed $acctinputoctets
     */
    public function setAcctinputoctets($acctinputoctets)
    {
        $this->acctinputoctets = $acctinputoctets;
    }

    /**
     * @return mixed
     */
    public function getAcctoutputoctets()
    { 
        return $this->acctoutputoctets;
    }

    /**
     * @param mixed $acctoutputoctets
     */
    public function setAcctoutputoctets($acctoutputoctets)
    {
        $this->acctoutputoctets = $acctoutputoctets;
    }

    /**
     * @return string
     */
    public function getCalledstationid()
    { 
        return $this->calledstationid;
    }

    /**
     * @param string $calledstationid
     */
    public function setCalledstationid($calledstationid)
    {
        $this->calledstationid = $calledstationid;
    }

    /**
     * @return string
     */
    public function getCallingstationid()
    { 
        return $this->callingstationid;
    }

    /**
     * @param string $callingstationid
     */
    public function setCallingstationid($callingstationid)
    {
        $this->callingstationid = $callingstationid;
    }

    /**
     * @return string
     */
    public function getAcctterminatecause()
    { 
        return $this->acctterminatecause;
    }

    /**
     * @param string $acctterminatecause
     */
    public function setAcctterminatecause($acctterminatecause)
    {
        $this->acctterminatecause = $acctterminatecause;
    }

    /**
     * @return string
     */
    public function getServicetype()
    { 
        return $this->servicetype;
    }

    /**
     * @param string $servicetype
     */
    public function setServicetype($servicetype)
    {
        $this->servicetype = $servicetype;
    }

    /**
     * @return string
     */
    public function getFramedprotocol()
    { 
        return $this->framedprotocol;
    }

    /**
     * @param string $framedprotocol
     */
    public function setFramedprotocol($framedprotocol)
    {
        $this->framedprotocol = $framedprotocol;
    }

    /**
     * @return string
     */
    public function getFramedipaddress()
    { 
        return $this->framedipaddress;
    }

    /**
     * @param string $framedipaddress
     */
    public function setFramedipaddress($framedipaddress)
    {
        $this->framedipaddress = $framedipaddress;
    }

}