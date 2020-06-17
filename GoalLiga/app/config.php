<?php
# config file contains constants that might vary from one web server to another

define('SYSTEM_PATH', dirname(__FILE__)); # location of 'app' folder - don't change

define('BASE_URL','http://localhost/CS3744-N/GoalLiga/'); # your base URL

// constants for admin access
//define('ADMIN_USERNAME','foo');
//define('ADMIN_PASSWORD','bar');

// database credentials
define('DB_HOST','127.0.0.1');
define('DB_DBNAME','goalligaarticles');
define('DB_USER','root');
define('DB_PASS','');
