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
    $user_dir = check_login();
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
        mkDirs($save_path);
    }
}

//根据path参数，设置各路径和URL
if (empty($_GET['path'])) {
    $current_path = realpath($save_path) . '/';
    $current_url = $save_url;
    $current_dir_path = '';
    $moveup_dir_path = '';
} else {
    $current_path = realpath($save_path) . '/' . $_GET['path'];
    $current_url = $save_url . $_GET['path'];
    $current_dir_path = $_GET['path'];
    $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
}
//echo realpath($root_path);
//排序形式，name or size or type
$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

//不允许使用..移动到上一级目录
if (preg_match('/\.\./', $current_path)) {
    echo '不允许访问上一层目录.';
    exit;
}
//最后一个字符不是/
if (!preg_match('/\/$/', $current_path)) {
    echo '无效的目录，最后一个字符不是"/".';
    exit;
}
//目录不存在或不是目录
if (!file_exists($current_path) || !is_dir($current_path)) {
    echo '目录不存在.';
    exit;
}

//遍历目录取得文件信息
$file_list = array();
if ($handle = opendir($current_path)) {
    $i = 0;
    while (false !== ($filename = readdir($handle))) {
        if ($filename{0} == '.') continue;
        $file = $current_path . $filename;
        if (is_dir($file)) {
            $file_list[$i]['is_dir'] = true; //是否文件夹
            $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
            $file_list[$i]['filesize'] = 0; //文件大小
            $file_list[$i]['is_photo'] = false; //是否图片
            $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
        } else {
            $file_list[$i]['is_dir'] = false;
            $file_list[$i]['has_file'] = false;
            $file_list[$i]['filesize'] = filesize($file);
            $file_list[$i]['dir_path'] = '';
            $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
            $file_list[$i]['filetype'] = $file_ext;
        }
        $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
        $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
        $i++;
    }
    closedir($handle);
}

//排序
function cmp_func($a, $b)
{
    global $order;
    if ($a['is_dir'] && !$b['is_dir']) {
        return -1;
    } else if (!$a['is_dir'] && $b['is_dir']) {
        return 1;
    } else {
        if ($order == 'size') {
            if ($a['filesize'] > $b['filesize']) {
                return 1;
            } else if ($a['filesize'] < $b['filesize']) {
                return -1;
            } else {
                return 0;
            }
        } else if ($order == 'type') {
            return strcmp($a['filetype'], $b['filetype']);
        } else {
            return strcmp($a['filename'], $b['filename']);
        }
    }
}

usort($file_list, 'cmp_func');

$result = array();
//相对于根目录的上一级目录
$result['moveup_dir_path'] = $moveup_dir_path;
//相对于根目录的当前目录
$result['current_dir_path'] = $current_dir_path;
//当前目录的URL
$result['current_url'] = $current_url;
//文件数
$result['total_count'] = count($file_list);
//文件列表数组
$result['file_list'] = $file_list;

//输出JSON字符串
header('Content-type: application/json; charset=UTF-8');
echo json_encode($result);

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