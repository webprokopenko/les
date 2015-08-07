<?php

$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');

$query="SELECT * FROM tovar";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

$data = array();

$i=0;
while ($doc = mysql_fetch_row($result))
{
    $data[$i]['id'] = $doc[0];
    $data[$i]['name'] = $doc[1];
    $i++;
}

header("Content-Type: application/json");

echo json_encode($data);
exit;
?>