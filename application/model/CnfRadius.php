<?php
namespace application\model;

use application\core\AppModel as BaseModel;
class CnfRadius extends BaseModel
{
    public static $tableName = 'cnf_radius';

    private $ip_radius;
    private $secrete_redius;

    /*optional field*/

    public function __construct($data = array())
    { 
        /* init data type for field*/
        $this->setTableField(array(
            'id' => self::TYPE_AUTO_INCREMENT,
            'ip_radius' => self::TYPE_STRING,
            'secrete_redius' => self::TYPE_STRING,
        )); 
 
        /* init data type for field use in update mode*/
        $this->setTableFieldForEdit(array(
            'ip_radius' => self::TYPE_STRING,
            'secrete_redius' => self::TYPE_STRING,

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
    public function getIpRadius()
    { 
        return $this->ip_radius;
    }

    /**
     * @param mixed $ip_radius
     */
    public function setIpRadius($ip_radius)
    {
        $this->ip_radius = $ip_radius;
    }

    /**
     * @return mixed
     */
    public function getSecreteRedius()
    { 
        return $this->secrete_redius;
    }

    /**
     * @param mixed $secrete_redius
     */
    public function setSecreteRedius($secrete_redius)
    {
        $this->secrete_redius = $secrete_redius;
    }

}