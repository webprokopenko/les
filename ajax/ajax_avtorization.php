<?php
require_once("../include/config.php");



$email = $_POST['login'];
$password = md5($_POST['pass']);
$data['users'] = $_POST['login'];
$data['pas'] = $_POST['pass'];
//
//$link = mysql_connect($db,$user,$pass) or die('Не удалось соединиться: '.mysql_error());
//mysql_select_db('m1') or die('Не удалось выбрать БД');
//$query="SELECT * FROM company WHERE email='$email' AND password='$password'";
//echo $query;
//$result = mysql_query($query) or die ('Запрос не удался'.mysql_error());
////$data['user_id'] = mysql_result($result,0);
////$data = $result->fetch_assoc();
////printf("id = %s (%s)\n", $data['id'], gettype($data['id']));
//
//
//if($data['user_id']){
//    $data['user']='Авторизация пройдена успешно';
//}else{
//    $data['user']='Нет такого пользователя';
//};
//header("Content-Type: application/json");
////$data['msg'] = "Вы успешно авторизовались";
echo json_encode($data);
exit;
?>