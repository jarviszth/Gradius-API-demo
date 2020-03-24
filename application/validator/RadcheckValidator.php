<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\validator;

use application\core\AppBaseValidator;
use application\model\Radcheck;
class RadcheckValidator extends AppBaseValidator
{
    public function __construct(Radcheck $radcheck)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $radcheck;
        $this->validateField('username', self::VALIDATE_REQUIRED);
        $this->validateField('attribute', self::VALIDATE_REQUIRED);
        $this->validateField('op', self::VALIDATE_REQUIRED);
        $this->validateField('value', self::VALIDATE_REQUIRED);

        //Custom Validate
        /*
        if($radcheck->getPrice < $radcheck->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}