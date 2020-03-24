<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\AppProvince as AppProvince;
class AppProvinceValidator extends BaseValidate
{
    public function __construct(AppProvince $appProvince)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $appProvince;
        $this->validateField('code', self::VALIDATE_REQUIRED);
        $this->validateField('name', self::VALIDATE_REQUIRED);
        $this->validateField('name_eng', self::VALIDATE_REQUIRED);
        $this->validateField('app_geography', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($appProvince->getPrice < $appProvince->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}