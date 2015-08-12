<?php
if (($_SERVER['REQUEST_METHOD'] == "POST")) {
    if((!empty($_POST['login']))&&(!empty($_POST['pass']))){
        session_start();
        require_once("../include/config.php");
        require_once("../class/class.common.php");
        $mysql = new Mysql();
        $mysql->connect($host, $user, $pass, $db);
        $market = new Common();

        $email = trim(htmlspecialchars(mysql_real_escape_string($_POST['login'])));
        if((isset($_POST['redirect']))&&($_POST['redirect']==true)){$password=$_POST['pass'];}else{$password = md5($_POST['pass']);}

        $query = "SELECT id_company FROM company WHERE email='$email' AND password='$password'";
        $data=$mysql->fetch_one($query);

        if($data){
            $_SESSION['user_id']=$data['id_company'];
            $data['error']=0;
            $data['msg']='Вы успешно авторизовались';
        }else{
            $data['error']=1;
            $data['sql'] = $query;
            $data['msg']='Вы ввели неверный логин или пароль';
        }

        header("Content-Type: application/json");

        echo json_encode($data);
        exit;
    }else{
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