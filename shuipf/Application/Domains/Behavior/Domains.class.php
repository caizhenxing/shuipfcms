<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 模块绑定域名
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Domains\Behavior;

class Domains {

    public function app_init($param) {
        $Domains_list = cache('Domains_list');
        $domain = $_SERVER['HTTP_HOST'];
        if ($Domains_list[$domain]) {
            C('DEFAULT_MODULE', $Domains_list[$domain]);
        }
    }

}
