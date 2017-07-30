<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24
 * Time: 13:46
 */

namespace Ypk;

/**
 * 邮件操作类，目前只支持smtp服务的邮件发送
 * Class Email
 * @package Ypk
 */
final class Email
{
    /**
     * 邮件服务器
     */
    private $email_server;
    /**
     * 端口
     */
    private $email_port;
    /**
     * 账号
     */
    private $email_user;
    /**
     * 密码
     */
    private $email_password;
    /**
     * 发送邮箱
     */
    private $email_from;
    /**
     * 间隔符
     */
    private $email_delimiter = "\n";
    /**
     * 站点名称
     */
    private $site_name;

    public function get($key)
    {
        if (!empty($this->$key)) {
            return $this->$key;
        } else {
            return false;
        }
    }

    public function set($key, $value)
    {
        if (!isset($this->$key)) {
            $this->$key = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 发送邮件
     *
     * @param string $email_to 发送对象邮箱地址
     * @param string $subject 邮件标题
     * @param string $message 邮件内容
     * @param string $from 页头来源内容
     * @return bool 布尔形式的返回结果
     */
    public function send($email_to, $subject, $message, $from = '')
    {
        if (empty($email_to)) return false;
        $email_to = $this->to($email_to);

        require BASE_API_PATH . '/phpmailer/PHPMailerAutoload.php';

        $mail = new \PHPMailer;
        $mail->isSMTP();
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';
        $mail->Host = $this->email_server;
        $mail->Port = $this->email_port;
        $mail->SMTPAuth = true;
        $mail->Username = $this->email_user;
        $mail->Password = $this->email_password;
        $mail->CharSet = CHARSET;
        $mail->setFrom($this->email_from, $this->site_name);
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        $mail->addAddress($email_to);
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        //$mail->AltBody = 'This is a plain-text message body';
        //$mail->addAttachment('examples/images/phpmailer_mini.png');

        if (!$mail->send()) {
            Log::record("对不起，邮件发送失败！请检查邮箱填写是否有误。" . $mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param string $email_to 发送对象邮箱地址
     * @param string $subject 邮件标题
     * @param $message
     * @return bool
     */
    public function send_sys_email($email_to, $subject, $message)
    {
        $this->set('email_server', getConfig('email_host'));
        $this->set('email_port', getConfig('email_port'));
        $this->set('email_user', getConfig('email_id'));
        $this->set('email_password', getConfig('email_pass'));
        $this->set('email_from', getConfig('email_addr'));
        $this->set('site_name', getConfig('site_name'));
        $result = $this->send($email_to, $subject, $message);
        return $result;
    }

    /**
     * 内容:邮件主体
     *
     * @param string $subject 邮件标题
     * @param string $message 邮件内容
     * @return string 字符串形式的返回结果
     */
    private function html($subject, $message)
    {
        $tmp = '';
        $message = preg_replace("/href\=\"(?!http\:\/\/)(.+?)\"/i", 'href="' . SHOP_SITE_URL . '\\1"', $message);
        $tmp .= "<html><head>";
        $tmp .= '<meta http-equiv="Content-Type" content="text/html; charset=' . CHARSET . '">';
        $tmp .= "<title>" . $subject . "</title>";
        $tmp .= "</head><body>" . $message . "</body></html>";
        $message = $tmp;
        unset($tmp);
        return $message;
    }

    /**
     * 发送对象邮件地址
     *
     * @param string $email_to 发送地址
     * @return string 字符串形式的返回结果
     */
    private function to($email_to)
    {
        $email_to = preg_match('/^(.+?) \<(.+?)\>$/', $email_to, $mats) ? ($this->email_user ? '=?' . CHARSET . '?B?' . base64_encode($mats[1]) . "?= <$mats[2]>" : $mats[2]) : $email_to;
        return $email_to;
    }

    /**
     * 内容:邮件标题
     *
     * @param string $subject 邮件标题
     * @return string 字符串形式的返回结果
     */
    private function subject($subject)
    {
        $subject = '=?' . CHARSET . '?B?' . base64_encode(preg_replace("/[\r|\n]/", '', '[' . $this->site_name . '] ' . $subject)) . '?=';
        return $subject;
    }

    /**
     * 内容:邮件主体内容
     *
     * @param string $message 邮件主体内容
     * @return string 字符串形式的返回结果
     */
    private function message($message)
    {
        $message = chunk_split(base64_encode(str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $message))))));
        return $message;
    }

    /**
     * 内容:邮件页头
     *
     * @param string $from 邮件页头来源
     * @return array $rs_row 返回数组形式的查询结果
     */
    private function header($from = '', $message)
    {
        if ($from == '') {
            $from = '=?' . CHARSET . '?B?' . base64_encode($this->site_name) . "?= <" . $this->email_from . ">";
        } else {
            $from = preg_match('/^(.+?) \<(.+?)\>$/', $from, $mats) ? '=?' . CHARSET . '?B?' . base64_encode($mats[1]) . "?= <$mats[2]>" : $from;
        }
        $header = "From: $from{$this->email_delimiter}";
        $header .= "X-Priority: 3{$this->email_delimiter}";
        $header .= "X-Mailer: xingsu {$this->email_delimiter}";
        $header .= "MIME-Version: 1.0{$this->email_delimiter}";
        $header .= "Content-type: text/html; ";
        $header .= "charset=" . CHARSET . "{$this->email_delimiter}";
        $header .= "Content-Transfer-Encoding: base64{$this->email_delimiter}";
        $header .= 'Message-ID: <' . gmdate('YmdHs') . '.' . substr(md5($message . microtime()), 0, 6) . rand(100000, 999999) . '@' . $_SERVER['HTTP_HOST'] . ">{$this->email_delimiter}";
        return $header;
    }

    /**
     * 错误信息记录
     *
     * @param string $msg 错误信息
     * @return bool 布尔形式的返回结果
     */
    private function resultLog($msg)
    {
        if (getConfig('debug') === true) {
            Log::record('Email\\' . $msg);
            return true;
        } else {
            return true;
        }
    }
}