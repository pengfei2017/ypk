<?php

/**
 * 公共方法
 */

/**
 * 获得当前请求的模块，控制器和action名称
 * @return array
 */
function getUrlParamArray()
{
    $url_param_array = array(
        'module' => 'shop',
        'controller' => 'index',
        'action' => 'index',
    );

    if (isset($GLOBALS['di'])) {
        $di = $GLOBALS['di'];
        $dispatcher = $di->getShared('dispatcher');
        if ($dispatcher instanceof \Phalcon\Mvc\Dispatcher) {
            $module = $dispatcher->getModuleName();
            $controller = $dispatcher->getControllerName();
            $action = $dispatcher->getActionName();
            $url_param_array = array(
                'module' => $module,
                'controller' => $controller,
                'action' => $action,
            );
        }
    }

    return $url_param_array;
}

/**
 * 输出聊天信息
 *
 * @param $layout
 * @return string
 */
function getChat($layout)
{
    if (!getConfig('node_chat') || !class_exists('\Ypk\Chat')) {
        return '';
    }
    return \Ypk\Chat::getChatHtml($layout);
}

/**
 * hpf
 *
 * 把字符串转成UTF-8编码
 *
 * @param $content
 * @return string
 */
function str_to_utf8($content)
{
    $encode = mb_detect_encoding($content, array("ASCII", "EUC-CN", "GB2312", 'UTF-8', "GBK", 'BIG5')); //EUC-CN是GB2312最常用的表示方法
    if ($encode != 'UTF-8') {
        $content = mb_convert_encoding($content, 'UTF-8', $encode);
    }
    return $content;
}

/**
 * hpf
 * 检测FORM是否提交
 * @param boolean $check_token 是否验证token
 * @param boolean $check_captcha 是否验证验证码
 * @param string $return_type 'alert','num'
 * @return mixed
 */
function chksubmit($check_token = false, $check_captcha = false, $return_type = 'alert')
{
    $submit = isset($_POST['form_submit']) ? $_POST['form_submit'] : (isset($_GET['form_submit']) ? $_GET['form_submit'] : null);
    if (empty($submit) || $submit != 'ok') return false;
    if ($check_token && !\Ypk\Security::checkToken()) {
        if ($return_type == 'alert') {
            return 'token_error';
        } else {
            return -11;
        }
    }
    if ($check_captcha) {
        if (!checkSeccode($_POST['hash'], $_POST['captcha'])) {
            setMyCookie('seccode' . $_POST['hash'], '', -3600);
            if ($return_type == 'alert') {
                return 'seccode_error';
            } else {
                return -12;
            }
        }
        setMyCookie('seccode' . $_POST['hash'], '', -3600);
    }
    return true;
}

/**
 * 取得系统配置信息
 *
 * @param string $key 取得下标值
 * @return mixed
 */
function getConfig($key)
{
    if (strpos($key, '.') !== false) {
        $key = explode('.', $key);
        if (isset($key[5])) {
            if (isset($GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]][$key[3]][$key[4]][$key[5]])) {
                return $GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]][$key[3]][$key[4]][$key[5]];
            } else {
                return null;
            }
        } elseif (isset($key[4])) {
            if (isset($GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]][$key[3]][$key[4]])) {
                return $GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]][$key[3]][$key[4]];
            } else {
                return null;
            }
        } elseif (isset($key[3])) {
            if (isset($GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]][$key[3]])) {
                return $GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]][$key[3]];
            } else {
                return null;
            }
        } elseif (isset($key[2])) {
            if (isset($GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]])) {
                return $GLOBALS['setting_config'][$key[0]][$key[1]][$key[2]];
            } else {
                return null;
            }
        } else {
            if (isset($GLOBALS['setting_config'][$key[0]][$key[1]])) {
                return $GLOBALS['setting_config'][$key[0]][$key[1]];
            } else {
                return null;
            }
        }
    } else {
        if (isset($GLOBALS['setting_config'][$key])) {
            return $GLOBALS['setting_config'][$key];
        } else {
            if (isset($GLOBALS['global_config'][$key])) {
                return $GLOBALS['global_config'][$key];
            } else {
                return null;
            }
        }
    }
}

/**
 * 加密函数
 *
 * @param string $text 需要加密的字符串
 * @param string $key 密钥
 * @return string 返回加密结果
 */
function encrypt($text, $key = '')
{
    if (empty($text)) return $text;
    if (empty($key)) $key = md5(MD5_KEY);
    $crypt = new \Phalcon\Crypt();
    return $crypt->encryptBase64($text, $key);
}

/**
 * 解密函数
 *
 * @param string $text 需要解密的字符串
 * @param string $key 密匙
 * @return string 字符串类型的返回结果
 */
function decrypt($text, $key = '')
{
    if (empty($text)) return $text;
    if (empty($key)) $key = md5(MD5_KEY);

    $crypt = new \Phalcon\Crypt();
    return $crypt->decryptBase64($text, $key);
}

/**
 * hpf
 *
 * 不显示信息直接跳转
 *
 * @param string $url
 */
function redirect($url = '')
{
    if (empty($url)) {
        if (!empty($_REQUEST['ref_url'])) {
            $url = $_REQUEST['ref_url'];
        } else {
            $url = getReferer();
        }
    }
    header('Location: ' . $url);
    exit();
}

/**
 * 取上一步来源地址
 *
 * @param
 * @return string 字符串类型的返回结果
 */
function getReferer()
{
    //该方法只有通过点击页面进来的才有效
    if (isset($_SERVER['HTTP_REFERER'])) {
        return str_replace(array('\'', '"', '<', '>'), '', $_SERVER['HTTP_REFERER']);
    }
    return '';
}

/**
 * 取验证码hash值
 *
 * @param string $controller
 * @param string $action
 * @return string 字符串类型的返回结果
 */
function getHash($controller, $action)
{
    if (getConfig('captcha_status_login')) {
        return substr(md5(SHOP_SITE_URL . $controller . $action), 0, 8);
    } else {
        return '';
    }
}

/**
 * 产生验证码
 *
 * @param string $hash 哈希数
 * @return string
 */
function makeSeccode($hash)
{
    $seccode = random(6, 1);
    $seccodeunits = '';

    $s = sprintf('%04s', base_convert($seccode, 10, 23));
    $seccodeunits = 'ABCEFGHJKMPRTVXY2346789';
    if ($seccodeunits) {
        $seccode = '';
        for ($i = 0; $i < 4; $i++) {
            $unit = ord($s{$i});
            $seccode .= ($unit >= 0x30 && $unit <= 0x39) ? $seccodeunits[$unit - 0x30] : $seccodeunits[$unit - 0x57];
        }
    }
    setMyCookie('seccode', encrypt(strtoupper($seccode) . "\t" . time(), MD5_KEY), 3600);
    return $seccode;
}

/**
 * 验证验证码
 *
 * @param string $hash 浏览器提交的hash值
 * @param string $value 浏览器提交的验证码值
 * @return boolean
 */
function checkSeccode($hash, $value)
{
    list($checkvalue, $checktime) = explode("\t", decrypt(cookie('seccode'), MD5_KEY));
    $return = $checkvalue == strtoupper($value);
    if (!$return) setMyCookie('seccode', '', -3600);
    return $return;
}

/**
 * 设置cookie
 *
 * @param string $name cookie 的名称
 * @param mixed $value cookie 的值
 * @param int $expire cookie 有效周期
 * @param string $path cookie 的服务器路径 默认为 /
 * @param string $domain cookie 的域名
 * @param boolean $secure 是否通过安全的 HTTPS 连接来传输 cookie,默认为false
 */
function setMyCookie($name, $value, $expire = 3600, $path = '/', $domain = FIRST_LEVEL_DOMAIN_NAME, $secure = false)
{
    if (empty($path)) $path = '/';
    if (empty($domain)) $domain = SUBDOMAIN_SUFFIX ? SUBDOMAIN_SUFFIX : '';
    //$name = defined('COOKIE_PRE') ? COOKIE_PRE . $name : strtoupper(substr(md5(MD5_KEY), 0, 4)) . '_' . $name;
    $expire = intval($expire) ? intval($expire) : (intval(SESSION_EXPIRE) ? intval(SESSION_EXPIRE) : 3600);
    $crypt = new \Phalcon\Crypt();
    //phalcon的cookie默认采用了加密，为了可以和phalcon自带的coolie操作函数保持一致，能够互相加解密，这里采用和phalcon的cookie同样的加解密函数
    $result = setcookie($name, $crypt->encryptBase64(strval($value), MD5_KEY), time() + $expire, $path, $domain, $secure);
    $_COOKIE[$name] = $value;
}

/**
 * 取得COOKIE的值
 *
 * @param string $name
 * @return mixed
 */
function cookie($name = '')
{
    if (isset($_COOKIE[$name])) {
        //$name = defined('COOKIE_PRE') ? COOKIE_PRE . $name : strtoupper(substr(md5(MD5_KEY), 0, 4)) . '_' . $name;
        $crypt = new \Phalcon\Crypt();
        //phalcon的cookie默认采用了加密，为了可以和phalcon自带的coolie操作函数保持一致，能够互相加解密，这里采用和phalcon的cookie同样的加解密函数
        $value = $crypt->decryptBase64(strval($_COOKIE[$name]), MD5_KEY);
        return is_numeric($value) ? floatval($value) : $value;
    } else {
        return null;
    }
}

/**
 * 删除cookie
 *
 * @param string $name cookie 的名称
 * @param string $path cookie 的服务器路径 默认为 /
 * @param string $domain cookie 的域名
 * @param boolean $secure 是否通过安全的 HTTPS 连接来传输 cookie,默认为false
 */
function deleteMyCookie($name, $path = '/', $domain = FIRST_LEVEL_DOMAIN_NAME, $secure = false)
{
    if (empty($domain)) $domain = SUBDOMAIN_SUFFIX ? SUBDOMAIN_SUFFIX : '';
    //$name = defined('COOKIE_PRE') ? COOKIE_PRE . $name : strtoupper(substr(md5(MD5_KEY), 0, 4)) . '_' . $name;
    $result = setcookie($name, null, time() - 31536000, $path, $domain, $secure);
    $_COOKIE[$name] = null;
}

/**
 * 取得随机数
 *
 * @param int $length 生成随机数的长度
 * @param int $numeric 是否只产生数字随机数 1是0否
 * @return string
 */
function random($length, $numeric = 0)
{
    $seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
    $hash = '';
    $max = strlen($seed) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $seed{mt_rand(0, $max)};
    }
    return $hash;
}

/**
 * 获取当前域名的网址
 */
function getDomainName()
{
    if ($_SERVER["SERVER_PORT"] != 80) {
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"];
    } else {
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
    }
    return $url;
}

/**
 * hpf
 *
 * 正则匹配文章内容中的url地址和关键字，自动给它们添加<a>链接
 *
 * @param $foo
 * @return string
 */
function autolink($foo)
{
    $foo = preg_replace('/(((f|ht){1}tp:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\1" target=_blank rel=nofollow style=text-decoration:underline;color:#0072C1;>\1</a>', $foo);
    if (strpos($foo, "http") === FALSE) {
        $foo = preg_replace('/(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="http://\1" target=_blank rel=nofollow style=text-decoration:underline;color:#0072C1;>\1</a>', $foo);
    } else {
        $foo = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\1<a href="http://\2" target=_blank rel=nofollow style=text-decoration:underline;color:#0072C1;>\2</a>', $foo);
    }
    return $foo;
}

/**
 * 把条件数组转为条件字符串
 *
 * @param array $paramarray
 * @return string
 */
function getConditionsByParamArray($paramarray)
{
    $conditions = '';
    if (is_array($paramarray) && !empty($paramarray)) {
        foreach (array_keys($paramarray) as $key) {
            $conditions .= $key . ' = :' . $key . ': and ';
        }
        $conditions = substr($conditions, 0, strlen($conditions) - 5);
    }
    return $conditions; //查询条件为空
}

/**
 * 获取用户选择的语言或者浏览器设置的默认语言
 *
 * 该方法相当于phalcon的$this->request->getBestLanguage()方法
 */
