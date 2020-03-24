<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\AppBaseValidator;
use application\model\Radgroupreply;
class RadgroupreplyValidator extends AppBaseValidator
{
    public function __construct(Radgroupreply $radgroupreply)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $radgroupreply;
        $this->validateField('groupname', self::VALIDATE_REQUIRED);
        $this->validateField('attribute', self::VALIDATE_REQUIRED);
        $this->validateField('op', self::VALIDATE_REQUIRED);
        $this->validateField('value', self::VALIDATE_REQUIRED);

        //Custom Validate
        /*
        if($radgroupreply->getPrice < $radgroupreply->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}