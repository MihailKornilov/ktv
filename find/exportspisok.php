<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate");
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');



$servername = $mysql['ktv_host'];
$username = $mysql['ktv_user'];
$password = $mysql['ktv_pass'];
$dbname = $mysql['ktv_database'];

//echo "ktv_host ".$_SESSION['ks']."<br>";

$link = mysql_connect($servername, $username , $password);
if ((!$link) or (!$_SESSION['ks'])) {
    die('Не удалось соединиться : ' . mysql_error());
}

// выбираем foo в качестве текущей базы данных
$conn = mysql_select_db($dbname, $link);
if (!$conn) {
    die ('Не удалось выбрать базу foo: ' . mysql_error());
}
mysql_set_charset($mysql['ktv_names'],$link);


//$sql = "SELECT id, f, i, o, adres_gorod_name, adres_ulica_name, adres_dom_num, adres_kv, balans, status FROM abonent where status=1 or status=6 or status=5";
//$result = $conn->query($sql);
//$result = mysql_query($sql, $conn);
//$result = mysql_fetch_array(mysql_query("SELECT id, f, i FROM abonent"))

$result = mysql_query('SELECT id, f, i, o, adres_gorod_name, adres_ulica_name, adres_dom_num, adres_kv, balans, status FROM abonent where status=1 or status=6 or status=5');
if (!$result) {
    die('Неверный запрос: ' . mysql_error());
}


//if ($result->num_rows > 0) {
if (mysql_num_rows($result) > 0) {
    // output data of each row
while ($row = mysql_fetch_assoc($result)) {
//    while($row = $result->fetch_assoc()) {
        echo "TV" . $row["id"]. ";" . $row["f"]. " " . $row["i"]." " . $row["o"].";" . $row["adres_gorod_name"].", " . $row["adres_ulica_name"] . ", д." . ltrim ( $row["adres_dom_num"],"0" ) . ", кв." .ltrim($row["adres_kv"],"0").";" . $row["balans"].""."<br>";
    }
} else {
    echo "0 results";
}
//$conn->close();
mysql_close()
?>
