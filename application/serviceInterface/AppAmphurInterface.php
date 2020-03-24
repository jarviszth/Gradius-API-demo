<?php
namespace application\serviceInterface;

use application\core\AppBaseInterface as BaseServiceInterface;
interface AppAmphurServiceInterface extends BaseServiceInterface
{
    public function findAmphurByProvinceList($provinveId);
}