function getBestLanguage()
{
    //看cookie中是否有用户选择的语言
    if (!empty(cookie('language'))) {
        $language = cookie('language');
    } else {
        //查看浏览器设置的默认语言
        //zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $languageArr = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $language = $languageArr[0];
        } else {
            $language = 'zh-CN';
        }
    }

    $language = strtolower($language);
    $language = str_replace('-', '_', $language);

    if (empty($language)) {
        $language = 'zh_cn';
    }

    return $language;

}

/**
 * @param string $filenames //翻译文件的名称
 * @return \Phalcon\Translate\Adapter\NativeArray
 */
function getTranslation($filenames = null)
{
    if (!empty($filenames)) {
        $filenames = str_replace('，', ',', $filenames);
        $tmp = explode(',', $filenames);

        $language = getBestLanguage();

        //语言数组
        $language_content = array();

        foreach ($tmp as $v) {

            $lang = array();

            // 检查是否有该语言的翻译文件
            if (file_exists(MODULE_LANGUAGE_PATH . "/" . $language . "/" . $v . ".php")) {
                require MODULE_LANGUAGE_PATH . "/" . $language . "/" . $v . ".php";
            }

            if (!empty($language_content) && is_array($language_content)) {
                $language_content = array_merge($language_content, $lang);
            } else {
                $language_content = $lang;
            }
            unset($lang);
        }

        //合并已有的语言包数组
        $old_lang = isset($GLOBALS['lang']) ? $GLOBALS['lang'] : array();
        if (!empty($old_lang) && is_array($old_lang)) {
            $language_content = array_merge($language_content, $old_lang);
        }
        unset($old_lang);

        // 返回一个翻译对象
        $GLOBALS['lang'] = $language_content;

        $translation = new \Phalcon\Translate\Adapter\NativeArray(
            array(
                "content" => $language_content
            )
        );

        if (isset($GLOBALS['di']['view']) && $GLOBALS['di']['view'] instanceof \Phalcon\Mvc\View) {
            $GLOBALS['di']['view']->setVar('lang', $translation);
        }

    } else {
        //读取已有的语言包数组
        $old_lang = isset($GLOBALS['lang']) ? $GLOBALS['lang'] : array();
        $translation = new \Phalcon\Translate\Adapter\NativeArray(
            array(
                "content" => $old_lang
            )
        );
    }

    return $translation;
}

/**
 * hpf
 *
 * 快速调用语言包
 *
 * @param string $key
 * @return string
 */
function getLang($key = '')
{
    if (isset($GLOBALS['lang'])) {
        if (strpos($key, ',') !== false) {
            $tmp = explode(',', $key);
            $str = $GLOBALS['lang'][$tmp[0]] . $GLOBALS['lang'][$tmp[1]];
            if (isset($tmp[2])) {
                $str .= $GLOBALS['lang'][$tmp[2]];
            }
            if (isset($tmp[3])) {
                $str .= $GLOBALS['lang'][$tmp[3]];
            }
            if (isset($tmp[4])) {
                $str .= $GLOBALS['lang'][$tmp[4]];
            }
            if (isset($tmp[5])) {
                $str .= $GLOBALS['lang'][$tmp[5]];
            }

            return $str;
        } else {
            return $GLOBALS['lang'][$key];
        }
    } else {
        return null;
    }
}

/**
 * hpf
 *
 * 文件缓存 读
 *
 * 使用注意：如果$cacheKey中带有路径信息，那么传值时$dir就必须为空
 * 如果$dir有值，那么$cacheKey中就绝对不能带有路径信息
 *
 * @param string $cacheKey //缓存名称 警告，看清使用的参数说明，第一个是key,不能是带‘/’的路径，只能是字母数字和下划线
 * @param bool $callback //如果Ypk\UserCallback类中有相应回调函数，是否调用回调函数
 * @param int $expire //缓存时间 单位秒 默认 31536000 是 一年
 * @param string $dir 缓存到哪个文件夹 如果不为空，最后一个‘/’必须加上
 * @return array
 * @throws Exception
 */
function read_file_cache($cacheKey, $callback = false, $expire = null, $dir = 'config/')
{
    if (strpos($cacheKey, '/') !== false) {
        $cacheKey_arr = explode('/', $cacheKey);
        $cacheKey = end($cacheKey_arr);
        $arr_len = count($cacheKey_arr);
        unset($cacheKey_arr[$arr_len - 1]);
        $dir = '';
        foreach ($cacheKey_arr as $cacheKey_arr_ele) {
            $dir .= $cacheKey_arr_ele . '/';
        }
    }

    if (empty($expire)) {
        $expire = 31536000;
    }

    $frontCache = new \Phalcon\Cache\Frontend\Data(
        array(
            "lifetime" => $expire
        )
    );

    //缓存文件的存放路径
    $cache_path = $GLOBALS['config']['application']['cacheDir'] . $dir;
    if (!realpath($cache_path)) {
        //如果路径不存在，就创建
        mkDirs($cache_path);
    }

    $cache = new \Phalcon\Cache\Backend\File(
        $frontCache,
        array(
            "cacheDir" => $cache_path
        )
    );

    $value = $cache->get($cacheKey);
    if (empty($value) && $callback !== false) {
        if ($callback === true) {
            $usercallback = new Ypk\UserCallback(); //UserCallback里的静态方法不需要实例化该类，如是调用非静态方法，需要先实例化出对象
            $callback = array($usercallback, 'call');
        }

        if (!is_callable($callback)) {
            throw new Exception('无效的回调函数!');
        }

        $value = call_user_func($callback, $cacheKey);
        $cache->save($cacheKey, $value);
    }

    return $value;
}

/**
 * hpf
 *
 * 文件缓存 写
 *
 * 使用注意：如果$cacheKey中带有路径信息，那么传值时$dir就必须为空
 * 如果$dir有值，那么$cacheKey中就绝对不能带有路径信息
 *
 * 使用注意：如果$cacheKey中带有路径信息，那么传值时$dir就必须为空
 * 如果$dir有值，那么$cacheKey中就绝对不能带有路径信息
 *
 * @param string $cacheKey 缓存名称
 * @param mixed $value 缓存数据 若设为否 则下次读取该缓存时会触发回调（如果有）
 * @param int $expire 缓存时间 单位秒 默认 31536000 是 一年
 * @param string $dir 缓存到哪个文件夹 如果不为空，最后一个‘/’必须加上
 * @return boolean
 */
function write_file_cache($cacheKey, $value, $expire = null, $dir = 'config/')
{
    if (strpos($cacheKey, '/') !== false) {
        $cacheKey_arr = explode('/', $cacheKey);
        $cacheKey = end($cacheKey_arr);
        $arr_len = count($cacheKey_arr);
        unset($cacheKey_arr[$arr_len - 1]);
        $dir = '';
        foreach ($cacheKey_arr as $cacheKey_arr_ele) {
            $dir .= $cacheKey_arr_ele . '/';
        }
    }

    if (empty($expire)) {
        $expire = 31536000;
    }

    $frontCache = new \Phalcon\Cache\Frontend\Data(
        array(
            "lifetime" => $expire
        )
    );

    //缓存文件的存放路径
    $cache_path = $GLOBALS['config']['application']['cacheDir'] . $dir;
    if (!realpath($cache_path)) {
        //如果路径不存在，就创建
        mkDirs($cache_path);
    }

    $cache = new \Phalcon\Cache\Backend\File(
        $frontCache,
        array(
            "cacheDir" => $cache_path
        )
    );

    return $cache->save($cacheKey, $value);
}

/**
 * hpf
 *
 * 文件缓存 删
 *
 * 使用注意：如果$cacheKey中带有路径信息，那么传值时$dir就必须为空
 * 如果$dir有值，那么$cacheKey中就绝对不能带有路径信息
 *
 * 使用注意：如果$cacheKey中带有路径信息，那么传值时$dir就必须为空
 * 如果$dir有值，那么$cacheKey中就绝对不能带有路径信息
 *
 * @param string $cacheKey 缓存名称
 * @param string $dir 缓存到哪个文件夹 如果不为空，最后一个‘/’必须加上
 * @return boolean
 */
function delete_file_cache($cacheKey, $dir = 'config/')
{
    if (strpos($cacheKey, '/') !== false) {
        $cacheKey_arr = explode('/', $cacheKey);
        $cacheKey = end($cacheKey_arr);
        $arr_len = count($cacheKey_arr);
        unset($cacheKey_arr[$arr_len - 1]);
        $dir = '';
        foreach ($cacheKey_arr as $cacheKey_arr_ele) {
            $dir .= $cacheKey_arr_ele . '/';
        }
    }

    $frontCache = new \Phalcon\Cache\Frontend\Data(
        array(
            "lifetime" => 31536000 //一年
        )
    );

    //缓存文件的存放路径
    $cache_path = $GLOBALS['config']['application']['cacheDir'] . $dir;
    if (!realpath($cache_path)) {
        //如果路径不存在，就直接返回true,文件夹都不存在，不用删除了
        return true;
    }

    $cache = new \Phalcon\Cache\Backend\File(
        $frontCache,
        array(
            "cacheDir" => $cache_path
        )
    );

    return $cache->delete($cacheKey);
}


/**
 * hpf
 *
 * 读取数据缓存
 *
 * @param string $key 要取得缓存键
 * @param string $prefix 键值前缀
 * @param string $fields 所需要的字段
 * @return array/bool
 */
function read_db_cache($key = null, $prefix = '', $fields = '*')
{
    if ($key === null || !getConfig('cache_open')) return array();
    $ins = new \Ypk\CacheRedis();
    $cache_info = $ins->hget($key, $prefix, $fields);
    if ($cache_info === false) {
        //未被缓存
        $data = array();
    } elseif (is_array($cache_info)) {
        //如果有一个键值为false(即未缓存)，则整个函数返回空，让系统重新生成全部缓存
        $data = $cache_info;
        foreach ($cache_info as $k => $v) {
            if ($v === false || (is_serialized($v) && empty(unserialize($v)))) {
                $data = array();
                break;
            }
        }
    } else {
        //string 取单个字段且被缓存
        $data = array($fields => $cache_info);
    }
    // 验证缓存是否过期
    if (isset($data['cache_expiration_time']) && $data['cache_expiration_time'] < TIMESTAMP) {
        $data = array();
    }
    return $data;
}

/**
 * hpf
 *
 * 写入数据缓存
 *
 * @param string $key 缓存键值
 * @param array $data 缓存数据
 * @param string $prefix 键值前缀
 * @param int $period 缓存周期  单位分，0为永久缓存
 * @return bool 返回值
 */
function write_db_cache($key = null, $data = array(), $prefix, $period = 0)
{
    if ($key === null || !getConfig('cache_open') || !is_array($data)) return false;
    $period = intval($period);
    if ($period != 0) {
        $data['cache_expiration_time'] = TIMESTAMP + $period * 60;
    }
    $ins = new \Ypk\CacheRedis();
    $ins->hset($key, $prefix, $data);
    return true;
}

/**
 * hpf
 *
 * 删除缓存的查询结果
 * @param string $key 缓存键值
 * @param string $prefix 键值前缀
 * @return boolean
 */
function delete_db_cache($key = null, $prefix = '')
{
    if ($key === null || !getConfig('cache_open')) return true;
    $ins = new \Ypk\CacheRedis();
    return $ins->hdel($key, $prefix);
}

/**
 * hpf
 *
 * 判断一个字符串是否是调用序列化函数serialize()生成的字符串
 *
 * @param $data
 * @return bool
 */
function is_serialized($data)
{
    $data = trim($data);
    if ('N;' == $data)
        return true;
    if (!preg_match('/^([adObis]):/', $data, $badions))
        return false;
    switch ($badions[1]) {
        case 'a' :
        case 'O' :
        case 's' :
            if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data))
                return true;
            break;
        case 'b' :
        case 'i' :
        case 'd' :
            if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data))
                return true;
            break;
    }
    return false;
}

/**
 * 读取目录列表
 * 不包括 . .. 文件 三部分
 *
 * @param string $path 路径
 * @return array 数组格式的返回结果
 */
