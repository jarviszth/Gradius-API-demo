<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface RadusergroupServiceInterface extends BaseServiceInterface
{
    public function findByUsername($username);
}