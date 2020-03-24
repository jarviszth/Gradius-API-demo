<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\CnfRadius as CnfRadius;
class CnfRadiusValidator extends BaseValidate
{
    public function __construct(CnfRadius $cnfRadius)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $cnfRadius;
        $this->validateField('ip_radius', self::VALIDATE_REQUIRED);
        $this->validateField('secrete_redius', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($cnfRadius->getPrice < $cnfRadius->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}