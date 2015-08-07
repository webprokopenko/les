<?php
$name_product = $_POST['name_product'];
$category_f_k = $_POST['category_f_k'];
$price = $_POST['price'];
$col_vo = $_POST['col_vo'];
$country_proish = $_POST['country_proish'];
$data_actuality = $_POST['data_actuality'];

$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');

$query="INSERT INTO product_tovari(name_product, category_f_k, price, col_vo, country_proish, data_actuality) VALUES('$name_product', '$category_f_k', '$price', '$col_vo', '$country_proish', '$data_actuality')";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

$data = array();

header("Content-Type: application/json");

echo json_encode($data);
exit;
?>