function readDirList($path)
{
    if (is_dir($path)) {
        $handle = @opendir($path);
        $dir_list = array();
        if ($handle) {
            while (false !== ($dir = readdir($handle))) {
                if ($dir != '.' && $dir != '..' && is_dir($path . DS . $dir)) {
                    $dir_list[] = $dir;
                }
            }
            return $dir_list;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 *递归获取文件列表(所有子目录文件)
 * @param string $path 目录
 * @param array $file_list 存放所有子文件的数组
 * @param array $ignore_dir 需要忽略的目录或文件
 * @return bool 数据格式的返回结果
 */
function readFileList($path, &$file_list, $ignore_dir = array())
{
    $path = rtrim($path, '/');
    if (is_dir($path)) {
        $handle = @opendir($path);
        if ($handle) {
            while (false !== ($dir = readdir($handle))) {
                if ($dir != '.' && $dir != '..') {
                    if (!in_array($dir, $ignore_dir)) {
                        if (is_file($path . DS . $dir)) {
                            $file_list[] = $path . DS . $dir;
                        } elseif (is_dir($path . DS . $dir)) {
                            readFileList($path . DS . $dir, $file_list, $ignore_dir);
                        }
                    }
                }
            }
            @closedir($handle);
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * 递归创建目录，此种方法是我目前感觉比较好的方法
 *
 * @param string $dir
 * @param int $mode
 * @return bool
 */
function mkDirs($dir, $mode = 0775)
{
    if (!is_dir($dir)) {
        if (!mkDirs(dirname($dir))) {
            return false;
        }
        if (!mkdir($dir, $mode)) {
            return false;
        }
    }
    return true;
}

/**
 * 编辑器内容
 *
 * @param string $id 编辑器id名称，与name同名
 * @param string $value 编辑器内容
 * @param string $width 宽 带px
 * @param string $height 高 带px
 * @param string $style 样式内容
 * @param string $upload_state 上传状态，默认是开启
 * @param bool $media_open 是否开启多媒体
 * @param string $type 编辑器的功能列表是basic，simple或者all
 * @param string $user_type 编辑器上传文件和管理上传文件的身份    管理员'admin' 用户'user' 商家'store'
 * @return bool
 */
function showEditor($id, $value = '', $width = '700px', $height = '300px', $style = 'visibility:hidden;', $upload_state = "true", $media_open = false, $type = 'all', $user_type = 'admin')
{
    //是否开启多媒体
    $media = '';
    if ($media_open) {
        $media = ", 'flash', 'media'";
    }
    switch ($type) {
        case 'basic':
            $items = "['source', '|', 'fullscreen', 'undo', 'redo', 'cut', 'copy', 'paste', '|', 'about']";
            break;
        case 'simple':
            $items = "['source', '|', 'fullscreen', 'undo', 'redo', 'cut', 'copy', 'paste', '|',
            'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link', '|', 'about']";
            break;
        default:
            $items = "['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
            'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
            'superscript', '|', 'selectall', 'clearhtml','quickformat','|',
            'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
            'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image'" . $media . ", 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about']";
            break;
    }
    //图片、Flash、视频、文件的本地上传都可开启。默认只有图片，要启用其它的需要修改resource\kindeditor\php下的upload_json.php的相关参数
    echo '<textarea id="' . $id . '" name="' . $id . '" style="width:' . $width . ';height:' . $height . ';' . $style . '">' . $value . '</textarea>';
    echo '
<script src="' . RESOURCE_SITE_URL . '/kindeditor/kindeditor-min.js" charset="utf-8"></script>
<script src="' . RESOURCE_SITE_URL . '/kindeditor/lang/' . getBestLanguage() . '.js" charset="utf-8"></script> 
<script>
	var KE;
  KindEditor.ready(function(K) {
        KE = K.create("textarea[name=\'' . $id . '\']", {
                        userType: "' . $user_type . '",
						items : ' . $items . ',
						cssPath : "' . RESOURCE_SITE_URL . '/kindeditor/themes/default/default.css",
						allowImageUpload : ' . $upload_state . ',
						allowFlashUpload : true,
						allowMediaUpload : true,
						allowFileManager : true,
						syncType:"form",
						afterCreate : function() {
							var self = this;
							self.sync();
						},
						afterChange : function() {
							var self = this;
							self.sync();
						},
						afterBlur : function() {
							var self = this;
							self.sync();
						}
        });
			KE.appendHtml = function(id,val) {
				this.html(this.html() + val);
				if (this.isCreated) {
					var cmd = this.cmd;
					cmd.range.selectNodeContents(cmd.doc.body).collapse(false);
					cmd.select();
				}
				return this;
			}
	});
</script>';
    return true;
}

/**
 * 得到图片的高度 单位：px
 * @param $image //图片的物理路径
 * @return mixed
 */
function get_height($image)
{
    $size = getimagesize($image);
    $height = $size[1];
    return $height;
}

/**
 * 得到图片的宽度 单位：px
 * @param $image //图片的物理路径
 * @return mixed
 */
function get_width($image)
{
    $size = getimagesize($image);
    $width = $size[0];
    return $width;
}

/**
 * @param $thumb_image_name //目标文件全路径
 * @param $image //源文件全路径
 * @param $width //目标文件宽度
 * @param $height //目标文件高度
 * @param $start_width //
 * @param $start_height //
 * @param $scale //缩放比例
 * @return mixed
 */
function resize_thumb($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
{
    $newImageWidth = ceil($width * $scale);
    $newImageHeight = ceil($height * $scale);
    if (getConfig('thumb.cut_type') == 'im') { //im即ImageMagick
        /*************************************************
         * 商城默认使用GD库生成缩略图，GD使用广泛但占用系统资源较多，ImageMagick速度快系统资源占用少，
         * 但需要服务器有执行命令行命令的权限。可到 http://www.imagemagick.org 下载安装，如改用ImageMagick，
         * 可编辑data/config/config.ini.php文件(用EditPlus): <br/>$config['thumb']['cut_type'] = 'im';
         * <br/>$config['thumb']['impath'] = 'ImageMagick下convert工具所在路径';
         * 如：<br/>$config['thumb']['impath'] = '/usr/local/ImageMagick/bin'
         * **********************************************/
        $exec_str = rtrim(getConfig('thumb.impath'), '/') . '/convert -quality 100 -crop ' . $width . 'x' . $height . '+' . $start_width . '+' . $start_height . ' -resize ' . $newImageWidth . 'x' . $newImageHeight . ' ' . $image . ' ' . $thumb_image_name;
        exec($exec_str); //exec是调用命令行命令
    } else {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $white);
        $source = null;
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }
        $dst_w = $dst_h = 0;
        if ($newImageWidth > $width) {
            $dst_w = ($newImageWidth - $width) / 2;
        }
        if ($newImageHeight > $height) {
            $dst_h = ($newImageHeight - $height) / 2;
        }
        if ($dst_w > 0) {
            imagecopyresampled($newImage, $source, $dst_w, $dst_h, $start_width, $start_height, $width, $height, $width, $height);
        } else {
            imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
        }

        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_image_name, 100);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);
                break;
        }
    }
    return $thumb_image_name;
}

/**
 * 返回以原数组某个值为下标的新数据
 *
 * @param array $array
 * @param string $key
 * @param int $type 1一维数组2二维数组
 * @return array
 */
function array_under_reset($array, $key, $type = 1)
{
    if (is_array($array)) {
        $tmp = array();
        foreach ($array as $v) {
            if ($type === 1) {
                $tmp[$v[$key]] = $v;
            } elseif ($type === 2) {
                $tmp[$v[$key]][] = $v;
            }
        }
        return $tmp;
    } else {
        return $array;
    }
}

/**
 * 生成完整的url
 * @param string $uri //必须是模块名称$module加上控制器名称$controller再加上action名称$action拼成的字符串
 * @param string $local
 * @param string $baseUri
 * @param array $paramArray //参数数组
 * @return string
 */
function getUrl($uri, $paramArray = null, $local = null, $baseUri = null)
{
    $url = new \Phalcon\Mvc\Url();
    return $url->get($uri, $paramArray, $local, $baseUri);
}

/**
 * 价格格式化
 *
 * @param int $price
 * @return string    $price_format
 */
function ncPriceFormat($price)
{
    return number_format($price, 2, '.', '');
}

/**
 * 价格格式化
 *
 * @param int $price
 * @return string    $price_format
 */
function ncPriceFormatForList($price)
{
    if ($price >= 10000) {
        return number_format(floor($price / 100) / 100, 2, '.', '') . '万';
    } else {
        return '&yen;' . ncPriceFormat($price);
    }
}

/**
 * 成员头像
 * @param string $member_id
 * @return string
 */
function getMemberAvatarForID($member_id)
{
    if (file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_AVATAR . '/avatar_' . $member_id . '.jpg')) {
        return UPLOAD_SITE_URL . '/' . ATTACH_AVATAR . '/avatar_' . $member_id . '.jpg';
    } else {
        return UPLOAD_SITE_URL . '/' . ATTACH_COMMON . DS . getConfig('default_user_portrait');
    }
}

/**
 * 输出分页xml数据
 *
 * @param $flexigridXML
 */
function flexigridXML($flexigridXML)
{
    //todo 这里到最后的时候要开启ob_clean
    //ob_clean();
    $page = $flexigridXML['now_page'];
    $total = $flexigridXML['total_num'];
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-type: text/xml");
    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $xml .= "<rows>";
    $xml .= "<page>$page</page>";
    $xml .= "<total>$total</total>";
    if (empty($flexigridXML['list'])) {
        $xml .= "<row id=''>";
        $xml .= "<cell></cell>";
        $xml .= "</row>";
    } else {
        foreach ($flexigridXML['list'] as $k => $v) {
            $xml .= "<row id='" . $k . "'>";
            foreach ($v as $kk => $vv) {
                $xml .= "<cell><![CDATA[" . $v[$kk] . "]]></cell>";
            }
            $xml .= "</row>";
        }
    }
    $xml .= "</rows>";
    echo $xml;
}

/**
 * 获取页码条
 * @param int $totalnum 总条数
 * @param int $eachnum 页容量
 * @param int $Style 风格
 * @return string 返回一个分页字符串
 */
function getPageShow($totalnum = 1, $eachnum = 10, $Style = 2)
{
    $page = new \Ypk\Page();
    $page->setTotalNum($totalnum);
    $page->setEachNum($eachnum);
    $page->setStyle($Style);
    return $page->show();
}

/**
 * hpf
 *
 * 数据库模型实例化入口
 *
 * @param string $table_name 切记，是数据库表名
 * @return object 对象形式的返回结果
 */
function Model($table_name = null)
{
    static $_cache = array();
    if (!is_null($table_name) && isset($_cache[$table_name])) return $_cache[$table_name];
    $class_name = '\Ypk\MyModels\\' . $table_name . 'Model';
    if (!class_exists($class_name)) {
        //该类没有被定义，就直接new一个空的Model,传入表名
        return $_cache[$table_name] = new \Ypk\Model($table_name);
    } else {
        //该类被定义，就直接new一个该类
        return $_cache[$table_name] = new $class_name();
    }
}

/**
 * hpf
 *
 * 行为模型实例
 *
 * @param string $model 模型名称
 * @param string $suffix 缓存健名的后缀
 * @return object 对象形式的返回结果
 */
function Logic($model = null, $suffix = null)
{
    static $_cache = array();
    $cache_key = $model . '.' . $suffix;

    if (!is_null($model) && isset($_cache[$cache_key])) return $_cache[$cache_key];

    $class_name = '\Ypk\MyLogic\\' . $model . 'Logic';
    if (!class_exists($class_name)) {
        return $_cache[$cache_key] = new \Ypk\Model($model);
    } else {
        return $_cache[$cache_key] = new $class_name();
    }
}

/**
 * hpf
 *
 * 用于规范队列任务函数的数据返回格式的函数
 *
 * @param bool $state
 * @param string $msg
 * @param array $data
 * @return array
 */
function queue_callback($state = true, $msg = '', $data = array())
{
    return array('state' => $state, 'msg' => $msg, 'data' => $data);
}

/**
 * hpf
 *
 * 封装分页操作到函数，方便调用
 *
 * @param string $cmd 命令类型
 * @param mixed $arg 参数
 * @return mixed
 */
function pagecmd($cmd = '', $arg = '')
{
    static $page;
    if ($page == null) {
        $page = new \Ypk\Page();
    }

    switch (strtolower($cmd)) {
        case 'seteachnum':
            $page->setEachNum($arg);
            break;
        case 'settotalnum':
            $page->setTotalNum($arg);
            break;
        case 'setstyle':
            $page->setStyle($arg);
            break;
        case 'show':
            return $page->show($arg);
            break;
        case 'obj':
            return $page;
            break;
        case 'gettotalnum':
            return $page->getTotalNum();
            break;
        case 'gettotalpage':
            return $page->getTotalPage();
            break;
        case 'getnowpage':
            return $page->getNowPage();
            break;
        case 'settotalpagebynum':
            $page->setTotalPageByNum($arg);
            break;
        default:
            break;
    }
    return true;
}

