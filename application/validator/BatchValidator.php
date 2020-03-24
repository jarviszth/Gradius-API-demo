<?php
namespace application\validator;

use application\controller\BatchController;
use application\core\AppBaseValidator as BaseValidate;
use application\model\Batch as Batch;
use application\util\AppUtil;

class BatchValidator extends BaseValidate
{
    public function __construct(Batch $batch)
    {
        //call parent construct
        parent::__construct();
        $this->objToValidate = $batch;
        $this->validateField('batch_name', self::VALIDATE_REQUIRED);
        $this->validateField('descriptions', self::VALIDATE_REQUIRED);
        $this->validateField('volume', self::VALIDATE_REQUIRED);
        $this->validateField('radusergroup_detail', self::VALIDATE_REQUIRED);

        if($batch->getVolume()<=0){
            $this->addError('volume', 'volume must gretter than 0');
        }
        $lengtOfVolume = strlen($batch->getVolume());
        if($lengtOfVolume>3){
            $this->addError('volume', 'volume can not gretter than 999');
        }
        if($batch->getUsernameLenght()==0 && AppUtil::isEmpty($batch->getUsernamePrefix())){
            $this->addError('username_prefix', 'Prefix can not be empty.');
        }
        if($batch->getPasswordType()== BatchController::$PWD_TYPE_FIX && AppUtil::isEmpty($batch->getFixPasswordText())){
            $this->addError('fix_password_text', 'Prefix can not be empty.');
        }

        //Custom Validate
        /*
        if($batch->getPrice < $batch->getDiscount){
          $this->addError('price', 'Price Cant Must than Discount');
        }
        */
    }
}