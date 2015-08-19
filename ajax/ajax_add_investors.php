<?php
session_start();
if (($_SERVER['REQUEST_METHOD'] == "POST")&&($_POST['token']==$_SESSION['token'])) {
    if(filter_has_var(INPUT_POST,'opisanie'))
    {
        if((strlen(filter_input(INPUT_POST,'opisanie'))<2000))
        {
            require_once("../include/config.php");
            require_once("../class/class.common.php");
            require_once("../class/class.investors.php");

            $mysql = new Mysql();
            $mysql->connect($host, $user, $pass, $db);

            $investors = new Investors();

            $id_company = $_SESSION['user_id'];
            $opisanie = trim(htmlspecialchars(mysql_real_escape_string($_POST['opisanie'])));
            $date = date("Y-m-d");

            $data = $investors->insertInvestors($id_company, $opisanie,$date);

            header("Content-Type: application/json");
            echo json_encode($data);
            exit;

        }
        else{
            $data["error"]=1;
            $data['msg']="Вы вводите некорректные данные";
            header("Content-Type: application/json");
            echo json_encode($data);
            exit;
        }

    }
    else {
        $data["error"]=1;
        $data['msg']="Все поля должны быть заполнены";
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
}else {
    header('HTTP/1.0 403 Forbidden');
}