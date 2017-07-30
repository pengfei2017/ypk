<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 23:40
 */

namespace Ypk\MyModels;

use Ypk\Model;
use Ypk\Db;
use Ypk\Tpl;
/**
 * 微信管理
 */
class invite_logModel extends Model{
    public function __construct() {
        parent::__construct('invite_log');
    }

}