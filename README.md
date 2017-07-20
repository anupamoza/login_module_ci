# login_module_ci
Login module for CodeIgniter upto version 3.x

Installation Steps :

1. Install Codeigniter and modular extension - HMVC (Installation Ref. URL : http://www.techitgeeks.com/2017/04/15/install-modular-extensions-hmvc/ )
2. Copy modules/login directory in application/modules/
3. Run SQL query below :
        create database login;
        CREATE TABLE IF NOT EXISTS `user_login` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_name` varchar(255) NOT NULL,
        `user_email` varchar(255) NOT NULL,
        `user_password` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) 
4. Sign up to create one user using your base_url + /login/user_registration_show and then login using same credentials.