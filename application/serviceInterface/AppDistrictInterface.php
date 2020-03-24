<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface AppDistrictServiceInterface extends BaseServiceInterface
{
    public function findDistrictListByAmphur($amphurId);
}