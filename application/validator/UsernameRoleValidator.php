<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\UsernameRole as UsernameRole;
class UsernameRoleValidator extends BaseValidate
{
    public function __construct(UsernameRole $usernameRole)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $usernameRole;
        $this->validateField('name_lenght', self::VALIDATE_INT);
        $this->validateField('mix_no', self::VALIDATE_REQUIRED);
        $this->validateField('special_char', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($usernameRole->getPrice < $usernameRole->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}