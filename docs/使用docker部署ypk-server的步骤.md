安装docker

修改php配置文件ypk/app/config/global_config.php中的 "$global_config['node_site_url'] = 'http://localhost:8096';" 的localhost为你的聊天服务器ip或者域名

修改node-chat聊天服务器的的配置文件ypk/node_chat_server/im/config.js中的 "exports.hostname = 'localhost';" 的localhost为你的聊天服务器ip或者域名

在终端中进入项目根路径ypk，然后运行命令docker-compose -f ./dockerfiles/docker-compose.yml up -d就好了，等待所有的容器运行起来，服务就发布好了

若要调试phalcon代码，请继续执行一下步骤
修改php的xdebug调试模块的配置文件ypk/xdebug-config/docker-php-ext-xdebug.ini中的 "xdebug.remote_host = 192.168.1.45" 的ip为你的apache服务器的ip