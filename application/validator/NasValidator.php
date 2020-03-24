<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\Nas as Nas;
class NasValidator extends BaseValidate
{
    public function __construct(Nas $nas)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $nas;
        $this->validateField('nasname', self::VALIDATE_REQUIRED);
        $this->validateField('shortname', self::VALIDATE_REQUIRED);
        $this->validateField('type', self::VALIDATE_REQUIRED);
        $this->validateField('ports', self::VALIDATE_REQUIRED);
        $this->validateField('secret', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($nas->getPrice < $nas->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}