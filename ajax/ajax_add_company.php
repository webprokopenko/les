<?php
if (($_SERVER['REQUEST_METHOD'] == "POST")) {
    if((!empty($_POST['name_company']))&&(!empty($_POST['name_sotr']))&&(!empty($_POST['dolzn_sotr']))&&(!empty($_POST['email']))&&(!empty($_POST['tel']))&&(!empty($_POST['country']))&&(!empty($_POST['pass1']))&&(!empty($_POST['opisanie']))) {
        if((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))&&(is_string($_POST['name_sotr']))&&(is_string($_POST['name_company']))&&(strlen($_POST['opisanie'])<100)&&(strlen($_POST['adress'])<70)&&(strlen($_POST['name_sotr'])<30)&&(strlen($_POST['dolzn_sotr'])<50)&&(strlen($_POST['country'])<50)){

        require_once("../include/config.php");
        require_once("../class/class.market.php");
        $mysql = new Mysql();
        $mysql->connect($host, $user, $pass, $db);
        $market = new Market();

        $name_company = trim(htmlspecialchars(mysql_real_escape_string($_POST['name_company'])));
        $name_sotr = trim(htmlspecialchars(mysql_real_escape_string($_POST['name_sotr'])));
        $dolzn_sotr = trim(htmlspecialchars(mysql_real_escape_string($_POST['dolzn_sotr'])));
        $email = trim(htmlspecialchars(mysql_real_escape_string($_POST['email'])));
        $tel = trim(htmlspecialchars(mysql_real_escape_string($_POST['tel'])));
        $country = trim(htmlspecialchars(mysql_real_escape_string($_POST['country'])));
        $adress = trim(htmlspecialchars(mysql_real_escape_string($_POST['adress'])));
        $password = md5($_POST['pass1']);
        $opisanie = trim(htmlspecialchars(mysql_real_escape_string($_POST['opisanie'])));

        $query = "INSERT INTO company(name_company, name_sotr, dolzn_sotr, email, tel, country, adress, password, opisanie) VALUES('$name_company', '$name_sotr', '$dolzn_sotr', '$email', '$tel', '$country', '$adress', '$password', '$opisanie')";
        $result = $mysql->query($query);
        if($result){
            $data["error"]=0;
            $data['msg']="Регистрация успешно завершена";
            $data['company']=$email;
            $data['pass']=$password;
        }
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }else{
          $data["error"]=1;
          $data['msg']="Посмотрите внимательно! Вы вводите некорректную информацию";
          header("Content-Type: application/json");
          echo json_encode($data);
          exit;
    }
    }else {
        $data["error"]=1;
        $data['msg']="Все поля должны быть заполнены";
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }
}else {
    header('HTTP/1.0 403 Forbidden');
}

?>