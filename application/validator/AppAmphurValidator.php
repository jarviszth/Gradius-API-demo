<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\AppAmphur as AppAmphur;
class AppAmphurValidator extends BaseValidate
{
    public function __construct(AppAmphur $appAmphur)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $appAmphur;
        $this->validateField('code', self::VALIDATE_REQUIRED);
        $this->validateField('name', self::VALIDATE_REQUIRED);
        $this->validateField('name_eng', self::VALIDATE_REQUIRED);
        $this->validateField('app_province', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($appAmphur->getPrice < $appAmphur->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}