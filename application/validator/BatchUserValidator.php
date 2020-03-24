<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\BatchUser as BatchUser;
class BatchUserValidator extends BaseValidate
{
    public function __construct(BatchUser $batchUser)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $batchUser;
        $this->validateField('batch', self::VALIDATE_REQUIRED);
        $this->validateField('account', self::VALIDATE_REQUIRED);
        $this->validateField('user_name', self::VALIDATE_REQUIRED);
        $this->validateField('password', self::VALIDATE_REQUIRED);
        $this->validateField('start_date', self::VALIDATE_REQUIRED);
        $this->validateField('expired_date', self::VALIDATE_REQUIRED);
        $this->validateField('status', self::VALIDATE_REQUIRED);
        $this->validateField('rate_limit', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($batchUser->getPrice < $batchUser->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}