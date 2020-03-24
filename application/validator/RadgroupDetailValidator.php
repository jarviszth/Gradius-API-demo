<?php
namespace application\validator;

use application\core\AppBaseValidator as BaseValidate;
use application\model\RadgroupDetail as RadgroupDetail;
class RadgroupDetailValidator extends BaseValidate
{
    public function __construct(RadgroupDetail $radgroupDetail)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $radgroupDetail;
        $this->validateField('groupname', self::VALIDATE_REQUIRED);
        $this->validateField('group_detail', self::VALIDATE_REQUIRED);
        //Custom Validate
        /*
        if($radgroupDetail->getPrice < $radgroupDetail->getDiscount){
          $this->addError('price', 'Price Can't Must than Discount');
        }
        */
    }
}