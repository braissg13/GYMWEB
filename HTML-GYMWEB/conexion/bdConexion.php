<?php
// datos para la conexion a mysql
/*define('DB_SERVER','127.0.0.1');
define('DB_NAME','gymweb');
define('DB_USER','root');
define('DB_PASS','');
function ConectarBD(){
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
mysql_select_db(DB_NAME,$con);
}
*/
$connect = mysqli_connect("127.0.0.1", "root", "ziralla09", "gymweb");
if (mysqli_connect_errno())
{
	unset($connect);
}
?>
