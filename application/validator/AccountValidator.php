<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\Account as Account;
use application\util\AppUtil as AppUtil;
use application\util\FilterUtils as FilterUtil;

class AccountValidator extends BaseValidate
{
    public function __construct(Account $account)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $account;
        $this->validateField('user_name', self::VALIDATE_REQUIRED);
        $this->validateField('radusergroup_detail', self::VALIDATE_REQUIRED);
        //Custom Validate
        if(AppUtil::isEmpty(FilterUtil::filterPostString('pr'))){
          $this->addError('pr', 'You must provide Password Field. Please try again');
        }
    }
}