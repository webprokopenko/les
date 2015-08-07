<?php
$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');

$query="SELECT name_category FROM category GROUP BY id_category DESC";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

$data = array();

    while($line=mysql_fetch_array($result, MYSQL_ASSOC)){
        foreach($line as $col_value){
            $data[$i++]=$col_value;
        }
    }

header("Content-Type: application/json");

echo json_encode($data);
exit;
?>