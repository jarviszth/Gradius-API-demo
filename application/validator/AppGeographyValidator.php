<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\AppGeography as AppGeography;
class AppGeographyValidator extends BaseValidate
{
    public function __construct(AppGeography $appGeography)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $appGeography;
        $this->validateField('name', self::VALIDATE_REQUIRED);
        $this->validateField('name_eng', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($appGeography->getPrice < $appGeography->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}