/**
 * 分页获取对象数组集合
 *
 * @param string $className 要查询的表对应的实体类名(带命名空间的完整的类名)
 * @param int $total_num 符合条件的总记录条数（是一个传出参数）
 * @param string $fields 要查询的字段名 eg："id,name,age"
 * @param string $where 查询条件 eg："e_name like '%安%'"
 * @param string $orderby 排序的字段名 eg："id desc"  or "id asc"
 * @param int $currentPageIndex 当前页码
 * @param int $pageSize 页容量
 * @return array 返回对象的数组集合
 */
function getModelArrayListByPaging($className, &$total_num, $fields = "*", $where = "", $orderby = "", $currentPageIndex = 1, $pageSize = 0)
{
    $arrList = array();
    if (!empty($className)) {
        if (class_exists($className)) { //判断实体类是否存在
            $modelQuery = $className::query();
            $modelQuery->columns($fields); //查询字段
            if (!empty($where)) {
                $modelQuery->andWhere($where); //查询条件
            }
            if (!empty($orderby)) {
                $modelQuery->orderBy($orderby); //排序条件
            }

            $total_num = count($modelQuery->execute());

            $offset = intval($pageSize) * (intval($currentPageIndex) - 1); //偏移量
            $modelQuery->limit($pageSize, $offset); //第一个参数是页容量，第二个参数是偏移量
            $res = $modelQuery->execute(); //返回结果是一个对象数组
            if (count($res) > 0) {
                $arrList = $res->toArray();
            }
        }
    }
    return $arrList;
}

/**
 * 根据条件获取对象数组集合
 *
 * @param string $className 要查询的表对应的实体类名(带命名空间的完整的类名)
 * @param string $fields 要查询的字段名 eg："id,name,age"
 * @param string $where 查询条件 eg："e_name like '%安%'"
 * @param string $orderby 排序的字段名 eg："id desc"  or "id asc"
 * @return array 返回对象的数组集合
 */
function getModelArrayList($className, $fields = "*", $where = "", $orderby = "")
{
    $arrList = array();
    if (!empty($className)) {
        if (class_exists($className)) { //判断实体类是否存在
            $modelQuery = $className::query();
            $modelQuery->columns($fields); //查询字段
            if (!empty($where)) {
                $modelQuery->andWhere($where); //查询条件
            }
            if (!empty($orderby)) {
                $modelQuery->orderBy($orderby); //排序条件
            }
            $res = $modelQuery->execute(); //返回结果是一个对象数组
            if (count($res) > 0) {
                $arrList = $res->toArray();
            }
        }
    }
    return $arrList;
}

/**
 * 根据条件获取实体数量
 *
 * @param string $className 表名对应的实体类的全名称（包含命名空间的类全名）
 * @param string $where 查询条件
 * @return int
 */
function getModelArrayListCount($className, $where = "")
{
    $count = 0;
    if (!empty($className)) {
        if (class_exists($className)) { //判断实体类是否存在
            $modelQuery = $className::query();
            if (!empty($where)) {
                $modelQuery->andWhere($where); //查询条件
            }
            $count = count($modelQuery->execute());
        }
    }
    return $count;
}

/**
 * 取得IP
 *
 * @return string 字符串类型的返回结果
 */
function getIp()
{
    if (@$_SERVER['HTTP_CLIENT_IP'] && $_SERVER['HTTP_CLIENT_IP'] != 'unknown') {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (@$_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['HTTP_X_FORWARDED_FOR'] != 'unknown') {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return preg_match('/^\d[\d.]+\d$/', $ip) ? $ip : '';
}

/**
 * 取得商品缩略图的完整URL路径，接收商品信息数组，返回所需的商品缩略图的完整URL
 *
 * @param array $goods 商品信息数组
 * @param string $type 缩略图类型  值为60,240,360,1280
 * @return string
 */
function thumb($goods = array(), $type = '')
{
    $type_array = explode(',_', ltrim(GOODS_IMAGES_EXT, '_'));
    if (!in_array($type, $type_array)) {
        $type = '240';
    }
    if (empty($goods)) {
        return UPLOAD_SITE_URL . '/default.gif';
    }
    if (array_key_exists('apic_cover', $goods)) {
        $goods['goods_image'] = $goods['apic_cover'];
    }
    if (empty($goods['goods_image'])) {
        $rusult = \Ypk\Models\Goods::findFirst("goods_id=" . isset($goods['goods_id']) ? $goods['goods_id'] : $goods['goods_commonid']);
        if ($rusult !== false) {
            $array = $rusult->toArray();
            if ($array['gc_id_1'] == 1076 || $array['gc_id_1'] == 1073) {
                return UPLOAD_SITE_URL . '/default.gif';
            } else {
                return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
            }
        }
    }
    $search_array = explode(',', GOODS_IMAGES_EXT);
    $file = str_ireplace($search_array, '', $goods['goods_image']);
    $fname = basename($file);
    //取医生ID
    if (preg_match('/^(\d+_)/', $fname)) {
        $store_id = substr($fname, 0, strpos($fname, '_'));
    } else {
        $store_id = $goods['store_id'];
    }

    $file = $type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file);
    if (!file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS . '/' . $store_id . '/' . $file)) {
        $rusult = \Ypk\Models\Goods::findFirst("goods_id=" . isset($goods['goods_id']) ? $goods['goods_id'] : $goods['goods_commonid']);
        if ($rusult !== false) {
            $array = $rusult->toArray();
            if ($array['gc_id_1'] == 1076 || $array['gc_id_1'] == 1073) {
                return UPLOAD_SITE_URL . '/default.gif';
            } else {
                return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
            }
        }
    }
    $thumb_host = UPLOAD_SITE_URL . '/' . ATTACH_GOODS;
    return $thumb_host . '/' . $store_id . '/' . $file;

}

/**
 * 取得商品默认大小图片
 *
 * @param string $key 图片大小 small tiny
 * @return string
 */
function defaultGoodsImage($key)
{
    $file = str_ireplace('.', '_' . $key . '.', getConfig('default_goods_image'));
    return ATTACH_COMMON . DS . $file;
}

/**
 * 加载广告
 * @param string $ap_id 广告位ID
 * @param string $type 广告返回类型 html,js
 * @return array|bool|string
 */
function loadadv($ap_id = null, $type = 'html')
{
    if (!is_numeric($ap_id)) return false;
    return advshow($ap_id, $type);
}

/**
 * 取广告内容
 *
 * @param string $ap_id
 * @param string $type html,js,array
 * @return array|string
 */
function advshow($ap_id, $type = 'js')
{
    if ($ap_id < 1) return;
    $time = time();

    $ap_info = Model('adv')->getApById($ap_id);
    if (!$ap_info)
        return;

    $list = $ap_info['adv_list'];
    unset($ap_info['adv_list']);
    extract($ap_info);
    if ($is_use !== '1') {
        return;
    }
    $adv_list = array();
    $adv_info = array();//异步调用的数组格式
    foreach ((array)$list as $k => $v) {
        if ($v['adv_start_date'] < $time && $v['adv_end_date'] > $time && $v['is_allow'] == '1') {
            $adv_list[] = $v;
        }
    }

    if (empty($adv_list)) {
        if ($ap_class == '1') {//文字广告
            $content .= "<a href=''>";
            $content .= $default_content;
            $content .= "</a>";
        } else {
            $width = $ap_width;
            $height = $ap_height;
            $content .= "<a href='' title='" . $ap_name . "'>";
            $content .= "<img style='width:{$width}px;height:{$height}px' border='0' src='";
            $content .= UPLOAD_SITE_URL . "/" . ATTACH_ADV . "/" . $default_content;
            $content .= "' alt=''/>";
            $content .= "</a>";
            $adv_info['adv_title'] = $ap_name;
            $adv_info['adv_img'] = UPLOAD_SITE_URL . "/" . ATTACH_ADV . "/" . $default_content;
            $adv_info['adv_url'] = '';
        }
    } else {
        $select = 0;
        if ($ap_display == '1') {//多广告展示
            $select = array_rand($adv_list);
        }
        $adv_select = $adv_list[$select];
        extract($adv_select);
        //图片广告
        if ($ap_class == '0') {
            $width = $ap_width;
            $height = $ap_height;
            $pic_content = unserialize($adv_content);
            $pic = $pic_content['adv_pic'];
            $url = $pic_content['adv_pic_url'];
            $content .= "<a href='http://" . $pic_content['adv_pic_url'] . "' target='_blank' title='" . $adv_title . "'>";
            $content .= "<img style='width:{$width}px;height:{$height}px' border='0' src='";
            $content .= UPLOAD_SITE_URL . "/" . ATTACH_ADV . "/" . $pic;
            $content .= "' alt='" . $adv_title . "'/>";
            $content .= "</a>";
            $adv_info['adv_title'] = $adv_title;
            $adv_info['adv_img'] = UPLOAD_SITE_URL . "/" . ATTACH_ADV . "/" . $pic;
            $adv_info['adv_url'] = 'http://' . $pic_content['adv_pic_url'];
        }
        //文字广告
        if ($ap_class == '1') {
            $word_content = unserialize($adv_content);
            $word = $word_content['adv_word'];
            $url = $word_content['adv_word_url'];
            $content .= "<a href='http://" . $pic_content['adv_word_url'] . "' target='_blank'>";
            $content .= $word;
            $content .= "</a>";
        }
        //Flash广告
        if ($ap_class == '3') {
            $width = $ap_width;
            $height = $ap_height;
            $flash_content = unserialize($adv_content);
            $flash = $flash_content['flash_swf'];
            $url = $flash_content['flash_url'];
            $content .= "<a href='http://" . $url . "' target='_blank'><button style='width:" . $width . "px; height:" . $height . "px; border:none; padding:0; background:none;' disabled><object id='FlashID' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='" . $width . "' height='" . $height . "'>";
            $content .= "<param name='movie' value='";
            $content .= UPLOAD_SITE_URL . "/" . ATTACH_ADV . "/" . $flash;
            $content .= "' /><param name='quality' value='high' /><param name='wmode' value='opaque' /><param name='swfversion' value='9.0.45.0' /><!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 --><param name='expressinstall' value='";
            $content .= RESOURCE_SITE_URL . "/js/expressInstall.swf'/><!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 --><!--[if !IE]>--><object type='application/x-shockwave-flash' data='";
            $content .= UPLOAD_SITE_URL . "/" . ATTACH_ADV . "/" . $flash;
            $content .= "' width='" . $width . "' height='" . $height . "'><!--<![endif]--><param name='quality' value='high' /><param name='wmode' value='opaque' /><param name='swfversion' value='9.0.45.0' /><param name='expressinstall' value='";
            $content .= RESOURCE_SITE_URL . "/js/expressInstall.swf'/><!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 --><div><h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4><p><a href='http://www.adobe.com/go/getflashplayer'><img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='获取 Adobe Flash Player' width='112' height='33' /></a></p></div><!--[if !IE]>--></object><!--<![endif]--></object></button></a>";
        }
    }

    if ($type == 'array' && $ap_class == '0') {
        return $adv_info;
    }

    if ($type == 'js') {
        $content = "document.write(\"" . $content . "\");";
    }
    return $content;
}

/**
 * hpf
 *
 * 取得用户头像图片
 *
 * @param string $member_avatar
 * @return string
 */
function getMemberAvatar($member_avatar)
{
    if (empty($member_avatar)) {
        return UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . getConfig('default_user_portrait');
    } else {
        if (file_exists(BASE_UPLOAD_PATH . DS . ATTACH_AVATAR . DS . $member_avatar)) {
            return UPLOAD_SITE_URL . DS . ATTACH_AVATAR . DS . $member_avatar;
        } else {
            return UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . getConfig('default_user_portrait');
        }

    }
}

/**
 * hpf
 *
 * 取得品牌图片
 *
 * @param string $image_name
 * @return string
 */
