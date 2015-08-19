<?
require_once('class.common.php');
class Technology extends Common{
    function getBodyTechnology($type){
        $query_test = $this->fetch_array("SELECT * FROM technology WHERE id_type_action='$type' ORDER BY id_technology DESC");
        $body='';
        foreach ($query_test as $array) {
            $body.= "<li class='list__item catalog-item'>".
                "<div class='catalog-item__img-wrapper'>";
            $body.="<img src='img/technology.png' class='catalog-item__img' alt='Технологии'>";

            $body.=    "</div><div class='catalog-item__body'>".
                "<div class='catalog-item__name'>";

            $body.= "<a href='#' class='catalog-item__link'>Компания: ";
            $body.= $this->getCompany($array['id_company']);
            $body.=" </a></div>".
                "<div class='field'>".
                "<div class='field__name'>Дата</div>".
                "<div class='field__value'>".$array['data_actuality']."</div></div>".
                "<div class='field'>".
                "<div class='field__name'>Телефон</div>".
                "<div class='field__value'>";
            $body.="<div class='field__value'>".$this->getTelCompany($array['id_company']);
            $body.= "</div></div>".
                "<div class='field'>".
                "<div class='field__name'>Описание технологии</div>".
                "<div class='field__value'>".$array['opisanie_technology']."</div></div>".
                "</div>".
                "</div>".
                "</li>";
        }
        return $body;
    }
    function insertTechnology($id_company,$opisanie, $date, $id_type_action){
        $insert_market_query = "INSERT INTO technology (id_company,opisanie_technology, data_actuality, id_type_action)";
        $insert_market_query.= " VALUES('$id_company', '$opisanie','$date' ,'$id_type_action')";
        $result = $this->query($insert_market_query);
        if($result) {
            $data['error'] = 0;
            $data['msg']="Объявление успешно добавлено";
        }
        else {
            $data['error'] = 1;
            $data['msg']="Ошибка!!Обратитесь в службу поддержки";
        }
        return $data;
    }
}