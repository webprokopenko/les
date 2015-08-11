<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    session_start();
    require_once("../include/config.php");

    $link = mysql_connect($host, $user, $pass) or die('Не удалось соединиться: ' . mysql_error());
    mysql_select_db($db) or die('Не удалось выбрать БД');

    $id_company = $_SESSION['user_id'];
    $id_prod_category = trim(htmlspecialchars(mysql_real_escape_string($_POST['category_prod'])));
    $id_country_proish = trim(htmlspecialchars(mysql_real_escape_string($_POST['country_proish'])));
    $cena = trim(htmlspecialchars(mysql_real_escape_string($_POST['cena'])));
    $col_vo = trim(htmlspecialchars(mysql_real_escape_string($_POST['col_vo'])));
    $data_actuality = date("Y-m-d");
    $id_type_action = 1; //Тип объявления - 1-покупка 2-продажа



    $query = "INSERT INTO market_tovar_q (id_company, id_prod_category, id_country_proish, cena, col_vo, data_actuality, id_type_action)";
    $query.= " VALUES('$id_company', '$id_prod_category', '$id_country_proish', '$cena', '$col_vo', '$data_actuality', '$id_type_action')";
    $result = mysql_query($query) or die ('Запрос не удался' . mysql_error());

    //$data['user_id'] = mysql_result($result, 0);

    if($resault) {$data['msg']='Объявление успешно добавлено';} else {$data['msg'] = 'Ошибка обратитесь в службу поддержки';};

    header("Content-Type: application/json");

    echo json_encode($data);
    exit;
}else {
    header('HTTP/1.0 403 Forbidden');
}

?>