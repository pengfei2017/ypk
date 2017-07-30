<?php
/*
 * 配置文件
 */
$options = array();
$options['apikey'] = getConfig('hao_sms_key'); //apikey
$options['signature'] = getConfig('hao_sms_signature'); //签名
return $options;
?>