function brandImage($image_name = '')
{
    if ($image_name != '') {
        return UPLOAD_SITE_URL . '/' . ATTACH_BRAND . '/' . $image_name; // files/upload/shop/brand/
    }
    return UPLOAD_SITE_URL . '/' . ATTACH_COMMON . '/default_brand_image.gif'; // files/upload/shop/common/
}

/**
 * hpf
 *
 * 取得医生标志
 *
 * @param string $img 图片名
 * @param string $type 查询类型 store_logo/store_avatar
 * @return string
 */
function getStoreLogo($img, $type = 'store_avatar')
{
    if ($type == 'store_avatar') {
        if (empty($img)) {
            return UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . getConfig('default_store_avatar');
        } else {
            return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . $img;
        }
    } elseif ($type == 'store_logo') {
        if (empty($img)) {
            return UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . getConfig('default_store_logo');
        } else {
            return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . $img;
        }
    }
}

/**
 * 获取店铺头像
 * @param int $member_id 会员id
 * @return string 返回会员的头像路径
 */
function getStoreHeaderLogo($member_id)
{
    if (empty($member_id)) {
        return UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . getConfig('default_store_logo');
    }
    $member_model = \Ypk\Models\Member::findFirst("member_id=" . $member_id);
    if ($member_model === false) {
        return UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . getConfig('default_store_logo');
    }
    return getMemberAvatar($member_model->getMemberAvatar());
}

/**
 * 获取当前页面的网络全路径 eg：http://www.xxx.com/index?a=10&b=10
 * @return string
 */
function getFullPageUri()
{
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * 取得用户头像图片
 *
 * @param string $member_avatar
 * @return string
 */
function getMemberAvatarHttps($member_avatar)
{
    if (empty($member_avatar)) {
        //加载默认的用户头像
        return UPLOAD_SITE_URL_HTTPS . DS . ATTACH_COMMON . DS . getConfig('default_user_portrait');
    } else {
        if (file_exists(BASE_UPLOAD_PATH . DS . ATTACH_AVATAR . DS . $member_avatar)) {
            return UPLOAD_SITE_URL_HTTPS . DS . ATTACH_AVATAR . DS . $member_avatar;
        } else {
            return UPLOAD_SITE_URL_HTTPS . DS . ATTACH_COMMON . DS . getConfig('default_user_portrait');
        }

    }
}

/**
 * 通知邮件/通知消息 内容转换函数
 *
 * @param string $message 内容模板
 * @param array $param 内容参数数组
 * @return string 通知内容
 */
function ncReplaceText($message, $param)
{
    if (!is_array($param)) return false;
    foreach ($param as $k => $v) {
        $message = str_replace('{$' . $k . '}', $v, $message);
    }
    return $message;
}

/**
 * 取得商品缩略图的完整URL路径，接收图片名称与医生ID
 *
 * @param string $file 图片名称
 * @param string $type 缩略图尺寸类型，值为60,240,360,1280
 * @param mixed $store_id 医生ID 如果传入，则返回图片完整URL,如果为假，返回系统默认图
 * @return string
 */
function cthumb($file, $type = '', $store_id = false, $goods_id = null)
{
    $type_array = explode(',_', ltrim(GOODS_IMAGES_EXT, '_'));
    if (!in_array($type, $type_array)) {
        $type = '240';
    }
    if (empty($file)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
    }
    $search_array = explode(',', GOODS_IMAGES_EXT);
    $file = str_ireplace($search_array, '', $file);
    $fname = basename($file);
    // 取医生ID
    if ($store_id === false || !is_numeric($store_id)) {
        $store_id = substr($fname, 0, strpos($fname, '_'));
    }
    // 本地存储时，增加判断文件是否存在，用默认图代替
    if (!file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS . '/' . $store_id . '/' . ($type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file)))) {
        if (!empty($goods_id)) {
            $rusult = \Ypk\Models\Goods::findFirst("goods_id=" . $goods_id);
            if ($rusult !== false) {
                $array = $rusult->toArray();
                if ($array['gc_id_1'] == 1076 || $array['gc_id_1'] == 1073) {
                    return UPLOAD_SITE_URL . '/default.gif';
                } else {
                    return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
                }
            }
        } else {
            return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
        }
    }
    $thumb_host = UPLOAD_SITE_URL . '/' . ATTACH_GOODS;
    return $thumb_host . '/' . $store_id . '/' . ($type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file));
}

/**
 * ycg
 * 获取开店申请图片
 */
function getStoreJoininImageUrl($image_name = '')
{
    return UPLOAD_SITE_URL . DS . ATTACH_STORE_JOININ . DS . $image_name;
}

/**
 * ycg
 * 存储session
 * @param string $key
 * @param mixed $val
 */
function setSession($key, $val)
{
    $di = $GLOBALS['di'];
    $session = $di->getShared('session');
    $session->set($key, $val);
}

/**
 * ycg
 * 获取session
 * @param string $key
 * @return mixed
 */
function getSession($key = null)
{
    $di = $GLOBALS['di'];
    $session = $di->getShared('session');
    if (empty($key)) {
        return null;
    }
    return $session->get($key);
}

/**
 * ycg
 * 清除session
 */
function destroySession()
{
    $di = $GLOBALS['di'];
    $session = $di->getShared('session');
    $session->destroy();
}

/**
 * hpf
 *
 * 得到查询创建器的绑定参数数组
 * @param \Phalcon\Mvc\Model\Criteria $query_object
 * @param $query_object
 * @return mixed
 */
function getBind($query_object)
{
    $params = $query_object->getParams();
    if (isset($params['bind'])) {
        return $params['bind'];
    } else {
        return null;
    }
}

/**
 * sns表情标示符替换为html
 */
function parsesmiles($message)
{
    $smilescache_file = APP_PATH . DS . 'common' . DS . 'include' . DS . 'smilies.php';
    if (file_exists($smilescache_file)) {
        include($smilescache_file);
        global $smilies_array;
        if (strtoupper(CHARSET) == 'GBK') {
            $smilies_array = getTranslation($smilies_array);
        }
        if (!empty($smilies_array) && is_array($smilies_array)) {
            $imagesurl = RESOURCE_SITE_URL . DS . 'js' . DS . 'smilies' . DS . 'images' . DS;
            $replace_arr = array();
            foreach ($smilies_array['replacearray'] AS $key => $smiley) {
                $replace_arr[$key] = '<img src="' . $imagesurl . $smiley['imagename'] . '" title="' . $smiley['desc'] . '" border="0" alt="' . $imagesurl . $smiley['desc'] . '" />';
            }
            $message = preg_replace($smilies_array['searcharray'], $replace_arr, $message);
        }
    }
    return $message;
}

/**
 * ycg
 * 验证是否为平台医生
 *
 * @return boolean
 */
function checkPlatformStore($store_id = 0)
{
    $v = getSession('is_own_shop'); //0不是自营医生，1是自营医生
    if (isset($v)) {
        return $v;
    } else {
        $own_shop_ids = (new \Ypk\Logic\StoreLogic())->getOwnShopIds(true);
        return in_array($store_id, $own_shop_ids);
    }
}

/**
 * 验证是否为平台医生 并且绑定了全部商品类目
 *
 * @return boolean
 */
function checkPlatformStoreBindingAllGoodsClass($store_id = 0, $bind_all_gc = 0)
{
    $a = getSession('is_own_shop');
    if (isset($a)) {
        return checkPlatformStore() && getSession('bind_all_gc'); //getSession('bind_all_gc') 自营医生是否绑定全部分类（0否，1是）
    } else {
        return $store_id && $bind_all_gc;
    }
}

/**
 * hpf
 *
 * 显示错误页面
 *
 * @param string $msg 输出信息
 * @param string /array $url 跳转地址 当$url为数组时，结构为 array('msg'=>'跳转连接文字','url'=>'跳转连接');
 * @param string $show_type 输出格式 默认为html
 * @param string $msg_type 信息类型 succ 为成功，error为失败/错误
 * @param int $is_show 是否显示跳转链接，默认是为1，显示
 * @param int $time 跳转时间，默认为2秒
 * @param string $admin_index_extrajs 要传递到admin/index/index页面执行的扩展JS
 */
function showMessage($msg, $url = '', $show_type = 'html', $msg_type = 'succ', $is_show = 1, $time = 2000, $admin_index_extrajs = '')
{
    /**
     * 如果默认为空，则跳转至上一步链接
     */
    if (empty($url)) {
        $url = getReferer();
    }

    //这个不行
    /*$this->dispatcher->forward(
        array(
            "controller" => "message",
            "action" => "index",
            "params" => array('msg' => $msg, 'url' => $url, "show_type" => $show_type, "msg_type" => $msg_type, "is_show" => $is_show, "time" => $time)
        )
    );*/

    //这个也不行
    //$this->response->redirect(getUrl('admin/message/index', array('msg' => $msg, 'url' => $url, "show_type" => $show_type, "msg_type" => $msg_type, "is_show" => $is_show, "time" => $time)));

    //@header('Location和exit搭配，能实现跳转，任何地方都能用，但是由于使用exit，cookies不能写入浏览器
    //$this->view->disable()和return搭配，只能在action中使用，可以实现exit的功能，只使用return，仍然会渲染html页面
    //使用$this->view->disable()，仍然可以写入浏览器cookies
    //$this->dispatcher->forward()和$this->response->redirect()都不能和exit搭配使用，一旦和exit搭配，页面将不会跳转了

    //由于在非action函数中，使用$this->dispatcher->forward()和$this->response->redirect()加return都不能退出程序，调用完这类函数还是会返回到action函数
    //中继续执行，所以这里用@header('Location加exit
    @header('Location: ' . getUrl('admin/message/index', array('param' => encrypt(serialize(array('msg' => $msg, 'url' => $url, "show_type" => $show_type, "msg_type" => $msg_type, "is_show" => $is_show, "time" => $time, "admin_index_extrajs" => $admin_index_extrajs))))));
    exit;
}

/**
 * 消息提示，主要适用于普通页面AJAX提交的情况
 *
 * @param string $message 消息内容
 * @param string $url 提示完后的URL去向
 * @param string $alert_type 提示类型 error/succ/notice 分别为错误/成功/警示
 * @param string $extrajs 扩展JS
 * @param int $time 停留时间
 */
function showDialog($message = '', $url = '', $alert_type = 'error', $extrajs = '', $time = 2)
{
    if (empty($_GET['inajax'])) {
        if ($url == 'reload') $url = '';
        showMessage($message, $url, 'html', $alert_type, 1, $time * 1000, $extrajs);
    }
    $message = str_replace("'", "\\'", strip_tags($message));

    $paramjs = null;
    if ($url == 'reload') {
        $paramjs = 'window.location.reload()';
    } elseif ($url != '') {
        $paramjs = 'window.location.href =\'' . $url . '\'';
    }
    if ($paramjs) {
        $paramjs = 'function (){' . $paramjs . '}';
    } else {
        $paramjs = 'null';
    }
    $modes = array('error' => 'alert', 'succ' => 'succ', 'notice' => 'notice', 'js' => 'js');
    $cover = $alert_type == 'error' ? 1 : 0;
    $extra = null;
    $extra .= 'showDialog(\'' . $message . '\', \'' . $modes[$alert_type] . '\', null, ' . ($paramjs ? $paramjs : 'null') . ', ' . $cover . ', null, null, null, null, ' . (is_numeric($time) ? $time : 'null') . ', null);';
    $extra = $extra ? '<script type="text/javascript" reload="1">' . $extra . '</script>' : '';
    if ($extrajs != '' && substr(trim($extrajs), 0, 7) != '<script') {
        $extrajs = '<script type="text/javascript" reload="1">' . $extrajs . '</script>';
    }
    $extra .= $extrajs;
    ob_end_clean();
    @header("Expires: -1");
    @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
    @header("Pragma: no-cache");
    @header("Content-type: text/xml; charset=" . CHARSET);

    $string = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\r\n";
    $string .= '<root><![CDATA[' . $message . $extra . ']]></root>';
    echo $string;
    exit; //退出整个程序
}

/**
 * hpf
 *
 * 后台程序抛出异常
 *
 * @param string $error 异常信息
 */
function throw_exception($error)
{
    if (!defined('IGNORE_EXCEPTION')) {
        showMessage($error, '', 'exception');
    } else {
        exit();
    }
}

/**
 * hpf
 *
 * 批量插入多条数据记录
 * 必须在控制器初始化之后使用
 *
 * @param string $class_name 带命名空间的数据模型的类名 如 'Ypk\Models\GoodsClassTag'
 * @param array $insert_array 含有多条记录的二维数组
 * @return bool
 */
