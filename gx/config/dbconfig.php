<?php

//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'User Name');
//define('DB_PASSWORD', 'Password');
//define('DB_DATABASE', 'DATABASE');
//$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
//$database = mysql_select_db(DB_DATABASE) or die(mysql_error());


define('DB_SERVER', 'aaglnrhc6ky1th.ch5sjbwjm96s.us-west-2.rds.amazonaws.com');
define('DB_USERNAME', 'stream');
define('DB_PASSWORD', 'gaoxi123');
define('DB_DATABASE', 'mindfullamp');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
