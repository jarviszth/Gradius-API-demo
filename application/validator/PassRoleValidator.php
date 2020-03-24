<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\PassRole as PassRole;
class PassRoleValidator extends BaseValidate
{
    public function __construct(PassRole $passRole)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $passRole;
        $this->validateField('pass_lenght', self::VALIDATE_INT);
        $this->validateField('mix_no', self::VALIDATE_REQUIRED);
        $this->validateField('special_char', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($passRole->getPrice < $passRole->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}