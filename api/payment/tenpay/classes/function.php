<?php

// 请注意服务器是否开通fopen配置
function log_result($word)
{
    $file = BASE_PATH . '/log/tenpay/' . date('Y-m-d') . '.log';
    if (!file_exists($file)) {
        if (!file_exists(dirname($file))) {
            mkDirs(dirname($file));
        }
    }
    $fp = fopen($file, "a");
    flock($fp, LOCK_EX);
    fwrite($fp, "执行日期：" . strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}