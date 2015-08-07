<?php
$group_name = $_POST['group_name'];
$group_id = $_POST['group_id'];
$name_tovar = $_POST['name_tovar'];
$articul_tovar = $_POST['articul_tovar'];
$option_tovar = $_POST['option_tovar'];
$f_k_color_tovar = $_POST['f_k_color_tovar'];
$razmer_tovar = $_POST['razmer_tovar'];
$ves_tovar = $_POST['ves_tovar'];
$f_k_category = $_POST['f_k_category'];
$cena_tovar = $_POST['cena_tovar'];
$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');

$query="INSERT INTO tovar(name_tovar, articul_tovar, option_tovar, f_k_color_tovar, razmer_tovar, ves_tovar, f_k_category, cena_tovar) VALUES('$name_tovar', '$articul_tovar', '$option_tovar', '$f_k_color_tovar', '$razmer_tovar', '$ves_tovar', '$f_k_category', '$cena_tovar')";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

$data = array();

header("Content-Type: application/json");

echo json_encode($data);
exit;
?>