<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface AttributeAllServiceInterface extends BaseServiceInterface
{
    public function findByAttributeName($att);
}