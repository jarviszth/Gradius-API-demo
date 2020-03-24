<?php
return array(
    'app_name' => 'begagu.com',
    'locale' => 'th',//en th
    /*
    |--------------------------------------------------------------------------
    | Production Mode
    |--------------------------------------------------------------------------
    |	development
    |	testing
    |	production
    */
    'production_mode' => 'development',
//    'production_os' => 'windows',
    'production_os' => 'linux',

    /*
    |--------------------------------------------------------------------------
    | Error Logging Threshold
    |--------------------------------------------------------------------------
    |	0 = Disables logging, Error logging TURNED OFF
    |	1 = Error Messages (including PHP errors)
    |	2 = Debug Messages
    |	3 = Informational Messages
    |	4 = All Messages
    */
    'log' => array(
        'log_threshold' => 4,
        'log_path' => '',
        'log_date_format' => 'Y-m-d H:i:s',
    ),
    /*
    |--------------------------------------------------------------------------
    | File and Directory Modes
    |--------------------------------------------------------------------------
    |
    | These prefs are used when checking and setting modes when working
    | with the file system.  The defaults are fine on servers with proper
    | security, but you may wish (or even need) to change the values in
    | certain environments (Apache running a separate process for each
    | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
    | always be used to set the mode correctly.
    |
    */
    'chmod_mode' => array(
        'file_read_mode' => 0644,
        'file_write_mode' => 0666,
        'dir_read_mode' => 0755,
        'dir_write_mode' => 0777,
    ),

    'upload_image' => array(
        'default_width' => 960,
        'default_height' => 960,
        'avatar_thumnail_main' => 160,
        'avatar_thumnail_second' => 40,
        'avatar_thumnail_third' => 32,
        'input_name' => 'v_file',
        'create_thumbnail' => true,
        'create_thumbnail_width' => 120,
        'create_thumbnail_exname' => '_thumb',
    ),


    /*
    |--------------------------------------------------------------------------
    | File Stream Modes
    |--------------------------------------------------------------------------
    |
    | These modes are used when working with fopen()/popen()
    |
    */
    'fopen_mode' => array(
        'fopen_read' => 'rb',
        'fopen_read_write' => 'r+b',
        'fopen_write_create_destructive' => 'wb',// truncates existing file data, use with care
        'fopen_read_write_create_destructive' => 'w+b',// truncates existing file data, use with care
        'fopen_write_create' => 'ab',
        'fopen_read_write_create' => 'a+b',
        'fopen_write_create_strict' => 'xb',
        'fopen_read_write_create_strict' => 'x+b',
    ),

    /*
    |--------------------------------------------------------------------------
    | mod_rewrite
    |--------------------------------------------------------------------------
    |mod_rewrite enable in AppServ\Apache2.2\conf and restart Apache
    */
    'url_rewriting' => true,
    'url_rewriting_extension' => '',//eg .do, .htm

    /*
    |--------------------------------------------------------------------------
    | Session And Cookie
    |--------------------------------------------------------------------------
    */
    'cookie_time' => (3600*24*30), // 30 days,


    /*
    |--------------------------------------------------------------------------
    | DATABASE CONNECTIVITY SETTINGS
    |--------------------------------------------------------------------------
    */
    'db_default_driver' => 'mysql',
    'mysql' => array(
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'database'  => 'gradius',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'port'    => '3306',
        'strict'    => false,
    ),
    'sqlite' => array(
        'driver'   => 'sqlite',
        'database' => 'D:/database.sqlite',//path of sqlite
        'prefix'   => '',
    ),
    'pgsql' => array(
        'driver'   => 'pgsql',
        'host'     => '',
        'database' => '',
        'username' => '',
        'password' => '',
        'charset'  => 'utf8',
        'prefix'   => '',
        'schema'   => 'public',
    ),
    'sqlsrv' => array(
        'driver'   => 'sqlsrv',
        'host'     => '',
        'database' => '',
        'username' => '',
        'password' => '',
        'prefix'   => '',
    ),

    /*
    | any  == anybody can register (default)
    | admin == members must be registered by an administrator
    | root  == only the root user can register members
    */
    'can_register'   => 'any',
    'default_role'   => 'member',
    /*
    | Is this a secure connection?  The default is FALSE, but the use of an
    | HTTPS connection for logging in is recommended.
    | If you are using an HTTPS connection, change this to TRUE
    */
    'secure'   => false,

    'base_paging_param'   => 'page',
    'base_module_name'   => 'module',
    'url'   => 'http://192.168.254.8',//http://192.168.100.8
    'url_rewriting_project_path'   => '/gradius/',
    'base_project_path'   => '/gradius/',
    'base_project_resources_path'   => '/gradius/resources',
    'url_radius_client'   => 'http://192.168.100.2/',

    /*
     | can use "index.php" will be like "index.php?module=login" or "" empty string will be like "?module=login"
     | config .htaccess for xample.com/login for hide 'index.php?module='
     */
    'base_index_name'   => 'index.php',
    /*
     | for admin only on windows ../app_data/bekaku , on linux /var/app_data/bekaku
     */
    'base_data_path'   => '../app_data/gradius',
    'base_data_display'   => '/app_data/gradius'

);