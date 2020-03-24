<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface RadgroupcheckServiceInterface extends BaseServiceInterface
{
    public function findByGroupName($gropuName);
}