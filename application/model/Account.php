<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class Account extends BaseModel
{
    public static $tableName = 'account';

    private $user_name;
    private $password;
    private $radusergroup_detail;
    private $session_timeout;
    private $idle_timeout;
    private $expired;
    private $unused_expired;
    private $create_date;
    private $unused_date;
    private $start_date;
    private $expired_date;
    private $usagetime;
    private $remaintime;
    private $status = true;
    private $unused_expired_hr;
    private $expired_hr;
    private $mac;
    private $rate_limit;
    private $description;
    private $frame_ip;
    private $prename;
    private $name;
    private $lastname;
    private $id_card;
    private $address;
    private $phonenumber;
    private $email;
    private $birthday;
    private $enable_code_check;
    private $code_check;
    private $information1;
    private $name_en;
    private $lastname_en;
    private $app_district;
    private $enable_pass_first;
    private $last_auth;
    private $resetdate_ofweek;
    private $idenity;
    private $create_from;
    private $id_h_ref;
    private $user_session_id;
    private $limittime;
    private $flage;
    private $type;
    private $plan_name;
    private $img_name;

    /*optional field*/
    private $price_plan_name;
    private $online_status;
    private $sum_usage_time_sec;
    private $last_post_authen;

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'user_name' => self::TYPE_STRING,
            'password' => self::TYPE_STRING,
            'radusergroup_detail' => self::TYPE_STRING,
            'session_timeout' => self::TYPE_STRING,
            'idle_timeout' => self::TYPE_STRING,
            'expired' => self::TYPE_STRING,
            'unused_expired' => self::TYPE_STRING,
            'create_date' => self::TYPE_STRING,
            'unused_date' => self::TYPE_STRING,
            'start_date' => self::TYPE_STRING,
            'expired_date' => self::TYPE_STRING,
            'usagetime' => self::TYPE_STRING,
            'remaintime' => self::TYPE_STRING,
            'status' => self::TYPE_BOOLEAN,
            'unused_expired_hr' => self::TYPE_STRING,
            'expired_hr' => self::TYPE_STRING,
            'mac' => self::TYPE_STRING,
            'rate_limit' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,
            'frame_ip' => self::TYPE_STRING,
            'prename' => self::TYPE_STRING,
            'name' => self::TYPE_STRING,
            'lastname' => self::TYPE_STRING,
            'id_card' => self::TYPE_STRING,
            'address' => self::TYPE_STRING,
            'phonenumber' => self::TYPE_STRING,
            'email' => self::TYPE_STRING,
            'birthday' => self::TYPE_STRING,
            'enable_code_check' => self::TYPE_STRING,
            'code_check' => self::TYPE_STRING,
            'information1' => self::TYPE_STRING,
            'name_en' => self::TYPE_STRING,
            'lastname_en' => self::TYPE_STRING,
            'app_district' => self::TYPE_STRING,
            'enable_pass_first' => self::TYPE_STRING,
            'last_auth' => self::TYPE_STRING,
            'resetdate_ofweek' => self::TYPE_STRING,
            'idenity' => self::TYPE_STRING,
            'create_from' => self::TYPE_STRING,
            'id_h_ref' => self::TYPE_STRING,
            'user_session_id' => self::TYPE_STRING,
            'limittime' => self::TYPE_STRING,
            'flage' => self::TYPE_STRING,
            'type' => self::TYPE_STRING,
            'plan_name' => self::TYPE_STRING,
            'img_name' => self::TYPE_STRING,
 
 
            'created_user' => self::TYPE_INTEGER,
            'created_date' => self::TYPE_DATE_TIME,
            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'user_name' => self::TYPE_STRING,
            'password' => self::TYPE_STRING,
            'radusergroup_detail' => self::TYPE_STRING,
            'session_timeout' => self::TYPE_STRING,
            'idle_timeout' => self::TYPE_STRING,
            'expired' => self::TYPE_STRING,
            'unused_expired' => self::TYPE_STRING,
            'create_date' => self::TYPE_STRING,
            'unused_date' => self::TYPE_STRING,
            'start_date' => self::TYPE_STRING,
            'expired_date' => self::TYPE_STRING,
            'usagetime' => self::TYPE_STRING,
            'remaintime' => self::TYPE_STRING,
            'status' => self::TYPE_BOOLEAN,
            'unused_expired_hr' => self::TYPE_STRING,
            'expired_hr' => self::TYPE_STRING,
            'mac' => self::TYPE_STRING,
            'rate_limit' => self::TYPE_STRING,
            'description' => self::TYPE_STRING,
            'frame_ip' => self::TYPE_STRING,
            'prename' => self::TYPE_STRING,
            'name' => self::TYPE_STRING,
            'lastname' => self::TYPE_STRING,
            'id_card' => self::TYPE_STRING,
            'address' => self::TYPE_STRING,
            'phonenumber' => self::TYPE_STRING,
            'email' => self::TYPE_STRING,
            'birthday' => self::TYPE_STRING,
            'enable_code_check' => self::TYPE_STRING,
            'code_check' => self::TYPE_STRING,
            'information1' => self::TYPE_STRING,
            'name_en' => self::TYPE_STRING,
            'lastname_en' => self::TYPE_STRING,
            'app_district' => self::TYPE_STRING,
            'enable_pass_first' => self::TYPE_STRING,
            'last_auth' => self::TYPE_STRING,
            'resetdate_ofweek' => self::TYPE_STRING,
            'idenity' => self::TYPE_STRING,
            'create_from' => self::TYPE_STRING,
            'id_h_ref' => self::TYPE_STRING,
            'user_session_id' => self::TYPE_STRING,
            'limittime' => self::TYPE_STRING,
            'flage' => self::TYPE_STRING,
            'type' => self::TYPE_STRING,
            'plan_name' => self::TYPE_STRING,
            'img_name' => self::TYPE_STRING,

            'updated_user' => self::TYPE_INTEGER,
            'updated_date' => self::TYPE_DATE_TIME
        ));

        /* init optional field*/
        $this->setTableOptionalField(array(
            //'field_name_option',
            'price_plan_name' => self::TYPE_STRING,
            'online_status' => self::TYPE_STRING,
            'sum_usage_time_sec' => self::TYPE_STRING,
            'last_post_authen' => self::TYPE_STRING,
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
     * @return mixed
     */
    public function getSessionTimeout()
    { 
        return $this->session_timeout;
    }

    /**
     * @param mixed $session_timeout
     */
    public function setSessionTimeout($session_timeout)
    {
        $this->session_timeout = $session_timeout;
    }

    /**
     * @return mixed
     */
    public function getIdleTimeout()
    { 
        return $this->idle_timeout;
    }

    /**
     * @param mixed $idle_timeout
     */
    public function setIdleTimeout($idle_timeout)
    {
        $this->idle_timeout = $idle_timeout;
    }

    /**
     * @return mixed
     */
    public function getExpired()
    { 
        return $this->expired;
    }

    /**
     * @param mixed $expired
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;
    }

    /**
     * @return mixed
     */
    public function getUnusedExpired()
    { 
        return $this->unused_expired;
    }

    /**
     * @param mixed $unused_expired
     */
    public function setUnusedExpired($unused_expired)
    {
        $this->unused_expired = $unused_expired;
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
    public function getUnusedDate()
    { 
        return $this->unused_date;
    }

    /**
     * @param mixed $unused_date
     */
    public function setUnusedDate($unused_date)
    {
        $this->unused_date = $unused_date;
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
     * @return mixed
     */
    public function getUsagetime()
    { 
        return $this->usagetime;
    }

    /**
     * @param mixed $usagetime
     */
    public function setUsagetime($usagetime)
    {
        $this->usagetime = $usagetime;
    }

    /**
     * @return mixed
     */
    public function getRemaintime()
    { 
        return $this->remaintime;
    }

    /**
     * @param mixed $remaintime
     */
    public function setRemaintime($remaintime)
    {
        $this->remaintime = $remaintime;
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
    public function getUnusedExpiredHr()
    { 
        return $this->unused_expired_hr;
    }

    /**
     * @param mixed $unused_expired_hr
     */
    public function setUnusedExpiredHr($unused_expired_hr)
    {
        $this->unused_expired_hr = $unused_expired_hr;
    }

    /**
     * @return mixed
     */
    public function getExpiredHr()
    { 
        return $this->expired_hr;
    }

    /**
     * @param mixed $expired_hr
     */
    public function setExpiredHr($expired_hr)
    {
        $this->expired_hr = $expired_hr;
    }

    /**
     * @return mixed
     */
    public function getMac()
    { 
        return $this->mac;
    }

    /**
     * @param mixed $mac
     */
    public function setMac($mac)
    {
        $this->mac = $mac;
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

    /**
     * @return mixed
     */
    public function getFrameIp()
    { 
        return $this->frame_ip;
    }

    /**
     * @param mixed $frame_ip
     */
    public function setFrameIp($frame_ip)
    {
        $this->frame_ip = $frame_ip;
    }

    /**
     * @return mixed
     */
    public function getPrename()
    { 
        return $this->prename;
    }

    /**
     * @param mixed $prename
     */
    public function setPrename($prename)
    {
        $this->prename = $prename;
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
    public function getLastname()
    { 
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getIdCard()
    { 
        return $this->id_card;
    }

    /**
     * @param mixed $id_card
     */
    public function setIdCard($id_card)
    {
        $this->id_card = $id_card;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    { 
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPhonenumber()
    { 
        return $this->phonenumber;
    }

    /**
     * @param mixed $phonenumber
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    { 
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    { 
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getEnableCodeCheck()
    { 
        return $this->enable_code_check;
    }

    /**
     * @param mixed $enable_code_check
     */
    public function setEnableCodeCheck($enable_code_check)
    {
        $this->enable_code_check = $enable_code_check;
    }

    /**
     * @return mixed
     */
    public function getCodeCheck()
    { 
        return $this->code_check;
    }

    /**
     * @param mixed $code_check
     */
    public function setCodeCheck($code_check)
    {
        $this->code_check = $code_check;
    }

    /**
     * @return mixed
     */
    public function getInformation1()
    { 
        return $this->information1;
    }

    /**
     * @param mixed $information1
     */
    public function setInformation1($information1)
    {
        $this->information1 = $information1;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    { 
        return $this->name_en;
    }

    /**
     * @param mixed $name_en
     */
    public function setNameEn($name_en)
    {
        $this->name_en = $name_en;
    }

    /**
     * @return mixed
     */
    public function getLastnameEn()
    { 
        return $this->lastname_en;
    }

    /**
     * @param mixed $lastname_en
     */
    public function setLastnameEn($lastname_en)
    {
        $this->lastname_en = $lastname_en;
    }

    /**
     * @return mixed
     */
    public function getAppDistrict()
    { 
        return $this->app_district;
    }

    /**
     * @param mixed $app_district
     */
    public function setAppDistrict($app_district)
    {
        $this->app_district = $app_district;
    }

    /**
     * @return mixed
     */
    public function getEnablePassFirst()
    { 
        return $this->enable_pass_first;
    }

    /**
     * @param mixed $enable_pass_first
     */
    public function setEnablePassFirst($enable_pass_first)
    {
        $this->enable_pass_first = $enable_pass_first;
    }

    /**
     * @return mixed
     */
    public function getLastAuth()
    { 
        return $this->last_auth;
    }

    /**
     * @param mixed $last_auth
     */
    public function setLastAuth($last_auth)
    {
        $this->last_auth = $last_auth;
    }

    /**
     * @return mixed
     */
    public function getResetdateOfweek()
    { 
        return $this->resetdate_ofweek;
    }

    /**
     * @param mixed $resetdate_ofweek
     */
    public function setResetdateOfweek($resetdate_ofweek)
    {
        $this->resetdate_ofweek = $resetdate_ofweek;
    }

    /**
     * @return mixed
     */
    public function getIdenity()
    { 
        return $this->idenity;
    }

    /**
     * @param mixed $idenity
     */
    public function setIdenity($idenity)
    {
        $this->idenity = $idenity;
    }

    /**
     * @return mixed
     */
    public function getCreateFrom()
    { 
        return $this->create_from;
    }

    /**
     * @param mixed $create_from
     */
    public function setCreateFrom($create_from)
    {
        $this->create_from = $create_from;
    }

    /**
     * @return mixed
     */
    public function getIdHRef()
    { 
        return $this->id_h_ref;
    }

    /**
     * @param mixed $id_h_ref
     */
    public function setIdHRef($id_h_ref)
    {
        $this->id_h_ref = $id_h_ref;
    }

    /**
     * @return mixed
     */
    public function getUserSessionId()
    { 
        return $this->user_session_id;
    }

    /**
     * @param mixed $user_session_id
     */
    public function setUserSessionId($user_session_id)
    {
        $this->user_session_id = $user_session_id;
    }

    /**
     * @return mixed
     */
    public function getLimittime()
    { 
        return $this->limittime;
    }

    /**
     * @param mixed $limittime
     */
    public function setLimittime($limittime)
    {
        $this->limittime = $limittime;
    }

    /**
     * @return mixed
     */
    public function getFlage()
    { 
        return $this->flage;
    }

    /**
     * @param mixed $flage
     */
    public function setFlage($flage)
    {
        $this->flage = $flage;
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
    public function getPlanName()
    { 
        return $this->plan_name;
    }

    /**
     * @param mixed $plan_name
     */
    public function setPlanName($plan_name)
    {
        $this->plan_name = $plan_name;
    }

    /**
     * @return mixed
     */
    public function getImgName()
    { 
        return $this->img_name;
    }

    /**
     * @param mixed $img_name
     */
    public function setImgName($img_name)
    {
        $this->img_name = $img_name;
    }
    /**
     * @return mixed
     */
    public function getPricePlanName()
    {
        return $this->price_plan_name;
    }

    /**
     * @param mixed $price_plan_name
     */
    public function setPricePlanName($price_plan_name)
    {
        $this->price_plan_name = $price_plan_name;
    }

    /**
     * @return mixed
     */
    public function getOnlineStatus()
    {
        return $this->online_status;
    }

    /**
     * @param mixed $online_status
     */
    public function setOnlineStatus($online_status)
    {
        $this->online_status = $online_status;
    }

    /**
     * @return mixed
     */
    public function getSumUsageTimeSec()
    {
        return $this->sum_usage_time_sec;
    }

    /**
     * @param mixed $sum_usage_time_sec
     */
    public function setSumUsageTimeSec($sum_usage_time_sec)
    {
        $this->sum_usage_time_sec = $sum_usage_time_sec;
    }

    /**
     * @return mixed
     */
    public function getLastPostAuthen()
    {
        return $this->last_post_authen;
    }

    /**
     * @param mixed $last_post_authen
     */
    public function setLastPostAuthen($last_post_authen)
    {
        $this->last_post_authen = $last_post_authen;
    }


}