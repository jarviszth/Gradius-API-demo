<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface RadcheckServiceInterface extends BaseServiceInterface
{
    public function findByUsername($username);
    public function findByUsernameAndPassword($username,$passwd);
}