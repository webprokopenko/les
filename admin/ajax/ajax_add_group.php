<?php
$group_name = $_POST['group_name'];
$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');

$query="INSERT INTO category(name_category) VALUES('$group_name')";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

$data = array();

header("Content-Type: application/json");

echo json_encode($data);
exit;
?>