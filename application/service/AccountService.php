<?php
namespace application\service;

use application\core\DatabaseSupport as DatabaseSupport;
use application\serviceInterface\AccountServiceInterface as AccountServiceInterface;
use application\model\Account as Account;

use application\model\RadgroupDetail as RadgroupDetail;
use application\util\FilterUtils as FilterUtil;
use application\util\ControllerUtil as ControllerUtils;
class AccountService extends DatabaseSupport implements AccountServiceInterface
{
    protected $tableName = 'account';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {

        //if have param
        $data_bind_where = null;

        $query = "SELECT account.id AS id ";
        $query .=",account.user_name AS user_name ";
        $query .=",account.password AS password ";
        $query .=",account.radusergroup_detail AS radusergroup_detail ";
        $query .=",account.session_timeout AS session_timeout ";
        $query .=",account.idle_timeout AS idle_timeout ";
        $query .=",account.expired AS expired ";
        $query .=",account.unused_expired AS unused_expired ";
        $query .=",account.create_date AS create_date ";
        $query .=",account.unused_date AS unused_date ";
        $query .=",account.start_date AS start_date ";
        $query .=",account.expired_date AS expired_date ";
        $query .=",account.usagetime AS usagetime ";
        $query .=",account.remaintime AS remaintime ";
        $query .=",account.status AS status ";
        $query .=",account.unused_expired_hr AS unused_expired_hr ";
        $query .=",account.expired_hr AS expired_hr ";
        $query .=",account.mac AS mac ";
        $query .=",account.rate_limit AS rate_limit ";
        $query .=",account.description AS description ";
        $query .=",account.frame_ip AS frame_ip ";
        $query .=",account.prename AS prename ";
        $query .=",account.name AS name ";
        $query .=",account.lastname AS lastname ";
        $query .=",account.id_card AS id_card ";
        $query .=",account.address AS address ";
        $query .=",account.phonenumber AS phonenumber ";
        $query .=",account.email AS email ";
        $query .=",account.birthday AS birthday ";
        $query .=",account.enable_code_check AS enable_code_check ";
        $query .=",account.code_check AS code_check ";
        $query .=",account.information1 AS information1 ";
        $query .=",account.name_en AS name_en ";
        $query .=",account.lastname_en AS lastname_en ";
        $query .=",account.app_district AS app_district ";
        $query .=",account.enable_pass_first AS enable_pass_first ";
        $query .=",account.last_auth AS last_auth ";
        $query .=",account.resetdate_ofweek AS resetdate_ofweek ";
        $query .=",account.idenity AS idenity ";
        $query .=",account.create_from AS create_from ";
        $query .=",account.id_h_ref AS id_h_ref ";
        $query .=",account.user_session_id AS user_session_id ";
        $query .=",account.limittime AS limittime ";
        $query .=",account.flage AS flage ";
        $query .=",account.type AS type ";
        $query .=",account.plan_name AS plan_name ";
        $query .=",account.img_name AS img_name ";
        $query .=",account.created_user AS created_user ";
        $query .=",account.created_date AS created_date ";
        $query .=",account.updated_user AS updated_user ";
        $query .=",account.updated_date AS updated_date ";

        $query .=",radgroup_detail.groupname AS price_plan_name ";

        $query .=",IFNULL( ";
        $query .="( SELECT radacctid ";
        $query .="	FROM radacct ";
        $query .="  WHERE username=UPPER(user_name) ";
        $query .="  AND acctstoptime IS NULL LIMIT 1 ";
        $query .="),0)AS online_status ";

        $query .="FROM account AS account ";
        $query .="LEFT JOIN  radgroup_detail AS radgroup_detail ";
        $query .="ON account.radusergroup_detail=radgroup_detail.id";


        //where query
        $query .=" WHERE account.id IS NOT NULL ";

        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!=''){
            //for query concat
            $query .=" AND account.user_name LIKE :q_user_name  ";
            //for bind param
            $data_bind_where['q_user_name'] = "%".$q_parameter['q_user_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_name']) && $q_parameter['q_name']!=''){
            $query .=" AND account.name LIKE :q_name  ";
            //for bind param
            $data_bind_where['q_name'] = "%".$q_parameter['q_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_lastname']) && $q_parameter['q_lastname']!=''){
            $query .=" AND account.lastname LIKE :q_lastname  ";
            //for bind param
            $data_bind_where['q_lastname'] = "%".$q_parameter['q_lastname']."%";//bind param for like query
        }
        if(isset($q_parameter['q_radusergroup_detail']) && $q_parameter['q_radusergroup_detail']!=''){
            $query .=" AND account.radusergroup_detail =:q_radusergroup_detail ";
            //for bind param
            $data_bind_where['q_radusergroup_detail'] = $q_parameter['q_radusergroup_detail'];
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_online_status']) && $q_parameter['q_online_status']!=''){


            if($q_parameter['q_online_status']=="1"){
                $query .= " HAVING online_status>0 ";
            }else{
                $query .= " HAVING online_status=0 ";
            }
        }


        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){

            $query .=" ORDER BY ".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY id ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " ASC ";
        }
        // END SORT ORDER




        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query, $perpage, $data_bind_where);
        }

        //regular query
        $this->query($query);

        //START BIND VALUE FOR REGULAR QUERY
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!='') {
            $this->bind(":q_user_name", "%".$q_parameter['q_user_name']."%");//bind param for like query
        }
        if(isset($q_parameter['q_name']) && $q_parameter['q_name']!='') {
            $this->bind(":q_name", "%".$q_parameter['q_name']."%");//bind param for like query
        }
        if(isset($q_parameter['q_lastname']) && $q_parameter['q_lastname']!='') {
            $this->bind(":q_lastname", "%".$q_parameter['q_lastname']."%");//bind param for like query
        }
        if(isset($q_parameter['q_radusergroup_detail']) && $q_parameter['q_radusergroup_detail']!='') {
            $this->bind(":q_radusergroup_detail", $q_parameter['q_radusergroup_detail']);
        }
        //END BIND VALUE FOR REGULAR QUERY

       return $this->resultset();

    }
    public function findAllReportStatus($perpage=0, $q_parameter=array())
    {

        //if have param
        $data_bind_where = null;

        $query = "SELECT account.id AS id ";
        $query .=",account.user_name AS user_name ";
        $query .=",account.password AS password ";
        $query .=",account.radusergroup_detail AS radusergroup_detail ";
        $query .=",account.session_timeout AS session_timeout ";
        $query .=",account.idle_timeout AS idle_timeout ";
        $query .=",account.expired AS expired ";
        $query .=",account.unused_expired AS unused_expired ";
        $query .=",account.create_date AS create_date ";
        $query .=",account.unused_date AS unused_date ";
        $query .=",account.start_date AS start_date ";
        $query .=",account.expired_date AS expired_date ";
        $query .=",account.usagetime AS usagetime ";
        $query .=",account.remaintime AS remaintime ";
        $query .=",account.status AS status ";
        $query .=",account.unused_expired_hr AS unused_expired_hr ";
        $query .=",account.expired_hr AS expired_hr ";
        $query .=",account.mac AS mac ";
        $query .=",account.rate_limit AS rate_limit ";
        $query .=",account.description AS description ";
        $query .=",account.frame_ip AS frame_ip ";
        $query .=",account.prename AS prename ";
        $query .=",account.name AS name ";
        $query .=",account.lastname AS lastname ";
        $query .=",account.id_card AS id_card ";
        $query .=",account.address AS address ";
        $query .=",account.phonenumber AS phonenumber ";
        $query .=",account.email AS email ";
        $query .=",account.birthday AS birthday ";
        $query .=",account.enable_code_check AS enable_code_check ";
        $query .=",account.code_check AS code_check ";
        $query .=",account.information1 AS information1 ";
        $query .=",account.name_en AS name_en ";
        $query .=",account.lastname_en AS lastname_en ";
        $query .=",account.app_district AS app_district ";
        $query .=",account.enable_pass_first AS enable_pass_first ";
        $query .=",account.last_auth AS last_auth ";
        $query .=",account.resetdate_ofweek AS resetdate_ofweek ";
        $query .=",account.idenity AS idenity ";
        $query .=",account.create_from AS create_from ";
        $query .=",account.id_h_ref AS id_h_ref ";
        $query .=",account.user_session_id AS user_session_id ";
        $query .=",account.limittime AS limittime ";
        $query .=",account.flage AS flage ";
        $query .=",account.type AS type ";
        $query .=",account.plan_name AS plan_name ";
        $query .=",account.img_name AS img_name ";
        $query .=",account.created_user AS created_user ";
        $query .=",account.created_date AS created_date ";
        $query .=",account.updated_user AS updated_user ";
        $query .=",account.updated_date AS updated_date ";

        $query .=",radgroup_detail.groupname AS price_plan_name ";

        $query .=",IFNULL( ";
        $query .="( SELECT radacctid ";
        $query .="	FROM radacct ";
        $query .="  WHERE username=UPPER(user_name) ";
        $query .="  AND acctstoptime IS NULL LIMIT 1 ";
        $query .="),0)AS online_status ";

        $query .=",( SELECT MAX(r.authdate) ";
        $query .="	FROM radpostauth AS r ";
        $query .="  WHERE r.username=UPPER(user_name) ";
        $query .="  AND r.reply='Access-Accept' ";
        $query .=")AS last_post_authen ";

        $query .=",( ";
        $query .="	SELECT SUM(a.acctsessiontime) AS sum_time  ";
        $query .="	FROM radacct a ";
        $query .="	WHERE a.username = UPPER(user_name) ";
        $query .=") AS sum_usage_time_sec ";


        $query .="FROM account AS account ";
        $query .="LEFT JOIN  radgroup_detail AS radgroup_detail ";
        $query .="ON account.radusergroup_detail=radgroup_detail.id";


        //where query
        $query .=" WHERE account.id IS NOT NULL ";

        //START PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!=''){
            //for query concat
            $query .=" AND account.user_name LIKE :q_user_name  ";
            //for bind param
            $data_bind_where['q_user_name'] = "%".$q_parameter['q_user_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_name']) && $q_parameter['q_name']!=''){
            $query .=" AND account.name LIKE :q_name  ";
            //for bind param
            $data_bind_where['q_name'] = "%".$q_parameter['q_name']."%";//bind param for like query
        }
        if(isset($q_parameter['q_lastname']) && $q_parameter['q_lastname']!=''){
            $query .=" AND account.lastname LIKE :q_lastname  ";
            //for bind param
            $data_bind_where['q_lastname'] = "%".$q_parameter['q_lastname']."%";//bind param for like query
        }
        if(isset($q_parameter['q_radusergroup_detail']) && $q_parameter['q_radusergroup_detail']!=''){
            $query .=" AND account.radusergroup_detail =:q_radusergroup_detail ";
            //for bind param
            $data_bind_where['q_radusergroup_detail'] = $q_parameter['q_radusergroup_detail'];
        }
        //END PREPARE WHERE QUERY AND BIND VALUE FOR PAGING HELPER
        if(isset($q_parameter['q_online_status']) && $q_parameter['q_online_status']!=''){


            if($q_parameter['q_online_status']=="1"){
                $query .= " HAVING online_status>0 ";
            }else{
                $query .= " HAVING online_status=0 ";
            }
        }


        //PREPARE SORT ORDER
        if(isset($q_parameter['sortField']) && $q_parameter['sortField']!=""){

            $query .=" ORDER BY ".$q_parameter['sortField']." ";
        }else{
            $query .= " ORDER BY id ";
        }
        if(isset($q_parameter['sortMode']) && $q_parameter['sortMode']!=""){
            $query .=" ".$q_parameter['sortMode']." ";
        }else{
            $query .= " ASC ";
        }
        // END SORT ORDER


        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query, $perpage, $data_bind_where);
        }

        //regular query
        $this->query($query);

        //START BIND VALUE FOR REGULAR QUERY
        if(isset($q_parameter['q_user_name']) && $q_parameter['q_user_name']!='') {
            $this->bind(":q_user_name", "%".$q_parameter['q_user_name']."%");//bind param for like query
        }
        if(isset($q_parameter['q_name']) && $q_parameter['q_name']!='') {
            $this->bind(":q_name", "%".$q_parameter['q_name']."%");//bind param for like query
        }
        if(isset($q_parameter['q_lastname']) && $q_parameter['q_lastname']!='') {
            $this->bind(":q_lastname", "%".$q_parameter['q_lastname']."%");//bind param for like query
        }
        if(isset($q_parameter['q_radusergroup_detail']) && $q_parameter['q_radusergroup_detail']!='') {
            $this->bind(":q_radusergroup_detail", $q_parameter['q_radusergroup_detail']);
        }
        //END BIND VALUE FOR REGULAR QUERY



        return $this->resultset();

    }
    public function findById($id)
    {
        $query = "SELECT account.id AS id ";
        $query .=",account.user_name AS user_name ";
        $query .=",account.password AS password ";
        $query .=",account.radusergroup_detail AS radusergroup_detail ";
        $query .=",account.session_timeout AS session_timeout ";
        $query .=",account.idle_timeout AS idle_timeout ";
        $query .=",account.expired AS expired ";
        $query .=",account.unused_expired AS unused_expired ";
        $query .=",account.create_date AS create_date ";
        $query .=",account.unused_date AS unused_date ";
        $query .=",account.start_date AS start_date ";
        $query .=",account.expired_date AS expired_date ";
        $query .=",account.usagetime AS usagetime ";
        $query .=",account.remaintime AS remaintime ";
        $query .=",account.status AS status ";
        $query .=",account.unused_expired_hr AS unused_expired_hr ";
        $query .=",account.expired_hr AS expired_hr ";
        $query .=",account.mac AS mac ";
        $query .=",account.rate_limit AS rate_limit ";
        $query .=",account.description AS description ";
        $query .=",account.frame_ip AS frame_ip ";
        $query .=",account.prename AS prename ";
        $query .=",account.name AS name ";
        $query .=",account.lastname AS lastname ";
        $query .=",account.id_card AS id_card ";
        $query .=",account.address AS address ";
        $query .=",account.phonenumber AS phonenumber ";
        $query .=",account.email AS email ";
        $query .=",account.birthday AS birthday ";
        $query .=",account.enable_code_check AS enable_code_check ";
        $query .=",account.code_check AS code_check ";
        $query .=",account.information1 AS information1 ";
        $query .=",account.name_en AS name_en ";
        $query .=",account.lastname_en AS lastname_en ";
        $query .=",account.app_district AS app_district ";
        $query .=",account.enable_pass_first AS enable_pass_first ";
        $query .=",account.last_auth AS last_auth ";
        $query .=",account.resetdate_ofweek AS resetdate_ofweek ";
        $query .=",account.idenity AS idenity ";
        $query .=",account.create_from AS create_from ";
        $query .=",account.id_h_ref AS id_h_ref ";
        $query .=",account.user_session_id AS user_session_id ";
        $query .=",account.limittime AS limittime ";
        $query .=",account.flage AS flage ";
        $query .=",account.type AS type ";
        $query .=",account.plan_name AS plan_name ";
        $query .=",account.img_name AS img_name ";
        $query .=",account.created_user AS created_user ";
        $query .=",account.created_date AS created_date ";
        $query .=",account.updated_user AS updated_user ";
        $query .=",account.updated_date AS updated_date ";

        $query .=",IFNULL( ";
        $query .="( SELECT radacctid ";
        $query .="	FROM radacct ";
        $query .="  WHERE username=UPPER(user_name) ";
        $query .="  AND acctstoptime IS NULL LIMIT 1 ";
        $query .="),0)AS online_status ";

        $query .="FROM account AS account ";
        $query .="WHERE account.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $account = new Account($result);
            return $account;
        }
        return false;
    }
    public function findDetailById($id)
    {
        $query = "SELECT account.id AS id ";
        $query .=",account.user_name AS user_name ";
        $query .=",account.password AS password ";
        $query .=",account.radusergroup_detail AS radusergroup_detail ";
        $query .=",account.session_timeout AS session_timeout ";
        $query .=",account.idle_timeout AS idle_timeout ";
        $query .=",account.expired AS expired ";
        $query .=",account.unused_expired AS unused_expired ";
        $query .=",account.create_date AS create_date ";
        $query .=",account.unused_date AS unused_date ";
        $query .=",account.start_date AS start_date ";
        $query .=",account.expired_date AS expired_date ";
        $query .=",account.usagetime AS usagetime ";
        $query .=",account.remaintime AS remaintime ";
        $query .=",account.status AS status ";
        $query .=",account.unused_expired_hr AS unused_expired_hr ";
        $query .=",account.expired_hr AS expired_hr ";
        $query .=",account.mac AS mac ";
        $query .=",account.rate_limit AS rate_limit ";
        $query .=",account.description AS description ";
        $query .=",account.frame_ip AS frame_ip ";
        $query .=",account.prename AS prename ";
        $query .=",account.name AS name ";
        $query .=",account.lastname AS lastname ";
        $query .=",account.id_card AS id_card ";
        $query .=",account.address AS address ";
        $query .=",account.phonenumber AS phonenumber ";
        $query .=",account.email AS email ";
        $query .=",account.birthday AS birthday ";
        $query .=",account.enable_code_check AS enable_code_check ";
        $query .=",account.code_check AS code_check ";
        $query .=",account.information1 AS information1 ";
        $query .=",account.name_en AS name_en ";
        $query .=",account.lastname_en AS lastname_en ";
        $query .=",account.app_district AS app_district ";
        $query .=",account.enable_pass_first AS enable_pass_first ";
        $query .=",account.last_auth AS last_auth ";
        $query .=",account.resetdate_ofweek AS resetdate_ofweek ";
        $query .=",account.idenity AS idenity ";
        $query .=",account.create_from AS create_from ";
        $query .=",account.id_h_ref AS id_h_ref ";
        $query .=",account.user_session_id AS user_session_id ";
        $query .=",account.limittime AS limittime ";
        $query .=",account.flage AS flage ";
        $query .=",account.type AS type ";
        $query .=",account.plan_name AS plan_name ";
        $query .=",account.img_name AS img_name ";
        $query .=",account.created_user AS created_user ";
        $query .=",account.created_date AS created_date ";
        $query .=",account.updated_user AS updated_user ";
        $query .=",account.updated_date AS updated_date ";

        $query .=",radgroup_detail.groupname AS price_plan_name ";

        $query .=",IFNULL( ";
        $query .="( SELECT radacctid ";
        $query .="	FROM radacct ";
        $query .="  WHERE username=UPPER(user_name) ";
        $query .="  AND acctstoptime IS NULL LIMIT 1 ";
        $query .="),0)AS online_status ";

        $query .=",( ";
        $query .="	SELECT SUM(a.acctsessiontime) AS sum_time  ";
        $query .="	FROM radacct a ";
        $query .="	WHERE a.username = UPPER(user_name) ";
        $query .=") AS sum_usage_time_sec ";

        $query .=",( SELECT MAX(r.authdate) ";
        $query .="	FROM radpostauth AS r ";
        $query .="  WHERE r.username=UPPER(user_name) ";
        $query .="  AND r.reply='Access-Accept' ";
        $query .=")AS last_post_authen ";

        $query .="FROM account AS account ";
        $query .="LEFT JOIN  radgroup_detail AS radgroup_detail ";
        $query .="ON account.radusergroup_detail=radgroup_detail.id ";


        $query .="WHERE account.id=:id ";

        $this->query($query);
        $this->bind(":id", $id);
        $result =  $this->single();
        if($result){
            $account = new Account($result);
            return $account;
        }
        return false;
    }
    public function findDetailByUsername($username)
    {
        $query = "SELECT account.id AS id ";
        $query .=",account.user_name AS user_name ";
        $query .=",account.password AS password ";
        $query .=",account.radusergroup_detail AS radusergroup_detail ";
        $query .=",account.session_timeout AS session_timeout ";
        $query .=",account.idle_timeout AS idle_timeout ";
        $query .=",account.expired AS expired ";
        $query .=",account.unused_expired AS unused_expired ";
        $query .=",account.create_date AS create_date ";
        $query .=",account.unused_date AS unused_date ";
        $query .=",account.start_date AS start_date ";
        $query .=",account.expired_date AS expired_date ";
        $query .=",account.usagetime AS usagetime ";
        $query .=",account.remaintime AS remaintime ";
        $query .=",account.status AS status ";
        $query .=",account.unused_expired_hr AS unused_expired_hr ";
        $query .=",account.expired_hr AS expired_hr ";
        $query .=",account.mac AS mac ";
        $query .=",account.rate_limit AS rate_limit ";
        $query .=",account.description AS description ";
        $query .=",account.frame_ip AS frame_ip ";
        $query .=",account.prename AS prename ";
        $query .=",account.name AS name ";
        $query .=",account.lastname AS lastname ";
        $query .=",account.id_card AS id_card ";
        $query .=",account.address AS address ";
        $query .=",account.phonenumber AS phonenumber ";
        $query .=",account.email AS email ";
        $query .=",account.birthday AS birthday ";
        $query .=",account.enable_code_check AS enable_code_check ";
        $query .=",account.code_check AS code_check ";
        $query .=",account.information1 AS information1 ";
        $query .=",account.name_en AS name_en ";
        $query .=",account.lastname_en AS lastname_en ";
        $query .=",account.app_district AS app_district ";
        $query .=",account.enable_pass_first AS enable_pass_first ";
        $query .=",account.last_auth AS last_auth ";
        $query .=",account.resetdate_ofweek AS resetdate_ofweek ";
        $query .=",account.idenity AS idenity ";
        $query .=",account.create_from AS create_from ";
        $query .=",account.id_h_ref AS id_h_ref ";
        $query .=",account.user_session_id AS user_session_id ";
        $query .=",account.limittime AS limittime ";
        $query .=",account.flage AS flage ";
        $query .=",account.type AS type ";
        $query .=",account.plan_name AS plan_name ";
        $query .=",account.img_name AS img_name ";
        $query .=",account.created_user AS created_user ";
        $query .=",account.created_date AS created_date ";
        $query .=",account.updated_user AS updated_user ";
        $query .=",account.updated_date AS updated_date ";

        $query .=",radgroup_detail.groupname AS price_plan_name ";

        $query .=",IFNULL( ";
        $query .="( SELECT radacctid ";
        $query .="	FROM radacct ";
        $query .="  WHERE username=UPPER(user_name) ";
        $query .="  AND acctstoptime IS NULL LIMIT 1 ";
        $query .="),0)AS online_status ";

        $query .=",( ";
        $query .="	SELECT SUM(a.acctsessiontime) AS sum_time  ";
        $query .="	FROM radacct a ";
        $query .="	WHERE a.username = UPPER(user_name) ";
        $query .=") AS sum_usage_time_sec ";

        $query .=",( SELECT MAX(r.authdate) ";
        $query .="	FROM radpostauth AS r ";
        $query .="  WHERE r.username=UPPER(user_name) ";
        $query .="  AND r.reply='Access-Accept' ";
        $query .=")AS last_post_authen ";

        $query .="FROM account AS account ";
        $query .="LEFT JOIN  radgroup_detail AS radgroup_detail ";
        $query .="ON account.radusergroup_detail=radgroup_detail.id ";

        $query .="WHERE account.user_name=:user_name ";

        $this->query($query);
        $this->bind(":user_name", $username);
        $result =  $this->single();
        if($result){
            $account = new Account($result);
            return $account;
        }
        return false;
    }
    public function deleteById($id)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE id=:id";
        $this->query($query);
        $this->bind(":id", $id);
        return $this->execute();
    }
    public function createByArray($data_array)
    {
        return $this->insertHelper($this->tableName, $data_array);
    }
    public function createByObject($oject)
    {
        return $this->insertObjectHelper($oject);
    }
    public function update($data_array, $where_array, $whereType = 'AND')
    {
        return $this->updateHelper($this->tableName, $data_array, $where_array, $whereType);
    }
    public function updateByObject($object, $where_array, $whereType = 'AND')
    {
        return $this->updateObjectHelper($object, $where_array, $whereType);
    }

}