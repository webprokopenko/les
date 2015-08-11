<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    session_start();
    require_once("../include/config.php");


    $email = $_POST['login'];
    $password = md5($_POST['pass']);

    $link = mysql_connect($db, $user, $pass) or die('Не удалось соединиться: ' . mysql_error());
    mysql_select_db('m1') or die('Не удалось выбрать БД');
    $query = "SELECT * FROM company WHERE email='$email' AND password='$password'";

    $result = mysql_query($query) or die ('Запрос не удался' . mysql_error());
    $data['user_id'] = mysql_result($result, 0);

    if ($data['user_id']) {
        $_SESSION['user_id'] = $data['user_id'];
        $data['msg'] = 'Авторизация пройдена успешно';

    } else {
        $data['msg'] = 'Вы ввели неверный логин или пароль';
    }
    header("Content-Type: application/json");

    echo json_encode($data);
    exit;
}else {
    header('HTTP/1.0 403 Forbidden');
}

?>