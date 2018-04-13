用户留言板说明：

框架：lumen 5.6
环境：php7.2  nginx  mysql
 
功能:用户留言，评论，注册，登录，管理员对留言以及评论的编辑和删除

注册登录实现功能为简单的注册登录，登录判断有唯一的方法作为入口进行判断 后期可以根据需求做改动。

管理员页面  /admin

数据库：news  导入文件news.sql
nginx虚拟域名配置：见vhosts.conf

表格两个  一个用户表（user） 一个内容表（message_content）