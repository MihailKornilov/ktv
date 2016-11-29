<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate");
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');

//$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
//$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);

//$kolonki=explode('-',$_GET['kolonki']);

//$find=$ktv->QueryObjectOne("select sort,direct from abonent_find where name='default' and admin=".$_SESSION['ks']);
//if($_GET['sort'])
//	if($_GET['sort']==$find->sort)
//		$direct=($find->direct?'':'desc');
//	else $direct='';

//echo "ktv_host ".$mysql['ktv_names']."<br>";
//echo "ktv_host ".$_SESSION['ks']."<br>";

$servername = $mysql['ktv_host'];
$username = $mysql['ktv_user'];
$password = $mysql['ktv_pass'];
$dbname = $mysql['ktv_database'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (($conn->connect_error) or (!$_SESSION['ks'])) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, $mysql['ktv_names']);


$sql = "SELECT id, f, i, o, adres_gorod_name, adres_ulica_name, adres_dom_num, adres_kv, balans, status FROM abonent where status=1 or status=6 or status=5";
$result = $conn->query($sql);
//$result = mysqli_query($conn, $sql);
//$result = mysql_fetch_array(mysql_query("SELECT id, f, i FROM abonent"))

//echo $result;
//mysqli_query ("set_client='cp1251'");//Следующие 4 строки решают проблему с кодировкой.
//mysqli_query ("set character_set_results='cp1251'");
//mysqli_query ("set collation_connection='cp1251_general_ci'");
//mysqli_query ("SET NAMES cp1251");
//mysqli_set_charset($result, "cp1251");

//if ($result->num_rows > 0) {
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "TV" . $row["id"]. ";" . $row["f"]. " " . $row["i"]." " . $row["o"].";" . $row["adres_gorod_name"].", " . $row["adres_ulica_name"] . ", д." . ltrim ( $row["adres_dom_num"],"0" ) . ", кв." .ltrim($row["adres_kv"],"0").";" . $row["balans"].";" . $row["status"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>
