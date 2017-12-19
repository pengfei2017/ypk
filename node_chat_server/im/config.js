/**
 * xingsu
 */
var config = {};//数据库帐号设置

//config['host'] = '180.76.141.156';//数据库地址
config['host'] = 'ypk-database';//数据库地址
config['port'] = '3306';//数据库端口
config['user'] = 'root';//数据库用户名
config['password'] = 'hpf';//数据库密码
config['database'] = 'ypk';//mysql数据库名
config['tablepre'] = '';//表前缀
config['insecureAuth'] = true;//兼容低版本
config['debug'] = true;//默认false

//exports.hostname = '192.168.1.104';//把网址修改为你安装商城的域名，不要带http://及/
exports.hostname = 'node-chat-server';//把网址修改为你安装商城的域名，不要带http://及/
exports.port = 8096;//服务器所用端口号,默认8090
exports.config = config;
