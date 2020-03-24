<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\AppBaseValidator;
use application\model\Radacct;
class RadacctValidator extends AppBaseValidator
{
    public function __construct(Radacct $radacct)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $radacct;
        $this->validateField('radacctid', self::VALIDATE_REQUIRED);
        $this->validateField('acctsessionid', self::VALIDATE_REQUIRED);
        $this->validateField('acctuniqueid', self::VALIDATE_REQUIRED);
        $this->validateField('username', self::VALIDATE_REQUIRED);
        $this->validateField('nasipaddress', self::VALIDATE_REQUIRED);
        $this->validateField('acctstarttime', self::VALIDATE_DATE_TIME);
        $this->validateField('acctupdatetime', self::VALIDATE_DATE_TIME);
        $this->validateField('acctstoptime', self::VALIDATE_DATE_TIME);
        $this->validateField('acctinterval', self::VALIDATE_INT);
        $this->validateField('acctsessiontime', self::VALIDATE_INT);
        $this->validateField('calledstationid', self::VALIDATE_REQUIRED);
        $this->validateField('callingstationid', self::VALIDATE_REQUIRED);
        $this->validateField('acctterminatecause', self::VALIDATE_REQUIRED);
        $this->validateField('framedipaddress', self::VALIDATE_REQUIRED);

        //Custom Validate
        /*
        if($radacct->getPrice < $radacct->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}