<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/22
 * Time: 1:30
 */

namespace Ypk;

/**
 * CSV作类，目前只支持smtp服务的邮件发送
 */
final class Csv
{
    public $filename;

    public function export($data)
    {
        if (!is_array($data)) return;
        $string = '';
        $new = array();
        foreach ($data as $k => $v) {
            foreach ($v as $xk => $xv) {
                $v[$xk] = str_replace(',', '', $xv);
            }
            $new[] = implode(',', $v);
        }
        if (!empty($new)) {
            $string = implode("\n", $new);
        }

        ob_clean(); //清除缓冲区,避免乱码

        header("Content-Type: application/vnd.ms-excel; charset=GBK");
        header("Content-Disposition: attachment;filename={$this->filename}.csv");
        echo $string;
    }

    /**
     * 转码函数
     *
     * @param mixed $content
     * @param string $from
     * @param string $to
     * @return mixed
     */
    public function charset($content, $from = 'gbk', $to = 'utf-8')
    {
        $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
        $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
        if (strtoupper($from) === strtoupper($to) || empty($content)) {
            //如果编码相同则不转换
            return $content;
        }
        if (function_exists('mb_convert_encoding')) {
            if (is_array($content)) {
                $content = var_export($content, true);
                $content = mb_convert_encoding($content, $to, $from);
                eval("\$content = $content;");
                return $content;
            } else {
                return mb_convert_encoding($content, $to, $from);
            }
        } elseif (function_exists('iconv')) {
            if (is_array($content)) {
                $content = var_export($content, true);
                $content = iconv($from, $to, $content);
                eval("\$content = $content;");
                return $content;
            } else {
                return iconv($from, $to, $content);
            }
        } else {
            return $content;
        }
    }
}

?>