function insertAll($class_name, $insert_array)
{
    $model = new $class_name();
    $table_name = $model->getSource();

    $sql = "";
    foreach ($insert_array as $insert) {
        $fields = array_keys($insert);
        $values = array_values($insert);
        $sql .= "INSERT INTO `" . $table_name . "` (`" . implode("`,`", $fields) . "`) VALUES ('" . implode("','", $values) . "');";
    }
    if (empty($sql)) {
        return true;
    }

    $db = $GLOBALS['di']->getShared('db');
    return $db->execute($sql);
}

/**
 * hpf
 *
 * 批量删除多条数据记录
 * 必须在控制器初始化之后使用
 *
 * @param string $class_name 带命名空间的数据模型的类名 如 'Ypk\Models\GoodsClassTag'
 * @param string|array $condition 含有多条记录的二维数组或者是字符串 数组如array('gc_id_1|gc_id_2|gc_id_3' => array('in', $gcid_array))
 * @return bool
 */
function deleteAll($class_name, $condition)
{
    $model = new $class_name();
    $table_name = $model->getSource();

    $whereStr = parseWhere($condition);

    $sql = "DELETE FROM `" . $table_name . "` WHERE 1 = 1 and " . $whereStr;

    $db = $GLOBALS['di']->getShared('db');
    return $db->execute($sql);
}

/**
 * hpf
 *
 * 清空数据表
 * 必须在控制器初始化之后使用
 * 数据表清空后再添加纪录的话主键会重新从1开始
 *
 * @param string $class_name 带命名空间的数据模型的类名 如 'Ypk\Models\GoodsClassTag'
 * @return bool
 */
function clearTable($class_name)
{
    $model = new $class_name();
    $table_name = $model->getSource();

    $sql = "TRUNCATE TABLE `" . $table_name->getSource() . "`";

    $db = $GLOBALS['di']->getShared('db');
    return $db->execute($sql);
}

/**
 * hpf
 *
 * where单元分析
 * 数据库操作使用
 *
 * @param $where
 * @return string
 */
function parseWhere($where)
{
    $whereStr = '';
    if (is_string($where)) {
        $whereStr = $where;
    } elseif (is_array($where)) {
        if (isset($where['_op'])) {
            // 定义逻辑运算规则 例如 OR XOR AND NOT
            $operate = ' ' . strtoupper($where['_op']) . ' ';
            unset($where['_op']);
        } else {
            $operate = ' AND ';
        }
        foreach ($where as $key => $val) {
            $whereStrTemp = '';

            // 查询字段的安全过滤
            if (!preg_match('/^[A-Z_\|\&\-.a-z0-9]+$/', trim($key))) {
                throw_exception('查询字段不安全!');
            }
            // 多条件支持
            $multi = is_array($val) && isset($val['_multi']);
            $key = trim($key);
            if (strpos($key, '|')) { // 支持 name|title|nickname 方式定义查询字段
                $array = explode('|', $key);
                $str = array();
                foreach ($array as $m => $k) {
                    $v = $multi ? $val[$m] : $val;
                    $str[] = '(' . parseWhereItem($k, $v) . ')';
                }
                $whereStrTemp .= implode(' OR ', $str);
            } elseif (strpos($key, '&')) {
                $array = explode('&', $key);
                $str = array();
                foreach ($array as $m => $k) {
                    $v = $multi ? $val[$m] : $val;
                    $str[] = '(' . parseWhereItem($k, $v) . ')';
                }
                $whereStrTemp .= implode(' AND ', $str);
            } else {
                $whereStrTemp .= parseWhereItem($key, $val);
            }

            if (!empty($whereStrTemp)) {
                $whereStr .= '( ' . $whereStrTemp . ' )' . $operate;
            }
        }
        $whereStr = substr($whereStr, 0, -strlen($operate));
    }
    //return empty($whereStr) ? '' : ' WHERE ' . $whereStr;
    return empty($whereStr) ? '' : $whereStr;
}

/**
 * hpf
 *
 * where子单元分析
 * 数据库操作使用
 *
 * @param $key
 * @param $val
 * @return string
 */
function parseWhereItem($key, $val)
{
    $comparison = array('eq' => '=', 'neq' => '<>', 'gt' => '>', 'egt' => '>=', 'lt' => '<', 'elt' => '<=', 'notlike' => 'NOT LIKE', 'like' => 'LIKE', 'in' => 'IN', 'not in' => 'NOT IN');

    $whereStr = '';
    if (is_array($val)) {
        if (is_string($val[0])) {
            if (preg_match('/^(EQ|NEQ|GT|EGT|LT|ELT|NOTLIKE|LIKE)$/i', $val[0])) { // 比较运算
                $whereStr .= $key . ' ' . $comparison[strtolower($val[0])] . ' ' . parseValue($val[1]);
            } elseif ('exp' == strtolower($val[0])) { // 使用表达式
                $whereStr .= $val[1];
            } elseif (preg_match('/IN/i', $val[0])) { // IN 运算
                if (isset($val[2]) && 'exp' == $val[2]) {
                    $whereStr .= $key . ' ' . strtoupper($val[0]) . ' ' . $val[1];
                } else {
                    if (empty($val[1])) {
                        $whereStr .= $key . ' ' . strtoupper($val[0]) . '(\'\')';
                    } elseif (is_string($val[1]) || is_numeric($val[1])) {
                        $val[1] = explode(',', $val[1]);
                        $zone = implode(',', parseValue($val[1]));
                        $whereStr .= $key . ' ' . strtoupper($val[0]) . ' (' . $zone . ')';
                    } elseif (is_array($val[1])) {
                        $zone = implode(',', parseValue($val[1]));
                        $whereStr .= $key . ' ' . strtoupper($val[0]) . ' (' . $zone . ')';
                    }
                }
            } elseif (preg_match('/BETWEEN/i', $val[0])) {
                $data = is_string($val[1]) ? explode(',', $val[1]) : $val[1];
                if ($data[0] && $data[1]) {
                    $whereStr .= ' (' . $key . ' ' . strtoupper($val[0]) . ' ' . parseValue($data[0]) . ' AND ' . parseValue($data[1]) . ' )';
                } elseif ($data[0]) {
                    $whereStr .= $key . ' ' . $comparison['gt'] . ' ' . parseValue($data[0]);
                } elseif ($data[1]) {
                    $whereStr .= $key . ' ' . $comparison['lt'] . ' ' . parseValue($data[1]);
                }
            } elseif (preg_match('/TIME/i', $val[0])) {
                $data = is_string($val[1]) ? explode(',', $val[1]) : $val[1];
                if ($data[0] && $data[1]) {
                    $whereStr .= ' (' . $key . ' BETWEEN ' . parseValue($data[0]) . ' AND ' . parseValue($data[1] + 86400 - 1) . ' )';
                } elseif ($data[0]) {
                    $whereStr .= $key . ' ' . $comparison['gt'] . ' ' . parseValue($data[0]);
                } elseif ($data[1]) {
                    $whereStr .= $key . ' ' . $comparison['lt'] . ' ' . parseValue($data[1] + 86400);
                }
            } else {
                $error = 'Model Error: args ' . $val[0] . ' is error!';
                throw_exception($error);
            }
        } else {
            $count = count($val);
            if (in_array(strtoupper(trim($val[$count - 1])), array('AND', 'OR', 'XOR'))) {
                $rule = strtoupper(trim($val[$count - 1]));
                $count = $count - 1;
            } else {
                $rule = 'AND';
            }
            for ($i = 0; $i < $count; $i++) {
                if (is_array($val[$i])) {
                    if (is_array($val[$i][1])) {
                        $data = implode(',', $val[$i][1]);
                    } else {
                        $data = $val[$i][1];
                    }
                } else {
                    $data = $val[$i];
                }
                if ('exp' == strtolower($val[$i][0])) {
                    $whereStr .= '(' . $key . ' ' . $data . ') ' . $rule . ' ';
                } else {
                    $op = is_array($val[$i]) ? $comparison[strtolower($val[$i][0])] : '=';
                    if (preg_match('/IN/i', $op)) {
                        $whereStr .= '(' . $key . ' ' . $op . ' (' . parseValue($data) . ')) ' . $rule . ' ';
                    } else {
                        $whereStr .= '(' . $key . ' ' . $op . ' ' . parseValue($data) . ') ' . $rule . ' ';
                    }

                }
            }
            $whereStr = substr($whereStr, 0, -4);
        }
    } else {
        $whereStr .= $key . ' = ' . parseValue($val);
    }
    return $whereStr;
}

/**
 * hpf
 *
 * 解析where数组条件的value
 * 数据库操作使用
 *
 * @param $value
 * @return array|string
 */
function parseValue($value)
{
    if (is_string($value) || is_numeric($value)) {
        $value = '\'' . escapeString($value) . '\'';
    } elseif (isset($value[0]) && is_string($value[0]) && strtolower($value[0]) == 'exp') {
        $value = $value[1];
    } elseif (is_array($value)) {
        $value = array_map('parseValue', $value);
    } elseif (is_null($value)) {
        $value = 'NULL';
    }
    return $value;
}

/**
 * hpf
 *
 * 重新加斜线(转义字符)，先去掉所有的转义字符，再重新自动加上转义字符，怕原来的加的有错误
 * 数据库操作使用
 *
 * @param $str
 * @return string
 */
function escapeString($str)
{
    $str = addslashes(stripslashes($str));//重新加斜线，防止从数据库直接读取出错
    return $str;
}

/**
 * hpf
 *
 * 记录和统计时间（微秒）
 *
 * @param $start
 * @param string $end
 * @param int $dec
 * @return string
 */
function addUpTime($start, $end = '', $dec = 3)
{
    static $_info = array();
    if (!empty($end)) { // 统计时间
        if (!isset($_info[$end])) {
            $_info[$end] = microtime(TRUE);
        }
        return number_format(($_info[$end] - $_info[$start]), $dec);
    } else { // 记录时间
        $_info[$start] = microtime(TRUE);
    }
}

/**
 * wdb
 *
 * 取得订单状态文字输出形式
 *
 * @param array $order_info 订单数组
 * @return string $order_state 描述输出
 */
function orderState($order_info)
{
    $order_state = '';
    switch ($order_info['order_state']) {
        case ORDER_STATE_CANCEL:
            $order_state = '已取消';
            break;
        case ORDER_STATE_NEW:
            if ($order_info['chain_code']) {
                $order_state = '门店付款自提';
            } else {
                $order_state = '待付款';
            }
            break;
        case ORDER_STATE_PAY:
            if ($order_info['chain_code']) {
                $order_state = '待自提';
            } else {
                $order_state = '待发货';
            }
            break;
        case ORDER_STATE_SEND:
            $order_state = '待收货';
            break;
        case ORDER_STATE_SUCCESS:
            $order_state = '交易完成';
            break;
    }
    return $order_state;
}

/**
 * wdb
 *
 * 取得订单支付类型文字输出形式
 *
 * @param array $payment_code
 * @return string
 */
function orderPaymentName($payment_code)
{
    return str_replace(
        array('offline', 'online', 'ali_native', 'alipay', 'tenpay', 'chinabank', 'predeposit', 'wxpay', 'wx_jsapi', 'wx_saoma', 'chain'),
        array('货到付款', '在线付款', '支付宝移动支付', '支付宝', '财付通', '网银在线', '站内余额支付', '微信支付[客户端]', '微信支付[jsapi]', '微信支付[扫码]', '门店支付'),
        $payment_code);
}

/**
 * wdb
 *
 * 取得订单商品销售类型文字输出形式
 *
 * @param array $goods_type
 * @return string 描述输出
 */
function orderGoodsType($goods_type)
{
    return str_replace(array(
        '1', '2', '3', '4', '5',
        '8', '9',
    ), array(
        '', '抢购', '限时折扣', '优惠套装', '赠品',
        '', '换购',
    ), $goods_type);
}

/**
 * wdb
 * 取得买家缩略图的完整URL路径
 *
 * @param string $image_name
 * @param string $type 缩略图类型  值为240,1024
 * @return string
 * @internal param string $imgurl 商品名称
 */
