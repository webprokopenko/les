<?php
//
//require_once('function.php');
//$sql=new sql;
//$mysql=new mysql;
//$mysql->connect('localhost', 'root', '', 'm1');
//
//$reg_slv=$sql->fetch_array("SELECT * FROM category");
//if(!empty($reg_slv)){
//    foreach($reg_slv as $value)
//    {
//        $data['category'][++$i]['name']=$value['name_category'];
//        $data['category'][$i]['id']=$value['id_category'];
//    }
//}


$link = mysql_connect('localhost','root','') or die('Не удалось соединиться: '.mysql_error());
mysql_select_db('m1') or die('Не удалось выбрать БД');

$query="SELECT * FROM category";
$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());

$data = array();

while ($doc = mysql_fetch_row($result))
{
    echo "<option value='".$i."'>".$doc[0].":".$doc[1]."</option>";
    $i++;
}


//header("Content-Type: application/json");

//echo json_encode($data);
exit;
?>