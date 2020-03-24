<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\AppDistrict as AppDistrict;
class AppDistrictValidator extends BaseValidate
{
    public function __construct(AppDistrict $appDistrict)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $appDistrict;
        $this->validateField('code', self::VALIDATE_REQUIRED);
        $this->validateField('name', self::VALIDATE_REQUIRED);
        $this->validateField('app_amphur', self::VALIDATE_REQUIRED);
        $this->validateField('zipcode', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($appDistrict->getPrice < $appDistrict->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}