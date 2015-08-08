<?php
require_once("../include/config.php");
$name_company = $_POST['name_company'];
$name_sotr = $_POST['name_sotr'];
$dolzn_sotr = $_POST['dolzn_sotr'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$country = $_POST['country'];
$adress = $_POST['adress'];
$password = md5($_POST['pass1']);
$opisanie = $_POST['opisanie'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $data['msg'] = "E-mail ($email) указан неверно.";
}


$link = mysql_connect($db,$user,$pass) or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');
$query="INSERT INTO company(name_company, name_sotr, dolzn_sotr, email, tel, country, adress, password, opisanie) VALUES('$name_company', '$name_sotr', '$dolzn_sotr', '$email', '$tel', '$country', '$adress', '$password', '$opisanie')";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

header("Content-Type: application/json");
$data['msg'] = "Компания успешно добавлена";
echo json_encode($data);
exit;
?>