function snsThumb($image_name = '', $type = '')
{
    if (!in_array($type, array('240', '1024'))) $type = '240';
    if (empty($image_name)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }

    if (strpos($image_name, '/')) {
        $image = explode('/', $image_name);
        $image = end($image);
    } else {
        $image = $image_name;
    }

    list($member_id) = explode('_', $image);
    $file_path = ATTACH_MALBUM . DS . $member_id . DS . str_ireplace('.', '_' . $type . '.', $image_name);
    if (!file_exists(str_replace(' ', '', BASE_UPLOAD_PATH . DS . $file_path))) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    return str_replace(' ', '', UPLOAD_SITE_URL . DS . $file_path);
}

/**
 * ycg
 * 通过商品SKU获取当前的加价购活动ID
 * @param $data
 * @param $sku_id
 * @param $cou_id
 * @return mixed
 */
function indexedValues($data, $sku_id, $cou_id)
{
    if (!empty($data)) {
        foreach ($data as $k => $v) {
            $quna[$v[$sku_id]] = $v[$cou_id];
        }
    } else {
        $quna = $data;

    }
    return $quna;
}

/**
 * wdb
 * 会员标签图片
 * @param unknown $img
 * @return string
 */
function getMemberTagimage($img)
{
    return UPLOAD_SITE_URL . '/' . ATTACH_PATH . '/membertag/' . ($img != '' ? $img : 'default_tag.gif');
}

/**
 * ycg
 * 字符串切割函数，一个字母算一个位置,一个字算2个位置
 *
 * @param string $string 待切割的字符串
 * @param int $length 切割长度
 * @param string $dot 尾缀
 * @return string
 */
function str_cut($string, $length, $dot = '')
{
    $string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
    $strlen = strlen($string);
    if ($strlen <= $length) return $string;
    $maxi = $length - strlen($dot);
    $strcut = '';
    if (strtolower(CHARSET) == 'utf-8') {
        $n = $tn = $noc = 0;
        while ($n < $strlen) {
            $t = ord($string[$n]);
            if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1;
                $n++;
                $noc++;
            } elseif (194 <= $t && $t <= 223) {
                $tn = 2;
                $n += 2;
                $noc += 2;
            } elseif (224 <= $t && $t < 239) {
                $tn = 3;
                $n += 3;
                $noc += 2;
            } elseif (240 <= $t && $t <= 247) {
                $tn = 4;
                $n += 4;
                $noc += 2;
            } elseif (248 <= $t && $t <= 251) {
                $tn = 5;
                $n += 5;
                $noc += 2;
            } elseif ($t == 252 || $t == 253) {
                $tn = 6;
                $n += 6;
                $noc += 2;
            } else {
                $n++;
            }
            if ($noc >= $maxi) break;
        }
        if ($noc > $maxi) $n -= $tn;
        $strcut = substr($string, 0, $n);
    } else {
        $dotlen = strlen($dot);
        $maxi = $length - $dotlen;
        for ($i = 0; $i < $maxi; $i++) {
            $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
        }
    }
    $strcut = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;'), $strcut);
    return $strcut . $dot;
}

/**
 * ycg
 * 替换地址参数
 * @param array $param
 * @return string
 */
function replaceParam($param)
{
    $controllerName = $GLOBALS['di']['dispatcher']->getControllerName();
    $actionName = $GLOBALS['di']['dispatcher']->getActionName();

    $purl = array();
    if (!empty($_GET)) {
        $purl = $_GET;
    }
    unset($purl['_url']);
    $purl = array_merge($purl, $param);
    return getUrl('shop/' . $controllerName . '/' . $actionName, $purl);
}

/**
 * ycg
 * 删除地址参数(把参数的值赋值为0)
 * @param array $param
 * @return string
 */
function dropParam($param)
{
    $controllerName = $GLOBALS['di']['dispatcher']->getControllerName();
    $actionName = $GLOBALS['di']['dispatcher']->getActionName();
    $purl = array();
    if (!empty($_GET)) {
        $purl = $_GET;
    }
    unset($purl['_url']);
    foreach ($param as $val) {
        $param[$val] = 0;
    }
    $purl = array_merge($purl, $param);
    return getUrl('shop/' . $controllerName . '/' . $actionName, $purl);
}

/**
 * ycg
 * 删除地址参数
 * @param array $param
 */
function removeParam($param)
{

}

/**
 * 得到数组变量的GBK编码
 *（因系统不有GBK版本，为兼容之前程序原样返回）
 * @param array $key 数组
 * @return array 数组类型的返回结果
 */

function getGBK($key)
{
    return $key;
}

/**
 * 得到数组变量的UTF-8编码
 *（因系统不有GBK版本，为兼容之前程序原样返回）
 * @param array $key GBK编码数组
 * @return array 数组类型的返回结果
 */

function getUTF8($key)
{
    return $key;
}

/**
 * WDB
 * 获得折线图统计图数据
 * param $statarr 图表需要的设置项
 */
function getStatData_LineLabels($stat_arr)
{
    //图表区、图形区和通用图表配置选项
    $stat_arr['chart']['type'] = 'line';
    //图表序列颜色数组
    $stat_arr['colors'] ? '' : $stat_arr['colors'] = array('#058DC7', '#ED561B', '#8bbc21', '#0d233a');
    //去除版权信息
    $stat_arr['credits']['enabled'] = false;
    //导出功能选项
    $stat_arr['exporting']['enabled'] = false;
    //标题如果为字符串则使用默认样式
    is_string($stat_arr['title']) ? $stat_arr['title'] = array('text' => "<b>{$stat_arr['title']}</b>", 'x' => -20) : '';
    //子标题如果为字符串则使用默认样式
    is_string($stat_arr['subtitle']) ? $stat_arr['subtitle'] = array('text' => "<b>{$stat_arr['subtitle']}</b>", 'x' => -20) : '';
    //Y轴如果为字符串则使用默认样式
    if (is_string($stat_arr['yAxis'])) {
        $text = $stat_arr['yAxis'];
        unset($stat_arr['yAxis']);
        $stat_arr['yAxis']['title']['text'] = $text;
    }
    return json_encode($stat_arr);
}

/**
 * 获得系统年份数组
 */
function getSystemYearArr()
{
    $year_arr = array('2010' => '2010', '2011' => '2011', '2012' => '2012', '2013' => '2013', '2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018', '2019' => '2019', '2020' => '2020');
    return $year_arr;
}

/**
 * 获得系统月份数组
 */
function getSystemMonthArr()
{
    $month_arr = array('1' => '01', '2' => '02', '3' => '03', '4' => '04', '5' => '05', '6' => '06', '7' => '07', '8' => '08', '9' => '09', '10' => '10', '11' => '11', '12' => '12');
    return $month_arr;
}

/**
 * 获得系统周数组
 */
function getSystemWeekArr()
{
    $week_arr = array('1' => '周一', '2' => '周二', '3' => '周三', '4' => '周四', '5' => '周五', '6' => '周六', '7' => '周日');
    return $week_arr;
}

/**
 * 获得系统某月的周数组，第一周不足的需要补足
 */
function getMonthWeekArr($current_year, $current_month)
{
    //该月第一天
    $firstday = strtotime($current_year . '-' . $current_month . '-01');
    //该月的第一周有几天
    $firstweekday = (7 - date('N', $firstday) + 1);
    //计算该月第一个周一的时间
    $starttime = $firstday - 3600 * 24 * (7 - $firstweekday);
    //该月的最后一天
    $lastday = strtotime($current_year . '-' . $current_month . '-01' . " +1 month -1 day");
    //该月的最后一周有几天
    $lastweekday = date('N', $lastday);
    //该月的最后一个周末的时间
    $endtime = $lastday - 3600 * 24 * ($lastweekday % 7);
    $step = 3600 * 24 * 7;//步长值
    $week_arr = array();
    for ($i = $starttime; $i < $endtime; $i = $i + 3600 * 24 * 7) {
        $week_arr[] = array('key' => date('Y-m-d', $i) . '|' . date('Y-m-d', $i + 3600 * 24 * 6), 'val' => date('Y-m-d', $i) . '~' . date('Y-m-d', $i + 3600 * 24 * 6));
    }
    return $week_arr;
}


/**
 * 获得Basicbar统计图数据
 */
function getStatData_Basicbar($stat_arr)
{
    //图表区、图形区和通用图表配置选项
    $stat_arr['chart']['type'] = 'bar';
    //去除版权信息
    $stat_arr['credits']['enabled'] = false;
    //导出功能选项
    $stat_arr['exporting']['enabled'] = false;
    //显示datalabel
    $stat_arr['plotOptions']['bar']['dataLabels']['enabled'] = true;
    //标题如果为字符串则使用默认样式
    is_string($stat_arr['title']) ? $stat_arr['title'] = array('text' => "<b>{$stat_arr['title']}</b>", 'x' => -20) : '';
    //子标题如果为字符串则使用默认样式
    is_string($stat_arr['subtitle']) ? $stat_arr['subtitle'] = array('text' => "<b>{$stat_arr['subtitle']}</b>", 'x' => -20) : '';
    //Y轴如果为字符串则使用默认样式
    if (is_string($stat_arr['yAxis'])) {
        $text = $stat_arr['yAxis'];
        unset($stat_arr['yAxis']);
        $stat_arr['yAxis']['title']['text'] = $text;
    }
    //柱形的颜色数组
    $color = array('#7a96a4', '#cba952', '#667b16', '#a26642', '#349898', '#c04f51', '#5c315e', '#445a2b', '#adae50', '#14638a', '#b56367', '#a399bb', '#070dfa', '#47ff07', '#f809b7');

    foreach ($stat_arr['series'] as $series_k => $series_v) {
        foreach ($series_v['data'] as $data_k => $data_v) {
            if (!$data_v['color']) {
                $data_v['color'] = $color[$data_k % 15];
            }
            $series_v['data'][$data_k] = $data_v;
        }
        $stat_arr['series'][$series_k]['data'] = $series_v['data'];
    }
    //print_r($stat_arr); die;
    return json_encode($stat_arr);
}

/**
 * 获得Column2D统计图数据
 */
function getStatData_Column2D($stat_arr)
{
    //图表区、图形区和通用图表配置选项
    $stat_arr['chart']['type'] = 'column';
    //去除版权信息
    $stat_arr['credits']['enabled'] = false;
    //导出功能选项
    $stat_arr['exporting']['enabled'] = false;
    //标题如果为字符串则使用默认样式
    is_string($stat_arr['title']) ? $stat_arr['title'] = array('text' => "<b>{$stat_arr['title']}</b>", 'x' => -20) : '';
    //子标题如果为字符串则使用默认样式
    is_string($stat_arr['subtitle']) ? $stat_arr['subtitle'] = array('text' => "<b>{$stat_arr['subtitle']}</b>", 'x' => -20) : '';
    //Y轴如果为字符串则使用默认样式
    if (is_string($stat_arr['yAxis'])) {
        $text = $stat_arr['yAxis'];
        unset($stat_arr['yAxis']);
        $stat_arr['yAxis']['title']['text'] = $text;
    }
    //柱形的颜色数组
    $color = array('#7a96a4', '#cba952', '#667b16', '#a26642', '#349898', '#c04f51', '#5c315e', '#445a2b', '#adae50', '#14638a', '#b56367', '#a399bb', '#070dfa', '#47ff07', '#f809b7');

    foreach ($stat_arr['series'] as $series_k => $series_v) {
        foreach ($series_v['data'] as $data_k => $data_v) {
            $data_v['color'] = $color[$data_k];
            $series_v['data'][$data_k] = $data_v;
        }
        $stat_arr['series'][$series_k]['data'] = $series_v['data'];
    }
    //print_r($stat_arr); die;
    return json_encode($stat_arr);
}

/**
 * 获取本周的开始时间和结束时间
 */
function getWeek_SdateAndEdate($current_time)
{
    $current_time = strtotime(date('Y-m-d', $current_time));
    $return_arr['sdate'] = date('Y-m-d', $current_time - 86400 * (date('N', $current_time) - 1));
    $return_arr['edate'] = date('Y-m-d', $current_time + 86400 * (7 - date('N', $current_time)));
    return $return_arr;
}

/**
 * 获取某月的最后一天
 */
function getMonthLastDay($year, $month)
{
    $t = mktime(0, 0, 0, $month + 1, 1, $year);
    $t = $t - 60 * 60 * 24;
    return $t;
}

