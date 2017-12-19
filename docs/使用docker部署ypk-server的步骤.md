安装docker

修改php配置文件ypk/app/config/global_config.php中的 "$global_config['node_site_url'] = 'http://localhost:8096';" 的localhost为你的聊天服务器ip或者域名

修改node-chat聊天服务器的的配置文件ypk/node_chat_server/im/config.js中的 "exports.hostname = 'localhost';" 的localhost为你的聊天服务器ip或者域名

在终端中进入项目根路径ypk，然后运行命令docker-compose -f ./dockerfiles/docker-compose.yml up -d就好了，等待所有的容器运行起来，服务就发布好了