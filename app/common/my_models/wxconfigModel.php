<?php
/**
 * 微信管理
 */

namespace Ypk\MyModels;

use Ypk\Model;
use Ypk\Db;
use Ypk\Tpl;

class wxconfigModel extends Model{
    public function __construct() {
        parent::__construct('wechat_config');
    }
}