/**
 * 计算同比
 */
function getTb($updata, $currentdata)
{
    if ($updata != 0) {
        $ytoyrate = round(($currentdata - $updata) / $updata * 100, 2) . '%';
    } else {
        $ytoyrate = '-';
    }
    return $ytoyrate;
}

/**
 * flexigrid.js返回的数组
 * @param array $in_array 需要进行赋值的数据（提供给页面中JS使用）
 * @param array $fields_array 赋值下标的数组
 * @param array $data 从数据库读出的未处理数据
 * @param array $format_array 格式化价格下标的数组
 * @return array 处理后的数据
 */
function getFlexigridArray($in_array, $fields_array, $data, $format_array = array())
{
    $out_array = $in_array;
    if (empty($out_array['operation'])) {
        $out_array['operation'] = '--';
    }
    if (!empty($fields_array) && is_array($fields_array)) {
        foreach ($fields_array as $key => $value) {
            $k = '';
            if (is_int($key)) {
                $k = $value;
            } else {
                $k = $key;
            }
            if (is_array($data) && array_key_exists($k, $data)) {
                $out_array[$k] = $data[$k];
                if (!empty($format_array) && in_array($k, $format_array)) {
                    $out_array[$k] = ncPriceFormat($data[$k]);
                }
            } else {
                $out_array[$k] = '--';
            }
        }
    }
    return $out_array;
}

/**
 * 地图统计图
 */
function getStatData_Map($stat_arr)
{
    //$color_arr = array('#f63a3a','#ff5858','#ff9191','#ffc3c3','#ffd5d5');
    $color_arr = array('#fd0b07', '#ff9191', '#f7ba17', '#fef406', '#25aae2');
    $stat_arrnew = array();
    foreach ($stat_arr as $k => $v) {
        $stat_arrnew[] = array('cha' => $v['cha'], 'name' => $v['name'], 'des' => $v['des'], 'color' => $color_arr[$v['level']]);
    }
    return json_encode($stat_arrnew);
}

/**
 * 获得饼形图数据
 */
function getStatData_Pie($data)
{
    $stat_arr['chart']['type'] = 'pie';
    $stat_arr['credits']['enabled'] = false;
    $stat_arr['title']['text'] = $data['title'];
    $stat_arr['tooltip']['pointFormat'] = '{series.name}: <b>{point.y}</b>';
    $stat_arr['plotOptions']['pie'] = array(
        'allowPointSelect' => true,
        'cursor' => 'pointer',
        'dataLabels' => array(
            'enabled' => $data['label_show'],
            'color' => '#000000',
            'connectorColor' => '#000000',
            'format' => '<b>{point.name}</b>: {point.percentage:.1f} %'
        )
    );
    $stat_arr['series'][0]['name'] = $data['name'];
    $stat_arr['series'][0]['data'] = array();
    foreach ($data['series'] as $k => $v) {
        $stat_arr['series'][0]['data'][] = array($v['p_name'], $v['allnum']);
    }
    //exit(json_encode($stat_arr));
    return json_encode($stat_arr);
}

/**
 * ycg
 * 取得抢购缩略图的完整URL路径
 *
 * @param string $image_name
 * @param string $type 缩略图类型  值为small,mid,max
 * @return string
 */
function gthumb($image_name = '', $type = '')
{
    if (!in_array($type, array('small', 'mid', 'max'))) $type = 'small';
    if (empty($image_name)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    list($base_name, $ext) = explode('.', $image_name);
    list($store_id) = explode('_', $base_name);
    $file_path = ATTACH_GROUPBUY . DS . $store_id . DS . $base_name . '_' . $type . '.' . $ext;
    if (!file_exists(BASE_UPLOAD_PATH . DS . $file_path)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    return UPLOAD_SITE_URL . DS . $file_path;
}

/**
 * ycg
 * 替换并删除地址参数
 *
 * @param $paramToReplace
 * @param $paramToDrop
 * @return string
 */
function replaceAndDropParam($paramToReplace, $paramToDrop)
{
    $purl = $_GET;
    if (!empty($paramToReplace)) {
        foreach ($paramToReplace as $key => $val) {
            $purl['param'][$key] = $val;
        }
    }
    if (!empty($paramToDrop)) {
        foreach ($paramToDrop as $val) {
            $purl['param'][$val] = 0;
        }
    }
    return getUrl('shop/' . $GLOBALS['di']['dispatcher']->getControllerName() . '/' . $GLOBALS['di']['dispatcher']->getActionName() . '?' . $purl['param']);
}

/**
 * wdb
 * 删除缓存目录下的文件或子目录文件
 *
 * @param string $dir 目录名或文件名
 * @return boolean
 */
function delCacheFile($dir)
{
    //防止删除cache以外的文件
    if (strpos($dir, '..') !== false) return false;
    $path = BASE_CACHE_PATH . DS . $dir;
    if (is_dir($path)) {
        $file_list = array();
        readFileList($path, $file_list);
        if (!empty($file_list)) {
            foreach ($file_list as $v) {
                if (basename($v) != 'index.html') @unlink($v);
            }
        }
    } else {
        if (basename($path) != 'index.html') @unlink($path);
    }
    return true;
}

/**
 * 调用推荐位
 *
 * @param int $rec_id
 * @return string
 */
function rec_position($rec_id = null)
{
    if (!is_numeric($rec_id)) return null;
    $string = '';

    if (getConfig('cache_open')) {
        $info = read_file_cache("rec_position/{$rec_id}", function ($rec_id) {
            return Model('rec_position')->where(array('rec_id' => $rec_id))->find();
        });
    } else {
        $info = Model('rec_position')->where(array('rec_id' => $rec_id))->find();
        write_file_cache("rec_position/{$rec_id}", $info);
    }

    $info['content'] = unserialize($info['content']);
    if ($info['content']['target'] == 2) $target = 'target="_blank"'; else $target = '';
    if ($info['pic_type'] == 0) {//文字
        foreach ((array)$info['content']['body'] as $v) {
            $href = '';
            if ($v['url'] != '') $href = "href=\"{$v['url']}\"";
            $string .= "<li><a {$target} {$href}>{$v['title']}</a></li>";
        }
        $string = "<ul>{$string}</ul>";
    } else {//图片
        $width = $height = '';
        if (is_numeric($info['content']['width'])) $width = "width=\"{$info['content']['width']}\"";
        if (is_numeric($info['content']['height'])) $height = "height=\"{$info['content']['height']}\"";
        if (is_array($info['content']['body'])) {
            if (count($info['content']['body']) > 1) {
                foreach ($info['content']['body'] as $v) {
                    if ($info['pic_type'] == 1) $v['title'] = UPLOAD_SITE_URL . '/' . $v['title'];
                    $href = '';
                    if ($v['url'] != '') $href = "href=\"{$v['url']}\"";
                    $string .= "<li><a {$target} {$href}><img {$width} {$height} src=\"{$v['title']}\"></a></li>";
                }
                $string = "<ul>{$string}</ul>";
            } else {
                $v = $info['content']['body'][0];
                if ($info['pic_type'] == 1) $v['title'] = UPLOAD_SITE_URL . '/' . $v['title'];
                $href = '';
                if ($v['url'] != '') $href = "href=\"{$v['url']}\"";
                $string .= "<a {$target} {$href}><img {$width} {$height} src=\"{$v['title']}\"></a>";
            }
        }
    }
    return $string;
}

/**
 * 将字符部分加密并输出
 * @param string $str
 * @param int $start 从第几个位置开始加密(从1开始)
 * @param int $length 连续加密多少位
 * @return string
 */
function encryptShow($str, $start, $length)
{
    $end = $start - 1 + $length;
    $array = str_split($str);
    foreach ($array as $k => $v) {
        if ($k >= $start - 1 && $k < $end) {
            $array[$k] = '*';
        }
    }
    return implode('', $array);
}

/**
 * 获取运单图片地址
 */
function getMbSpecialImageUrl($image_name = '')
{
    $name_array = explode('_', $image_name);
    if (count($name_array) == 2) {
        $image_path = DS . ATTACH_MOBILE . DS . 'special' . DS . $name_array[0] . DS . $image_name;
    } else {
        $image_path = DS . ATTACH_MOBILE . DS . 'special' . DS . $image_name;
    }
    if (is_file(BASE_UPLOAD_PATH . $image_path)) {
        return UPLOAD_SITE_URL . $image_path;
    } else {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
}

/**
 * 商品二维码
 * @param array $goods_info
 * @return string
 */
function goodsQRCode($goods_info)
{
    if (!file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_STORE . '/' . $goods_info['store_id'] . '/' . $goods_info['goods_id'] . '.png')) {
        return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . 'default_qrcode.png';
    }
    return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . $goods_info['store_id'] . DS . $goods_info['goods_id'] . '.png';
}

/**
 * 取得结算文字输出形式
 *
 * @param array $bill_state
 * @return string 描述输出
 */
function billState($bill_state)
{
    return str_replace(
        array('1', '2', '3', '4'),
        array('已出账', '商家已确认', '平台已审核', '结算完成'),
        $bill_state);
}

/**
 * 输出validate的验证信息
 *
 * @param array /string $error
 */
function showValidateError($error)
{
    if (!empty($_GET['inajax'])) {
        foreach (explode('<br/>', $error) as $v) {
            if (trim($v != '')) {
                showDialog($v, '', 'error', '', 3);
            }
        }
    } else {
        showDialog($error, '', 'error', '', 3);
    }
}

/**
 * 获取运单图片地址
 */
function getWaybillImageUrl($image_name = '')
{
    $image_path = DS . ATTACH_WAYBILL . DS . $image_name;
    if (is_file(BASE_UPLOAD_PATH . $image_path)) {
        return UPLOAD_SITE_URL . $image_path;
    } else {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
}

/**
 * 加载完成业务方法的文件
 *
 * @param string $filename
 * @param string $file_ext
 */
function loadfunc($filename, $file_ext = '.php')
{
    if (preg_match('/^[\w\d\/_.]+$/i', $filename . $file_ext)) {
        $file = realpath(APP_PATH . '/common/library/' . $filename . $file_ext);
    } else {
        $file = false;
    }
    if (!$file) {
        exit($filename . $file_ext . ' isn\'t exists!');
    } else {
        require_once($file);
    }
}

/**
 * 二维数组排序
 *
 * @param array $arrays 要排序的二维数组
 * @param string $sort_key 按照哪个字段排序
 * @param int $sort_order 升序还是降序 SORT_ASC：升序 SORT_DESC：降序
 * @param int $sort_type 排序类型，按照数字大小排序或者按照字符串字母顺序排序
 * @return bool|array
 */
function sort_two($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
{
    if (is_array($arrays)) {
        foreach ($arrays as $array) {
            if (is_array($array)) {
                $key_arrays[] = $array[$sort_key];
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
    array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
    return $arrays;
}

/**
 * hpf
 *
 * 将内容进行UNICODE编码，编码后的内容格式：\u56fe\u7247 （原始文字：图片）
 *
 * @param string $name
 * @return string
 */
function unicode_encode($name)
{
    $name = iconv('UTF-8', 'UCS-2', $name);
    $len = strlen($name);
    $str = '';
    for ($i = 0; $i < $len - 1; $i = $i + 2) {
        $c = $name[$i];
        $c2 = $name[$i + 1];
        if (ord($c) > 0) {    // 两个字节的文字
            $str .= '\u' . base_convert(ord($c), 10, 16) . base_convert(ord($c2), 10, 16);
        } else {
            $str .= $c2;
        }
    }
    return $str;
}

/**
 * hpf
 *
 * 将UNICODE编码后的内容进行解码，编码后的内容格式：\u56fe\u7247 （原始文字：图片）
 *
 * @param string $name
 * @return string
 */
function unicode_decode($name)
{
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
    preg_match_all($pattern, $name, $matches);
    if (!empty($matches)) {
        $name = '';
        for ($j = 0; $j < count($matches[0]); $j++) {
            $str = $matches[0][$j];
            if (strpos($str, '\\u') === 0) {
                $code = base_convert(substr($str, 2, 2), 16, 10);
                $code2 = base_convert(substr($str, 4), 16, 10);
                $c = chr($code) . chr($code2);
                $c = iconv('UCS-2', 'UTF-8', $c);
                $name .= $c;
            } else {
                $name .= $str;
            }
        }
    }
    return $name;
}