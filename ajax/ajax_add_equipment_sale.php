<?php
session_start();
if(($_SERVER['REQUEST_METHOD'] == "POST")&&($_POST['token']==$_SESSION['token'])&&(!empty($_FILES["foto_equipment"]))){
    if ($_FILES["foto_equipment"]["error"] == UPLOAD_ERR_OK) {
            $name = md5(uniqid($_FILES['foto_equipment']['name'])).".jpg";
            $full_name = "../uploads/".$name;
            if(move_uploaded_file( $_FILES["foto_equipment"]["tmp_name"], $full_name )){
                $data["file_name"]=$name;
                $data["error"]=0;
                header("Content-Type: application/json");
                echo json_encode($data);
                exit;
            }else{
                $data["error"]=1;
                $data["msg"]='Ошибка перемещения файла';
                header("Content-Type: application/json");
                echo json_encode($data);
                exit;
            }
    }else{
        $data["error"]=1;
        $data["msg"]='Не надо ломать наш сайт';
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
}
else{
if (($_SERVER['REQUEST_METHOD'] == "POST")&&($_POST['token']==$_SESSION['token'])) {
    if((filter_has_var(INPUT_POST,'nazvanie'))&&(filter_has_var(INPUT_POST,'model'))&&(filter_has_var(INPUT_POST,'status_equipment')))
    {
        if((filter_input(INPUT_POST, 'cena', FILTER_VALIDATE_INT))&&(strlen(filter_input(INPUT_POST,'nazvanie'))<30)&&(strlen(filter_input(INPUT_POST,'model'))<30)&&(strlen(filter_input(INPUT_POST,'cena'))<7)&&(strlen(filter_input(INPUT_POST,'status_equipment'))<2))
        {
            require_once("../include/config.php");
            require_once("../class/class.common.php");
            require_once("../class/class.equipment.php");

            $mysql = new Mysql();
            $mysql->connect($host, $user, $pass, $db);

            $equipment = new Equipment();

            $id_company = $_SESSION['user_id'];
            $nazvanie = trim(htmlspecialchars(mysql_real_escape_string($_POST['nazvanie'])));
            $model = trim(htmlspecialchars(mysql_real_escape_string($_POST['model'])));
            $status_equipment = trim(htmlspecialchars(mysql_real_escape_string($_POST['status_equipment'])));
            $cena = trim(htmlspecialchars(mysql_real_escape_string($_POST['cena'])));
            $data_actuality = date("Y-m-d");
            $id_type_action = 2; //Тип объявления - 1-покупка 2-продажа
            if(!empty($_POST['filename'])) $filename = trim(htmlspecialchars(mysql_real_escape_string($_POST['filename']))); else $filename=NULL;

            $data = $equipment->insertEquipment($id_company, $nazvanie, $model, $status_equipment, $cena, $data_actuality,$id_type_action,$filename);
            if($data){
                $data["error"]=0;
                $data["msg"]="Вы успешно добавили объявление в категорию Оборудование - Продажа";
            }
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
        $data['msg']="Все поля должны быть заполнены {$_POST['nazvanie']} , {$_POST['model']} , {$_POST['status_equipment']}";
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
}else {
    header('HTTP/1.0 403 Forbidden');
}
}
?>