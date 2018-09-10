初始化项目，分别执行以下命令
1. 环境配置文件 cp .env.example .env 
只需配置数据库

2. composer install  composer #下载依赖，详情：https://pkg.phpcomposer.com/
3. php artisan admin:install #laravel-admin安装，初始化后台管理员admin, 密码admin
4. php artisan migrate #生成数据库
5. php artisan db:seed #生成初始化数据