<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface RadgroupreplyServiceInterface extends BaseServiceInterface
{
    public function findByGroupName($gropuName);
}