<meta charset="utf-8">
<?php
date_default_timezone_set('Asia/Shanghai');

require 'PHPMailerAutoload.php';

/**
 * 注：本邮件类都是经过我测试成功了的，如果大家发送邮件的时候遇到了失败的问题，请从以下几点排查：
 * 1. 用户名和密码是否正确；
 * 2. 检查邮箱设置是否启用了smtp服务；
 * 3. 是否是php环境的问题导致；
 * 4. 将26行的$smtp->debug = false改为true，可以显示错误信息，然后可以复制报错信息到网上搜一下错误的原因
 */
//******************** 配置信息 ********************************
$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport = 25;//SMTP服务器端口
$smtpusermail = "ymjkgl@163.com";//SMTP服务器的用户邮箱
$smtpemailto = $_POST['toemail'];//发送给谁
$smtpuser = "ymjkgl";//SMTP服务器的用户帐号
$smtppass = "ypk20172017";//SMTP服务器的用户密码
$charset = "UTF-8";//SMTP服务器的编码
$mailtitle = $_POST['title'];//邮件主题
$mailcontent = "<h1>" . $_POST['content'] . "</h1>";//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = $smtpserver;
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = $smtpserverport;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = $smtpuser;
//Password to use for SMTP authentication
$mail->Password = $smtppass;
$mail->CharSet = $charset;
//Set who the message is to be sent from
$mail->setFrom($smtpusermail, '逸陪康健康管理');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($smtpemailto, '小河');
//Set the subject line
$mail->Subject = $mailtitle;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($mailcontent);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
$mail->addAttachment('examples/images/phpmailer_mini.png');

//send the message, check for errors
echo "<div style='width:300px; margin:36px auto;'>";
if (!$mail->send()) {
    echo "对不起，邮件发送失败！请检查邮箱填写是否有误。" . $mail->ErrorInfo;
    echo "<a href='index.html'>点此返回</a>";
    exit();
} else {
    echo "恭喜！邮件发送成功！！";
    echo "<a href='index.html'>点此返回</a>";
}
echo "</div>";