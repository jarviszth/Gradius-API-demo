<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\AttributeAll as AttributeAll;
class AttributeAllValidator extends BaseValidate
{
    public function __construct(AttributeAll $attributeAll)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $attributeAll;
        $this->validateField('attribute', self::VALIDATE_REQUIRED);
        $this->validateField('attribute_name', self::VALIDATE_REQUIRED);
        $this->validateField('type_value', self::VALIDATE_REQUIRED);
        $this->validateField('type_checkreply', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($attributeAll->getPrice < $attributeAll->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}