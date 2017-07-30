<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/20
 * Time: 12:08
 */

session_start();

//todo 做自己项目时，用户中心、后台管理中心、商铺中心的图片文件分别以$_GET['user_type'](身份类型)文件夹隔开

@date_default_timezone_set('Asia/Shanghai');

define('BASE_PATH', str_replace('\\', '/', dirname(__FILE__) . '/../../../../'));

//加载配置文件和公共函数库
if (file_exists(BASE_PATH . '/app/config/global_const.php')) {
    require_once BASE_PATH . '/app/config/global_const.php';
} else {
    alert('文件上传的配置文件不存在!');
}

//验证用户是否有上传权限
$user_dir = false; //默认没有上传权限
if (file_exists(BASE_PATH . '/public/resource/kindeditor/php/check_login.php')) {
    require_once BASE_PATH . '/public/resource/kindeditor/php/check_login.php';
    $user_dir = check_login(); //内部会获取“用户id_用户名”形式的目录名
} else {
    alert('用户上传权限验证文件不存在，请联系管理员!');
}

//文件保存目录路径
$save_path = BASE_UPLOAD_PATH . '/' . ATTACH_EDITOR . '/';
//文件访问URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
$save_url = UPLOAD_SITE_URL . '/' . ATTACH_EDITOR . '/';

//目录名
$dir_name = !isset($_GET['dir']) || empty($_GET['dir']) ? '' : trim($_GET['dir']);
if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
    echo "不可用的文件夹.";
    exit;
}
if ($dir_name !== '') {
    $save_path .= $dir_name . "/";
    $save_url .= $dir_name . "/";

    //定义允许上传的文件扩展名
    if ($dir_name == 'image') {
        $ext_arr = getConfig('allow_upload_image_type');
    } else if ($dir_name == 'flash') {
        $ext_arr = getConfig('allow_upload_flash_type');
    } else if ($dir_name == 'media') {
        $ext_arr = getConfig('allow_upload_media_type');
    }

} else {
    //定义允许上传的文件扩展名,MOREN
    alert("没有设置上传目录。");
}

if ($user_dir != false) {
    $save_path .= $user_dir . "/";
    $save_url .= $user_dir . "/";
    //上传目录不存在时就递归创建
    if (!file_exists($save_path)) {
        if(mkDirs(iconv('utf-8','gbk',$save_path))===false){
            mkDirs($save_path);
        }
    }
}
$save_path=iconv('utf-8','gbk',$save_path);
//最大文件大小
$max_size = 1000000;

//有上传文件时
if (empty($_FILES) === false) {
    //原文件名
    $file_name = $_FILES['imgFile']['name'];
    //服务器上临时文件名
    $tmp_name = $_FILES['imgFile']['tmp_name'];
    //文件大小
    $file_size = $_FILES['imgFile']['size'];
    //检查文件名
    if (!$file_name) {
        alert("请选择文件。");
    }
    //检查目录
    //iconv('gbk','utf-8',$save_path);
    if (@is_dir($save_path) === false) {
        alert("上传目录不存在。");
    }
    //检查目录写权限
    if (@is_writable($save_path) === false) {
        alert("上传目录没有写权限。");
    }
    //检查是否已上传
    if (@is_uploaded_file($tmp_name) === false) {
        alert("临时文件可能不是上传文件。");
    }
    //检查文件大小
    if ($file_size > $max_size) {
        alert("上传文件大小超过限制。");
    }
    //获得文件扩展名
    $temp_arr = explode(".", $file_name);
    $file_ext = array_pop($temp_arr);
    $file_ext = trim($file_ext);
    $file_ext = strtolower($file_ext);
    //检查扩展名
    if (in_array($file_ext, $ext_arr) === false) {
        alert("上传文件扩展名是不允许的扩展名。");
    }
    //新文件名
    $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    //移动文件
    $file_path = $save_path . $new_file_name;
    if (move_uploaded_file($tmp_name, $file_path) === false) {
        alert("上传文件失败。");
    }
    @chmod($file_path, 0644);
    $file_url = $save_url . $new_file_name;

    header('Content-type: text/html; charset=UTF-8');
    echo json_encode(array('error' => 0, 'url' => $file_url));
    exit;
}

/**
 * 让浏览器弹出alert提示框（kindeditor设置上传文件时使用）
 * @param $msg
 */
function alert($msg)
{
    header('Content-type: text/html; charset=UTF-8');
    echo json_encode(array('error' => 1, 'message' => $msg));
    exit;
}